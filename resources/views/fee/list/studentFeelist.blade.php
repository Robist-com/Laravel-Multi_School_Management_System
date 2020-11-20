
    <div class="table-responsive">
    <!-- <table style="border-collapse:collapse;" class="table-hover table-bordered" id="list-student-fee"> -->
    <table class="table table-striped jambo_table bulk_action" id="list-student-fee">
    <thead>
    <tr class="headings">
        <th>
            <input type="checkbox" id="check-all" class="flat">
        </th>
            <th style="text-align:center; color:#">N<sup>o</sup></th>
            <th style="text-align:center; color:#">Grade</th>
            <th style="text-align:center; color:#">Fee Type</th>
            <th style="text-align:center; color:#">Fee</th>
            <th style="text-align:center; color:#">Total Amount</th>
            <th style="text-align:center; color:#">Paid Amount</th>
            <th style="text-align:center; color:#">Balance</th>
            <th class="column-title no-link last"><span class="nobr">Action</span></th>
            <th class="bulk-actions" colspan="8">
                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
            </th>
            </tr>
    </thead>

    <tbody id="tbody-student-fee">

        {{------------Test-----------------}}
       {{-- {{$readStudentTransaction}} --}}
        @foreach($readStudentFee as $key => $sf)
        <tr class="even pointer" data-id="" id="sfeeId">
            <td class="a-center ">
            <input type="checkbox" class="flat" name="table_records">
            </td>
        <td style="text-align: center;">{{ $key+1}}</td>
        <td style="text-align: center;">{{ $sf->semester_name}}</td>
        <td style="text-align: center;">{{ $sf->fee_type}}</td>
        <td style="text-align: center;">$ {{number_format($sf->semester_fee,2)}}</td>
        <td style="text-align: center;">$ {{number_format($sf->semester_fee_amount,2)}}</td>
        {{-- <td style="text-align: center;">{{$sf->discount}}%</td> --}}
        <td style="text-align: center; ">
        $ {{ number_format($readStudentTransaction->where('student_fee_id',$sf->student_fee_id)->sum('paid_amount'),2)}}
        </td>
        <td style="text-align: center;color:red; font-weight:bold;">
        $ {{number_format($sf->semester_fee_amount - $readStudentTransaction->where('student_fee_id',$sf->student_fee_id)->sum('paid_amount'),2)}}
        </td>

        <td style="text-align: center; width:115px;">

            <a href="#" class="btn btn-success btn-xs btn-sfee-edit" data-id-update-student-fee="
            {{ $sf->s_fee_id}} " title="Edit">
                 <i class="fa fa-edit"></i>
            </a>
        <button type="button" class="btn btn-danger btn-xs btn-paid" data-toggle="modal"
        data-target="#update-payment-table"
        value="{{ $sf->semester_fee_amount - $readStudentTransaction->where('student_fee_id',$sf->student_fee_id)->sum('paid_amount')}}" data-id-paid="{{$sf->s_fee_id}}">
                    <i class="fa fa-usd" title="Complete"></i>
        </button>

         <button type="button" class="btn btn-primary btn-xs accordion-toggle"  data-toggle="collapse"
            data-target="#demo{{$key}}" title="Partial"><span class="fa fa-eye"></span></button>
        </td>

        </tr>
        <tr>
            <td colspan="9" class="hiddenrow">
                @include('fee.list.transactionList')
                {{-- @include('fee.update-payment') --}}

            </td>
        </tr>

        @endforeach
        {{---------------End Test---------------}}

    </tbody>
    </table>
    </div>
    </div>
    <!-- </div> -->
    <!-- <div class="panel-footer" style="height:40px;"></div>
</div> -->
