@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Department
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($department, ['route' => ['departments.update', $department->department_id], 'method' => 'patch']) !!}

                   <div class="modal-body">

<!-- Faculty Id Field -->
<div class="form-group" >
<select name="faculty_id" id="faculty_id" class="form-control select_2_single" id="select_2_single">
<option value="0" selected="true" disabled="true" style="margin-right:20px">Choose Faculty</option>
@foreach($faculties as $key => $faculty)
<option value="{{$faculty->faculty_id}}" {{$faculty->faculty_id == $department->faculty_id ? 'selected' : ''}}>{{$faculty->faculty_name}}</option>
@endforeach
</select>
</div>

<!-- Department name Field -->
<div class="form-group">
{!! Form::text('department_name', null, ['class' => 'form-control border', 'placeholder' => 'Enter Department Name']) !!}
</div>
<!-- Department code Field -->
<div class="form-group">
{!! Form::text('department_code', null, ['class' => 'form-control border', 'placeholder' => 'Enter Department Code']) !!}
</div>

<!-- Department Description Field -->
<div class="form-group">
{!! Form::textarea('department_description', null, ['class' => 'form-control border', 'cols' => 40, 'rows' =>2, 'placeholder'=> 'Department Description']) !!}
</div>

<!-- Department Status Field -->
<div class="form-group col-md-6 ">
{!! Form::label('department_status', 'Status:') !!}
<label class="checkbox-inline">
{!! Form::hidden('department_status', 0) !!}
{!! Form::checkbox('department_status', '1', null) !!} 1
</label>
</div>
<!-- Submit Field -->
</div>
<div class="modal-footer">
<a href="{{route('departments.index')}}"><button data-dismiss="modal" class="btn btn-danger" type="button">Close</button></a>
{!! Form::submit('Update Class Group', ['class' => 'btn btn-success']) !!}
</div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection