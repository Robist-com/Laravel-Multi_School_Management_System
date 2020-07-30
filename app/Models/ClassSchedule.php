<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClassSchedule
 * @package App\Models
 * @version November 11, 2019, 8:28 am UTC
 *
 * @property integer course_id
 * @property integer class_id
 * @property string level_id
 * @property integer shift_id
 * @property integer classroom_id
 * @property integer batch_id
 * @property integer day_id
 * @property integer time_id
 * @property integer semester_id
 * @property string start_date
 * @property string end_date
 * @property boolean status
 */
class ClassSchedule extends Model
{
    use SoftDeletes;

    public $table = 'class_schedule';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'course_id',
        'class_id',
        'degree_id',
        'shift_id',
        'classroom_id',
        'batch_id',
        'day_id',
        'time_id',
        'semester_id',
        'department_id',
        'faculty_id',
        'teacher_id',
        'start_date',
        'end_date',
        'schedule_status'
    ];

    // protected $primaryKey = 'Scheduleid';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
        'class_id' => 'integer',
        'degree_id' => 'integer',
        'shift_id' => 'integer',
        'classroom_id' => 'integer',
        'batch_id' => 'integer',
        'day_id' => 'integer',
        'time_id' => 'integer',
        'semester_id' => 'integer',
        'teacher_id' => 'integer',
        'department_id' => 'integer',
        'faculty_id' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'schedule_status' => 'tinyint'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_id' => 'required',
        'class_id' => 'required',
        'degree_id' => 'required',
        'shift_id' => 'required',
        'classroom_id' => 'required',
        'batch_id' => 'required',
        'day_id' => 'required',
        'time_id' => 'required',
        'semester_id' => 'required',
        'teacher_id' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        // 'schedule_status' => 'required'
    ];
//  we will write  our another relationship here okay to be belongsto...

protected $with=['semester', 'course'];

public function course()
{
    return $this->belongsTo('App\Models\Course');
}
	
    public function semester()
	{
		return $this->belongsTo('App\Models\Semester');
	}
	

    public function classassign()
	{
		return $this->hasMany('App\Models\ClassAssigning');
		
    }
    


    public static function isTimeAvailable($days, $startTime, $endTime, $class, $teacher, $lesson)
    {
        $classtimetables = ClassSchedule::where('day_id', $days)
            ->when($classtimetables, function ($query) use ($classtimetables) {
                $query->where('id', '!=', $classtimetables);
            })
            ->where(function ($query) use ($class, $teacher) {
                $query->where('class_id', $class);
                    // ->orWhere('teacher_id', $teacher);
            })
            ->where([
                ['time_id', '<', $endTime],
                ['time_id', '>', $startTime]
            ])
            ->count();

        return !$lessons;
    }
}

//  now lets open our table to change soe of the codes to able to connect our 
//  course and class schedule okay..