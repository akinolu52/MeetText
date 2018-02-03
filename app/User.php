<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use App\Task;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'phone', 'role', 'avatar', 'provider', 'provider_id', 'skype', 'hangout', 'call_guest', 'meeting_location', 'preferred_time',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function interest()
    {
        return $this->hasMany('App\Interest');
    }
}
