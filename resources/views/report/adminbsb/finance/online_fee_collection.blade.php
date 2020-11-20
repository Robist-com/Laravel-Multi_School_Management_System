@php
use Carbon\Carbon;
$now = Carbon::now();
$year = $now->year;
$month = $now->month;
$week =  $now->weekOfYear;
$lastweek = \Carbon\Carbon::today()->subDays(7);

@endphp

<strong>Select Criteria</strong>
                    <hr>
                    <div class="row">
                    <div class="form-group">
                       <form action="{{route('postOnlinefee_collectionReport')}}" method="POST">
                           @csrf

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
                        <label for="">Type <b style="color:red">*</b></label>
                        <select name="type_id" id="type_id" class="form-control bootstrap-select">
                        <option value="" selected="true">Select</option>
                        <option value="{{$now }}">Today</option>
                        <!-- <option value="{{date('Y', strtotime($week))}}" @if(request('type_id')) selected @endif>This Week</option> -->
                        <option value="{{$lastweek }}" @if(request('type_id') === $lastweek) selected @endif>Last Week</option>
                        <option value="{{$month}}" @if(request('type_id') === $month) selected @endif>This Month</option>
                        <option value="{{$year}}" @if(request('type_id') === $year) selected @endif>This Year</option>
                        </select>
                        </div>

                        <div class="col-md-4" style="display: none;">
                        <label for="">Collect By<b style="color:red">*</b></label>
                        <select name="user_id" id="user_id" class="form-control bootstrap-select">
                        <option value="" selected="true">---Select Staff---</option>
                        @foreach($users as $key => $staff)
                        <option value="{{$staff->id}}" @if(isset($user_name)) @if($user_name->id === request('user_id')) selected @endif @endif>{{$staff->name}}</option>
                        @endforeach
                        </select>
                        <div class="col-md-2"><span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span></div>
                        </div>

                        <div class="col-md-4" style="display: none;">
                        <label for="">Group By<b style="color:red">*</b></label>
                        <select name="group_by" id="group_by" class="form-control bootstrap-select">
                        <option value="" selected="true">---Select---</option>
                        <option value="Cash" @if( request('group_by')) selected @endif>Mood</option>
                        <option value="class" @if( request('group_by')) selected @endif>Class</option>
                        </select>
                        </div>

                        <div class=" pull-right " style="margin-top:25px" >
                        <button type="submit" class="btn bg-teal btn-round "><i class="fa fa-search"></i>search</button>
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

.border{
        no-border-right: solid 1px tranparent;
        /* color: red; */
        background: #fff;
        font-weight: bolder
 }
 .name{
     font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
     font-weight: normal;
 }


 #loader{
   visibility:hidden;
   }

</style>
           
            
            @if(isset($data_collection))
            <hr>
            <strong>Online Fee Collection Report</strong>
            <hr>

            <div class="table-responsive" id="student_transaction_balance">
            <table id1="datatable-buttons" class="table table-striped table-bordered js-exportable">
                <thead >
     
                <tr>
                   
            <th style="text-align:center;">Invoice</th>
            <th style="text-align:center;">Grade</th>
            <th style="text-align:center;">Student</th>
            <th style="text-align:center;">Fee type</th>
            <th style="text-align:center;">Class</th>
            <th style="text-align:center;">Collect By</th>
            <th style="text-align:center;">Date</th>
            <th style="text-align:center;">Mood</th>
            <th style="text-align:center;">Amount </th>
            <th style="text-align:center;"> Discount</th>
            <th style="text-align:center;">Balance</th>
            <th style="text-align:center;"></th>
        </tr>
        <tbody> 
       
        @foreach($data_collection as $key => $data)
       
        <tr>
        <td style="text-align:center;">{{$data->invoice_id}}</td>
        <td style="text-align:center;">{{$data->semester_name}}</td>
        <td style="text-align:center;">{{$data->full_name}}</td>
        <td style="text-align:center;">{{$data->fee_type}}</td>
        <td style="text-align:center;">{{$data->class_name}}</td>
        <td style="text-align:center;">{{$data->name}}</td>
        <td style="text-align:center;">{{date('d/m/Y', strtotime($data->transaction_date))}}</td>
        <td style="text-align:center;">@if($data->mood == 'Cash') <i class="fa fa-money fa-lg"> {{$data->mood}}</i> @elseif($data->mood == 'Bank') <i class="fa fa-bank fa-lg"> {{$data->mood}}</i> @elseif($data->mood == 'Credit') <i class="fa fa-cc-master-card fa-lg"> {{$data->mood}}</i>@elseif($data->mood == 'Paypal') <i class="fa fa-paypal fa-lg"> {{$data->mood}}</i>@endif </td>
        <!-- <td style="text-align:center;">{{number_format($data->paid_amount,2)}} </td> -->
        <td style="text-align:center;">{{number_format($data->school_fee,2)}}</td>
        <td style="text-align:center;">{{number_format($data->paid_amount,2)}}</td>
        <td style="text-align:center;">@if($data->balance == 0) <span class="label label-success ">Completed</span> @else <span class="label label-danger">{{number_format($data->balance,2)}}</span> @endif</td>
        <td><a href="{{ route ('StudentInvoicePrint', [$data->invoice_id])}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a></td>
        </tr>
        @endforeach
       
        <tr style="background-color: #ffff; border-right:1px solid #fff; font-family:'Times New Roman', Times, serif; font-size:larger; text-transform:uppercase;">
             <td style="background-color: #ffff; border-right:1px solid #fff">
             <label for=""></label>
             </td>
             <td style="background-color: #ffff; border-right:1px solid #fff">
             <label for=""></label>
             </td>
             <td style="background-color: #ffff; border-right:1px solid #fff">
             <label for=""></label>
             </td>
             <!-- <td style="background-color: #ffff; border-right:1px solid #fff">
             <label for=""></label>
             </td> -->
             
             <td style="background-color: #ffff; border-right:1px solid #fff">
             <b></b>
             </td>
             <td style="background-color: #ffff; border-right:1px solid #fff">
            <b></b>
             </td>
             <td style="background-color: #ffff; border-right:1px solid #fff">
             <label for="" style="text-decoration: underline;">Total</label>
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
            <b>$  {{number_format($total_balance1->sum('total_outgoings',2))}}</b>
             </td>
             <td style="background-color: #ffff; border-right:1px solid #fff; color:crimson">
            <b> $ {{number_format($total_balance1->sum('total_balance',2))}}</b>
             </td>
             <td style="background-color: #ffff; border-left:1px solid #fff">
             <label for="" style="color:teal">$ {{$total_balance1->sum('total_schoolFee')+$total_balance1->sum('total_outgoings')+$total_balance1->sum('total_balance')}}</label>
             </td>
         </tr>
        @endif
        
        </tbody>
    </thead>
</table>
@csrf
    </div>
<!-- </div> -->
