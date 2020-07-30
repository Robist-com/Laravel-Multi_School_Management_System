{{-- @include('class_schedules.show') --}}
@extends('layouts.app')
@include('table_style')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Academic Information System| (AIS)</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    @yield('css')
</head>

    

<!-- {{--------------------------------------------------}} -->
<!-- <div class="panel panel-default">
                    <div class="panel-heading">Class information</div>
                    <div class="panel-body" id="add-class-info">
                    
                    </div>
                </div> -->
<div class="table-responsive">
 <table class="table" id="classSchedules-table" >
    <thead>
        <tr>
            <th rowspan="1">Class</th>
            <th rowspan="2">Course</th>
            <th rowspan="2">Semester</th> 
            <th rowspan="2"style="text-align: center; background:#ccc">Days</th>
            <th rowspan="1"style="text-align: center; background:#ccc">Room</th>
            <th rowspan="2"style="text-align: center; background:#ccc">Date</th>
            <th rowspan="2"style="text-align: center; background:#ccc">Status</th>
            <!-- <th rowspan="2"style="text-align: center; background:#ccc">Date</th> -->

            <th colspan="3">Action</th>
        </tr>

    </thead>
    <tbody>
    @foreach($classSchedule as $key => $classSchedule)
<tr>
<td class="col-md-2" style="padding-top:70px;">{!! $classSchedule->class_name !!}</td>

<td>
    <div class="top_row">
        <div>{!! $classSchedule->course_name !!}</div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classSchedule->level !!}</i>
        </div>
 </td>

<td>
    <div class="top_row">
        <div>{!! $classSchedule->semester_name!!}</div>
        <!-- <div>World</div> -->
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classSchedule->batch !!}</i>
        </div>
 </td>


 <td>
    <div class="top_row">
        <div><i class="badge badge-success">{!! $classSchedule->name !!}</i></div>
        <div><i class="badge badge-success"> {!! $classSchedule->time !!}</i> </div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classSchedule->shift !!}</i>
        </div>
 </td>

<td> 
<i class="badge badge-success">{!! $classSchedule->classroom_name !!}</i> 
<i class="badge badge-success">{!! $classSchedule->classroom_code !!}</i> 
</td>

<td> 
<div class="top_row">
Start <i class="badge badge-success">{!! date("d-M-Y", strtotime($classSchedule->start_date))!!}</i> 
</div>
<div class="top_row">
End <i class="badge badge-success">{!! date("d-M-Y", strtotime($classSchedule->end_date))!!}</i>
</div>
</td>

<td style="text-align:center">
        <input type="checkbox" data-id="{{ $classSchedule->Scheduleid }}" name="status" 
        class="js-switch" {{ $classSchedule->schedule_status == 1 ? 'checked' : '' }}>
 </td>

                <td colspan="3">
                    {!! Form::open(['route' => ['classSchedules.destroy', $classSchedule->Scheduleid], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-class-schedule-single', [$classSchedule->Scheduleid]) !!} " target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                           <!-- ----------------------- View Button---------------- -->
                        <a type="button" href="#" data-toggle="modal" data-target="#Viewclassschedule-show" 
                        data-scheduleid="{{$classSchedule->Scheduleid}}" 
                        data-course_id="{!! $classSchedule->course_name !!}" 
                        data-class_id="{!! $classSchedule->class_name !!}" 
                        data-level_id="{!! $classSchedule->level !!}"
                        data-shift_id="{!! $classSchedule->shift !!}" 
                        data-classroom_id="{!! $classSchedule->classroom_name !!}"
                        data-batch_id="{!! $classSchedule->batch !!}"
                        data-time_id="{!! $classSchedule->time !!}"
                        data-day_id="{!! $classSchedule->name !!}" 
                        data-semester_id="{!! $classSchedule->semester_name !!}"
                        data-start_date="{!! $classSchedule->start_date !!}"
                        data-end_date="{!! $classSchedule->end_date !!}"
                        data-status="{!! $classSchedule->status !!}"
                        class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <!-- ---------------Edit button-------------- -->
                        <a data-toggle="modal" data-target="#Editclassschedule-show" id="Edit" data-id="{{$classSchedule->Scheduleid}}"  class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            <!-- --------------------- Delete Button ------------------ -->
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

 <!-- jQuery 3.1.1 -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select_2_single').select2({width: '100%', hight: '100%'});
});

$(document).ready(function() {
    $('.select_2_multiple').select2();
});

$(".js-example-responsive").select2({
    width: 'resolve',
    height: 'resolve' // need to override the changed default
});

let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'medium' });
});

$(document).ready(function() {
    alert(1)
});


</script>

</body>
</html>
 

