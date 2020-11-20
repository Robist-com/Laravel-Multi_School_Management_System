
 @if(auth()->user()->group == "Admin")
<div class="form-group">

        <select class="form-control" name="school_id" id="school_id">
          <option>Choose School</option>
          @foreach (auth()->user()->school->all() as $school)
          <option value="{{ $school->id }}"
          @if(isset($day)){{$day->school_id == $school->id ? 'selected' : ''}} @endif >
          {{$school->name}}</option>
          @endforeach
        </select>
      </div>
  @else
    <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
@endif
<div class="form-group">
    {!! Form::text('semester_name', null, ['class' => 'form-control text-capitalize','placeholder'=>'Enter Grade Name', 'id' => 'semester_name']) !!}
</div>

<!-- Semester Code Field -->
<div class="form-group">
    {!! Form::text('semester_code', null, ['class' => 'form-control','placeholder'=>'Enter Grade Code', 'id' => 'semester_code']) !!}
</div>

<!-- Semester Duration Field -->
<div class="form-group">
    {!! Form::text('semester_duration', null, ['class' => 'form-control', 'placeholder'=>'Enter Grade Duration']) !!}
</div>

<!-- Semester Description Field -->
<div class="form-group">
    {!! Form::textarea('semester_description', null, ['class' => 'form-control','cols' => 40 , 'rows' => 2, 'placeholder'=>'Enter Semester Description']) !!}
</div>

<div class="form-group">
    @if(isset($sems))
    {!! Form::hidden('status', 'off') !!}
  {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
  @else
  {!! Form::hidden('status', 'off') !!}
  {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
  @endif
  </div>
 
<!-- Submit Field -->
<div class="modal-footer">
@if(isset($semes))
  {!! Form::submit('save changes', ['class' => 'btn btn-dark btn-round']) !!}
  @else
  {!! Form::submit('save', ['class' => 'btn btn-dark btn-round']) !!}
  @endif
</div>

