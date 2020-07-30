<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClassRoom
 * @package App\Models
 * @version October 1, 2019, 12:29 pm UTC
 *
 * @property string classroom_name
 * @property string classroom_code
 * @property string classroom_description
 * @property boolean classroom_status
 */
class ClassRoom extends Model
{
    use SoftDeletes;

    public $table = 'class_rooms';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'classroom_id';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'classroom_name',
        'classroom_code',
        'classroom_description',
        'classroom_status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'classroom_id' => 'integer',
        'classroom_name' => 'string',
        'classroom_code' => 'string',
        'classroom_description' => 'string',
        'classroom_status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'classroom_name' => 'required',
        'classroom_code' => 'required',
        'classroom_description' => 'required',
        'classroom_status' => 'required'
    ];

    
}
