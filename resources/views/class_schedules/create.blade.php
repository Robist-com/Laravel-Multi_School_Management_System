


<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')


@if($template->template == '0')

       @include('class_schedules.admindefault.create')

@else

       @include('class_schedules.adminbsb.create')

@endif

@endsection