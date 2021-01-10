@extends('layouts.new-layouts.app')
@section('content')

@if (count($classes) == 0)
<span><i class="fa fa-info"></i> <marquee behavior="" direction="">Classes Table is Empty Please create classes to able to create Exam</marquee> <a href="{{ route('classes.index') }}" class="btn btn-sm btn-dark"> Create Class</a> </span>
@endif
@if(count($department) == 0)
<span><i class="fa fa-info"></i> <marquee behavior="" direction="">Student Group is Empty Please create group to able to create Exam</marquee> <a href="{{ route('departments.index') }}" class="btn btn-sm btn-dark"> Create Group</a> </span>
@endif


    <div class="content">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        @include('flash::message')

        <div class="page-title">
              <div class="title_left">
                <h2>Create Exams</h2>
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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-dark btn-round" data-toggle="modal" data-target="#createExam"> Create Exam</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                <div class="pull-right">
                <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
                <i class="fa fa-file-pdf-o text-red" style="color:red"></i> PDF </a>

                <a href="{{url('export-excel-xlsx-users')}}" class="btn btn  btn-x"> 
                <i class="fa fa-file-excel-o text-green" style="color:green"></i> Excel </a>

                <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
                <i class="fa fa-file-word-o text-blue" style="color:blue"></i> Word </a>

                <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
                <i class="fa fa-print text-light-blue" style="color:default"></i> Print </a>
                </div>
                <div class="clearfix"></div>
                    @include('exam_management.table')
                    
           {{-- <form action="{{route('admissions.store')}}" method="post" enctype="multipart/form-data"> --}}
                    <!-- @csrf -->
              
                 @include('exam_management.admindefault.examCreate')
                  {!! Form::close() !!}
            </div>
        <div class="text-center">
          
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

  @endsection

