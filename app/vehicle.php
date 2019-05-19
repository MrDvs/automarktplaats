<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
	public function listing()
	{
	    return $this->hasOne('App\listing');
	}
}
