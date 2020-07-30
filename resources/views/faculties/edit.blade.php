@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
        Student Group
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($faculty, ['route' => ['faculties.update', $faculty->faculty_id], 'method' => 'patch']) !!}

                   <div class="modal-body">

<!-- Faculty Name Field -->

    {!! Form::text('faculty_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Group Name']) !!}

<br>
<!-- Faculty Code Field -->

    {!! Form::text('faculty_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Group Code']) !!}

<br>
<!-- Faculty Status Field -->
<div class="form-group col-sm-6 pull-left" style="margin-left:30px;" >
    {!! Form::label('faculty_status', 'Group Status:') !!}
    <label class="checkbox-inline" style="margin-left:30px;">
        {!! Form::hidden('faculty_status', 0) !!}
        {!! Form::checkbox('faculty_status', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
</div>
<div class="modal-footer">
 <a href="{{route('faculties.index')}}"> <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></a>
  {!! Form::submit('Update Student Group', ['class' => 'btn btn-success']) !!}
</div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection