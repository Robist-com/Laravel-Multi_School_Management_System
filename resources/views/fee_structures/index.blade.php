@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-right">
           <a class="btn btn-warning pull-right" data-toggle="modal" data-target="#feestructure-modal" style="margin-top: -10px;margin-bottom: 5px" href="#"><i class="fa fa-plus"></i></a>
        </h1>

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px; font-weight:bold">Add New Fee Structure</h1>
<!-- <h1 style=""><i class="fa fa-money"></i> FEE STRUCTURE</h1> -->

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
                    @include('fee_structures.table')
            </div>
        </div>
        <div class="">
            {!! Form::open(['route' => 'feeStructures.store']) !!}

            @include('fee_structures.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection

