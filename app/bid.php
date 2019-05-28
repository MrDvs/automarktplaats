<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\Bid');
    }

    public function listing()
    {
    	return $this->belongsTo('App\listing');
    }
}
