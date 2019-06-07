<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\favorite;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
    	$favorite = new favorite();
        $favorite->user_id = request('userId');
        $favorite->listing_id = request('listingId');
        $favorite->save();    	
    }

    public function destroy(Request $request)
    {
    	$favorite = favorite::where([
    		['user_id', request('userId')],
    		['listing_id', request('listingId')]
    	])->get();
    	print_r($favorite);
    	favorite::destroy($favorite[0]['id']);
    	// $favorite->destroy();
    }
}
