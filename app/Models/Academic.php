<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Academic
 * @package App\Models
 * @version October 25, 2019, 3:27 pm UTC
 *
 */
class Academic extends Model
{
    use SoftDeletes;

    public $table = 'academics';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'academic_id';

    public $fillable = [
        'academic_year',
        'status'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'academic_id' => 'integer', 
        'academic_year' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'academic_year' => 'required'
    ];

    
}
