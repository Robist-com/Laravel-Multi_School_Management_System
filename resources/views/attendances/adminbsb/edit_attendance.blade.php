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

   <?php
  $date = date('d-m-Y');
$nameOfDay = date('l', strtotime($date));
echo "<h4 style='color:red; font-weight:bolder;text-transform:uppercase'>$nameOfDay   <b style='color:black'>Attendance</b></h4>  ";
?>
   /* #addAttendance1{
   visibility:hidden;
   }
   #addAttendance2{
   visibility:hidden;
   } */
 </style>
 <style>
.btn-block {
    height: 28px;
    text-emphasis: center;
    text-anchor: top;
  }
    .dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}

</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>EDIT ATTENDANCE </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <!-- <a href="{{route('batches.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a> -->
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                <h3 style="font-weight:bold;text-transform: uppercase; text-align:left">
             <i class="fa fa-calendar"></i> Update CLASS<b style="color:red">  ATTENDANCE</b>
            </h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">

            <!-- <h3><a href="{{route('attendances.index')}}" class="btn btn-dark btn-round btn-sm pull-right" style="margin-left:300px;margin-bottom:50px" title="Back to Attendance List">back</a></h3> -->
  
            <form action="{{url('update_attendance')}}" method="post">
                @csrf

                <div  id="wait"></div>
                <div class="form-group ">
               
            <div class="col-md-2 pull-left">
                <b style="font-weight:bolder;">  Date: </b> 
                <div class="form-line">
                <input type="text" name="attendance_date"  id="attendance_date" class="form-control" value="{{ $date}}" disabled >
            </div>
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
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive js-exportable">
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
    <button type="submit" class="btn bg-teal btn-round "><i class="fa fa-refresh"></i> Update Attendance</button>
    </div>
    </form>
    </div> </div> </div>


    