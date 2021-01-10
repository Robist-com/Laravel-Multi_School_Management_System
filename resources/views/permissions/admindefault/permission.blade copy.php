@extends('layouts.new-layouts.app')

@section('content')

{{-- <h1>hello</h1> --}}


<style>
#datatable-buttons thead,
#datatable-buttons th {text-align: center;}
.toggle{text-align: center;}
</style>

<?php 
/*$permission_fields = array(
  'Student view',
  'Student Update',
  'Student Delete',
  'Add Student Attendance',
  'View Student Attendance',
  'View Student Monthly Reports',
  'Add Marks',
  'View Marks',
  'Delete Marks',
  'Generate Result',
  'Search Result',
  'promote Student',
  'Add Fess',
  'View Fess',
  'Delete Fess',
  'View Fess Report',
  'View Result Reports',
  'View Attendance Reports',
  'View Sms/voice log Reports',
  //'View Student Monthly Reports',
  'Class View',
  'Class Add',
  'Class update',
  'Class delete',
  'Sections view',
  'Section add',
  'Section update',
  'Section View',
  'Teacher View',
  'Teacher Add',
  'Teacher update',
  'Teacher delete',
  'Teacher timetable add',
  'Teacher timetable view',
  'Send Sms/Voice',
  'Setting GPA Rule view',
  'GPA Rule add',
  'GPA Rule update',
  'GPA Rule delete',
  'holidays add',
  'holidays view',
  'holidays delete',
  'Class off view',
  'Class off add',
  'Class off delete',
  'Institute information add',
  'Grade system (auto,manual)',

  );*/
$permission_fields = array(
          'Student View',
          'Student Add',
          'Student Update',
          'Student Delete',
          'Student Info',
          'Student Student Portal Access',
          'Student Student Bulk Add',
          'Family',
          'Add Student Attendance',
          'View Student Attendance',
          'View Student Monthly Reports',
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
           
          /*'Accounting',*/
        );

?>
<div class="page-title">


              <div class="title_left">
                <h3>Permissions</h3>
              </div>
              
               

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" name="roll_no1" id="roll_no1" placeholder="Search by...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" name="filter1" id="filter1" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title ">
                    <h2 style="font-weight:bold">Permissions</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  @include('flash::message')
                @include('adminlte-templates::common.errors')

                  <form role="form" >
                      <button class="btn btn-dark btn-round pull-right"  type="submit"><i class="glyphicon glyphicon-th"></i> Get List</button>
              
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" @if(request('admin')) checked @endif  name="admin"  data-toggle="toggle" data-on="Check Admin" data-off="Uncheck Admin" data-onstyle="info" data-offstyle="warning">
                                    </div>
                                    </div>
                                     
                                    <div class="col-md-2">
                                        <div class="form-group">
                                                 <input type="checkbox" @if(request('teacher')) checked @endif  name="teacher" data-toggle="toggle" data-on="Check Teacher" data-off="Uncheck Teacher" data-onstyle="info" data-offstyle="warning">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                                 <input type="checkbox" @if(request('student')) checked @endif  name="student" data-toggle="toggle" data-on="Check Student" data-off="Uncheck Student" data-onstyle="info" data-offstyle="warning">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                                 <input type="checkbox" @if(request('parent')) checked @endif  name="parent" data-toggle="toggle" data-on="Check Parent" data-off="Uncheck Parent" data-onstyle="info" data-offstyle="warning">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                                 <input type="checkbox" @if(request('accountant')) checked @endif  name="accountant" data-toggle="toggle" data-on="Check Accountant" data-off="Uncheck Accountant" data-onstyle="info" data-offstyle="warning">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                                 <input type="checkbox" @if(request('school_owner')) checked @endif  name="school_owner" data-toggle="toggle" data-on="Check School Owner" data-off="Uncheck School Owner" data-onstyle="info" data-offstyle="warning">
                                        </div>
                                    </div>
                                    
                                <!-- </div>
                            </div> -->

                            <div class="row">
                                <div class="col-md-12">
                                   

                                </div>
                            </div>
                            <br>
                        </form>
                        
                        </div>
                            </div>
                                </div>
                            </div>
            <div class="page-title">
              <div class="title_left">
                <h3>Select Creterials</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title ">
                    <h2 style="font-weight:bold">Permissions</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  @if(request('admin') || request('teacher') || request('student') || request('parent') || request('accountant')  || request('school_owner'))
                  <div class="x_content ">
                  @else
                  <div class="x_content collapse">
                  @endif
            <div id="user-permissions">
            <form role="form" action="{{route('permissions.store')}}" method="post" enctype="multipart/form-data">
                   
           <button class="btn btn-dark btn-round pull-right" id="btnsave" type="submit"><i class="glyphicon glyphicon-plus"></i>Save Permission</button>
                   
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <table style="width:100%" id="permissione" class="table responsive table-bordered">
            <!-- <table id="datatable-buttons" class="table table-striped table-bordered"> -->

            <thead>
    <tr>
      <!-- {{$admin}}==={{$teacherd}} -->
      <th>Permissions</th>
     @if($admin=="yes")
     <th>
     <div class="toggle">Admin</div>
     <input type="checkbox"  data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"  id="checkAll">
     </th>
     @endif
     @if($teacherd=="yes")
      <th> 
      <div class="toggle">Teachers</div>
      <input type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"  id="checkAll1"></th>
      @endif
      @if($studentss=="yes")
      <th> 
      <div class="toggle">Students</div>
      <input type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"   id="checkAll2"></th>
      @endif
       @if($accountant=="yes")
      <th> 
      <div class="toggle">Accuntant</div>
      <input type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"  id="checkAll3"></th>
      @endif 
      @if($owner=="yes")
      <th> 
      <div class="toggle">School</div>
      <input type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"  id="checkAll4"></th>
      @endif 
    </tr>
  </thead>
   <tbody>
   <?php 
      $i       = 0 ;
      $student = count($permission_fields);
      
     /*if($studentss=="yes"){
      
        }
       else{
        $teacher =  $student  + count($permission_fields);
        }*/

      $teacher  =   $student  + count($permission_fields);
       $accounnt  =   $teacher  + count($permission_fields);
       $school_owner  =   $accounnt  + count($permission_fields);
      //echo $teacher + $student;

     // echo "<pre>";print_r($permissions->toArray());
       //echo $studentss;
   ?>
    @foreach($permission_fields as $permission_field)

    <?php $field_name = str_replace(" ","_",strtolower($permission_field)); 
    ?>

    @if($permissions)

    <tr>

      <td width="50">{{$permission_field}}</td>
      
      @if($permissions[$i]->permission_group=='admin')
      @if($admin=="yes")
      <td width="50">
        <div class="btn-group btn-toggle">
            <input class="cb-element chb admins" data-toggle="toggle" id="admin_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="admin[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox"  @if($permissions[$i]->permission_type=='yes') checked @endif  >                                            
        </div>
      </td>
      @endif
      @endif
      
       @if($permissions[$teacher]->permission_group=='teacher')
       @if($teacherd=="yes")
        <td width="50">
          <div class="btn-group btn-toggle">
            <input class="cb-element1 chb" data-toggle="toggle" id="teacher_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="teacher[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox"   @if($permissions[$teacher]->permission_type=='yes') checked @endif >                                            
          </div>

          </div>
        </td>
      @endif
      @endif
      
       @if($permissions[$student]->permission_group=='student')
       @if($studentss=="yes")
      <td width="50">
        <div class="btn-group btn-toggle">
          <input class="cb-element2 chb" data-toggle="toggle" id="student_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="student[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox" @if($permissions[$student]->permission_type=='yes') checked @endif >                                            
        </div>
      </td>
      @endif
      @endif
     
      @if($permissions[$accounnt]->permission_group=='accountant')
      @if($accountant=="yes")
     
      <td width="50">
        <div class="btn-group btn-toggle">
          <input class="cb-element3 chb" data-toggle="toggle" id="accutant_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="accutant[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox" @if($permissions[$accounnt]->permission_type=='yes') checked @endif >                                            
        </div>
      </td>
      @endif
      @endif

      @if($permissions[$school_owner]->permission_group=='owner')
      @if($owner=="yes")
     
      <td width="50">
        <div class="btn-group btn-toggle">
          <input class="cb-element4 chb" data-toggle="toggle" id="school_owner_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="school_owner[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox" @if($permissions[$school_owner]->permission_type=='yes') checked @endif >                                            
        </div>
      </td>
      @endif
      @endif

    </tr>
    <?php 
     $i++ ;
     $student++ ;
     $teacher++;
     $accounnt++;
     $school_owner++;
    ?>
   @else

    <tr>
      <td>{{$permission_field}}</td>
      @if($admin=="yes")
      <td>
        <div class="btn-group btn-toggle">
            <input class="cb-element chb" data-toggle="toggle" id="admin_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="admin[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox"  >                                            
        </div>
      </td>
      @endif
     @if($teacherd=="yes")
      <td>
        <div class="btn-group btn-toggle">
          <input class="cb-element1 chb" data-toggle="toggle" id="teacher_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="teacher[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox"    >                                            
        </div>

        </div>
      </td>
      @endif
      @if($studentss=="yes")
      <td>
        <div class="btn-group btn-toggle">
          <input class="cb-element2 chb" data-toggle="toggle" id="student_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="student[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox" >                                            
        </div>
      </td>
      @endif
      @if($accountant=="yes")
      <td>
        <div class="btn-group btn-toggle">
          <input class="cb-element3 chb" data-toggle="toggle" id="accutant_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="accutant[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox" >                                            
        </div>
      </td>
    </tr>
   @endif

   @if($owner=="yes")
      <td>
        <div class="btn-group btn-toggle">
          <input class="cb-element4 chb" data-toggle="toggle" id="school_owner_{{$field_name}}" data-on="Yes" data-off="No" data-width="100"   name="school_owner[{{$field_name}}]" data-onstyle="success" data-offstyle="danger" type="checkbox" >                                            
        </div>
      </td>
    </tr>
   @endif
   @endif
    @endforeach
    
  </tbody>
           
            </table>
            </div>
           
        <!--button save -->
        <div class="row">
         <div class="col-md-12">
           <button class="btn btn-dark btn-round pull-right" id="btnsave" type="submit"><i class="glyphicon glyphicon-plus"></i> Save Permission</button>
             
             </form>

            <div id="push"></div>
        
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

        <style>
        /* This only works with JavaScript, 
		   if it's not present, don't show loader */
		.no-js #loader { display: none;  }
		.js #loader { display: block; position: absolute; left: 100px; top: 0; }
        </style>

@stop
@section('scripts')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
$( document ).ready(function() {

  $('#permissione').DataTable();

  $("#checkAll").change(function () {
//   alert(34);
  //alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element").change(function () {
    _tot = $(".cb-element").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll").prop('checked',false);
    }
});

$("#checkAll1").change(function () {
  //alert(34);
  //alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element1").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element1").change(function () {
    _tot = $(".cb-element1").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element1:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll1").prop('checked',false);
    }
});

$("#checkAll2").change(function () {
  //alert(34);
  ///alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element2").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element2").change(function () {
    _tot = $(".cb-element2").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element2:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll2").prop('checked',false);
    }
});
$("#checkAll3").change(function () {
  //alert(34);
  ///alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element3").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element3").change(function () {
    _tot = $(".cb-element3").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element3:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll3").prop('checked',false);
    }
});


$("#checkAll4").change(function () {
  //alert(34);
  ///alert(JSON.stringify($("input:checkbox.cb-element").prop('checked', $(this).prop("checked"))));
    $("input:checkbox.cb-element4").prop('checked', $(this).prop("checked")).change();
});
$(".cb-element4").change(function () {
    _tot = $(".cb-element4").length 
    //alert(_tot);             
    _tot_checked = $(".cb-element4:checked").length;
    
    if(_tot != _tot_checked){
      $("#checkAll4").prop('checked',false);
    }
});

   //$('#timepicker1').timepicker();
    // $('#timepicker').timepicker({
    //     timeFormat: 'HH:mm:ss',
    // });

    //         $('#timepicker1').timepicker();
    
});

$("#adminchckwww").click(function(e) {
    // this function will get executed every time the #home element is clicked (or tab-spacebar changed)
    if($(this).is(":checked")) // "this" refers to the element that fired the event
    {
        alert('home is checked');
        /*$(':checkbox').each(function () {
          //$(this).removeAttr('checked');
          $('input[type="radio"]').prop('checked', false);

        })*/
        $('input:checkbox[name=admin]').each(function () { $(this).prop('checked', true); });
          
    }else{
      alert('home is unchecked');
      $('.admins').prop('checked', $(e.target).prop('checked'));

     // $("input:checkbox[name=admin]").prop('checked', $(this).prop("checked",false));
       //$('input:checkbox').removeAttr('checked');
      //$('input:checkbox[name=admin]').each(function () { alert($(this)); $(this).prop('checked', false); });
    }
});
</script>
@stop

