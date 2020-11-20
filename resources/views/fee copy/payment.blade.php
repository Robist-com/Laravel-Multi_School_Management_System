@extends('layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')


                    <div class="panel  panel-default">

                    <div class="panel-heading">
                    <div class="col-md-3">

                        <form action="{{ url('student-view-timetable') }}" method="get">
                            @foreach($data as $key => $semes)
                            {{-- <input type="text" name="semester_id" id="semester_id1" class="form-control" value="{{$semes->semester_id}}">
                            <input type="text" name="department_id" id="department_id1" class="form-control" value="{{$semes->department_id}}">
                            <input type="text" name="degree_id" id="level_id1" class="form-control" value="{{$semes->degree_id}}">
                            <input type="text" name="class_id" id="level_id1" class="form-control" value="{{$semes->class_id}}">
                            <input type="text" name="faculty" id="level_id1" class="form-control" value="{{$semes->faculty_id}}">
                                  --}}
                            {{-- <input type="hidden" name="fee_id" value="{{$semes->fee_structure_id}}" id="FeeID"> --}}
                            {{-- <input type="text" name="student_id" value="{{$semes->student_id }}" id="StudentID"> --}}
                            @endforeach
                            {{-- <button type="submit" class="btn btn-info">Check</button> --}}
                        </form>

                    <form action="{{route('showStudentPayment')}}" class="search-payment" method="GET">
                    <input class="form-control" type="hidden" value="{{$student_id}}" name="student_id" id="Student_ID" Placeholder="Student ID">
                    <input class="form-control" readonly type="text" value="{{$roll_no->username}}" name="student_id1" id="Student_ID" Placeholder="Student ID">
                    </form>
                    </div>
                    <div class="col-md-5">
                        <label class="badge eng-name">Student Name: <b class="student-name">{{ $roll->first_name." ".$roll->last_name}}</b></label>
                    </div>

                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <label class="badge date-invoice"><span>Payment Date:</span> <b class="">{{  date ('d-M-Y')}}</b></label>
                    </div>

                    <div class="col-md-3" style="text-align: right;">
                        <label class="badge invoice-number">Invoice N<sup>0</sup>: <b>{{sprintf("%'.06d\n", $invoice_id)}}</b></label>
                    </div>
                </div>

                <form action="{{ count($readStudentFee) != 0? route('exstraPay')  : route('savePayment')}}" method="POST" id="frmPayment">
                {{ csrf_field() }}
                <div class="panel-body">
                <div class="panel">
                    <div class="col-md-12 panel-heading">
                        <div class="col-md-4">
                        <h3 style="font-weight:bold;text-transform: uppercase">
                        @foreach($data as $key => $semes){{$semes->semester_name}} @endforeach <b style="color:red">FEE</b>
                        </h3>
                        </div>

                        <div class="col-md-4" >
                        <h5 style="font-weight:bold;text-transform: uppercase">
                        FACULTY
                        <b style="color:red">  @foreach($data as $key => $semes){{$semes->faculty_name}} @endforeach </b>
                        </h5>
                        </div>

                         <div class="col-md-6" >
                        <h5 style="font-weight:bold;text-transform: uppercase">
                        DEPARTMENT
                        <b style="color:red"> @foreach($data as $key => $semes){{$semes->department_name}} @endforeach </b>
                        </h5>
                        <h5 class="pull-right"><b>Degree: </b> @foreach($data as $key => $semes){{$semes->level}} @endforeach </h5>
                        </div>
                    </div>
                    <hr class="line" style="margin-top:9%">

                <div class="panel-body">
                    <div class="col-md-2">
                    {{-- <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        View Student Subject's
                      </button> --}}
                      <img src="{{asset('student_images/' .$roll->image)}}" alt=""
                      class="rounded-circle" width="85" height="85" style="border-radius:50%; vertical-alight:middle;">
                    </div>
                      <div class="col-md-5">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                              <label  class="col-sm-10 col-form-label" id="inputEmail3">{{ $roll->first_name." ".$roll->last_name}}</label>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Father</label>
                            <div class="col-sm-9">
                              <label  class="col-sm-10 col-form-label" id="inputEmail3">{{ $roll->father_name}}</label>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                              <label  class="col-sm-10 col-form-label" id="inputEmail3">{{ $roll->phone}}</label>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Faculty</label>
                            <div class="col-sm-9">
                              <label  class="col-sm-10 col-form-label" id="inputEmail3">{{ $roll->faculty_name}}</label>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                              <label  class="col-sm-10 col-form-label" id="inputEmail3">{{ $roll->department_name}}</label>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Class</label>
                            <div class="col-sm-9">
                              <label  class="col-sm-5 col-form-label" id="inputEmail3"> @foreach($data as $key => $semes){{$semes->class_name}} @endforeach</label>
                              <label  class="col-sm-5 col-form-label" id="inputEmail3"> @foreach($data as $key => $semes){{$semes->batch}} @endforeach</label>
                            </div>
                          </div>
                      {{-- </div> --}}
                    {{-- </div> --}}

                    <div class="message-alert" style="text-align:center"></div>
                    </div>
                      <table style="margin-top: -12px;" id="payment-table">
                <caption class="academicDetail" style="font-size:100%" >
                        <td colspan="12" class="hiddenrow">
                            @include('fee.detail')
                        </td>
                    </caption>
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
             @foreach($data as $key => $semes)
                <tr>
                <td>
                <input type="text" class="form-control" value="{{$semes->semester_name}}" readonly>
                </td>
                <td>
                <input type="text" class="form-control" value="{{$semes->admissionFee}}" id="admissionFee" readonly="">
                </td>
                <td>
                <input type="text" class="form-control" value="{{$semes->semesterFee}}" id="semesterFee" readonly="">
                </td>
                <td>
                <input type="text" class="form-control" name="amount" value="" id="totalFee" readonly="">
                </td>
                <input type="hidden" name="semester_id1" id="semester_id1" class="form-control" value="{{$semes->semester_name}}">
                <input type="hidden" name="department_id1" id="department_id1" class="form-control" value="{{$semes->department_name}}">
                <input type="hidden" name="level_id1" id="level_id1" class="form-control" value="{{$semes->level}}">

                <input type="hidden" name="fee_id" value="{{$semes->fee_structure_id}}" id="FeeID">
                <input type="hidden" name="student_id" value="{{$semes->student_id }}" id="StudentID">
                <input type="hidden" name="level_id" value="{{$semes->degree_id }}" id="LevelID">
                {{-- <input type="text" name="level_name" value="{{$semes->level or null}}" id="LevelID"> --}}
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="UserID">
                <input type="hidden" name="transact_date" value="{{ date('Y-m-d-H:i:s')}}" id="TransacDate">
                <input type="hidden" name="student_fee_id" id="student_fee_id">

                <td>
                <input type="text" class="form-control" name="paid_amount" id="Paid">
                </td>

                <td>
                <input type="text" class="form-control" name="balance" id="balance" readonly>
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
                @endforeach
                     </table>
                </div>
            </div>
        </div>
                <div class="panel-footer">
                    {{-- <button type="button" onclick="this.form.reset()" class="btn btn-danger btn-reset pull-right"><span class="fa fa-refresh"> Reset</span></button> --}}
                    <input type="submit" id="btn-go" name="btn-go" class="btn btn-success btn-payment pull-right" value="{{'Submit Payment'}}">
                    @if(count($readStudentFee)!= 0)
                    <a href="{{ url('printInvoice',$invoice_id) }}" class="btn btn-primary btn-sm" target="_blank">Print</a>
                    @endif
                </div>
            </form>
            </div>
            
                @if(count($readStudentFee)!= 0)
                @include('fee.list.studentFeelist')
                <input type="hidden" value="0" id="disabled">
                @endif

            </div>
            </div>
            {{-- </div> --}}

            @endsection

            @section('scripts')
                @include('fee.semester_course.course_modal')
                @include('fee.script.calculate')
                @include('fee.script.payment')
            @endsection


