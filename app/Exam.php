<?php
namespace App;
class Exam extends \Eloquent {
	protected $table = 'exam';
	protected $fillable = ['type','class_id','department_id', 'school_id'];
}
