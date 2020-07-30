<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SalaryType
 * @package App\Models
 * @version December 15, 2019, 1:50 pm UTC
 *
 * @property string salary_type
 */
class SalaryType extends Model
{
    use SoftDeletes;

    public $table = 'salary_types';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'salary_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'salary_type_id' => 'integer',
        'salary_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'salary_type' => 'required'
    ];

    
}
