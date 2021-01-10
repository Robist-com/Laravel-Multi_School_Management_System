<?php

namespace App;


use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
use Cache;
class Roll extends Model
{
    use SoftDeletes;
    public $fillable = [
        'student_id', 'username','password', 'login_time','logout_time'
    ];

    protected $primaryKey = 'roll_id';
//  you can use both public and protected is private okay 


    public static function onlineStudent(){
        $students = Roll::join('admissions','admissions.id', '=' , 'rolls.student_id' )
                            ->where(['username' => Session::get('studentSession')])->first();
                            
                            return $students;// we will join the student with admission okay to have all his/her data's
    }

    public function semester_detail()
    {
        return $this->hasMany('App\SemesterDetail');
    }

    public function student()
    {
        return $this->belongsTo('App\Model\Admission');
    }

    public function isOnline()
	{
		return Cache::has('student-online' . Session::get('studentSession'));
		
	}
}
