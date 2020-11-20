<style>
.btn-block {
    height: 28px;
    text-emphasis: center;
    text-anchor: top;
}
</style>

@php
$date = date('d-m-Y');
@endphp

<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>ATTENDANCE </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <!-- <a href="{{route('batches.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a> -->
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">

                   <h2>MARK ATTENDANCE</h2>

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

                    <div class="row">
                        <form action="{{route('attendances.index')}}" method="GET">
                            <!-- @csrf -->

                            @if(auth()->user()->group == "Admin")
                            <div class="col-md-12">
                                <label for="">School <b style="color:red">*</b></label>
                                <select name="school_id" id="school_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach(auth()->user()->school->all() as $school)
                                    <option value="{{$school->id}}"
                                        @if(isset($classstudentreport_single)){{$school->id == $classstudentreport_single->school_id ? 'selected' : '' }}
                                        @endif>{{$school->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                            <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                            @endif

                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="">Grade <b style="color:red">*</b></label>
                                <select name="grade_id" id="grade_id" class="form-control bootstrap-select">
                                    <option value="">Select</option>
                                    @foreach(App\Models\Semester::where('school_id', auth()->user()->school->id)->get()
                                    as $grade)
                                    <option value="{{$grade->id}}">{{$grade->semester_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Class <b></b></label>
                                <select name="class_id" id="class_id" class="form-control bootstrap-select" onchange="getData(this);">
                                    <option value="" selected="true">Select</option>
                                    @foreach ($classes as $class)
                                    <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="">Date <b></b></label>
                                <div class="form-line">
                                <input type="search" name="attendance_date" id="attendance_date" class="form-control"
                                    placeholder="Date" autocomplete="off" />
                            </div>
                            </div>
                            </div>

                            <div class=" pull-right " style="margin-top:10px">
                                <button type="submit" class="btn bg-teal btn-round"><i
                                        class="fa fa-search"></i>search</button>
                            </div>

                        </form>
                    </div>
                    <hr>

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive js-exportable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Roll No.</th>
                                <th>Student Name</th>
                                <th>Status</th>
                                <th>Class</th>
                                <th>Course</th>
                                <th>Teacher</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($attendances->where('attendance_date', $date))
                            @foreach ($attendances as $key => $item)
                            <tr>
                                <td><img src="{{asset('student_images/'.$item->image)}}" alt="" class="rounded-circle"
                                        width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
                                <td>{{$item->roll_no}}</td>
                                <td>{{$item->student_first_name ." ". $item->student_last_name}}</td>
                                <td>
                                    @if ($item->attendance_status == 'present')
                                    <div><span class="label bg-green">Present</span></div>
                                    @elseif ($item->attendance_status == 'absent')
                                    <div> <span class="label bg-red">Absent</span></div>
                                    @elseif ($item->attendance_status == 'late')
                                    <div><span class="label bg-purple">Late</span></div>
                                    @else
                                    <div><span class="label bg-blue">Late</span> Sick</div>
                                    @endif
                                </td>
                                <td> {{$item->class_name}}</td>
                                <td> {{$item->course_name}}</td>
                                <td> {{$item->teacher_first_name ." ". $item->teacher_last_name}}</td>
                                <td> {{$item->attendance_date}}</td>
                                <td colspan="3">
                                    <a href="{!! url('/edit/attendance/'.$item->attendance_date) !!}"
                                        class="btn btn-round bg-teal fa fa-edit" data-toggle="tooltip"
                                        data-placement="left" title="Edit attendance"></a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10">
                                    <h1 align='center' class=' alert alert-danger'>No Attendance Found Under This Date!,
                                        Please Try Another Date.</h1>
                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                    @include('flash::message')

                    @include('attendances.attendance_report.report_list')

                    @section('js')
                    <script type="text/javascript">
                    $('#attendance_date').datetimepicker({
                        format: 'd-m-Y',
                        // format: 'YYYY-MM-DD',
                        // useCurrent: false
                        // autoCompelete: false
                        timepicker:false,
                    });

                    $('#attendance_date').on('clcik', function() {
                    });

                    $("#class_id").on('change', function() {
                        var classid = $("#class_id").val();
                        var school_id = $("#school_id").val();
                        if ($('#class_id').val() == '') {
                            $('#addAttendance').hide();
                        } else {
                            $('#addAttendance').show();

                        }

                        $.ajax({
                            type: 'get',
                            dataType: 'html',
                            url: '{{ route ("attendances.index")}}',
                            data: {
                                'class_id': classid,
                                'school_id': school_id
                            },

                            beforeSend: function() {
                                $('#wait').css("visibility", "visible");
                            },

                            success: function(data) {
                                console.log(data);
                                $("#datatable-responsive1").html(data);

                                if (data == '') {
                                    // $("#addAttendance2").hide();
                                    // $("#addAttendance1").hide();
                                    $(".addAttendance").css("display", "none");
                                    $(".addAttendance").prop("disabled", true);
                                    $("#addAttendance2").css("display", "none");
                                } else {
                                    // $("#addAttendance2").show();
                                    // $("#addAttendance1").show();
                                    $(".addAttendance").css("display", "block");
                                    $("#addAttendance2").css("display", "block");

                                }

                            },
                            complete: function() {
                                $('#wait').css("visibility", "hidden");
                            }
                        });
                    });
                    </script>
                    @endsection