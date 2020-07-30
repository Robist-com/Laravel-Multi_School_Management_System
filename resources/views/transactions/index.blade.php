@extends('layouts.app')

@section('content')
    <section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true">TRANSACTIONS</i></h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

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

            <h3 style="font-weight:bold;"><i class="fa fa-money" aria-hidden="true"></i> TRANSACTION</h3>

<div class="panel-body" style="border:0px solid">
    <div class="col-md-2">
    <label for="">Roll No:</label>
        <div class="form-group">
        <input type="text" name="roll_no" id="roll_no" class="form-control">
        </div>
    </div>
    <div class="col-md-2">
    <label for=""></label>
        <div class="form-group">
        <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
       <!-- <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button> -->
        </div>
    </div>
    <div class="col-md-2">
    <label for="">Semester</label>
        <div class="form-group">
        <select name="semester_id" id="semester_id" class="form-control select_2_single">
        <option value="" selected="true">Select Class</option>
        @foreach($semester as $semester)
            <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
        @endforeach
        </select>
        </div>
    </div>

    <div class="col-md-2">
    <label for="">Class</label>
        <div class="form-group">
        <select name="class_code" id="class_code" class="form-control select_2_single">
            <option value="" selected="true">Select Class</option>
            @foreach($classes as $classes)
            <option value="{{$classes->class_code}}">{{$classes->class_name}}</option>
        @endforeach
        </select>
        </div>
    </div>
    <div class="col-md-2">
    <label for=""></label>
        <div class="form-group">
        <!-- <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button> -->
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
        </div>
    </div>

    </div>
<br>
<div class="" id="transaction_fee" style="display:none">
@include('transactions.search-transactions.transactions')
           
 </div>
 @include('transactions.search-transactions.all_transactions')
</div>
 
 <!-- </div>
</div>
</div> 
</div> 
</div>  -->

@endsection

@section('scripts')
<script>
$(document).ready(function(){
$('#show-total').hide();
$('#transaction_fee').hide();
  var date = new Date();
  
  $('.input-daterange').datepicker({
  todayBtn: 'linked',
  format: 'yyyy-mm-dd',
  autoclose: true
 });

var _token = $('input[name="_token"]').val();

//  fetch_data();
//  fetch_data_roll_no();

 function fetch_data_roll_no(roll_no = '')
 {
  $.ajax({
   url:"{{ route('getStudentTransactions') }}",
   method:"POST",
   data:{roll_no:roll_no,  _token:_token},
//    dataType:"json",
   success:function(response)
   {

    console.log(response)
    $("#student_transaction").html(response);
    
    if (response.message) {
        toastr.options.closeButton = true;
        toastr.options.closeMethod = 'fadeOut';
        toastr.options.closeDuration = 100;
        toastr.options.positionClass = 'toast-bottom-full-width';
        toastr.info(response.message);
    }
    else{

    // $('#show-student-paid').html(output);
    // $('class_name').html(data.class_name);
    $('#show-total').show();
    $('#transaction_fee').show();
    $('#all_transaction').hide();
    // $('.show-student-paid').html(data) 
   }
   }
  })
 }

 function fetch_data(class_code = '', semester_id = '')
 {
  $.ajax({
   url:"{{ route('getStudentTransactions') }}",
   method:"POST",
   data:{class_code:class_code, semester_id:semester_id, _token:_token},
//    dataType:"json",
   success:function(response)
   {
    var output = '';
    
    $('#total_records').text(response.length);
    $("#student_transaction").html(response);

    if (response.message) {
        toastr.options.closeButton = true;
        toastr.options.closeMethod = 'fadeOut';
        toastr.options.closeDuration = 100;
        toastr.options.positionClass = 'toast-bottom-full-width';
        toastr.info(response.message);
    }
    else{

    // $('#show-student-paid').html(output);
    // $('class_name').html(data.class_name);
    $('#show-total').show();
    $('#transaction_fee').show();
    $('#all_transaction').hide();
    // $('.show-student-paid').html(data) 
   }

    // $('#show-student-paid').html(output);
    // $('#show-total').show();
    // $('#transaction_fee').show();
    // $('#all_transaction').hide();

    // $('.show-student-paid').html(data) 
   }
  })
 }


 $('#filter').click(function(){
  var class_code = $('#class_code').val();
  var semester_id = $('#semester_id').val();
  var roll_no = $('#roll_no').val();

  if(roll_no != '')
  {
    fetch_data_roll_no(roll_no)
    $('#roll_id').hide();
  }
  else
  {
   alert('Roll Number Field is required');
   $('#show-total').hide();
   $('#fee_report').hide();
  }
 });

 $('#refresh').click(function(){
  $('#semester_id').val('');
  $('#class_code').val('');
  $('#roll_no').val('');
//   fetch_data();
//   fetch_data_roll_no();
  $('#all_transaction').show();
  $('#show-total').hide();
  $('#transaction_fee').hide();
 });

 $('#class_code').on('change', function(){
    var class_code = $('#class_code').val();
    var semester_id = $('#semester_id').val();

  if(class_code != '' &&  semester_id != '')
  {
   fetch_data(class_code, semester_id);
   $('#roll_id').show();

  }
   var cla = $(this).val();
   $('#class_name').text(cla);
   $('#roll_no').val('');
 });

 $('#semester_id').on('change', function(){
    var sem = $(this).val();
   $('#semester_name').text(sem);
   $('#roll_no').val('');
})

$('#roll_no').on('keyup', function(){
        $('#class_code').val('');
        $('#semester_id').val('');
    
})

});
</script>
@endsection