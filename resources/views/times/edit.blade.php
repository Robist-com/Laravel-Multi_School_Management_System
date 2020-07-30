@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Time
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
    <div class="modal-body">
    {!! Form::model($time, ['route' => ['times.update', $time->time_id], 'method' => 'patch']) !!}
    <div class="col-md-6">
        <select name="shift_id" id="shift_id" class="form-control select_2_single">
        <option value="" selected disabled>Select Shift</option>
        @foreach ($shifts as $shift)
        <option value="{{$shift->shift_id}}" {{$shift->shift_id == $time->shift_id ? 'selected' : ''}}>{{$shift->shift}}</option>
        @endforeach
        </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="time" id="time_id" class="form-control" value="{{$time->time}}">
    </div>
    </div>
    </div>

    <div class="modal-footer">
    <a href="{{route('times.index')}}"><button data-dismiss="modal" class="btn btn-danger" type="button">Close</button></a>
    {!! Form::submit('Update', ['class' => 'btn btn-success btn-sm']) !!}
    </div>

    {!! Form::close() !!}
</div>
</div>
@endsection

@section('scripts')

        <script type="text/javascript">
        //------------------Date Of Birth Change-----------
        $('#time_id').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false
        })
@endsection