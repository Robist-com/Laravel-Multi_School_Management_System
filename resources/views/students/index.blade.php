@extends('layouts.master')


@section('content')
    <section class="content-header">
        <h1 class="pull-left">Roles</h1>
        <h1 class="pull-right">
           <a type="button" data-toggle="modal" data-target="#modal-role" class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" >Add Role</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
      @if($message = Session::get('success'))
      <div class="alert-success">
        <p>{{$message}}</p>
      </div>
      @endif
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            @include('roles.table')
            </div>
        </div>
        <div class="text-center">

      
        </div>
    </div>

<!-- ------------------------------------ ADD NEW STUDENT MODAL -------------------------------------- -->
<div class="modal modal-primary fade" id="modal-role">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Primary Modal</h4>
              </div>
              <div class="modal-body">
               <form action="{{ route('roles.store') }}" method="post">
               @csrf
               <div class="box-body">
              <div class="input-group">
                <span class="input-group-addon">Role Name</span>
                <input type="text" class="form-control" name="name" placeholder="Enter Role Name Here">
              </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline">Save Role</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


@endsection

