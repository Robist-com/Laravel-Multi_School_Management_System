<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FeeStructure
 * @package App\Models
 * @version December 15, 2019, 11:23 pm UTC
 *
 * @property integer semester_id
 * @property number admissionFee
 * @property number monthlyFee
 * @property number courseFee
 * @property number securityDeporcite
 * @property number miscellaneous_charges
 */
class FeeStructure extends Model
{
    use SoftDeletes;

    public $table = 'fee_structures';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'semester_id',
        'degree_id',
        'faculty_id',
        'department_id',
        'admissionFee',
        'semesterFee',
        'fee_type',
        'total_amount'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'semester_id' => 'integer',
        'degree_id'=> 'integer',
        'faculty_id'=> 'integer',
        'department_id'=> 'integer',
        'admissionFee' => 'float',
        'semesterFee' => 'float',
        'fee_type' => 'string',
        'total_amount' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'semester_id' => 'required',
        'degree_id'=> 'required',
        'faculty_id'=> 'required',
        'department_id'=> 'required',
        // 'admissionFee' => 'required',
        'semesterFee' => 'required',
        'fee_type' => 'required'

    ];

    
}
