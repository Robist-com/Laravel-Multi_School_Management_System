<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    Protected $table = 'timetable';
    public $fillable = [
        'teacher_id', 'class_id','course_id', 'start_time','end_time','day','color'
    ];
}
