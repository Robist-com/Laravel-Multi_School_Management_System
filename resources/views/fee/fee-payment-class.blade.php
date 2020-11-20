@extends('layouts.new-layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')
<!-- <section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true">FEE PAYMENT PORTAL</i></h1>
<a  class="pull-left btn btn-danger" href="{{ url()->full() }}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

</section> -->
<style>
#panel_fee{
visibility:hidden;
}
#payment_submitButton{
  visibility:hidden;
}
</style>
<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="page-title">
              <div class="title_left">
                <h2>CLASS FEE COLLECTION PORTAL</h2>
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
                        <a href="{{url('student/list/fee/collection')}}"><button type="submit" class="btn btn-round btn-warning"><i class="fa fa-refresh" aria-hidden="true"> Refresh </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

            <div class="clearfix"></div>
                    <div class="panel  panel-default"> 

                       @foreach ($data as $student)
                       <div class="panel" style="height:10%">
                    <h4 class="col-sm-10 "style="margin-left:15px;font-weight:bolder" id="inputEmail3">{{ $student->username }}</h5>
                         <div class="panel-body" >
               
                        <td><div class="col-md-2">
                          <a href="#aboutModal" data-toggle="modal" data-target="#myModal">
                            <img src="{{asset('student_images/'.$student->image)}}"  
                          name="aboutme" width="120" height="120" border="0" class="img-circle"></a>
                        </div></td>
                          <td> <div class="col-md-5">
                            <div class="form-group row">
                                <h5  class="col-sm-3" style="font-weight:bolder">Name</h5>
                                <div class="col-sm-9">
                                <h6  class="col-sm-10 " id="inputEmail3">{{$student->first_name ." ". $student->last_name}}</h6>
                              </div>
                              </div></td>
                             
                              <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Father</h5>
                                <div class="col-sm-9">
                                <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$student->father_name}}</h6>
                                </div>
                              </div>
                              <div class="form-group row">
                                <strong><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Mobile</h5></strong>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$student->phone}}</h6>
                                </div>
                              </div>
                          </div>

                          <div class="col-md-5">
                            <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Faculty</h5>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$student->faculty_name}}</h6>
                                </div>
                              </div>
                              <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Department</h5>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$student->department_name}}</h6>
                                </div>
                              </div>
                              <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Class</h5>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-5 col-form-label" id="inputEmail3">{{$student->class_name}}</h6>
                                </div>
                              </div>
                      </div>
                             
                      @include('fee.detail')
                      </div>
                     
                    <div class="col-md-12" id="fee_type_select" style="display:none1">
                    <hr>
                  <label for="">Fee Type</label>
                  <select name="fee_type" id="fee_type_id" class="form-control select_2_single">
                      <option value="" selected="true" selected="true">Select Fee Type</option>
                        @foreach($fee_structure as $fee_structure)
                        <option value="{{$fee_structure->id}}">{{$fee_structure->fee_type}}</option>
                        @endforeach
                    </select>
                    </div>
                   <hr>
                    <div class="clearfix"></div>
                      <form action="{{route('savePayment')}}" method="POST" id="frmPayment">
                         @csrf
                        
                         <div class="panel-body" id="panel_fee" style="display:none">
                              @include('fee.fee-type')
                        </div>
                              <input type="hidden" name="semester_id1" id="semester_id1" class="form-control" value="{{$student->semesterFee}}">         
                              <input type="hidden" name="department_id1" id="department_id1" class="form-control" value="{{$student->semesterFee}}">
                              <input type="hidden" name="level_id1" id="level_id1" class="form-control" value="{{$student->semesterFee}}">
                             
                            <!-- <input type="hidden" name="fee_id" value="{{$student->fee_structure_id}}" id="FeeID"> -->
                            <input type="hidden" name="student_id" value="{{$student->student_id}}" id="StudentID">
                            <input type="hidden" name="level_id" value="{{$student->degree_id}}" id="LevelID">
                              <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="UserID">
                              <input type="hidden" name="transact_date" value="{{ date('Y-m-d-H:i:s')}}" id="TransacDate">
                              <!-- <input type="hidden" name="student_fee_id" id="student_fee_id"> -->
                     
                    <div class="modal-footer" id="payment_submitButton">
                      <a href="{{route('All_Student_Fee_Transactios',[$student->student_id])}}" target="_blank"><button class="btn  btn-danger pull-left btn-round" type="button"><i class="glyphicon glyphicon-arraw-back"></i> Show all Transactions</button> </a>
                        <input type="submit" id="btn-go" name="btn-go" class="btn btn-success btn-payment pull-right btn-round" value="{{'Save Payment'}}">
                    </div>

                </form>
                @endforeach
            
            <div class="box-body">
            @if(count($data)!="0")
            @if(count($readStudentFee)!= 0)
            @include('fee.list.studentFeelist')
            <input type="hidden" value="0" id="disabled">
            @endif
            @endif
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

  @csrf
          
            <div class="tab-pane" id="messages">

            </div>

            @endsection

            @section('scripts')

                @include('fee.script.calculate') 
                @include('fee.script.payment')
            <script>
$(document).ready(function(){
    
  var _token = $('input[name="_token"]').val();

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
var semesterFee = $('#semesterFee').val();
$('#totalFee').val(semesterFee);
// var admissionFee = $('#admissionFee').val();

if (fee_type != '') {
fetch_feeType(fee_type)
$('#roll_id').show();
$('#show-student-paid').show();
$('#main_body').show();
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
    
    

    // GET SEMESTER DEGREEE
    $('#grade_id').on('change',function(e){
    //   getStudentsByclass()
        var grade_id = $(this).val();
        var level = $('#level_id')
            $(level).empty();
        $.get("{{ route('dynamicDegrees') }}",{grade_id:grade_id},function(data){  
    
            console.log(data);
            $.each(data,function(i,l){
            $(level).append($('<option/>',{
                value : l.id,
                text  : l.level
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

$('#department_id').on('change',function(e){
    getStudentsByclass()
});

// GET SEMESTER DEGREEE
// $('#faculty_id').on('change',function(e){
function getStudentsByclass(){
  var faculty_id = $('#faculty_id').val();
  var department_id = $('#department_id').val()
  var class_code = $('#class_id').val()
  var semester_id = $('#grade_id').val()
  var degree_id = $('#level_id').val()
  var student_id = $('#student_id')
  $(student_id).empty();
        $.get("{{ route('dynamicStudentsByClass') }}",
        {'faculty_id':faculty_id,
        'department_id':department_id,
        'class_code':class_code,
        'semester_id':semester_id,'degree_id':degree_id},function(data){  
            
        console.log(data);
        $.each(data,function(i,l){
        $(student_id).append($('<option/>',{
            value : l.id,
            text  : l.first_name
            // text  : 
    }))
}) 
})
}

// });
});
</script>


      <!-- <script>
    $(document).ready(function(){
    
    // GET SEMESTER DEGREEE
    $('#grade_id').on('change',function(e){
      getStudentsByclass()
        var grade_id = $(this).val();
        var level = $('#level_id')
            $(level).empty();
        $.get("{{ route('dynamicDegrees') }}",{semester_id:grade_id},function(data){  
    
            console.log(data);
            $.each(data,function(i,l){
            $(level).append($('<option/>',{
                value : l.id,
                text  : l.level
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
  var grade_id = $('#grade_id').val()
  var degree_id = $('#level_id').val()
  var student_id = $('#student_id')
  $(student_id).empty();
        $.get("{{ route('dynamicStudentsByClass') }}",
        {faculty_id:faculty_id,'department_id':department_id,'class_code':class_id,
        'semester_id':grade_id,'degree_id':level_id},function(data){  
            
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

// });
});
</script> -->
            @endsection 


         