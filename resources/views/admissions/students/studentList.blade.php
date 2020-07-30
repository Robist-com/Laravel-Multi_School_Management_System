
@extends('layouts.app')
@include('fee.stylesheet.css-payment')
@section('content')
    <section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"> <i class="fa fa-user"></i> STUDENT<b style="color:red">LIST</b></h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>
<style>
th{
  text-align: center;
  font-family: 'Times New Roman', Times, serif;
  font-style: initial;
  font-weight: bold;
  font-size:large
}
</style>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

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
            <h3 style="font-weight:bold;"><i class="fa fa-user" aria-hidden="true"></i> MANAGE STUDENT</h3>
          
    <div class="clearfix"></div>
    <div class="panel"></div>
          <div class="panel-body" style="border:0px solid">
        <div class="col-md-3">
        <label for="" class="fa fa-search text-red"> </label> <span style="font-size:13px; margin-left:35px"> Filter by Roll</span>
            <div class="form-group">
            <input type="text" name="roll_no" id="roll_no" class="form-control roll_no" placeholder="Enter Roll No.">
            </div>
        </div>

      <div class="col-md-2 ">
      <label for=""> </label> <span style="font-size:13px; margin-left:35px"> .</span>
      <div class="form-group">
       <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
       </div>
       </div>
       <div class="col-md-2 pull-right">
       <label for="">Sort by Gender</label>
       <select name="sort_by_gender" id="sort_by_gender" class="form-control col-md-2 select_2_single1" style="margin-right:100%">
       <option value="" selected="selected">All</option>
       <option value="0">Male</option>
       <option value="1">Female</option>
       </select>
       </div>
       <div class="col-md-2 pull-right">
       <label for="">Display</label>
       <select name="display" id="display" class="form-control col-md-2 select_2_single1" style="margin-right:100%">
       <option value="table" selected="selected">Table</option>
       <option value="gride">Gride</option>
       </select>
       </div>
      <label for="" id="total_records"></label>
    </div>
    </div>

  <div class="clearfix"></div>
  @if($message = Session::get('success'))
<div class="alert-success">
  <p>{{$message}}</p>
</div>
  @endif
  <div class="clearfix"></div>
  <div class="" id="table">
        @include('admissions.students.table_list')
        </div>
       
      <hr>
      <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            <ul class="pagination" id="myPager"></ul>
        </div>
        
      </div>
      </div>
      <div class="" id="gride" style="display:none">
        @include('admissions.students.gallary_list')
        </div>
    <!-- </div> -->
  </div>
  <div class="text-center">
  
</div>
</div>    
@endsection

@section('scripts')

@include('fee.script.calculate') 

@include('fee.script.payment')
<script>
$(document).ready(function(){
  $('#gride').hide();
  var _token = $('input[name="_token"]').val();

  function Sort_gender(sort_by_gender = '')
{
 $.ajax({
  url:"{{ url('sort/students') }}",
  method:"GET",
  data:{sort_by_gender:sort_by_gender, _token:_token},
//    dataType:"json",
  success:function(response)
  {
   
   $('#show-student-list').html(response);
  //  $('#show-student-gallary').html(response);
   $('#show-total').show();
   $('#fee_report').show();
   $('#print-student-transaction').hide();
   // $('.show-student-paid').html(data) 
  }
 })
}


$('#display').on('change', function(){
  var table = $(this).val();

  if(table == 'table'){
   $('#gride').hide();
   $('#table').show();

  }else if(table == 'gride')
  {
    $('#gride').show();
   $('#table').hide();
  }
})


function fetch_data_roll_no(roll_no = '')
    {
      $.ajax({
      url:"{{ url('sort/students') }}",
      method:"GET",
      data:{roll_no:roll_no,  _token:_token},
      //  dataType:"json",
      success:function(response)
      {
        
        $('#show-student-list').html(response);
        $('class_name').html(response.class_name);
        $('#show-total').show();
        $('#print-student-transaction').show();
        $('#fee_report').show();
      }
      })
    }

    //Filter by Class Code 
$('#sort_by_gender').on('change',function()
{

      var sort_by_gender = $('#sort_by_gender').val();

      if(sort_by_gender != '')
      {
        Sort_gender(sort_by_gender);
      $('#roll_id').show();
      $('#print-student-transaction').hide();

      }
      else
      {
        Sort_gender();
      }
});

$('#filter').click(function(){
    var roll_no = $('#roll_no').val();

      if(roll_no != '')
      {
        fetch_data_roll_no(roll_no)
        $('#roll_id').hide();
        $('#print-student-transaction').show();

      }
      else
      {
      alert('Enter Student Roll Number to search please!');
      $('#show-total').hide();
      $('#fee_report').hide();
      }
    });


    $('#refresh').click(function(){
      $('#roll_no').val('');
      fetch_data_roll_no();
      Sort_gender();
      $('#show-total').hide();
      $('#fee_report').hide();

      
      $('#sort_by_gender option').prop('selected', function () { 
        if (this.defaultSelected) { 
                    this.selected = true; 
                    return false; 
                } 
      }); 
    });


 


// GET SEMESTER DEGREEE
$('#semester_id').on('change',function(e){
getStudentsByclass()
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
getStudentsByclass()
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

// GET SEMESTER DEGREEE
// $('#faculty_id').on('change',function(e){
function getStudentsByclass(){
var faculty_id = $('#faculty_id').val();
var department_id = $('#department_id').val()
var class_id = $('#class_id').val()
var semester_id = $('#semester_id').val()
var degree_id = $('#degree_id').val()
var student_id = $('#student_id')
$(student_id).empty();
$.get("{{ route('dynamicStudentsByClass') }}",
{faculty_id:faculty_id,'department_id':faculty_id,'class_id':class_id,
'semester_id':semester_id,'degree_id':degree_id},function(data){  

console.log(data);
$.each(data,function(i,l){
$(student_id).append($('<option/>',{
value : l.id,
text  : l.first_name + " " + l.last_name
// text  : 
}))
}) 
})
}
});




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

$("#roll_no").on("keyup", function() {
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


