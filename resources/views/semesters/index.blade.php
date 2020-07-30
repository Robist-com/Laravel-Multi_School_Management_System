@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-right">
           <a data-toggle="modal" data-target="#semester-show" class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px"><i class="fa fa-plus-circle"> Add New Grade</i> </a>
        </h1>

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
<i class="fa fa-gear">Grades</i></h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
    <div class="pull-right">
    <a href="{{url('pdf-download-semester')}}" class="btn btn  btn-x"> 
    <i class="fa fa-file-pdf-o text-red" style="color:white"></i> PDF </a>

    <a href="{{url('export-excel-xlsx-courses')}}" class="btn btn  btn-x"> 
    <i class="fa fa-file-excel-o text-green" style="color:white"></i> Excel </a>

    <a href="{{url('pdf-download-class-schedule')}}" class="btn btn  btn-x"> 
    <i class="fa fa-file-word-o text-blue" style="color:white"></i> Word </a>

    <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
    <i class="fa fa-print text-light-blue" style="color:white"></i> Print </a>
    </div>
    <div class="clearfix"></div>
<div class="table-responsive">

                    @include('semesters.table')
                    </div>
                    {!! Form::open(['route' => 'semesters.store']) !!}

                    @include('semesters.fields')

                    {!! Form::close() !!}

            </div>
        </div>
        @include('semesters.degrees.degree')
        @include('semesters.semester_fields')
        <div class="text-center">
        
        </div>
    </div>


    @include('semesters.in-active')

@endsection

