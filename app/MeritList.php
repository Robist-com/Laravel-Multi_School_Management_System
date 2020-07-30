<?php
namespace App;
class MeritList extends \Eloquent {
    protected $table = 'meritlist';

    protected $fillable = ['exam', 'roll_no','class','department_id','batch','grade','point','totalNo'];
}