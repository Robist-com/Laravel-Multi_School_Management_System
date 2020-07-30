<div class="modal fade left" id="semester-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-gear"></i> Grades </h3>
      </div>
      <div class="modal-body">

<!-- Semester Name Field -->
<div class="form-group">
    {!! Form::text('semester_name', null, ['class' => 'form-control','placeholder'=>'Enter Semester Name']) !!}
</div>

<!-- Semester Code Field -->
<div class="form-group">
    {!! Form::text('semester_code', null, ['class' => 'form-control','placeholder'=>'Enter Semester Code']) !!}
</div>

<!-- Semester Duration Field -->
<div class="form-group">
    {!! Form::text('semester_duration', null, ['class' => 'form-control', 'placeholder'=>'Enter Semester Duration']) !!}
</div>

<!-- Semester Description Field -->
<div class="form-group">
    {!! Form::textarea('semester_description', null, ['class' => 'form-control','cols' => 40 , 'rows' => 2, 'placeholder'=>'Enter Semester Description']) !!}
</div>

<!-- Submit Field -->
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  {!! Form::submit('Create Semester', ['class' => 'btn btn-success']) !!}
</div>
</div>
</div>
</div>


<!---------------------------------------------------- LEVEL MODAL --------------------------------------->

<div class="modal fade left" id="level-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-gear"></i> Level </h3>
      </div>
      <div class="modal-body">
  <form action="create/degree" method="post">
    @csrf
  <div class="form-group">
    <select name="semester_id" id="semester_id" class="form-control select_2_single1" multiple1>
      {{-- <option value="" selected disabled>Select Grade</option> --}}
      @foreach ($semester as $item)
          <option value="{{ $item->id }}">{{ $item->semester_name }}</option>
      @endforeach
    </select>
  </div>
 <!-- Semester Code Field -->
 <div class="form-group">
  <input type="text" name="degree_name" id="degree_name" class="form-control" placeholder="Enter Level">
      <!-- {!! Form::text('degree_name', null, ['class' => 'form-control','placeholder'=>'Enter Level']) !!} -->
  </div>
  
  <!-- Semester Description Field -->
  <div class="form-group">
      {!! Form::textarea('description', null, ['class' => 'form-control','cols' => 40 , 'rows' => 2, 'placeholder'=>'Enter Description']) !!}
  </div>

<!-- Submit Field -->
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!}
</div>
</form>
</div>
</div>
</div>
