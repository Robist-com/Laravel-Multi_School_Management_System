@extends('layouts.app')

@section('content')

<section class="content-header">
<style>
.container{
	width:100%;
	padding: 15px;
	/* box-shadow: 0px 0px 2px; */
	margin: 0 auto;
}

table {
	width: 100%;
	border-collapse: collapse;
	text-align: left;
}

tr , th, td {
	border: 1px solid;
	padding: 5px;
    text-align:center;
    
    
}

th{
	background:#605ca8;
    text-align:center;
    color:#fff;
    font-weight:bold;
}

tbody > tr > td:last-child{
	/* background:#ccc; */
	
}
.badge{
    padding-top:2px;
    margin-top:3px;
}

.top_row {
    display: table;
    width: 100%;
}

.top_row > div {
    display: table-cell;
    width: 50%;
    border-bottom: 1px solid #eee;
}

</style>
 </section>
<form action="/search-teachers" method="GET">
    <table class="table" id="search-table" style="background:#fff">
        <tr style="background:#fff">
           <td style="border-style:none; box-shadow:5px;">
            <div class="input-group col-md-4 pull-right" style="padding-left:1px; margin-bottom:5px;">
            <input type="search" name="search" id="search" value="{{request('search')}}" 
            class="form-control " placeholder="Search Teacher by Name or ID" >
            <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
            </span>
        </div>
    </td>
        </tr>
    </table>
</form>

<table class="table" id1="classAssignings-table" id="table-class-info">
    <thead>
        <tr>
            <th rowspan="2">Teacher</th>
            <th rowspan="2">Course</th>
            <th rowspan="2">Semester</th> 
            <th rowspan="2"style="text-align: center; background:#ccc">Days</th>
            <th rowspan="2"style="text-align: center; background:#ccc">Room and Class</th>
            <th colspan="3">Action</th>
        </tr>

        <!-- <tr> -->
<!-- <th>Day and Time & Shift</th> -->
<!-- <th>Room and Class</th> -->
<!-- <th>Action</th> -->
<!-- <th>Boilogy</th> -->
<!-- <tr> -->
    </thead>
    <tbody>
    @foreach ($classAssignings as $classAssigning)
<tr>
<td class="col-md-2" style="padding-top:70px;">{!! $classAssigning->first_name !!} {!! $classAssigning->last_name !!}</td>
<!-- <td class="col-md-2">{!! $classAssigning->semester_name!!} <div style="text-decoration:underline">&nbsp;</div> <i class="badge badge-success"> {!! $classAssigning->batch !!}</i></td> -->

<td>
    <div class="top_row">
        <div>{!! $classAssigning->course_name !!}</div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classAssigning->level !!}</i>
        </div>
 </td>

<td>
    <div class="top_row">
        <div>{!! $classAssigning->semester_name!!}</div>
        <!-- <div>World</div> -->
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classAssigning->batch !!}</i>
        </div>
 </td>


 <td>
    <div class="top_row">
        <div><i class="badge badge-success">{!! $classAssigning->name !!}</i></div>
        <div><i class="badge badge-success"> {!! $classAssigning->time !!}</i> </div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classAssigning->shift !!}</i>
        </div>
 </td>

<td> 
<i class="badge badge-success">{!! $classAssigning->classroom_name !!}</i> 
<i class="badge badge-success">{!! $classAssigning->class_name !!}</i>
</td>

        <td colspan="3">
             {!! Form::open(['route' => ['classAssignings.destroy', $classAssigning->class_assign_id], 'method' => 'delete']) !!}
              <div class='btn-group'>
              <a href="{!! url('print-class-assign-by-teacher-single', [$classAssigning->teacher_id]) !!} " target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>

              <!-- ----------------------------------------------------------- -->
              <!-- view modal button -->
              <a href="#" class="show-modal btn btn-warning btn-xs" data-id="{{$classAssigning->class_assign_id}}"
                data-name="{{$classAssigning->name}}" data-fname="{{$classAssigning->first_name}}"  
                data-lname="{{$classAssigning->last_name}}" data-shift="{{$classAssigning->shift}}"
                 data-level="{!! $classAssigning->level !!}"  data-time="{!! $classAssigning->time !!}"
                 data-classroom_name="{!! $classAssigning->classroom_name !!}" data-class_name="{!! $classAssigning->class_name !!}"
                 data-batch="{!! $classAssigning->batch !!}" data-course_name="{!! $classAssigning->course_name !!}"
                 data-semester_name="{!! $classAssigning->semester_name !!}"
                data-created_at="{{$classAssigning->created_at}}">
                <i class='glyphicon glyphicon-eye-open'></i></a> 
                <!-- view modal button

               <!-- ---------------------------------------------------------- -->

                <a href="{!! route('classAssignings.edit', [$classAssigning->class_assign_id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
               </div>
               {!! Form::close() !!}
               </td>

</tr>

@endforeach
    </tbody>
    
</table>

<!-- this is the pagenation part okay. -->
@endsection


@section('scripts')

<!-- javacript okay -->
<!-- // here we will do our view details part okay. -->
<script>
$(document).on('click', '.show-modal', function(){
    $('.modal-title').text('Teacher Class Assignings Details');

    $('.form-horizontal').show();
    $('#show-id').text($(this).data('id'));
    $('#first_name').text($(this).data('fname'));
    $('#last_name').text($(this).data('lname'));
    $('#semester_name').text($(this).data('semester_name'));
    $('#level').text($(this).data('level'));
    $('#shift').text($(this).data('shift'));
    $('#classroom_name').text($(this).data('classroom_name'));
    $('#batch').text($(this).data('batch'));
    $('#time').text($(this).data('time'));
    $('#course_name').text($(this).data('course_name'));
    $('#batch').text($(this).data('batch'));
    $('#name').text($(this).data('name'));
    $('#class_name').text($(this).data('class_name'));
    $('#show-created_at').text($(this).data('created_at'));
    $('#BtnShow').modal('show');
});

$('document').ready(function(){
  // alert('hello');

function ShowTeacherClassAssign(teacher_id)
{
    $.get("{{ url('show-class-assign') }}",{teacher_id:teacher_id}, function(){
            alert('hello');
        $('#class-schedule-info').empty().append(data);
        MargeCommonRows($('#table-class-info'));
    })
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
				if(i === 1) firstColumnBrakes.push(index);
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
                if(i === 1) firstColumnBrakes.push(index);
                rowspan = 1;
                previous = content;
                cellToExtend = jthis;
            }
        });
    }
    // now remove hidden td's (or leave them hidden if you wish):
    $('td.hidden').remove();
}

// Escape last column
// function MargeCommonRows(table){
// 	var firstColumnBrakes = [];
// 	$.each(table.find('th'),function(i){
// 		var previous = null, cellToExtend = null, rowspan = 1;
// 		table.find("td:nth-child("+i+")").each(function(index,e){
// 			var jthis = $(this),content = jthis.text();
// 			if(previous == content && content !== "" && $.inArray(index, firstColumnBrakes) === -1){
// 				jthis.addClass('hidden');
// 				cellToExtend.attr('rowspan',(rowspan = rowspan+1));
// 			}else{
// 				if(i==1) firstColumnBrakes.push(index);
// 				rowspan = 1;
// 				previous = content;
// 				cellToExtend = jthis;
// 			}
// 		});
// 	});
// 	$('td.hidden').remove();
// }
 
$('.button').click(function(){
    MergeCommonRows($('#table-class-info'));
});

MargeCommonRows($('#table-class-info'));

function Print(){
    $("#table-class-info td, #table-class-info th").each(function(){ $(this).css("width",  $(this).width() + "px")  });
    $("#table-class-info tr").wrap("<div class='avoidBreak'></div>");
    window.print();
}


// Function for Search data 

//   $("#search").on("keyup", function() {
//     // alert('hello')
//     var value = $(this).val().toLowerCase();
//     $("#table-class-info tbody tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//     MargeCommonRows($('#table-class-info'));
//   });

})
</script>




































        <script>
        $(document).ready(function() {
        var max_fields = 4; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".addRow"); //Add button ID
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="input-group col-md-12" ><select name="teacher_id[]" id="" class="form-control"><option value="0" selected="true" disabled="true">Select Teacher</option>@foreach ($classAssignings as $key => $teach)<option value="{{$teach->teacher_id}}">{{$teach->first_name}}{{$teach->last_name}}</option>@endforeach</select><span style="cursor:pointer; background:red"class="remove_field input-group-addon btn btn-danger"><i class="fa fa-times"></i></div></span> <label for=""></label>'); //add input box
        }
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
        })
        });

        </script>
            
        @endsection
