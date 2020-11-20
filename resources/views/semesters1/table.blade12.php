<div class="page-title">
              <div class="title_left">
                <h3>MANAGE <small>GRADE</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  @if(isset($semes))
                   <h2>Update semester</h2>
                   @else
                   <h2>Create semester</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('semesters.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($semes))
                  {!! Form::model($semes, ['route' => ['semesters.update', $semes->id], 'method' => 'patch', 'class' => 'form-horizontal form-label-left']) !!}
                  @else
                  {!! Form::open(['route' => 'semesters.store', 'class' => 'form-horizontal form-label-left']) !!}
                  @endif
                  
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    {!! Form::text('semester_name', null, ['class' => 'form-control','placeholder'=>'Enter Semester Name', 'require' => 'true']) !!}
                    </div>
                    </div> 

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    {!! Form::text('semester_code', null, ['class' => 'form-control','placeholder'=>'Enter Semester Code']) !!}
                    </div>
                    </div> 

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    {!! Form::text('semester_duration', null, ['class' => 'form-control', 'placeholder'=>'Enter Semester Duration']) !!}
                    </div>
                    </div> 

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    {!! Form::textarea('semester_description', null, ['class' => 'form-control','cols' => 40 , 'rows' => 2, 'placeholder'=>'Enter Semester Description']) !!}
                    </div>
                    </div> 

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    @if(isset($semes))
                      {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div> 
                   
                   
                    <div class="modal-footer">
                    @if(isset($semes))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                   @endif
                    </div>
                   
                    {!! Form::close() !!}

                  </div>
                </div>
              </div>

<div class="col-md-8 col-sm-8 col-xs-8">
<div id="myDiv" class="container">
			<div id="myDiv">
<ul class="nav nav-pills">
					<li class="active"><a data-toggle="tab" href="#home">H</a></li>
                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '1') 
					<li><a data-toggle="tab" href="#menu0">GRADE 1</a></li>
                    @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '2') 
					<li><a data-toggle="tab" href="#menu1">GRADE 2</a></li>
                    @endif
                @endforeach
                
                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '3') 
					<li><a data-toggle="tab" href="#menu2">GRADE 3</a></li>
                    @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '4') 
                    <li><a data-toggle="tab" href="#menu3">GRADE 4</a></li>
                    @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '5') 
                    <li ><a data-toggle="tab" href="#menu4">GRADE 5</a></li>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '6') 
                    <li ><a data-toggle="tab" href="#menu5">GRADE 6</a></li>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '7') 
                    <li ><a data-toggle="tab" href="#menu6">GRADE 7</a></li>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '8') 
                    <li ><a data-toggle="tab" href="#menu7">GRADE 8</a></li>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '9') 
                    <li ><a data-toggle="tab" href="#menu8">GRADE 9</a></li>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '10') 
                    <li ><a data-toggle="tab" href="#menu9">GRADE 10</a></li>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '11') 
                    <li ><a data-toggle="tab" href="#menu10">GRADE 11</a></li>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '12') 
                    <li ><a data-toggle="tab" href="#menu11">GRADE 12</a></li>
               @endif
                @endforeach
				</ul>
        <div class="tab-content col-md-12">
				    <div id="home" class="tab-pane fade in active">
			    <h3 style="font-weight:bold; color:red">HOME</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semesters')
                </div>
                @foreach($enable_grade as $grade) 
                @if($grade->status == 'on' && $grade->id == '1') 
                <div id="menu0" class="tab-pane fade">
                    <h3 style="font-weight:bold; color:red">GRADE 1</h3>
                    <hr class="line">
                    @include('semesters.semester-tabs.semester1')
                    </div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 2) 
				<div id="menu1" class="tab-pane fade">
				<h3 style="font-weight:bold; color:red">GRADE 2</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester2')
				</div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 3) 
				<div id="menu2" class="tab-pane fade">
				<h3 style="font-weight:bold; color:red">GRADE 3</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester3')
	            </div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 4) 
	            <div id="menu3" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">GRADE 4</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester4')
				</div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 5) 
                <div id="menu4" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">GRADE 5</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester5')
				</div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 6) 
                <div id="menu5" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">GRADE 6</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester6')
				</div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 7) 
                <div id="menu6" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">GRADE 7</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester7')
				</div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 8) 
                <div id="menu7" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">GRADE 8</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester8')
		        </div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 9) 
                <div id="menu8" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">GRADE 9</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester9')
		        </div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 10) 
                <div id="menu9" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">GRADE 10</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester10')
		        </div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 11) 
                <div id="menu10" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">GRADE 11</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester11')
		        </div>
                @endif
                @endforeach

                @foreach($enable_grade as $grade) 
                 @if($grade->status == 'on' && $grade->id == 12) 
                <div id="menu11" class="tab-pane fade">
		        <h3 style="font-weight:bold; color:red">GRADE 12</h3>
                <hr class="line">
                @include('semesters.semester-tabs.semester12')
		        </div>
                @endif
                @endforeach
		</div>
	</div>
	</div>
	</div>
	</div>
  @include('semesters.show_fields')
  @section('scripts')

    <script>
    // {{-----------Level view Side------------------}} 






$('#semester_view_modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var semester_name = button.data('semester_name')
var semester_code = button.data('semester_code')
var semester_duration = button.data('semester_duration')
var semester_description = button.data('semester_description')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var semester_id = button.data('semester_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW SEMESTER INFORMATION');
modal.find('.modal-body #semester_name').val(semester_name);
modal.find('.modal-body #semester_code').val(semester_code);
modal.find('.modal-body #semester_duration').val(semester_duration);
modal.find('.modal-body #semester_description').val(semester_description);
// modal.find('.modal-body #semester_year').val(semester_year); // HERE IS OUR ERROR OKAY
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #semester_id').val(semester_id);
});
    
    // this is just bootstrap simple code you can read the bootstrap modal.find okay.
    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let semesterId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('semesters/status/update') }}',
            data: {'status': status, 'semester_id': semesterId},
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
    MargeCommonRows($('#semesters'));

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
})  

$('#course_id').on('change',function(e){
                var course_id = $(this).val();
                var level = $('#level_id')
                    $(level).empty();
             $.get("{{ route('dynamicLevels') }}",{course_id:course_id},function(data){  
                    
                    console.log(data);
                    $.each(data,function(i,l){
                    $(level).append($('<option/>',{
                        value : l.level_id,
                        text  : l.level
               }))
             }) 
         })
    })

    // GET SEMESTER DEGREEE
    $('#semester').on('change',function(e){

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


$(document).ready(function () {
    
    $('#master').on('click', function(e) {
    var rowCount = '<label class="btn btn-primary " >Total Row Selected is : ' +$('#semesters tbody tr').length + ' </label>';
     if($(this).is(':checked',true))  
     {
        $(".sub_chk").prop('checked', true); 

        $("table").has(".contact").css('background-color','Plum');
        $("table").has(".contact").css('color','White');
        $('.delete-modal').hide();

        $("#divoutput").html(rowCount);
        

     } else {  
        $(".sub_chk").prop('checked',false);  
        $("table").has(".contact").css('background-color','');
        $("table").has(".contact").css('color','');
        $('.delete-modal').show();
        $("#divoutput").html('');
     }  
    });


    $('.delete_all').on('click', function(e) {

        var allVals = [];  
        $(".sub_chk:checked").each(function() {  
            allVals.push($(this).attr('data-id'));
        });  


        if(allVals.length <=0)  
        {  
            alert("Please select row.");  
        }  else {  


            var check = confirm("Are you sure you want to delete this rows?");  
            if(check == true){  


                var join_selected_values = allVals.join(","); 


                $.ajax({
                    url: $(this).data('url'),
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'promote_ids='+join_selected_values,
                    success: function (data) {
                        if (data.success) {

                        $(".sub_chk:checked").each(function() {  
                            $(this).parents("tr").remove();
                        });
                            toastr.options.closeButton = true;
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.options.closeDuration = 100;
                            toastr.options.positionClass = 'toast-top-full-width';
                            toastr.success(data.success);

                            $("#divoutput").html('');
                            $("#master").prop('checked',false);

                        } else if (data.error) {
                            toastr.options.closeButton = true;
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.options.closeDuration = 100;
                            toastr.options.positionClass = 'toast-top-full-width';
                            toastr.error(data.error);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });


              $.each(allVals, function( index, value ) {
                  $('table tr').filter("[data-row-id='" + value + "']").remove();
              });
            }  
        }  
    });


    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        onConfirm: function (event, element) {
            element.trigger('confirm');
        }
    });

});

$(document).ready(function () {

var $checkboxes = $('#semesters td input[type="checkbox"]');
var checked = false;
$("input[type='checkbox']").change(function(e) {

if($(this).prop("checked")){ 
  $(this).parent().parent().css('background-color','plum');
  $(this).parent().parent().css('color','white');

var countCheckedCheckboxes = '<label class="btn btn-primary" >Total Row Selected is : '+$checkboxes.filter(':checked').length + ' </label>';
$('#divoutput').html(countCheckedCheckboxes);

if($checkboxes.change(function(){
  var countCheckedCheckboxes = '<label class="btn btn-primary" >Total Row Selected is : '+$checkboxes.filter(':checked').length + ' </label>';
  $('#divoutput').html(countCheckedCheckboxes);
}));

}else{
  $(this).parent().parent().css('background-color','');
  $(this).parent().parent().css('color','');

    $("#divoutput").html('');
// }
}
});


// Disabled button when table is empty
$(function(){
var rowCount = $('#semesters tbody tr').length;
// alert(rowCount)
if(rowCount < 1){
    $('.delete_all').hide();
    $('#master').hide();
    $('#table-hide').hide();
    $('.card-header').hide();
    $('#search').hide();
    $('#numberOfRows').focus();
    $('#editAll').hide();

} 
else{
    $('.delete_all').show();
    $('#master').show();
    $('#table-hide').show();
    $('.card-header').show();
    $('#search').show();
    $('#editAll').show();


}
});

$("#roll_no").on("keyup", function() {
// alert('hello')
var value = $(this).val().toLowerCase();
$("#semesters tbody tr").filter(function() {
  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});

})

// Function for Search data 
$(document).ready(function(){
$("#student_id_single").on("keyup", function() {
// alert('hello')
var value = $(this).val().toLowerCase();
$("#semesters tbody tr").filter(function() {
  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});





// function MargeCommonRows(table)
// {
// 	var firstColumnBrakes = [];
// 	$.each(table.find('th'),function(i){
// 			var previous = null, cellToExtend = null, rowspan = 1;
// 			table.find("td:nth-child("+i+")").each(function(index,e){
// 			var jthis = $(this), content = jthis.text();
// 			if (previous == content && content !== "" && $.inArray(index, firstColumnBrakes) === -1){
// 				jthis.addClass('hidden');
// 				cellToExtend.attr("rowspan", (rowspan = rowspan+1));
// 			}else
// 			{
// 				if(i === 2) firstColumnBrakes.push(index);
// 				rowspan = 1;
// 				previous = content;
// 				cellToExtend = jthis;
// 			}
// 			});
// 	});
// 	$('td.hidden').remove();
// }

     
    
    
    </script>




  @endsection