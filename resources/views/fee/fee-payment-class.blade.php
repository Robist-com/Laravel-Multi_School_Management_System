@extends('layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')
<section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true">FEE PAYMENT PORTAL</i></h1>
<a  class="pull-left btn btn-danger" href="{{url('all/student/list')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

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
                    <div class="panel  panel-default"> 

                      <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">

                    {{-- @if(count($data)!="0") --}}
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
                        </div>
                        </div>
                        </div>
                      @include('fee.detail')
                    </div>
                    </div>
                  
                    <div class="col-md-3" id="fee_type_select" style="display:none1">
                  <label for="">Fee Type</label>
                  <select name="fee_type" id="fee_type_id" class="form-control select_2_single">
                      <option value="" selected="true" selected="true">Select Fee Type</option>
                        @foreach($fee_structure as $fee_structure)
                        <option value="{{$fee_structure->id}}">{{$fee_structure->fee_type}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="clearfix"></div>
                      {{--@if(count($readStudentFee)== 0)--}}
                      <form action="{{route('savePayment')}}" method="POST" id="frmPayment">
                    <!-- {{ csrf_field() }} -->
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
                     
                    <div class="modal-footer">
                      {{-- <button class="btn btn-lg btn-success pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button> --}}
                      <a href="{{route('All_Student_Fee_Transactios',[$student->student_id])}}" target="_blank"><button class="btn btn-lg btn-danger pull-left" type="button"><i class="glyphicon glyphicon-arraw-back"></i> Show all Transactions</button> </a>
                        <input type="submit" id="btn-go" name="btn-go" class="btn btn-success btn-payment pull-right" value="{{'Save Payment'}}">
                        @if(count($readStudentFee)!= 0)
                        {{-- <a href="{{ url('printInvoice','invoice_id') }}" class="btn btn-primary btn-sm" target="_blank">Print</a>--}}
                        @endif
                    </div>
                 {{--@endif--}}
                </form>
                @endforeach
              </div>
            </div>
             </div>
            {{-- @endif --}}
          {{-- </div> --}}
        </div>
        {{-- <div class="text-center"> --}}
          {{-- <div class="box box-primary"> --}}
            <div class="box-body">
          {{-- <div class="panel-body"> --}}
            @if(count($data)!="0")
            @if(count($readStudentFee)!= 0)
            @include('fee.list.studentFeelist')
            <input type="hidden" value="0" id="disabled">
            @endif
            @endif

        {{-- </div> --}}
        {{-- </div> --}}
    </div>
  {{-- </div> --}}
  @csrf
          
            <div class="tab-pane" id="messages">
              {{-- @include('fee.feeTypes.multiFeePayment')  --}}
            </div>
          {{-- </div> --}}

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


         