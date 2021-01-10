<?php
use App\Models\ClassSchedule;
use App\Institute;
$teacher_id = Auth::user()->teacher_id;
$teacherclass = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->select('semesters.id as semester_id','semesters.*','courses.*',
            'classes.id as class_id','classes.*')
        ->where(['teacher_id' =>  $teacher_id])
        ->first();

?>

@extends('layouts.new-layouts.admin_app')


@section('content')

@if (Auth::user()->group == 'Admin')
    
@include('admins.admin_dashboard')

@endif


<?php 



$date = date('d-m-Y');
$current_year = date('Y');
$last_year = date('Y', strtotime("-1 year"));
$year_before_last = date('Y', strtotime("-2 year"));

$current_month = date('F');
$last_month = date('F', strtotime("-1 month"));
$month_before_last_month = date('F', strtotime("-2 month"));
$month_before2_last_month = date('F', strtotime("-3 month"));

?>


<input type="hidden" name="" id="current_month_attendance_present" value="{{$current_month_attendance_present}}">
            <input type="hidden" name="" id="current_month_attendance_absent" value="{{$current_month_attendance_absent}}">
            <input type="hidden" name="" id="current_month_attendance_late" value="{{$current_month_attendance_late}}">
            <input type="hidden" name="" id="current_month_attendance_sick" value="{{$current_month_attendance_sick}}">
            
            <input type="hidden" name="" id="current_year" value="{{$current_year}}">
            <input type="hidden" name="" id="last_year" value="{{$last_year}}">
            <input type="hidden" name="" id="year_before_last" value="{{$year_before_last}}">

            <input type="hidden" name="" id="current_month" value="{{$current_month}}">
            <input type="hidden" name="" id="last_month" value="{{$last_month}}">
            <input type="hidden" name="" id="month_before_last_month" value="{{$month_before_last_month}}">
            <input type="hidden" name="" id="month_before2_last_month" value="{{$month_before2_last_month}}">

            <input type="hidden" name="" id="last_month_attendance" value="{{$last_month_attendance}}">
            <input type="hidden" name="" id="month_before_last_attendance" value="{{$month_before_last_attendance}}">
            <input type="hidden" name="" id="month_before2_last_attendance" value="{{$month_before2_last_attendance}}">

            <input type="hidden" name="" id="last_month_attendance_present" value="{{$last_month_attendance_present}}">
            <input type="hidden" name="" id="last_month_attendance_absent" value="{{$last_month_attendance_absent}}">
            <input type="hidden" name="" id="last_month_attendance_late" value="{{$last_month_attendance_late}}">
            <input type="hidden" name="" id="last_month_attendance_sick" value="{{$last_month_attendance_sick}}">

            <input type="hidden" name="" id="month_before_last_attendance_present" value="{{$month_before_last_attendance_present}}">
            <input type="hidden" name="" id="month_before_last_attendance_absent" value="{{$month_before_last_attendance_absent}}">
            <input type="hidden" name="" id="month_before_last_attendance_late" value="{{$month_before_last_attendance_late}}">
            <input type="hidden" name="" id="month_before_last_attendance_sick" value="{{$month_before_last_attendance_sick}}">

            <input type="hidden" name="" id="month_before2_last_attendance_present" value="{{$month_before2_last_attendance_present}}">
            <input type="hidden" name="" id="month_before2_last_attendance_absent" value="{{$month_before2_last_attendance_absent}}">
            <input type="hidden" name="" id="month_before2_last_attendance_late" value="{{$month_before2_last_attendance_late}}">
            <input type="hidden" name="" id="month_before2_last_attendance_sick" value="{{$month_before2_last_attendance_sick}}">
           
           
            <input type="hidden" name="" id="online_admission" value="{{$online_admission}}">
            <input type="hidden" name="" id="offline_admission" value="{{$offline_admission}}">

            <input type="hidden" name="" id="current_session_repeated_students" value="{{$current_session_repeated_students}}">
            <input type="hidden" name="" id="last_session_repeated_students" value="{{$last_session_repeated_students}}">
            <input type="hidden" name="" id="year_before_last_session_repeated_students" value="{{$year_before_last_session_repeated_students}}">




@endsection

{{-- @endif --}}