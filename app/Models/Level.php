<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Level
 * @package App\Models
 * @version September 23, 2019, 10:05 am UTC
 *
 * @property string level
 * @property integer course_id
 * @property string level_description
 */
class Level extends Model
{
    use SoftDeletes;

    public $table = 'levels';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'level',
        'course_id',
        'level_description',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'level' => 'string',
        'course_id' => 'integer',
        'status' => 'tinyint',
        'level_description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'level' => 'required',
        'course_id' => 'required',
        'level_description' => 'required'
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Semester');
    }
    
    
    // public function class_schedulling()
    // {
    //     return $this->belongsTo('App\Models\Class_schedullings');
    // }
}
