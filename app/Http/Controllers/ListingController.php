<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\listing;
use \App\vehicle;
use Illuminate\Support\Facades\Auth;


class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = listing::with('vehicle')->get();
        return view('listings.index', ['listings' => $listings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $RDW_APP_TOKEN = env('RDW_APP_TOKEN');  
        return view('listings.create', ['RDW_APP_TOKEN' => $RDW_APP_TOKEN]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = new vehicle();
        $vehicle->make = request('make');
        $vehicle->model = request('model');
        $vehicle->save();

        $listing = new listing();
        $listing->user_id = Auth::id();
        $listing->vehicle_id = $vehicle->id;
        $listing->title = request('title');
        $listing->description = request('description');
        $listing->starting_price = request('price');
        $listing->save();

        return redirect('listing/'.$listing->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listing = listing::where('id', $id)->with('vehicle', 'user')->get();
        // Checked of de listing bestaat (als count() niet 0 is).
        if (count($listing)) {
            return view('listings.show', ['listing' => $listing[0]]);
        } else {
            echo 'Deze listing bestaat niet <a href="'.route('listing.index').'">Ga terug</a>';
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
