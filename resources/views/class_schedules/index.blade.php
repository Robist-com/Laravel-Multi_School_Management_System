@extends('layouts.app')
@section('content')
    <section class="content-header">

        <h1 class="pull-right">
           <a data-toggle="modal" data-target="#classschedule-show" 
           class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px">Create New ClassSchedule</a>
            <!-- <a href="" data-toggle="modal" data-target="#" ></a> -->
        </h1>
<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
<i class="fa fa-id" aria-hidden="true">Add New Class Schedule</i></h1>   
<a href="{{url('home')}}" class="pull-lft" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
<button class="btn btn-danger btn-sm">Return</button></a>   
    </section>
<style>
td{
    border-style:none;
}
</style>


    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors') 
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
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
                @include('class_schedules.edit');
           
                    <!-- so here we need to include the field file here okay so that our id 
                    can able to see the modal okay. -->
                    {!! Form::open(['route' => 'classSchedules.store']) !!}

                    @include('class_schedules.fields')

                    {!! Form::close() !!}
                    
                @include('class_schedules.table');
                    
            </div>
        </div>
        <div class="box-body">
            {{-- @include('class_schedules.table'); --}}
        
        </div>
    </div>
   
@endsection

@section('scripts')

<script>
$(document).ready(function(){
    alert('hello')
})
             function showClassInfo()
            {
                var data = $('#frm-create-class').serialize();
                $.get("{{ route('showClassInformation')}}",data,function(data){
                      $('#add-class-info').empty().append(data);
                     MergeCommonRows($('#table-class-info'));
                 })
            }
</script>

@endsection