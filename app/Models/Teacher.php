<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cache;
/**
 * Class Teacher
 * @package App\Models
 * @version September 24, 2019, 3:06 am UTC
 *
 * @property string first_name
 * @property string last_name
 * @property string gender
 * @property string email
 * @property string dob
 * @property string phone
 * @property string address
 * @property string nationality
 * @property string passport
 * @property string status
 * @property string dateregistered
 * @property integer user_id
 * @property integer semester_id
 * @property string image
 */
class Teacher extends Model
{
    use SoftDeletes;

    public $table = 'teachers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'teacher_id';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'roll_no',
        'first_name',
        'last_name',
        'gender',
        'email',
        'dob',
        'phone',
        'address',
        'faculty_id',
        'department_id',
        'nationality',
        'passport',
        'status',
        'dateregistered',
        'user_id',
        // 'semester_id',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'teacher_id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'gender' => 'string',
        'email' => 'string',
        'dob' => 'date',
        'phone' => 'string',
        'address' => 'string',
        'nationality' => 'string',
        'passport' => 'string',
        'status' => 'string',
        'dateregistered' => 'date',
        'user_id' => 'integer',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'gender' => 'required',
        'email' => 'required',
        'dob' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'nationality' => 'required',
        'passport' => 'required',
        'status' => 'required',
        'dateregistered' => 'required',
        'user_id' => 'required',
        'image'   => 'image|max:2048',
        'image'   => 'required'
    ];

    public function semesters()
    {
        return $this->belongsTo('App\Models\Semester');
    }

    public function classassign()
	{
		return $this->hasMany('App\Models\ClassAssigning');
		
    }
    
    public function isOnline(){ // THIS IS THE FUNCTION THAT WE CALLED INSIDE THE TEACHER ONLINE TBALE OKAY

        return Cache::has('user-online' . $this->id);// is the current login user id okay.

}
}
