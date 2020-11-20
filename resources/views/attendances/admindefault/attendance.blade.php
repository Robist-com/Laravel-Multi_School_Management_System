
<style>
    .btn-block{
        height:28px;
        text-emphasis: center;
        text-anchor: top;
    }
</style>

@php
    $date = date('d-m-Y');
@endphp

<div class="row">
                       <form action="{{route('attendances.index')}}" method="GET">
                           <!-- @csrf -->

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
                        <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                        @endif

                        <div class="col-md-4">
                            <label for="">Grade <b style="color:red">*</b></label>
                        <select name="grade_id" id="grade_id" class="form-control">
                            <option value="">Select</option>
                            @foreach(App\Models\Semester::where('school_id', auth()->user()->school->id)->get() as $grade)
                            <option value="{{$grade->id}}">{{$grade->semester_name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-4">
                        <label for="">Class <b></b></label>
                        <select name="class_id" id="class_id" class="form-control" onchange="getData(this);">
                            <option value="" selected="true">Select</option>
                            @foreach ($classes as $class)
                            <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="col-md-4">
                        <label for="">Date <b></b></label>
                        <input type="search" name="attendance_date" id="attendance_date" class="form-control" placeholder="Date" autocomplete="off" />
                        </div>
                           
                        <div class=" pull-right " style="margin-top:10px" >
                        <button type="submit" class="btn btn-dark btn-round"><i class="fa fa-search"></i>search</button>
                        </div>

                        </form>
                    </div>
                    <hr>

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        @if($attendances->where('attendance_date', $date))                        
        @foreach ($attendances as $key => $item)
        <tr>
            <td><img src="{{asset('student_images/'.$item->image)}}" alt=""
                class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
            <td>{{$item->roll_no}}</td>
            <td>{{$item->student_first_name ." ". $item->student_last_name}}</td>
            <td> 
                @if ($item->attendance_status == 'present')
                <div style="background-color:#27AE60;color:#fff;">Present</div>
               @elseif ($item->attendance_status == 'absent')
               <div style="background-color:#E74C3C;color:#fff;">Absent</div>
               @elseif ($item->attendance_status == 'late')
               <div style="background-color:#3498DB;color:#fff;">Late</div>
               @else
               <div style="background-color:#A569BD;color:#fff;">Sick</div>
                @endif
            </td>
            <td> {{$item->class_name}}</td>
            <td> {{$item->course_name}}</td>
            <td> {{$item->teacher_first_name ." ". $item->teacher_last_name}}</td>
            <td> {{$item->attendance_date}}</td>
            <td colspan="3"> 
            <a href="{!! url('/edit/attendance/'.$item->attendance_date) !!}" class="btn btn-round btn-dark fa fa-edit" data-toggle="tooltip" data-placement="left" title="Edit attendance"></a>
            </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="10"> 
                    <h1 align='center' class=' alert alert-danger'>No Attendance Found Under This Date!, Please Try Another Date.</h1>
                </td>
            </tr>
            @endif

        </tbody>
    </table>
    @include('flash::message')

@include('attendances.attendance_report.report_list')

@section('scripts')
<script type="text/javascript">
   $('#attendance_date').datetimepicker({
                        format: 'DD-MM-YYYY',
                        // format: 'YYYY-MM-DD',
                        useCurrent: false
                        // autoCompelete: false
                    });

    $('#attendance_date').on('clcik',function(){
        alert(1)
    });

    $("#class_id").on('change', function(){
        alert(1)
		var classid = $("#class_id").val();
		var school_id = $("#school_id").val();
    if($('#class_id').val() == '')
    {
      $('#addAttendance').hide();
    }else
    {
      $('#addAttendance').show();

      }

		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '{{ route ("attendances.index")}}',
			data: {'class_id': classid, 'school_id':school_id},

            beforeSend: function(){
                $('#wait').css("visibility", "visible");
            },
            
                success:function(data){
                    console.log(data);
                        $("#datatable-responsive1").html(data);

                if (data == '') {
                    // $("#addAttendance2").hide();
                    // $("#addAttendance1").hide();
                    $(".addAttendance").css("display", "none");
                    $(".addAttendance").prop("disabled", true);
                    $("#addAttendance2").css("display", "none");
                }
                else{
                    // $("#addAttendance2").show();
                    // $("#addAttendance1").show();
                    $(".addAttendance").css("display", "block");
                    $("#addAttendance2").css("display", "block");

            }
                    
			},
            complete: function(){
                  $('#wait').css("visibility", "hidden");
              }
		});
	});
</script>
@endsection