

<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

<div class="clearfix"></div>

@include('flash::message')
@include('adminlte-templates::common.errors')

@include('class_rooms.table')

{!! Form::open(['route' => 'classRooms.store']) !!}

@include('class_rooms.fields')

{!! Form::close() !!}

@else

@include('flash::message')
@include('adminlte-templates::common.errors')

@include('class_rooms.table1')

{!! Form::open(['route' => 'classRooms.store']) !!}

@include('class_rooms.fields')

{!! Form::close() !!}

@endif

@endsection

