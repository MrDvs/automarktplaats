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

// Resource route voor de listings
Route::post('listing/zoeken', 'ListingController@search');
// Route::get('listing/zoeken/{make}', 'ListingController@searchMake');
// Route::get('listing/zoeken/{make}/{model}', 'ListingController@searchMakeModel');
Route::resource('listing', 'ListingController');

// Test route
Route::get('/test', 'PageController@test');

// Ajax calls
Route::get('/addFavorite', 'FavoriteController@store');
Route::get('/removeFavorite', 'FavoriteController@destroy');

// Home routes
Route::get('/', 'PageController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

// Profile routes
Route::get('/profiel', 'ProfileController@index')->name('profiel');
Route::get('/profiel/{slug}', 'ProfileController@show');
Route::put('/profiel/{id}', 'ProfileController@update');

// Chat routes
Route::get('/chat', 'ChatsController@index');
Route::get('/chat/messages', 'ChatsController@fetchMessages');
Route::post('/chat/messages', 'ChatsController@sendMessage');

// Bid routes
Route::post('/bieden', 'BidController@store');


