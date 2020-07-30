<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 * @package App\Models
 * @version September 18, 2019, 8:00 pm UTC
 *
 * @property string course_name
 * @property string course_code
 * @property string describtion
 * @property boolean status
 */
class Course extends Model
{
    use SoftDeletes;

    public $table = 'courses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'course_name',
        'course_code',
        'describtion',
        'class',
        'department',
        'gradeSystem',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_name' => 'string',
        'course_code' => 'string',
        'describtion' => 'string',
        'class' => 'string',
        'department' => 'string',
        'gradeSystem' => 'integer',
        'status' => 'tyinyinteger'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_name' => 'required',
        'course_code' => 'required',
        'describtion' => 'required',
        'status' => 'required'
    ];

    // WE WILL WRITE OUR RELATIONSHIP HERE OKAY.
    public function classSchedule()
    {
        return $this->hasMany('App\Models\ClassSchedule');
    }

    public function semester_detail()
    {
        return $this->hasMany('App\SemesterDetail');
    }

    public function semester_subject()
	{
		return $this->hasMany('App\SemesterSubjects');
		
    }
    
    public function student_subjects()
	{
		return $this->hasMany('App\StudentSubjects');
		
	}


    public function classassign()
	{
		return $this->hasMany('App\Models\ClassAssigning');
		
	}
}
