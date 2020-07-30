@extends('layouts.app')

@section('content')
@include('table_style')
<section class="content-header">
    <h1 class="pull-right">
    <a href="{{url('result/home')}}" class="btn btn-success pull-right style" style="margin-top: -10px;margin-bottom: 5px" ><i class="fa fa-arrow" aria-hidden="true">back</i></a>
    </h1>
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
            <h3 class="box-title">Generate Grade Sheet</h3>
                <div class="box-tools">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool " data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
            <div class="box-body collapse">
                <div class="panel">
                    <div class="panel-body">
        <form role="form" action="{{url('/gradesheet')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{--<input value="{{date('Y')}}" type="text" id="session" required="true" class="form-control datepicker2" name="session" value="{{$formdata->session}}"  data-date-format="yyyy">
        --}}
        <input type="hidden" id="session"  class="form-control " name="session" value="{{$formdata->batch}}"   data-date-format="yyyy">
        <input type="hidden" id="class_f"  class="form-control " name="class_f" value="{{$formdata->class}}"   data-date-format="yyyy">
        <input type="hidden" id="section_f"  class="form-control " name="section_f" value="{{$formdata->department_id}}"   data-date-format="yyyy">

        <div class="form-group">
            <div class="col-md-2">
                <label class="control-label" for="section">Class</label>
                <select name="class" id="class" class="form-control select_2_single" >
                  @foreach(App\Models\Classes::all(); as $class)
                      <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                  @endforeach

              </select>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="section">Batch</label>
            <select id="session"  class="form-control select_2_single" name="session"  >
                @foreach(App\Models\Batch::all(); as $batch)
                <option value="{{$batch->id}}">{{$batch->batch}}</option>
                @endforeach
            </select>
        </div>
    </div>
    
        <div class="col-md-3">
            <label class="control-label" for="section">Class Group</label> //Department
            <select class="form-control select_2_single" id="department" required name="section">
             </select>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" for="section">Type</label>
            <select name="type" id="type"  class ='form-control select_2_single'>
            <option value="sigle" @if($formdata->type == 'sigle') selected @endif>Single</option>
            @if($gradsystem=='manual')
            <option value="compined"  @if($formdata->type == 'compined') selected @endif>Compined</option>
            @endif
            </select>
            </div>
    </div>

    <div class="form-group" id="single">
        <div class="col-md-2">
        <label class="control-label" for="section">Exam</label>
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
</div>
</div>
</div>  

<button type="submit" class="btn btn-success btn-sm  pull-right"><i class="glyphicon glyphicon-th"></i> Generate Result </button>
<button type="button" class="btn btn-danger  pull-right" data-dismiss="modal">close</button>
</div>  
 </form>
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
    
                {{-- </div> --}}
    </div>
        {{-- </div> --}}
    {{-- </div> --}}
@endsection


@section('scripts')
<script src="{{url('/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
     $( document ).ready(function() {
         // alert(1);
         getdepartment();
             getexam();
         // getsections();
         $(".datepicker2").datepicker( {
             format: " yyyy", // Notice the Extra space at the beginning
             viewMode: "years",
             minViewMode: "years",
             autoclose:true

         });
         // $('#markList').dataTable();
         
          $('#class').on('change', function (e) {
    
             //getexam();
             getdepartment();
             getexam();
             alert(1);
             // subject();
            });
          $('#section').on('change', function (e) {
    
                 getexam();
                 //getsections();
            });
            
     getexam();
     });

function getdepartment()
{
 var aclass = $('#class').val();
 //  var session = $('#session').val();
  if(session==''){
    session =2020;
  }
// alert(aclass);
 $.ajax({
   url: "{{url('/department/getList')}}"+'/'+aclass+'/'+session,
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
       var opt="<option value='"+department.department_id+"'>"+department.department_name +' (  ' + department.students +' ) '+ "</option>"

       //console.log(opt);
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
    $('#exam').append($('<option>').text("--Select--").attr('value',""));
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


