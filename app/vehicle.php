<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \app\listing;

class vehicle extends Model
{
    public function listing()
	{
	    return $this->belongsTo(Listing::class);
	}
}
