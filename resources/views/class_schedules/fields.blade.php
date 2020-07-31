<!--  here we will make our modal here okay. -->
 <!-- i will  just past the modal header code so you can follow and write it step by step okay. -->
 <style>
.border{
    border-radius:5px;
    height:30px;
}

#select_2_single{
    width:1px !important;
}
</style>
 <!------------------------------ Modal start from here okay-------------------------------- -->
 <div class="modal fade" id="classschedule-show" tabindex="-1" role="dialog" 
 aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" 
            aria-hidden="true">&times;</button>
            <h4 class="modal-title">Manage Class Scheduled</h4>
            </div>
             <div class="panel-body" style="border-bottom: 1px solid #ccc; ">
             <div class="form-group">

            <div class="row"></div>
            <!-- <input type="text" name="id" id="id"> -->

<!-- Semester Id Field -->
<div class="form-group col-sm-2">
    <select class="form-control select_2_single" name="semester_id" id="semester_id1">
            <option value="">Select Grade</option>
            @foreach($semester as $sem)
            <option value="{{$sem->id}}">{{$sem->semester_name}}</option>
            @endforeach
        </select>
    </div>

    <!-- Level Id Field -->
<div class="form-group col-sm-2">
    <select class="form-control select_2_single " name="degree_id" id="degree_id1">
        <option selected disabled>Select Level</option>

    </select>
</div>

<!-- Class Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control select_2_single" name="faculty_id" id="faculty_id1">
        <option value="">Select Student Group</option>
        @foreach($faculty as $faculty)
        <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
        @endforeach
    </select>
    </div>

    <!-- Class Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control select_2_single" name="department_id" id="department_id1">
        <option value="">Select Class Group</option>
    </select>
    </div>

<!-- Class Id Field -->
<div class="form-group col-sm-2">
    <select class="form-control select_2_single" name="class_id" id="class_id1">
        <option value="">Select Class</option>
        <!-- here i will use foreach loop okay to fetch all the data from the controllerokay. -->
        {{-- @foreach($classes as $cla)
        <option value="{{$cla->id}}">{{$cla->class_name}}</option>
        @endforeach --}}
    </select>
    </div>

    <!-- Course Id Field -->
    <div class="form-group col-sm-2">
   <select class="form-control select_2_single" name="course_id" id="course_id1">
        <option value="">Select Subject</option>
        @foreach($course as $cour)
        <option value="{{$cour->id}}">{{$cour->course_name}}</option>
        @endforeach
    </select>
</div>

{{-- <!-- Level Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control select_2_single " name="level_id" id="level_id1">
    @foreach($course as $lev)
        <option value="{{$lev->id}}">Select Level</option>
        @endforeach
    </select>
</div> --}}
<!-- i will skip the level first because we need to extra code for the level it will
be dynamic value by the select of the course okay.... -->

<!-- Shift Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control select_2_single" name="shift_id" id="shift_id1">
        <option value="">Select Shift</option>
        @foreach($shift as $shi)
        <option value="{{$shi->shift_id}}">{{$shi->shift}}</option>
        @endforeach
    </select>
</div>

<!-- Classroom Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control select_2_single" name="classroom_id" id="classroom_id1">
        <option value="">Select ClassRoom</option>
        @foreach($classroom as $room)
        <option value="{{$room->classroom_id}}">{{$room->classroom_name}}__{{$room->classroom_code}}</option>
        @endforeach
    </select>
</div>

<!-- Batch Id Field -->
<div class="form-group col-sm-2">
<select class="form-control select_2_single" name="batch_id" id="batch_id1">
        <option value="">Select Batch</option>
        @foreach($batch as $bat)
        <option value="{{$bat->id}}">{{$bat->batch}}</option>
        @endforeach
    </select>
</div>

<!-- Day Id Field -->
<div class="form-group col-sm-2">
<select class="form-control select_2_single" name="day_id" id="day_id1">
        <option value="">Select Day</option>
        @foreach($day as $d)
        <option value="{{$d->day_id}}">{{$d->name}}</option>
        @endforeach
    </select>
</div>

<!-- Time Id Field -->
<div class="form-group col-sm-4">
<select class="form-control select_2_single" name="time_id" id="time_id1">
        <option value="">Select Time</option>
        @foreach($time as $ti)
        <option value="{{$ti->time_id}}">{{$ti->time}}</option>
        @endforeach
    </select>
</div>

<!-- Day Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control select_2_single" name="teacher_id" id="teacher_id">
            <option value="">Select Teacher</option>
            @foreach($teachers as $teacher)
            <option value="{{$teacher->teacher_id}}">{{$teacher->first_name ." ". $teacher->last_name }}</option>
            @endforeach
        </select>
    </div>

<!-- Start Date Field -->
<div class="form-group col-sm-6">
        <label >Start Date</label>
        <input type="text" class="form-control border" name="start_date" id="start_date1" autocomplete="off">
</div>

<!-- End Date Field -->
<div class="form-group col-sm-6">
        <label >End Date</label>
        <input type="text" class="form-control border" name="end_date" id="end_date1" autocomplete="off">
</div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-1" name="status" id="status1">
<label class="container2">status
  <input type="checkbox" checked="checked" name="status">
  <span class="checkmark"></span>
</label>
</div>
</div>
      <!-- </div> -->
      <!-- </div> -->
        <div class="modal-footer ">
        <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
         <button type="submit" class="btn btn-success btn-sm">Generate Create Schedule</button>
          </div>
        </div>
    </div>
</div>

@section('scripts')
  <script type="text/javascript">
//{{---------------------Show Start Date-------------------}}  
   
       $('#start_date1').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                        // autoCompelete: false
                    });
    //  {{----------------------------Show End Date---------------------}}  
             $('#end_date1').datetimepicker({
           format:'YYYY-MM-DD',
            useCurrent: false
            // autoComplete: false
        });

    //     we will write our code here okay.
    $('#course_id1').on('change',function(e){
                var course_id = $(this).val();
                alert(course_id)
                var level = $('#level_id1')
                    $(level).empty();
             $.get("{{ route('dynamicLevel') }}",{course_id:course_id},function(data){  
                    
                    console.log(data);
                    $.each(data,function(i,l){
                    $(level).append($('<option/>',{
                        value : l.level_id,
                        text  : l.level
               }))
             }) 
         })
    });

 


    // lets check this inside the browser
        </script>
        @endsection