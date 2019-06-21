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

// Listing routes
Route::get('listing/zoeken/{make}', 'ListingController@searchMake');
Route::get('listing/zoeken/{make}/{model}', 'ListingController@searchMakeModel');
Route::get('listing/zoeken/{make}/{model}/{year}/{price}', 'ListingController@searchExtra');
Route::put('listing/sluiten/{id}', 'ListingController@closeListing');
Route::resource('listing', 'ListingController');

// Ajax calls
Route::get('/addFavorite', 'FavoriteController@store');
Route::get('/removeFavorite', 'FavoriteController@destroy');
Route::post('/getMakes', 'ListingController@getMakes');
Route::post('/getModels', 'ListingController@getModels');
Route::post('/listing/zoeken', 'ListingController@search');

// Home routes
Route::get('/', 'PageController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

// Profile routes
Route::get('/profiel', 'ProfileController@index')->name('profiel');
Route::get('/profiel/{slug}', 'ProfileController@show');
Route::put('/profiel/{id}', 'ProfileController@update');
Route::delete('/profiel/delete/{id}', 'ProfileController@destroy');

// Admin routes
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/{slug}', 'AdminController@show');

// Chat routes
Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/chat/{id}', 'ChatController@show');
Route::post('/chat/send', 'ChatController@send');

// Bid routes
Route::post('/bieden', 'BidController@store');


