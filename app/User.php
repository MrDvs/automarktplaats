<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

// class User extends Model
// {
//     public function listings()
//     {
//         return $this->hasMany('App\listing');
//     }
// }

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isadmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function listings()
    {
        return $this->hasMany('App\listing');
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }

    public function favorites()
    {
        return $this->hasMany('App\favorite');
    }

    public function messagesSend()
    {
      return $this->hasMany('App\Message', 'sender_id');
    }

    public function messagesReceived()
    {
      return $this->hasMany('App\Message', 'receiver_id');
    }
}
