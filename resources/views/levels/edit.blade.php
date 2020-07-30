@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Level
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($level, ['route' => ['levels.update', $level->id], 'method' => 'patch']) !!}

                      
                       <!-- Level Field -->
<div class="form-group col-md-6">
<span class="input-group-addon">level</span>
    {!! Form::text('level', null, ['class' => 'form-control', 'placeholder' => 'Enter Level Here']) !!}
</div>

<!-- Course Id Field -->
<div class="form-group col-md-6">
<span class="input-group-addon">Coursees</span>

    <select name="course_id" id="course_id" class="form-control">
    <option value="">Select Course</option>
    @foreach($course as $key => $cour)
    <option value="{{$cour->id}}" {{$cour->id == $level->course_id ? 'selected' : ''}} >{{$cour->course_name}}</option>
    @endforeach
    </select>
</div>
<!-- Level Description Field -->
<div class="form-group col-md-12">
<span class="input-group-addon">Level Description</span>
    {!! Form::textarea('level_description', null, ['class' => 'form-control', 'cols' => 40, 'rows' =>2, 'placeholder'=> 'Level Description']) !!}
</div>


<!-- Status Field -->
<div class="form-group  col-sm-2">
<label class="checkbox-inline">
{!! Form::hidden('status', 'off') !!}
{!! Form::checkbox('status', 'on', null) !!} Status
</label>
</div>

<!-- Submit Field -->
</div>
<div class="modal-footer">
 
 <a href="{{route('levels.index')}}">{!! Form::button('Back', ['class' => 'btn btn-info']) !!}</a>
 {!! Form::submit('Update Level', ['class' => 'btn btn-info']) !!}
</div>
</form>
 </div>
</div>
</div>


                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection