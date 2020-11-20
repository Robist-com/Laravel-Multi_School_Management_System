<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cache;
use Session;
/**
 * Class Admission
 * @package App\Models
 * @version September 21, 2019, 12:16 pm UTC
 *
 * @property string first_name
 * @property string last_name
 * @property string father_name
 * @property string father_phone
 * @property string mother_name
 * @property string gender
 * @property string email
 * @property string dob
 * @property string phone
 * @property string address
 * @property string current_address
 * @property string nationality
 * @property string passport
 * @property boolean status
 * @property string dateregistered
 * @property integer user_id
 * @property integer class_id
 * @property string image
 */
class Admission extends Model
{
    use SoftDeletes;

    public $table = 'admissions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $primaryKey = "id";

    public $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'father_phone',
        'mother_name',
        'gender',
        'email',
        'dob',
        'phone',
        'address',
        'current_address',
        'nationality',
        'passport',
        'status',
        'dateregistered',
        'user_id',
        'class_code',
        'department_id',
        'faculty_id',
        'degree_id', // degree_id
        'semester_id',
        'school_id',
        'batch_id',
        'online_admission',
        'acceptance',
        'matrital',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'father_name' => 'string',
        'father_phone' => 'string',
        'mother_name' => 'string',
        'gender' => 'string',
        'email' => 'string',
        'dob' => 'date',
        'phone' => 'string',
        'address' => 'string',
        'current_address' => 'string',
        'nationality' => 'string',
        'passport' => 'string',
        'status' => 'boolean',
        'dateregistered' => 'date',
        'user_id' => 'integer',
        'class_code' => 'string',
        'department_id' => 'integer',
        'faculty_id' => 'integer',
        'degree_id' => 'integer',
        'semester_id' => 'integer',
        'school_id' => 'integer',
        'image' => 'string',
        'acceptance' => 'string',
        'online_admission' => 'string',
        'matrital' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'father_name' => 'required',
        'father_phone' => 'required',
        'mother_name' => 'required',
        'gender' => 'required',
        'email' => 'required',
        // 'dob' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'current_address' => 'required',
        'nationality' => 'required',
        'passport' => 'required',
        'status' => 'required',
        'dateregistered' => 'required',
        'user_id' => 'required',
        'department_id' => 'required',
        'faculty_id' => 'required',
        'class_code' => 'required'
    ];

    public function semester_detail()
    {
        return $this->hasMany('App\SemesterDetail');
    }

    public function student_subjects()
    {
        return $this->hasMany('App\StudentSubjects');
    }

    public function isOnline()
	{
		return Cache::has('student-online' . $this->studentSession);
		
	}


    public function school()
    {
        return $this->belongsTo('App\School');
    }
    
}
