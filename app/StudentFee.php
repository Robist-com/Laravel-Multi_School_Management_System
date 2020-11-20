<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    protected $table = 'student_fees';
    protected $fillable = ['fee_id', 'student_id', 'level_id', 'amount', 'school_id'];

    protected $primaryKey = 'student_fee_id';
    public $timestamps = false;
}

