@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Class Assigning
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($classAssignings, ['route' => ['classAssignings.update', $classAssignings->id], 'method' => 'patch']) !!}

                    

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection