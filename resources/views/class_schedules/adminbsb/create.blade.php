<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>UPDATE CLASS SCHEDULES </h3>
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
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">

                    <h2>Update Class Schedules</h2>

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

                    <div class="panel-body" style="-bottom: 1px solid #ccc; ">
                        <div class="form-group">

                            <form action="{{route('classSchedules.update', $edit_classSchedule->schedule_id)}}"
                                method="post">
                                @csrf
                                @method('PUT')
                                <!-- <input type="text" name="id" id="id"> -->
                                {{-- this parameter is just and empty string okay  --}}
                                {{-- it will be hidden input for our classschedule id okay --}}
                                <input type="hidden" name="Scheduleid" id="Scheduleid">

                                <!-- Semester Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Grade <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="semester_id"
                                            id="semester_id">
                                            <option value="">Select Grade</option>
                                            @foreach($semester as $sem)
                                            <option value="{{$sem->id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->semester_id == $sem->id ? 'selected' : ''}}
                                                @endif>{{$sem->semester_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Level Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Level <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="level_id"
                                            id="level_id">
                                            <option value="">-------</option>
                                            @foreach($level as $level)
                                            @if($level->id == $edit_classSchedule->degree_id)
                                            <option value="{{$level->id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->degree_id == $level->id ? 'selected' : ''}}
                                                @endif>{{$level->level}}</option>
                                            @endif
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <!-- Semester Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Student Group <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="faculty_id"
                                            id="faculty_id">
                                            <option value="">Select Student Group</option>
                                            @foreach($faculty as $faculty)
                                            <option value="{{$faculty->faculty_id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->faculty_id == $faculty->faculty_id? 'selected' : ''}}
                                                @endif>{{$faculty->faculty_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Level Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Class Group <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="department_id"
                                            id="department_id">
                                            <option value="">Select Class Group</option>
                                            @foreach($department as $department)
                                            @if($department->department_id == $edit_classSchedule->department_id)
                                            <option value="{{$department->department_id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->department_id == $department->department_id ? 'selected' : ''}}
                                                @endif>{{$department->department_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Class Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Class <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="class_id"
                                            id="class_id">
                                            <option value="">Select Class</option>
                                            <!-- here i will use foreach loop okay to fetch all the data from the controllerokay. -->
                                            @foreach($classes as $cla)
                                            @if($cla->class_code == $edit_classSchedule->class_id)
                                            <option value="{{$cla->class_code}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->class_id == $cla->class_code ? 'selected' : ''}}
                                                @endif>{{$cla->class_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Course Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Subject <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="course_id"
                                            id="course_id">
                                            <option value="">Select Subject</option>
                                            @foreach($course as $cour)
                                            @if($cour->id == $edit_classSchedule->course_id)
                                            <option value="{{$cour->id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->course_id == $cour->id ? 'selected' : ''}}
                                                @endif>{{$cour->course_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- i will skip the level first because we need to extra code for the level it will


            <!-- Shift Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Shift <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="shift_id"
                                            id="shift_id">
                                            <option value="">Select Shift</option>
                                            @foreach($shift as $shi)
                                            @if($shi->shift_id == $edit_classSchedule->shift_id)
                                            <option value="{{$shi->shift_id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->shift_id == $shi->shift_id ? 'selected' : ''}}
                                                @endif>{{$shi->shift}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Classroom Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Room <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="classroom_id"
                                            id="classroom_id">
                                            <option value="">Select ClassRoom</option>
                                            @foreach($classroom as $room)
                                            @if($room->classroom_id == $edit_classSchedule->classroom_id)
                                            <option value="{{$room->classroom_id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->classroom_id == $room->classroom_id ? 'selected' : ''}}
                                                @endif>{{$room->classroom_name}}__{{$room->classroom_code}}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- edit_classSchedule Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Session <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="batch_id"
                                            id="batch_id">
                                            <option value="">---Select Session---</option>
                                            @foreach($batch as $bat)
                                            <option value="{{$bat->id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->batch_id == $bat->id ? 'selected' : ''}}
                                                @endif>{{$bat->batch}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Day Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Day <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="day_id"
                                            id="day_id">
                                            <option value="">Select Day</option>
                                            @foreach($day as $d)
                                            <option value="{{$d->day_id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->day_id == $d->day_id ? 'selected' : ''}}
                                                @endif>{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Time Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Time <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="time_id"
                                            id="time_id">
                                            <option value="">Select Time </option>
                                            @foreach($time as $ti)
                                            <option value="{{$ti->time_id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->time_id == $ti->time_id ? 'selected' : ''}}
                                                @endif>{{$ti->time .' -- '. $ti->end_time}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Time Id Field -->
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="">Teacher <b class="error">*</b></label>
                                        <select required class="form-control bootstrap-select" name="teacher_id"
                                            id="teacher_id">
                                            <option value="">Select Teacher</option>
                                            @foreach($teachers as $teacher)
                                            <option value="{{$teacher->teacher_id}}"
                                                @if(isset($edit_classSchedule)){{$edit_classSchedule->teacher_id == $teacher->teacher_id ? 'selected' : ''}}
                                                @endif>{{$teacher->first_name .' '. $teacher->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Start Date Field -->
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <label for="">Start Date <b class="error">*</b></label>
                                            <input type="text" class="form-control "
                                                value="{{date('Y-m-d', strtotime($edit_classSchedule->start_date))}}"
                                                name="start_date" id="start_date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">

                                    </div>
                                </div>

                                <!-- End Date Field -->
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <label for="">End Date <b class="error">*</b></label>
                                            <input type="text" class="form-control"
                                                value="{{date('Y-m-d', strtotime($edit_classSchedule->end_date))}}"
                                                name="end_date" id="end_date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>


                        </div>

                        <!-- Status Field -->
                        <div class="form-group">
                            <div class="col-sm-4">
                                <select class="form-control bootstrap-select" name="schedule_status"
                                    id="schedule_status">
                                    <option value="1" @if($edit_classSchedule->schedule_status == '1') selected @endif>
                                        Active </option>
                                    <option value="0" @if($edit_classSchedule->schedule_status == '0') selected @endif>
                                        In active </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->
                    <div class="modal-footer ">
                        <a href="{{url()->previous()}}" class="btn btn-danger btn-sm pull-left"> Cancel</a>
                        <button type="submit" class="btn bg-teal btn-round btn-sm">Update Class Schedule</button>
                    </div>
                </div>
                {!! Form::close() !!}
                <!-- </div>
</div> -->
                </form> {{-- form close here --}}

            </div>
        </div>
    </div>
</div>


@section('js')
<script type="text/javascript">
//{{---------------------Show Start Date-------------------}}  

$('#start_date').datetimepicker({
    i18n: {
        de: {
            months: [
                'January', 'February', 'March', 'April',
                'May', 'Jun', 'July', 'August',
                'September', 'October', 'November', 'December',
            ],
            dayOfWeek: [
                "Su", "Mon", "Tu", "Wed",
                "Thu", "Fri", "Sa",
            ]
        }
    },
    timepicker: false,
    format: 'Y-m-d'
});

$('#end_date').datetimepicker({
    i18n: {
        de: {
            months: [
                'January', 'February', 'March', 'April',
                'May', 'Jun', 'July', 'August',
                'September', 'October', 'November', 'December',
            ],
            dayOfWeek: [
                "Su", "Mon", "Tu", "Wed",
                "Thu", "Fri", "Sa",
            ]
        }
    },
    timepicker: false,
    format: 'Y-m-d'
});

//     we will write our code here okay.
$('#course_id').on('change', function(e) {
    var course_id = $(this).val();
    alert(course_id)
    var level = $('#level_id')
    $(level).empty();
    $.get("{{ route('dynamicLevel') }}", {
        course_id: course_id
    }, function(data) {

        // console.log(data);
        $.each(data, function(index, l) {
            $(level).append($('<option/>', {
                value: l.id,
                text: l.level
            }))
        })
    })
})

// ------------------------------------SHOW SCRIPT--------------------------------

// we will change this and use the bootstrap find function it's more easy to use and simple okay.
$('#Viewclassschedule-show').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var course_id = button.data('course_id') // we will use the variable inside that value okay.
    var level_id = button.data('level_id')
    var shift_id = button.data('shift_id')
    var time_id = button.data('time_id')
    var day_id = button.data('day_id')
    var classroom_id = button.data('classroom_id')
    var edit_classSchedule_id = button.data('edit_classSchedule_id')
    var semester_id = button.data('semester_id')
    var start_date = button.data('start_date')
    var end_date = button.data('end_date')
    var class_id = button.data('class_id')
    var Scheduleid = button.data('Scheduleid')
    var status = button.data('status')
    console.log(event);
    var modal = $(this)

    // and here we will use the find function to fetch the data okay...
    modal.find('.modal-title').text('Class Schedule View');
    modal.find('.modal-body #course_id').val(course_id);
    modal.find('.modal-body #level_id').val(level_id);
    modal.find('.modal-body #shift_id').val(shift_id);
    modal.find('.modal-body #time_id').val(time_id);
    modal.find('.modal-body #day_id').val(day_id);
    modal.find('.modal-body #classroom_id').val(day_id);
    modal.find('.modal-body #edit_classSchedule_id').val(edit_classSchedule_id);
    modal.find('.modal-body #semester_id').val(semester_id);
    modal.find('.modal-body #start_date').val(start_date);
    modal.find('.modal-body #end_date').val(end_date);
    modal.find('.modal-body #class_id').val(class_id);
    modal.find('.modal-body #status').val(status);
    modal.find('.modal-body #Scheduleid').val(Scheduleid);

});

// GET SEMESTER DEGREEE
$('#semester_id').on('change', function(e) {
    var grade_id = $(this).val();
    var degree = $('#level_id')
    // alert(grade_id)
    $(degree).empty();
    $(degree).append($('<option>').text("--Select level--").attr('value', ""));
    $.get("{{ route('dynamicDegrees') }}", {
        grade_id: grade_id
    }, function(data) {

        console.log(data);
        $.each(data, function(i, l) {
            $(degree).append($('<option/>', {
                value: l.id,
                text: l.level
            }))
        })
    })
});

// GET SEMESTER DEGREEE
$('#faculty_id').on('change', function(e) {
    alert(1)
    var faculty_id = $(this).val();
    var department_id = $('#department_id')
    $(department_id).empty();
    $(department_id).append($('<option>').text("--Select class group--").attr('value', ""));
    $.get("{{ route('dynamicDepartments') }}", {
        faculty_id: faculty_id
    }, function(data) {

        console.log(data);
        $.each(data, function(i, l) {
            $(department_id).append($('<option/>', {
                value: l.department_id,
                text: l.department_name
            }))
        })
    })
});

$('document').ready(function() {
    //   alert('hello');


    function ShowTeacherClassAssign(teacher_id) {
        $.get("{{ url('show-class-assign') }}", {
            teacher_id: teacher_id
        }, function() {
            // alert('hello');
            $('#class-schedule-info').empty().append(data);
            MargeCommonRows($('#table-class-info'));
        })
    }

    $('#department_id1').on('change', function(e) {

        var department_id = $(this).val();
        var class_id = $('#class_id1')

        $(class_id).empty();
        $(class_id).append($('<option>').text("--Select class--").attr('value', ""));
        $.get("{{ route('dynamicDepartmentsWithClass') }}", {
            department_id: department_id
        }, function(data) {

            console.log(data);
            $.each(data, function(i, c) {
                $(class_id).append($('<option>').text(c.class_name).attr('value', c
                    .class_code));

            })
        })
    });

    $('#class_id').on('change', function(e) {

        var class_id = $(this).val();
        var course_id = $('#course_id')
        $(course_id).empty();
        $(course_id).append($('<option>').text("--Select subject--").attr('value', ""));
        $.get("{{ route('dynamicCourse') }}", {
            class_id: class_id
        }, function(data) {

            console.log(data);
            $.each(data, function(i, c) {
                $(course_id).append($('<option/>', {
                    value: c.id,
                    text: c.course_name
                }))
            })
        })
    });

    // Function for Search data 

    $("#search").on("keyup", function() {
        // alert('hello')
        var value = $(this).val().toLowerCase();
        $("#table-class-info tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        MargeCommonRows($('#table-class-info'));
    });

    MargeCommonRows($('#classSchedules-table'));

    // })

    // $(document).ready(function(){

    // {{--------------------------------FILTER BY CLAss--------------------------------}}

    $("#clas_id").on('change', function() {
        var classid = $("#clas_id").val();

        $.ajax({
            type: 'get',
            dataType: 'html',
            url: '{{ url (' / filter - classSchedules - by - class ')}}',
            data: {
                'class_id': classid
            },

            success: function(response) {
                console.log(response);
                $("#classSchedules-table").html(response);
                MargeCommonRows($('#classSchedules-table'));

                let elems = Array.prototype.slice.call(document.querySelectorAll(
                    '.js-switch'));
                elems.forEach(function(html) {
                    let switchery = new Switchery(html, {
                        color: '#0A9913',
                        secondaryColor: '#F80A20',
                        jackColor: '#fff',
                        jackSecondaryColor: '#fff'
                    });

                });
                Status()
            }
        });
    });

    // {{--------------------------------FILTER BY COUR--------------------------------}}

    $("#cour_id").on('change', function() {
        var courseid = $("#cour_id").val();
        // alert(classid);

        $.ajax({
            type: 'get',
            dataType: 'html',
            url: '{{ url (' / filter - classSchedules - by - course ')}}',
            // data: 'course_id=' + courseid,
            data: {
                'course_id': courseid
            },
            success: function(response) {
                console.log(response);
                $("#classSchedules-table").html(response);
                MargeCommonRows($('#classSchedules-table'));

                let elems = Array.prototype.slice.call(document.querySelectorAll(
                    '.js-switch'));
                elems.forEach(function(html) {
                    let switchery = new Switchery(html, {
                        color: '#0A9913',
                        secondaryColor: '#F80A20',
                        jackColor: '#fff',
                        jackSecondaryColor: '#fff'
                    });

                });
                Status()
            }
        });
    });

    // {{--------------------------------FILTER BY LEVEL--------------------------------}}

    $("#leve_id").on('change', function() {
        var levelid = $("#leve_id").val();
        // alert(classid);

        $.ajax({
            type: 'get',
            dataType: 'html',
            url: '{{ url (' / filter - classSchedules - by - level ')}}',
            // data: 'level_id=' + levelid,
            data: {
                'level_id': levelid
            },
            success: function(response) {
                console.log(response);
                $("#classSchedules-table").html(response);
                MargeCommonRows($('#classSchedules-table'));

                let elems = Array.prototype.slice.call(document.querySelectorAll(
                    '.js-switch'));
                elems.forEach(function(html) {
                    let switchery = new Switchery(html, {
                        color: '#0A9913',
                        secondaryColor: '#F80A20',
                        jackColor: '#fff',
                        jackSecondaryColor: '#fff'
                    });

                });
                Status()
            }
        });

    });

    // {{--------------------------------FILTER BY COUR AND LEVEL--------------------------------}}

    $("#filter").click(function() {
        var courseid = $("#cour_id").val();
        var levelid = $("#leve_id").val();
        // $("#clas_id").val('');

        $.ajax({
            type: 'get',
            dataType: 'html',
            url: '{{ url (' / filter - classSchedules - by - course - level ')}}',
            data: {
                'course_id': courseid,
                'level_id': levelid
            },
            // data: 'course_id=' + courseid + '&level_id=' + levelid,
            success: function(response) {
                console.log(response);
                $("#classSchedules-table").html(response);
                MargeCommonRows($('#classSchedules-table'));

                let elems = Array.prototype.slice.call(document.querySelectorAll(
                    '.js-switch'));
                elems.forEach(function(html) {
                    let switchery = new Switchery(html, {
                        color: '#0A9913',
                        secondaryColor: '#F80A20',
                        jackColor: '#fff',
                        jackSecondaryColor: '#fff'
                    });

                });
                Status();
            }
        });

        $('#clas_id').val('');
    });


    function MargeCommonRows(table) {
        var firstColumnBrakes = [];
        $.each(table.find('th'), function(i) {
            var previous = null,
                cellToExtend = null,
                rowspan = 1;
            table.find("td:nth-child(" + i + ")").each(function(index, e) {
                var jthis = $(this),
                    content = jthis.text();
                if (previous == content && content !== "" && $.inArray(index,
                        firstColumnBrakes) === -1) {
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
                if (previous == content && content !== "" && $.inArray(index, firstColumnBrakes) === -
                    1) {
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

    $(document).ready(function() {
        // alert(1)
        // function Status(){
        // $('.js-switch').change(function() {
        //     let status = $(this).prop('checked') === true ? 1 : 0;
        //     let scheduleId = $(this).data('id');
        //     // alert(scheduleId)
        //     $.ajax({
        //         type: "GET",
        //         dataType: "json",
        //         url: '{{ url('
        //         schedule / status / update ') }}',
        //         data: {
        //             'status': status,
        //             'schedule_id': scheduleId
        //         },
        //         success: function(data) {
        //             console.log(data);
        //             console.log(data.message);
        //             // success: function (data) {
        //             toastr.options.closeButton = true;
        //             toastr.options.closeMethod = 'fadeOut';
        //             toastr.options.closeDuration = 100;
        //             toastr.success(data.message);
        //             // }
        //         }
        //     });
        // });
        // }
    })

    // let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

});
</script>
@endsection