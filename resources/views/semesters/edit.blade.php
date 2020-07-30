@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Update Grade
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
              
                   {!! Form::model($semester, ['route' => ['semesters.update', $semester->id], 'method' => 'patch']) !!}

                    <!-- <div class="form-group"> -->
                    <div class="col-md-6">
               <!-- </div> -->
                        {!! Form::text('semester_name', null, ['class' => 'form-control','placeholder'=>'Enter Semester Name']) !!}
                    </div>

                    <!-- Semester Code Field -->
                    <div class="col-md-6">
                        {!! Form::text('semester_code', null, ['class' => 'form-control','placeholder'=>'Enter Semester Code']) !!}
                    </div>
    <br><br><br>
                    <!-- Semester Duration Field -->
                    <div class="col-md-6">
                        {!! Form::text('semester_duration', null, ['class' => 'form-control', 'placeholder'=>'Enter Semester Duration']) !!}
                    </div>

                  <!-- Semester Description Field -->
                    <div class="col-md-6">
                        {!! Form::textarea('semester_description', null, ['class' => 'form-control','cols' => 40 , 'rows' => 2, 'placeholder'=>'Enter Semester Description']) !!}
                    </div>

                    <!-- <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div> -->

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
                    <a href="{!! route('semesters.index') !!}"><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></a>
                    {!! Form::submit('Update Grade', ['class' => 'btn btn-success']) !!}
                    </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection