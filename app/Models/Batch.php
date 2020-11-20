<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Batch
 * @package App\Models
 * @version September 18, 2019, 8:00 pm UTC
 *
 * @property integer year
 */
class Batch extends Model
{
    use SoftDeletes;

    public $table = 'batches';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'batch','is_current_batch', 'school_id','name'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'batch' => 'string',
        'name' => 'string',
        'is_current_batch' => 'integer',
        'school_id' => 'integer'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'batch' => 'required',
        'name' => 'required',
        'is_current_batch' => 'required'
    ];

    
}
