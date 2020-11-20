@extends('layouts.new-layouts.app')

@section('content')
<!-- @include('table_style')  -->
<?php 
$day = '';
$date = date('Y-m-d');
?>

<style>
    .btn-block{
        height:28px;
        text-emphasis: center;
        text-anchor: top;
    }
</style>

@php
    $date = date('Y-m-d'); // this for the date current date
@endphp

<section class="content-header">
    <h1 class="pull-left"><i class="fa fa-calendar">  Attendance</i></h1>
    <div class="col-md-4">
    
    </div>
    
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
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

        <div class="clearfix"></div>
        <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Select Creterials </h2>
                <ul class="nav navbar-right panel_toolbox">
                  <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-dark btn-round dropdown-toggle btn-sm" type="button"> MARK CLASS ATTENDANCE <span class="caret"></span>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                    @foreach($classes as $grade) 
                    <li>
                    <a data-toggle="tooltip" data-placement="left" title="{{$grade->class_name}}" class="dropdown-item" href="{{url('get-class-attendance', $grade->class_code)}}">
                    <label for=""  class="active">{{$grade->semester_name}} </label> | {{$grade->class_code}}
                    </a></li>
                    @endforeach
                    </ul>
                    </div>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

   
            @if($attendances != $date)
          <form action="{{url('MarkAttendanceClass')}}" method="post">
            @csrf
            @if(isset($classes))
            @include('teachers.attendances.mark_attendance')
            <?php $url = Request::is('get-class-attendance/*');?>

            @if($url)
              <div class="modal-footer">
              <button type="submit" id="addAttendance" class="btn btn-dark btn-round pull-right"><i class="fa fa-pencil"></i> Mark-Attendance</button>
              <a href="{{url('mark-teacher-attendance')}}" id="addAttendance" class="btn btn-danger btn-round pull-right"><i class="fa fa-close"></i> Cancel</a>
              </div>
              @endif
            @endif
            </form>
            @endif
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            @endsection

{{-- here will be our js part okay --}}
@if($classes)
@endif
@section('scripts')
<script type="text/javascript">


// {{-- i will explain this script later okay  --}}

        $('#semester_id').on('change',function(e){
        var semester_id = $('#semester_id').val();
          getStudentsByclass()
          $('#department_id').empty();
          $('#class_id').empty();
          $('#course_id').empty();


        });

        $('#faculty_id').on('change',function(e){
        var faculty_id = $('#faculty_id').val()
        getByfaculty()
          $('#class_id').empty();
          $('#course_id').empty();
        });

        $('#department_id').on('change',function(e){
        var department_id = $('#department_id').val()
        getBydepartment()
        $('#course_id').empty();
        });

        $('#class_id').on('change',function(e){
        var class_id = $('#class_id').val()
        getBycourse()
        });

function getStudentsByclass(){

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

function getByfaculty(){

  var faculty_id = $('#faculty_id').val()
  var department_id = $('#department_id')
  $(department_id).empty();
  $('#department_id').append($('<option>').text("--Select Department--").attr('value',""));
        $.get("{{ url('dynamic-by-faculty') }}",
        {'faculty_id':faculty_id},function(data){

        console.log(data);
 $.each(data,function(i,d){
    $(department_id).append($('<option/>',{
            value : d.department_id,
             text  : d.department_name

    }))
 })

})
}

function getBydepartment(){
var department_id = $('#department_id').val()
var class_id = $('#class_id')
$(class_id).empty();
  $('#class_id').append($('<option>').text("--Select Class--").attr('value',""));
      $.get("{{ url('dynamic-by-class') }}",
      {'department_id':department_id},function(data){

      console.log(data);
$.each(data,function(i,c){
  $(class_id).append($('<option/>',{
          value : c.id,
           text  : c.class_name

  }))
})


})
}

function getBycourse(){
var class_id = $('#class_id').val()
var course_id = $('#course_id')
$(course_id).empty();
  $('#course_id').append($('<option>').text("--Select Course--").attr('value',""));
      $.get("{{ url('dynamic-by-course') }}",
      {'class_id':class_id},function(data){

      console.log(data);
$.each(data,function(i,c){
  $(course_id).append($('<option/>',{
          value : c.id,
           text  : c.id

  }))
})


})
}


   $('#attendance_date').datetimepicker({
                        format: 'DD-MM-YYYY',
                        useCurrent: false
                        // autoCompelete: false
                    });

    $('#attendance_date').on('clcik',function(){
    });

$(document).ready(function(){
  alert(1)
  if($('#class_id').val() == '')
  {
    $('#addAttendance').hide();
  }else
  {
    $('#addAttendance').show();

    }

alert(1);
    // $('#markAttendance').on('hidden.bs.modal', function (e) {
    //     $('#markAttendance').modal('handleUpdate')
})
})

  $("#class").on('change', function(){
  var classid = $("#class").val();
  //alert(classid);
alert(1)
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
