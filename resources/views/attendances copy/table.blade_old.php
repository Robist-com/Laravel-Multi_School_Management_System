@include('table_style')

@php 
if(isset($class_id)){

}else{
 $class_id ='';
}
 @endphp

<!-- <div class="panel  panel-default">  -->
                    
    <div class="panel-heading">
      <h3><a href="{{route('attendances.index')}}"><button class="pull-right" style="margin-left:300px;margin-bottom:50px" title="Back to Attendance List">Back</button></a></h3>
      <h3 style="font-weight:bold;text-transform: uppercase; text-align:left">
       <i class="fa fa-calendar"></i> GENERATE CLASS<b style="color:red">  ATTENDANCE</b>
      </h3>
      </div>
      <div class="panel-body">
      <div  id="wait"></div>
      <div class="form-group ">

        <div class="col-md-6">
          <?php
              $date = date('d-m-Y');
          $nameOfDay = date('l', strtotime($date));
          echo "<h4 style='color:red; font-weight:bolder;text-transform:uppercase'>$nameOfDay   <b style='color:black'>Attendance</b></h4>  ";
          ?>
      {{-- <hr class="line"> --}}

        </div>
        <div class="col-md-2">
                <b style="font-weight:bolder;">  Date: </b> 
                <input type="text" name="attendance_date"  id="attendance_date" class="form-control" value="<?php echo date('d-m-Y')?>" disabled >
              </div>
             
                </div>

            <!-- Level Id Field -->
            <div class="form-group col-sm-2 pull-right">
                <select class="form-control select_2_single " name="class" id="class">
                <option value="">Select Class</option>
                    @foreach($classes as $class)
                    <option value="{{$class->id}}">{{$class->class_name}}</option>
                    @endforeach
                </select>
                </div>
              </div>
              {{-- @if($attendances != $date) --}}

              <form action="{{url('MarkClassAttendance')}}" method="post">
                @csrf
                    @include('attendances.mark_attendance')

                   {{-- @if($class_id != "") --}}
                   <button type="submit" name="submit" class="btn  bg-navy pull-right" id="addAttendance"><span
                    class="glyphicon glyphicon-pencil"> Mark-Attendance</button>
                   {{-- @else --}}
                   
                    {{-- @endif --}}
              
              </form>

        
          </div>
        
          {{-- @endif --}}

          @if($attendances != $date)
          <div class="panel  panel-default"> 
          <div class="panel-heading">
          <h3 style="font-weight:bold;text-transform: uppercase; text-align:left">
           <i class="fa fa-calendar"></i> today' <sup>s</sup> attendance<b style="color:red">  Already Taken</b>
          </h3>
          </div>
          <div class="panel-body">
          <div class="table-responsive">

    <table class="table table-striped table-bordered table-hover" id="student">
        <thead>
            <tr>
                <th></th>
                <th>Roll No.</th>
                <th>Student Name</th>
                <th>Status</th>
                <th>Class</th>
                <th>Course</th>
                <th>Teacher</th>
                <th>Date</th>
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
 {{-- </div> --}}
</div>
{{-- </div> --}}
@endif
          <!-- </div> -->

        @section('scripts');
  <script>
  $(document).ready(function(){
    if($('#class').val() == '')
    {
      $('#addAttendance').hide();
    }else
    {
      $('#addAttendance').show();

      }
  })  
            
    $("#class").on('change', function(){
		var classid = $("#class").val();
    if($('#class').val() == '')
    {
      $('#addAttendance').hide();
    }else
    {
      $('#addAttendance').show();

      }

		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '{{ url ('/get/attendance/class')}}',
			data: {'class_id': classid},
            
			success:function(data){
				console.log(data);
					$("#student").html(data);
                    
			}
		});
	});

  $('#attendance_date').datetimepicker({
                        format: 'DD-MM-YYYY',
                        useCurrent: false
                        // autoCompelete: false
     });

     function attendance_date(val) {
    document.getElementById('attendance_date1').value = val;

  }
            </script>
    @endsection