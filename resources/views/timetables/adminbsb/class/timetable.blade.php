@php
if(isset($class_id)){

}else{
$class_id ='';
}
@endphp

<style>
th {
    width: 125;
}

h3 {
    font-family: 'Times New Roman', Times, serif;
    font-style: initial;
    font-weight: bolder;
    text-transform: uppercase;
    color: red;
}
</style>
<div class="body">

    <h3>
        {{$class_name->class_name }} <strong style="color:black">TIME TABLE</strong>
        <b class="pull-right"> {{$class_name->semester_name }}</b>
    </h3>

    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action" id="timetable-table">
            <thead>
                <tr class="headings">
                    <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                    </th> -->
                    <th class="column-title">DAYS</th>
                    <th class="column-title">CODE</th>
                    <th class="column-title">SUBJECT</th>
                    <th class="column-title">CLASS</th>
                    <th class="column-title">CREDIT</th>
                    <th class="column-title">ROOM</th>
                    <th class="column-title">GRADE</th>
                    <th class="column-title">TEACHER</th>
                    <th class="column-title">TIME</th>
                    <!-- <th class="bulk-actions" colspan="9">
                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">
                            </span> ) <i class="fa fa-chevron-down"></i></a>
                    </th> -->
                </tr>
            </thead>

            <tbody id="accordion">
                @if(count($classtimetables) == 0)
                @include('flash::message')
                @include('adminlte-templates::common.errors')
                @endif
                @if($classtimetables)
                @foreach ($classtimetables as $teacher)

                <tr class="even pointer">
                    <!-- <td class="a-center ">
                        <input type="checkbox" class="flat" name="table_records">
                    </td> -->
                    <th>{{$teacher->name}}</th>
                    <td class="">{{$teacher->code}}</a></td>
                    <td style="background-color:#f0f0f0" class="align-middle text-center">{{$teacher->course_name}}</td>
                    <td class=""">@if(isset($teacher->class_name)) {{ $teacher->class_name }} @endif</td>
        <td class=""">----</td>
                    <td class=""">{{$teacher->classroom_name}}</td>
        <td class=""">{{ $teacher->semester_name}}</td>
                    <td class="""><a href=" #" title="View Teacher"
                        onclick="getteacherinfo('{{$teacher->teacher_id}}')">
                        {{$teacher->first_name}}{{$teacher->last_name}}</a></td>
                    <td>{{ $teacher->time .' ' .  $teacher->end_time}} </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td></td>
                    <td> </td>
                    <td></td>
                    <td></td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>

</div>

<!-- </div> -->
<!-- The Modal -->
<div class=" modal" data-backdrop="" id="teacherModal" role="dialog" aria-labelledby="preview-modal" aria-hidden="true"
    style="margin-top: 100px;">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header-store">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Teacher Detail</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table id="classList" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:30%">Name</th>
                            <th style="width:30%">Phone</th>
                            <th style="width:30%">Email</th>
                        </tr>
                    </thead>
                    <tbody id="tdetails">
                    </tbody>
                </table>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script>
$(document).ready(function() {
    MargeCommonRows($('#timetable-table'));
    MergeCommonRows($('#timetable-table'));
})

function getteacherinfo(teacher_id) {
    //alert(teacher_id)
    $.ajax({
        url: "{{ url('/get/teacher') }}" + "/" + teacher_id,
        method: "GET",
        //data:{name:class_name,code:class_code,description:class_des, _token:_token},
        success: function(data) {
            $("#tdetails").html(data);

            $('#teacherModal').modal('show');
        },

        error: function(textStatus, errorThrown) {
            alert(JSON.stringify(textStatus));
        }
    });
}
$('#timepicker1').timepicker();
$('#timepicker2').timepicker();

function confirmed(teacher_id) {
    var x = confirm('Are you sure you want to delete timetable?');
    if (x) {
        window.location = "{{url('/timetable/delete/')}}/" + teacher_id;
        return true;
    } else {
        return false;
    }
}

function MargeCommonRows(table) {
    var firstColumnBrakes = [];
    $.each(table.find('th'), function(i) {
        var previous = null,
            cellToExtend = null,
            rowspan = 1;
        table.find("td:nth-child(" + i + ")").each(function(index, e) {
            var jthis = $(this),
                content = jthis.text();
            if (previous == content && content !== "" && $.inArray(index, firstColumnBrakes) === -1) {
                jthis.addClass('hidden');
                cellToExtend.attr("rowspan", (rowspan = rowspan + 1));
            } else {
                if (i === 2) firstColumnBrakes.push(index);
                rowspan = 1;
                previous = content;
                cellToExtend = jthis;
            }
        });
    });
    $('td.hidden').remove();
}

// All Columns
function MergeCommonRows(table) {
    var firstColumnBrakes = [];
    // iterate through the columns instead of passing each column as function parameter:
    for (var i = 1; i <= table.find('th').length; i++) {
        var previous = null,
            cellToExtend = null,
            rowspan = 1;
        table.find("td:nth-child(" + i + ")").each(function(index, e) {
            var jthis = $(this),
                content = jthis.text();
            // check if current row "break" exist in the array. If not, then extend rowspan:
            if (previous == content && content !== "" && $.inArray(index, firstColumnBrakes) === -1) {
                // hide the row instead of remove(), so the DOM index won't "move" inside loop.
                jthis.addClass('hidden');
                cellToExtend.attr("rowspan", (rowspan = rowspan + 1));
            } else {
                // store row breaks only for the first column:
                if (i === 2) firstColumnBrakes.push(index);
                rowspan = 1;
                previous = content;
                cellToExtend = jthis;
            }
        });
    }
    // now remove hidden td's (or leave them hidden if you wish):
    $('td.hidden').remove();
}
</script>
@endsection