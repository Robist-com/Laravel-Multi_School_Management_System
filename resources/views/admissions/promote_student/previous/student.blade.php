@extends('layouts.app')

@section('content')
    <section class="content-header">
<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
<span class="fa fa-u-o">PREVIOUS GRADES </span></h1>
<a  class="pull-left btn btn-danger" href="{{url('show/promote/student')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        @include('adminlte-templates::common.errors')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
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
    <h3 style="font-weight:bold;"><i class="fa fa-user" aria-hidden="true"></i> CURRENT GRADE</h3>
   <table class="table table-striped1 table-hover" id="table">
    <thead>
    <button style="margin-bottom: 10px; display:none" class="btn btn-danger delete_all" data-url="{{ url('delete_multiple_promoted_student') }}"><i class="fa fa-trash"></i> Delete All Selected</button>
    <b class="btn btn-sm pull-right" id="divoutput"></b>
        <tr>
            <!-- <th><input type="button" name="checkedAll" id="checkedAll" value="check All">  </th> -->
            <th width="50px"><input type="checkbox" id="master" style="display:none"></th>
            <th>#</th>
            <th>Roll No.</th>
            <th>Student</th>
            <th>Class</th>
            <th>Grade</th>
            <th>Status</th>
            <th>Promoted Date</th>
            <th style="text-align:center">Action</th>
        </tr>

    </thead>

    <tbody>
        @foreach ($promotestudent_current as $key => $user)
                <tr id="tr_{{$user->id}}" class="contact">
                <td><input type="checkbox" class="sub_chk" data-id="{{$user->id}}"></td>
                <td>{{$key+1}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->first_name}} {{$user->last_name}}</td>
                <td>{{$user->class_name}}</td>
                <td id="role">{{$user->semester_name}}</td>
                <td>
                {{$user->status}} Grade
                </td>

                <td>{{ date("d-M-Y", strtotime($user->created_at)) }}</td>

                <td>
               
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-users-single', [$user->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('ShowPreviousPromotedStudent', [$user->student_id]) !!}" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        @if(Auth::user()->role_id == 1)
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs delete-modal', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
         @endforeach
    </tbody>
</table>
<div class="clearfix"></div>
            <h3 style="font-weight:bold;"><i class="fa fa-user" aria-hidden="true"></i> PREVIOUS GRADE</h3>
@if($promotestudent_previous)
<table class="table table-striped1 table-hover" id="table">
    <thead>
    <button style="margin-bottom: 10px; display:none" class="btn btn-danger delete_all" data-url="{{ url('delete_multiple_promoted_student') }}"><i class="fa fa-trash"></i> Delete All Selected</button>
    <b class="btn btn-sm pull-right" id="divoutput"></b>
        <tr>
            <!-- <th><input type="button" name="checkedAll" id="checkedAll" value="check All">  </th> -->
            <th width="50px"><input type="checkbox" id="master" style="display:none"></th>
            <th>#</th>
            <th>Roll No.</th>
            <th>Student</th>
            <th>Class</th>
            <th>Grade</th>
            <th>Status</th>
            <th>Promoted Date</th>
            <th style="text-align:center">Action</th>
        </tr>

    </thead>

    <tbody>
        @foreach ($promotestudent_previous as $key => $user)
              
                <tr id="tr_{{$user->id}}" class="contact">
                <td><input type="checkbox" class="sub_chk" data-id="{{$user->id}}"></td>
                <td>{{$key+1}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->first_name}} {{$user->last_name}}</td>
                <td>{{$user->class_name}}</td>
                <td id="role">{{$user->semester_name}}</td>
                <td>
                {{$user->status}} Grade
                </td>

                <td>{{ date("d-M-Y", strtotime($user->created_at)) }}</td>

                <td>
               
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-users-single', [$user->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('ShowPreviousPromotedStudent', [$user->student_id]) !!}" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        @if(Auth::user()->role_id == 1)
                        <a href="{!! route('users.edit', [$user->id]) !!}" title="Previous Result" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs delete-modal', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
           
         @endforeach
    </tbody>
</table>
@endif

</div>
        <!-- </div> -->
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


