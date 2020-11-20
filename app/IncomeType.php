<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
    protected $table = 'income_types';
    protected $fillable = ['school_id', 'type','status'];
}
