<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use App\Movie;
use App\Actor;
use App\Image;


class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actor::orderBy('name', 'asc')->get();
        return view('actors.all', ['actors' => $actors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies = Movie::orderBy('name', 'asc')->get();
        return view('actors.create', [ 'movies' => $movies ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $actor = Actor::create( $request->except('_token') + [ 'user_id' => $user_id ] );

        $file = $request->file('photo');
        $path = $file->storePublicly('public/photos/actors/');
        $filename = basename($path);


        $actor->images()->create(['filename' => $filename, 'user_id' => $user_id, 'featured' => 0]);

        $movies_attached = $request->movie_id;
        $actor->movies()->attach($movies_attached);

        return redirect()->action('ActorsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = Actor::findOrFail( $id );
        return view('actors.single',  [ 'actor' => $actor ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movies = Movie::orderBy('name', 'asc')->get();
        $actor = Actor::findOrFail( $id );
        return view('actors.edit', ['actor' => $actor, 'movies' => $movies]);
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
        $actor = Actor::findOrFail( $id );
        $user_id = Auth::user()->id;
        if (!empty($request->get('photo_id'))) {
            $actorImages = $actor->images;
            foreach ($actorImages as $image) {
                if (in_array($image->filename, $request->get('photo_id'))) {
                    $fullFileName = 'public/photos/actors/' . $image->filename; 
                    Storage::delete($fullFileName);
                    $image->delete($image->id);
                }
            }
        }
                
        if (!empty($request->featured)) {
            $actorImages = $actor->images;
            foreach ($actorImages as $image) {
                $image->update(['featured' => 0]);
            }
            $image = Image::findOrFail( $request->featured );
            $image->update(['featured' => 1]);
         }
        
        if (!empty($request->file('photo'))) {
            foreach ($request->file('photo') as $file) {
                $path = $file->storePublicly('public/photos/actors');
                $filename = basename($path);
                $actor->images()->create(['filename' => $filename, 'user_id' => $user_id, 'featured' => 1]);
            }
        }
        Actor::findOrFail( $id )->update(
            ['name' => $request->get('name'), 
            'birthday' => $request->get('birthday'), 
            'deathday' => $request->get('deathday')]
        );

        $movies_attached = $request->movie_id;
        $actor->movies()->sync($movies_attached);
        return redirect()->action('ActorsController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actorToDelete = Actor::findOrFail( $id );
        
        $actorImages = $actorToDelete->images;
        foreach ($actorImages as $image) {
            $fullFileName = 'public/photos/actors/' . $image->filename; 
            Storage::delete($fullFileName);
            $image->delete($image->id);
        }
        $actorToDelete->movies()->detach();
        $deletedActor = Actor::destroy( $id );
        $actors = Actor::orderBy('name', 'asc')->get();
        return redirect()->action('ActorsController@index');
    }
}
