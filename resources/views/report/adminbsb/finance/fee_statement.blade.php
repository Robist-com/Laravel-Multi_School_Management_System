<strong>Select Criteria</strong>
<hr>
<div class="row">
    <div class="form-group">
        <form action="{{route('postfee_statementReport')}}" method="POST">
            @csrf

            @if(auth()->user()->group == "Admin")
            <div class="col-md-12">
                <label for="">School <b style="color:red">*</b></label>
                <select name="school_id" id="school_id" class="form-control bootstrap-select">
                    <option value="">Select</option>
                    @foreach(auth()->user()->school->all() as $school)
                    <option value="{{$school->id}}"
                        @if(isset($school)){{$school->id == request('school_id') ? 'selected' : '' }} @endif>
                        {{$school->name}}</option>
                    @endforeach
                </select>
            </div>
            <br>
            @else
            <input type="hidden" name="school_id" id="school_id" class="form-control bootstrap-select"
                value="{{auth()->user()->school->id}}">
            <br>
            @endif

            <div class="col-md-4">
                <label for="">Student<b style="color:red">*</b></label>
                <select name="roll_no_feestatement" id="roll_no_balance" class="form-control bootstrap-select">
                    <option value="" selected="true">---Select Student---</option>
                    @foreach($students as $key => $student)
                    <option value="{{$student->username}}" @if($student->username === request('roll_no_feestatement'))
                        selected @endif>{{$student->first_name}} {{$student->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="">Grade<b style="color:red">*</b></label>
                <select name="grade_id" id="grade_id" class="form-control bootstrap-select">
                    <option value="" selected="true">---Select Grade---</option>
                    @foreach($semesters as $semester)
                    <option value="{{$semester->id}}"
                        @if(isset($semesters)){{$semester->id == request('grade_id') ? 'selected' : '' }} @endif>
                        {{$semester->semester_name}}</option>
                    @endforeach
                </select>
                <div class="col-md-2"><span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span></div>
            </div>

            <div class="col-md-4">
                <label for="">Class<b style="color:red">*</b></label>
                <select name="class_code" id="class_id" class="form-control bootstrap-select">
                    <option value="" selected="true">---Select Class---</option>
                    @foreach($classes as $class)
                    <option value="{{$class->class_code}}" @if(isset($classes)) @if($class->class_code ==
                        request('class_code')) selected @endif @endif>{{$class->class_name}}</option>
                    @endforeach
                </select>
                <br>
                <button type="submit" class="btn bg-teal btn-round pull-right"><i
                        class="fa fa-search"></i>search</button>
            </div>
        </form>
    </div>
</div>

<style>
/* .border{
    border: 1px solid #ddd !important;
} */

table {
    border-collapse: collapse;
    border: solid 1px #000;
}

.border table td {
    border: solid 1px #000;
}

.no-border-right {
    border-right: solid 1px #FFF;
    color: red;
}

.border {
    no-border-right: solid 1px tranparent;
    /* color: red; */
    background: #fff;
    font-weight: bolder
}

.name {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: normal;
}


#loader {
    visibility: hidden;
}
</style>


@if(isset($data_feestatement))
<hr>
<strong>Fee Statement Report</strong>
<hr>

<div class="row">
    <div class="form-group">
        @foreach($student_detail as $detail)
        <div class=" col-sm-3 {{ (request()->segment(1,2) == 'fee-statement') ? 'active' : '' }}">
            <img width="115" height="115" src="{{asset('student_images/' .$detail->image)}}" alt="" srcset="">
        </div>
        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'fee statement') ? 'active' : '' }}">
            <label class="sidebar-link">Name : </label>
        </div>

        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'balance') ? 'active' : '' }}">
            <label class="sidebar-link name"> {{$detail->full_name}}</label>
        </div>

        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'fee collection') ? 'active' : '' }}">
            <label class="sidebar-link"> Grade : </label>
        </div>

        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'fee collection') ? 'active' : '' }}">
            <label class="sidebar-link name"> {{$detail->semester_name}}</label>
        </div>
        <!-- <hr> -->
        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'fee statement') ? 'active' : '' }}">
            <label class="sidebar-link">Father Name : </label>
        </div>

        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'balance') ? 'active' : '' }}">
            <label class="sidebar-link name"> {{$detail->father_name}}</label>
        </div>

        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'fee collection') ? 'active' : '' }}">
            <label class="sidebar-link"> Class : </label>
        </div>

        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'fee collection') ? 'active' : '' }}">
            <label class="sidebar-link name"> {{$detail->class_name}}</label>
        </div>


        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'fee statement') ? 'active' : '' }}">
            <label class="sidebar-link">Guidance Name : </label>
        </div>

        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'balance') ? 'active' : '' }}">
            <label class="sidebar-link name"> -------------------</label>
        </div>

        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'fee collection') ? 'active' : '' }}">
            <label class="sidebar-link"> Group : </label>
        </div>

        <div class=" col-sm-2 {{ (request()->segment(1,2) == 'fee collection') ? 'active' : '' }}">
            <label class="sidebar-link name"> {{$detail->department_name}}</label>
        </div>
        <!-- <hr> -->
        @endforeach
    </div>
</div>
<hr>

<div class="table-responsive" id="student_transaction_balance">
    <table id1="datatable-buttons" class="table table-striped table-bordered js-exportable">
        <thead>

            <tr>

                <th style="text-align:center;">#</th>
                <th style="text-align:center;">Grade</th>
                <!-- <th style="text-align:center;">Desc</th> -->
                <th style="text-align:center;">Fee type</th>
                <th style="text-align:center;">Due Date</th> <!-- transactio date  -->
                <th style="text-align:center;">status</th>
                <th style="text-align:center;">Class</th>
                <th style="text-align:center;">Paid Amount</th>
                <th style="text-align:center;">Mood</th>
                <th style="text-align:center;">Date</th>
                <th style="text-align:center;"> Discount</th>
                <th style="text-align:center;">Balance</th>
                <th style="text-align:center;">Balance</th>
                <th style="text-align:center;">
                    @if(request('roll_no_feestatement'))
                    @foreach($rolls as $rolls)
                    <a href="{{ route ('StudentTransactionPrint', [$rolls->student_id])}}" target="_blank"
                        class="btn btn-warning btn-xs"><i class="fa fa-print" title="Print all"></i></a>
                    @endforeach
                    @endif
                </th>

            </tr>
        <tbody>

            @foreach($data_feestatement as $key => $data)

            <tr>
                <td style="text-align:center;">{{$key+1}}</td>
                <td style="text-align:center;">{{$data->semester_name}}</td>
                <!-- <td style="text-align:center;">{{$data->description}}</td> -->
                <td style="text-align:center;">{{$data->fee_type}}</td>
                <td style="text-align:center;">{{date('Y/m/d', strtotime($data->transaction_date))}}</td>
                <td style="text-align:center;">@if($data->status == 'paid') <span
                        class="label label-success ">Paid</span> @else <span class="label label-danger">UnPaid</span>
                    @endif</td>
                <td style="text-align:center;">{{$data->class_name}}</td>
                <td style="text-align:center;">{{number_format($data->paid_amount,2)}} <br> <i data-toggle="tooltip"
                        data-placement="right" title="collected by {{$data->name}} ({{$data->invoice_id}})"><i
                            class="fa fa-user fa-lg pull-left"></i><i class="fa fa-mail-forward pull-left"></i></i></td>
                <td style="text-align:center;">@if($data->mood == 'Cash') <i class="fa fa-money fa-lg">
                        {{$data->mood}}</i> @elseif($data->mood == 'Bank') <i class="fa fa-bank fa-lg">
                        {{$data->mood}}</i> @elseif($data->mood == 'Credit') <i class="fa fa-cc-master-card fa-lg">
                        {{$data->mood}}</i>@elseif($data->mood == 'Paypal') <i class="fa fa-paypal fa-lg">
                        {{$data->mood}}</i>@endif </td>
                <td style="text-align:center;">{{date('d/m/Y', strtotime($data->transaction_date))}}</td>
                <td style="text-align:center;">{{number_format($data->school_fee,2)}}</td>
                <td style="text-align:center;">{{number_format($data->paid_amount,2)}}</td>
                <td style="text-align:center;">@if($data->balance == 0) <span
                        class="label label-success ">Completed</span> @else <span
                        class="label label-danger">{{number_format($data->balance,2)}}</span> @endif</td>
                @if(isset($rolls))
                <td><a href="{{ route ('StudentInvoicePrint', [$data->invoice_id])}}" target="_blank"
                        class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a></td>
                @endif
            </tr>
            @endforeach

            <tr
                style="background-color: #ffff; border-right:1px solid #fff; font-family:'Times New Roman', Times, serif; font-size:larger; text-transform:uppercase;">
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <label for=""></label>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <label for=""></label>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <label for=""></label>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <label for=""></label>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <label for="" style="text-decoration: underline;">Total</label>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <b></b>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <b></b>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff;">
                    <b> $ {{number_format($total_balance1->sum('total_outgoings',2))}}</b>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <label for=""></label>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <label for=""></label>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <b>$ {{number_format($total_balance1->sum('total_schoolFee',2))}}</b>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff">
                    <b>$ {{number_format($total_balance1->sum('total_outgoings',2))}}</b>
                </td>
                <td style="background-color: #ffff; border-right:1px solid #fff; color:crimson">
                    <b> $ {{number_format($total_balance1->sum('total_balance',2))}}</b>
                </td>
                <td style="background-color: #ffff; border-left:1px solid #fff">
                    <label for=""></label>
                </td>
            </tr>
            @endif

        </tbody>
        </thead>
    </table>
    @csrf
</div>
<!-- </div> -->