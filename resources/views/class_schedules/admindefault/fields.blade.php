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

$(document).ready(function(){
    //   alert(1)
    })
//{{---------------------Show Start Date-------------------}}  
   
$('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
    //    $('#start_date1').datetimepicker({
    //                     format: 'YYYY-MM-DD',
    //                     useCurrent: false
    //                     // autoCompelete: false
    //                 });
    //  {{----------------------------Show End Date---------------------}}  
        //      $('#end_date1').datetimepicker({
        //    format:'YYYY-MM-DD',
        //     useCurrent: false
        //     // autoComplete: false
        // });

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