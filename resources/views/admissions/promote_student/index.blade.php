@extends('layouts.app')
@include('fee.stylesheet.css-payment')
@section('content')
    <section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true"> PROMOTE STUDENT</i></h1>
<a  class="pull-left btn btn-danger" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

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

    <div class="col-md-4">
    <label for=""> </label> <span style="font-size:13px; margin-left:100px"> PROMOTE STUDENT</span>
        <div class="form-group">
        <select name="student_id_single" id="student_id_single" class="form-control select_2_single">
        <option value="" selected="true">SELECT STUDENT</option>
        @foreach($students as $key => $student)
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
    <div class="col-md-2">
    <label for=""> </label> <span style="font-size:13px; margin-left:10px" class="fa fa"></span>
        <div class="form-group">
      <a href="{{route('ShowPromoteStudent')}}"> <button type="button" name="promote_list" id="promote_list" class="btn btn-primary btn-sm">PROMOTED LIST</button></a>
        </div>
    </div>
    </div>



</div>
<!-- <br>
</div> -->


<div class="panel  panel-default" id="main_body" style="display:none"> 

<form action="{{ route('SavePromoteStudent')}}" method="POST" id="form_promotestudent">

<!-- @include('fee.fee-type') -->
<div id="promote_single_student">
@include('admissions.promote_student.field')
</div>
</form>


<div id="promote_classwise" style="display:none">
<form method="post" id="dynamic_form">
    @csrf
 <div class="modal-body" >
 <div  id="wait"></div>
 <div class="col-md-3">
        <label for=""> </label> <span style="font-size:13px; margin-left:100px"> FROM GRADE</span>
        <div class="form-group">
          <input type="text" name="previous_grade" style="border:none" id="previous_grade" class="form-control text-center">
        </div>
 </div>
             <div class="col-md-6">
                    <label for=""> </label> <span style="font-size:13px; margin-left:250px"> PROMOTE CLASS</span>
                <div class="input-group ">
                    <div class="input-group-addon"><i class="fas fa-sync-alt text-red" aria-hidden="true"></i></div>
                    <select name="grade_id_classwise" id="grade_id_classwise" class="form-control select_2_single" require>
                            <option value="" selected="true">TO GRADE</option>
                            @foreach($grades_promote as $grade)
                            <option value="{{$grade->id}}">{{$grade->semester_name}}</option>
                            @endforeach
                        </select>

                    <div class="input-group-addon"><i class="fas fa-sync-alt text-red" aria-hidden="true"></i></div>
                    <select name="class_code_classwise" id="class_code_classwise" class="form-control select_2_single" require>
                            <option value="" selected="true">TO CLASS</option>
                            @foreach($classes_promote as $class)
                            <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                            @endforeach
                    </select>
                </div>
                </div>
             <!-- </div> -->
             <div class="col-md-2">
             <label for=""> </label> <span style="font-size:13px; margin-left:100px" class="fa fa-promote"></span>
             <div class="input-group pull-right" >
            <input type="submit" id="btn_classwise_promote" name="classwise_promote" class="btn btn-success btn-payment pull-right" value="{{'Promote Student'}}">
            </div>
            </div>
             <div class="clearfix"></div>
           <br><br>

@include('admissions.promote_student.class')
</form>
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

$('#show-promotestudentclass-form').hide();
$('#show-promotestudent-form').hide();

  var date = new Date();
  
  $('.input-daterange').datepicker({
  todayBtn: 'linked',
  format: 'yyyy-mm-dd',
  autoclose: true
 });

 var _token = $('input[name="_token"]').val();



$('#student_id_single').on('change', function(){
  var student_id_single = $(this).val();

  if (student_id_single != '') {
    promote_student(student_id_single)

    $('#promote_classwise').hide();
    $('#promote_single_student').show();
  }
  else{
    alert('Please Select Student')
  }
});
 

$('#dynamic_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:'{{ route("SavePromoteStudentClasswise") }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                // $('#btn_classwise_promote').attr('disabled','disabled');
            },
            success:function(data)
            {
                console.log(data);
                if(data.error)
                {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.error(data.error);
                }
                else if(data.info)
                {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.info(data.info);
                }
                else
                {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);

                    $('#roll_no').val('');
                    $('#student_id_single').val('');
                    $('#semester_id_grade').val('');
                    $('#class_code').val('');
                    $('#show-total').hide();
                    $('#show-multi_total').hide();
                    $('#fee_report').hide();
                    $('#collect_fee').hide();
                    $('#multi_collect_fee').hide();
                    $('#show-promotestudent-form').hide();
                    $('#show-promotestudentclass-form').hide();
                    $('#main_body').hide();
                    // $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                // $('#btn_classwise_promote').attr('disabled', false);
            }
        })
 });

 function fetch_data_roll_no(roll_no = '')
 {
  $.ajax({
   url:"{{ route('PromoteStudent') }}",
   method:"POST",
   data:{roll_no:roll_no,  _token:_token},
  //  dataType:"json",
   success:function(response)
   {
    // var output = '';
    console.log(response);
    $('#total_records').text(response.length);
    $('#show-promotestudent-form').html(response);
    // $('class_name').html(data.class_name);
    $('#show-total').show();
    $('#fee_report').show();
    $('#collect_fee').show();
    $('#multi_collect_fee').hide();
    $('#show-promotestudent-form').show();
    $('#show-promotestudentclass-form').hide();
    $('#main_body').show();
    $('#panel_fee').hide();
    $('#fee_type_select').show();

    // $('.show-promotestudent-form').html(data) 
   }
  })
 }


 function promote_student(student_id_single = '')
 {
  $.ajax({
   url:"{{ route('PromoteStudent') }}",
   method:"POST",
   data:{student_id_single:student_id_single,  _token:_token},
  //  dataType:"json",
   success:function(response)
   {
    // var output = '';
    console.log(response);
    $('#total_records').text(response.length);
    $('#show-promotestudent-form').html(response);
    // $('class_name').html(data.class_name);
    $('#show-total').show();
    $('#fee_report').show();
    $('#collect_fee').show();
    $('#multi_collect_fee').hide();
    $('#show-promotestudent-form').show();
    $('#show-promotestudentclass-form').hide();

    $('#main_body').show();
    $('#panel_fee').hide();
    $('#fee_type_select').show();

    // $('.show-promotestudent-form').html(data) 
   }
  })
 }


 function fetch_data(class_code = '', semester_id = '')
 {
  $.ajax({
   url:"{{ route('PromoteStudent') }}", 
   method:"POST",
   data:{class_code:class_code, semester_id:semester_id, _token:_token},
  //  dataType:"json",
   success:function(response)
   {
       if (response.info) {
        toastr.options.closeButton = true;
        toastr.options.closeMethod = 'fadeOut';
        toastr.options.closeDuration = 100;
        toastr.error(response.info);

        // $('#semester_id').val('');
        // $('#class_code').val('');
        $('#roll_no').val('');
        $('#student_id_single').val('');
        // fetch_data();
        // fetch_data_roll_no();
        $('#show-total').hide();
        $('#show-multi_total').hide();
        $('#fee_report').hide();
        $('#collect_fee').hide();
        $('#multi_collect_fee').hide();
        $('#show-promotestudent-form').hide();
        $('#show-promotestudentclass-form').hide();
        $('#main_body').hide();

    }
    else{
    $('#multi_total_records').text(response.length);
    $('#show-promotestudentclass-form').html(response);
    // $('class_name').html(data.class_name);
    $('#show-multi_total').show();
    $('#fee_report').show();
    $('#multi_collect_fee').show();
    $('#collect_fee').hide();
    // $('#promote_classwise').show();
    $('#show-promotestudentclass-form').show();
    $('#show-promotestudent-form').hide();
    $('#main_body').show();
    $('#fee_type_select').show();
    
}
    
  


   }
  })
 }

 $('#class_code').on('change', function(){

    var class_code = $('#class_code').val();
    var semester_id = $('#semester_id_grade').val();
    var roll_no = $('#roll_no').val();

    if(class_code != '' &&  semester_id != '')
  {
   fetch_data(class_code, semester_id);
   $('#roll_id').show();
   $('#promote_classwise').show();
    // $('#promote_single_student').hide();
   $('#main_body').show();
   $('#panel_fee').hide();
  
  }
  else
  {
   alert('Please select Class or Grade');
   $('#show-total').hide();
   $('#fee_report').hide();
  }

});


 $('#filter').click(function(){
  var roll_no = $('#roll_no').val();

  if(roll_no != '')
  {
   fetch_data(roll_no);
   $('#roll_id').show();
   $('#show-promotestudent-form').show();
   $('#main_body').show();
   $('#panel_fee').hide();
  
  }
  else
  {
   alert('Enter Student Roll Number to Search');
   $('#roll_no').focus();
   $('#show-total').hide();
   $('#fee_report').hide();
  }
 });


 $('#refresh').click(function(){
  $('#semester_id_grade').val('');
  $('#class_code').val('');
  $('#roll_no').val('');
  $('#student_id_single').val('');
  // fetch_data();
  // fetch_data_roll_no();
  $('#show-total').hide();
  $('#show-multi_total').hide();
  $('#fee_report').hide();
  $('#collect_fee').hide();
  $('#multi_collect_fee').hide();
  $('#show-promotestudent-form').hide();
  $('#show-promotestudentclass-form').hide();
  $('#main_body').hide();
 });



 $('#semester_id_grade').on('change', function(){
    var sem = $(this).val();
    // alert(sem)
   $('#previous_grade').val(sem);
   $('#roll_no').val('');
})

$('#roll_no').on('keyup', function(){
        $('#class_code').val('');
        $('#semester_id_grade').val('');
    
})


});
</script>
@endsection