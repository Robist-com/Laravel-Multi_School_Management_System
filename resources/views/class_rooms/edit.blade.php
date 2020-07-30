@extends('layouts.app')

@section('content')
    <section class="content-header">
    <h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px">
    <i class="fa fa-id-sun-o" aria-hidden="true"> Class Rooms</i></h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
     
     {!! Form::model($classRoom, ['route' => ['classRooms.update', $classRoom->classroom_id], 'method' => 'patch']) !!}
    <div class="modal-body">
       <div class="">
       {!! Form::text('classroom_name', null, ['class' => 'form-control','placeholder'=>'Enter ClassRoom']) !!}
       </div>
       <br>
       <div class="">
       {!! Form::text('classroom_code', null, ['class' => 'form-control','placeholder'=>'Enter Code']) !!}
       </div>
       <br>
       <div class="">
       {!! Form::textarea('classroom_description', null, ['class' => 'form-control','placeholder'=>'Enter Description','rows' => '2']) !!}
       </div>
       <br>
        <!-- Status Field -->
        <div class=" col-sm-6">
                    <div class=" col-sm-1" name="classroom_status" id="status1">
                    <label class="container1">status
                    {!! Form::hidden('classroom_status', 0) !!}
                    {!! Form::checkbox('classroom_status', '1', null) !!}
                        <span class="checkmark"></span>
                    </label>
                    </div>   
                </div>
      </div>
      <div class="modal-footer">
        <a href="{{route('classRooms.index')}}"><button  type="button" class="btn btn-warning" data-dismiss="modal">Close</button></a>
        {!! Form::submit('Update ClassRoom', ['class' => 'btn btn-success btn-sm']) !!}
      </div>
      </div>
        <div class="text-center">
        
        </div>
        </div>
        </div>
@endsection