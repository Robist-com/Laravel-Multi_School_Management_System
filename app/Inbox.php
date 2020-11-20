<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'inboxes';
    public $fillable = [
        'user_id', 'subject','message', 'status', 'school_id'
    ];
}
