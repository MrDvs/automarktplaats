<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\favorite;
use \App\listing;
use \App\Image;
use \App\Bid;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $listings = listing::where('user_id', $user->id)->with('vehicle')->with('bids')->get();
        $favorites = favorite::where('user_id', $user->id)->with('listing')->get();
        $bids = Bid::where('user_id', $user->id)->with('listing')->get();

        foreach ($favorites as $key => $favorite) {
            // echo $favorite['listing']['id'];
            $image = Image::where([['listing_id', $favorite['listing']['id']], ['mainImage', 1]])->get();
            $favorites[$key]['image'] = $image[0]['img_path'];
        }

        // dd($favorites);

        // foreach ($listings as $key => $listing) {
        //     $listings[$key]->highest_bid = Bid::where('listing_id', $listing['id'])->max('amount');
        // }

        return view('profile.index', ['user' => $user, 'listings' => $listings, 'bids' => $bids, 'favorites' => $favorites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        dd($id);
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
