
@include('class_schedule-table_style')
<div class="table-responsive">
<h3 style="font-weight:bold">MANAGE CLASS SCHEDULE</h3>
<hr class="line">
<section class="content-header">

    <div class="panel-body" id="add-class-info">
    <div class="form-group col-sm-1" style="padding-left:-0px;">
        <i class="badge badge glyphicon glyphicon-filter" style="background:red">FILTER-BY:</i>
    </div>
    
        <div class="form-group col-sm-3">
        <select class="form-control select_2_single" name="class_id" id="clas_id">
        <option value="">Select Class</option>
        <!-- here i will use foreach loop okay to fetch all the data from the controllerokay. -->
        @foreach($classes as $cla)
        <option value="{{$cla->class_code}}">{{$cla->class_name}}</option>
        @endforeach
    </select>
    </div>
    
    <!-- Course Id Field -->
    <div class="form-group col-sm-4">
    <select class="form-control select_2_single" name="course_id" id="cour_id">
        <option value="">Select Subject</option>
        @foreach($course as $cour)
        <option value="{{$cour->id}}">{{$cour->course_name}}</option>
        @endforeach
    </select>
    </div>
    
    <!-- Level Id Field -->
    <div class="form-group col-sm-3">
    <select class="form-control select_2_single " name="level_id" id="leve_id">
    <option value="">Select Level</option>
    @foreach($level as $lev)
        <option value="{{$lev->id}}">{{$lev->level}}</option>
        @endforeach
    </select>
    </div>
    <button type="button" class="btn btn-warning btn-sm" id='filter'>filter</button>
    </div>
    </div>
    </section>

<!-- <div class="panel panel-default"> -->
    <!-- <div class="panel-body"> -->
    <div  id="wait"></div>
<div class="panel-heading">
    <h4 style="font-weight:bold; color:red">SCHEDULE</h4>
</div>
 <table class="table table-hover" id="classSchedules-table" >
    <thead>
        <tr>
            <th rowspan="1">Classs</th>
            <th rowspan="2">Stud Group & Class Group</th>
            <th rowspan="2">Courses</th>
            <th rowspan="2">Grades</th> 
            <th rowspan="2"style="text-align: center; background:#ccc">Days</th>
            <th rowspan="1"style="text-align: center; background:#ccc">Room</th>
            <th rowspan="2"style="text-align: center; background:#ccc">Date</th>
            <!-- <th rowspan="2"style="text-align: center; background:#ccc">Status</th> -->
            <!-- <th rowspan="2"style="text-align: center; background:#ccc">Date</th> -->

            <!-- <th colspan="3">Action</th> -->
        </tr>

    </thead>
    <tbody>
    @foreach($classSchedule as $key => $classSchedule)
<tr>
<td class="col-md-2" style="padding-top:70px;">{!! $classSchedule->class_name !!}</td>
<td>
    <div class="top_row">
        <div>{!! $classSchedule->faculty_name !!}</div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classSchedule->department_name !!}</i>
        </div>
 </td>

 <td>
    <div class="top_row">
        <div>{!! $classSchedule->course_name !!}</div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classSchedule->level !!}</i>
        </div>
 </td>

<td>
    <div class="top_row">
        <div>{!! $classSchedule->semester_name!!}</div>
        <!-- <div>World</div> -->
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classSchedule->batch !!}</i>
        </div>
 </td>


 <td>
    <div class="top_row">
        <div><i class="badge badge-success">{!! $classSchedule->name !!}</i></div>
        <div><i class="badge badge-success"> {!! $classSchedule->time !!}</i> </div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classSchedule->shift !!}</i>
        </div>
 </td>

<td> 
<i class="badge badge-success">{!! $classSchedule->classroom_name !!}</i> 
<i class="badge badge-success">{!! $classSchedule->classroom_code !!}</i> 
</td>

<td> 
<div class="top_row">
Start <i class="badge badge-success">{!! date("d-M-Y", strtotime($classSchedule->start_date))!!}</i> 
</div>
<div class="top_row">
End <i class="badge badge-success">{!! date("d-M-Y", strtotime($classSchedule->end_date))!!}</i>
</div>
</td>

<!-- <td style="text-align:center">
        <input type="checkbox" data-id="{{ $classSchedule->schedule_id }}" name="status" 
        class="js-switch" {{ $classSchedule->schedule_status == 1 ? 'checked' : '' }}>
 </td> -->
            </tr>
        @endforeach
        </tbody>
    </table>
<!-- </div> -->
{{-- </div> --}}
<!-- </div> -->

@section('scripts')
  <script type="text/javascript">
 
 $(document).ready(function(){
    //  alert(1)
 })
</script>
        @endsection
