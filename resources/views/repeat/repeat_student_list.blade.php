@extends('layouts.new-layouts.app')
@section('style')
<link href="{{url('/css/bootstrap-datepicker.css')}}" rel="stylesheet">
@stop
@section('content')

<div class="content">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        @include('flash::message')

        <div class="clearfix"></div>

        <div class="page-title">
              <div class="title_left">
                <h2>Repeated Students List</h2>
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

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{url('home/dashboard2')}}"><button type="submit" class="btn btn-round btn-dark">back</button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

               @if($repeated_students)
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>
                <tr>
                <th class="column-title">Student </th>
                <th class="column-title">Exam </th>
                <th class="column-title">Subject </th>
                <th class="column-title">Class </th>
                <th class="column-title">Status </th>
                <th class="column-title">Grade </th>
                <th class="column-title no-link last"><span class="nobr">Action</span>
                </th>
                </tr>
                </thead>
                <tbody>
                @foreach($repeated_students as $repeat)
                <tr>
                    <td class=" " data-toggle="tooltip" data-placement="top" title="{{$repeat->first_name . ' '  . $repeat->last_name}}">{{$repeat->roll_no}}</td>
                    <td class=" " data-toggle="tooltip" data-placement="top" title="{{$repeat->batch}}">{{$repeat->type}}</td>
                    <td class=" " data-toggle="tooltip" data-placement="top" title="{{$repeat->subject_code}}">{{$repeat->subject_name}}</td>
                    <td class=" " data-toggle="tooltip" data-placement="top" title="{{$repeat->class_code}}">{{$repeat->class_name}}</td>
                    <td class=" text-red" data-toggle="tooltip" data-placement="top" title="student need to repeat {{$repeat->subject_name}} subject to able to promote to next grade!">@if($repeat->grade == 'F') <label class="label label-danger">Fail</label> @endif</td>
                    <td class=" ">{{$repeat->grade_name}}</td>
                    <td>
                    <a href="#" class="btn btn-success btn-xs fa fa-mobile icon-white" data-toggle="tooltip" data-placement="top" title="send notification"></a>
                    <a title='View' class='btn btn-info btn-xs' data-toggle="tooltip" data-placement="top"  href='{{url("/question/edit/$repeat->mark_id")}}'> <i class="glyphicon glyphicon-pencil icon-white"></i></a>&nbsp&nbsp
                    <a title='Delete' class='btn btn-danger btn-xs' data-toggle="tooltip" data-placement="top"  href='{{url("/question/delete/$repeat->mark_id")}}' onclick="return confirm('Are you sure you want to delete ?');"> <i class="glyphicon glyphicon-trash icon-white"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
                </table>
                <!-- </div>
                </div> -->
                @endif
                </div>
                </div>
                </div>
                </div>
                </div>
@endsection