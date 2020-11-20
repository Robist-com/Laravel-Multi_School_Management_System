<?php $url = Request::is('get-class-attendance/*');?>
   
   <h2><i class="fa fa-calendar"> Attendance List</i> </h2>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <!-- <a href="{{route('shifts.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a> -->
    </div>
    <br><br>
    <div class="card">
        <div class="body">
            <div class="demo-splite-button-dropdowns pull-right">
                <div class="btn-group">
                    <button type="button" class="btn bg-teal waves-effect">MARK CLASS ATTENDANCE</button>
                    <button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Select Class</span>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach($classes as $grade)
                        <li>
                            <a data-toggle="tooltip" data-placement="left" title="{{$grade->class_name}}"
                                class="dropdown-item" href="{{url('get-class-attendance', $grade->class_code)}}">
                                <label for="" class="active">{{$grade->semester_name}} </label> | {{$grade->class_code}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br>
            <br>


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


@include('teachers.attendances.day_attendance')

@if($attendances != $date)

<h2 style="font-weight:bold;text-transform: uppercase; text-align:left">
 <i class="fa fa-calendar"></i> <b>Taken Attendace</b>
</h2>
<div class="panel-body">
  <div class="table-responsive">
    <!-- <table class="table table-hover" id="student"> -->
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable-responsive js-exportable" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th></th>
                    <th>Roll No.</th>
                    <th>Student Name</th>
                    <th>Status</th>
                    <th>Class</th>
                    <th>Course</th>
                    <th>Grade</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{$class_name}} --}}
            @if($attendances->where('attendance_date', $date)->where('teacher_id', $class_name->teacher_id))
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
                   <div style="background-color:#E74C3C;color:#fff;" data-toggle="tooltip" data-placement="right" title="{{$item->attendance_reason}}">Absent</div>
                   @elseif ($item->attendance_status == 'late')
                   <div style="background-color:#3498DB;color:#fff;" data-toggle="tooltip" data-placement="right" title="{{$item->attendance_reason}}">Late</div>
                   @else
                   <div style="background-color:#A569BD;color:#fff;" data-toggle="tooltip" data-placement="right" title="{{$item->attendance_reason}}">Sick</div>
                    @endif
                </td>
                <td> {{$item->class_name}}</td>
                <td> {{$item->course_name}}</td>
                <td> {{$item->semester_name}}</td>
                <td> {{$item->attendance_date}}</td>
                <td colspan="3">
                    {{-- here is the edit route link to edit the attendance okay by class okay --}}
                <a href="{!! url('teacher/edit/attendance/'.$item->attendance_date. '/' .$item->class_code.
                '/' .$item->semester_id. '/' .$class_name->teacher_id) !!}" class="fa fa-edit btn btn-round bg-pink" data-toggle="tooltip" data-placement="left" title="Edit Attendance"></a>
                </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="10">
                        <h1 align='center' class=' alert alert-danger'>
                            No Attendance Found Under This Date!, Please Try Another Date.

                        </h1>
                    </td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>
@endif
</div>
</div>
</div>
</div>
</div>
</div>


@section('js')
<script type="text/javascript">

       //  Exportable table
       $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });


        $('#semester_id').on('change',function(e){  // this script is to get the student by class okay
        var semester_id = $('#semester_id').val();
          getStudentsByclass()
          $('#department_id').empty();
          $('#class_id').empty();
          $('#course_id').empty();


        });

        $('#faculty_id').on('change',function(e){ // this script is to get faculty
        var faculty_id = $('#faculty_id').val()
        getByfaculty()
          $('#class_id').empty();
          $('#course_id').empty();
        });

        $('#department_id').on('change',function(e){ // this script is to get departmemnt
        var department_id = $('#department_id').val()
        getBydepartment()
        $('#course_id').empty();
        });

        $('#class_id').on('change',function(e){ // this script is to get class_ by course okay
        var class_id = $('#class_id').val()
        getBycourse()
        });

function getStudentsByclass(){ //is to get student by class degree facuty okay

  var semester_id = $('#semester_id').val()
  var degree_id = $('#degree_id').val()
  var faculty_id = $('#faculty_id')
  $(faculty_id).empty();
  $('#faculty_id').append($('<option>').text("--Select Faculty--").attr('value',""));
        $.get("{{ url('class-attendance') }}",
        {'semester_id':semester_id},function(data){
        console.log(data);
$.each(data,function(i,f){
    $(faculty_id).append($('<option/>',{
            value : f.faculty_id,
            text  : f.faculty_name

    }))
})



})
}

// function getByfaculty(){ // this script is to get faculty by department

//   var faculty_id = $('#faculty_id').val()
//   var department_id = $('#department_id')
//   $(department_id).empty();
//   $('#department_id').append($('<option>').text("--Select Department--").attr('value',""));
//         $.get("{{ url('dynamic-by-faculty') }}",
//         {'faculty_id':faculty_id},function(data){

//         console.log(data);
//  $.each(data,function(i,d){
//     $(department_id).append($('<option/>',{
//             value : d.department_id,
//              text  : d.department_name

//     }))
//  })

// })
// }

// function getBydepartment(){ // this script is to get department by class okay
// var department_id = $('#department_id').val()
// var class_id = $('#class_id')
// $(class_id).empty();
//   $('#class_id').append($('<option>').text("--Select Class--").attr('value',""));
//       $.get("{{ url('dynamic-by-class') }}",
//       {'department_id':department_id},function(data){

//       console.log(data);
// $.each(data,function(i,c){
//   $(class_id).append($('<option/>',{
//           value : c.id,
//            text  : c.class_name

//   }))
// })


// })
// }

// function getBycourse(){ // this script is to get class by course okay
// var class_id = $('#class_id').val()
// var course_id = $('#course_id')
// $(course_id).empty();
//   $('#course_id').append($('<option>').text("--Select Course--").attr('value',""));
//       $.get("{{ url('dynamic-by-course') }}",
//       {'class_id':class_id},function(data){

//       console.log(data);
// $.each(data,function(i,c){
//   $(course_id).append($('<option/>',{
//           value : c.id,
//            text  : c.id

//   }))
// })


// })
// }


  //  $('#attendance_date').datetimepicker({ // this is the date time picker okay
  //                       format: 'DD-MM-YYYY',
  //                       useCurrent: false
  //                       // autoCompelete: false
  //                   });

  //   $('#attendance_date').on('clcik',function(){
  //   });

// $(document).ready(function(){
//   if($('#class_id').val() == '')
//   {
//     $('#addAttendance').hide();
//   }else
//   {
//     $('#addAttendance').show();

//     }

// alert(1);
//     // $('#markAttendance').on('hidden.bs.modal', function (e) {
//     //     $('#markAttendance').modal('handleUpdate')
// })
// })

  $("#class").on('change', function(){
  var classid = $("#class").val();
  //alert(classid);

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
