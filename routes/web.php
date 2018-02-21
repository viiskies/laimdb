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
    Route::get('/category/create', 'CategoriesController@create')->name('categories.create');
    Route::post('/category/store', 'CategoriesController@store')->name('categories.store');
    Route::get('/category/edit/{id}', 'CategoriesController@edit')->name('categories.edit');
    Route::post('/category/update/{id}', 'CategoriesController@update')->name('categories.update');
    Route::get('/category/delete/{id}', 'CategoriesController@destroy')->name('categories.destroy');
    
    Route::get('/movie/create', 'MoviesController@create')->name('movies.create');
    Route::post('/movie/store', 'MoviesController@store')->name('movies.store');
    Route::get('/movie/edit/{id}', 'MoviesController@edit')->name('movies.edit');
    Route::post('/movie/update/{id}', 'MoviesController@update')->name('movies.update');
    Route::get('/movie/delete/{id}', 'MoviesController@destroy')->name('movies.destroy');
    
    Route::get('/actor/create', 'ActorsController@create')->name('actors.create');
    Route::post('/actor/store', 'ActorsController@store')->name('actors.store');
    Route::get('/actor/edit/{id}', 'ActorsController@edit')->name('actors.edit');
    Route::post('/actor/update/{id}', 'ActorsController@update')->name('actors.update');
    Route::get('/actor/delete/{id}', 'ActorsController@destroy')->name('actors.destroy');
} );

Route::get('/categories', 'CategoriesController@index')->name('categories.all');   
Route::get('/category/{id}', 'CategoriesController@show')->name('categories.show');

Route::get('/movies', 'MoviesController@index')->name('movies.all');    
Route::get('/movie/{id}', 'MoviesController@show')->name('movies.show');
Route::get('/movie/upvote/{id}', 'MoviesController@upvote')->name('movies.upvote');
Route::get('/movie/downvote/{id}', 'MoviesController@downvote')->name('movies.downvote');

Route::get('/actors', 'ActorsController@index')->name('actors.all');
Route::get('/actor/{id}', 'ActorsController@show')->name('actors.show');