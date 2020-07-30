<div class="table-responsive">
<div class="panel panel-default">
<div class="panel-heading">
    <h4 style="font-weight:bold; color:red" class="pull-right" id="print-all">
    
    </h4>
</div>

<h3 style="text-align:center; font-size: 20px; font-weight:bold" id="show-total"><span id="total_records" class="btn btn-danger"></span>  Paid Students Found <b > <label id="roll_id"> in -- Class -- <label for="" id="class_name" class="btn btn-info"></label>  -- <span>Grade -- <label for="" id="semester_name" class="btn btn-warning"></label></span></label></h3>
        <div class="panel-body" style="padding-bottom:4px;">
        <table class="table table-hover  table-condesed" class="display" style="width:100%" id="student_transaction1">
    <thead>
        <tr>
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">Accountant</th>
            <th style="text-align:center;">Fee type</th>
            <th style="text-align:center;">Student</th>
            <th style="text-align:center;">Transaction Date</th>
            <th style="text-align:center;">School Fee</th>
            <th style="text-align:center;">Student Amount</th>
            <th style="text-align:center;">Paid Amount</th>
            <th style="text-align:center;">Balance</th>
        </tr>
    </thead>
        <tbody> 
        @foreach($data as $key => $data)
        <tr>
        <td style="text-align:center;">{{$key+1}}</td>
        <td style="text-align:center;">{{$data->name}}</td>
        <td style="text-align:center;">{{$data->fee_type}}</td>
        <td style="text-align:center;">{{$data->first_name}} {{$data->last_name}}</td>
        <td style="text-align:center;">{{$data->transaction_date}} </td>
        <td style="text-align:center;">{{number_format($data->school_fee,2)}}</td>
        <td style="text-align:center;">{{number_format($data->student_fee,2)}}</td>
        <td style="text-align:center;">{{number_format($data->paid_amount,2)}}</td>
        <td style="text-align:center;">{{number_format($data->balance,2)}}</td>
        <td><a href="{{ route ('StudentInvoicePrint', [$data->invoice_id])}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a></td>
        <!-- <td><a href="student/transactions/ '+ data[count].student_id +'" target="_blank" class="btn btn-warning btn-xs"><i class="fa fa-print" title="Print all"></i></a></td> -->
        </tr>
        @endforeach
        </tbody>
</table>
@csrf
    </div>
</div>
