@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">MANAGE TIMETABLE</h1>
        <h1 class="pull-right">
          <a type="button" data-toggle="modal" data-target="#add-timetable" class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" >Genarate TimeTable</a>
          <a type="button" href="class/students" class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" >Genarate Classes</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
      @if($message = Session::get('success'))
      <div class="alert-success">
        <p>{{$message}}</p>
      </div>
      @endif
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body text-center">
            <div class="pull-right">
            <a href="{{url('pdf-download-class-schedule')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-pdf-o text-red" style="color:white"></i> PDF </a>

            <a href="{{url('export-excel-xlsx-level')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-excel-o text-green" style="color:white"></i> Excel </a>

            <a href="{{url('pdf-download-class-schedule')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-word-o text-blue" style="color:white"></i> Word </a>

            <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
            <i class="fa fa-print text-light-blue" style="color:white"></i> Print </a>
            </div>
            <div class="clearfix"></div>
             @include('timetables.table')

            @include('timetables.teacher_timetable')

            </div>
        </div>
        <div class="text-center">
          {{-- @include('timetables.table') --}}

      
        </div>
    </div>

@endsection

