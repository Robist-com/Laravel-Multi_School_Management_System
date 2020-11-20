

<?php   $template = App\Institute::where('school_id', auth()->user()->school_id)->first(); ?>

@extends($template->template == '0' ? 'layouts.new-layouts.app' : 'layouts.adminTem.app')

@section('content')

@if($template->template == '0')
@include('admissions.online-admission.online_admission')
@else
@include('admissions.online-admission.online_admissionList1')
@endif

@endsection

