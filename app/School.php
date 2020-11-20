<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';

    protected $guarded = [];


    public function owner()
    {
       return $this->belongsTo('App\User');
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
