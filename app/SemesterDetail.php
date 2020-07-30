<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemesterDetail extends Model
{
    protected $with=['semester', 'course','student'];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
        
        public function semester()
        {
            return $this->belongsTo('App\Models\Semester');
        }

        public function student()
        {
            return $this->belongsTo('App\Models\Admission');
        }
        
}
