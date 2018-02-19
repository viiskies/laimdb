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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoriesController@index')->name('categories.all');
Route::get('/categories/create', 'CategoriesController@create')->name('categories.create');
Route::post('/categories/store', 'CategoriesController@store')->name('categories.store');

Route::get('/movies', 'MoviesController@index')->name('movies.all');
Route::get('/movies/create', 'MoviesController@create')->name('movies.create');
Route::post('/movies/store', 'MoviesController@store')->name('movies.store');