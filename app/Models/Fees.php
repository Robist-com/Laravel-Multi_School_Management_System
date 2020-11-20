<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fees
 * @package App\Models
 * @version December 15, 2019, 1:48 pm UTC
 *
 * @property integer course_id
 * @property integer level_id
 * @property integer semester_id
 * @property integer fee_structure_id
 * @property number amount
 */
class Fees extends Model
{
    use SoftDeletes;

    public $table = 'fees';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'course_id',
        'level_id',
        'semester_id',
        'fee_structure_id',
        'amount',
        'school_id',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
        'level_id' => 'integer',
        'semester_id' => 'integer',
        'fee_structure_id' => 'integer',
        'amount' => 'float',
        'school_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_id' => 'required',
        'level_id' => 'required',
        'semester_id' => 'required',
        'fee_structure_id' => 'required',
        'amount' => 'required'
    ];

    
}
