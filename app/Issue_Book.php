<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue_Book extends Model
{
    protected $table = 'issue_book';
    protected $fillable = ['issue_book', 'due_return_date','student_id', 'school_id', 'user_id', 'return_date', 'book_id'];
}
