<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MoviesController@index')->name('homepage');
Auth::routes();

Route::middleware('auth')->group(function() {
    Route::resource('categories', 'CategoriesController')->except(['index', 'show']);
    Route::resource('movies', 'MoviesController')->except(['index', 'show']);
    Route::resource('actors', 'ActorsController')->except(['index', 'show']);

    Route::get('/movie/upvote/{id}', 'MoviesController@upvote')->name('movies.upvote');
    Route::get('/movie/downvote/{id}', 'MoviesController@downvote')->name('movies.downvote');
} );

Route::resource('categories', 'CategoriesController')->only(['index', 'show']);
Route::resource('movies', 'MoviesController')->only(['index', 'show']);
Route::resource('actors', 'ActorsController')->only(['index', 'show']);

Route::get('/fb/login','FacebookController@redirect')->name('facebook.redirect');
Route::get('/fb/callback','FacebookController@callback')->name('facebook.callback');