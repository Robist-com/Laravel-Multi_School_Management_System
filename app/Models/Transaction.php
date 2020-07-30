<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 * @package App\Models
 * @version October 1, 2019, 3:15 am UTC
 *
 * @property integer student_id
 * @property integer fee_id
 * @property integer user_id
 * @property number paid amount
 * @property string remark
 * @property string describtion
 * @property string status
 * @property string transaction_date
 */
class Transaction extends Model
{
    use SoftDeletes;

    public $table = 'transactions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = "transaction_id";

    public $fillable = [
        'student_id',
        'fee_id',
        'user_id',
        'paid_amount',
        'remark',
        'description',
        'status',
        'semester_fee_id',
        'balance',
        'transaction_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'transaction_id' => 'integer',
        'student_id' => 'integer',
        'fee_id' => 'integer',
        'user_id' => 'integer',
        'paid_amount' => 'string',
        'remark' => 'string',
        'description' => 'string',
        'status' => 'string',
        'semester_fee_id',
        'balance' => 'string',
        'transaction_date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required',
        'fee_id' => 'required',
        'user_id' => 'required',
        'paid_amount' => 'required',
        'status' => 'required',
        'semester_fee_id'=> 'required',
        'transaction_date' => 'required'
    ];

    
}
