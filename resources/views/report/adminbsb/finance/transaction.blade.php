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
</style>
           
            <div class="table-responsive" id="student_transaction">
            @if(isset($data))
            <hr>
            <strong>Transaction Report</strong>
            <hr>
            <table id1="datatable-buttons" class="table table-striped table-bordered js-exportable">
                <thead >
              
                <tr>
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">Accountant</th>
            <th style="text-align:center;">Fee type</th>
            <th style="text-align:center;">Student</th>
            @if(request('class_code'))
            <th style="text-align:center;">Class</th>
            @endif
            <th style="text-align:center;">Transaction Date</th>
            <th style="text-align:center;">School Fee</th>
            <!-- <th style="text-align:center;">Fee Amount</th> -->
            <th style="text-align:center;">Paid Amount</th>
            <th style="text-align:center;">Balance</th>
            <th style="text-align:center;">
            @if(request('roll_no_transaction'))
            @foreach($rolls as $rolls)
            <a href="{{ route ('StudentTransactionPrint', [$rolls->student_id])}}"  
            target="_blank" class="btn btn-warning btn-xs"><i class="fa fa-print" title="Print all"></i></a>
            @endforeach
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
        <td style="text-align:center;">{{$data->full_name}}</td>
        @if(request('class_code'))
        <td style="text-align:center;">{{$data->class_name}} </td>
        @endif
        <td style="text-align:center;">{{$data->transaction_date}} </td>
        <td style="text-align:center;">{{number_format($data->school_fee,2)}}</td>
        <!-- <td style="text-align:center;">{{number_format($data->student_fee,2)}}</td> -->
        <td style="text-align:center;">{{number_format($data->paid_amount,2)}}</td>
        <td style="text-align:center;">{{number_format($data->balance,2)}}</td>
        @if(isset($data))
        <td><a href="{{ route ('StudentInvoicePrint', [$data->invoice_id])}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a></td>
        @endif
        <!-- <td><a href="student/transactions/ '+ data[count].student_id +'" target="_blank" class="btn btn-warning btn-xs"><i class="fa fa-print" title="Print all"></i></a></td> -->
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
             <td style="background-color: #ffff; border-right:1px solid #fff">
             <label for=""></label>
             </td>
             @if(request('class_code'))
             <td style="background-color: #ffff; border-right:1px solid #fff"></td>
            @endif
             <td style="background-color: #ffff; border-right:1px solid #fff">
             <label for="">Total</label>
             </td>
             <td style="background-color: #ffff; border-right:1px solid #fff">
             <b>$ {{number_format($total_fee,2)}}</b>
             </td>
             <td style="background-color: #ffff; border-right:1px solid #fff">
            <b>$  {{number_format($total_paid,2)}}</b>
             </td>
             <td style="background-color: #ffff; border-right:1px solid #fff; color:crimson">
            <b> $ {{number_format($total_balance,2)}}</b>
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
