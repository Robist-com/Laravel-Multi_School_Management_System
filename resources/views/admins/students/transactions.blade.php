
@extends('layouts.app')

@section('content')
<section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true">Report</i></h1>
<a  class="pull-left btn btn-danger" href="{{url('view/fee/collection')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

@include('table_style') 
<div class="table-responsive" id="show-student-paid">
    <table class="table table-boredred table-hover table-striped table-condesed" class="display" style="width:100%" id="fee_report">
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
            <th>
            <a class="btn btn-warning" href="{{route('StudentTransactionPrint', [$student_id->id])}}"><i class="fa fa-print"></i></a>
            </th>
        </tr>
        <tbody>
        @foreach($data as $key => $data)
        <tr>
        <td style="text-align:center;">{{$key+1}}</td>
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
</div>
</div>
</div>
</div>
@endsection
