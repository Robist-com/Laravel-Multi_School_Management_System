@extends('layouts.app')

@php
    use App\Models\Batch;
@endphp


@section('content')
@include('table_style')
<section class="content-header">
    <h1 class="pull-left">Mark List</h1>
    <h1 class="pull-right">
       <a type="button" href="mark/create" class="btn btn-primary pull-right  style" style="margin-top: -10px;margin-bottom: 5px" >back</a>
    </h1>
</section>
<div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

        <form role="form" action="{{url('mark/list')}}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="col-md-12">

              <div class="col-md-2">
                <div class="form-group">
                  <label class="control-label" for="class">Class</label>
                    <select id="class" id="class" name="class" required="true" class="form-control select_2_single" >
                      @foreach($classes as $class)
                      <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label" for="department">Department</label>
                      {{-- {{ Form::select('department',$formdata,$formdata->department,['class'=>'form-control','id'=>'section','required'=>'true'])}} --}}
                        <select name="department" id="department" class='form-control select_2_single'></select>
                  </div>
                </div>

               <input type="hidden" value="Morning" name="shift">

               <div class="col-md-2">
                  <div class="form-group ">
                    <label for="session">session</label>
                    <select  id="session" name="session" required="true" class="form-control select_2_single" >
                      @foreach(App\Models\Batch::all(); as $batch)
                      <option value="{{$batch->id}}">{{$batch->batch}}</option>
                      @endforeach
                    </select>
                    {{-- {{ Form::select('session',$formdata,$formdata->session,['class'=>'form-control','id'=>'session','required'=>'true'])}} --}}
                  </div>
                </div>
                {{-- <input type="hidden" id="session"  class="form-control " name="session" value=""   data-date-format="yyyy"> --}}
{{-- {{$class}} --}}
            {{-- <div class="row">
              <div class="col-md-12"> --}}
               
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label" for="subject">Course</label>
                      <select  id="subject" name="subject" required="true" class="form-control select_2_single" >
                      </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="control-label" for="exam">Examination</label>
                      <?php  $data=[
                        ''=>'--Select Exam--',
                       
                      ];?>
                        <select  id="exam" name="exam" required="true" class="form-control select_2_single" >
                            {{-- <option value="">--Select Subjects--</option> --}}

                        </select>
                      {{-- {{ Form::select('exam',$formdata,$formdata->exam,['class'=>'form-control select_2_single','id'=>'exam','required'=>'true'])}} --}}
                  </div>
                </div>
            </div>

              {{-- </div>
            </div> --}}
            {{-- <div class="row"> --}}
              <div class="col-md-12">
                <button class="btn btn-primary pull-right style"  type="submit"><i class="glyphicon glyphicon-th"></i>Get List</button>

              {{-- </div> --}}
            </div>
          </form>
         
            </div>
        </div>
    </div>
    <div class="box box-primary">
            <div class="box-body">
        <div class="text-center"> 
        <div class="pull-right">
            <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-pdf-o text-red" style="color:white"></i> PDF </a>

            <a href="{{url('export-excel-xlsx-users')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-excel-o text-green" style="color:white"></i> Excel </a>

            <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-word-o text-blue" style="color:white"></i> Word </a>

            <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
            <i class="fa fa-print text-light-blue" style="color:white"></i> Print </a>
            </div>
            <div class="clearfix"></div>
          @include('mark_management.test')

        </div>
        </div>
    </div>
    </div>
    @stop
    @section('scripts')
    <script src="/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
    var getSubjects = function () {
      var val = $('#class').val();

       // alert(val);
      $.ajax({
        url:"{{url('/class/getcourses')}}"+'/'+val,
        type:'get',
        dataType: 'json',
        success: function( json ) {


          $('#subject').empty();
          $('#subject').append($('<option>').text("--Select Subject--").attr('value',""));
          $.each(json, function(i, subject) {
             console.log(subject);

            $('#subject').append($('<option>').text(subject.course_name).attr('value', subject.course_code));
          });
        }
      });
    };

function getdepartment()
{
    var aclass = $('#class').val();
    var batch = $('#batch').val();
   // alert(aclass);
    $.ajax({
      url: "{{url('/department/getList')}}"+'/'+aclass+'/'+batch,
      data: {
        format: 'json'
      },
      error: function(error) {
        //alert("Please fill all inputs correctly!");
      },
      dataType: 'json',
      success: function(data) {
        $('#department').empty();
      // $('#section').append($('<option>').text("--Select Section--").attr('value',""));
        $.each(data, function(i, department) {
          //console.log(student);
         
          
            //var opt="<option value='"+section.id+"'>"+section.name + " </option>"
            // var opt="<option value='"+section.id+"'>"+section.name +' (  ' + section.students +' ) '+ "</option>"
            var opt="<option value='"+department.department_id+"'>"+department.department_name +' (  ' + department.students +' ) '+ "</option>"
        
          console.log(opt);
          $('#department').append(opt);

        });
        //console.log(data);

      },
      type: 'GET'
    });
};
 function getexam()
{
    var aclass = $('#class').val();
   // alert(aclass);
    $.ajax({
      url: "{{url('/exam/getList')}}"+'/'+aclass,
      data: {
        format: 'json'
      },
      error: function(error) {
        alert("Please fill all inputs correctly!");
      },
      dataType: 'json',
      success: function(data) {
        $('#exam').empty();
       $('#exam').append($('<option>').text("--Select Exam--").attr('value',""));
        $.each(data, function(i, exam) {
          //console.log(student);
         
          
            var opt="<option value='"+exam.id+"'>"+exam.type + " </option>"

        
          //console.log(opt);
          $('#exam').append(opt);

        });
        //console.log(data);

      },
      type: 'GET'
    });
};
    $( document ).ready(function() {
      
 
      $(".datepicker2").datepicker( {
        format: " yyyy", // Notice the Extra space at the beginning
        viewMode: "years",
        minViewMode: "years",
        autoclose:true

      });
      // $('#markList').dataTable({
      //     "sPaginationType": "bootstrap",
      // });
      $('#class').on('change', function (e) {
        getSubjects();
        getdepartment();
        getexam();
      });
    //   getSubjects();
    //   getdepartment();
    //     getexam();

         $('#batch').on('change',function() {
          getdepartment();
        });
    });
    </script>
    @stop
