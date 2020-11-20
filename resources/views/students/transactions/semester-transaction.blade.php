
@if($studenttransaction)
@foreach ($student_grades as $n => $student_grade)
@foreach ($studenttransaction as $n => $transaction)
@if ($transaction->semester_fee_id == $student_grade->id)


<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{$student_grade->semester_name}}</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="card">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="card">
                            <h3 style="text-transform:uppercase; font-weight:bold; margin-left:30%;">
                            {{$student_grade->semester_name}} <b style="color:red">TRANSACTIONS</b>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <!-- <table class="bordered-table"> -->
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr class="bordered-tr">
                                <th class="bordered-th">#</th>
                                <th class="bordered-th">Transaction Date</th>
                                <th class="bordered-th">Cashier</th>
                                <th class="bordered-th">Balance ($)</th>
                                <th class="bordered-th">Paid Amount ($)</th>
                                <th class="bordered-th">Total ($)</th>
                                <th class="bordered-th">Remark</th>
                                <th class="bordered-th">Description</th>
                                <th class="bordered-th">Action</th>
                            </tr>
                        </thead>

                        <tbody>


                            <tr class="bordered-tr">
                                <td class="bordered-td" style="text-align: center;background-color:#34495E; color:#fff">
                                    {{++$n}}
                                </td>
                                <td class="bordered-td" style="text-align: center;">
                                    {{date('d-M-Y',strtotime($transaction->transaction_date))}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$transaction->name}}</td>
                                <td class="bordered-td" style="text-align: center; color:red;  font-weight:bold; cursor:pointer"><span class="fa fa-usd" data-toggle="tooltip" data-placement="left" title="Remaining Balance"></span>
                                    {{number_format($transaction->balance,2)}}</td>
                                <td class="bordered-td" style="text-align: center; font-weight:bold; cursor:pointer"><span class="fa fa-usd" data-toggle="tooltip" data-placement="left" title="Amount Paid"></span>
                                    {{number_format($transaction->paid_amount,2)}}</td>
                                    <td class="bordered-td" style="text-align: center; color:green; font-weight:bold; cursor:pointer"><span class="fa fa-usd" data-toggle="tooltip" data-placement="left" title="Total Fee Amount"></span>
                                    {{number_format($transaction->paid_amount + $transaction->balance,2)}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$transaction->remark}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$transaction->description}}</td>

                                <td style="text-align: center;width:112px;">
                                    <a href="{{ route ('StudentInvoicePrint', [$transaction->invoice_id])}}"
                                        target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print"
                                            title="Print"></i></a>
                                </td>
                        </tbody>
                    </table>
                </div>
            </div><br>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
    <!-- <h1>Hello</h1> -->
    </div>
</div>
<!-- /.box -->

@endif
@endforeach
@endforeach
@else
<tr class="bordered-tr">
    <td colspan="12" class=" bordered-td">
        <div class="alert alert-danger text-center" style="font-weight:bolder">
            No Transaction Found for {{$transaction->first_name}}
            {{$transaction->last_name}}
        </div>
    </td>
</tr>
@endif