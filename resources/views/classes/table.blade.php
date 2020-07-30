<style>

input:read-only{
    border:none;
    border-color: transparent;
}
</style>

@include('table_style')
<div class="table-responsive">
<div class="panel">
<h3 style="font-weight:bold"><i class="fa fa-user-o"></i> MANAGE CLASSES</h3>
<hr class="line">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>
    <table class="table table-hover" id="classes-table">
        <thead>
        <button style="margin-bottom: 10px; display:none" class="btn btn-danger delete_all" data-url="{{ url('delete_multiple_class') }}"><i class="fa fa-trash"></i> Delete All Selected</button>
            <b class="btn btn-sm pull-right" id="divoutput"></b>
            <tr>
                <th width="50px"><input type="checkbox" id="master" style="display:none"></th>
                <th>Class</th>
                <th>Department</th>
                <th >Code</th>
                <th style="text-align:center">Students</th>
                <th >Status</th>
                <th >Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($classes as $classes)
            <tr id="tr_{{$classes->id}}" class="contact">
            <td><input type="checkbox" class="sub_chk" data-id="{{$classes->id}}"></td>
            <td>{!! $classes->class_name !!}</td>
            <td class=" " >{!! $classes->department_name !!}</td>
            <td class="badge badge" >{!! $classes->class_code !!}</td>
            <td ><i fa fa-badge>{{$classes->students}}</i> </td>
            
            <td style="text-align:center">
                <input type="checkbox" data-id="{{ $classes->id }}" name="status" 
                class="js-switch" {{ $classes->status == 'on' ? 'checked' : '' }}>
            </td>

                <td>
                    {!! Form::open(['route' => ['classes.destroy', $classes->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    <a href="{!! url('print-class-single', [$classes->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <!-- <a href="{!! route('classes.show', [$classes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                        <!-- ---------------------------------------here is the class view button code ---------------------------------------- -->
                        <a data-toggle="modal" data-target="#class-view-modal" data-batch_id="{{$classes->id}}"
                        data-class_name="{{$classes->class_name}}" data-class_code="{{$classes->class_code}}" data-created_at="{{$classes->created_at}}"
                        data-updated_at="{{$classes->updated_at}}"
                         class='btn btn-warning btn-xs'>
                         <i class="glyphicon glyphicon-eye-open"></i></a>
                         <!-- -------------------------------------------------------------------- -->
                       
                        <a href="{!! route('classes.edit', [$classes->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
<div class="modal fade left" id="class-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="class_id" id="class_id"> 
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- Year Field -->
            <div class="form-group">
                {!! Form::label('class_name', 'Class Name:') !!}
               <input type="text" name="class_name" id="class_name" readonly>
            </div>

                <!-- Year Field -->
                <div class="form-group">
                {!! Form::label('class_code', 'Class Code:') !!}
               <input type="text" name="class_code" id="class_code" readonly>
            </div>
            <!-- Created At Field -->
            <div class="form-group">
                {!! Form::label('created_at', 'Created At:') !!}
                <input type="text" name="created_at" id="created_at" readonly>
            </div>

            <!-- Updated At Field -->
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <input type="text" name="updated_at" id="updated_at" readonly>
            </div>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <!-- {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!} -->
      </div>
    </div>
  </div>
  </div>
  </div>


  @section('scripts')

    <script>
    // {{-----------Level view Side------------------}} 
$('#class-view-modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var class_name = button.data('class_name')
var class_code = button.data('class_code')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var class_id = button.data('class_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW BATCH INFORMATION');
modal.find('.modal-body #class_name').val(class_name);
modal.find('.modal-body #class_code').val(class_code);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #class_id').val(class_id);
});
    
    // this is just bootstrap simple code you can read the bootstrap modal.find okay.
    
$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 'on' : 'off';
        let classId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('classes/status/update') }}',
            data: {'status': status, 'class_id': classId},
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
}) 





$(document).ready(function () {
        $('#master').on('click', function(e) {
        var rowCount = '<label class="btn btn-primary " >Total Row Selected is : ' +$('#classes-table tbody tr').length + ' </label>';
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

  var $checkboxes = $('#classes-table td input[type="checkbox"]');
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
    var rowCount = $('#classes-table tbody tr').length;
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
    $("#classes-table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

})

// Function for Search data 
$(document).ready(function(){
  $("#student_id_single").on("keyup", function() {
    // alert('hello')
    var value = $(this).val().toLowerCase();
    $("#classes-table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});






    </script>




  @endsection

