<div class="accordian-body collapse " id="demo{{$key}}">
<!-- {{ $key==0 ? 'in' : null}} -->
    <table> 
        <thead>

            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Transaction Date</th>
                <th style="text-align: center;">Cashier</th>
                <th style="text-align: center;">Paid Amount ($)</th>
                <th style="text-align: center;">Remark</th>
                <th style="text-align: center;">Description</th>
                <th style="text-align: center;">Action</th>

            </tr>
        </thead>
        <tbody>

            @foreach($readStudentTransaction->where('student_fee_id',$sf->student_fee_id) as $n => $st)

            <tr>
                <td style="text-align: center;">{{++$n}}</td>
                <td style="text-align: center;">{{date('d-M-Y',strtotime($st->transaction_date))}}</td>
                <td style="text-align: center;">{{$st->name}}</td>
                <td style="text-align: center;">$ {{number_format($st->paid_amount,2)}}</td>
                <td style="text-align: center;">{{$st->remark}}</td>
                <td style="text-align: center;">{{$st->description}}</td>

                <td style="text-align: center;width:112px;">
                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit" title="Edit"></i></a>
                    <a href="{{ route('deleteStudentFee',$sf->student_fee_id) }}" class="btn btn-danger btn-xs" onclick = "return confirm('Are you sure, you want to delete this? The Transaction related to this will be deleted as well!')"><i class="fa fa-trash" title="Delete"></i></a>
                    <a href="{{ route ('StudentInvoicePrint', [$st->invoice_id])}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>