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
            'title' => 'required|max:191',
            'description' => 'required|string',
            'price' => 'nullable|numeric|digits_between:0,11',
            'make' => 'required|max:191',
            'model' => 'required|max:191',
            'licenseplate' => 'nullable',
            'mileage' => 'required|numeric|digits_between:0,11',
            'year' => 'required|numeric|digits_between:0,5',
            'color' => 'required|string',
            'state' => 'required|string',
            'body' => 'required|string',
            'apk' => 'nullable|date',
            'transmission' => 'required|string',
            'gear' => 'required|numeric|digits_between:0,11',
            'capacity' => 'nullable|numeric|digits_between:0,11',
            'cylinder' => 'nullable|numeric|digits_between:0,11',
            'weight' => 'nullable|numeric|digits_between:0,11',
            'drive' => 'required|string',
            'fuel' => 'required|string',
            'door' => 'required|numeric|digits_between:0,11',
            'seat' => 'required|numeric|digits_between:0,11',
            'power' => 'nullable|numeric|digits_between:0,11',
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
        $listing->starting_price = (null == request('price') ? 0 : request('price'));
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
        // Als de advertentie verlopen word hij inactief gesteld
        if ($listing[0]['expiration_date'] < Carbon::now() && $listing[0]['active'] == 1) {
            Listing::where('id', $id)->update(['active' => 0]);
        }
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
        $listing = listing::where('id', $id)->with('vehicle')->get();
        return view('listings.edit', ['listing' => $listing[0]]);
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
        request()->validate([
            'title' => 'required|max:191',
            'description' => 'required|string',
            'price' => 'nullable|numeric|digits_between:0,11',
            'make' => 'required|max:191',
            'model' => 'required|max:191',
            'mileage' => 'required|numeric|digits_between:0,11',
            'color' => 'required|string',
            'state' => 'required|string',
            'body' => 'required|string',
            'apk' => 'nullable|date',
            'capacity' => 'nullable|numeric|digits_between:0,10',
            'cylinder' => 'nullable|numeric|digits_between:0,10',
            'weight' => 'nullable|numeric|digits_between:0,10',
            'door' => 'required|numeric|digits_between:0,10',
            'seat' => 'required|numeric|digits_between:0,10',
            'power' => 'nullable|numeric|digits_between:0,10',
        ]);

        $listing = listing::find($id);
        $listing->title = request('title');
        $listing->description = request('description');
        $listing->starting_price = (null == request('price') ? 0 : request('price'));
        $listing->save();

        $vehicle = vehicle::find($listing->vehicle_id);
        $vehicle->make = request('make');
        $vehicle->model = request('model');
        $vehicle->mileage = request('mileage');
        $vehicle->color = request('color');
        $vehicle->state = request('state');
        $vehicle->body_type = request('body');
        $vehicle->apk_expiration = carbon::parse(request('apk'))->format("Y-m-d");
        $vehicle->engine_capicity = request('capacity');
        $vehicle->cylinders = request('cylinder');
        $vehicle->empty_weight = request('weight');
        $vehicle->doors = request('door');
        $vehicle->seats = request('seat');
        $vehicle->power = request('power');
        $vehicle->save();

        if (Auth::id() != $listing['user_id']) {
            return url('admin/listings');
        } else {
            return redirect('listing/')->with('succes-message', 'Je advertentie is succesvol aangepast!');
        }
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

        if ($listing[0]['user_id'] == Auth::id() || Auth::user()->is_admin) {

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
            return back();
        }
    }

    public function search(Request $request)
    {
        if (request('make') != 'alle') {
            if (request('model') != 'alle') {
                return ['redirect' => url('/listing/zoeken/'.request('make').'/'.request('model'))];
            } else {
                return ['redirect' => url('/listing/zoeken/'.request('make'))];
            }
        } else {
            return ['redirect' => url('/listing')];
        }
        return response()->json(request('make'));
    }

    public function searchMake($make)
    {
        $listings = listing::with('vehicle', 'images', 'bids', 'favorites')->whereHas('vehicle', function ($query) use($make) {
            $query->where('make', '=', $make);
        })->paginate(10);

        foreach ($listings as $key => $listing) {
            $listings[$key]['favorited'] = count($listing['favorites']);
        }

        return view('listings.index', ['listings' => $listings]);
    }

    public function searchMakeModel($make, $model)
    {
        $listings = listing::with('vehicle', 'images', 'bids', 'favorites')->whereHas('vehicle', function ($query) use($make, $model) {
            [
                [$query->where('make', '=', $make)],
                [$query->where('model', '=', $model)]
            ];
        })->paginate(10);

        foreach ($listings as $key => $listing) {
            $listings[$key]['favorited'] = count($listing['favorites']);
        }

        return view('listings.index', ['listings' => $listings]);
    }

    public function getMakes()
    {
        $makes = vehicle::select('make')->distinct()->get();
        return response()->json($makes);
    }

    public function getModels(Request $request)
    {
        // Haal alle unieke modellen van het geselecteerde merk uit de database
        if (request('make') != 'alle') {
            $models = vehicle::select('model')->distinct()->where('make', request('make'))->get();
            return response()->json($models);
        }
    }
}
