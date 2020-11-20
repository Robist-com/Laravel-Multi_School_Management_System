@include('attendances.style')
<!-- @include('table_style')    -->
    @php
       $date = date('d-m-Y');
    @endphp

    <style>
   #attendance_date{
     background-color: #fff !important;
     border: 1px solid #fff !important;
   }
   /* #addAttendance1{
   visibility:hidden;
   }
   #addAttendance2{
   visibility:hidden;
   } */
 </style>
 <div class="page-title">

<div class="title_right1">
  <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-right top_search">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
    </div>
  </div>
</div>
</div>
<?php
  $date = date('d-m-Y');
$nameOfDay = date('l', strtotime($date));
echo "<h4 style='color:red; font-weight:bolder;text-transform:uppercase'>$nameOfDay   <b style='color:black'>Attendance</b></h4>  ";
?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <!-- <div class="x_title">
        <div class="row "> 
        
        </div> -->
      <!-- <div class="clearfix"></div>
    </div> -->
    <div class="x_content">

            <h3><a href="{{route('attendances.index')}}" class="btn btn-dark btn-round btn-sm pull-right" style="margin-left:300px;margin-bottom:50px" title="Back to Attendance List">back</a></h3>
  
            <form action="{{url('update_attendance')}}" method="post">
                @csrf

                <div  id="wait"></div>
                <div class="form-group ">
                    {{-- {{$date}} --}}
                  <div class="col-md-6">
                  <h3 style="font-weight:bold;text-transform: uppercase; text-align:left">
             <i class="fa fa-calendar"></i> Update CLASS<b style="color:red">  ATTENDANCE</b>
            </h3>

            </div>
            <div class="col-md-2">
                <b style="font-weight:bolder;">  Date: </b> 
                <input type="text" name="attendance_date"  id="attendance_date" class="form-control" value="{{ $date}}" disabled >
            </div>
            </div>
    
                @if(auth()->user()->group == "Admin")
            <div class="col-md-12">
                <label for="">School <b style="color:red">*</b></label>
            <select name="school_id" id="school_id" class="form-control">
                <option value="">Select</option>
                @foreach(auth()->user()->school->all() as $school)
                <option value="{{$school->id}}" @if(isset($classstudentreport_single)){{$school->id == $classstudentreport_single->school_id ? 'selected' : '' }} @endif>{{$school->name}}</option>
                @endforeach
            </select>
            </div>
            @else
            <input type="hidden" name="school_id" id="school_id1" value="{{auth()->user()->school->id}}">
            @endif
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>Roll No.</th>
                    <th>Student Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Late</th>
                    <th>Sick</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($edit_attendances as $key => $item)
                <tr>
                <td>{{$item->roll_no}}
                <input type="hidden" id="roll_no" name="roll_no" value="{{$item->roll_no}}">
                <input type="hidden" name="teacher_id" id="teacher_id" value="{{$item->teacher_id}}">
                <input type="hidden" name="class_id" id="class_id" value="{{$item->class_id}}">
                <input type="hidden" name="course_id" id="course_id" value="{{$item->course_id}}">
                <input type="hidden" name="attendance_date" id="attendance_date" value="{{$date}}">
                <input type="hidden" name="edit_date" id="edit_date" value="{{$date}}">

                </td>
                <td>
                <input class="atten" type="hidden" name="attendance_id[]" id="attendance_id" value="
                {{$item->attendance_id}}" class="form-control"
                style="border:none;" readonly>    
                <label for=""> {{$item->student_first_name }} {{$item->student_last_name}}</label>                                        
                </td>
                <td align="center">
                <div id="ck-button-present">
                <label>
                <input style="cursor:pointer;" class="atten" type="radio"id="attendance_status" name="attendance_status[{{$item->attendance_id}}]" value="present" 
                @if ($item->attendance_status == "present")
                checked
               @endif />
                <span>Present</span>
                </label>
                </div>
                </td>
    
                <td align="center">
                <div id="ck-button-absent">
                <label>
                <input class="atten" type="radio"id="attendance_status" name="attendance_status[{{$item->attendance_id}}]" value="absent"
                 @if ($item->attendance_status == "absent")
                 checked
                @endif />
                <span>Absent</span>
                </label>
                </div>
                </td>
    
                <td align="center">
                <div id="ck-button-late">
                <label>
                <input class="atten" type="radio"id="attendance_status" name="attendance_status[{{$item->attendance_id}}]" value="late" 
                @if ($item->attendance_status == "late")
                 checked
                @endif />
                <span>Late</span>
                </label>
                </div>
                </td>
    
                <td align="center">
                <div id="ck-button-sick">
                <label>
                <input class="atten" type="radio"id="attendance_status" name="attendance_status[{{$item->attendance_id}}]" value="sick" 
                @if ($item->attendance_status == "sick")
                checked
               @endif />
                <span>Sick</span>
                </label>
                </div>
                </td>
                
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn btn-dark btn-round "><i class="fa fa-refresh"></i> Update Attendance</button>
    </div>
    </form>
    </div> </div> </div>


    