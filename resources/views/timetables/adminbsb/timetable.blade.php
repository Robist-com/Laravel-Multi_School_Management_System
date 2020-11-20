<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h2>TIMETABLES </h2>
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

        <div class="card">
            <div class="header">
                <h2>
                    TIMETABLES
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
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form action="{{  url('/generate-class-timetable')}}" method="POST">
                            @csrf
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control bootstrap-select" name="semester_id" id="semester_id">
                                        <option value="">Select Grade</option>
                                        @foreach($semesters as $semester)
                                        <option value="{{$semester->id}}" @if(request('semester_id')==$semester->id)
                                            selected @endif>{{$semester->semester_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control bootstrap-select " name="class_id" id="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->class_code}}" @if(request('class_id')==$class->
                                            class_code)
                                            selected @endif>{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control bootstrap-select " name="faculty_id" id="faculty_id">
                                        <option value="">Select Faculty</option>
                                        @foreach($faculty as $faculty)
                                        <option value="{{$faculty->faculty_id}}" @if(request('faculty_id')==$faculty->
                                            faculty_id) selected @endif>{{$faculty->faculty_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control bootstrap-select " name="degree_id" id="degree_id">
                                        <option value="">Select Degree</option>
                                        @foreach($levels as $level)
                                        <option value="{{$level->id}}" @if(request('degree_id')==$level->id) selected
                                            @endif>{{$level->level}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control bootstrap-select" name="department_id"
                                        id="department_id">
                                        <option selected disabled>Select Department</option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->department_id}}"
                                            @if(request('department_id')==$department->department_id) selected
                                            @endif>{{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="modal-footer">
                                    <button class="btn bg-teal btn-round" id="generate_btn">GENERATE TIMETABLE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if(isset($classtimetables))
                @include('timetables.adminbsb.class.timetable')
                @endif

            </div>
        </div>
    </div>
</div>







@section('js')
<script>
$(document).ready(function() {

    var degree_id = $('#semester_id').val();
    var department_id = $('#faculty_id').val();
    // alert(degree_id)
    if (degree_id != '' && department_id != '') {
        $('#degree_id').show();
        $('#department_id').show();
        $('#generate_btn').show();

    } else {
        $('#degree_id').hide();
        $('#department_id').hide();
        $('#generate_btn').hide();
    }

    // GET SEMESTER DEGREEE
    $('#semester_id').on('change', function(e) {
        //   getStudentsByclass()
        var semester_id = $(this).val();
        var degree = $('#degree_id')
        $(degree).empty();
        $(degree).append($('<option>').text("--Select level--").attr('value', ""));
        $.get("{{ route('dynamicDegrees') }}", {
            grade_id: semester_id
        }, function(data) {

            console.log(data);
            $.each(data, function(i, l) {
                $(degree).append($('<option/>', {
                    value: l.id,
                    text: l.level
                }))
                $('#degree_id').show();
            })
        })
    });

    // GET DEPARTMENT BY FACULTY
    $('#faculty_id').on('change', function(e) {
        //   getStudentsByclass()
        var faculty_id = $(this).val();
        var department_id = $('#department_id')
        $(department_id).empty();
        $(department_id).append($('<option>').text("--Select student group--").attr('value', ""));
        $.get("{{ route('dynamicDepartments') }}", {
            faculty_id: faculty_id
        }, function(data) {

            console.log(data);
            $.each(data, function(i, l) {
                $(department_id).append($('<option/>', {
                    value: l.department_id,
                    text: l.department_name
                }));
                $('#department_id').show();

            })
        })
    });

    $('#department_id').on('change', function() {
        $('#generate_btn').show();
    })
});
</script>
@endsection