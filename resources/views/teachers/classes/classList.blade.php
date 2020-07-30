@extends('layouts.app')

@section('content')
    <section class="content-header">
        <!-- <h1 class="pull-right">
           <a class="btn btn-warning pull-right" data-toggle="modal" data-target="#faculty-add-modal" style="margin-top: -10px;margin-bottom: 5px" href="#"><i class="fa fa-plus"></i></a>
        </h1> -->
    <h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
    <i class="fa fa-id-sun-o" aria-hidden="true">CLASSES IN CHARGE</i></h1>
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
          
            <div class="clearfix"></div>
            <div class="table-responsive">
<div  id="wait"></div>
    <table class="table table-striped1 table-hover" id="teachers-table">
        <thead>
        <button style="margin-bottom: 10px; display:none" class="btn btn-danger delete_all" data-url="{{ url('delete_multiple_teacher') }}"><i class="fa fa-trash"></i> Delete All Selected</button>
            <b class="btn btn-sm pull-right" id="divoutput"></b>
            <tr>
            <th>Class</th>
            <th>Grade</th>
            </tr>
            </thead>
        <tbody>
        @foreach($allStudentList as $teacher)
            <tr id="tr_{{$teacher->id}}" class="contact">
            <td>{!! $teacher->class_name !!}</td>
            <td>{!! $teacher->semester_name !!}</td>

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

