@extends('layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')


                    <div class="panel  panel-default"> 
                    
                    <div class="panel-heading">
                    <div class="col-md-3">
                    <form action="{{route('showStudentPayment')}}" class="search-payment" method="GET">
                    <input class="form-control" type="hidden" value="{{$student_id}}" name="student_id" id="Student_ID" Placeholder="Student ID">
                    <input class="form-control" type="text" value="{{$roll_no->username}}" name="student_id" id="Student_ID" Placeholder="Student ID">
                    </form>
                    </div>
                    <div class="col-md-5">
                        <label class="eng-name">Student Name: <b class="student-name">{{ $roll->first_name." ".$roll->last_name}}</b></label>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <label class="date-invoice"><span>Date:</span> <b class="">{{date('d-M-Y')}}</b></label>
                    </div>

                    <div class="col-md-3" style="text-align: right;">
                        <label class="invoice-number">Receipt N<sup>0</sup>: <b>{{sprintf('%05d','$invoice_id')}}</b></label>
                    </div>
                </div>

                <form action="{{ count($readStudentFee) !=0 ? route('exstraPay')  : route('savePayment')}}" method="POST" id="frmPayment">
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

                        <!-- <a class="btn btn-success pull-right " style="" href="#"
                        data-toggle="modal" data-target="#classschedule-show"><i class="fa fa-plus"></i></a> -->
                        <!-- <a data-toggole="modal" data-target="#classschedule-show" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> -->
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
                <table style="margin-top: -12px;">
                <caption class="academicDetail" style="font-size:100%" >
                        @include('fees.detail')
                        <span class="message-alert"></span>
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
                <input type="text" class="form-control" value="" id="totalFee" readonly="">
                </td>  
                <input type="hidden" name="semester_id1" id="semester_id1" class="form-control" value="{{$semes->semester_name}}">         
                <input type="hidden" name="department_id1" id="department_id1" class="form-control" value="{{$semes->department_name}}">
                <input type="hidden" name="level_id1" id="level_id1" class="form-control" value="{{$semes->level}}">
                 
                     
                <input type="hidden" name="fee_id" value="{{$semesterfee->fee_id or null}}" id="FeeID">
                <input type="hidden" name="student_id" value="{{$student_id or null}}" id="StudentID">
                <input type="hidden" name="level_id" value="{{$roll->level_id or null}}" id="LevelID">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="UserID">
                <input type="hidden" name="transact_date" value="{{ date('Y-m-d-H:i:s')}}" id="TransacDate">
                <input type="hidden" name="s_fee_id" id="s_fee_id">

                <td>
                <input type="text" class="form-control" name="paid" id="Paid">
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
                <div class="panel-footer">
                    <input type="submit" id="btn-go" name="btn-go" class="btn btn-info btn-payment" value="{{count($readStudentFee)!=0 ? 'Exstra Pay' : 'Save'}}">
                    @if(count($readStudentFee)!=0)
                    <a href="{{ url('printInvoice',$receipt_id) }}" class="btn btn-primary btn-sm" target="_blank">Print</a>
                    @endif
                    <button type="button" onclick="this.form.reset()" class="btn btn-danger btn-reset pull-right"><span class="fa fa-refresh"> Reset</span></button>
                </div>
            </form>

            </div>
            </div>
            @if(count($readStudentFee)!=0)
           
            <input type="hidden" value="0" id="disabled">
            @endif
            </div>








            
            @endsection

            @section('scripts')
                @include('fees.semester_course.course_modal') 
                @include('fee.script.calculate') 
                @include('fee.script.payment')
            @endsection 


         