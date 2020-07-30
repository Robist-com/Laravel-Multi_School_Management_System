<!-- Semester Id Field -->
<div class="form-group">
    {!! Form::label('semester_id', 'Semester Id:') !!}
    <p>{{ $feeStructure->semester_id }}</p>
</div>

<!-- Admissionfee Field -->
<div class="form-group">
    {!! Form::label('admissionFee', 'Admissionfee:') !!}
    <p>{{ $feeStructure->admissionFee }}</p>
</div>

<!-- Monthlyfee Field -->
<div class="form-group">
    {!! Form::label('monthlyFee', 'Monthlyfee:') !!}
    <p>{{ $feeStructure->monthlyFee }}</p>
</div>

<!-- Coursefee Field -->
<div class="form-group">
    {!! Form::label('courseFee', 'Coursefee:') !!}
    <p>{{ $feeStructure->courseFee }}</p>
</div>

<!-- Securitydeporcite Field -->
<div class="form-group">
    {!! Form::label('securityDeporcite', 'Securitydeporcite:') !!}
    <p>{{ $feeStructure->securityDeporcite }}</p>
</div>

<!-- Miscellaneous Charges Field -->
<div class="form-group">
    {!! Form::label('miscellaneous_charges', 'Miscellaneous Charges:') !!}
    <p>{{ $feeStructure->miscellaneous_charges }}</p>
</div>

