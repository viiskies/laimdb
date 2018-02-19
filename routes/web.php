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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'MoviesController@index')->name('homepage');
Auth::routes();

Route::get('/categories', 'CategoriesController@index')->name('categories.all');
Route::get('/category/create', 'CategoriesController@create')->name('categories.create');
Route::post('/category/store', 'CategoriesController@store')->name('categories.store');
Route::get('/category/{id}', 'CategoriesController@show')->name('categories.show');

Route::get('/movies', 'MoviesController@index')->name('movies.all');
Route::get('/movie/create', 'MoviesController@create')->name('movies.create');
Route::post('/movie/store', 'MoviesController@store')->name('movies.store');
Route::get('/movie/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/actors', 'ActorsController@index')->name('actors.all');
Route::get('/actor/create', 'ActorsController@create')->name('actors.create');
Route::post('/actor/store', 'ActorsController@store')->name('actors.store');
Route::get('/actor/{id}', 'ActorsController@show')->name('actors.show');
