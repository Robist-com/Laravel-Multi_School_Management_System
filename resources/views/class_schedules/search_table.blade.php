
@include('class_schedule-table_style')

 <table class="table table-striped table-hover" id="classSchedules-table" >
    <thead>
        <tr>
            <th rowspan="1">Classs</th>
            <th rowspan="2">Faculty & Department</th>
            <th rowspan="2">Courses</th>
            <th rowspan="2">Semesters</th> 
            <th rowspan="2"style="text-align: center; background:#ccc">Days</th>
            <th rowspan="1"style="text-align: center; background:#ccc">Room</th>
            <th rowspan="2"style="text-align: center; background:#ccc">Date</th>
            <th rowspan="2"style="text-align: center; background:#ccc">Status</th>
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

<td style="text-align:center">
        <input type="checkbox" data-id="{{ $classSchedule->Scheduleid }}" name="status" 
        class="js-switch" {{ $classSchedule->schedule_status == 1 ? 'checked' : '' }}>
 </td>
            </tr>
        @endforeach
        </tbody>
    </table>

