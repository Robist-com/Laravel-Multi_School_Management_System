<!-- Course Id Field -->
<div class="form-group">
    {!! Form::label('course_id', 'Course Id:') !!}
    <p>{{ $fees->course_id }}</p>
</div>

<!-- Level Id Field -->
<div class="form-group">
    {!! Form::label('level_id', 'Level Id:') !!}
    <p>{{ $fees->level_id }}</p>
</div>

<!-- Semester Id Field -->
<div class="form-group">
    {!! Form::label('semester_id', 'Semester Id:') !!}
    <p>{{ $fees->semester_id }}</p>
</div>

<!-- Fee Structure Id Field -->
<div class="form-group">
    {!! Form::label('fee_structure_id', 'Fee Structure Id:') !!}
    <p>{{ $fees->fee_structure_id }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $fees->amount }}</p>
</div>

