@include('attendances.style')

@php
   $date = date('Y-m-d');

   $monthly = date('F', strtotime($date));
   $year = date('Y', strtotime($date));
   $day = date('l', strtotime($date));
@endphp
@if (isset($students))

    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable-responsive" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th style="text-align: center;">Roll No.</th>
                <th style="text-align: center;">Student Name</th>
                <th style="text-align: center;">Present</th>
                <th style="text-align: center;">Absent</th>
                <th style="text-align: center;">Late</th>
                <th style="text-align: center;">Sick</th>
                <th style="text-align: center;">Reason</th>
            </tr>
        </thead>
        <tbody>
        <b>@if(isset($attendance)) @endif</b>

        @foreach ($students as $key => $item)
            <tr>
            <td>{{$item->roll_no}}
           @if(auth()->user()->group == 'Owner')
           <input type="hidden" id="roll_no" name="roll_no" value="{{$item->roll_no}}">
            <input type="hidden" name="teacher_id" id="teacher_id" value="{{auth()->user()->id}}">
            <input type="hidden" name="class_id" id="class_id" value="{{request('class_id')}}">
            <input type="hidden" name="semester_id" id="semester_id" value="{{$item->semester_id}}">
            <input type="hidden" name="course_id" id="course_id" value="{{$attendance->course_id}}">
            <input type="hidden" name="attendance_date" id="attendance_date1" value="{{$date}}">
            <input type="hidden" name="month" id="month" value="{{$monthly}}">
            <input type="hidden" name="school_id" id="school_id" value="{{request('school_id')}}">
            <input type="hidden" name="year" id="year" value="{{$year}}">
            <input type="hidden" name="day" id="day" value="{{$day}}">
           @else
           <input type="hidden" id="roll_no" name="roll_no" value="{{$item->roll_no}}">
            <input type="hidden" name="teacher_id" id="teacher_id" value="{{auth()->user()->teacher_id}}">
            <input type="hidden" name="class_id" id="class_id" value="{{request('class_id')}}">
            <input type="hidden" name="semester_id" id="semester_id" value="{{$item->semester_id}}">
            <input type="hidden" name="course_id" id="course_id" value="{{$item->course_id}}">
            <input type="hidden" name="attendance_date" id="attendance_date1" value="{{$date}}">
            <input type="hidden" name="month" id="month" value="{{$monthly}}">
            <input type="hidden" name="school_id" id="school_id" value="{{request('school_id')}}">
            <input type="hidden" name="year" id="year" value="{{$year}}">
            <input type="hidden" name="day" id="day" value="{{$day}}">

           @endif

           <!-- {{$attendance}} -->
            </td>
            <td>
            <input class="atten" type="hidden" name="student_id[]" id="student_id" value="
            {{$item->student_id}}" class="form-control"
            style="border:none;" readonly>    
            <label for=""> {{$item->student_firstname }} {{$item->student_lastname}}</label>                                        
            </td>
            <td align="center">
            <div id="ck-button-present">
            <label>
            <input style="cursor:pointer;" class="atten" checked type="radio"id="attendance_status" name="attendance_status[{{$item->student_id}}]" value="present" />
            <span>Present</span>
            </label>
            </div>
            </td>

            <td align="center">
            <div id="ck-button-absent">
            <label>
            <input class="atten" type="radio"id="attendance_status" name="attendance_status[{{$item->student_id}}]" value="absent" />
            <span>Absent</span>
            </label>
            </div>
            </td>

            <td align="center">
            <div id="ck-button-late">
            <label>
            <input class="atten" type="radio"id="attendance_status" name="attendance_status[{{$item->student_id}}]" value="late" />
            <span>Late</span>
            </label>
            </div>
            </td>

            <td align="center">
            <div id="ck-button-sick">
            <label>
            <input class="atten" type="radio"id="attendance_status" name="attendance_status[{{$item->student_id}}]" value="sick" />
            <span>Sick</span>
            </label>
            </div>
            </td>

            <td align="center">
            <label>
            <input class="form-control" type="text" id="attendance_reason" name="attendance_reason[{{$item->student_id}}]" placeholder="enter reason if necesary!"/>
            </label>
            </div>
            </td>
            
            </tr>
            @endforeach
            @endif
           

        </tbody>
    </table>
</div>

@section('scripts');
  <script>
  $(document).ready(function(){
    if($('#class_id').val() == '')
    {
      $('#addAttendance').hide();
    }else
    {
      $('#addAttendance').show();

      }

      $("#addAttendance2").css("display", "none");
      $(".addAttendance").css("display", "none");


  })  
            
    $("#class_id").on('change', function(){
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
			url: '{{ url ('/get/attendance/class')}}',
			data: {'class_id': classid, 'school_id':school_id},

            beforeSend: function(){
                $('#wait').css("visibility", "visible");
            },
            
                success:function(data){
                    console.log(data);
                        $(".datatable-responsive").html(data);

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

  $('#attendance_date').datetimepicker({
                        // format: 'DD-MM-YYYY',
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                        // autoCompelete: false
     });

     function attendance_date(val) {
    document.getElementById('attendance_date1').value = val;

  }

  setInterval(CheckTables, 100);

function CheckTables() {
    $("table").each(function (index) {
        $(this).find('tbody:not(:empty)').parent().show();
        $(this).find('tbody:empty').parent().hide();
    });

    if (($("tbody").is(":empty")))
        // $("#addAttendance1").hide();
        $("#addAttendance1").hide();

        if (($.trim($("tbody").html()) == ""))
    $("#addAttendance2").hide();
}

</script>
@endsection

