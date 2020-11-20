<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attendance
 * @package App\Models
 * @version September 24, 2019, 12:54 am UTC
 *
 * @property integer student_id
 * @property integer class_id
 * @property integer subject_id
 * @property integer teacher_id
 * @property integer attendance_status
 */
class Attendance extends Model
{
    use SoftDeletes;

    public $table = 'attendances';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'attendance_id';

    public $fillable = [
        'student_id',
        'class_id',
        'course_id',
        'teacher_id',
        'attendance_date',
        'attendance_status',
        'edit_date',
        'day',
        'school_id',
        'month',
        'year',
        'attendance_reason'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'attendance_id' => 'integer',
        'student_id' => 'integer',
        'class_id' => 'integer',
        'course_id' => 'integer',
        'teacher_id' => 'integer',
        'attendance_date' => 'string',
        'attendance_status' => 'string',
        'edit_date' => 'string',
        'day' => 'string',
        'month' => 'string',
        'year' => 'string',
        'school_id' => 'integer',
        'attendance_reason' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required',
        'class_id' => 'required',
        'subject_id' => 'required',
        'teacher_id' => 'required',
        'attendance_status' => 'required'
    ];

    public function admission()
    {
        return $this->hasMany('App\Models\Admission');
    }

    public function semester()
    {
        return $this->hasMany('App\Models\Semester');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
}
