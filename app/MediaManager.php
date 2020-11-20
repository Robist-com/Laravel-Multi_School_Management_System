<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaManager extends Model
{
   protected $table = 'media_managers';

   protected $fillable = ['filename', 'schol_id'];
}
