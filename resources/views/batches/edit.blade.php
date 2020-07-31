@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Batch
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($batch, ['route' => ['batches.update', $batch->id], 'method' => 'patch']) !!}

                   <div class="form-group col-md-6">
                    <span class="input-group-addon">Batch Year</span>
                    {!! Form::text('batch', null, ['class' => 'form-control']) !!}
                    </div>
                    </div>
                    <br>
     <div class="form-group" name="is_current_batch">
                    <label class="checkbox-inline">
                    {!! Form::hidden('is_current_batch', '0') !!}
                    {!! Form::checkbox('is_current_batch', '1', null) !!} Is Current Batch
                    </label>
                    </div>
                    
                    <div class="modal-footer">
                        {!! Form::submit('Update Batch', ['class' => 'btn btn-info']) !!}
                    </div>
                     
                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection