@include('table_style')

<style>
    .btn-block{
        height:28px;
        text-emphasis: center;
        text-anchor: top;
    }
</style>

@php
    $date = date('d-m-Y');
@endphp

<div class="panel-default">
    <div class="panel-heading">
    <a href="#"> <button class="btn bg-navy pull-right" data-toggle="modal" data-target="#ReportList">Attendance Report</button></a>
        <h3 style="font-weight:bold;text-transform: uppercase; text-align:left">
            <i class="fa fa-calendar"></i> attendance' <sup>s</sup> <b style="color:red">  list</b>
           </h3>
    </div>
    <div class="panel-body">
        
<div class="row">
    <div class="col-md-3">
        <form action="{{url('/search/attendance/by/roll_no')}}" method="get">
         <div class="form-group">
            <div class="input-group">
            <input type="search" name="roll_no" id="roll_no" class="form-control" placeholder="Roll No."/>
            <span class="input-group-btn">
                <button id="filter" class="btn btn-primary btn-block" onclick="searchStationTable();">
                    <span class="glyphicon glyphicon-search">Search</span>
                </button>
            </span>
            </div>
         </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-3">
            <form action="{{url('/search/attendance/by/class')}}" method="get">
             <div class="form-group">
                <div class="input-group">
                    <select name="class_id" id="class_id" class='form-control select_2_single'>
                        <option value="" selected disabled>select class</option>
                        @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{$class->class_name}}</option>
                        @endforeach
                    </select>

                <span class="input-group-btn">
                    <button id="filter" class="btn btn-primary btn-block" onclick="searchStationTable();">
                        <span class="glyphicon glyphicon-search">Search</span>
                    </button>
                </span>
            </form>
                </div>
             </div>
        </div>

    <div class="col-md-3">
        <form action="{{url('/search/attendance/by/date')}}" method="get">
        <div class="form-group">
           <div class="input-group">
           <input type="search" name="attendance_date" id="attendance_date" class="form-control" placeholder="Date" autocomplete="off" />
           <span class="input-group-btn">
               <button id="filter" class="btn btn-primary btn-block" onclick="searchStationTable();">
                   <span class="glyphicon glyphicon-search">Search</span>
               </button>
           </span>
           </div>
        </div>
    </form>
   </div>
</div>
</div>
{{-- @if ($edited_date =="")
<a href="{!! url('/edit/attendance/'.$edited_date->attendance_date) !!}"><button class="btn btn-primary pull-right" name="edit_date" type="submit"><i class="fa fa-edit"></i> Edit Attendance</button></a>
<a href="{!! url('/delete/attendance/'.$edited_date->attendance_date) !!}"><button class="btn btn-danger pull-right" name="delete_date" type="submit"><i class="fa fa-trash"></i> Delete Attendance</button></a>
@endif --}}

</div>
</div>


<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="student">
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
            <td><img src="{{asset('student_images/'.$item->image)}}" alt=""
                class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
            <td>{{$item->roll_no}}</td>
            <td>{{$item->student_first_name ." ". $item->student_last_name}}</td>
            <td> 
                @if ($item->attendance_status == 'present')
                <div style="background-color:#27AE60;color:#fff;">Present</div>
               @elseif ($item->attendance_status == 'absent')
               <div style="background-color:#E74C3C;color:#fff;">Absent</div>
               @elseif ($item->attendance_status == 'late')
               <div style="background-color:#3498DB;color:#fff;">Late</div>
               @else
               <div style="background-color:#A569BD;color:#fff;">Sick</div>
                @endif
            </td>
            <td> {{$item->class_name}}</td>
            <td> {{$item->course_name}}</td>
            <td> {{$item->teacher_first_name ." ". $item->teacher_last_name}}</td>
            <td> {{$item->attendance_date}}</td>
            <td colspan="3"> 
            <a href="{!! url('/edit/attendance/'.$item->attendance_date) !!}"><button name="edit_date" type="submit"><i class="fa fa-edit"></i></button></a>
            </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="10"> 
                    <h1 align='center' class=' alert alert-danger'>No Attendance Found Under This Date!, Please Try Another Date.</h1>
                </td>
            </tr>
            @endif

        </tbody>
    </table>
</div>

@include('attendances.attendance_report.report_list')

@section('scripts')
<script type="text/javascript">
   $('#attendance_date').datetimepicker({
                        format: 'DD-MM-YYYY',
                        useCurrent: false
                        // autoCompelete: false
                    });

    $('#attendance_date').on('clcik',function(){
        alert(1)
    })
</script>
@endsection