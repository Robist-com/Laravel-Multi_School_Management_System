<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Classes
 * @package App\Models
 * @version September 18, 2019, 7:56 pm UTC
 *
 * @property string class_name
 * @property string class_code
 */
class Classes extends Model
{
    use SoftDeletes;

    public $table = 'classes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'class_name',
        'class_code',
        'department_id',
        'school_id',
        'grade_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'class_name' => 'string',
        'class_code' => 'string',
        'department_id' => 'integer',
        'school_id' => 'integer',
        'status' => 'string',
        'grade_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'class_name' => 'required',
        'class_code' => 'required',
        'department_id' => 'required',
        'grade_id' => 'required'
    ];

    
}
