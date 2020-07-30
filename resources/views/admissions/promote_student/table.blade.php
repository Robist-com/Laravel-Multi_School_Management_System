@extends('layouts.app')

@section('content')
    <section class="content-header">
        <!-- <h1 class="pull-right">
           <a href="{{route('PromoteStudents')}}" data-toggle="modal1" data-target="#admission-add-modal" class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" ><i class="fa fa-plus-circle"> PROMOTE</i></a>
        </h1> -->
      
<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-text-o" aria-hidden="true">PROMOTED STUDENTS</i></h1>
<a  class="pull-left btn btn-danger" href="{{route('PromoteStudents')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

    </section>
        <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        <div class="clearfix"></div>
        <div class="box box-primary">
        <div class="box-body">
        <div class="pull-right">
            <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-pdf-o text-red" style="color:white"></i> PDF </a>

            <a href="{{url('export-excel-xlsx-users')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-excel-o text-green" style="color:white"></i> Excel </a>

            <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-word-o text-blue" style="color:white"></i> Word </a>

            <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
            <i class="fa fa-print text-light-blue" style="color:white"></i> Print </a>
            </div>
            <div class="clearfix"></div>
            <h3 style="font-weight:bold;"><i class="fa fa-user" aria-hidden="true"></i> PROMOTED STUDENTS</h3>
          
    <div class="clearfix"></div>

    <div class="col-md-4">
    <label for=""> </label> <span style="font-size:13px; margin-left:100px"> PROMOTED STUDENT</span>
        <div class="form-group">
        <select name="student_id_single" id="student_id_single" class="form-control select_2_single">
        <option value="" selected="true">SELECT STUDENT</option>
        @foreach($Allpromotestudents as $key => $student)
          <option value="{{$student->id}}">{{$student->first_name}} {{$student->last_name}} -- {{$student->username}}</option>
        @endforeach
        </select>
        </div>
    </div>

    <div class="col-md-4">
    <label for=""> </label> <span style="font-size:13px; margin-left:100px"> PROMOTE CLASS WISE</span>
    <div class="input-group ">
        <select name="semester_id" id="semester_id_grade" class="form-control select_2_single">
        <option value="" selected="true">SELECT GRADE</option>
        @foreach($semester as $semester)
            <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
        @endforeach
        </select>
        <div class="input-group-addon"><i class="fas fa-sync-alt text-red" aria-hidden="true"></i></div>
        <select name="class_code" id="class_code" class="form-control select_2_single">
            <option value="" selected="true">SELECT CLASS</option>
            @foreach($classes as $classes)
            <option value="{{$classes->class_code}}">{{$classes->class_name}}</option>
        @endforeach
        </select>
        </div>
    </div>
    <div class="col-md-2">
    <label for=""> </label> <span style="font-size:13px; margin-left:10px" class="fa fa"></span>
        <div class="form-group">
        <!-- <button class="btn btn-warning btn-xs" id="filter" style="height:30px">Find</button> -->
        <!-- <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button> -->
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
        </div>
    </div>
    <div class="clearfix"></div>
    @include('table_style')
<hr class="line">
<div class="table-responsive">
<div class="panel-body">
<div  id="wait"></div>
</div>

<table class="table table-striped1 table-hover" id="table">
    <thead>
    <div class="col-md-4">
    <button style="margin-bottom: 10px; display:none" class="btn btn-danger delete_all" data-url="{{ url('delete_multiple_promoted_student') }}"><i class="fa fa-trash"></i> Delete All Selected</button>
    </div>
    <div class="col-md-4">
    <!-- <label for=""> </label> <span style="font-size:13px; margin-left:100px"> PROMOTED STUDENT</span> -->
        <div class="form-group">
        <input type="text" name="search" id="search" class="form-control" placeholder="Search Student">
        </div>
    </div>
    <b class="btn btn-sm pull-right" id="divoutput"></b>
        <tr>
            <!-- <th><input type="button" name="checkedAll" id="checkedAll" value="check All">  </th> -->
            <th width="50px"><input type="checkbox" id="master" style="display:none"></th>
            <th>#</th>
            <th>Roll No.</th>
            <th>Student</th>
            <th>Class</th>
            <th>Grade</th>
            <th>Status</th>
            <th>Promoted Date</th>
            <th style="text-align:center">Action</th>
        </tr>

    </thead>

    <tbody>
        @foreach ($Allpromotestudents as $key => $user)
                <tr id="tr_{{$user->id}}" class="contact">
                <td><input type="checkbox" class="sub_chk" data-id="{{$user->id}}"></td>
                <td>{{$key+1}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->first_name}} {{$user->last_name}}</td>
                <td>{{$user->class_name}}</td>
                <td id="role">{{$user->semester_name}}</td>
                <td>
                {{$user->status}} Grade
                </td>

                <td>{{ date("d-M-Y", strtotime($user->created_at)) }}</td>

                <td>
               
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-users-single', [$user->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('ShowPreviousPromotedStudent', [$user->student_id]) !!}" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        @if(Auth::user()->role_id == 1)
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs delete-modal', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

            </div>
        </div>
        <div class="text-center">
          
        </div>
    </div>
@csrf

  @endsection

  @section('scripts')


<script type="text/javascript">




    $(document).ready(function () {
        $('#master').on('click', function(e) {
        var rowCount = '<label class="btn btn-primary " >Total Row Selected is : ' +$('#table tbody tr').length + ' </label>';
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

  var $checkboxes = $('#table td input[type="checkbox"]');
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
    var rowCount = $('#table tbody tr').length;
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

$("#search").on("keyup", function() {
    // alert('hello')
    var value = $(this).val().toLowerCase();
    $("#table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

})

// Function for Search data 
$(document).ready(function(){
  $("#student_id_single").on("keyup", function() {
    // alert('hello')
    var value = $(this).val().toLowerCase();
    $("#table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});





</script>

@endsection