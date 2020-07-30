<!--  here we will make our modal here okay. -->
 <!-- i will  just past the modal header code so you can follow and write it step by step okay. -->
 <style>
.border{
    border-radius:5px;
    height:30px;
}

#border{
    width:1px !important;
}
</style>
 <!------------------------------ Modal start from here okay-------------------------------- -->
 <div class="modal fade" id="Editclassschedule-show" tabindex="-1" role="dialog" 
 aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
            aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Class Scheduled</h4>
            </div>
             <div class="panel-body" style="border-bottom: 1px solid #ccc; ">
             <div class="form-group">

                 {{-- here we will add form here to able to update our edit data okay --}}
                <form action="{{route('classSchedules.update','Scheduleid')}}" method="post"> 
                     {{-- form open here --}}
                    @csrf
                    @method('PUT')
            <div class="row"></div> 
            <!-- <input type="text" name="id" id="id"> -->
            {{-- this parameter is just and empty string okay  --}}
            {{-- it will be hidden input for our classschedule id okay --}}
            <input type="hidden" name="Scheduleid" id="Scheduleid"> 
<!-- Class Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control border" name="class_id" id="class_id">
        <option value="">Select Class</option>
        <!-- here i will use foreach loop okay to fetch all the data from the controllerokay. -->
        @foreach($classes as $cla)
        <option value="{{$cla->id}}">{{$cla->class_name}}</option>
        @endforeach
    </select>
    </div>

    <!-- Course Id Field -->
    <div class="form-group col-sm-4">
   <select class="form-control border" name="course_id" id="course_id">
        <option value="">Select Course</option>
        @foreach($course as $cour)
        <option value="{{$cour->id}}">{{$cour->course_name}}</option>
        @endforeach
    </select>
</div>

<!-- Level Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control border" name="level_id" id="level_id">
   
    </select>
</div>
<!-- i will skip the level first because we need to extra code for the level it will
be dynamic value by the select of the course okay.... -->

<!-- Shift Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control border" name="shift_id" id="shift_id">
        <option value="">Select Shift</option>
        @foreach($shift as $shi)
        <option value="{{$shi->shift_id}}">{{$shi->shift}}</option>
        @endforeach
    </select>
</div>

<!-- Classroom Id Field -->
<div class="form-group col-sm-4">
    <select class="form-control border" name="classroom_id" id="classroom_id">
        <option value="">Select ClassRoom</option>
        @foreach($classroom as $room)
        <option value="{{$room->classroom_id}}">{{$room->classroom_name}}__{{$room->classroom_code}}</option>
        @endforeach
    </select>
</div>

<!-- Batch Id Field -->
<div class="form-group col-sm-4">
<select class="form-control border" name="batch_id" id="batch_id">
        <option value="">Select Batch</option>
        @foreach($batch as $bat)
        <option value="{{$bat->id}}">{{$bat->batch}}</option>
        @endforeach
    </select>
</div>

<!-- Day Id Field -->
<div class="form-group col-sm-4">
<select class="form-control border" name="day_id" id="day_id">
        <option value="">Select Day</option>
        @foreach($day as $d)
        <option value="{{$d->day_id}}">{{$d->name}}</option>
        @endforeach
    </select>
</div>

<!-- Time Id Field -->
<div class="form-group col-sm-4">
<select class="form-control " name="time_id" id="time_id">
        <option value="">Select Time</option>
        @foreach($time as $ti)
        <option value="{{$ti->time_id}}">{{$ti->time}}</option>
        @endforeach
    </select>
</div>

<!-- Semester Id Field -->
<div class="form-group col-sm-4">
<select class="form-control border" name="semester_id" id="semester_id">
        <option value="">Select Semester</option>
        @foreach($semester as $sem)
        <option value="{{$sem->semester_id}}">{{$sem->semester_name}})__{{$sem->semester_code}}</option>
        @endforeach
    </select>
</div>

<!-- Start Date Field -->
<div class="form-group col-sm-6">
        <label >Start Date</label>
        <input type="text" class="form-control border" name="start_date" id="start_date" autocomplete="off">
</div>

<!-- End Date Field -->
<div class="form-group col-sm-6">
        <label >End Date</label>
        <input type="text" class="form-control border" name="end_date" id="end_date" autocomplete="off">
</div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6" name="status" id="status">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!} 1
    </label>
</div>
</div>
      <!-- </div> -->
      <!-- </div> -->
        <div class="modal-footer ">
         <button type="submit" class="btn btn-warning btn-sm">Update Class Schedule</button>
          </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</form> {{-- form close here --}}

{{-- WE WILL CALL IT HERE --}}
@include('class_schedules.show_fields')

@section('scripts')
  <script type="text/javascript">
//{{---------------------Show Start Date-------------------}}  
   
       $('#start_date').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false
                        // autoCompelete: false
                    });
    //  {{----------------------------Show End Date---------------------}}  
             $('#end_date').datetimepicker({
           format:'YYYY-MM-DD',
            useCurrent: false
            // autoComplete: false
        });

    //     we will write our code here okay.
    $('#course_id').on('change',function(e){
                var course_id = $(this).val();
                var level = $('#level_id')
                    $(level).empty();
             $.get("{{ route('dynamicLevel') }}",{course_id:course_id},function(data){  
                    
                    // console.log(data);
                    $.each(data,function(index,l){
                    $(level).append($('<option/>',{
                        value : l.id,
                        text  : l.level
               }))
             }) 
         })
    })

// Here we wil write our edit Script okay to fetch our data from the modal.

// ------------------------------------Edit--------------------------------

$(document).on('click', '#Edit', function(data){
    var Scheduleid = $(this).data('id');
    // alert(Scheduleid)

    // now we need to write route for this edit okay..
    $.get("{{ route('edit')}}", {Scheduleid:Scheduleid}, function(data){
        $("#course_id").val(data.course_id);
        $("#level_id").val(data.level_id);
        $("#shift_id").val(data.shift_id);
        $("#time_id").val(data.time_id);
        $("#day_id").val(data.day_id);
        $("#classroom_id").val(data.classroom_id);
        $("#batch_id").val(data.batch_id);
        $("#batch_id").val(data.batch_id);
        $("#semester_id").val(data.semester_id);
        $("#start_date").val(data.start_date);
        $("#end_date").val(data.end_date);
        $("#class_id").val(data.class_id);
        $("#Scheduleid").val(data.Scheduleid); 
        $("#status").val(data.status);
            console.log(data);
        // we will use the input id's okay
        // let's check if we are ahving the data's or not okay..
    });
});

// ------------------------------------SHOW SCRIPT--------------------------------

// we will change this and use the bootstrap find function it's more easy to use and simple okay.
$('#Viewclassschedule-show').on('show.bs.modal',  function(event){
   var button = $(event.relatedTarget)
   var course_id = button.data('course_id') // we will use the variable inside that value okay.
   var level_id = button.data('level_id')
   var shift_id = button.data('shift_id')
   var time_id = button.data('time_id')
   var day_id = button.data('day_id')
   var classroom_id = button.data('classroom_id')
   var batch_id = button.data('batch_id')
   var semester_id = button.data('semester_id')
   var start_date = button.data('start_date')
   var end_date =  button.data('end_date')
   var class_id = button.data('class_id')
   var Scheduleid = button.data('Scheduleid')
   var status = button.data('status')
    console.log(event);
    var modal = $(this)

    // and here we will use the find function to fetch the data okay...
    modal.find('.modal-title').text('Class Schedule View');
    modal.find('.modal-body #course_id').val(course_id);
    modal.find('.modal-body #level_id').val(level_id);
    modal.find('.modal-body #shift_id').val(shift_id);
    modal.find('.modal-body #time_id').val(time_id);
    modal.find('.modal-body #day_id').val(day_id);
    modal.find('.modal-body #classroom_id').val(day_id);
    modal.find('.modal-body #batch_id').val(batch_id);
    modal.find('.modal-body #semester_id').val(semester_id);
    modal.find('.modal-body #start_date').val(start_date);
    modal.find('.modal-body #end_date').val(end_date);
    modal.find('.modal-body #class_id').val(class_id);
    modal.find('.modal-body #status').val(status);
    modal.find('.modal-body #Scheduleid').val(Scheduleid);

});

    // GET SEMESTER DEGREEE
        $('#semester_id1').on('change',function(e){
        var grade_id = $(this).val();
        var degree = $('#degree_id1')
            $(degree).empty();
        $.get("{{ route('dynamicDegrees') }}",{grade_id:grade_id},function(data){  
    
            console.log(data);
            $.each(data,function(i,l){
            $(degree).append($('<option/>',{
                value : l.id,
                text  : l.level
            }))
        }) 
    })
});

// GET SEMESTER DEGREEE
        $('#faculty_id1').on('change',function(e){

        var faculty_id = $(this).val();
        var department_id = $('#department_id1')
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
                var level = $('#level_id1')
                    $(level).empty();
             $.get("{{ route('dynamicLevel') }}",{course_id:course_id},function(data){  
                    
                    // console.log(data);
                    $.each(data,function(i,l){
                    $(level).append($('<option/>',{
                        value : l.level_id,
                        text  : l.level
               }))
             }) 
         })
    });

$('document').ready(function(){
//   alert('hello');

function ShowTeacherClassAssign(teacher_id)
{
    $.get("{{ url('show-class-assign') }}",{teacher_id:teacher_id}, function(){
            alert('hello');
        $('#class-schedule-info').empty().append(data);
        MargeCommonRows($('#table-class-info'));
    })
}

$('#department_id1').on('change',function(e){

var department_id = $(this).val();
var class_id = $('#class_id1')
    $(class_id).empty();
$.get("{{ route('dynamicDepartmentsWithClass') }}",{department_id:department_id},function(data){  
    
console.log(data);
$.each(data,function(i,c){
$(class_id).append($('<option/>',{
value : c.class_code,
text  : c.class_name
}))
}) 
})
});

$('#class_id1').on('change',function(e){

var class_id = $(this).val();
var course_id = $('#course_id1')
    $(course_id).empty();
$.get("{{ route('dynamicCourse') }}",{class_id:class_id},function(data){  
    
console.log(data);
$.each(data,function(i,c){
$(course_id).append($('<option/>',{
value : c.id,
text  : c.course_name
}))
}) 
})
});

// Function for Search data 

  $("#search").on("keyup", function() {
    // alert('hello')
    var value = $(this).val().toLowerCase();
    $("#table-class-info tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    MargeCommonRows($('#table-class-info'));
  });

  MargeCommonRows($('#classSchedules-table'));

// })

// $(document).ready(function(){
	
     // {{--------------------------------FILTER BY CLAss--------------------------------}}

	$("#clas_id").on('change', function(){
		var classid = $("#clas_id").val();
		// alert(classid);
        // alert(1)
		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '{{ url ('/filter-classSchedules-by-class')}}',
			data: {'class_id': classid},
            
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

    // {{--------------------------------FILTER BY COUR--------------------------------}}

    $("#cour_id").on('change', function(){
		var courseid = $("#cour_id").val();
		// alert(classid);

		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '{{ url ('/filter-classSchedules-by-course')}}',
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

    $("#leve_id").on('change', function(){
		var levelid = $("#leve_id").val();
		// alert(classid);

		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '{{ url ('/filter-classSchedules-by-level')}}',
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
		// $("#clas_id").val('');

		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '{{ url ('/filter-classSchedules-by-course-level')}}',
            data: {'course_id': courseid, 'level_id': levelid},
			// data: 'course_id=' + courseid + '&level_id=' + levelid,
			success:function(response){
				console.log(response);
					$("#classSchedules-table").html(response);
                    MargeCommonRows($('#classSchedules-table'));

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


//         function Status(){
//     $('.js-switch').change(function () {
//         alert(1)
//         let status = $(this).prop('checked') === true ? 1 : 0;
//         let scheduleId = $(this).data('id');
//         $.ajax({
//             type: "GET",
//             dataType: "json",
//             url: '{{ url('schedule/status/update') }}',
//             data: {'status': status, 'schedule_id': scheduleId},
//             success: function (data) {
//                 console.log(data.message);
//                 // success: function (data) {
//                 toastr.options.closeButton = true;
//                 toastr.options.closeMethod = 'fadeOut';
//                 toastr.options.closeDuration = 100;
//                 toastr.success(data.message);
// // }
//             }
//         });
//     });
// }

$(document).ready(function(){

// function Status(){
    $('.js-switch').change(function () {
    let status = $(this).prop('checked') === true ? 1 : 0;
    let scheduleId = $(this).data('id');
    // alert(scheduleId)
    $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ url('schedule/status/update') }}',
        data: {'status': status, 'schedule_id': scheduleId},
        success: function (data) {
            console.log(data);
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
// }
})

    // let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

});
        </script>
        @endsection