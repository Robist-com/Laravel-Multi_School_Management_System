@extends('layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')

<section class="content-header">
    <h1 class="pull-right">
       <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('fees.create') }}">Add New</a>
    </h1>

  <h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true">Fee</i></h1>

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

                      <div class="panel-heading">
                        <h3 style="font-weight:bold;text-transform: uppercase; text-decoration:underline">
                         <i class="fa fa-money"></i> FEE<b style="color:red"> PAYMENT PORTAL</b>
                        </h3>
                        </div>
                          <div class="panel-body" id="add-class-info">
                          <div class="form-group col-sm-1" style="padding-left:-0px;">
                              <i class="badge glyphicon glyphicon-filter" style="background:red; font-weight:bold">FILTER-BY:</i>
                          </div>
                          <br>
                          <br>
                          <hr class="line">
                          <form action="{{  url('/student/fee/collection/payment')}}" method="get">

                              <div class="form-group col-sm-4">
                              <select class="form-control select_2_single" name="semester_id" id="semester_id">
                              <option value="">Select Semester</option>
                              @foreach($semester as $semester)
                              <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                              @endforeach
                          </select>
                          </div>

                          <!-- Level Id Field -->
                          <div class="form-group col-sm-4">
                              <select class="form-control select_2_single " name="degree_id" id="degree_id">
                              <option value="">Select Degree</option>

                              </select>
                              </div>

                                  <!-- Level Id Field -->
                          <div class="form-group col-sm-4">
                              <select class="form-control select_2_single " name="class_id" id="class_id">
                              <option value="">Select Class</option>
                                  @foreach($classes as $class)
                                  <option value="{{$class->id}}">{{$class->class_name}}</option>
                                  @endforeach
                              </select>
                              </div>

                              <!-- Level Id Field -->
                          <div class="form-group col-sm-4">
                              <select class="form-control select_2_single " name="faculty_id" id="faculty_id">
                              <option value="">Select Faculty</option>
                                  @foreach($faculty as $faculty)
                                  <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                                  @endforeach
                              </select>
                              </div>
                          <!-- Course Id Field -->
                          <div class="form-group col-sm-4">
                          <select class="form-control select_2_single" name="department_id" id="department_id">
                              <option selected disabled>Select Department</option>
                          </select>
                          </div>

                            <!-- Course Id Field -->
                            <div class="form-group col-sm-4">
                              <select class="form-control select_2_single" name="student_id" id="student_id">
                                  <option selected disabled>Select Student</option>
                              </select>
                              </div>
                          <button type="submit" class="btn btn-info pull-right fa fa-search"; style="font-weight:bold;font-size:12px;"><i></i> filter</button>
                          </div>
                          </form>
                         </div>
                         </div>
                        </div>
                        <div class="clearfix"></div>
                      <div class="box box-primary">
                          <div class="box-body">
                       {{-- @if(count($data)!="0") --}}
                       @foreach ($data1 as $data)
                       <div class="panel">
                    <h4 class="col-sm-10 "style="margin-left:15px;font-weight:bolder" id="inputEmail3">{{ $data->username }}</h5>
                         <div class="panel-body">
                    <form action="{{ count($readStudentFee) != 0? route('exstraPay')  : route('savePayment')}}" method="POST" id="frmPayment">
                    {{ csrf_field() }}
                        <div class="col-md-2">
                          <a href="#aboutModal" data-toggle="modal" data-target="#myModal">
                            <img src="{{asset('student_images/'.$data->image)}}"
                          name="aboutme" width="120" height="120" border="0" class="img-circle"></a>
                        </div>
                              <div class="col-md-5">
                                <div class="form-group row">
                                    <h5 style="font-weight:bolder" class="col-sm-3">Name</h5>
                                    <div class="col-sm-9">
                                    <h6  class="col-sm-10 " id="inputEmail3">{{$data->first_name ." ". $data->last_name}}</h6>
                                  </div>
                                  </div>
                              <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Father</h5>
                                <div class="col-sm-9">
                                <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$data->father_name}}</h6>
                                </div>
                              </div>
                              <div class="form-group row">
                                <strong><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Mobile</h5></strong>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$data->phone}}</h6>
                                </div>
                              </div>
                          </div>

                          <div class="col-md-5">
                            <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Faculty</h5>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$data->faculty_name}}</h6>
                                </div>
                              </div>
                              <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Department</h5>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$data->department_name}}</h6>
                                </div>
                              </div>
                              <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Class</h5>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-5 col-form-label" id="inputEmail3">{{$data->class_name}}</h6>
                                </div>
                              </div>
                        </div>
                      @include('fee.fee-payment-class-detail')

                      </div>
                    </div>
                    </div>
                      {{-- <hr> --}}
                      @if(count($readStudentFee)== 0)
                      <div class="panel">
                      <div class="panel-body">
                        <table style="margin-top: -12px;">
                          <thead>
                          <tr>
                              <th>Semester</th>
                              <th>Admission Fee($)</th>
                              <th>Semester Fee($)</th>
                              <th>Total Fee Amount</th>
                              <th>Paid Amount($)</th>
                              <th>Balance Amount($)</th>
                          </tr>
                          </thead>
                          <tr>
                          <td>
                          <input type="text" class="form-control" style=" border:none; text-align:center; font-weight:bold;" value="{{$data->semester_name}}" readonly>
                          </td>
                          <td>
                          <input type="text" style="text-align:right; border:none" class="form-control" value="{{$data->admissionFee}}" id="admissionFee" readonly="">
                          </td>
                          <td>
                          <input type="text" style="text-align:right; border:none" class="form-control" value="{{$data->semesterFee}}" id="semesterFee" readonly="">
                          </td>
                          <td>
                          <input type="text" style="text-align:right; border:none" class="form-control" name="amount" value="" id="totalFee" readonly="">
                          </td>
                          <input type="hidden" name="semester_id1" id="semester_id1" class="form-control" value="{{$data->semesterFee}}">
                          <input type="hidden" name="department_id1" id="department_id1" class="form-control" value="{{$data->semesterFee}}">
                          <input type="hidden" name="level_id1" id="level_id1" class="form-control" value="{{$data->semesterFee}}">

                        <input type="hidden" name="fee_id" value="{{$data->fee_structure_id}}" id="FeeID">
                        <input type="hidden" name="student_id" value="{{$data->student_id}}" id="StudentID">
                        <input type="hidden" name="level_id" value="{{$data->degree_id}}" id="LevelID">
                          {{-- <input type="text" name="level_name" value="{{$semes->level or null}}" id="LevelID"> --}}
                          <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="UserID">
                          <input type="hidden" name="transact_date" value="{{ date('Y-m-d-H:i:s')}}" id="TransacDate">
                          <input type="hidden" name="student_fee_id" id="student_fee_id">

                          <td>
                          <input type="text" class="form-control" style="text-align:right" name="paid_amount" id="Paid">
                          </td>

                          <td>
                          <input type="text" class="form-control" style="text-align:right; border:none" name="balance" id="balance" readonly>
                          </td>
                          </tr>

                          <thead>
                          <tr>
                          <th colspan="2">Remark</th>
                          <th colspan="5">Description</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                          <td colspan="2">
                          <input type="text" name="remark" class="form-control" id="remark">
                          </td>
                          <td colspan="5">
                          <input type="text" name="description" class="form-control" id="description">
                          </td>
                          </tr>
                          </tbody>
                          </div>
                          </div>
                            </table>
                          </div>
                      </div>
                    {{-- </div> --}}

                    <div class="panel-footer">
                      {{-- <button class="btn btn-lg btn-success pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button> --}}
                        <input type="submit" id="btn-go" name="btn-go" class="btn btn-success btn-payment pull-right" value="{{count($readStudentFee)!= 0 ? 'Update Pay' : 'Submit Payment'}}">
                        @if(count($readStudentFee)!= 0)
                        <a href="{{ url('printInvoice','invoice_id') }}" class="btn btn-primary btn-sm" target="_blank">Print</a>
                        @endif
                    </div>
                 @endif
                </form>
                @endforeach
              </div>
            </div>
             {{-- </div> --}}
            {{-- @endif --}}
             {{-- </div>  --}}
            <div class="panel-body">
                {{-- @if(count($data)!="0") --}}
                @if(count($readStudentFee)!= 0)
                @include('fee.list.studentFeelist')
                <input type="hidden" value="0" id="disabled">
                @endif
                {{-- @endif --}}

            </div>
            <div class="tab-pane" id="messages">
            </div>
          </div>

            @endsection

            @section('scripts')
                @include('fee.script.calculate')
                @include('fee.script.payment')
      <script>
    $(document).ready(function(){

    // GET SEMESTER DEGREEE
    $('#semester_id').on('change',function(e){
    //   getStudentsByclass()
        var semester_id = $(this).val();
        var degree = $('#degree_id')
            $(degree).empty();
        $.get("{{ route('dynamicDegrees') }}",{grade:semester_id},function(data){

            console.log(data);
            $.each(data,function(i,l){
            $(degree).append($('<option/>',{
                value : l.id,
                text  : l.level
            }))
        })
    })
});

$('#department_id').on('change', function(){
    getStudentsByclass()
});

// $('#class_id').on('change', function(){
//     getStudentsByclass()
//     alert(1)
// });


// GET SEMESTER DEGREEE
        $('#faculty_id').on('change',function(e){
        //   getStudentsByclass()
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
        {'faculty_id':faculty_id,'department_id':department_id,'class_code':class_id,
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

// });
});
</script>
            @endsection


