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

// Auth routes
Auth::routes();

// Resource route for the listings
Route::resource('listing', 'ListingController');

// Test route
Route::get('test', 'PageController@test');

// Ajax call
Route::get('addFavorite', 'FavoriteController@store');

// Main routes
Route::get('/', 'PageController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profiel', 'ProfileController@index')->name('profiel');
Route::put('/profiel/{id}', 'ProfileController@update');


