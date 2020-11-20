<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';
    protected $fillable = ['school_id', 'expense_type_id','status','amount', 'name', 'date','invoice_number', 'file', 'description'];
}
