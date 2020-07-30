@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Shift
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($shift, ['route' => ['shifts.update', $shift->shift_id], 'method' => 'patch']) !!}

                        <!-- Shift Field -->
                    <div class="form-group col-sm-6">
                    <span class="input-group-addon">Shift </span>
                        {!! Form::text('shift', null, ['class' => 'form-control','placeholder'=>'Enter Shift']) !!}
                    </div>

                </div>
                <div class="modal-footer">
                    {!! Form::submit('Update Shift', ['class' => 'btn btn-info']) !!}
                </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection