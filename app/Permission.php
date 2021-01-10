<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Permission extends Model
{
    // use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    // protected $dates = ['deleted_at'];

    Protected $table = 'permission';

    Protected $fillable = ['permission_name', 'permission_group','permission_type', 'permission', 'school_id'];
    // Protected $fillable = ['permission', 'role_id'];


    // protected $casts = [
    //     'permission' => 'array'
    // ];


    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function get_permission_by_role()
    {
         $user = Auth::user();
        $permissions = Permission::count();
        if($permissions>0){
            $permissions = Permission::where('permission_group',strtolower($user->group))->where('permission_type','yes')->get();
        }else{
            $permissions =array(); 
        }
       return $permissions ;
    }
}
