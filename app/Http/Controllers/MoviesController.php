<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Movie;
use App\Actor;
use App\Image;


class MoviesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $movies = Movie::orderBy('name', 'asc')->get();
        return view('movies.all', ['movies' => $movies]);
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
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
       
        // dd($request->file('photo'));
        $user_id = Auth::user()->id;
        $movie = Movie::create( $request->except('_token') + [ 'user_id' => $user_id ] );
        
        foreach ($request->file('photo') as $file) {
            $path = $file->storePublicly('public/photos/movies');
            $filename = basename($path);
            $movie->images()->create(['filename' => $filename, 'user_id' => $user_id]);
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
    public function edit($id)
    {
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
        // dd($request->get('photo_id'));
        // image update

        $movieImages = Movie::findOrFail( $id )->images;
        foreach ($movieImages as $image) {
            if (in_array($image->filename, $request->get('photo_id'))) {
                $fullFileName = 'public/photos/movies/' . $image->filename; 
                Storage::delete($fullFileName);
                $image->delete($image->id);
            }
        }
        
        $movie = Movie::findOrFail( $id )->update(
            ['name' => $request->get('name'), 
            'category_id' => $request->get('category_id'), 
            'description' => $request->get('description'), 
            'year' => $request->get('year'),
            'rating' => $request->get('rating')]
        );
        $movie = Movie::findOrFail( $id );
        
        $actors_attached = $request->actor_id;
        $movie->actors()->sync($actors_attached);
        
        return view('movies.single', ['movie' => $movie]);
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $movieToDelete = Movie::findOrFail( $id );
        $movieImages = Movie::findOrFail( $id )->images;
        foreach ($movieImages as $image) {
            $fullFileName = 'public/photos/movies/' . $image->filename; 
            Storage::delete($fullFileName);
            $image->delete($image->id);
        }

        $movieToDelete->actors()->detach();
        $deletedMovie = Movie::destroy( $id );
        $movies = Movie::orderBy('name', 'asc')->get();
        return view('movies.all', ['movies' => $movies]);
    }
    
    // public function save($request)
    // {
        //     $file = $request->file('photo');
        //     $path = $file->storePublicly('public/photos');
        //     $filename = basename($path);
        // }
    }
    