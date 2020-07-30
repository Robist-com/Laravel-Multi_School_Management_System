<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = ['id'];
    public $timestamps = false;

public static function autoNumber()
{
    $id = 0;
    $ReceiptID = Invoice::max('id');
    if ($ReceiptID != 0) {
        $id = $ReceiptID + 1;
        Invoice::insert(['id' => $id]);
    } else {
        $id = 1;
        Invoice::insert(['id' => $id]);
    }

    return $id;
}
}
