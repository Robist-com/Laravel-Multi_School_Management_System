<?php $url = Request::is('get-class-attendance/*');?>

<h2><i class="fa fa-calendar"> ENTER EXAM MARKS</i> </h2>
<div class="page-title">
    <ol class="breadcrumb breadcrumb-bg-teal align-right">
        <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
        <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                Return</a></li>
    </ol>
    <!-- <a href="{{route('shifts.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a> -->
</div>
<br><br>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Enter Marks
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

                <!-- <div class="clearfix"></div>
                <div class="x_panel">
                    <div class="x_title"> -->

                        <h2>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="session">Session</label>
                                    <select id="session" name="batch_id" class="form-control bootstrap-select"
                                        required="true">
                                        <option value="" selected disabled>--Select--</option>
                                        @foreach($batches as $batch)
                                        <option value="{{$batch->id}}" @if($batch->is_current_batch == 1) selected
                                            @endif>{{$batch->batch}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </h2>

                        <!-- <div class="clearfix"></div>
                    </div> -->

                    <!-- <div class="x_content"> -->
                        <div id="wait"></div>
                        <form role="form" action="{{url('teacher/mark/list')}}" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-md-12 col-sm-6 col-xs-12">

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="class">Class</label>

                                            <select id="class" id="class" name="class" required="true"
                                                class="form-control bootstrap-select">
                                                <option value="" selected>-- Select --</option>
                                                @foreach($classes as $class)
                                                <option value="{{$class->class_code}}" @if($class->class_code ==
                                                    request('class')) selected @endif>{{$class->class_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="department">Department</label>
                                            <select name="department" id="department"
                                                class='form-control bootstrap-select'></select>
                                            <option value=" {{request('department')}} " @if(request('department'))
                                                selected @endif></option>
                                        </div>
                                    </div>

                                    <input type="hidden" value="Morning" name="shift">
                                    <!-- <input type="hidden" value="{{request('batch_id')}}" name="batch"> -->
                                    <input type="hidden" name="batch" id="session_value" value="">

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="subject">Course</label>
                                            <select id="subject" name="subject" required="true"
                                                class="form-control bootstrap-select">
                                                <option value=" {{request('subject')}} " @if(request('subject'))
                                                    selected @endif></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="exam">Examination</label>
                                            <select id="exam" name="exam" required="true"
                                                class="form-control bootstrap-select">
                                                <option value=" {{request('exam')}} " @if(request('exam')) selected
                                                    @endif></option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn bg-teal btn-round pull-right style" type="submit"><i
                                            class="glyphicon glyphicon-th"></i>Get List</button>
                                </div>

                        </form>
                        <!-- </div> -->
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="text-center">
                            @include('teachers.adminbsb.mark_management.test')

                        </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
    <script src="/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">

//  Exportable table
$('.js-exportable').DataTable({
    dom: 'Bfrtip',
    responsive: true,
   
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print',
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


    var getSubjects = function() {
        var val = $('#class').val();

        // alert(val);
        $.ajax({
            url: "{{url('/class/getcourses')}}" + '/' + val,
            type: 'get',
            dataType: 'json',
            success: function(json) {


                $('#subject').empty();
                $('#subject').append($('<option>').text("--Select Subject--").attr('value', ""));
                $.each(json, function(i, subject) {
                    console.log(subject);

                    $('#subject').append($('<option>').text(subject.course_name).attr('value',
                        subject.course_code));
                });
            }
        });
    };

    function getdepartment() {
        var aclass = $('#class').val();
        var batch = $('#batch').val();
        // alert(aclass);
        $.ajax({
            url: "{{url('/department/getList')}}" + '/' + aclass + '/' + batch,
            data: {
                format: 'json'
            },
            error: function(error) {
                //alert("Please fill all inputs correctly!");
            },
            dataType: 'json',
            success: function(data) {
                $('#department').empty();
                // $('#section').append($('<option>').text("--Select Section--").attr('value',""));
                $.each(data, function(i, department) {
                    //console.log(student);


                    //var opt="<option value='"+section.id+"'>"+section.name + " </option>"
                    // var opt="<option value='"+section.id+"'>"+section.name +' (  ' + section.students +' ) '+ "</option>"
                    var opt = "<option value='" + department.department_id + "'>" + department
                        .department_name + ' (  ' + department.students + ' ) ' + "</option>"

                    console.log(opt);
                    $('#department').append(opt);

                });
                //console.log(data);

            },
            type: 'GET'
        });
    };

    function getexam() {
        var aclass = $('#class').val();
        // alert(aclass);
        $.ajax({
            url: "{{url('/exam/getList')}}" + '/' + aclass,
            data: {
                format: 'json'
            },
            error: function(error) {
                alert("Please fill all inputs correctly!");
            },
            dataType: 'json',
            success: function(data) {
                $('#exam').empty();
                $('#exam').append($('<option>').text("--Select Exam--").attr('value', ""));
                $.each(data, function(i, exam) {
                    //console.log(student);


                    var opt = "<option value='" + exam.id + "'>" + exam.type + " </option>"


                    //console.log(opt);
                    $('#exam').append(opt);

                });
                //console.log(data);

            },
            type: 'GET'
        });
    };
    $(document).ready(function() {


        $(".datepicker2").datepicker({
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years",
            autoclose: true

        });
        // $('#markList').dataTable({
        //     "sPaginationType": "bootstrap",
        // });
        $('#class').on('change', function(e) {
            getSubjects();
            getdepartment();
            getexam();
        });
        //   getSubjects();
        //   getdepartment();
        //     getexam();

        var sessionvalue = $('#session').val();
        $('#session_value').val(sessionvalue);

        $('#batch').on('change', function() {
            getdepartment();
        });
    });
    </script>
    @stop