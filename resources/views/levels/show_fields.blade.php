<!-- Level Id Field -->
<div class="form-group">
    {!! Form::label('level_id', 'Level Id:') !!}
    <p>{!! $level->level_id !!}</p>
</div>

<!-- Level Field -->
<div class="form-group">
    {!! Form::label('level', 'Level:') !!}
    <p>{!! $level->level !!}</p>
</div>

<!-- Course Id Field -->
<div class="form-group">
    {!! Form::label('course_id', 'Course Id:') !!}
    <p>{!! $level->course['course_name'] !!}</p>
</div>

<!-- Level Description Field -->
<div class="form-group">
    {!! Form::label('level_description', 'Level Description:') !!}
    <p>{!! $level->level_description !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $level->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $level->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $level->updated_at !!}</p>
</div>

