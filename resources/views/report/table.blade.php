

<div class="table-responsive" id="show-student-paid" >
    <table class="table table-boredred table-hover table-striped table-condesed" class="display" style="width:100%; display:none" id="fee_report">
    <thead>
        <tr>
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">Accountant</th>
            <th style="text-align:center;">Fee Type</th>
            <th style="text-align:center;">Student</th>
            <th style="text-align:center;">Transaction Date</th>
            <th style="text-align:center;">Fee</th>
            <th style="text-align:center;">Student Amount</th>
            <th style="text-align:center;">Paid Amount</th>
            <th style="text-align:center;">Balance</th>
            <th id="print-student-transaction" style="display:none">
            {{ $students}}
            @if(isset( $students))
            <a class="btn btn-warning" href="{{route('StudentTransactionPrint', [$students->student_id])}}"><i class="fa fa-print"></i></a>
            @endif
            </th>
        </tr>
        <tbody>
        @foreach($data as $key => $data)
        <tr>
        <td style="text-align:center;">{{$key+1}}</td>
        <td style="text-align:center;"><input type="text" name="student_id" id="student_id" value="{{$data->student_id}}"></td>
        <td style="text-align:center;">{{$data->name}}</td>
        <td style="text-align:center;">{{$data->fee_type}}</td>
        <td style="text-align:center;">{{$data->first_name}} {{$data->last_name}}</td>
        <td style="text-align:center;">{{$data->transaction_date}}</td>
        <td style="text-align:center;">{{$data->school_fee}}</td>
        <td style="text-align:center;">{{$data->student_fee}}</td>
        <td style="text-align:center;">{{$data->paid_amount}}</td>
        <td style="text-align:center;">{{$data->balance}}</td>
        <td style="text-align:center;">
        <a class="btn btn-info" href="{{route('StudentInvoicePrint', [$data->invoice_id])}}"><i class="fa fa-print"></i></a>
        </td>
        </tr>
        @endforeach
        </tbody>
    </thead>
</table>
@csrf
