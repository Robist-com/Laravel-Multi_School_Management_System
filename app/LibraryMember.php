<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryMember extends Model
{
    protected $table = 'library_members';
    protected $fillable = ['school_id', 'user_id','status','student_id', 'library_card', 'join_date','roll_no'];
}
