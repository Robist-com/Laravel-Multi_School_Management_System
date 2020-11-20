<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoteStudent extends Model
{
    protected $table = 'promote_students';
	protected $fillable = ['student_id',
	'grade_id',
	'class_code',
	'status', 'school_id'
	];
}
