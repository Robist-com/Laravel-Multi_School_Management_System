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

<div class="col-md-12">
<hr>
<strong>Select Criteria</strong>

<hr>
</div>

<form role="form" action="{{url('/attendance/monthly-report')}}" method="get" enctype="multipart/form-data">
    <input type="hidden" name="print_view" value="0">
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
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="class">Class</label>
                    <select id="class" id="class" name="class" class="form-control bootstrap-select">
                        @foreach($classes2 as $class)
                        <option value="{{$class->class_code}}" @if($class->class_code === request('class')) selected
                            @endif >{{$class->class_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
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

            <div class="col-md-3">
                <div class="form-group ">
                    <label for="dob">Month <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                        <div class="form-line">
                        <input type="text" class="form-control datepicker" name="yearMonth" required
                            data-date-format="yyyy-mm" value="{{$yearMonth}}">
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" for="section">Report Type</label>
                    <select id="section" name="type" class="form-control bootstrap-select">
                        <option value="">---Select Type ---</option>
                        <option value="complete">Complete Report</option>
                        <option value="count">Count Number only</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div>
                        <button class="btn bg-teal btn-round pull-right" id="btnPrint" type="button"><i
                                class="glyphicon glyphicon-print"></i> Print List</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
<br>
</div>
</div>
</div>

@section('js')
<script src="{{url('')}}/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $(".datepicker2").datepicker({
        format: " yyyy", // Notice the Extra space at the beginning
        viewMode: "years",
        minViewMode: "years",
        autoclose: true

    });

    $(".datepicker").datepicker({
        autoclose: true,
        format: "yyyy-mm",
        changeMonth: true,
        changeYear: true,
        viewMode: "months",
        // minViewMode: "months",

    });

    $("#btnPrint").click(function() {
        $('input[name="print_view"]').val(1);
        var qstring = $("form").serialize();
        var url = "<?php echo url(''); ?>/attendance/monthly-report?" + qstring;
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