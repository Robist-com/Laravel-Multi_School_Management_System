<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClassAssigning
 * @package App\Models
 * @version September 19, 2019, 4:32 am UTC
 *
 */
class ClassAssigning extends Model
{
    use SoftDeletes;

    public $table = 'class_assignings';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $primaryKey = 'class_assign_id';

    public $fillable = [
        'teacher_id' ,
        'class_schedule_id' 
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'teacher_id' => 'integer',
        'class_schedule_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'class_assign_id' => 'required',
        'teacher_id' => 'required',
        'class_schedule_id' => 'required'
    ];

    protected $with=['teacher', 'classSchedule'];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
    
    public function classSchedule()
	{
		return $this->belongsTo('App\Models\ClassSchedule');
    }
    




    
	
	 public function courses()
	{
		return $this->belongsToMany('App\Models\Course');
		
    }
    
    // public function student()
	// {
	// 	return $this->belongsToMany('App\Models\Admission');
		
	// }
}
