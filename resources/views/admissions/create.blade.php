<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


{!! Form::open(['route' => 'admissions.store']) !!}

@if($template->template == '0')

@include('admissions.fields')

{!! Form::close() !!}
@else

@include('admissions.fields1')

@endif



@endsection