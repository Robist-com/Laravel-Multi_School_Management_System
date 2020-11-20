<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books';
    protected $fillable = ['school_id', 'book_title','book_number','isbn_number', 'publish', 'author','subject', 
    'rac_number', 'book_qty','book_price','post_date','description','user_id'];
}
