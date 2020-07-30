@extends('layouts.app')

@section('content')

<section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa" aria-hidden="true">HADLE CLASSES </i></h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>
    </section>

     <div class="content">

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                <h3 style="font-weight:bold"><i class="fa fa-user-o"></i> HANDLE CLASSES</h3>
                <hr class="line">
                    <!-- Split button -->
              <div class="btn-group">
                    <button type="button" class="btn btn-danger">SELECT CLASS</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                    @foreach($class_assign1 as $grade) 
                    <li>
                    <a data-toggle="tooltip" title="{{$grade->class_name}}" class="dropdown-item" href="{{url('send-class-homework', $grade->class_code)}}">
                    <label for=""  class="active">{{$grade->semester_name}} </label> | {{$grade->class_code}}
                    </a></li>
                    @endforeach
                    </ul>
                    </div>
                    <div class="row">
                    </div>
                    <h3 > @if(isset($class_assign)) @foreach ($class_assign as $n => $result) <b style="font-weight:bold; color:red">{{$result->semester_name}}</b>  <b>{{$result->course_name}}</b> @endforeach  @endif</h3>
                     <a href="{{url('homework-list')}}"><button class="btn btn-info">Homework List</button></a>
                
                </div>
            </div>
            <div class="">

            @if(isset($class_assign))
                @include('teachers.homework.table')
            @endif 

            </div>
        </div>


@endsection
