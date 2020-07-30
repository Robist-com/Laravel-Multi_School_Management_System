@extends('layouts.app')
@include('fee.stylesheet.css-payment')
@section('content')
    <section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true"> COLLECT FEES</i></h1>
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


<div class="panel-body" style="border:0px solid">
    <div class="col-md-2">
    <label for="">Roll No:</label>
        <div class="form-group">
        <input type="text" name="roll_no" id="roll_no" class="form-control">
        </div>
    </div>
    <div class="col-md-2">
    <label for="">Filter</label>
        <div class="form-group">
        <!-- <button class="btn btn-warning btn-xs" id="filter" style="height:30px">Find</button> -->
        <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
        </div>
    </div>
    <!-- <div class="col-md-2">
    <label for="">Roll Test</label>
        <div class="form-group">
        <select name="roll_no" id="roll_no" class="form-control select_2_single">
        <option value="" selected="true">Select Class</option>
          <option value="1116093000111">1116093000111</option>
          <option value="1116093000112">1116093000112</option>
          <option value="1116093000113">1116093000113</option>
          <option value="1116093000114">1116093000114</option>
        </select>
        </div>
    </div> -->

    <div class="col-md-2">
    <label for="">Grade</label>
        <div class="form-group">
        <select name="semester_id" id="semester_id_fee" class="form-control select_2_single">
        <option value="" selected="true">Select Grade</option>
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
    <label for="">Reset</label>
        <div class="form-group">
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
        </div>
    </div>
    <div class="col-md-3" id="fee_type_select" style="display:none">
    <label for=""> </label> <span style="font-size:13px; margin-left:80px"> FEE TYPE</span>
    <select name="fee_type" id="fee_type_id" class="form-control select_2_single">
        <option value="" selected="true" selected="true">Select Fee Type</option>
          @foreach($fee_structure as $fee_structure)
          <option value="{{$fee_structure->id}}">{{$fee_structure->fee_type}}</option>
          @endforeach
      </select>
      </div>
    </div>
    <!-- </div> -->

<br>


<div class="panel  panel-default" id="main_body" style="display:none"> 
<form action="{{ count($readStudentFee) != 0? route('exstraPay')  : route('savePayment')}}" method="POST" id="frmPayment">

<!-- @include('fee.fee-type') -->
@include('fee.fee-payment')
</form>
</div> 
   @include('fee.all_fees')
</div> 
</div>
</div>

@endsection

@section('scripts')

@include('fee.script.calculate')
@include('fee.script.payment')

<script>
$(document).ready(function(){
$('#show-total').hide();
$('#show-multi_total').hide();
$('#fee_report').hide();
$('#collect_fee').hide();
$('#multi_collect_fee').hide();
$('#main_body').hide();
$('#panel_fee').hide();
$('#fee_type_select').hide();
  var date = new Date();
  
  $('.input-daterange').datepicker({
  todayBtn: 'linked',
  format: 'yyyy-mm-dd',
  autoclose: true
 });


 function fetch_feeType(fee_type = '')
 {
  $.ajax({
   url:"{{ route('getFeeTypes') }}",
   method:"POST",
   data:{fee_type:fee_type, _token:_token},
  //  dataType:"json",
   success:function(response)
   {
    
    $('#total_records').text(response.length);
    $('#show-fee-type').html(response);
    $('#show-total').show();
    $('#fee_report').show();
    var semesterFee = $('#semesterFee').val();
    $('#totalFee').val(parseInt(semesterFee))

   }
  })
 }


$('#fee_type_id').on('change', function(){
var fee_type = $(this).val();
var semesterFee = $('#semesterFee').val();
$('#totalFee').val(semesterFee);
// var admissionFee = $('#admissionFee').val();

if (fee_type != '') {
fetch_feeType(fee_type)
$('#roll_id').show();
$('#show-student-paid').show();
$('#main_body').show();
$('#panel_fee').show();
// $('#totalFee').val(semesterFee);

// $('#main_body').show();
  }
  else{
    alert('Please Select fee type')
  }
});
 


// var x = document.getElementById("tabela").rows[2].cells[3].firstChild.value;
// alert(1)
// alert(x)



$('#roll_no').on('change', function(){
  var roll_no = $(this).val();
  if (roll_no != '') {
    fetch_data_roll_no(roll_no = '')
  }
  else{
    alert('Please Select fee type')
  }
});
 
 

$('#btn-go').click(function(){
  var paid_amount = $('#Paid').val();

  if(paid_amount == ''){
     alert("Paid amount is required!");
   }
 })

var _token = $('input[name="_token"]').val();


 function fetch_data_roll_no(roll_no = '')
 {
  $.ajax({
   url:"{{ route('FeeCollectionPayment') }}",
   method:"POST",
   data:{roll_no:roll_no,  _token:_token},
  //  dataType:"json",
   success:function(response)
   {
    // var output = '';
    console.log(response);
    $('#total_records').text(response.length);
    $('#show-student-paid').html(response);
    // $('class_name').html(data.class_name);
    $('#show-total').show();
    $('#fee_report').show();
    $('#collect_fee').show();
    $('#multi_collect_fee').hide();
    $('#allfees-table').hide();
    $('#show-student-paid').show();
    $('#main_body').show();
    $('#panel_fee').hide();
    $('#fee_type_select').show();

    // $('.show-student-paid').html(data) 
   }
  })
 }

 function fetch_data(class_code = '', semester_id = '')
 {
  $.ajax({
   url:"{{ route('FeeCollectionPayment') }}", 
   method:"POST",
   data:{class_code:class_code, semester_id:semester_id, _token:_token},
  //  dataType:"json",
   success:function(response)
   {
    
    $('#multi_total_records').text(response.length);
    $('#show-student-paid').html(response);
    // $('class_name').html(data.class_name);
    $('#show-multi_total').show();
    $('#fee_report').show();
    $('#multi_collect_fee').show();
    $('#collect_fee').hide();
    $('#show-student-paid').show();
    $('#allfees-table').hide();
    $('#main_body').show();
    $('#fee_type_select').show();


   }
  })
 }


 $('#filter').click(function(){
  var class_code = $('#class_code').val();
  var semester_id = $('#semester_id_fee').val();
  var roll_no = $('#roll_no').val();

 if(roll_no != '')
  {
    fetch_data_roll_no(roll_no)
    $('#roll_id').hide();
    $('#semesterFee').val();
    $('#show-student-paid').show();
    $('#main_body').show();
    $('#panel_fee').hide();
  }
  else
  {
   alert('Roll No Field is required');
   $('#show-total').hide();
   $('#fee_report').hide();
  }
 });

 $('#refresh').click(function(){
  $('#semester_id_fee').val('');
  $('#class_code').val('');
  $('#roll_no').val('');
  // fetch_data();
  // fetch_data_roll_no();fee_type_select
  $('#show-total').hide();
  $('#show-multi_total').hide();
  $('#fee_report').hide();
  $('#collect_fee').hide();
  $('#multi_collect_fee').hide();
  $('#allfees-table').show();
  $('#fee_type_select').hide();
  $('#show-student-paid').hide();
  $('#main_body').hide();
 });

 $('#class_code').on('change', function(){

  var class_code = $('#class_code').val();
  var semester_id = $('#semester_id_fee').val();
  var roll_no = $('#roll_no').val();

  if(class_code != '' &&  semester_id != '')
  {
   fetch_data(class_code, semester_id);
   $('#roll_id').show();
   $('#show-student-paid').show();
   $('#main_body').show();
   $('#panel_fee').hide();
  
  }
   var cla = $(this).val();
   $('#class_name').text(cla);
   $('#roll_no').val('');
 });

 $('#semester_id_fee').on('change', function(){
    var sem = $(this).val();
   $('#semester_name').text(sem);
   $('#roll_no').val('');
})

$('#roll_no').on('keyup', function(){
        $('#class_code').val('');
        $('#semester_id_fee').val('');
    
})


});
</script>
@endsection