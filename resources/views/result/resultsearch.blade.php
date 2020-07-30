
@extends('layouts.app')

@section('content')
 
<section class="content-header">
 <h1>Search Result</h1>
 <button class="btn btn-xs btn-info pull-right" style="padding-bottom:5px; margin-bottom:10px;"><a href="/result/home" style="color:#fff">back</a></button>
 </section>

<div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
       
                <div class="box box-primary" data-widget="box-widget">
                    <div class="box-header">
                    <h3 class="box-title">Search Result</h3>
                        <div class="box-tools">
                        <!-- This will cause the box to collapse when clicked -->
                        <button class="btn btn-box-tool " data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                        </div>
                        </div>
                        <!-- /.box-header -->
                    <div class="box-body">
                    <form role="form" action="{{url('result/search')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="class_f"  class="form-control " name="class_f" value="{{$formdata->class}}"   data-date-format="yyyy">
                                 <input type="hidden" id="section_f"  class="form-control " name="section_f" value="{{$formdata->department_id}}"   data-date-format="yyyy">
                                 <input type="hidden" id="session"  class="form-control " name="session" value="{{$formdata->batch}}"   data-date-format="yyyy">


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="class">Class</label>

                                            <select name="class" id="class" class="form-control select_2_single" >
                                                @foreach(App\Models\Classes::all(); as $class)
                                                    <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="class">Batch</label>

                                            <select name="session" id="session" class="form-control select_2_single" >
                                                @foreach(App\Models\Batch::all(); as $batch)
                                                    <option value="{{$batch->id}}">{{$batch->batch}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="exam">Examination</label>
                                            <?php  $data=[
                                                    'Class Test'=>'Class Test',
                                                    'Model Test'=>'Model Test',
                                                    'First Term'=>'First Term',
                                                    'Mid Term'=>'Mid Term',
                                                    'Final Exam'=>'Final Exam'
                                            ];?>

                                    <select name="exam" id="exam" class="form-control select_2_single" require="true">
                                    <option value="0" selected="true">Select Exam</option>
                                        @foreach(App\Exam::all(); as $exam)
                                        <option value="{{$exam->id}}">{{$exam->exam_code}}</option>
                                        @endforeach
                                    </select>
                                            <!-- {{ Form::select('exam',$data,$formdata->exam,['class'=>'form-control select_2_single','id'=>'exam','required'=>'true'])}} -->
                                        
                                        </div>
                                     </div>

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="session">Regi No</label>
                                            <input type="text" id="regiNo" required="true" class="form-control" name="regiNo">
                                        </div>
                                </div>
                                <br>
                                <button class="btn btn-warning pull-right"  type="submit"><i class="glyphicon glyphicon-search"></i> Search Result</button>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                            </div>
                        </div>
                    </form>



                    </div>
                    </div>
                </div>
        </div>
        <div class="text-center">
            @if($students)
            <div class="row">
                <div class="col-md-12">
                    <table id="markList" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Shift</th>
                            {{-- <th>Group</th> --}}
                             <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                            <td><img src="{{asset('student_images/'.$student->image)}}" alt="" class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
                                <td>{{$student->roll_no}}</td>
                                <td>{{$student->first_name}} {{$student->last_name}}</td>
                                <td>{{$formdata->postclass}}</td>
                                <td>{{$student->department_name}}</td>
                                <td>{{$student->shift}}</td>
                                {{-- <td>{{$student->group}}</td> --}}

                                <td>
                                    {{-- @if($gradsystem=='' || $gradsystem=='auto') --}}
                                      <a title='Print' target="_blank" class='btn btn-info' href='{{url("/gradesheet/print")}}/{{$student->roll_no}}/{{$formdata->exam}}/{{$formdata->class}}'> <i class="glyphicon glyphicon-print icon-printer"></i></a>
                                    {{-- @else --}}
                                      {{-- <a title='Print' target="_blank" class='btn btn-info' href='{{url("/gradesheet/m_print")}}/{{$student->roll_no}}/{{$formdata->exam}}/{{$formdata->class}}?type={{ $type}}&examps_ids={{$exams_ids}}'> <i class="glyphicon glyphicon-print icon-printer"></i></a> --}}
                                    {{-- @endif --}}
                                </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        </div>
    </div>
@stop
@section('scripts')

<script type="text/javascript">

 $( document ).ready(function() {
  $('#class').on('change', function (e) {
       
        getexam();
      });
     
        getexam();
    });
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
</script>
@stop
