<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeWork extends Model
{
    protected $table = 'homeworks';
    protected $fillable = ['body',
	'class_code',
	'semester_id',
	'subject_id',
	'file',
	'teacher_id',
	'start_date',
	'end_date',
	'status',
	'school_id'
	];
}
