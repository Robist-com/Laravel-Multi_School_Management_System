<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School_Event extends Model
{
   protected $table = 'school_events';

   protected $fillable = ['name', 'place', 'start_date', 'end_date', 'school_id', 'status', 'body'];

}
