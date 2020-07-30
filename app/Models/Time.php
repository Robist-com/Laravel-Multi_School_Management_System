<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Time
 * @package App\Models
 * @version September 22, 2019, 6:34 pm UTC
 *
 * @property string time
 */
class Time extends Model
{
    use SoftDeletes;

    public $table = 'times';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $primaryKey = 'time_id';

    public $fillable = [
        'time',
        'shift_id',
        'status'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'time_id' => 'integer',
        'time' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'time' => 'required'
    ];
    public function class_schedulling()
    {
        return $this->hasMany('App\Models\Class_schedullings');
    }
    
}
