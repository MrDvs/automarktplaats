<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Intervention;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \App\listing;
use \App\vehicle;
use \App\favorite;
use \App\User;
use \App\Image;
use Storage;



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
        $listings = listing::with('vehicle', 'images', 'bids', 'favorites')->paginate(10);
        // dd($listings);
        foreach ($listings as $key => $listing) {
            $listings[$key]['favorited'] = count($listing['favorites']);
        }

        return view('listings.index', ['listings' => $listings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $endDate = Carbon::now()->addWeek()->format('d-m-Y');

        // Haalt de RDW app token uit de .env file voor de api call
        $RDW_APP_TOKEN = env('RDW_APP_TOKEN');
        return view('listings.create', ['RDW_APP_TOKEN' => $RDW_APP_TOKEN, 'endDate' => $endDate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Hier vind de validatie van alle form fields plaats.
        request()->validate([
            'mainImage' => 'required|image|max:2048',
            'extraImages.*' => 'required|image|max:2048',
        ]);

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
        $listing->expiration_date = Carbon::now()->addWeek();
        $listing->save();

        $images = new Image();
        $images->listing_id = $listing->id;
        $images->img_path = substr($request->mainImage->store('public'), 7);
        $images->mainImage = 1;
        $images->save();

        // Hier haalt intervention de image weer op, zorgt er voor dat de afbeelding het juiste formaat heeft en slaat het op als een JPG met 80% van zijn orginele kwaliteit. Daarnaast word de orginele afbeelding verwijderd.
        $img = Intervention::make(Storage::disk('public')->get($images->img_path))
            ->fit(664, 373)
            ->encode('jpg', 80);
        Storage::disk('public')->delete($images->img_path);
        Storage::disk('public')->put($images->img_path, $img);

        if (!is_null(request('extraImages'))) {
            foreach (request('extraImages') as $image) {
                $images = new Image();
                $images->listing_id = $listing->id;
                $images->img_path = substr($image->store('public'), 6);
                $images->save();

                // Hier haalt intervention de image weer op, zorgt er voor dat de afbeelding het juiste formaat heeft en slaat het op als een JPG met 80% van zijn orginele kwaliteit. Daarnaast word de orginele afbeelding verwijderd.
                $img = Intervention::make(Storage::disk('public')->get($images->img_path))
                    ->fit(664, 373)
                    ->encode('jpg', 80);
                Storage::disk('public')->delete($images->img_path);
                Storage::disk('public')->put($images->img_path, $img);
            }
        }

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
        $listing = listing::where('id', $id)->with('vehicle', 'user', 'images', 'bids')->get();
        Carbon::setLocale('nl');
        $timeLeft = Carbon::parse($listing[0]['expiration_date'])->diffForHumans();

        $favorite = favorite::where([
            ['user_id', Auth::id()],
            ['listing_id', $listing[0]['id']]
        ])->get();

        if(count($favorite)) {
            $favorite = 1;
        } else {
            $favorite = 0;
        }

        if (count($listing[0]['bids'])) {
            foreach ($listing[0]['bids'] as $key => $bid) {
                // echo $bid;
                $user = User::find($bid['user_id']);
                $listing[0]['bids'][$key]['username'] = $user['first_name'];
            }
        }

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
            return view('listings.show', [
                'listing' => $listing[0],
                'favorite' => $favorite,
                'timeLeft' => $timeLeft
            ]);
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

        return redirect('listing/')->with('succes-message', 'Je advertentie is succesvol aangepast!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listing = listing::where('id', $id)->with('images', 'vehicle')->get();

        if ($listing[0]['user_id'] == Auth::id()) {

            // dd($listing);

            foreach ($listing[0]['images'] as $image) {
                echo $image->img_path."<br><br>";
                Storage::delete('/public/'.$image->img_path);
                $image->delete();
            }
            $listing[0]['vehicle']->delete();
            $listing[0]->delete();

            return redirect('listing/')->with('error-message', 'Je advertentie is succesvol verwijderd!');
        } else {
            echo "Das machen sie eswas nicht machen meiner soon";
        }
    }
}
