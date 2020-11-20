@extends('layouts.new-layouts.app')

@section('content')
<!-- <section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa" aria-hidden="true">HOMEWORK LIST</i></h1>
<a  class="pull-left btn btn-danger" href="{{url('homework-list')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>
</section> -->
            <style>
                .names{
                color: red;
                font-family: 'Times New Roman', Times, serif;
                font-display: bold;
                font-size: large;
                }
                table{
                    border: 0px solid;
                    width:100%;
                }
                .vl {
            border-left: 6px solid green;
            height: 500px;
            position: absolute;
            left: 50%;
            margin-left: -3px;
            top: 0;
            }
            h6{
            display: inline-block
            }
            h5{
            display: inline-block
            }

.bordered-table {
    border:1px solid black;
    border-collapse: collapse;
}
.bordered-tr {
  border-left: 1px solid #000;
  border-right: 1px solid #000;
}

.bordered-td {
    border-left: 1px solid black;
    border-right: 1px solid black;
    border-bottom: 1px solid black;
}

.bordered-th {
    border-left: 1px solid #000;
    border-right: 1px solid #000;
    border-bottom: 1px solid black;

    text-align: center;
}

            </style>

    <div class="page-title">
              <div class="title_left">
                <h2>HOMEWORK SUBMITED LIST</h2>
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
                  @if(isset($student_homework))
                    <h2>Homeworks</h2>
                    @else
                    <h2>Homeworks Table</h2>
                    @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      @if(isset($student_homework))
                      <a href="{{url('home')}}" class="btn btn-dark btn-round" data-toggle="tooltip" data-placement="left" title="Return back"><i class="fa fa-arrow-circle-left" aria-hidden="true"> back</i></a>
                      @else
                      <a href="{{url('homework-list')}}" class="btn btn-dark btn-round" data-toggle="tooltip" data-placement="left" title="Return back"><i class="fa fa-arrow-circle-left" aria-hidden="true"> back</i></a>
                      @endif
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                @if(isset($class_assign1))
            <h2  style="text-transform:uppercase; font-weight:bold;">{{$class_assign1->semester_name}} <b style="color:red">({{$class_assign1->class_name}})</b></h2>
            @endif
   
              <h2 style="text-transform:uppercase; font-weight:bold; margin-left:20%;">
              
                 <b >@if(isset($class_assign1)){{$class_assign1->course_name}} @endif</b> homework <b style="color:red">submit </b> @if(isset($student_homework)) by  @if($class_assign1->gender == 0) mr. {{$class_assign1->last_name}} @else mis. {{$class_assign1->last_name}} @endif @else List @endif</h2>
          
        @if(isset($class_assign))
       <div class="card">
        <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action" width="100%">
           <!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" > -->
                <thead>
                    <tr class="bordered-tr">
                      <th class="bordered-th">Student</th>
                      <th class="bordered-th">Subject</th>
                      <th class="bordered-th">File</th>
                      <th class="bordered-th">Submit Time</th>
                      <th class="bordered-th">Date</th>
                      <th class="bordered-th">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($class_assign) > 0)
                    @foreach ($class_assign as $n => $homework)

                            <tr class="bordered-tr">
                                <td class="bordered-td" style="text-align: center;">{{$homework->first_name}} {{$homework->last_name}} </td>
                                <td class="bordered-td" style="text-align: center;">{{$homework->course_name}} </td>
                                <td class="bordered-td" style="text-align: center;"><button type="button" class="btn btn-primary btn-xs accordion-toggle"  data-toggle="collapse"
                                data-target="#demo{{$n}}" title="Click to download"><span class="fa fa-download"></span> {{$homework->file}}</button></td>
                                <td class="bordered-td" style="text-align: center;">{{$homework->created_at->diffForHumans()}}</td>
                                <td class="bordered-td" style="text-align: center;">{{date('d-m-Y ', strtotime($homework->created_at))}}</td>

                                <td style="text-align: center;width:112px;">
                                {!! Form::open(['route' => ['homework-delete', $homework->id], 'method' => 'post']) !!}
                                  <a title='Edit'  class='btn btn-info btn-sm' href='{{route('homework-edit', $homework->class_code )}}'> <i class="glyphicon glyphicon-edit icon-edit"></i></a> 
                                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'title'=>'Delete', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        
                                    {!! Form::close() !!}
                                    <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Print"></i></a> -->
                                    <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a> -->
                                </td>
                            </tr>
                            <tr>
                            <td colspan="9" class="hiddenrow">
                                @include('teachers.homework.studentSubmitpdfFile')
                            </td>
                        </tr>
                     @endforeach
                    @else
                   <tr>
				<td style="background:#fffff" style="border: none; text-transform:uppercase; text-align:center" text-black>
					
                @foreach ($class_assign as $n => $result)
                <ul class="nav nav-pills" role="tablist" style="text-align:center">
                <li role="presentation" class="active"><a href="#"> THERE IS NO STUDENT SUBMIT HOMEWORK YET FOR <span class="badge">{{$result->semester_name}}</span></a></li>
                <li role="presentation"><a href="#">{{$result->class_name}}</a></li>
                </ul>
				@endforeach
				</td>
				<td style="background:#fffff" style="border: none;"></td>
          
      </tr>
      @endif
  </tbody>
</table>
@else
<table class="table table-striped jambo_table bulk_action" width="100%">
           <!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" > -->
                <thead>
                    <tr class="bordered-tr">
                      <th class="bordered-th">Student</th>
                      <th class="bordered-th">Subject</th>
                      <th class="bordered-th">File</th>
                      <th class="bordered-th">Submit Time</th>
                      <th class="bordered-th">Date</th>
                      <th class="bordered-th">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($student_homework) > 0)
                    @foreach ($student_homework as $n => $homework)

                            <tr class="bordered-tr">
                                <td class="bordered-td" style="text-align: center;">{{$homework->first_name}} {{$homework->last_name}} </td>
                                <td class="bordered-td" style="text-align: center;">{{$homework->course_name}} </td>
                                <td class="bordered-td" style="text-align: center;"><button type="button" class="btn btn-primary btn-xs accordion-toggle"  data-toggle="collapse"
                                data-target="#demo{{$n}}" title="Click to download"><span class="fa fa-download"></span> {{$homework->file}}</button></td>
                                <td class="bordered-td" style="text-align: center;">{{$homework->created_at->diffForHumans()}}</td>
                                <td class="bordered-td" style="text-align: center;">{{date('d-m-Y ', strtotime($homework->created_at))}}</td>

                                <td style="text-align: center;width:112px;">
                                {!! Form::open(['route' => ['homework-delete', $homework->id], 'method' => 'post']) !!}
                                  <a title='Edit'  class='btn btn-info btn-sm' href='{{route('homework-edit', $homework->class_code )}}'> <i class="glyphicon glyphicon-edit icon-edit"></i></a> 
                                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'title'=>'Delete', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        
                                    {!! Form::close() !!}
                                    <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Print"></i></a> -->
                                    <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a> -->
                                </td>
                            </tr>
                            <tr>
                            <td colspan="9" class="hiddenrow">
                                @include('teachers.homework.studentSubmitpdfFile')
                            </td>
                        </tr>
                     @endforeach
                    @else
                   <tr>
				<td style="background:#fffff" style="border: none; text-transform:uppercase; text-align:center" text-black>
					
                @foreach ($class_assign as $n => $result)
                <ul class="nav nav-pills" role="tablist" style="text-align:center">
                <li role="presentation" class="active"><a href="#"> THERE IS NO STUDENT SUBMIT HOMEWORK YET FOR <span class="badge">{{$result->semester_name}}</span></a></li>
                <li role="presentation"><a href="#">{{$result->class_name}}</a></li>
                </ul>
				@endforeach
				</td>
				<td style="background:#fffff" style="border: none;"></td>
                       
          </tr>
          @endif
      </tbody>
  </table>
@endif
</div>
</div>
<br>

</div>

</div></div></div>
@endsection
@section('scripts')

<script>

function closePdf(){

var omyFrame = document.getElementById("myframe");
omyFrame.style.display="none";
// alert(1);

}

function openPdf(){
var omyFrame = document.getElementById("myframe");
omyFrame.style.display="block";

// alert(1);

}
</script>

@endsection