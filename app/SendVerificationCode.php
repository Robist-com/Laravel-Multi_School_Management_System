<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendVerificationCode extends Model
{
    protected $table = 'verificationcodes';

    public static function sendVerificationCode($phone)
    {
        $verificationcode = rand(1111,9999);
        $nexmo=app('Nexmo\Client');
        $nexmo->message()->send([
            'to'=> '+62' .(int) $phone, 
            'from'=>"081290348080" ,
            'text'=>'Please Verify your Account Code: ' .$verificationcode
        ]);
        return $verificationcode;
 
    }

    protected $fillable = [
        'name', 'email', 'password','phone','code','activate'
    ];
}
