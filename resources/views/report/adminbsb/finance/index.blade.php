
<style>
  ul li {
    list-style: none;
  }

  div a{
    position: relative;
    /* display: block; */
    text-decoration: none ;
    text-transform:capitalize;
    color: #262626;
    /* font-weight: bold; */
  }

  div.active a{
    background-color: #009688;
    color: #ffff;
  }

  div.active {
    background-color: #009688;
    color: #ffff;
  }
</style>
<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}

.select {
    color: #ffffff !important;
    text-decoration: none;
}

a:hover{
    text-decoration: none !important;
    color: #000000
}

a{
    text-decoration: none !important;
    color: #000000
}
</style>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>STUDENT ACADEMICS REPORTS </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>

    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                <h3>{{ ucfirst(request()->segment(1)) }} {{ ucfirst(request()->segment(2)) }}</h3>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row">
                      <div class="form-group">
                    <div class=" col-sm-4 {{ (request()->segment(1) == 'fee-statement' || request()->segment(2) == 'fee-statement') ? 'active' : '' }}">
                          <i class="fa fa-file-o"></i> <a href="{{route('getfee_statementReport')}}" class="sidebar-link"> fee-statemen Report</a>
                    </div>

                    <div class="col-sm-4 {{ (request()->segment(1) == 'balance' || request()->segment(1) == 'poststudentbalance') ? 'active' : '' }} " >
                          <i class="fa fa-file-o"></i> <a href="{{route('getbalanceReport')}}" class="sidebar-link"> Balance Fee Report</a>
                    </div>

                    <div class=" col-sm-4 {{ (request()->segment(1) == 'feecollection' || request()->segment(2) == 'feecollection') ? 'active' : '' }}">
                    <i class="fa fa-file-o"></i> <a href="{{route('getfee_collectionReport')}}" class="sidebar-link"> Fee Colection Report</a>
                    </div>
                    </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="form-group">
                    <div class=" col-sm-4 {{ (request()->segment(1,2) == 'income') ? 'active' : '' }}">
                           <i class="fa fa-file-o"></i> <a href="{{route('getincomeReport')}}" class="sidebar-link"> Income Report</a>
                    </div>

                    <div class="col-sm-4  {{ (request()->segment(1,2) == 'expense') ? 'active' : '' }}">
                    <i class="fa fa-file-o"></i> <a href="{{route('getexpenseReport')}}" class="sidebar-link"> Expense Report</a>
                    </div>

                    <div class="col-sm-4  {{ (request()->segment(1,2) == 'payroll') ? 'active' : '' }}">
                           <i class="fa fa-file-o"></i> <a href="{{route('getpayrollReport')}}" class="sidebar-link"> Payroll Report</a>
                    </div>
                    </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="form-group">
                    <div class=" col-sm-4 {{ (request()->segment(1,2) == 'transactions') ? 'active' : '' }}">
                           <i class="fa fa-file-o"></i> <a href="{{route('gettransactionsReport')}}" class="sidebar-link"> Transactions Report</a>
                    </div>

                    <div class=" col-sm-4 {{ (request()->segment(1) == 'online-fee-collection' || request()->segment(2) == 'online-fee-collection') ? 'active' : '' }}">
                    <i class="fa fa-file-o"></i> <a href="{{route('getOnlinefee_collectionReport')}}" class="sidebar-link"> Online Fee Collection Report</a>
                    </div>

                    <div class=" col-sm-4">
                           <i class="fa fa-file-o"></i> <a href=""> Payroll Report</a>
                    </div>
                    </div>

                    </div>
                   
                 

                    @if(isset($transctions_balance))
                    
                    @include('report.adminbsb.finance.balance_field')
                    @include('report.adminbsb.finance.balance')

                    @elseif(isset($transctions_feestatement))
                    @include('report.adminbsb.finance.fee_statement')

                    @elseif(isset($transctions_feecollection))
                    @include('report.adminbsb.finance.fee_collection')

                    @elseif(isset($transctions_onlinefeecollection))
                    @include('report.adminbsb.finance.online_fee_collection')

                    @elseif(isset($poststudentbalancereport))
                    @include('report.adminbsb.finance.balance')

                    @elseif(isset($transctions))
                    
                    <strong>Select Criteria</strong>
                    <hr>
                    <div class="row">
                    <div class="form-group">
                    @if(auth()->user()->group == "Admin")
                        <div class="col-md-12">
                            <label for="">School <b style="color:red">*</b></label>
                        <select name="school_id" id="school_id" class="form-control bootstrap-select">
                            <option value="">Select</option>
                            @foreach(auth()->user()->school->all() as $school)
                            <option value="{{$school->id}}" @if(isset($school)){{$school->id == request('school_id') ? 'selected' : '' }} @endif>{{$school->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <br>
                        @else
                        <input type="hidden" name="school_id" id="school_id" class="form-control bootstrap-select" value="{{auth()->user()->school->id}}">
                          <br>
                        @endif

                        <div class="col-md-4">
                          
                            <label for="">Roll No <b style="color:red">*</b></label>
                            <!-- <div class="input-group"> -->
                              <select name="roll_no_transaction" id="roll_no_transaction" class="form-control bootstrap-select" >
                              <option value="">Select</option>  
                              @foreach($student_roll as $key => $roll_no)
                                <option value="{{$roll_no->username}}"  @if(request('roll_no_transaction')) selected @endif>{{$roll_no->full_name}}</option>
                                @endforeach
                              </select>
                          
                        </div>

                        <div class="col-md-4">
                            <label for="">Grade <b style="color:red">*</b></label>
                        <select name="semester_id" id="grade_id" class="form-control bootstrap-select">
                            <option value="">Select</option>
                            @foreach($semesters as $semester)
                            <option value="{{$semester->id}}" @if(isset($classstudentreport_single)){{$semester->id == $classstudentreport_single->semester_id ? 'selected' : '' }} @endif>{{$semester->semester_name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-4">
                        <label for="">Class <b style="color:red">*</b></label>
                        <select name="class_code" id="class_id" class="form-control bootstrap-select">
                        <option value="">Select</option>
                            @foreach($classes as $class)
                            <option value="{{$class->class_code}}" @if(isset($classstudentreport_single)){{$class->class_code == $classstudentreport_single->class_code ? 'selected' : '' }} @endif>{{$class->class_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    </div>
                    @include('report.adminbsb.finance.transaction')
                    @endif

                    @include('flash::message')
              @include('adminlte-templates::common.errors')
        </div>
        </div>
      
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


@section('js')
<script>
$(document).ready(function(){
$('#show-total').hide();
$('#transaction_fee').hide();
  var date = new Date();
  
  $('.js-exportable').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});

// $(document).on('click', 'ul div a', function(){
//   $(this).addClass('active').siblings().removeClass('active');
// })
  // alert(1)

var _token = $('input[name="_token"]').val();

//  fetch_data();
//  fetch_data_roll_no();

 function fetch_data_roll_no(roll_no_transaction = '', school_id = '')
 {
  $.ajax({
   url:"{{ route('posttransactionsReport') }}",
   method:"POST",
   data:{roll_no_transaction:roll_no_transaction, school_id:school_id,  _token:_token},
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

 function fetch_data(class_code = '', semester_id = '', school_id = '')
 {
  $.ajax({
   url:"{{ route('posttransactionsReport') }}",
   method:"POST",
   data:{class_code:class_code, semester_id:semester_id, school_id:school_id, _token:_token},
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

      $('#message').text(response.message);

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

//  SCHOOL RELATED INFOMATIONS

function getSchoolRelatedStudentBalance(school_id){
  $.get("{{ route('getSchoolRelatedStudent') }}",{school_id:school_id},function(data){  
    // $(roll_no_balance).empty();

    $('#roll_no_balance').empty();
    $('#roll_no_balance').append($('<option>').text("--Select Student--").attr('value',""));
    $.each(data,function(i,s){
      console.log(data);

      $('#roll_no_balance').append($('<option>').text(s.full_name).attr('value', s.username));
    })
})
}

function getSchoolRelatedStaffs(school_id){
  $.get("{{ route('getSchoolRelatedStaff') }}",{school_id:school_id},function(data){  

    $('#user_id').empty();
    $('#user_id').append($('<option>').text("--Select Staff--").attr('value',""));
    $.each(data,function(i,s){
      console.log(data);

      $('#user_id').append($('<option>').text(s.name).attr('value', s.id));
    })
})
}

function getSchoolRelatedStudentTransaction(school_id){
  $.get("{{ route('getSchoolRelatedStudent') }}",{school_id:school_id},function(data){  
    // $(roll_no_transaction).empty();

  
    $('#roll_no_transaction').empty();
    $('#roll_no_transaction').append($('<option>').text("--Select Student Roll No--").attr('value',""));
    $.each(data,function(i,s){
      console.log(data);

      $('#roll_no_transaction').append($('<option>').text(s.full_name).attr('value', s.username));
    })
})
}

var school_id = $('#school_id').val();
if (school_id == "") {
  $('#user_id').prop('disabled',true);
  $('.saerch_mode').prop('disabled',true);
}else{
  $('#user_id').prop('disabled',false);
$('.saerch_mode').prop('disabled',false);
}



$('#school_id').on('change',function(e){

  var school_id = $(this).val();

$.ajax({
  url:"{{ route('getSchoolInfo') }}",
  data:{school_id:school_id},
  type:'get',
  dataType: 'json',

  beforeSend: function(){
        $('#loader').css("visibility", "visible");
    },
  success: function( json ) {


    $('#grade_id').empty();
    $('#grade_id').append($('<option>').text("--Select grade--").attr('value',""));
    $.each(json, function(i, grade) {
       console.log(grade);

      $('#grade_id').append($('<option>').text(grade.semester_name).attr('value', grade.id));
    });
  },
  complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
});
getSchoolRelatedStudentBalance(school_id); getSchoolRelatedStudentTransaction(school_id);
getSchoolRelatedStaffs(school_id);
$('#user_id').prop('disabled',false);
$('.saerch_mode').prop('disabled',false);
});

  $('#grade_id').on('change',function(e){


    var grade_id = $(this).val();
    var class_id = $('#class_id')
    $('#roll_no_transaction').val('');

        $(class_id).empty();
    
        $('#class_id').append($('<option>').text("--Select Class--").attr('value', ""));
    $.get("{{ route('getGradeRelatedClass') }}",{grade_id:grade_id},function(data){  
        
    console.log(data);
    $.each(data,function(i,c){
    $(class_id).append($('<option/>',{
    value : c.class_code,
    text  : c.class_name
    }))
    }) ;

    })
    });



 $('#roll_no_transaction').on('change',function(){
  var class_code = $('#class_id').val();
  var school_id = $('#school_id').val();
  $('#grade_id').val('');
  $('#class_id').val('');
  var roll_no_transaction = $('#roll_no_transaction').val();

  if(roll_no_transaction != '' && school_id != '')
  {
    fetch_data_roll_no(roll_no_transaction, school_id)
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
  $('#grade_id').val('');
  $('#class_id').val('');
  $('#roll_no').val('');
//   fetch_data();
//   fetch_data_roll_no();
  $('#all_transaction').show();
  $('#show-total').hide();
  $('#transaction_fee').hide();
 });

 $('#class_id').on('change', function(){
    var class_code = $('#class_id').val();
    var semester_id = $('#grade_id').val();
    var school_id = $('#school_id').val();

  if(class_code != '' &&  semester_id != '' && school_id != '')
  {
   fetch_data(class_code, semester_id, school_id);
   $('#roll_id').show();

  }
   var cla = $(this).val();
   $('#class_name').text(cla);
   $('#roll_no').val('');
 });

 $('#grade_id').on('change', function(){
    var sem = $(this).val();
   $('#semester_name').text(sem);
  //  $('#roll_no').val('');
  //  $('#roll_no_balance').empty();
  //  $('#roll_no_balance').append($('<option>').text("--Select Student--").attr('value',""));
})

$('#roll_no').on('keyup', function(){
        $('#class_id').val('');
        $('#grade_id').val('');
    
})



// TRANSACTION BALANCE 


function fetch_student_roll_no(roll_no_balance = '', student_id = '')
 {
  $.ajax({
   url:"{{ route('poststudentbalanceReport') }}",
   method:"POST",
   data:{roll_no_balance:roll_no_balance, student_id:student_id,  _token:_token},
//    dataType:"json",
   success:function(response)
   {

    console.log(response)
    $("#student_transaction_balance").html(response);
    
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

 $('#roll_no_balance1').on('change', function(){
    var roll_no_balance = $('#roll_no_balance').val();
    var school_id = $('#school_id').val();

    // alert(roll_no);
    // alert(school_id);

  if(roll_no_balance != '' && school_id != '' )
  {
    fetch_student_roll_no(roll_no_balance, school_id);
  //  $('#roll_id').show();

  }
  //  var cla = $(this).val();
  //  $('#class_name').text(cla);
  //  $('#grade_id').val('');
 });

 
 $('#roll_no_balance').on('change',function(){
  var class_code = $('#class_id').val();
  var roll_no_balance = $('#roll_no_balance').val();
    var school_id = $('#school_id').val();

  if(roll_no_balance != '' && school_id != '')
  {

    fetch_student_roll_no(roll_no_balance, school_id)
    
  }
  else
  {
   alert('Roll Number Field is required');
   $('#show-total').hide();
   $('#fee_report').hide();
  }
 });



 $('#class_id').on('change', function(){
    var class_code = $('#class_id').val();
    var semester_id = $('#grade_id').val();

  if(class_code != '' &&  semester_id != '')
  {
   fetch_data(class_code, semester_id);
   $('#roll_id').show();

  }
  //  var cla = $(this).val();
  //  $('#class_name').text(cla);
  //  $('#roll_no_balance').val('');
 });

});
</script>
@endsection