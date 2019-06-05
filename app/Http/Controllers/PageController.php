<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\vehicle;
use \App\listing;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = listing::with('vehicle')->get();
        $makes = vehicle::select('make')->distinct()->get();
        $models = vehicle::select('model')->distinct()->get();
        
        return view('index', ['listings' => $listings, 'makes' => $makes, 'models' => $models]);
    }

    public function test()
    {
        return view('listings.test');
    }
}
