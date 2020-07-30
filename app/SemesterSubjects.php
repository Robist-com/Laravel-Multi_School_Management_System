<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemesterSubjects extends Model
{
    protected $table = 'semester_subjects';
    protected $fillable = ['semester_id','department_id','course_id','degree_id','faculty_id'];
	
	// CREATE THE TABLE OKAY  TABLE NAME semester_subjects 
	// ID is ID OKAY


    protected $with=['semester', 'course'];
	
    public function semester()
	{
		return $this->belongsTo('App\Models\Semester');
	}
	
	 public function course()
	{
		return $this->belongsTo('App\Models\Course');
		
	}
    
}
