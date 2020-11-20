@extends('layouts.new-layouts.app')

@section('content')
<!-- 
<section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa" aria-hidden="true">HADLE CLASSES </i></h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>
    </section> -->

     <div class="content">

            <div class="clearfix"></div>
            <div class="clearfix"></div>
    <div class="page-title">

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

        <div class="clearfix"></div>
        <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Homework  </h2>
                <div class="col-md-12 row">
                <div class="btn-group pull-right">
                <div class="col-md-5">
                <label for=""class="label label-success">Create Homework</label>
                </div>
                    <button type="button" class="btn btn-dark btn-round">SELECT CLASS</button>
                    <button type="button" class="btn btn-dark btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                   
                    <ul class="dropdown-menu">
                    @foreach($class_assign1 as $grade) 
                    <li>
                    <a data-toggle="tooltip" data-placement="left" title="{{$grade->class_name}}" class="dropdown-item" href="{{url('send-class-homework', $grade->class_code)}}">
                    <label for=""  class="active">{{$grade->semester_name}} </label> | {{$grade->class_code}}
                    </a></li>
                    @endforeach
                    </ul>
                    </div>
                    </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
              
                    <div class="row">
                    </div>
                    <h3 > @if(isset($class_assign)) @foreach ($class_assign as $n => $result) <b style="font-weight:bold; color:red">{{$result->semester_name}}</b>  <b>{{$result->course_name}}</b> @endforeach  @endif</h3>
                     <a href="{{url('homework-list')}}" data-toggle="tooltip" data-placement="right" title="View homework list"><button class="btn btn-dark btn-round">Homework List</button></a>
                
                </div>
            </div>
            <div class="">

            @if(isset($class_assign))
                @include('teachers.homework.table')
            @endif 

            </div>
        </div>
        </div>
        </div>
        </div>


@endsection
