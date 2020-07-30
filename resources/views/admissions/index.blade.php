@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-right">
           <a data-toggle="modal" data-target="#admission-add-modal" class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" ><i class="fa fa-plus-circle"> Add New Admission</i></a>
        </h1>
      
<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-text-o" aria-hidden="true">Admissions</i></h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

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
            <h3 style="font-weight:bold;"><i class="fa fa-user" aria-hidden="true"></i> STUDENT ADMISSIONS</h3>
          
    <div class="clearfix"></div>
                    @include('admissions.table')

                {{-- {!! Form::open(['route' => 'admissions.store']) !!} --}}
            <form action="{{route('admissions.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                  @include('admissions.fields')

                  {!! Form::close() !!}
            </div>
        </div>
        <div class="text-center">
          
        </div>
    </div>


  @endsection

