            
            
            <div class="input-group col-md-12 input_fields_wrap" >
            <input type="hidden" name="class_assign_id" id="">
            <div class="col-md-4 pull-right" style="width:50%; margin-top:7px;">
            <select name="teacher_id" id="" class="form-control select_2_single" id="class-schedule-info" >
            <option value="0" selected="true" disabled="true">Select Teacher</option>
          
            @foreach ($teacher as $teach)
            <option value="{{$teach->teacher_id}}">
            {{$teach->first_name}}
            {{$teach->last_name}}
            </option>
            @endforeach

            </select>
            </div>
            <hr>
            <div class="clearfix"></div>
             {{-- <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Generate Class Assign</button>
                {{-- {!! Form::submit('Generate Class Assign', ['class' => 'btn btn-success']) !!} --}}
              {{-- </div> --}} 


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
//   alert('hello');

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

  $("#search").on("keyup", function() {
    // alert('hello')
    var value = $(this).val().toLowerCase();
    $("#table-class-info tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    MargeCommonRows($('#table-class-info'));
  });

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

        
       