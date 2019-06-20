<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bid;
use App\image;
use App\listing;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
    	return view('admin.index');
    }

    public function show($slug)
    {
    	switch ($slug) {

	        case 'users':
	            $users = User::all();
	            return view('admin.users', ['users' => $users]);
	            break;

	        case 'listings':
	            $listings = listing::with('vehicle', 'bids')->get();
	            foreach ($listings as $key => $listing) {
                    // Pak het hoogste bod op deze listing
                    $listings[$key]->highest_bid = Bid::where('listing_id', $listing['id'])->max('amount');

                    // Pak de path naar de main image van deze listing
                    $image = Image::where([['listing_id', $listing['id']], ['mainImage', 1]])->get();
                    $listings[$key]['image'] = $image[0]['img_path'];
                }
	            return view('admin.listings', ['listings' => $listings]);
	            break;
		}
    }
}
