@extends('layouts.app')

@section('content')
<section class="content-header">
@include('table_style')
    @php
   if(isset($class_id)){

   }else{
    $class_id ='';
   }
    @endphp
<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa" aria-hidden="true">@if($class_id=='') Teacher Timetable @else Student Timetable @endif</i></h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>
</section>


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
  @if(!empty($class_name))
  <h3>
  @if($class_name->gender == 0) <b style="color:black"> Mr.</b>
  @else  <b style="color:black"> Mr'<sup>s</sup>.</b> @endif
  {{$class_name->last_name }}'<sup style="color:black">s</sup> <strong style="color:black">TIME TABLE</strong>
  </h3>
  @else
  <tr class="bordered-tr">
    <td colspan="12" class=" bordered-td">
    <div class="alert alert-danger text-center" style="font-weight:bolder">
          No TimeTble Found for this Teacher!
          <a href="{{ route('classSchedules.index') }}"><button class="btn btn-success btn-lg pull-right">Assign TimeTable</button></a>
    </div>
   </td>
    </tr>
  @endif

  <div class="tab-content">
         <!-- MONDAY TIME TABLE  -->
    <div id="home" class="tab-pane in fade active">
   <div class="pull-right">
    @include('timetables.printoptions.teachers.printbuttons')
   </div>

      <table style="border-collapse:collapse;" class="table table-striped table-bordered table-hover" id="timetable-table">
        <thead>
       <tr>
        {{-- @foreach($days as $day) --}}
        <th>DAYS</th>
        <th>CODE</th>
        <th>COURSE</th>
        <th>CLASS</th>
        <th>CREDIT</th>
        <th>ROOM</th>
        <th>GRADE</th>
        <th>PROFESSOR</th>
        <th>TIME</th>
        {{-- <th colspan="3">ACTION</th> --}}
        {{-- @endforeach --}}
       </tr>
    </thead>
    <tbody id="accordion">
        @foreach ($teachertimetables as $teacher)
        @if(count($teachertimetables)>0)

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
       </tr>
       @else
       <tr class="bordered-tr">
       <td colspan="12" class=" bordered-td">
       <div class="alert alert-danger text-center" style="font-weight:bolder">
             No TimeTble Found for {{$teacher->first_name}} {{$teacher->last_name}}
       </div>
      </td>
       </tr>
     @endif
      @endforeach

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
