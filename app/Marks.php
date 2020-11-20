<?php
namespace App;
class Marks extends \Eloquent {
  protected $table = 'marks';
	protected $fillable = ['roll_no',
	'exam',
	'department',
	'written',
	'mcq',
	'shift',
	'practical',
	'session',
	'total',
	'grade',
    'point',
    'Absent',
    'class',
	'ca', 'school_id'
	];
}
