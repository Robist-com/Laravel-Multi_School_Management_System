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
                <div class="clearfix"></div>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group ">
                                    <span for="session" style="font-size:15px">Current Session</span>
                                    <select id="session" name="session" class="form-control bootstrap-select"
                                        required="true">
                                        <option value="" selected disabled>--Select--</option>
                                        {{$batches}}
                                        @foreach(App\Models\Batch::where('school_id', auth()->user()->school_id)->get() as $batch)
                                        <option value="{{$batch->id}}" @if($batch->is_current_batch == 1) selected
                                            @endif>{{$batch->batch}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form role="form" action="{{url('/teacherEnterMarks')}}" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="session" id="session_value" value="">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">

                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="class">Class</label>
                                                        <select id="class" name="class"
                                                            class="form-control bootstrap-select">
                                                            <option value="" selected disabled>--Select--</option>
                                                            @foreach($classes as $class)
                                                            <option value="{{$class->class_code}}"
                                                                @if($class_code==$class->class_code) selected
                                                                @endif>{{$class->class_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="section">Class Group</label>
                                                        <select id="department" name="department"
                                                            class="form-control bootstrap-select">
                                                            <option value="">--Select--</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <input type="hidden" name="shift" value="Morning">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="subject">Courses</label>

                                                        <select id="subject" name="subject"
                                                            class="form-control bootstrap-select" required="true">
                                                            <option value="">--Select--</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="exam">Examination</label>

                                                        <select name="exam" id="exam" required="true"
                                                            class="form-control bootstrap-select">
                                                            <option value="">-Select-</option>
                                                            @if($exams)
                                                            @foreach($exams as $exm)
                                                            <option value="{{$exm->id}}" @if($exm->id==$exam) selected
                                                                @endif>{{$exm->type}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <!-- <div class="panel"> -->
                                        <div class="row">
                                            <div class="col-md-2 col-sm-12 col-xs-12">

                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12 style" style="color:#55555">
                                                <label>Marks</label>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12 style" style="color:#55555">
                                                <label>Theory</label>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12 style" style="color:#55555">
                                                <label>MCQ</label>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12 style" style="color:#55555">
                                                <label>Practical</label>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12 style" style="color:#55555">
                                                <label>Assign</label>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                        <div class="row" style="text-align:center">
                                            <div class="  btn-round col-md-2 label bg-teal  btn-xs style">
                                                <label>Full Marks</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="tfull">0</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="wfull">0</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="mfull" >0</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="pfull">0</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="cfull">0</label>
                                            </div>
                                        </div>
                                        <div class="row" style="text-align:center">
                                            <div class=" btn-round col-md-2 label bg-teal btn-xs style">
                                                <label>Pass Marks</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="tpass">0</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="wpass">0</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="mpass">0</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="ppass">0</label>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label id="cpass">0</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="datatable-responsive" class="table table-bordered table-striped table-hover dataTable js-exportable">

                                <!-- <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"> -->
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Theory</th>
                                        <th>MCQ</th>
                                        <th>Practical</th>
                                        <th>Assignment</th>
                                        <th>Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                            </table>

                            <!--button save -->
                            <div class="row">
                                <div class="modal-footer">
                                    <button class="btn bg-teal btn-round pull-right" id="btnsave" type="submit"><i
                                            class="glyphicon glyphicon-plus"></i>Save Mark</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="text-center"> 
        </div>
        </div> -->
</div>


@section('js')
<script src="{{url('/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
//

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

$(document).ready(function() {

    //$('#class').trigger('change');
    //  <?php if($session){ ?>
    //   getstudent();
    //    subject();
    //   <?php } ?>
    //  getdepartments();
    $('#class').on('change', function() {
        // alert(434);

        getdepartment();
        getexam();
        subject();
    });
    $('#session').on('change', function() {
        getstudent();
    });
    $('#btnsave').hide();

    $("#subject").change(function() {
        //   alert(434);
        $.ajax({
            url: "{{url('/course/getmarks')}}" + '/' + $('#subject').val() + '/' + $('#class')
                .val(),
            data: {
                format: 'json'
            },
            error: function(error) {
                console.log(error);
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#tfull').text(data[0]['totalfull']);
                $('#tpass').text(data[0]['totalpass']);

                $('#wfull').text(data[0]['wfull']);
                $('#wpass').text(data[0]['wpass']);

                $('#mfull').text(data[0]['mfull']);
                $('#mpass').text(data[0]['mpass']);

                $('#pfull').text(data[0]['pfull']);
                $('#ppass').text(data[0]['ppass']);

                $('#cfull').text(data[0]['sfull']);
                $('#cpass').text(data[0]['spass']);
                getstudent();
            },
            type: 'GET'
        });



    });



});


var sessionvalue = $('#session').val();
$('#session_value').val(sessionvalue);

function subject() {
    var val = $('#class').val();
    $.ajax({
        url: "{{url('/class/getcourses')}}" + '/' + val,
        type: 'get',
        dataType: 'json',
        success: function(json) {
            $('#subject').empty();
            $('#subject').append($('<option>').text("--Select--").attr('value', ""));
            $.each(json, function(i, subject) {
                // console.log(subject);

                $('#subject').append($('<option>').text(subject.course_name).attr('value', subject
                    .course_code));
            });
        }
    });
}

function getstudent() {

    var aclass = $('#class').val();
    var department = $('#department').val();
    var batch = $('#session').val();
    // var shift = $('#shift').val();
    // alert(1);
    var shift = "Morning";


    //  .trim();
    // alert(batch);
    $.ajax({
        url: "{{url('/student/getsList')}}" + '/' + aclass + '/' + department + '/' + batch,
        data: {
            format: 'json'
        },
        error: function(error) {
            alert(error);
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            $("#datatable-responsive").find("tr:gt(0)").remove();
            if (data.length > 0) {
                $('#btnsave').show();
            }
            for (var i = 0; i < data.length; i++) {
                addRow(data[i], i);
            }

        },
        type: 'GET'
    });


}


function getdepartment() {
    var aclass = $('#class').val();
    var session = $('#session').val();
    if (session == '') {
        session = 2020;
    }
    $('#department').empty();
    $('#department').append($('<option>').text("--Select--").attr('value', ""));
    $.ajax({
        url: "{{url('/department/getList')}}" + '/' + aclass + '/' + session,
        data: {
            format: 'json'
        },
        error: function(error) {
            //alert("Please fill all inputs correctly!");
        },
        dataType: 'json',
        success: function(data) {
            $('#department').empty();
            $('#department').append($('<option>').text("--Select--").attr('value', ""));
            $.each(data, function(i, department) {
                console.log(data);

                //var opt="<option value='"+section.id+"'>"+section.name + " </option>"
                var opt = "<option value='" + department.department_id + "'>" + department
                    .department_name + ' (  ' + department.students + ' ) ' + "</option>"

                //console.log(opt);
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
            $('#exam').append($('<option>').text("--Select--").attr('value', ""));
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

function addRow(data, index) {
    var table = document.getElementById('datatable-responsive');
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    // var cell1 = row.insertCell(0);
    //  var chkbox = document.createElement("label");
    // chkbox.type = "checkbox";
    //chkbox.name="chkbox[]";
    // cell1.appendChild(chkbox);
    var tm = $('#tfull').text();

    if (tm == '') {
        tm = 15;
    }
    var wm = $('#wfull').text();
    if (wm == '') {
        wm = 15;
    }
    var mm = $('#mfull').text();
    if (mm == '') {
        mm = 15;
    }
    var pm = $('#pfull').text();
    if (pm == '') {
        pm = 15;
    }
    var cm = $('#cfull').text();
    if (cm == '') {
        cm = 15;
    }
    var cell2 = row.insertCell(0);
    var regiNo = document.createElement("label");

    regiNo.innerHTML = data['studentRollss'];
    cell2.appendChild(regiNo);
    var hdregi = document.createElement("input");
    hdregi.name = "roll[]";
    hdregi.value = data['studentRollss'];
    hdregi.type = "hidden";
    cell2.appendChild(hdregi);


    //  var cell3 = row.insertCell(0);
    //  var rollno = document.createElement("label");
    //   rollno.innerHTML=data['student'];
    //  cell3.appendChild(rollno);
    /*   var hdroll = document.createElement("input");
       hdroll.name="rollNo[]";
       hdroll.value=data['rollNo'];
      hdroll.type="hidden";
      cell3.appendChild(hdroll);*/



    var cell4 = row.insertCell(1);
    var name = document.createElement("label");
    name.innerHTML = data['first_name'] + '  ' + data['last_name'];
    cell4.appendChild(name);

    var cell5 = row.insertCell(2);
    var written = document.createElement("input");
    written.type = "number";

    written.name = "written[]";
    written.required = "true";
    written.size = "2";
    written.maxlength = "2";
    written.max = wm;
    written.class = "form-control";
    cell5.appendChild(written);

    var cell6 = row.insertCell(3);
    var mcq = document.createElement("input");
    mcq.type = "number";

    mcq.name = "mcq[]";
    mcq.required = "true";
    mcq.size = "2";
    mcq.max = mm;
    cell6.appendChild(mcq);

    var cell7 = row.insertCell(4);
    var practical = document.createElement("input");
    practical.type = "number";

    practical.name = "practical[]";
    practical.required = "true";
    practical.size = "2";
    practical.max = pm;
    cell7.appendChild(practical);

    var cell8 = row.insertCell(5);
    var ca = document.createElement("input");
    ca.type = "number";

    ca.name = "ca[]";
    ca.required = "true";
    ca.max = cm;
    ca.size = "2";
    cell8.appendChild(ca);

    var cell9 = row.insertCell(6);
    var chkbox = document.createElement("input");
    chkbox.type = "text";
    chkbox.placeholder = "No";
    chkbox.name = "absent[]";
    chkbox.size = "3";
    chkbox.class = "form-control bootstrap-select";
    cell9.appendChild(chkbox);
};
</script>

@stop