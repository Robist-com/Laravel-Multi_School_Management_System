@extends('layouts.new-layouts.app')

@php
    $class_name
@endphp
@section('content')
<!-- <div class="col-md-3 pull-right" style="height:20% !important" > -->
 
   <div class="clearfix"></div>
    <div class="page-title">
    @include('flash::message')

    @include('adminlte-templates::common.errors')

          <div class="title_right1">
            <div class="col-md-3 col-sm-5 col-xs-12 form-group pull-right top_search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>
        </div>
        <?php
        $date = date('d-m-Y');
        $nameOfDay = date('l', strtotime($date));
        echo "<h4 style='color:red; font-weight:bolder;text-transform:uppercase'>$nameOfDay
            <b style='color:black'>Attendance</b></h4>  ";
        ?>
        <div class="clearfix"></div>
        <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
              <h2 style="font-weight:bold;text-transform: uppercase; text-align:left">
             <i class="fa fa-calendar"></i> Update CLASS<b style="color:red">  ATTENDANCE</b>
            </h2>
            <div class="col-md-2 pull-right">
                <input type="button" name="class_name"  id="class_nam" class="btn btn-round btn-dark edit_atten"
                value="{{$edited_date->class_name}}" disabled >
            </div>
            <div class="col-md-2 pull-right">
            <input type="button" name="semester_name"  id="semester_nam" class="btn btn-round btn-dark  edit_atten"
            value="{{$edited_date->semester_name}}" disabled >
            </div>
            
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                @include('teachers.attendances.edit_attendance')


               </div>
           </div>
       </div>
   </div>
@endsection
