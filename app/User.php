<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

     /**
     * Get the user that role that own by the user.
     */
    public function role()
    {
        return $this->belongsTo('App\Roles');
    }

    public function isOnline(){ // THIS IS THE FUNCTION THAT WE CALLED INSIDE THE TEACHER ONLINE TBALE OKAY

        return Cache::has('user-online' . $this->id);// is the current login user id okay.

        //now we will create one file for the online users okay.
        //i have alreay created it let me show you to guys

	}

}