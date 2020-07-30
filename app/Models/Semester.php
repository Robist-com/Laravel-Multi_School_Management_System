<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Semester
 * @package App\Models
 * @version September 24, 2019, 3:04 am UTC
 *
 * @property string semester_name
 * @property string semester_code
 * @property string semester_duration
 * @property string semester_description
 */
class Semester extends Model
{
    use SoftDeletes;

    public $table = 'semesters';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // protected $primaryKey = 'semester_id';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'semester_name', 
        'semester_code',
        'semester_duration',
        'semester_description',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'semester_name' => 'string',
        'semester_code' => 'string',
        'semester_duration' => 'string',
        'semester_description' => 'string',
        'status' => 'tinyint'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'semester_name' => 'required',
        'semester_code' => 'required',
        'semester_duration' => 'required',
        'semester_description' => 'required',
        'status' => 'required'
    ];

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

    public function Teacher()
    {
        return $this->hasMany('App\Models\Teacher');
    }

    public function student_subjects()
    {
        return $this->hasMany('App\StudentSubjects');
    }

}
