<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolBanner extends Model
{
   protected $table = 'school_banners';

   protected $fillable = ['name', 'status', 'school_id', 'banner_image'];
}
