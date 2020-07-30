@extends('layouts.app')

@section('content')
    <section class="content-header">
        <!-- <h1 class="pull-right">
           <a class="btn btn-warning pull-right" data-toggle="modal" data-target="#faculty-add-modal" style="margin-top: -10px;margin-bottom: 5px" href="#"><i class="fa fa-plus"></i></a>
        </h1> -->
    <h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
    <i class="fa fa-id-sun-o" aria-hidden="true">STUDENTS IN CHARGE</i></h1>
    <a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            <div class="pull-right">
            <a href="{{url('pdf-download-faculty')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-pdf-o text-red" style="color:white"></i> PDF </a>

            <a href="{{url('export-excel-xlsx-faculty')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-excel-o text-green" style="color:white"></i> Excel </a>

            <a href="{{url('pdf-download-faculty')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-word-o text-blue" style="color:white"></i> Word </a>

            <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
            <i class="fa fa-print text-light-blue" style="color:white"></i> Print </a>
            </div>
            <div class="pull-left">
            <div class="btn-group">
                    <button type="button" class="btn btn-danger">SELECT CLASS</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                    @foreach($teacher_class as $grade) 
                    <li>
                    <a data-toggle="tooltip" title="{{$grade->class_name}}" class="dropdown-item" href="{{url('studentsincharge', $grade->class_code)}}">
                    <label for=""  class="active">{{$grade->semester_name}} </label> | {{$grade->class_code}}
                    </a></li>
                    @endforeach
                    </ul>
                    </div>
                    <h3 > @if(isset($teacher_class_grade)) @foreach ($teacher_class_grade as $n => $result) <b style="font-weight:bold; color:red">{{$result->semester_name}}</b>  <b>{{$result->course_name}}</b> @endforeach  @endif</h3>
                </div>
            <div class="clearfix"></div>
            <div class="table-responsive">
<div  id="wait"></div>
    <table class="table table-striped1 table-hover" id="teachers-table">
        <thead>
        <button style="margin-bottom: 10px; display:none" class="btn btn-danger delete_all" data-url="{{ url('delete_multiple_teacher') }}"><i class="fa fa-trash"></i> Delete All Selected</button>
            <b class="btn btn-sm pull-right" id="divoutput"></b>
            <tr>
         <th width="50px"><input type="checkbox" id="master" style="display:none"></th>
         <th>Photo</th>
        <th>Full Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Grade</th>
        <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($allStudentList as $teacher)
            <tr id="tr_{{$teacher->id}}" class="contact">
            <td><input type="checkbox" class="sub_chk" data-id="{{$teacher->id}}"></td>
            <td><a  href="{!! route('teachers.show', [$teacher->teacher_id]) !!}" title="View Profile">
            <img src="{{asset('student_images/' .$teacher->image)}}" alt=""
                class="rounded-circle"  width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></a>
            </td>
            <td> 
            {!! $teacher->first_name !!} {!! $teacher->last_name !!}
            
            </td>
            <td> @if($teacher->gender == 0)Male @else Female @endif</td>
            <td>{!! $teacher->email !!}</td>
            <td>{!! $teacher->phone !!}</td>
            <td>{!! $teacher->semester_name !!}</td>

            <td colspan="3">
                    {!! Form::open(['route' => ['teachers.destroy', $teacher->teacher_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <!-- <a href="{!! url('mark-teacher-attendance', [$teacher->teacher_id]) !!}" title="Mark Attendance" target="_blank" title="Mark Attendance" class='btn btn-info btn-xs'> <i class="glyphicon glyphicon-calendar"></i></a> -->
                        <!-- <a href="{!! url('generate-teacher-timetable', [$teacher->teacher_id]) !!} " target="_blank" title="View TimeTable" class='btn btn-primary btn-xs'> <i class="far fa-calendar"></i></a> -->
                        <!-- <a href="{!! url('prints-teachers', [$teacher->teacher_id]) !!} " title="Print Teacher" target="_blank" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-print"></i></a> -->
                        <a href="#" title="Send Email"  class='btn btn-default btn-xs'><i class="glyphicon glyphicon-envelope"></i></a>
                        <!-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} -->
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

