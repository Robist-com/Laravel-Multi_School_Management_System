<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';

    protected $fillable = ['name', 'email', 'is_active', 'user_id', 'description', 'rating'];


    public function owner()
    {
       return $this->belongsTo('App\User');
    }

     public function institute()
    {
       return $this->hasMany('App\Institute');
    }

    public function admission()
    {
       return $this->hasMany('App\Models\User');
    }

    public function fee_structure()
    {
      return $this->hasMany('App\Models\FeeStructure');
    }
}
