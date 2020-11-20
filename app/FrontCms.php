<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrontCms extends Model
{
   protected $table = 'front_cms';

   protected $fillable = ['head_background_color','footer_background_color','head_fore_color','footer_fore_color',
   'facebook_link','instagram_link','twiter_link','linkedin_link','youtube_link','whatsapp_link','icon','theme_name','school_id', 'theme_status'];
}
