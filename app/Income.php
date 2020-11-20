<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'incomes';
    protected $fillable = ['school_id', 'income_type_id','status','amount', 'name', 'date','invoice_number', 'file', 'description'];
}
