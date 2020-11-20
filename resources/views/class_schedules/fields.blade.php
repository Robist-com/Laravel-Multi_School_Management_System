<!--  here we will make our modal here okay. -->
 <!-- i will  just past the modal header code so you can follow and write it step by step okay. -->
 <!-- <style>
.border{
    border-radius:5px;
    height:30px;
}

#select_2_single{
    width:1px !important;
}
</style> -->
 <!------------------------------ Modal start from here okay-------------------------------- -->
 <div class="modal fade" id="classschedule-show" tabindex="-1" role="dialog" 
 aria-labelledby="myModalLabel"
aria-hidden="true" style="margin-left: 20%;">
<div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
            aria-hidden="true">&times;</button>
            <h4 class="modal-title">Generate Class Scheduled</h4>
            </div>
             <div class="panel-body" style="border-bottom: 1px solid #ccc; ">
             <div class="form-group">

            <div class="row"></div>
            <!-- <input type="text" name="id" id="id"> -->

            @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($classes)){{$classes->school_id == $school->id ? 'selected' : ''}} @endif >
                            {{$school->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @else
                      <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                  @endif

<!-- Semester Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
    <select class="form-control select_2_single" name="semester_id" id="semester_id1">
            <option value="">Select Grade</option>
            @foreach($semester as $sem)
            <option value="{{$sem->id}}">{{$sem->semester_name}}</option>
            @endforeach
        </select>
    </div>

    <!-- Level Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
    <select class="form-control select_2_single " name="degree_id" id="degree_id1">
        <option selected disabled>Select Level</option>

    </select>
</div>

<!-- Class Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
    <select class="form-control select_2_single" name="faculty_id" id="faculty_id1">
        <option value="">Select Student Group</option>
        @foreach($faculty as $faculty)
        <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
        @endforeach
    </select>
    </div>

    <!-- Class Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
    <select class="form-control select_2_single" name="department_id" id="department_id1">
        <option value="">Select Class Group</option>
    </select>
    </div>

<!-- Class Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
    <select class="form-control select_2_single" name="class_id" id="class_id1">
        <option value="">Select Class</option>
        <!-- here i will use foreach loop okay to fetch all the data from the controllerokay. -->
        {{-- @foreach($classes as $cla)
        <option value="{{$cla->id}}">{{$cla->class_name}}</option>
        @endforeach --}}
    </select>
    </div>

    <!-- Course Id Field -->
    <div class="form-group col-md-3 col-sm-3 col-xs-12">
   <select class="form-control select_2_single" name="course_id" id="course_id1">
        <option value="">Select Subject</option>
        @foreach($course as $cour)
        <option value="{{$cour->id}}">{{$cour->course_name}}</option>
        @endforeach
    </select>
</div>

{{-- <!-- Level Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
    <select class="form-control select_2_single " name="level_id" id="level_id1">
    @foreach($course as $lev)
        <option value="{{$lev->id}}">Select Level</option>
        @endforeach
    </select>
</div> --}}
<!-- i will skip the level first because we need to extra code for the level it will
be dynamic value by the select of the course okay.... -->

<!-- Shift Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
    <select class="form-control select_2_single" name="shift_id" id="shift_id1">
        <option value="">Select Shift</option>
        @foreach($shift as $shi)
        <option value="{{$shi->shift_id}}">{{$shi->shift}}</option>
        @endforeach
    </select>
</div>

<!-- Classroom Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
    <select class="form-control select_2_single" name="classroom_id" id="classroom_id1">
        <option value="">Select ClassRoom</option>
        @foreach($classroom as $room)
        <option value="{{$room->classroom_id}}">{{$room->classroom_name}}__{{$room->classroom_code}}</option>
        @endforeach
    </select>
</div>

<!-- Batch Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
<select class="form-control select_2_single" name="batch_id" id="batch_id1">
        <option value="">Select Batch</option>
        @foreach($batch as $bat)
        <option value="{{$bat->id}}">{{$bat->batch}}</option>
        @endforeach
    </select>
</div>

<!-- Day Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
<select class="form-control select_2_single" name="day_id" id="day_id1">
        <option value="">Select Day</option>
        @foreach($day as $d)
        <option value="{{$d->day_id}}">{{$d->name}}</option>
        @endforeach
    </select>
</div>

<!-- Time Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
<select class="form-control select_2_single" name="time_id" id="time_id1">
        <option value="">Select Time</option>
        @foreach($time as $ti)
        <option value="{{$ti->time_id}}">{{$ti->time}}</option>
        @endforeach
    </select>
</div>

<!-- Day Id Field -->
<div class="form-group col-md-3 col-sm-3 col-xs-12">
    <select class="form-control select_2_single" name="teacher_id" id="teacher_id">
            <option value="">Select Teacher</option>
            @foreach($teachers as $teacher)
            <option value="{{$teacher->teacher_id}}">{{$teacher->first_name ." ". $teacher->last_name }}</option>
            @endforeach
        </select>
    </div>

<!-- Start Date Field -->
        <div class='col-sm-4'>
                    Start Date
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker1'>
                            <input type='text' class="form-control" name="start_date" id="start_date1" autocomplete="off"/>
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class='col-sm-4'>
                </div>
        <div class='col-sm-4'>
        End Date
        <div class="form-group">
            <div class='input-group date' id='myDatepicker2'>
                <input type='text' class="form-control" name="end_date" id="end_date1" autocomplete="off"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        </div>

</div>

<!-- Status Field -->
<div class="form-group col-sm-6" name="status" id="status1">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null, ['class' => 'flat']) !!} 
    </label>
</div>

      </div>
      <!-- </div> -->
        <div class="modal-footer ">
        <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">close</button>
         <button type="submit" class="btn btn-success btn-sm btn-round">Generate Create Schedule</button>
          </div>
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript">
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
$('#start_date1').datetimepicker({
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

$('#end_date1').datetimepicker({
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

// Here we wil write our edit Script okay to fetch our data from the modal.

// ------------------------------------Edit--------------------------------

// $(document).on('click', '#Edit', function(event){
$('#Editclassschedule-show').on('show.bs.modal', function(event) {
 
    var button = $(event.relatedTarget)
    var course_id = button.data('course_id') // we will use the variable inside that value okay.
    var level_id = button.data('level_id')
    var shift_id = button.data('shift_id')
    var time_id = button.data('time_id')
    var day_id = button.data('day_id')
    var classroom_id = button.data('classroom_id')
    var batch_id = button.data('batch_id')
    var semester_id = button.data('semester_id')
    var start_date = button.data('start_date')
    var end_date = button.data('end_date')
    var class_id = button.data('class_id')
    var Scheduleid = button.data('id')
    var status = button.data('status')

    alert(course_id)
    console.log(event);
    var modal = $(this)

    $(event.currentTarget).find('select[name="course_id"]').val(course_id);
    $(event.currentTarget).find('select[name="level_id"]').val(level_id);
    $(event.currentTarget).find('select[name="shift_id"]').val(shift_id);
    $(event.currentTarget).find('select[name="time_id"]').val(time_id);
    $(event.currentTarget).find('select[name="day_id"]').val(day_id);
    $(event.currentTarget).find('select[name="classroom_id"]').val(classroom_id);
    $(event.currentTarget).find('select[name="batch_id"]').val(batch_id);

    // modal.find('.modal-title').text('Class Schedule View');
    // modal.find('.modal-body #course_id').val(course_id);
    // modal.find('.modal-body #level_id').val(level_id);
    // modal.find('.modal-body #shift_id').val(shift_id);
    // modal.find('.modal-body #time_id').val(time_id);
    // modal.find('.modal-body #day_id').val(day_id);
    // modal.find('.modal-body #classroom_id').val(day_id);
    // modal.find('.modal-body #batch_id').val(batch_id);
    // modal.find('.modal-body #semester_id').val(semester_id);
    // modal.find('.modal-body #start_date').val(start_date);
    // modal.find('.modal-body #end_date').val(end_date);
    // modal.find('.modal-body #class_id').val(class_id);
    // modal.find('.modal-body #status').val(status);
    // modal.find('.modal-body #Scheduleid').val(Scheduleid);

    // now we need to write route for this edit okay..
    // $.get("{{ route('edit')}}", {Scheduleid:Scheduleid}, function(data){
    //     $("#course_id").val(data.course_id);
    //     $("#level_id").val(data.level_id);
    //     $("#shift_id").val(data.shift_id);
    //     $("#time_id").val(data.time_id);
    //     $("#day_id").val(data.day_id);
    //     $("#classroom_id").val(data.classroom_id);
    //     $("#batch_id").val(data.batch_id);
    //     $("#batch_id").val(data.batch_id);
    //     $("#semester_id").val(data.semester_id);
    //     $("#start_date").val(data.start_date);
    //     $("#end_date").val(data.end_date);
    //     $("#class_id").val(data.class_id);
    //     $("#Scheduleid").val(data.Scheduleid); 
    //     $("#faculty_id").val(data.faculty_id);
    //     $("#department_id").val(data.department_id);
    //     $("#status").val(data.status);
    // console.log(data);
    // we will use the input id's okay
    // let's check if we are ahving the data's or not okay..
});
// });

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
    var batch_id = button.data('batch_id')
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
    modal.find('.modal-body #batch_id').val(batch_id);
    modal.find('.modal-body #semester_id').val(semester_id);
    modal.find('.modal-body #start_date').val(start_date);
    modal.find('.modal-body #end_date').val(end_date);
    modal.find('.modal-body #class_id').val(class_id);
    modal.find('.modal-body #status').val(status);
    modal.find('.modal-body #Scheduleid').val(Scheduleid);

});

// GET SEMESTER DEGREEE
$('#semester_id1').on('change', function(e) {
    var grade_id = $(this).val();
    var degree = $('#degree_id1')
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
$('#faculty_id1').on('change', function(e) {
    alert(1)
    var faculty_id = $(this).val();
    var department_id = $('#department_id1')
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

//     we will write our code here okay.
$('#course_id1').on('change', function(e) {
    var course_id = $(this).val();
    var level = $('#level_id1')
    $(level).empty();
    $(level).append($('<option>').text("--Select Level--").attr('value', ""));
    $.get("{{ route('dynamicLevel') }}", {
        course_id: course_id
    }, function(data) {

        // console.log(data);
        $.each(data, function(i, l) {
            $(level).append($('<option/>', {
                value: l.level_id,
                text: l.level
            }))
        })
    })
});

$('#course_id').on('change', function(e) {
    var course_id = $(this).val();
    var level = $('#level_id')
    $(level).empty();
    $(level).append($('<option>').text("--Select Level--").attr('value', ""));
    $.get("{{ route('dynamicLevel') }}", {
        course_id: course_id
    }, function(data) {

        // console.log(data);
        $.each(data, function(i, l) {
            $(level).append($('<option/>', {
                value: l.level_id,
                text: l.level
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

    $('#class_id1').on('change', function(e) {

        var class_id = $(this).val();
        var course_id = $('#course_id1')
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


    // {{----------------------------Update class Schedule Status---------------------}}  


    //         function Status(){
    //     $('.js-switch').change(function () {
    //         alert(1)
    //         let status = $(this).prop('checked') === true ? 1 : 0;
    //         let scheduleId = $(this).data('id');
    //         $.ajax({
    //             type: "GET",
    //             dataType: "json",
    //             url: '{{ url('schedule/status/update') }}',
    //             data: {'status': status, 'schedule_id': scheduleId},
    //             success: function (data) {
    //                 console.log(data.message);
    //                 // success: function (data) {
    //                 toastr.options.closeButton = true;
    //                 toastr.options.closeMethod = 'fadeOut';
    //                 toastr.options.closeDuration = 100;
    //                 toastr.success(data.message);
    // // }
    //             }
    //         });
    //     });
    // }

    $(document).ready(function() {

        // function Status(){
        $('.js-switch').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let scheduleId = $(this).data('id');
            // alert(scheduleId)
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ url('
                schedule / status / update ') }}',
                data: {
                    'status': status,
                    'schedule_id': scheduleId
                },
                success: function(data) {
                    console.log(data);
                    console.log(data.message);
                    // success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                    // }
                }
            });
        });
        // }
    })

    // let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

});
</script>
        @endsection