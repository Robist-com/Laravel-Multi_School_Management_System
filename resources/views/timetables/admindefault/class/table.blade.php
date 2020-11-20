@extends('layouts.app')

@section('content')
@include('class_schedule-table_style')
<div class="table-responsive">
<h1 style="font-weight:bold"><i class="fa fa-money"></i> CLASS SCHEDULE</h1>
<hr class="line">
<section class="content-header">

    <div class="panel-body" id="add-class-info">
    <div class="form-group col-sm-1" style="padding-left:-0px;">
        <i class="badge badge glyphicon glyphicon-filter" style="background:red">FILTER-BY:</i>
    </div>
    <form action="{{  url('/student-view-timetable')}}" method="get">
    
        <div class="form-group col-sm-3">
        <select class="form-control select_2_single" name="semester_id" id="semester_id">
        <option value="">Select Semester</option>
        @foreach($semester as $semester)
        <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
        @endforeach
    </select>
    </div>

    <!-- Level Id Field -->
    <div class="form-group col-sm-3">
        <select class="form-control select_2_single " name="degree_id" id="degree_id">
        <option value="">Select Degree</option>

        </select>
        </div>

            <!-- Level Id Field -->
    <div class="form-group col-sm-3">
        <select class="form-control select_2_single " name="class_id" id="class_id">
        <option value="">Select Class</option>
            @foreach($classes as $class)
            <option value="{{$class->class_code}}">{{$class->class_name}}</option>
            @endforeach
        </select>
        </div>

        <!-- Level Id Field -->
    <div class="form-group col-sm-3">
        <select class="form-control select_2_single " name="faculty_id" id="faculty_id">
        <option value="">Select Faculty</option>
            @foreach($faculty as $faculty)
            <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
            @endforeach
        </select>
        </div>
    
    <!-- Course Id Field -->
    <div class="form-group col-sm-4">
    <select class="form-control select_2_single" name="department_id" id="department_id">
        <option selected disabled>Select Department</option>

    </select>
    </div>
    <button type="submit" class="btn btn-info">filter</button>
      
    {{-- <a href="{{ url('FilterByCourseLevelClass','teacher_id') }}"><button type="button" class="btn btn-warning btn-sm" id='filter1'>filter</button></a>  --}}
    </div>
    </div>
    </section>

    </form>

<div class="panel panel-default">
    <!-- <div class="panel-body"> -->
    <div  id="wait"></div>
<div class="panel-heading">
    <h4 style="font-weight:bold; color:red">SCHEDULE</h4>
</div>
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
            {{-- <th rowspan="2"style="text-align: center; background:#ccc">Status</th> --}}
            <!-- <th rowspan="2"style="text-align: center; background:#ccc">Date</th> -->

            {{-- <th colspan="3">Action</th> --}}
        </tr>

    </thead>
    <tbody id="tbody">
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
            </tr>

            @endforeach

    </tbody>
    </table>
</div>
{{-- </div> --}}
<!-- </div> -->
 
@section('scripts')
<script>
$(document).ready(function(){
    
    

    // GET SEMESTER DEGREEE
    $('#semester_id').on('change',function(e){
        var semester_id = $(this).val();
        var degree = $('#degree_id')
            $(degree).empty();
        $.get("{{ route('dynamicDegrees') }}",{semester_id:semester_id},function(data){  
    
            console.log(data);
            $.each(data,function(i,l){
            $(degree).append($('<option/>',{
                value : l.degree_id,
                text  : l.degree_name
            }))
        }) 
    })
});

// GET SEMESTER DEGREEE
        $('#faculty_id').on('change',function(e){

        var faculty_id = $(this).val();
        var department_id = $('#department_id')
            $(department_id).empty();
        $.get("{{ route('dynamicDepartments') }}",{faculty_id:faculty_id},function(data){  
                    
            console.log(data);
            $.each(data,function(i,l){
            $(department_id).append($('<option/>',{
                value : l.department_id,
                text  : l.department_name
            }))
        }) 
    })
});



    // {{--------------------------------FILTER BY CLAss--------------------------------}}

   $("#clas_id1").on('change', function(){
       var classid = $("#clas_id").val();
    //    alert(classid);

       $.ajax({
           type: 'get',
           dataType: 'html',
           url: '{{ url ('/filter-class-by-class')}}',
           data: {'class_id': classid},
           
           success:function(response){
               console.log(response);
                   $("#tbody").html(response);
                   MargeCommonRows($('#tbody'));

                   let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                   elems.forEach(function(html) {
                   let switchery = new Switchery(html, { color: '#0A9913', secondaryColor: '#F80A20', jackColor: '#fff', jackSecondaryColor: '#fff' });

           });
           Status()
           }
       });
   });

   // {{--------------------------------FILTER BY COUR--------------------------------}}

   $("#cour_id1").on('change', function(){
       var courseid = $("#cour_id").val();
       // alert(classid);

       $.ajax({
           type: 'get',
           dataType: 'html',
           url: '{{ url ('/filter-class-by-course')}}',
           // data: 'course_id=' + courseid,
           data: {'course_id': courseid},
           success:function(response){
               console.log(response);
                   $("#classSchedules-table").html(response);
                   MargeCommonRows($('#classSchedules-table'));

                   let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                   elems.forEach(function(html) {
                   let switchery = new Switchery(html, { color: '#0A9913', secondaryColor: '#F80A20', jackColor: '#fff', jackSecondaryColor: '#fff' });

           });
           Status()
           }
       });
   });

    // {{--------------------------------FILTER BY LEVEL--------------------------------}}

   $("#leve_id1").on('change', function(){
       var levelid = $("#leve_id").val();
       // alert(classid);

       $.ajax({
           type: 'get',
           dataType: 'html',
           url: '{{ url ('/filter-class-by-level')}}',
           // data: 'level_id=' + levelid,
           data: {'level_id': levelid},
           success:function(response){
               console.log(response);
                   $("#classSchedules-table").html(response);
                   MargeCommonRows($('#classSchedules-table'));

                    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                   elems.forEach(function(html) {
                   let switchery = new Switchery(html, { color: '#0A9913', secondaryColor: '#F80A20', jackColor: '#fff', jackSecondaryColor: '#fff' });

           });
           Status()
           }
       });
      
   });

    // {{--------------------------------FILTER BY COUR AND LEVEL--------------------------------}}

   $("#filter").click(function(){
       var courseid = $("#cour_id").val();
       var levelid = $("#leve_id").val();
       var classid = $("#class_id").val();
       // $("#clas_id").val('');

       $.ajax({
           type: 'get',
           dataType: 'html',
           url: '{{ url ('/filter-class-by-course-level-class')}}',
           data: {'course_id': courseid, 'level_id': levelid, 'class_id': classid},
           // data: 'course_id=' + courseid + '&level_id=' + levelid,
           success:function(response){
               console.log(response);
                   $("#tbody").html(response);
                   MargeCommonRows($('#tbody'));

                    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                   elems.forEach(function(html) {
                   let switchery = new Switchery(html, { color: '#0A9913', secondaryColor: '#F80A20', jackColor: '#fff', jackSecondaryColor: '#fff' });

           });
           Status();
           }
       });
       
       $('#clas_id').val('');
   });


   function MargeCommonRows(table)
{
   var firstColumnBrakes = [];
   $.each(table.find('th'),function(i){
           var previous = null, cellToExtend = null, rowspan = 1;
           table.find("td:nth-child("+i+")").each(function(index,e){
           var jthis = $(this), content = jthis.text();
           if (previous == content && content !== "" && $.inArray(index, firstColumnBrakes) === -1){
               jthis.addClass('hidden');
               cellToExtend.attr("rowspan", (rowspan = rowspan+1));
           }else
           {
               if(i === 2) firstColumnBrakes.push(index);
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
   for(var i=1; i<=table.find('th').length; i++){
       var previous = null, cellToExtend = null, rowspan = 1;
       table.find("td:nth-child(" + i + ")").each(function(index, e){
           var jthis = $(this), content = jthis.text();
           // check if current row "break" exist in the array. If not, then extend rowspan:
           if (previous == content && content !== "" && $.inArray(index, firstColumnBrakes) === -1) {
               // hide the row instead of remove(), so the DOM index won't "move" inside loop.
               jthis.addClass('hidden');
               cellToExtend.attr("rowspan", (rowspan = rowspan+1));
           }else{
               // store row breaks only for the first column:
               if(i === 2) firstColumnBrakes.push(index);
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


       function Status(){
   $('.js-switch').change(function () {
       let status = $(this).prop('checked') === true ? 1 : 0;
       let scheduleId = $(this).data('id');
       $.ajax({
           type: "GET",
           dataType: "json",
           url: '{{ url('schedule/status/update') }}',
           data: {'status': status, 'schedule_id': scheduleId},
           success: function (data) {
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
}
   let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

});
       </script>
@endsection

@endsection
