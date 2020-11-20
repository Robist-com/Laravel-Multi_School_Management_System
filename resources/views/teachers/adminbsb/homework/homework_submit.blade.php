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

<h2><i class="fa fa-users"> HOMEWORK SUBMITED LIST</i> </h2>
<div class="page-title">
    <ol class="breadcrumb breadcrumb-bg-teal align-right">
        <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
        <li class="active">
            @if(isset($student_homework))
            <a href="{{url('home')}}" class="" data-toggle="tooltip" data-placement="left" title="Return back"> <i
                    class="material-icons">arrow_back</i>Return</a>
            @else
            <a href="{{url('homework-list')}}" class="" data-toggle="tooltip" data-placement="left" title="Return back">
                <i class="material-icons">arrow_back</i>Return</a>
            @endif
        </li>
    </ol>
</div>
<br><br>
<div class="card">
    <div class="header">
        @if(isset($student_homework))
        <h2>Homeworks</h2>
        @else
        <h2>Homeworks Table</h2>
        @endif
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
        @if(isset($class_assign1))
        <h4 style="text-transform:uppercase; font-weight:bold;">{{$class_assign1->semester_name}} <b
                style="color:red">({{$class_assign1->class_name}})</b></h4>
        @endif

        <h4 style="text-transform:uppercase; font-weight:bold; margin-left:20%;">

            <b>@if(isset($class_assign1)){{$class_assign1->course_name}} @endif</b> homework <b style="color:red">submit
            </b> @if(isset($student_homework)) by @if($class_assign1->gender == 0) mr. {{$class_assign1->last_name}}
            @else mis. {{$class_assign1->last_name}} @endif @else List @endif
        </h4>

        @if(isset($class_assign))
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action" width="100%">
                    <!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" > -->
                    <thead>
                        <tr class="bordered-tr">
                            <th class="bordered-th">Student</th>
                            <th class="bordered-th">Subject</th>
                            <th class="bordered-th">File</th>
                            <th class="bordered-th">Submit Time</th>
                            <th class="bordered-th">Date</th>
                            <th class="bordered-th">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($class_assign) > 0)
                        @foreach ($class_assign as $n => $homework)

                        <tr class="bordered-tr">
                            <td class="bordered-td" style="text-align: center;">{{$homework->first_name}}
                                {{$homework->last_name}} </td>
                            <td class="bordered-td" style="text-align: center;">{{$homework->course_name}} </td>
                            <td class="bordered-td" style="text-align: center;"><button type="button"
                                    class="btn btn-primary btn-xs accordion-toggle" data-toggle="collapse"
                                    data-target="#demo{{$n}}" title="Click to download"><span
                                        class="fa fa-download"></span> {{$homework->file}}</button></td>
                            <td class="bordered-td" style="text-align: center;">
                                {{$homework->created_at->diffForHumans()}}</td>
                            <td class="bordered-td" style="text-align: center;">
                                {{date('d-m-Y ', strtotime($homework->created_at))}}</td>

                            <td style="text-align: center;width:112px;">
                                {!! Form::open(['route' => ['homework-delete', $homework->id], 'method' => 'post']) !!}
                                <a title='Edit' class='btn btn-info btn-sm'
                                    href='{{route('homework-edit', $homework->class_code )}}'> <i
                                        class="glyphicon glyphicon-edit icon-edit"></i></a>
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit',
                                'class' => 'btn btn-danger btn-xs', 'title'=>'Delete', 'onclick' => "return confirm('Are
                                you sure?')"]) !!}

                                {!! Form::close() !!}
                                <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Print"></i></a> -->
                                <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a> -->
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="hiddenrow">
                                @include('teachers.homework.studentSubmitpdfFile')
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td style="background:#fffff"
                                style="border: none; text-transform:uppercase; text-align:center" text-black>

                                @foreach ($class_assign as $n => $result)
                                <ul class="nav nav-pills" role="tablist" style="text-align:center">
                                    <li role="presentation" class="active"><a href="#"> THERE IS NO STUDENT SUBMIT
                                            HOMEWORK YET FOR <span class="badge">{{$result->semester_name}}</span></a>
                                    </li>
                                    <li role="presentation"><a href="#">{{$result->class_name}}</a></li>
                                </ul>
                                @endforeach
                            </td>
                            <td style="background:#fffff" style="border: none;"></td>

                        </tr>
                        @endif
                    </tbody>
                </table>
                @else
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" > -->
                    <thead>
                        <tr class="bordered-tr">
                            <th class="bordered-th">Student</th>
                            <th class="bordered-th">Subject</th>
                            <th class="bordered-th">File</th>
                            <th class="bordered-th">Submit Time</th>
                            <th class="bordered-th">Date</th>
                            <th class="bordered-th">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($student_homework) > 0)
                        @foreach ($student_homework as $n => $homework)

                        <tr class="bordered-tr">
                            <td class="bordered-td" style="text-align: center;">{{$homework->first_name}}
                                {{$homework->last_name}} </td>
                            <td class="bordered-td" style="text-align: center;">{{$homework->course_name}} </td>
                            <td class="bordered-td" style="text-align: center;"><button type="button"
                                    class="btn btn-primary btn-xs accordion-toggle" data-toggle="collapse"
                                    data-target="#demo{{$n}}" title="Click to download"><span
                                        class="fa fa-download"></span> {{$homework->file}}</button></td>
                            <td class="bordered-td" style="text-align: center;">
                                {{$homework->created_at->diffForHumans()}}</td>
                            <td class="bordered-td" style="text-align: center;">
                                {{date('d-m-Y ', strtotime($homework->created_at))}}</td>

                            <td style="text-align: center;width:112px;">
                                {!! Form::open(['route' => ['homework-delete', $homework->id], 'method' => 'post']) !!}
                                <a title='Edit' class='btn btn-info btn-sm'
                                    href='{{route('homework-edit', $homework->class_code )}}'> <i
                                        class="glyphicon glyphicon-edit icon-edit"></i></a>
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit',
                                'class' => 'btn btn-danger btn-xs', 'title'=>'Delete', 'onclick' => "return confirm('Are
                                you sure?')"]) !!}

                                {!! Form::close() !!}
                                <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Print"></i></a> -->
                                <!-- <a href="{{url("/gradesheet/print")}}/{{$homework->roll_no}}/{{$homework->exam}}/{{$homework->class}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a> -->
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="hiddenrow">
                                @include('teachers.homework.studentSubmitpdfFile')
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td style="background:#fffff"
                                style="border: none; text-transform:uppercase; text-align:center" text-black>

                                @foreach ($class_assign as $n => $result)
                                <ul class="nav nav-pills" role="tablist" style="text-align:center">
                                    <li role="presentation" class="active"><a href="#"> THERE IS NO STUDENT SUBMIT
                                            HOMEWORK YET FOR <span class="badge">{{$result->semester_name}}</span></a>
                                    </li>
                                    <li role="presentation"><a href="#">{{$result->class_name}}</a></li>
                                </ul>
                                @endforeach
                            </td>
                            <td style="background:#fffff" style="border: none;"></td>

                        </tr>
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <br>

    </div>

</div>
</div>
</div>
@section('js')

<script>
//  Exportable table
$('.js-exportable').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});

$(document).ready(function() {
    // alert(1)
    var deleteLinks = document.querySelectorAll('#addAttendance');

    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            var choice = confirm(this.getAttribute('data-confirm'));

            if (choice) {
                document.getElementById("attendance_form").submit(); //form id
            }
        });
    }

})

function closePdf() {

    var omyFrame = document.getElementById("myframe");
    omyFrame.style.display = "none";
    // alert(1);

}

function openPdf() {
    var omyFrame = document.getElementById("myframe");
    omyFrame.style.display = "block";

    // alert(1);

}
</script>

@endsection