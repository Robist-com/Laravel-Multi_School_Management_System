@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-right">
        @if(Auth::user()->role_id == 1)
           <a data-toggle='modal' data-target='#user-add-modal' class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="">Add New User</a>
       @endif
        </h1>

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
<span class="fa fa-u-o">Users</span></h1>
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
            @include('users.table')
        </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>

    <div class="modal fade left" id="user-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-lg modal-right " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
      </div>
      <div class="modal-body">

      {!! Form::open(['route' => 'users.store']) !!}

            @include('users.fields')

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-info">Update Student</button> -->
        {!! Form::submit('Save User', ['class' => 'btn btn-success']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection


