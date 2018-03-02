<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Movie;
use App\Actor;
use App\Image;
use App\User;


class MoviesController extends Controller
{
    
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $movies = Movie::orderBy('rating', 'desc')->orderBy('name', 'asc')->paginate(20);
        return view('movies.all', ['movies' => $movies]);
    }
    
    public function api(Request $request)
    {
        $url = 'https://api.themoviedb.org/3/genre/movie/list?api_key=1e2dcbc9bfec809dc5b5af87fba9f171';
        $json = json_decode(file_get_contents($url), true);

        foreach($json['genres'] as $genre) {
            $category = Category::create( [ 'user_id' => 1, 'name' => $genre['name'], 'description' => 'blank', 'id' => $genre['id'] ] );
        }
        return redirect()->action('MoviesController@index');
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        if (Auth::check()) {
            $request->user()->authorizeRoles('user');
        }
        $categories = Category::orderBy('name', 'asc')->get();
        $actors = Actor::orderBy('name', 'asc')->get();
        return view('movies.create', [ 'categories' => $categories, 'actors' => $actors ] );
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $request->user()->authorizeRoles('user');
        }
        $user_id = Auth::user()->id;
        $movie = Movie::create( $request->except('_token') + [ 'user_id' => $user_id ] );
        
        foreach ($request->file('photo') as $file) {
            $path = $file->storePublicly('public/photos/movies');
            $filename = basename($path);
            $featured = 1;
            $movie->images()->create(['filename' => $filename, 'user_id' => $user_id, 'featured' => $featured]);
            $featured = 0;
        }
        $actors_attached = $request->actor_id;
        $movie->actors()->attach($actors_attached);
        
        return redirect()->action('MoviesController@index');
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $movie = Movie::findOrFail( $id );
        return view('movies.single', [ 'movie' => $movie ]);
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id, Request $request)
    {
        if (Auth::check()) {
            $request->user()->authorizeRoles('user');
        }
        $movie = Movie::findOrFail( $id );
        $categories = Category::orderBy('name', 'asc')->get();
        $actors = Actor::orderBy('name', 'asc')->get();
        return view('movies.edit', ['movie' => $movie, 'categories' => $categories, 'actors' => $actors]);
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $request->user()->authorizeRoles('user');
        }
        $movie = Movie::findOrFail( $id );
        $user_id = Auth::user()->id;
        
        if (!empty($request->get('photo_id'))) {
            $movieImages = $movie->images;
            foreach ($movieImages as $image) {
                if (in_array($image->filename, $request->get('photo_id'))) {
                    $fullFileName = 'public/photos/movies/' . $image->filename; 
                    Storage::delete($fullFileName);
                    $image->delete($image->id);
                }
            }
        }
        
        if (!empty($request->featured)) {
            $movieImages = $movie->images;
            foreach ($movieImages as $image) {
                $image->update(['featured' => 0]);
            }
            $image = Image::findOrFail( $request->featured );
            $image->update(['featured' => 1]);
        }
        
        if (!empty($request->file('photo'))) {
            foreach ($request->file('photo') as $file) {
                $path = $file->storePublicly('public/photos/movies');
                $filename = basename($path);
                $movie->images()->create(['filename' => $filename, 'user_id' => $user_id, 'featured' => 0]);
            }
        }
        
        Movie::findOrFail( $id )->update(
            [      'name' => $request->get('name'), 
            'category_id' => $request->get('category_id'), 
            'description' => $request->get('description'), 
            'year' => $request->get('year'),
            'rating' => $request->get('rating')]
        );
        
        $actors_attached = $request->actor_id;
        $movie->actors()->sync($actors_attached);
        return redirect()->action('MoviesController@show', ['id' => $id]);
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request, $id)
    {
        if (Auth::check()) {
            $request->user()->authorizeRoles('user');
        }
        $movieToDelete = Movie::findOrFail( $id );
        $movieImages = $movieToDelete->images;
        foreach ($movieImages as $image) {
            $fullFileName = 'public/photos/movies/' . $image->filename; 
            Storage::delete($fullFileName);
            $image->delete($image->id);
        }
        $movieToDelete->votes()->detach();
        $movieToDelete->actors()->detach();
        $deletedMovie = Movie::destroy( $id );
        return redirect()->action('MoviesController@index');
    }
    
    public function upvote( $id ) {
        $movie = Movie::findOrFail( $id );
        $user_id = Auth::user()->id;    
        
        $voted = $movie->votes()->where('user_id', $user_id)->exists();
        if ($voted) {
            $vote = $movie->votes()->where('user_id', $user_id)->first()->pivot->vote;
            $movie->votes()->detach($user_id);               
            if ($vote == true) {
                $delta = -1;
            } else {
                $delta = 2;
                $movie->votes()->attach($user_id, ['vote' => true]);                         
            }
        } else {
            $movie->votes()->attach($user_id, ['vote' => true]);
            $delta = 1;
        }
        
        Movie::findOrFail( $id )->update(['rating' => ($movie->rating + $delta)]);
        return redirect()->action('MoviesController@index');
    }
    
    public function downvote( $id ) {
        $movie = Movie::findOrFail( $id );
        $user_id = Auth::user()->id;
        
        $voted = $movie->votes()->where('user_id', $user_id)->exists();
        if ($voted) {
            $vote = $movie->votes()->where('user_id', $user_id)->first()->pivot->vote;
            $movie->votes()->detach($user_id);
            if ($vote == false) {
                $delta = -1;
            } else {
                $movie->votes()->attach($user_id, ['vote' => false]);
                $delta = 2;            
            }
        } else {
            $movie->votes()->attach($user_id, ['vote' => false]);
            $delta = 1;
        }
        
        Movie::findOrFail( $id )->update(['rating' => ($movie->rating - $delta)]);
        return redirect()->action('MoviesController@index');
    }

    public function search($query) {
        $movies = Movie::search($query)->paginate(20);
        $movies->searchable();
        return view('movies.search', ['movies' => $movies]);
    }
}