<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Bid;

class BidController extends Controller
{
    public function store(Request $request)
    {

    	request()->validate([
            'bidAmount' => 'required|numeric|min:'.request('minAmount'),
        ]);

    	$bid = new Bid();
    	$bid->user_id = Auth::id();
    	$bid->listing_id = request('listingId');
    	$bid->amount = request('bidAmount');
    	$bid->save();

    	return redirect('listing/'.$bid->listing_id);
    }
}
