@extends('layouts.app')

@section('content')
@include('table_style')
    @php
   if(isset($class_id)){

   }else{
    $class_id ='';
   }
    @endphp

    <style>
      th{
        width:125;
      }
      h3{
        font-family: 'Times New Roman', Times, serif;
        font-style:initial;
        font-weight: bolder;
        text-transform: uppercase;
        color:red;
      }
    </style>
     <section class="content-header">
      <div class="box box-primary">
        <div class="box-body">
      <h2><i class="glyphicon glyphicon-user"></i> @if($class_id=='') Teacher Timetable @else Student Timetable @endif
        <a href="timetables"><button class="pull-right" title="back to timetable">Back</button></a>
      </h2>
    </div>
    <hr class="line">
  </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

  {{-- <ul class="nav nav-pills">
    <li class="nav-item active"><a class="nav-link active" data-toggle="pill" href="#home">Monday</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu1">Tuesday</a></li>
    <li class="nav-item"><a  class="nav-link"data-toggle="pill" href="#menu2">Wednesday</a></li>
    <li class="nav-item"><a  class="nav-link"data-toggle="pill" href="#menu3">Thursday</a></li>
     <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu4">Friday</a></li>
      <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu5">Sturday</a></li>
       <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu6">Sunday</a></li>
  </ul> --}}
  <h3>
    {{$class_name->class_name }} <strong style="color:black">TIME TABLE</strong>
    <b class="pull-right"> {{$class_name->semester_name }}</b>
  </h3>

  <div class="tab-content">
         <!-- MONDAY TIME TABLE  -->
    <div id="home" class="tab-pane in fade active">
   <div class="pull-right">
    @include('timetables.printoptions.classes.printbuttons')
   </div>

      <table style="border-collapse:collapse;" class="table table-striped table-bordered table-hover" id="timetable-table">
        <thead>
       <tr>
        {{-- @foreach($days as $day) --}}
        <th>DAYS</th>
        <th>CODE</th>
        <th>SUBJECT</th>
        <th>CLASS</th>
        <th>CREDIT</th>
        <th>ROOM</th>
        <th>GRADE</th>
        <th>TEACHER</th>
        <th>TIME</th>
        {{-- <th colspan="3">ACTION</th> --}}
        {{-- @endforeach --}}
       </tr>
    </thead>
    <tbody id="accordion">
    @if($classtimetables)
        @foreach ($classtimetables as $teacher)

     <tr>
       <tr>
        <th>{{$teacher->name}}</th>
        <td style="text-align: center;">{{$teacher->code}}</a></td>
        <td style="text-align: center;background-color:#f0f0f0" class="align-middle text-center">{{$teacher->course_name}}</td>
        <td style="text-align: center;">@if(isset($teacher->class_name)) {{ $teacher->class_name }} @endif</td>
        <td style="text-align: center;">----</td>
        <td style="text-align: center;">{{$teacher->classroom_name}}</td>
        <td style="text-align: center;">{{ $teacher->semester_name}}</td>
        <td style="text-align: center;"><a href="#" onclick="getteacherinfo('{{$teacher->teacher_id}}')">{{$teacher->first_name}}{{$teacher->last_name}}</a></td>
        <td style="text-align: center;">{{ $teacher->time}}</td>
        <td style="text-align: center;">{{ $teacher->end_time}}</td>
        {{-- <td style="text-align: center;">{{ $teacher->course_name }}</td> --}}
        {{-- <td style="text-align: center;">
            <a title='Edit' class='btn btn-info' href='{{url("/timetable/edit")}}/{{$teacher->timetable_id}}'> <i class="glyphicon glyphicon-edit icon-white"></i></a>
           &nbsp&nbsp<a title='Delete' class='btn btn-danger' onclick="confirmed('{{$teacher->timetable_id}}');" href='#' > <i class="glyphicon glyphicon-trash icon-white"></i></a>
          </td> --}}
       </tr>
      @endforeach
    @else
          <tr>
          <td></td>
          <td>No class</td>
          <td></td>
          <td></td>
          
          </tr>
    @endif

    </tbody>
    </table>
    {{-- </div> --}}
    </div>
  {{-- </div> --}}

      <!-- TUESDAY TIME TABLE  -->
    <div id="menu1" class="tab-pane fade">
    </div>

        <!-- WEDNESDAY TIME TABLE  -->
    <div id="menu2" class="tab-pane fade">

    </div>

            <!-- THURSDAY TIME TABLE  -->
    <div id="menu3" class="tab-pane">

    </div>

    <!-- FRIDAY TIME TABLE  -->
    <div id="menu4" class="tab-pane">

      </div>

      <!-- SATURDAY TIME TABLE  -->
    <div id="menu5" class="tab-pane">

      </div>

          <!-- SUNDAY TIME TABLE  -->
       <div id="menu6" class="tab-pane" style="width:200px">
    </div>
  </div>
</div>
<div class="text-center">

</div>
</div>
    <!-- The Modal -->
<div class="modal"  data-backdrop="" id="teacherModal" role="dialog" aria-labelledby="preview-modal" aria-hidden="true" style="margin-top: 100px;" >
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header-store">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Teacher Detail</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <table id="classList" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th style="width:30%">Name</th>
              <th style="width:30%">Phone</th>
              <th style="width:30%">Email</th>
            </tr>
          </thead>
          <tbody id="tdetails">

          </tbody>
          </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script>
$(document).ready(function(){
  MargeCommonRows($('#timetable-table'));
  MergeCommonRows($('#timetable-table'));
})
function getteacherinfo(teacher_id){
    //alert(teacher_id)
       $.ajax({
      url:"{{ url('/get/teacher') }}"+"/"+teacher_id,
      method:"GET",
      //data:{name:class_name,code:class_code,description:class_des, _token:_token},
      success:function(data){
          $("#tdetails").html(data);

          $('#teacherModal').modal('show');
      },

            error: function (textStatus, errorThrown) {
                alert(JSON.stringify(textStatus));
            }
     });
  }
 $('#timepicker1').timepicker();
  $('#timepicker2').timepicker();

  function confirmed(teacher_id){
    var x = confirm('Are you sure you want to delete timetable?');
                if (x){
                  window.location = "{{url('/timetable/delete/')}}/"+teacher_id;
                 return true;
                }else{
                  return false;
                }
  }

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

</script>
@endsection
