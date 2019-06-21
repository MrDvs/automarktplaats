<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\vehicle;
use \App\listing;
use \App\bid;
use \App\Image;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = listing::get('id');
        $highlighted = listing::with('vehicle', 'bids')->inRandomOrder()->take(3)->get();
        foreach ($highlighted as $key => $highlight) {
            // Pak het hoogste bod op deze listing
            $highlighted[$key]->highest_bid = Bid::where('listing_id', $highlight['id'])->max('amount');
            // Pak de path naar de main image van deze listing
            $image = Image::where([['listing_id', $highlight['id']], ['mainImage', 1]])->get();
            $highlighted[$key]['image'] = $image[0]['img_path'];
        }
        return view('index', [
            'listings' => $listings,
            'highlighted' => $highlighted,
        ]);
    }

    public function test()
    {
        return view('listings.test');
    }
}
