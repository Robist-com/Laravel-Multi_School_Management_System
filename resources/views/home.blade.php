@php
use App\Models\ClassSchedule;
$teacher_id = Auth::user()->teacher_id;
$teacherclass = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->select('semesters.id as semester_id','semesters.*','courses.*',
            'classes.id as class_id','classes.*')
        ->where(['teacher_id' =>  $teacher_id])
        ->first();

@endphp


@extends('layouts.app')

@section('content')

@if(Auth::user()->role_id == 1)
@include('admins.admin_dashboard')

@else

@if($teacherclass) 
@include('teachers.teacher_dashboard')

@else

<div class="alert alert-warning" style="text-align:center"><h1>You are yet to assigned to a class!</h1><br>we will assign you to a class soon</div>

@endif

@endif
@endsection
