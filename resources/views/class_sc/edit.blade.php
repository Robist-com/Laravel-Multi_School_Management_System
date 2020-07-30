@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Class Schedullings
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($classSchedullings, ['route' => ['classSchedullings.update', $classSchedullings->id], 'method' => 'patch']) !!}

                        @include('class_schedullings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection