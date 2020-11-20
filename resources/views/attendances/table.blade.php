<!-- @include('table_style') -->

@php 
if(isset($class_id)){

}else{
 $class_id ='';
}
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
<div class="clearfix"></div>
<div class="row">

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <div class="col-md-2">
          <label for="">Date <b style="color:red">*</b></label>
          <input type="text" name="attendance_date"  id="attendance_date" class="form-control" value="<?php echo date('d-m-Y')?>" disabled >
        </div>
        <div class="row "> 
        @if(auth()->user()->group == "Admin")
        <div class="col-md-3">
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
        <div class="col-md-3">
        <label for="">Grade <b style="color:red">*</b></label>
        <select class="form-control select_2_single " name="semester_id" id="grade_id">
        <option value="">Select Grade</option>
            @foreach(App\Models\Semester::where('school_id', auth()->user()->school->id)->get() as $grade)
            <option value="{{$grade->id}}">{{$grade->semester_name}}</option>
            @endforeach
        </select>
        <div class="col-md-2"><span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span></div>
        </div>
        <div class="col-md-3">
        <label for="">Class <b style="color:red">*</b></label>
        <select class="form-control select_2_single " name="class" id="class_id">
        <option value="">Select Class</option>
            @foreach($classes as $class)
            <option value="{{$class->class_code}}">{{$class->class_name}}</option>
            @endforeach
        </select>
        </div>
        </div>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

      <div class="panel-body">
      <div  id="wait"><i class="fa fa-spinner fa-3x fa-spin"></i></div>
      <div class="form-group ">

                </div>
              </div>
              @if($students != '') 

              <form action="{{url('MarkClassAttendance')}}" method="post">
                @csrf
                <!-- <button type="submit" name="submit" class="btn btn-dark btn-round pull-right addAttendance" style="display: none;"><span
                    class="glyphicon glyphicon-pencil"> Mark-Attendance</button> -->
                    @include('attendances.mark_attendance')
                    <button type="submit" name="submit" class="btn btn-dark btn-round pull-right" id="addAttendance2" style="display: none;"><span
                    class="glyphicon glyphicon-pencil"> Mark-Attendance</button>
              
              </form>
              @endif 
          </div>
          </div>
          </div>
          </div>

          @if($attendances == $date)
          <div class="panel  panel-default"> 
          <div class="panel-heading">
          <h3 style="font-weight:bold;text-transform: uppercase; text-align:left">
           <i class="fa fa-calendar"></i> today' <sup>s</sup> attendance<b style="color:red">  Already Taken</b>
          </h3>
          </div>
          <div class="panel-body">
          <div class="table-responsive">

    <!-- <table class="table table-striped table-bordered table-hover" id="student"> -->
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th align="center">Roll No.</th>
                <th align="center">Student Name</th>
                <th align="center">Present</th>
                <th align="center">Absent</th>
                <th align="center">Late</th>
                <th align="center">Sick</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($attendances as $key => $item)
            <tr>
            <td><img src="{{asset('student_images/'.$item->image)}}" alt=""
                class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
            <td>{{$item->roll_no}}</td>
            <td>{{$item->student_first_name ." ". $item->student_last_name}}</td>
            <td> @if ($item->attendance_status == 'present')
                  <div style="background-color:#27AE60;color:#fff;">Present</div>
                 @elseif ($item->attendance_status == 'absent')
                 <div style="background-color:#E74C3C;color:#fff;">Absent</div>
                 @elseif ($item->attendance_status == 'late')
                 <div style="background-color:#3498DB;color:#fff;">Late</div>
                 @else
                 <div style="background-color:#A569BD;color:#fff;">Sick</div>

                
            @endif</td>
            <td> {{$item->class_name}}</td>
            <td> {{$item->course_name}}</td>
            <td> {{$item->teacher_first_name ." ". $item->teacher_last_name}}</td>
            <td> {{$item->attendance_date}}</td>
            <td>
              {{-- <a href=""><button class="btn btn-info"></button></a></td> --}}
            </tr>
            @endforeach
           

        </tbody>
    </table>
</div>

@endif
          <!-- </div> -->

       