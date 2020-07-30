<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubjects extends Model
{
    protected $table = 'students_subjects';
    protected $fillable = ['student_id', 'semester_id','degree_id','department_id','faculty_id','batch_id'];
    protected $primaryKey = 'status_id';
    public $timestamps = false;


    protected $with=['semester', 'course1','student','faculty','department','degree'];

    public function course1()
    {
        return $this->belongsTo('App\Models\Course');
    }
        
        public function semester1()
        {
            return $this->belongsTo('App\Models\Semester');
        }

        public function student1()
        {
            return $this->belongsTo('App\Models\Admission');
        }

        public function faculty1()
        {
            return $this->belongsTo('App\Models\Faculty');
        }

        public function department1()
        {
            return $this->belongsTo('App\Models\Department');
        }

        public function degree()
        {
            return $this->belongsTo('App\Degree');
        }
}

