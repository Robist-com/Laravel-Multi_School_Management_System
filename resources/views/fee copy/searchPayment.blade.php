@extends('layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')
<div class="panel  panel-default">
<div class="panel-heading">
                    <div class="col-md-3">
                    <form action="{{route('showStudentPayment')}}" class="search-payment" method="GET">
                        <input class="form-control" type="text"  name="student_id" Placeholder="Student ID">
                    </form>
                    </div>
                    <div class="col-md-3">
                        <label class="eng-name">Name: <b class="student-name"></b></label>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <label class="date-invoice"><b>Date:</b> <b class="">{{date('d-M-Y')}}</b></label>
                    </div>

                    <div class="col-md-3" style="text-align: right;">
                        <label class="invoice-number"><b>Receipt N<sup>0</sup>:</b></label>
                    </div>
                </div>

                <div class="panel-body"> 

                <table style="margin-top: -12px;">
                <caption class="academicDetail">

                </caption>
            
            <thead>
                <tr>
                    <th>Program</th> 
                    <th>Level</th>
                    <th>School Fee($)</th>
                    <th>Amount($)</th>
                    <th>Dis(%)</th>
                    <th>Paid($)</th>
                    <th>Amount Lack($)</th>
                </tr>
            </thead>

                <tr>
                <td>
                    <select name="AcademicID" id="AcademicID">
                        <option value=""><b>Select</b></option>
                    </select>
                </td>

                <td>
                    <select>
                        <option value=""><b>Select</b></option>
                    </select>
                                        </td>

                                        <td>
                                        <input type="text" name="fee" id="Fee" readonly="true">
                                        <input type="hidden" name="fee-id" id="FeeID">
                                        <input type="hidden" name="student-id" id="StudentID">
                                        <input type="hidden" name="level-id" id="LevelID">
                                        <input type="hidden" name="user-id" id="UserID">
                                        <input type="hidden" name="transacdate" id="TransacDate">
                                        </td>

                                        <td>
                                        <input type="text" name="discount" id="Discount">
                                        </td>

                                        <td>
                                        <input type="text" name="discount" id="Discount">
                                        </td>

                                        <td>
                                        <input type="text" name="paid" id="Paid">
                                        </td>

                                        <td>
                                        <input type="text" name="balance" id="Balance">
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
                                            <input type="text" name="remark" id="remark">
                                        </td>
                                        <td colspan="5">
                                            <input type="text" name="description" id="description">
                                        </td>
                                    </tr>
                                    </tbody>
                     </table>
                </div>
                <div class="panel-footer" style="height: 40px;"></div>
            </div>
            </div>
            @endsection
