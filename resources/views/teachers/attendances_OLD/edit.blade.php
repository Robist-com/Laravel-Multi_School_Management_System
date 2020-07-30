@extends('layouts.app')

@php
    $class_name
@endphp
@section('content')
<div class="col-md-3 pull-right" style="height:20% !important" >
    @include('flash::message')

    @include('adminlte-templates::common.errors')
</div>
    <section class="content-header">
        <h1>
            Attendance

            @if (isset($class_name))
            <a href="{{route('AttendanceList',$class_name->teacher_id)}}"><button class="pull-right"  title="Back to Attendance List">Back</button></a>
            @endif
        </h1>
   </section>



   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                {{-- {{$class_name}} --}}
                @include('teachers.attendances.edit_attendance')


               </div>
           </div>
       </div>
   </div>
@endsection
