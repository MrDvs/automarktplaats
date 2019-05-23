<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \App\listing;
use \App\vehicle;



class ListingController extends Controller
{
    public function __construct()
    {
        // Dit zorgt er voor dat de create blade alleen toegangelijk is voor ingelogde users
        $this->middleware('auth', ['only' => 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Haal alle listings op uit de database
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
        // Haalt de RDW app token uit de .env file voor de api call
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

        $vehicle->mileage = request('mileage');
        $vehicle->license_plate = request('licenseplate');
        $vehicle->year = request('year');
        $vehicle->color = request('color');
        $vehicle->state = request('state');
        $vehicle->body_type = request('body');
        $vehicle->apk_expiration = carbon::parse(request('apk'))->format("Y-m-d");
        $vehicle->transmission = request('transmission');
        $vehicle->gears = request('gear');
        $vehicle->engine_capicity = request('capacity');
        $vehicle->cylinders = request('cylinder');
        $vehicle->empty_weight = request('weight');
        $vehicle->drive = request('drive');
        $vehicle->fuel_type = request('fuel');
        $vehicle->doors = request('door');
        $vehicle->seats = request('seat');
        $vehicle->power = request('power');

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

        switch ($listing[0]['vehicle']->state) {
            case 'U':
                $listing[0]['vehicle']->state = 'Gebruikt';
                break;
            
            case 'N':
                $listing[0]['vehicle']->state = 'Nieuw';
                break;

            default:
                break;
        }
        switch ($listing[0]['vehicle']->transmission) {
            case 'A':
                $listing[0]['vehicle']->transmission = 'Automaat';
                break;
            
            case 'H':
                $listing[0]['vehicle']->transmission = 'Handgeschakeld';
                break;

            default:
                break;
        }

        // Zet het format om naar dag-maand-jaar
        $listing[0]['vehicle']->apk_expiration = carbon::parse($listing[0]['vehicle']->apk_expiration)->format("d-m-Y");

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
        $listing = listing::find($id);
        return view('listings.edit', ['listing' => $listing]);
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
        $listing = listing::find($id);
        $listing->title = request('title');
        $listing->description = request('description');
        $listing->save();

        return redirect('listing/')->with('message', 'Je advertentie is succesvol aangepast!');
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
