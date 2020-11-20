<?php
namespace App;
class GPA extends \Eloquent {

	protected $table = 'gpa';
protected $fillable = ['for','gpa','grade','markfrom','markto', 'school_id'];
}
