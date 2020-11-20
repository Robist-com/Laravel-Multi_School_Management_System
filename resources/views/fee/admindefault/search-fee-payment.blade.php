
    <div class="page-title">
              <div class="title_left">
                <h3>COLLECT FEES</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" name="roll_no1" id="roll_no1" placeholder="Search by...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" name="filter1" id="filter1" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <div class="col-md-2"><span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span></div>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('levels.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                  <label for="">Roll</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="roll_no" id="roll_no"  placeholder="Search for..." value="41116093000111">
                    <span class="input-group-btn">
                      <button class="btn btn-default" name="filter" id="filter" type="button">Go!</button>
                    </span>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
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

                <div class="col-md-4 col-sm-4 col-xs-12">
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
               
                    <div class="modal-footer">
                    <button type="button" name="refresh" id="refresh" class="btn btn-dark btn-sm btn-round">Refresh</button>
                    </div>
                   
                <div class="col-md-3 col-sm-3 col-xs-12" id="fee_type_select" style="display:none">
                <label for=""> </label> <span style="font-size:13px; margin-left:80px"> FEE TYPE</span>
                <select name="fee_type" id="fee_type_id" class="form-control select_2_single">
                    <option value="" selected="true" selected="true">Select Fee Type</option>
                      @foreach($fee_structure as $fee_structure)
                      <option value="{{$fee_structure->id}}">{{$fee_structure->fee_type}}</option>
                      <input type="hidden" name="" id="fee_structure_id" value="{{$fee_structure->id}}">
                      <input type="hidden" name="" id="semesterFee" value="{{$fee_structure->semesterFee}}">
                      @endforeach
                  </select>
                  </div>
                 
                 
<!-- <div class=""> -->
<!-- <div  id="main_body1" style1="display:none">  -->

<form action="{{ count($readStudentFee) != 0? route('exstraPay')  : route('savePayment')}}" method="POST" id="frmPayment">
@include('fee.admindefault.fee-payment')

</form>

   @include('fee.all_fees')

   </div>
   </div>
   </div>
  </div>
  </div>
</div>
</div>


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
// $('#panel_fee').hide();
$('#fee_type_select').hide();
  var date = new Date();
  
//   $('.input-daterange').datepicker({
//   todayBtn: 'linked',
//   format: 'yyyy-mm-dd',
//   autoclose: true
//  });


 function fetch_feeType(fee_type = '')
 {

 

  $.ajax({
   url:"{{ route('getFeeTypes') }}",
   method:"POST",
   data:{fee_type:fee_type, _token:_token},
  //  dataType:"json",
  beforeSend: function(){
      $('#loader').css("visibility", "visible");
  },
   success:function(response)
   {
    
    $('#total_records').text(response.length);
    $('#show-fee-type').html(response);
    $('#show-total').show();
    $('#fee_report').show();
    var semesterFee = $('#semesterFee').val();
    $('#totalFee').val(parseInt(semesterFee))

   },
   complete: function(){
        $('#loader').css("visibility", "hidden");
      }
  })
 }


$('#fee_type_id').on('change', function(){
var fee_type = $(this).val();
// alert(fee_type)
var semesterFee = $('#semesterFee').val();
alert(semesterFee)
$('#totalFee').val(semesterFee);
// var admissionFee = $('#admissionFee').val();

if (fee_type != '') {
fetch_feeType(fee_type)
$('#roll_id').show();
$('#show-student-paid').show();
// $('#main_body').show();
$('#panel_fee').show();
$('#panel_fee').css("visibility", "visible");
$('#payment_submitButton').css("visibility", "visible");

// $('#totalFee').val(semesterFee);

// $('#main_body').show();
  }
  else{
    alert('Please Select fee type')
    $('#panel_fee').hide()
    $('#payment_submitButton').css("visibility", "hidden");
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
  beforeSend: function(){
      $('#loader').css("visibility", "visible");
  },
   success:function(response)
   {
    // var output = '';
    // alert(response)
    console.log(response);
    // $('#total_records').text(response.length);
    $('#show-student-paid').html(response);
    // $('class_name').html(data.class_name);
    $('#show-total').show();
    $('#fee_report').show();
    $('#collect_fee').show();
    $('#multi_collect_fee').hide();
    // $('#allfees-table').hide();
    $('#show-student-paid').show();
    $('#main_body').show();
    $('#panel_fee').hide();
    $('#fee_type_select').show();

    // $('.show-student-paid').html(data) 
   }
   ,
   complete: function(){
        $('#loader').css("visibility", "hidden");
      }
  })
 }

 function fetch_data(class_code = '', semester_id = '')
 {
  $.ajax({
   url:"{{ route('FeeCollectionPaymentGradeClass') }}", 
   method:"POST",
   data:{class_code:class_code, semester_id:semester_id, _token:_token},
  //  dataType:"json",
  beforeSend: function(){
      $('#loader').css("visibility", "visible");
      $('#loader').show();
  },
   success:function(response)
   {
    
    console.log(response)
    $('#multi_total_records').text(response.length);
    $('#show-student-money').html(response);
    // $('class_name').html(data.class_name);
    $('#show-multi_total').show();
    $('#fee_report').show();
    $('#multi_collect_fee').show();
    $('#collect_fee').hide();
    $('#show-student-paid').show();
    // $('#allfees-table').hide();
    $('#main_body').show();
    $('#fee_type_select').show();

   }
   ,
   complete: function(){
        $('#loader').hide();
      }
  })
 }

// $('#loader').hide();

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
  var roll_no = $('#roll_no').val('');

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