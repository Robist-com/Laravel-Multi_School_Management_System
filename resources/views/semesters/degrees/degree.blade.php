

<div class="modal fade left" id="degree-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header-store">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-gear"></i> Level </h3>
        </div>
        <div class="modal-body">
  
          {{-- {!! Form::open(['url' => 'create/degree']) !!} --}}
          <form action="create/degree" method="post">
              @csrf
  <!-- Semester Name Field -->
  <div class="form-group">
    <select name="semester_id[]" id="semester_id" class="form-control select_2_single" multiple>
      {{-- <option value="" selected disabled>Select Grade</option> --}}
      @foreach ($semester as $item)
          <option value="{{ $item->id }}">{{ $item->semester_name }}</option>
      @endforeach
    </select>
  </div>
  
  <!-- Semester Code Field -->
  <div class="form-group">
      {!! Form::text('degree_name', null, ['class' => 'form-control','placeholder'=>'Enter Level']) !!}
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
  </div>
  {!! Form::close() !!}
  </div>
  </div>
