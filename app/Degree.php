<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $table = 'degrees';
    protected $fillable = ['degree_name','semester_id','description'];
    protected $primaryKey = 'degree_id';
    public $timestamps = false;

    public function student_subjects()
	{
		return $this->hasMany('App\StudentSubjects');
	}
}
