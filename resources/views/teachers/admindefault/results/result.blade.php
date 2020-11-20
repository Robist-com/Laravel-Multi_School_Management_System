@extends('layouts.new-layouts.app')

@section('content')


<div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="page-title">
              <div class="title_left">
                <h2> RESULT CARD</h2>
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

    <div class="content">

            <div class="clearfix"></div>
            <div class="x_panel">
                  <div class="x_title">
                  <div class="btn-group">
                    <button type="button" class="btn btn-dark btn-round">SELECT CLASS</button>
                    <button type="button" class="btn btn-dark btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                    @foreach($class_assign1 as $grade) 
                    <li>
                    <a data-toggle="tooltip" title="Click {{$grade->class_name}} to view result card" data-placement="right" class="dropdown-item" href="{{url('teacher/gradesheet', $grade->class_code)}}">
                    <label for=""  class="active"> {{$grade->semester_name}} </label> | {{$grade->class_name}}
                    </a></li>
                    @endforeach
                    </ul>
                    </div>
                        <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" data-toggle="tooltip" title=" show collapse"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!-- <li><button class="btn btn-box-tool " data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button></li> -->
                      <a href="{{url('get/mark/list')}}" class="btn btn-dark btn-round" data-toggle="tooltip" data-placement="left" title="Refresh"><i class="fa fa-arrow-circle-left" aria-hidden="true"> back</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                <div  id="wait"></div>
                    <!-- Split button -->
              
                    <h2 > @foreach ($class_assign as $n => $result) <b style="font-weight:bold; color:red">{{$result->semester_name}}</b> | {{$result->class_name}} @endforeach</h2>
                
                @if(count($isGenerated) > 0)
                @include('teachers.results.table')
                @endif

                </div>
            </div>
            <div class="text-center">
            @include('flash::message')
        @include('adminlte-templates::common.errors')
            </div>
        </div>
        </div>


@endsection
