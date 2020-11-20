@extends('layouts.new-layouts.app')

@section('content')
<section class="content-header">

    <!-- <h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa" aria-hidden="true">HOMEWORK TABLE</i></h1> -->
    <!-- <a  class="pull-left btn btn-danger" href="{{url('send-class-homework')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a> -->

</section>
<style>
.names {
    color: red;
    font-family: 'Times New Roman', Times, serif;
    font-display: bold;
    font-size: large;
}

table {
    border: 0px solid;
    width: 100%;
}

.vl {
    border-left: 6px solid green;
    height: 500px;
    position: absolute;
    left: 50%;
    margin-left: -3px;
    top: 0;
}

h6 {
    display: inline-block
}

h5 {
    display: inline-block
}

.bordered-table {
    border: 1px solid black;
    border-collapse: collapse;
}

.bordered-tr {
    border-left: 1px solid #000;
    border-right: 1px solid #000;
}

.bordered-td {
    border-left: 1px solid black;
    border-right: 1px solid black;
    border-bottom: 1px solid black;
}

.bordered-th {
    border-left: 1px solid #000;
    border-right: 1px solid #000;
    border-bottom: 1px solid black;

    text-align: center;
}
</style>

<?php $url = Request::is('get-class-attendance/*');?>

<h2><i class="fa fa-users"> HOMEWORKS</i> </h2>
<div class="page-title">
    <ol class="breadcrumb breadcrumb-bg-teal align-right">
        <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
        <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                Return</a></li>
    </ol>
</div>
<br><br>
<div class="card">
    <div class="header">
        <h2>
            HOMEWORKS LIST
        </h2>
        <ul class="header-dropdown m-r--5">
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else here</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="body">

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                    <tr class="bordered-tr">
                        <th class="bordered-th">Class</th>
                        <th class="bordered-th">Subject</th>
                        <th class="bordered-th">Body</th>
                        <th class="bordered-th">File</th>
                        <th class="bordered-th">Start</th>
                        <th class="bordered-th">End</th>
                        <th class="bordered-th">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($class_assign) > 0)
                    @foreach ($class_assign as $n => $homework)

                    <tr class="bordered-tr">
                        <td class="bordered-td" style="text-align: center;">{{$homework->class_code}} </td>
                        <td class="bordered-td" style="text-align: center;">{{$homework->course_name}} </td>
                        <td class="bordered-td" style="text-align: center;"> <a title='View submited homeworks'
                                target1="_blank1" data-toggle="tooltip" data-placement="right"
                                class='btn btn-dark btn-round btn-xs'
                                href='{{url("upload-student-homework", $homework->class_code )}}'>
                                <i class="fa fa-external-link-square"></i> {{$homework->body}} </a></td>
                        <td class="bordered-td" style="text-align: center;"><button type="button"
                                class="btn btn-dark btn-round btn-xs accordion-toggle" data-placement="right"
                                data-toggle="collapse" data-target="#demo{{$n}}" title="Click to download"><span
                                    class="fa fa-cloud-download"></span> {{$homework->file}}</button></td>
                        <!-- <td class="bordered-td" style="text-align: center;"><iframe id="myframe{{$n}}"  style="display:none" width="600" height="300" ></iframe><input type="button" title="Click to download" value="{{$homework->file}}" onclick="openPdf()"/><button id="close" onclick="closePdf()"><i class="fa fa-close text-red"></i></button></td> -->
                        <td class="bordered-td" style="text-align: center;">{{$homework->start_date}}</td>
                        <td class="bordered-td" style="text-align: center;">{{$homework->end_date}}</td>

                        <td style="text-align: center;width:112px;">
                            {!! Form::open(['route' => ['homework-delete', $homework->id], 'method' => 'post']) !!}
                            <a title='Edit' data-toggle="tooltip" data-placement="left"
                                class='btn btn-info btn-round btn-xs'
                                href='{{route('homework-edit', $homework->homework_id )}}'> <i
                                    class="glyphicon glyphicon-edit "></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class'
                            => 'btn btn-danger btn-xs btn-round', 'data-toggle' => 'tooltip', 'data-placement'=>
                            'right', 'title'=>'Delete', 'onclick' => "return confirm('Are you sure?')"]) !!}

                            {!! Form::close() !!}
                            <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Print"></i></a> -->
                            <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a> -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" class="hiddenrow">
                            @include('teachers.homework.pdfFile')
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td style="background:#fffff" style="border: none; text-transform:uppercase; text-align:center"
                            text-black>

                            @foreach ($class_assign as $n => $result)
                            <ul class="nav nav-pills" role="tablist" style="text-align:center">
                                <li role="presentation" class="active"><a href="#"> THERE IS NO EXAM RESULT YET FOR
                                        <span class="badge">{{$result->semester_name}}</span></a></li>
                                <li role="presentation"><a href="#">{{$result->class_name}}</a></li>
                            </ul>
                            @endforeach
                        </td>
                        <td style="background:#fffff" style="border: none;"></td>

                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div><br>

</div>
</div>
</div>
</div>

@endsection

@if(count($class_assign) > 0)

@section('js')

<script>
$(document)
//  Exportable table
$('.js-exportable').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});

function closePdf() {

    var omyFrame = document.getElementById("myframe{{$n}}");
    omyFrame.style.display = "none";
    // alert(1);
    omyFrame.src = "{{asset('teacher_homeworks/' .$homework->file)}}";
}

function openPdf() {
    var omyFrame = document.getElementById("myframe{{$n}}");
    omyFrame.style.display = "block";

    // alert(1);
    omyFrame.src = "{{asset('teacher_homeworks/' .$homework->file)}}";
}
</script>

@endsection

@endif