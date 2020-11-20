@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Semester
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($semester, ['route' => ['semesters.update', $semester->semester_id], 'method' => 'patch']) !!}
<!--                                   THIS SEMESTER_ID WAS THE ERROR AND I JUST RESET THE SERVER AND ITS WORK PERFECT  -->
                        <!-- Semester Name Field -->
                    <div class="form-group">
                        {!! Form::text('semester_name', null, ['class' => 'form-control','placeholder'=>'Enter Semester Name']) !!}
                    </div>

                    <!-- Semester Code Field -->
                    <div class="form-group">
                        {!! Form::text('semester_code', null, ['class' => 'form-control','placeholder'=>'Enter Semester Code']) !!}
                    </div>

                    <!-- Semester Duration Field -->
                    <div class="form-group">
                        {!! Form::text('semester_duration', null, ['class' => 'form-control', 'placeholder'=>'Enter Semester Duration']) !!}
                    </div>

                  <!-- Semester Description Field -->
                    <div class="form-group">
                        {!! Form::textarea('semester_description', null, ['class' => 'form-control','cols' => 40 , 'rows' => 2, 'placeholder'=>'Enter Semester Description']) !!}
                    </div>

                    <!-- Submit Field -->
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    {!! Form::submit('Create Semester', ['class' => 'btn btn-success']) !!}
                    </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection