@extends('layouts.new-layouts.app')
@section('style')
<link href="{{url('/css/bootstrap-datepicker.css')}}" rel="stylesheet">
@stop
@section('content')

<div class="content">
        

        <div class="clearfix"></div>

        <div class="page-title">
              <div class="title_left">
                <h2>Search Result Card</h2>
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
                      
                    <ul class="nav navbar-right panel_toolbox">
                   
                        <a href="{{url('home/dashboard2')}}"><button type="submit" class="btn btn-round btn-dark">back</button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <form role="form" action="{{route('result.roll')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        <label class="control-label" for="exam">Note:</label>
                            <p>You can able to search individual student result by using his / her roll number</p>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label class="control-label" for="exam">Roll no</label>
                        <div class="form-group ">
                        <div class="input-group">
                        <input type="text" id="regiNo" required="true" @if(request('regiNo')) value="{{request('regiNo')}}" @endif class="form-control" name="regiNo" autocomplete="off" placeholder="enter roll to search....">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                        </div>
                        </div>
                        </div>
                </form>

                    <form role="form" action="{{url('result/search')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="class_f"  class="form-control " name="class_f" value="{{$formdata->class}}"   data-date-format="yyyy">
                                 <input type="hidden" id="section_f"  class="form-control " name="section_f" value="{{$formdata->department_id}}"   data-date-format="yyyy">
                                 <input type="hidden" id="session"  class="form-control " name="session" value="{{$formdata->batch}}"   data-date-format="yyyy">


                                 <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="class">Class <b style="color:red">*</b></label>

                                            <select name="class" id="class" class="form-control select_2_single" >
                                                <option value="0">--- select ---</option>
                                                @foreach(App\Models\Classes::where('school_id', auth()->user()->school_id)->get(); as $class)
                                                    <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="exam">Examination Type <b style="color:red">*</b></label>
                                            <?php  $data=[
                                                    'Class Test'=>'Class Test',
                                                    'Model Test'=>'Model Test',
                                                    'First Term'=>'First Term',
                                                    'Mid Term'=>'Mid Term',
                                                    'Final Exam'=>'Final Exam'
                                            ];?>

                                    <select name="exam" id="exam" class="form-control select_2_single" require="true">
                                    <option value="0" selected="true">Select Exam</option>
                                        <!-- @foreach(App\Exam::all(); as $exam)
                                        <option value="{{$exam->id}}">{{$exam->exam_code}}</option>
                                        @endforeach -->
                                    </select>
                                        </div>
                                     </div>

                                     <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="class">Session <b style="color:red">*</b></label>

                                            <select name="session" id="session" class="form-control select_2_single" >
                                                @foreach(App\Models\Batch::where('school_id', auth()->user()->school_id)->get(); as $batch)
                                                    <option value="{{$batch->id}}" @if($batch->is_current_batch === 1) selected @endif>{{$batch->batch}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                </div>
                                </div>
                                </div>

                                <br>
                                <button class="btn btn-dark btn-round pull-right"  type="submit"><i class="glyphicon glyphicon-search"></i> Search Result</button>
                         </form>
                   
                   <hr>
                   <div class="clearfix"></div>
                    @include('adminlte-templates::common.errors')
                    @include('flash::message')
            <div class="text-center">
            @if(isset($all_students_class))
            <div class="row">
                <div class="col-md-12">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <!-- <table id="markList" class="table table-striped table-bordered table-hover"> -->
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
                        @foreach($students_class as $student)
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
            @if(isset($all_students))
            @include('result.result_search_roll')
       
        @endif
        </div>
    </div>
    </div>
    </div>
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
