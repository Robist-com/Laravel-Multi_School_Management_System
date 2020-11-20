@section('style')
<link href="{{url('')}}/css/bootstrap-datepicker.css" rel="stylesheet">
<style>
#attendanceList th,
#attendanceList td {
    text-align: center;
}

.badge-warning {
    background-color: #f89406;
}

.badge-warning:hover {
    background-color: #c67605;
}

.badge-success {
    background-color: #468847;
}

.badge-success:hover {
    background-color: #356635;
}
</style>
@stop
<hr>
<div class="form-group col-md-4">
<strong>Select Criteria</strong>
</div>
<hr>



<form action="{{route('PostAttendaceReport')}}" method="post">
    @csrf
    @if(auth()->user()->group == "Admin")
    <div class="col-md-12">
        <label for="">School <b style="color:red">*</b></label>
        <select name="school_id" id="school_id" class="form-control bootstrap-select">
            <option value="">Select</option>
            @foreach(auth()->user()->school->all() as $school)
            <option value="{{$school->id}}"
                @if(isset($school)){{$school->id == request('school_id') ? 'selected' : '' }} @endif>{{$school->name}}
            </option>
            @endforeach
        </select>
    </div>
    <br>
    @else
    <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
    <br>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="class">Class</label>
                    <select id="class" id="class_id" name="class_id" class="form-control bootstrap-select">
                        <option value="">---Select ---</option>
                        @foreach($classes2 as $class)
                        <option value="{{$class->class_code}}" @if($class->class_code === request('class_id')) selected
                            @endif >{{$class->class_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="section">Section</label>
                    <select id="section" name="section" class="form-control bootstrap-select">
                        <option value="">---Select Section ---</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>

                    </select>
                </div>
            </div>


            <input type="hidden" name="shift" value="Morning">

            <input type="hidden" id="session" class="form-control " name="session" value="" data-date-format="yyyy">

            <div class="col-md-4">
                <div class="form-group ">
                    <label for="dob">Month </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                        <div class="form-line">
                            <input type="text" class="form-control datepicker" name="monthly_date"
                                data-date-format="yyyy-mm" value="{{$yearMonth}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div>
                        @if(isset($class_attend))
                        <button class="btn bg-teal btn-round pull-right" type="submit"><i
                                class="glyphicon glyphicon-print"></i> Get List</button>
                        @else

                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>


<br>
@if(request('class_id'))
<hr>
<b>Class Wise Report</b>


<hr>
<table id="datatable-buttons" class="table table-striped table-bordered">
    <thead>
        <tr class="bordered-tr">
            <th class="bordered-th">Roll No.</th>
            <th class="bordered-th">Student Name</th>
            <th class="bordered-th">Attendance</th>
            <th class="bordered-th">Class</th>
            @if(request('monthly_date'))
            <th class="bordered-th">Month</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($class_attend as $key => $item)
        <tr class="bordered-tr">
            <td class="bordered-td">{{$item->roll_no}}</td>
            <td class="bordered-td">{{$item->student_first_name }} {{$item->student_last_name}}</td>
            <td class="bordered-td">
                @if($item->attendance_status == 'present')
                <span class="label label-success">Present</span>
                @elseif($item->attendance_status == 'absent')
                <span class="label label-danger">Absent</span>
                @elseif($item->attendance_status == 'sick')
                <span class="label label-warning">Sick</span>
                @elseif($item->attendance_status == 'late')
                <span class="label label-info">Late</span>
                @endif
            </td>
            <td class="bordered-td">{{$item->class_name }} </td>
            @if(request('monthly_date'))
            <td class="bordered-td">{{date('m',  strtotime($item->attendance_date ))}} / {{$item->month }} </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endif
</div>
</div>
</div>
</div>

@section('js')
<script src="{{url('')}}/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">

$('#classwise').on('click',function(e){
  alert(1)
    $('#classwise').css("color", "black");
    $(this).css("color", "red");
});

$(document).ready(function() {
    // alert(1)
    $(".datepicker2").datepicker({
        format: " yyyy", // Notice the Extra space at the beginning
        viewMode: "years",
        minViewMode: "years",
        autoclose: true

    });

    $(".datepicker").datepicker({
        autoclose: true,
        format: "mm",
        changeMonth: true,
        changeYear: true,
        viewMode: "months",
        // minViewMode: "months",

    });

    $("#btnPrint").click(function() {
        $('input[name="print_view"]').val(1);
        var qstring = $("form").serialize();
        var url = "<?php echo url(''); ?>/class_wise_attendance?" + qstring;
        window.open(url, '_blank');
        window.focus();
    });


    // getsections();
    $('#class').on('change', function() {
        // getsections();
    });
    $('#session').on('change', function() {
        // getsections();
    });


});

function getsections() {
    var aclass = $('#class').val();
    var session = $('#session').val();
    // alert(aclass);
    $.ajax({
        url: "{{url('/section/getList')}}" + '/' + aclass + '/' + session,
        data: {
            format: 'json'
        },
        error: function(error) {
            alert("Please fill all inputs correctly!");
        },
        dataType: 'json',
        success: function(data) {
            $('#section').empty();
            $('#section').append($('<option>').text("--Select Section--").attr('value', ""));
            $.each(data, function(i, section) {
                //console.log(student);


                var opt = "<option value='" + section.id + "'>" + section.name + ' (  ' + section
                    .students + ' ) ' + "</option>"


                //console.log(opt);
                $('#section').append(opt);

            });
            //console.log(data);

        },
        type: 'GET'
    });
};
</script>
@stop