@extends('layouts.app')
@include('fee.stylesheet.css-payment')
@section('content')
    <section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true"> COLLECT FEES</i></h1>

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
        <!-- <button class="btn btn-warning btn-xs" id="filter" style="height:30px">Find</button> -->
        <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
        </div>
    </div>

    </div>
</div>
<br>
</div>

<div class="" id="show-student-paid">

@include('fee.fee-payment')

</div>        
</div> 
    <!-- </div> -->
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
// $('#show-student-paid').hide();
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
   url:"{{ route('FeeCollectionPayment') }}",
   method:"POST",
   data:{roll_no:roll_no,  _token:_token},
  //  dataType:"json",
   success:function(response)
   {
    // var output = '';
    console.log(response);
    $('#total_records').text(response.length);
    // for(var count = 0; count < data.length; count++)
    // {
    //  output += '<div class="panel">';
    //  output += '<h4 class="col-sm-10 "style="margin-left:15px;font-weight:bolder" id="inputEmail3">' + data[count].username  + '</h5>';
    //  output += '<div class="panel-body">';
        
    //  output += ' <div class="col-md-2">';
    //  output += ' <a href="#aboutModal" data-toggle="modal" data-target="#myModal">';
    //  output += '<img src="{{asset('student_images/' .'+data[count].image+' )}}" name="aboutme" width="120" height="120" border="0" class="img-circle"></a></div>';
    //  output += '<div class="col-md-5">';
    //  output += '<div class="form-group row">';
    //  output += '<h5 style="font-weight:bolder" class="col-sm-3">Name</h5>';
    //  output += '<div class="col-sm-9"><h6  class="col-sm-10 " id="inputEmail3">' + data[count].first_name + '  '  +data[count].last_name+ '</h6></div></div>';
    //  output += '<div class="form-group row"><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Father</h5>';
    //  output += '<div class="col-sm-9"><h6  class="col-sm-10 col-form-label" id="inputEmail3">' + data[count].father_name  + '</h6></div></div>';
    //  output += '<div class="form-group row"><strong><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Mobile</h5></strong>';
    //  output += '<div class="col-sm-9"><h6  class="col-sm-10 col-form-label" id="inputEmail3">' + data[count].phone  + '</h6></div></div></div>';

    //  output += '<div class="col-md-5"><div class="form-group row"><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Faculty</h5>';
    //  output += '<div class="col-sm-9"><h6  class="col-sm-10 col-form-label" id="inputEmail3">' + data[count].faculty_name  + '</h6></div></div>';
    //  output += '<div class="form-group row"><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Department</h5>';
    //  output += ' <div class="col-sm-9"><h6  class="col-sm-10 col-form-label" id="inputEmail3">' + data[count].department_name  + '</h6>';
    //  output += '</div></div><div class="form-group row"><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Class</h5><div class="col-sm-9"><h6  class="col-sm-5 col-form-label" id="inputEmail3">' + data[count].class_name  + '</h6></div></div></div>';
     

    // output += '</div></div></div>';

    // output += ' @if(count($readStudentFee)== 0)';
    // output += '<div class="panel"><div class="panel-body"><table style="margin-top: -12px;"><thead><tr>';
    // output += '<th>Grade</th><th>Admission Fee($)</th><th>School Fee($)</th><th>Total Fee Amount</th><th>Paid Amount($)</th><th>Balance Amount($)</th></tr></thead>';                
    // output += ' <tr>';
    // output += '<td><input type="text" class="form-control" style=" border:none; text-align:center; font-weight:bold;" value=' + data[count].semester_name  + ' readonly required>';
    // output += '</td>';
    // output += '<td><input type="text" style="text-align:right; border:none" class="form-control" value=' + data[count].admissionFee.toFixed(2) +' id="admissionFee" readonly="" required>';
    // output += '</td>';
    // output += '<td><input type="text" style="text-align:right; border:none" class="form-control" value=' + data[count].semesterFee.toFixed(2)  + '  id="semesterFee" readonly="" required>';
    // output += '</td>';
    // output += '<td><input type="text" style="text-align:right; border:none" class="form-control" name="amount" value='+ data[count].total_amount.toFixed(2) +' id="totalFee" readonly="" required>';
    // output += '</td>';
    // output += '<input type="hidden" name="semester_id1" id="semester_id1" class="form-control" value=' + data[count].semesterFee  + '>';
    // output += '<input type="hidden" name="department_id1" id="department_id1" class="form-control" value=' + data[count].semesterFee  + '>';
    // output += '<input type="hidden" name="level_id1" id="level_id1" class="form-control" value=' + data[count].semesterFee  + '>';
    // output += '<input type="hidden" name="fee_id" value=' + data[count].fee_structure_id  + ' id="FeeID">';
    // output += '<input type="hidden" name="student_id" value=' + data[count].student_id  + ' id="StudentID">';
    // output += '<input type="hidden" name="level_id" value=' + data[count].degree_id  + '  id="LevelID">';
    // output += '<input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="UserID">';
    // output += '<input type="hidden" name="transact_date" value="{{ date("Y-m-d-H:i:s")}}" id="TransacDate">';
    // output += '<input type="hidden" name="student_fee_id" id="student_fee_id">';

    // output += '<td><input type="text" class="form-control" style="text-align:right" name="paid_amount" id="Paid" required autocomplete="off"></td> ';
    // output += '<td><input type="text" class="form-control" style="text-align:right; border:none" name="balance" id="balance" readonly></td>';
    // output += '<input type="hidden" class="form-control" style="text-align:right; border:none" name="balance1" id="balance1" readonly>';
    // output += '</tr>';

    // output += '<thead>';
    // output += '<tr>';
    // output += '<th colspan="2">Remark</th>';
    // output += '<th colspan="5">Description</th>';
    // output += '</tr>';
    // output += ' </thead>';
    // output += '<tbody>';
    // output += '<tr>';
    // output += '<td colspan="2">';
    // output += '<input type="text" name="remark" class="form-control" id="remark" autocomplete="off">';
    // output += '</td>';
    // output += '<td colspan="5">';
    // output += '<input type="text" name="description" class="form-control" id="description" autocomplete="off">';
    // output += '</td>';
    // output += '</tr>';
    // output += '</tbody>';
    // output += '</div>';
    // output += '</div>';
    // output += '</table>';
    // output += '</div>';
    // output += '</div>';

    // output += '@endif';
    // }
    $('#show-student-paid').html(response);
    $('class_name').html(data.class_name);
    $('#show-total').show();
    $('#fee_report').show();
    $('#collect_fee').show();
    $('#multi_collect_fee').hide();
    $('#show-student-paid').show();
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
    // for(var count = 0; count < data.length; count++)
    // {

    //  output += '<div class="panel">';
    //  output += '<h4 class="col-sm-10 "style="margin-left:15px;font-weight:bolder" id="inputEmail3">' + data[count].username  + '</h5>';
    //  output += '<div class="panel-body">';
        
    //  output += ' <div class="col-md-2">';
    //  output += ' <a href="#aboutModal" data-toggle="modal" data-target="#myModal">';
    //  output += '<img src="{{asset('student_images/' .'+data[count].image+' )}}" name="aboutme" width="120" height="120" border="0" class="img-circle"></a></div>';
    //  output += '<div class="col-md-5">';
    //  output += '<div class="form-group row">';
    //  output += '<h5 style="font-weight:bolder" class="col-sm-3">Name</h5>';
    //  output += '<div class="col-sm-9"><h6  class="col-sm-10 " id="inputEmail3">' + data[count].first_name + '  '  +data[count].last_name+ '</h6></div></div>';
    //  output += '<div class="form-group row"><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Father</h5>';
    //  output += '<div class="col-sm-9"><h6  class="col-sm-10 col-form-label" id="inputEmail3">' + data[count].father_name  + '</h6></div></div>';
    //  output += '<div class="form-group row"><strong><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Mobile</h5></strong>';
    //  output += '<div class="col-sm-9"><h6  class="col-sm-10 col-form-label" id="inputEmail3">' + data[count].phone  + '</h6></div></div></div>';

    //  output += '<div class="col-md-5"><div class="form-group row"><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Faculty</h5>';
    //  output += '<div class="col-sm-9"><h6  class="col-sm-10 col-form-label" id="inputEmail3">' + data[count].faculty_name  + '</h6></div></div>';
    //  output += '<div class="form-group row"><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Department</h5>';
    //  output += ' <div class="col-sm-9"><h6  class="col-sm-10 col-form-label" id="inputEmail3">' + data[count].department_name  + '</h6>';
    //  output += '</div></div><div class="form-group row"><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Class</h5><div class="col-sm-9"><h6  class="col-sm-5 col-form-label" id="inputEmail3">' + data[count].class_name  + '</h6></div></div></div>';
     

    // output += '</div></div></div>';

    // output += ' @if(count($readStudentFee)== 0)';
    // output += '<div class="panel"><div class="panel-body"><table style="margin-top: -12px;"><thead><tr>';
    // output += '<th>Check</th><th>Grade</th><th>Admission Fee($)</th><th>School Fee($)</th><th>Total Fee Amount</th><th>Paid Amount($)</th><th>Balance Amount($)</th></tr></thead>';                
    // output += ' <tr>';
    
    // output += '<td><input type="checkbox" name="multifeepayment[]" value=' + data[count].student_id  + '  class="form-control1" text-align:center; font-weight:bold;" >';
    // output += '<td><input type="text" class="form-control" style=" border:none; text-align:center; font-weight:bold;" value=' + data[count].semester_name  + ' readonly required>';
    // output += '</td>';
    // output += '<td><input type="text" style="text-align:right; border:none" class="form-control" value=' + data[count].admissionFee.toFixed(2) +' id="admissionFee" readonly="" required>';
    // output += '</td>';
    // output += '<td><input type="text" style="text-align:right; border:none" class="form-control" value=' + data[count].semesterFee.toFixed(2)  + '  id="semesterFee" readonly="" required>';
    // output += '</td>';
    // output += '<td><input type="text" style="text-align:right; border:none" class="form-control" name="amount" value='+ data[count].total_amount.toFixed(2) +' id="totalFee" readonly="" required>';
    // output += '</td>';
    // output += '<input type="hidden" name="semester_id1" id="semester_id1" class="form-control" value=' + data[count].semesterFee  + '>';
    // output += '<input type="hidden" name="department_id1" id="department_id1" class="form-control" value=' + data[count].semesterFee  + '>';
    // output += '<input type="hidden" name="level_id1" id="level_id1" class="form-control" value=' + data[count].semesterFee  + '>';
    // output += '<input type="hidden" name="fee_id" value=' + data[count].fee_structure_id  + ' id="FeeID">';
    // output += '<input type="hidden" name="student_id" value=' + data[count].student_id  + ' id="StudentID">';
    // output += '<input type="hidden" name="level_id" value=' + data[count].degree_id  + '  id="LevelID">';
    // output += '<input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="UserID">';
    // output += '<input type="hidden" name="transact_date" value="{{ date("Y-m-d-H:i:s")}}" id="TransacDate">';
    // output += '<input type="hidden" name="student_fee_id" id="student_fee_id">';

    // output += '<td><input type="text" class="form-control" style="text-align:right" name="paid_amount" id="Paid" required autocomplete="off"></td> ';
    // output += '<td><input type="text" class="form-control" style="text-align:right; border:none" name="balance" id="balance" readonly></td>';
    // output += '<input type="hidden" class="form-control" style="text-align:right; border:none" name="balance1" id="balance1" readonly>';
    // output += '</tr>';

    // output += '<thead>';
    // output += '<tr>';
    // output += '<th colspan="2">Remark</th>';
    // output += '<th colspan="5">Description</th>';
    // output += '</tr>';
    // output += ' </thead>';
    // output += '<tbody>';
    // output += '<tr>';
    // output += '<td colspan="2">';
    // output += '<input type="text" name="remark" class="form-control" id="remark" autocomplete="off">';
    // output += '</td>';
    // output += '<td colspan="5">';
    // output += '<input type="text" name="description" class="form-control" id="description" autocomplete="off">';
    // output += '</td>';
    // output += '</tr>';
    // output += '</tbody>';
    // output += '</div>';
    // output += '</div>';
    // output += '</table>';
    // output += '</div>';
    // output += '</div>';

    // output += '@endif';
    // }
    $('#show-student-paid').html(response);
    $('class_name').html(data.class_name);
    $('#show-multi_total').show();
    $('#fee_report').show();
    $('#multi_collect_fee').show();
    $('#collect_fee').hide();
    $('#show-student-paid').show();

   }
  })
 }


 $('#filter').click(function(){
  var class_code = $('#class_code').val();
  var semester_id = $('#semester_id').val();
  var roll_no = $('#roll_no').val();

  if(class_code != '' &&  semester_id != '' && roll_no == '')
  {
   fetch_data(class_code, semester_id);
   $('#roll_id').show();

  }
  else if(class_code == '' &&  semester_id == '' && roll_no != '')
  {
    fetch_data_roll_no(roll_no)
    $('#roll_id').hide();
    $('#semesterFee').val();

  }
  else
  {
   alert('Both Date is required');
   $('#show-total').hide();
   $('#fee_report').hide();
  }
 });

 $('#refresh').click(function(){
  $('#semester_id').val('');
  $('#class_code').val('');
  $('#roll_no').val('');
  // fetch_data();
  // fetch_data_roll_no();
  $('#show-total').hide();
  $('#show-multi_total').hide();
  $('#fee_report').hide();
  $('#collect_fee').hide();
  $('#multi_collect_fee').hide();
  $('#show-student-paid').hide();
 });

 $('#class_code').on('change', function(){

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