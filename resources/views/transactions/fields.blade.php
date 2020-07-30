<!-- Student Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_id', 'Student Id:') !!}
    {!! Form::number('student_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Fee Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fee_id', 'Fee Id:') !!}
    {!! Form::number('fee_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Paid Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paid amount', 'Paid Amount:') !!}
    {!! Form::text('paid amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Remark Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('remark', 'Remark:') !!}
    {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}
</div>

<!-- Describtion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('describtion', 'Describtion:') !!}
    {!! Form::textarea('describtion', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Transaction Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transaction_date', 'Transaction Date:') !!}
    {!! Form::date('transaction_date', null, ['class' => 'form-control','id'=>'transaction_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#transaction_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false
        })
    </script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('transactions.index') !!}" class="btn btn-default">Cancel</a>
</div>
