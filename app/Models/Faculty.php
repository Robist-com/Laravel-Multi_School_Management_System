<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Faculty
 * @package App\Models
 * @version December 20, 2019, 4:04 pm UTC
 *
 * @property string faculty_name
 * @property string faculty_code
 * @property boolean faculty_status
 */
class Faculty extends Model
{
    use SoftDeletes;

    public $table = 'faculties';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $primaryKey = 'faculty_id';

    public $fillable = [
        'faculty_name',
        'faculty_code',
        'faculty_status',
        'school_id',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'faculty_id' => 'integer',
        'faculty_name' => 'string',
        'faculty_code' => 'string',
        'faculty_status' => 'boolean',
        'school_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'faculty_name' => 'required',
        'faculty_code' => 'required',
        'faculty_status' => 'required'
    ];

    public function student_subjects()
	{
		return $this->hasMany('App\StudentSubjects');
		
	}

    
}
