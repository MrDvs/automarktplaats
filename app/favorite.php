<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    public function user()
    {
    	$this->belongsTo('App\User');
    }

    public function listing()
    {
    	$this->belongsTo('App\listing');
    }
}
