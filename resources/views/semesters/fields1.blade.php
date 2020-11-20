@if(auth()->user()->group == "Admin")
<div class="form-group">

    <label for="">School <b class="error">*</b></label>
    <select class="form-control bootstrap-select" name="school_id" id="school_id">
        <option>Choose School</option>
        @foreach (auth()->user()->school->all() as $school)
        <option value="{{ $school->id }}" @if(isset($day)){{$day->school_id == $school->id ? 'selected' : ''}} @endif>
            {{$school->name}}</option>
        @endforeach
    </select>
</div>
@else
<input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
@endif
<div class="form-group">
    <div class="form-line">
    <label for="">Grade Name <b class="error">*</b></label>
        {!! Form::text('semester_name', null, ['class' => 'form-control text-capitalize ','placeholder'=>'Enter Grade Name', 'id' => 'semester_name',  'required'=>'required']) !!}
    </div>
</div>

<!-- Semester Code Field -->
<div class="form-group">
    <div class="form-line">
    <label for="">Grade Code <b class="error">*</b></label>
        {!! Form::text('semester_code', null, ['class' => 'form-control','placeholder'=>'Enter Grade Code', 'id' =>
        'semester_code', 'required' => 'required', 'readonly']) !!}
    </div>
</div>

<!-- Semester Duration Field -->
<div class="form-group">
    <div class="form-line">
    <label for="">Duration <b class="error">*</b></label>
        {!! Form::text('semester_duration', null, ['class' => 'form-control', 'placeholder'=>'Enter Grade Duration',
        'required'=>'required']) !!}
    </div>
</div>

<!-- Semester Description Field -->
<div class="form-group">

    <div class="form-line">
    <label for="">Description </label>
        {!! Form::textarea('semester_description', null, ['class' => 'form-control','cols' => 40 , 'rows' => 2,
        'placeholder'=>'Enter Semester Description']) !!}
    </div>
</div>

<div class="form-group">
    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
        <label for="">Status <b class="error">*</b></label>
        @if(isset($semes))
        <select class="form-control bootstrap-select" name="status" id="status">
            <option value="on" @if($semes->status == 'on') selected @endif>
                Active </option>
            <option value="off" @if($semes->status == 'off') selected @endif>
                In active </option>
        </select>
        @else
        <select class="form-control bootstrap-select" name="status" id="status" required>
            <option value="on"> Active </option>
            <option value="off"> In active </option>
        </select>
        @endif
    <!-- </div> -->
</div>


<!-- Submit Field -->
<div class="modal-footer">
    @if(isset($semes))
    {!! Form::submit('save changes', ['class' => 'btn btn-dark bg-teal']) !!}
    @else
    {!! Form::submit('save', ['class' => 'btn btn-dark bg-teal']) !!}
    @endif
</div>