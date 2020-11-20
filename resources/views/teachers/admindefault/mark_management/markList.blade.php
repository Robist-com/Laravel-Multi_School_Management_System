@extends('layouts.new-layouts.app')

@php
    use App\Models\Batch;
@endphp

@section('content')

<div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="page-title">
              <div class="title_left">
                <h2> Marks List</h2>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

    <div class="content">

            <div class="clearfix"></div>
            <div class="x_panel">
                  <div class="x_title">
                    <h2> <div class="col-md-12">
                        <div class="form-group ">
                         <label for="session">Session</label>
                         <select id="session" name="batch_id" class="form-control select_2_single" required="true">
                                <option value="" selected disabled>--Select--</option>
                                    @foreach($batches as $batch)
                                    <option value="{{$batch->id}}" @if($batch->is_current_batch == 1) selected @endif>{{$batch->batch}}</option>
                                    @endforeach
                              </select>
                            </div>
                        </div></h2>
                        <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" data-toggle="tooltip" title=" show collapse"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!-- <li><button class="btn btn-box-tool " data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button></li> -->
                      <a href="{{url('get/mark/list')}}" class="btn btn-dark btn-round" data-toggle="tooltip" data-placement="left" title="Refresh"><i class="fa fa-arrow-circle-left" aria-hidden="true"> back</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                <div  id="wait"></div>
        <form role="form" action="{{url('teacher/mark/list')}}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
          <div class="col-md-12 col-sm-6 col-xs-12">

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label" for="class">Class</label>
                   
                    <select id="class" id="class" name="class" required="true" class="form-control select_2_single" >
                        <option value="" selected >-- Select --</option>
                      @foreach($classes as $class)
                      <option value="{{$class->class_code}}" @if($class->class_code == request('class')) selected @endif>{{$class->class_name}}</option>
                      @endforeach

                    </select>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label" for="department">Department</label>
                        <select name="department" id="department" class='form-control select_2_single' ></select>
                        <option value=" {{request('department')}} " @if(request('department')) selected @endif ></option>
                  </div>
                </div>

               <input type="hidden" value="Morning" name="shift">
               <!-- <input type="hidden" value="{{request('batch_id')}}" name="batch"> -->
               <input type="hidden" name="batch" id="session_value" value="">

               <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label" for="subject">Course</label>
                      <select  id="subject" name="subject" required="true" class="form-control select_2_single" >
                      <option value=" {{request('subject')}} " @if(request('subject')) selected @endif ></option>
                      </select>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label" for="exam">Examination</label>
                        <select  id="exam" name="exam" required="true" class="form-control select_2_single" >
                        <option value=" {{request('exam')}} " @if(request('exam')) selected @endif ></option>
                        </select>
                  </div>
                </div>
            </div>

              <div class="modal-footer">
                <button class="btn btn-dark btn-round pull-right style"  type="submit"><i class="glyphicon glyphicon-th"></i>Get List</button>
            </div>

          </form>
         
     
        <div class="text-center"> 
           
          @include('teachers.mark_management.test')

        </div>


    </div>
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

    var sessionvalue = $('#session').val();
$('#session_value').val(sessionvalue);

         $('#batch').on('change',function() {
          getdepartment();
        });
    });
    </script>
    @stop
