<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Flash;
use DB;
class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('checkPermission::permission_add')->except('index','store','update');

        // $this->middleware('subscribed')->except('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1(Request $request)
    {
        // $permissions = Permission::all();
        // $roles = Role::all();
    //    return view('permissions.index', compact('roles','permissions'));
    //    return view('permissions.index', compact('roles','permissions'));
    }

    public function index(Request $request)
    {

        // $permission_all = Permission::all();
        // $permission_all =array(); 
        // $permission_all = array_values($permission_all->toArray());
        // dd($request->all());

        $permission_all =  DB::table('permission')
        ->orderBy('created_at', 'asc')
        ->get(); 
        // dd( $permission_all);

        $permissions = Permission::count();
        if($permissions>0){
            $permissions = Permission::get();
        }else{
            $permissions =array(); 
        }
        $admin='';
        $teacherd='';
        $studentss='';
        $accountant='';
        $owner ='';
        if($request->get('admin')){
          $admin="yes";
        }
        if($request->get('teacher')){
          $teacherd="yes";
        }
        if($request->get('student')){
          $studentss="yes";
        }
        if($request->get('accountant')){
          $accountant="yes";
        }

        if($request->get('school_owner')){
            $owner="yes";
          }
       return view('permissions.permission',compact('permission_all','permissions','admin','teacherd','studentss','accountant','owner'));
    }

    // public function get_permission(Request $request)
    // {
    //     # code...
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'permission' => 'required|max:255',
        //     'role_id' => 'required|unique:permissions',
        // ]);

        // $permission = Permission::create($request->all());

        $permission_fields = array(
            'Student View',
            'Student Add',
            'Student Update',
            'Student Delete',
            'Student Info',
            'Student Student Portal Access',
            'Student Student Bulk Add',
            
            'Add Student Attendance',
            'View Student Attendance',
            'View Student Monthly Reports',
            'Family',
            'Add Marks',
            'View Marks',
            'Delete Marks',
            'Generate Result',
            'Search Result',
            'promote Student',
            /*'Add Fess',
            'View Fess',
            'Update Fess',
            'Delete Fess',
            'View Fess Report',*/
            'View Result Reports',
            'View Attendance Reports',
            'View Sms/voice log Reports',
            //'View Student Monthly Reports',
            'Class View',
            'Class Add',
            'Class update',
            'Class delete',
            'Section View',
            'Section add',
            'Section update',
            'Section Delete',
            'Section Time Table',
            'Teacher View',
            'Teacher Add',
            'Teacher Bulk Add',
            'Teacher update',
            'Teacher delete',
            'Teacher timetable add',
            'Teacher timetable view',
            'Teacher Portal Access',
            'Send Sms/Voice',
            'Setting GPA Rule view',
            'GPA Rule add',
            'GPA Rule update',
            'GPA Rule delete',
            'GPA Rule View',
            'holidays add',
            'holidays view',
            'holidays delete',
            'Class off view',
            'Class off add',
            'Class off delete',
            'Institute information add',
            'Grade system (auto,manual)',
            'Subject View',
            'Subject Add',
            'Subject update',
            'Subject delete',
            'Exam View',
            'Exam Add',
            'Exam update',
            'Exam delete',
            'Gradesheet View',
            'Gradesheet Print',
            'Send Notification',
            'Paper View',
            'Paper Add',
            'Paper update',
            'Paper delete',

            //School Crud
            'School Add',
            'School update',
            'School View',
            'School delete',

            //Grade Crud
            'Grade Add',
            'Grade update',
            'Grade View',
            'Grade delete',

            //Level Crud
            'Level Add',
            'Level update',
            'Level View',
            'Level delete',

            //Day Crud
            'Day Add',
            'Day update',
            'Day View',
            'Day delete',

            //Shift Crud
            'Shift Add',
            'Shift update',
            'Shift View',
            'Shift delete',

            //Classroom Crud
            'Classroom Add',
            'Classroom update',
            'Classroom View',
            'Classroom delete',
            //'Accounting',
          );
     /* DB::table("permission")->delete();*/
        DB::table('permission')->truncate();
        foreach($permission_fields as $field){
          $permission_save = new Permission;
          $field_name = str_replace(" ","_",strtolower($field));
          $admin =$request->get('admin');
              if(!empty($request->get('admin')) && in_array($field_name, array_keys($request->get('admin')))){
                  $permission_save->permission_name  =  $field_name ;
                  $permission_save->permission_group =  'admin'     ;
                  $permission_save->permission_type  =  'yes'       ;  
                  $permission_save->save();
              }else{
                  $permission_save->permission_name  =  $field_name ;
                  $permission_save->permission_group =  'admin'     ;
                  $permission_save->permission_type  =  'no'       ;  
                  $permission_save->save();
              }
        }
        foreach($permission_fields as $field){
          $permission_save = new Permission;
          $field_name = str_replace(" ","_",strtolower($field));
          
              if(!empty($request->get('student')) && in_array($field_name, array_keys($request->get('student')))){
                  $permission_save->permission_name  =  $field_name ;
                  $permission_save->permission_group =  'student'     ;
                  $permission_save->permission_type  =  'yes'       ;  
                  $permission_save->save();
              }else{
                  $permission_save->permission_name  =  $field_name ;
                  $permission_save->permission_group =  'student'     ;
                  $permission_save->permission_type  =  'no'       ;  
                  $permission_save->save();
              }
        }
        foreach($permission_fields as $field){
          $permission_save = new Permission;
          $field_name = str_replace(" ","_",strtolower($field));
              if(!empty($request->get('teacher')) && in_array($field_name, array_keys($request->get('teacher')))){
                  $permission_save->permission_name  =  $field_name ;
                  $permission_save->permission_group =  'teacher'     ;
                  $permission_save->permission_type  =  'yes'       ;  
                  $permission_save->save();
              }else{
                  $permission_save->permission_name  =  $field_name ;
                  $permission_save->permission_group =  'teacher'     ;
                  $permission_save->permission_type  =  'no'       ;  
                  $permission_save->save();
              }
        }
  
        foreach($permission_fields as $field){
          $permission_save = new Permission;
          $field_name = str_replace(" ","_",strtolower($field));
              if(!empty($request->get('accutant')) && in_array($field_name, array_keys($request->get('accutant')))){
                  $permission_save->permission_name  =  $field_name ;
                  $permission_save->permission_group =  'accountant'     ;
                  $permission_save->permission_type  =  'yes'       ;  
                  $permission_save->save();
              }else{
                  $permission_save->permission_name  =  $field_name ;
                  $permission_save->permission_group =  'accountant'     ;
                  $permission_save->permission_type  =  'no'       ;  
                  $permission_save->save();
              }
        }

        foreach($permission_fields as $field){
            $permission_save = new Permission;
            $field_name = str_replace(" ","_",strtolower($field));
                if(!empty($request->get('school_owner')) && in_array($field_name, array_keys($request->get('school_owner')))){
                    $permission_save->permission_name  =  $field_name ;
                    $permission_save->permission_group =  'owner'     ;
                    $permission_save->permission_type  =  'yes'       ;  
                    $permission_save->save();
                }else{
                    $permission_save->permission_name  =  $field_name ;
                    $permission_save->permission_group =  'owner'     ;
                    $permission_save->permission_type  =  'no'       ;  
                    $permission_save->save();
                }
          }
                Flash::success("Permission Save Succesfully.");
                  return Redirect(route('permissions.index'));
  
      }
  

        // return redirect(route('roles.index'));
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $permissions = Permission::all();

        $roles = Role::all();
        return view('roles.index', compact('roles','permissions','permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'role_id' => 'required|unique:permissions,role_id,' .$permission->id,
            'permission' => 'required|max:255'
            
        ]);

        if (empty($permission)) {
            Flash::info('Permssion Not Found!');
            return redirect(route('roles.index'));
        }

        $permission->update($request->all());

        Flash::success('Permssion Updated Successfully!');
        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {

        // if (empty($permission)) {
        //     Flash::error('Permission not found');

        //     return redirect(route('permissions.index'));
        // }

            $permission->delete();

        Flash::success('Permssion Deleted Successfully!');
        return redirect(route('permissions.index'));
    }
}
