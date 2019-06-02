<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listing extends Model
{
	public function vehicle()
	{
	    return $this->belongsTo('App\vehicle');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function images()
	{
		return $this->hasMany('App\Image');
	}

	public function bids()
	{
		return $this->hasMany('App\Bid');
	}
}
