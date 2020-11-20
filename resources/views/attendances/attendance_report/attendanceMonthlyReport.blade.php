<!DOCTYPE html>
<html lang="en">
<head>

@php 
use App\Institute;
use App\Models\Classes;
$institute=Institute::select('*')->first();

$classInfo = Classes::where('class_code')->first();

@endphp

    <meta charset="utf-8">
    <title>Monthly Attendance Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- The styles -->
    <link id="bs-css" href="{{url('')}}/css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="{{url('')}}/css/charisma-app.css" rel="stylesheet">
    <style>
        @media print
        {
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
        #footer
        {

            width:100%;
            height:50px;
            position:absolute;
            bottom:0;
            left:0;
        }
        .logo
        {
            height:80px;
            width: 100px;
        }
        #attendanceList{
            font-size: 11px;
            font-weight: bold;
        }
        #attendanceList th,#attendanceList td{
            text-align: center;
        }
        #attendanceList tr td{
            padding: 2px;
        }
        body {
            -webkit-print-color-adjust: exact;
            padding: 0;
            margin: 0;
        }
        .rInfo{
            padding-right: 10px;
        }

    </style>
</head>
<body>
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<a  class="btn btn-danger no-print" href="/teacher-attendance/list"><i class=""></i>Back</a>--}}
    {{--</div>--}}
    {{--</div>--}}

<div id="printableArea">
    <div class="row text-center">

        <div class="col-md-1 col-sm-1">
           
            <img class="logo" src="{{ asset('institute_logo/' .$institute->image) }}">

        </div>
        <div class="col-md-11 col-sm-11">
           
            <h4><strong>{{$institute->name}}</strong></h4>
            <h5><strong>Establish:</strong> {{$institute->establish}}  <strong>Web:</strong> {{$institute->web}}  <strong>Email:</strong> {{$institute->email}}</h5>
            <h5><strong>Phone:</strong> {{$institute->phoneNo}} <strong>Address:</strong> {{$institute->address}}</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <h5>
                <strong>Monthly Attendance Report</strong>
            </h5>
            <h6>
                <span class="rInfo"><strong>Class: </strong> </span> 
                <span class="rInfo"><strong>Session: </strong> </span>
                <span class="rInfo"><strong>Section: </strong> </span>
                <!--<span class="rInfo"><strong>Shift: </strong> {{$shift}}</span>-->
            </h6>
            <h6><strong>Month: </strong> {{date('F,Y',strtotime($yearMonth))}}</h6>
        </div>
    </div>
        <div class="">
          
            <p>Print Date: {{date('d/m/Y')}}</p>
        </div>


</div>

</div>
<script src="{{url('')}}/bower_components/jquery/jquery.min.js"></script>
<script src="{{url('')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    $( document ).ready(function() {
        window.print();
    });
</script>
</body>
</html>
