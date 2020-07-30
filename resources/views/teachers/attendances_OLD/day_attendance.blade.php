@include('attendances.style')

@php
   $date = date('d-m-Y');

   $monthly = date('F', strtotime($date));
   $year = date('Y', strtotime($date));
   $day = date('l', strtotime($date));
@endphp


@php
if(isset($class_id)){

}else{
 $class_id ='';
}
 @endphp


  <!-- Modal -->
  <div class="modal fade" id="markAttendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered "style="width:90%"  role="document">
      <div class="modal-content">
        <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          <h5 class="modal-title" id="exampleModalLongTitle">Class Attendance Report</h5>
        </div>
        <div class="modal-body">

          <div class="panel  panel-default">

            <div class="panel-heading">
              <div class="col-md-2 pull-right">
                <b style="font-weight:bolder;">  Date: </b>
                <input type="text" name="attendance_date"  id="attendance_date" class="form-control" value="<?php echo date('d-m-Y')?>" disabled >
              </div>
              <div class="col-md-3 pull-right">
                <?php
                    $date = date('d-m-Y');
                $nameOfDay = date('l', strtotime($date));
                echo "<h4 style='color:red; font-weight:bolder;text-transform:uppercase'>$nameOfDay   <b style='color:black'>Attendance</b></h4>  ";
                ?>
              </div>
              <h3 style="font-weight:bold;text-transform: uppercase; text-align:left">
                <i class="fa fa-calendar"></i> GENERATE CLASS<b style="color:red">  ATTENDANCE</b>
               </h3>
              </div>


              <div class="panel-body">
              <div  id="wait"></div>
              <div class="form-group ">

              <form action="{{url("get-class-attendance")}}" method="get">
                    <!-- Level Id Field -->

                          <div class="form-group col-sm-2 pull-right">
                            <select class="form-control select_2_single " name="course_id" id="course_id1">
                            <option value="">Select Course</option>
                                @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="form-group col-sm-2 pull-right">
                              <select class="form-control select_2_single " name="class_id" id="class_id1">
                              <option value="">Select Class</option>
                                  @foreach($classes as $class)
                                  <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                                  @endforeach
                              </select>
                              </div>

                            <div class="form-group col-sm-3 pull-right">
                              <select class="form-control select_2_single " name="department_id" id="department_id1">
                               <option value="">Select Department</option>
                                   @foreach($departments as $department)
                                  <option value="{{$department->department_id}}">{{$department->department_name}}</option>
                                  @endforeach
                              </select>
                              </div>

                            <div class="form-group col-sm-3 pull-right">
                              <select class="form-control select_2_single " name="faculty_id" id="faculty_id1">
                              <option value="">Select Faculty</option>
                              @foreach($faculties as $faculty)
                              <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                              @endforeach
                              </select>
                              </div>

                            <div class="form-group col-sm-2 pull-right">
                              <select class="form-control select_2_single " name="semester_id" id="semester_id1">
                               <option value="">Select Semester</option>
                                  @foreach($semesters as $semester)
                                  <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                                  @endforeach
                              </select>
                              </div>
                              @isset($class_name)
                              <input type="hidden" name="teacher_id" value="{{$class_name->teacher_id}}">

                              @endisset

                      </div>
                    </div>
                  </div>
       </div>
   <div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  <button type="submit" class="btn bg-navy"><i class="fa fa-search"></i> Mark-Attendance</button>
</div>
</form>
</div>
</div>
</div>





