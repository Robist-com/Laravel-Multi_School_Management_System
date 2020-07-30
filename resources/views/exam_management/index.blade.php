@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="pull-right">
           <a data-toggle="modal" data-target="#generatePaper-show" class="btn btn-warning pull-right" style="margin-top: -10px;margin-bottom: 5px" ><i class="fa fa-plus-circle"></i></a>
        </h1>
      
<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-text-o" aria-hidden="true">Exam Papers List</i></h1>

    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        @include('flash::message')

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
                    @include('exam_management.table')
                    
           {{-- <form action="{{route('admissions.store')}}" method="post" enctype="multipart/form-data"> --}}
                    <!-- @csrf -->
                 @include('exam_management.generate_exam_paper')
                 {{--@include('exam_management.generatePaper')--}}
                 @include('exam_management.question')
                 @include('exam_management.examCreate')
                  {!! Form::close() !!}
            </div>
        <div class="text-center">
          
        </div>
    <!-- </div> -->

    {{-- @include('exam_management.script') --}}

  @endsection

