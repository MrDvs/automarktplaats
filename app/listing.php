<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \app\vehicle;

class listing extends Model
{
	public function vehicle()
	{
	    return $this->hasOne(Vehicle::class);
	}
}
