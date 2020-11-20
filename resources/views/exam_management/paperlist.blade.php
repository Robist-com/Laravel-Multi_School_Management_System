@extends('layouts.new-layouts.app')
@section('style')
<link href="{{url('/css/bootstrap-datepicker.css')}}" rel="stylesheet">
@stop
@section('content')

<!-- <section class="content-header">
    <h1>Question Lists</h1>
    <button class="btn btn-xs btn-info pull-right" style="padding-bottom:5px; margin-bottom:10px;"><a href="/question" style="color:#fff">back</a></button>
    </section> -->

<div class="content">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        

        <div class="clearfix"></div>

        <div class="page-title">
              <div class="title_left">
                <h3>MANAGE CLASSES</h3>
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

            <div class="clearfix"></div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
            <a class="btn btn-dark btn-round" data-toggle="modal" data-target="#generatePaper-show"> Generate Question Paper</a>

                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a class="btn btn-dark btn-round" data-toggle="modal" data-target="#generatequestion-show"> Create Question</a>
                        <!-- <a href="{{route('classes.index')}}"><button type="submit" class="btn btn-round btn-success">Add</button></a> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

        <form role="form" action="{{url('/question/list')}}" method="post"  enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="col-md-12">

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                    <select id="class" id="class" name="class" class="form-control select_2_single" >
                    <option value="" selected="true" disabled="true">Select Class</option>
                      @foreach($classes as $class)
                      <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                      @endforeach
                    </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-group ">
                      <input type="text" id="session" value="{{date('Y')}}" required="true" class="form-control datepicker2" name="session" value=""  >
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-group">
                      @if(isset($subjects))
                      {{ Form::select('subject',$subjects,$formdata->subject,['class'=>'form-control','id'=>'subject','required'=>'true'])}}
                      @else
                      <select id="course_id"  name="course_id"  class="form-control select_2_single" >
                        <option value="" selected="true" disabled="true">Select Course</option>

                      </select>
                      @endif
                    </div>
                  </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-12">

              <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-group">
                      <select   name="chapter[]" id="chapter" class="form-control select_2_multiple" multiple data-actions-box="true" data-hide-disabled="true" data-size="5"  required="true">
                      </select>

                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <select name="level[]" class="form-control select_2_multiple" multiple data-actions-box="true" data-hide-disabled="true" data-size="5" required>
                          <option value="">---Select a Level---</option>
                          <option value="simple">Simple</option>
                          <option value="normal">Normal</option>
                          <option value="hard">Hard</option>
                        </select>
                    </div>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="modal-footer">
                <button class="btn btn-dark btn-round pull-right"  type="submit"><i class="glyphicon glyphicon-th"></i>Get List</button>

              </div>
            </div>
          </form>

          @if($questions )
              <!-- <table id="studentList" class="table table-striped table-bordered" > -->
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>
                <tr>
                  <th>Class</th>
                  <th>Course</th>
                  <th>Question</th>
                  <th>Chapter</th>
                  <th>Type</th>
                  <th>Level</th>
                  <th>Point</th>
                  <th>Session</th>

                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($questions as $question)
                  <tr>
                    <td>{{$question->class_code}}</td>
                    <td>{{$question->course_name}}</td>
                    <td>{{$question->question_name}}</td>
                    <td>{{$question->chapter}}</td>
                    <td>@if($question->question_type==1) Long @elseif($question->question_type==2) MCQ @else Short @endif</td>
                    <td>{{$question->level}}</td>
                    <td>{{$question->points}}</td>
                    <td>{{$question->session}}</td>

                    <td>
                    <?php


                    ?>
                    <a title='View' class='btn btn-success' href='{{url("/question/edit/$question->question_id")}}'> <i class="glyphicon glyphicon-pencil icon-white"></i></a>&nbsp&nbsp
                   <a title='Delete' class='btn btn-danger' href='{{url("/question/delete/$question->question_id")}}' onclick="return confirm('Are you sure you want to delete ?');"> <i class="glyphicon glyphicon-trash icon-white"></i></a>
                    {{--&nbsp&nbsp <a title='View' class='btn btn-success' href=''> <i class="glyphicon glyphicon-phone"></i></a>--}}
                    <?php /*&nbsp&nbsp <a title='View' class='btn btn-success' href='{{url("/fee/collections?class_id=$student->class_code&section=$student->section_id&session=$student->session&type=Monthly&month=$month&fee_name=$fee_name")}}'> <i class="glyphicon glyphicon-phone"></i></a>
                    */ ?>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            <!-- </div>
          </div> -->
          @endif
          </div>
        </div>
      </div>
    </div>
</div>

@include('exam_management.generate_exam_paper')
@include('exam_management.question')
<!-- /.box-body -->
                
<!-- </div> -->

    @stop
    @section('scripts')
    <script src="/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
     $( document ).ready(function() {
    //   $('#studentList').DataTable( {
    //     //pagingType: "simple",
    //     //"pageLength": 5,
    //   //  "pagingType": "full_numbers",
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'print'
    //     ],
    //      "sPaginationType": "bootstrap",

    // });

    // alert(1)

      // $(".datepicker2").datetimepicker( {
      //   format: "Y", // Notice the Extra space at the beginning
      //   viewMode: "years",
      //   // minViewMode: "years",
      //   // autoclose:true

      // });

      $('.datepicker2').datetimepicker({
            viewMode: 'years',
            format: 'Y',
            // autoClose: true,
    //   });
        });
      // $('#markList').dataTable();
      $('#class').on('change', function (e) {
        getSubjects();
        // getchapter();
       // getexam();
        // getsections();

      });
      $('#section').on('change', function (e) {
          //getSubjects();
          //getsections();
          //getexam();
      });
      $('#course_id').on('change', function (e) {
          //getSubjects();
          //getsections();
          //alert(43);
          //getexam();
          getchapter();
      });
          getSubjects();
          // getexam();
          // getsections();


        $('#session').on('change',function() {
        //  getexam();
          // getsections();

        });
         //getexam();
    });
    var getSubjects = function () {

      var val = $('#class').val();

       // alert(val);
      $.ajax({
        url:"{{url('/class/getcourses')}}"+'/'+val,
        type:'get',
        dataType: 'json',
        success: function( json ) {


          $('#course_id').empty();
          $('#course_id').append($('<option>').text("--Select Course--").attr('value',""));
          $.each(json, function(i, course) {
             console.log(course);

            $('#course_id').append($('<option>').text(course.course_name).attr('value', course.id));

          });
        }
      });
    };

// function getsections()
// {
//     var aclass = $('#class').val();
//     var session = $('#session').val();
//    // alert(aclass);
//     $.ajax({
//       url: "{{url('/section/getList')}}"+'/'+aclass+'/'+session,
//       data: {
//         format: 'json'
//       },
//       error: function(error) {
//         //alert("Please fill all inputs correctly!");
//       },
//       dataType: 'json',
//       success: function(data) {
//         $('#section').empty();
//       // $('#section').append($('<option>').text("--Select Section--").attr('value',""));
//         $.each(data, function(i, section) {
//           //console.log(student);


//             //var opt="<option value='"+section.id+"'>"+section.name + " </option>"
//             var opt="<option value='"+section.id+"'>"+section.name +' (  ' + section.students +' ) '+ "</option>"


//           //console.log(opt);
//           $('#section').append(opt);

//         });
//         //console.log(data);

//       },
//       type: 'GET'
//     });
// };
function getchapter()
{
     var aclass = $('#class').val();
     var course = $('#course_id').val();

     alert(course);
    $.ajax({
      url: "{{url('/chapter/getList')}}"+'/'+aclass+'?course_id='+course,
      data: {
        format: 'json'
      },
      error: function(error) {
        // alert("Please fill all inputs correctly!");
      },
      dataType: 'json',
      success: function(data) {
       $('#chapter').empty();
       $('#chapter').append($('<option>').text("--Select Exam--").attr('value',""));
       var options = [];
       $.each(data, function(i, exam) {
          //console.log(student);


            var opt="<option value='"+exam.chapter+"'>"+exam.chapter + " </option>"


          //console.log(opt);
          //$('#chapter').append(opt);
           options.push(opt);

        });
        //console.log(data);
       $("#chapter").html(options).selectpicker('refresh');

      },
      type: 'GET'
    });
};

    </script>
    @stop
