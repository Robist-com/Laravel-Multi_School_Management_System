<div class="panel  panel-default"> 
                    
    <div class="panel-heading">
      <h3 style="font-weight:bold;text-transform: uppercase; text-align:left">
       <i class="fa fa-calendar"></i> GENERATE CLASS<b style="color:red">TIMETABLE</b>
       {{-- <button class="btn btn-default pull-right">Back</button> --}}
      <a href="{{route('admissions.index')}}"><button class="pull-right" style="margin-left:900px;margin-bottom:80px" title="back to timetable">Back</button></a>
      </h3>
      </div>
      <div class="panel-body">
<form action="{{  url('/generate-class-timetable')}}" method="get">
                          
    <div class="form-group col-sm-4">
    <select class="form-control select_2_single" name="semester_id" id="semester_id">
    <option value="">Select Grade</option>
    @foreach($semesters as $semester)
    <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
    @endforeach
</select>
</div>

            <!-- Level Id Field -->
            <div class="form-group col-sm-4">
                <select class="form-control select_2_single " name="class_id" id="class_id">
                <option value="">Select Class</option>
                    @foreach($classes as $class)
                    <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                    @endforeach
                </select>
                </div>

    <!-- Level Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control select_2_single " name="faculty_id" id="faculty_id">
    <option value="">Select Faculty</option>
        @foreach($faculty as $faculty)
        <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
        @endforeach
    </select>
    </div>



    <!-- Level Id Field -->
<div class="form-group col-sm-4" style="">
    <select class="form-control select_2_single " name="degree_id" id="degree_id">
    <option value="">Select Degree</option>

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
    </select>
    </div>
<div class="col-md-12">
    <button class="btn btn-info">GENERATE TIMETABLE</button>
</div>
</form>
</div>
</div>
</div>

@section('scripts')
<script>
    $(document).ready(function(){
        $('#degree_id').hide();
        $('#department_id').hide();
    // GET SEMESTER DEGREEE
    $('#semester_id').on('change',function(e){
    //   getStudentsByclass()
        var semester_id = $(this).val();
        var degree = $('#degree_id')
            $(degree).empty();
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
});
</script>
@endsection