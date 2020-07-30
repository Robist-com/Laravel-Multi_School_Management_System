<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $table = "invoice_details";
    public $fillable = [
        'invoice_id',
        'student_id',
        'transaction_id',
        'student_fee_id'
    ];
}
