@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-right">
           <a data-toggle="modal" data-target="#teacher-add-modal" 
           class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px">
           <span class="fa fa-plus">Add New Teacher</span> </a>
        </h1>
<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
<i class="fa fa-id-badge" aria-hidden="true">Teachers</i></h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>
    </section>
    <div class="content">
        <div class="clearfix"></div>

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
            <h3 style="font-weight:bold;"><i class="fa fa-user" aria-hidden="true"></i> MANAGE TEACHERS</h3>
          
    <div class="clearfix"></div>
    <div class="panel"></div>
          <div class="panel-body" style="border:0px solid">
        <div class="col-md-4">
        <label for="" class="fa fa-search text-red"> </label> <span style="font-size:13px; margin-left:35px"> Filter by Roll</span>
            <div class="form-group">
            <input type="text" name="roll_no" id="roll_no" class="form-control" placeholder="Enter Roll No.">
            </div>
        </div>

        <div class="col-md-4">
        <label for="" class="fa fa-search text-red"> </label> <span style="font-size:13px; margin-left:100px"> Filter by Grade & Class</span>
       <div class="input-group ">
       <select name="semester_id" id="semester_id" class="form-control select_2_single">
            <option value="" selected="true">Select Class</option>
            </select>
           <div class="input-group-addon">and</div>
           <select name="class_code" id="class_code" class="form-control select_2_single">
                <option value="" selected="true">Select Class</option>
           
            </select>
       </div>
      </div>
        <!-- <div class="col-md-4">
        <label for="" class="fa fa-search text-red"> </label> <span style="font-size:13px; margin-left:100px"> Filter by Date Range</span>
       <div class="input-group input-daterange">
           <input type="text" name="from_date" id="from_date" readonly class="form-control" />
           <div class="input-group-addon">to</div>
           <input type="text"  name="to_date" id="to_date" readonly class="form-control" />
       </div>
      </div> -->
      <div class="col-md-2">
      <label for="">Filter</label>
      <div class="form-group">
       <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
       </div>
       </div>
    </div>
    </div>
    <br>

  <div class="clearfix"></div>

                    @include('teachers.table')
                    @include('teachers.excel')
                    
                    {{-- {!! Form::open(['route' => 'teachers.store']) !!} --}}
            <form action="{{route('teachers.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                     @include('teachers.fields')

            </form>
            <!-- </div> -->
        <!-- </div> -->
        <div class="text-center">
        
        </div>
@endsection



@section('scripts')


<script>




</script>

@endsection
