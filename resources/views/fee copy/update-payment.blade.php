<div class="modal fade" id="update-payment-table" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header-store">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel">Update {{ $student->last_name }} Payment</h4>
                </div>
            <div class="modal-body">
            <table style="margin-top: -12px;" id="">
                <caption class="academicDetail" style="font-size:100%" >
                        <td colspan="12" class="hiddenrow">
                @include('fee.detail')
            </td>
        </caption>
            <thead>
            <tr>
        <th>Semester</th> 
        <th>Admission Fee($)</th>
        <th>Semester Fee($)</th>
        <th>Total Fee Amount</th>
        <th>Paid Amount($)</th>
        <th>Balance Amount($)</th>
            </tr>
            </thead>
            <form action="{{ route('exstraPay')}}" method="POST" id="frmPayment">
        @foreach($data as $key => $semes)
    <tr>
    <td>
    <input type="text" class="form-control" value="{{$semes->semester_name}}" readonly>
    </td>     
    <td>
    <input type="text" class="form-control" value="{{$semes->admissionFee}}" id="admissionFee" readonly="">
    </td> 
    <td>
    <input type="text" class="form-control" value="{{$semes->semesterFee}}" id="semesterFee" readonly="">
    </td>       
    <td>
    <input type="text" class="form-control" name="amount" value="" id="totalFee" readonly="">
    </td>  
    <input type="hidden" name="semester_id1" id="semester_id1" class="form-control" value="{{$semes->semester_name}}">         
    <input type="hidden" name="department_id1" id="department_id1" class="form-control" value="{{$semes->department_name}}">
    <input type="hidden" name="level_id1" id="level_id1" class="form-control" value="{{$semes->level}}">
         
    <input type="hidden" name="fee_id" value="{{$semes->fee_structure_id}}" id="FeeID">
    <input type="hidden" name="student_id" value="{{$semes->student_id }}" id="StudentID">
    <input type="hidden" name="level_id" value="{{$semes->degree_id }}" id="LevelID">
    {{-- <input type="text" name="level_name" value="{{$semes->level or null}}" id="LevelID"> --}}
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="UserID">
    <input type="hidden" name="transact_date" value="{{ date('Y-m-d-H:i:s')}}" id="TransacDate">
    <input type="hidden" name="student_fee_id" id="student_fee_id">

    <td>
    <input type="text" class="form-control" name="paid_amount" id="Paid">
    </td>

    <td>
    <input type="text" class="form-control" name="balance" id="balance" readonly>
    </td>
    </tr>

    <thead>
    <tr>
    <th colspan="2">Remark</th>
    <th colspan="5">Description</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td colspan="2">
    <input type="text" name="remark" class="form-control" id="remark">
     </td>
    <td colspan="5">
    <input type="text" name="description" class="form-control" id="description">
     </td>
    </tr>
    </tbody>
     </div>
     </div>
    @endforeach
    </table>
</div>
<div class="modal-footer">
    <center>
    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-refresh"> </i> Update {{ $student->last_name }} Payment</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">I've heard enough about {{ $student->last_name }}</button>
    </center>
</div>
</div>
</div>