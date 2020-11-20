<div class="page-title">
              <div class="title_left">
                <h2>MANAGE TIMETABLE</h2>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('timetables.index')}}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"> Return </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                <form action="{{  url('/generate-class-timetable')}}" method="post">
                    @csrf
                    <div class="form-group col-sm-4">
                    <select class="form-control select_2_single" name="semester_id" id="semester_id">
                    <option value="">Select Grade</option>
                    @foreach($semesters as $semester)
                    <option value="{{$semester->id}}" @if(request('semester_id') == $semester->id) selected @endif>{{$semester->semester_name}}</option>
                    @endforeach
                </select>
                </div>

            <!-- Level Id Field -->
            <div class="form-group col-sm-4">
                <select class="form-control select_2_single " name="class_id" id="class_id">
                <option value="">Select Class</option>
                    @foreach($classes as $class)
                    <option value="{{$class->class_code}}" @if(request('class_id') == $class->class_code) selected @endif>{{$class->class_name}}</option>
                    @endforeach
                </select>
                </div>

    <!-- Level Id Field -->
            <div class="form-group col-sm-4">
                <select class="form-control select_2_single " name="faculty_id" id="faculty_id">
                <option value="">Select Faculty</option>
                    @foreach($faculty as $faculty)
                    <option value="{{$faculty->faculty_id}}" @if(request('faculty_id') == $faculty->faculty_id) selected @endif>{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
                </div>
                    <!-- Level Id Field -->
                <div class="form-group col-sm-4" style="">
                    <select class="form-control select_2_single " name="degree_id" id="degree_id">
                    <option value="">Select Degree</option>
                    @foreach($levels as $level)
                    <option value="{{$level->id}}" @if(request('degree_id') == $level->id) selected @endif>{{$level->level}}</option>
                    @endforeach
                    </select>
                    </div>
                <!-- Course Id Field -->
                <div class="form-group col-sm-4" style="">
                {{-- <select class="form-control select_2_single" name="department_id" id="department_id">
                    <option selected disabled>Select Department</option>
                </select> --}}
                </div>

                <div class="form-group col-sm-4" style="">
                    <select class="form-control select_2_single" name="department_id" id="department_id">
                        <option selected disabled>Select Department</option>
                        @foreach($departments as $department)
                    <option value="{{$department->department_id}}" @if(request('department_id') == $department->department_id) selected @endif>{{$department->department_name}}</option>
                    @endforeach
                    </select>
                    </div>
                <div class="col-md-12">
                <div class="modal-footer">
                <button class="btn btn-info btn-round" id="generate_btn">GENERATE TIMETABLE</button>
                </div>
                </div>
                </form>

                @if(isset($classtimetables))
                @include('timetables.admindefault.class.timetable')
                @endif
                </div>
                </div>
              
                </div>
                </div>
               

@section('scripts')
<script>
    $(document).ready(function(){

      var degree_id =   $('#semester_id').val();
      var department_id =   $('#faculty_id').val();
        // alert(degree_id)
        if (degree_id != '' && department_id != '') {
            $('#degree_id').show();
            $('#department_id').show();
            $('#generate_btn').show();

        }else{
        $('#degree_id').hide();
        $('#department_id').hide();
        $('#generate_btn').hide();
        }
        
    // GET SEMESTER DEGREEE
    $('#semester_id').on('change',function(e){
    //   getStudentsByclass()
        var semester_id = $(this).val();
        var degree = $('#degree_id')
            $(degree).empty();
            $(degree).append($('<option>').text("--Select level--").attr('value',""));
        $.get("{{ route('dynamicDegrees') }}",{grade_id:semester_id},function(data){  
    
            console.log(data);
            $.each(data,function(i,l){
            $(degree).append($('<option/>',{
                value : l.id,
                text  : l.level
            }))
            $('#degree_id').show();
        }) 
    })
});

// GET DEPARTMENT BY FACULTY
        $('#faculty_id').on('change',function(e){
        //   getStudentsByclass()
        var faculty_id = $(this).val();
        var department_id = $('#department_id')
            $(department_id).empty();
            $(department_id).append($('<option>').text("--Select student group--").attr('value',""));
        $.get("{{ route('dynamicDepartments') }}",{faculty_id:faculty_id},function(data){  
                    
            console.log(data);
            $.each(data,function(i,l){
            $(department_id).append($('<option/>',{
                value : l.department_id,
                text  : l.department_name
            }));
        $('#department_id').show();

        }) 
    })
});

$('#department_id').on('change', function(){
    $('#generate_btn').show();
})
});
</script>
@endsection