

<!-- <div class="panel panel-default"> -->

<div class="table-responsive">
    <table class="table  table-hover table-condesed" class="display" style="width:100%" id="student_transaction">
  
    <thead>
        <tr>
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">Accountant</th>
            <th style="text-align:center;">Fee type</th>
            <th style="text-align:center;">Student</th>
            <th style="text-align:center;">Transaction Date</th>
            <th style="text-align:center;">School Fee</th>
            <th style="text-align:center;">Fee Amount</th>
            <th style="text-align:center;">Paid Amount</th>
            <th style="text-align:center;">Balance</th>
            <th>
            @if(isset($rolls))
            <a href="{{ route ('StudentTransactionPrint', [$rolls->student_id])}}"  
            target="_blank" class="btn btn-warning btn-xs"><i class="fa fa-print" title="Print all"></i></a>
            @endif
            </th>

        </tr>
        <tbody> 
        @foreach($data as $key => $data)
        <tr>
        <td style="text-align:center;">{{$key+1}}</td>
        <!-- <input type="text" name="student_id" id="student_id" value="{{$data->student_id}}"> -->
        <td style="text-align:center;">{{$data->name}}</td>
        <td style="text-align:center;">{{$data->fee_type}}</td>
        <td style="text-align:center;">{{$data->first_name}} {{$data->last_name}}</td>
        <td style="text-align:center;">{{$data->transaction_date}} </td>
        <td style="text-align:center;">{{number_format($data->school_fee,2)}}</td>
        <td style="text-align:center;">{{number_format($data->student_fee,2)}}</td>
        <td style="text-align:center;">{{number_format($data->paid_amount,2)}}</td>
        <td style="text-align:center;">{{number_format($data->balance,2)}}</td>
        @if(isset($data))
        <td><a href="{{ route ('StudentInvoicePrint', [$data->invoice_id])}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a></td>
        @endif
        <!-- <td><a href="student/transactions/ '+ data[count].student_id +'" target="_blank" class="btn btn-warning btn-xs"><i class="fa fa-print" title="Print all"></i></a></td> -->
        </tr>
        @endforeach
        </tbody>
    </thead>
</table>
@csrf
    </div>
<!-- </div> -->
