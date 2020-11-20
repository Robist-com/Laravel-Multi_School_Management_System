


<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

<div class="clearfix"></div>

@include('flash::message')
@include('adminlte-templates::common.errors')

            @include('class_schedules.admindefault.edit')
           
           <!-- so here we need to include the field file here okay so that our id 
           can able to see the modal okay. -->
           {!! Form::open(['route' => 'classSchedules.store']) !!}

           @include('class_schedules.admindefault.fields')

           {!! Form::close() !!}
           
       @include('class_schedules.admindefault.table')

@else

@include('flash::message')
@include('adminlte-templates::common.errors')

@include('class_schedules.adminbsb.edit')
           
           <!-- so here we need to include the field file here okay so that our id 
           can able to see the modal okay. -->
           {!! Form::open(['route' => 'classSchedules.store']) !!}

           @include('class_schedules.adminbsb.fields')

           {!! Form::close() !!}
           
       @include('class_schedules.adminbsb.table')

@endif

@endsection