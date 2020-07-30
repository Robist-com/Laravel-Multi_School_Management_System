<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Shift
 * @package App\Models
 * @version September 22, 2019, 6:56 pm UTC
 *
 * @property string shift
 */
class Shift extends Model
{
    use SoftDeletes;

    public $table = 'shifts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'shift_id';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'shift',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'shift_id' => 'integer',
        'shift' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'shift' => 'required'
    ];

     public function class_schedulling()
    {
        return $this->belongsTo('App\Models\Class_schedullings');
    }
    
}
