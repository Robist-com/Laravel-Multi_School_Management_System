<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoManager extends Model
{
    protected $table = 'video_managers';

    protected $fillable = ['video_filename','video_name', 'schol_id'];
}
