<!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
<div class="modal fade left" id="class-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-ms  modal-right " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-leanpub" aria-hidden="true"> Add New Class</i></h5>
      </div> 
      <div class="modal-body">

        <select name="department_id" id="department_id" class="form-control select_2_single">
          <option value="" selected disabled>Select Department</option>
          @foreach ($departments as $department)
        <option value="{{ $department->department_id }}">{{$department->department_name}}</option>
          @endforeach
        </select>
        <br><br>
          {!! Form::text('class_name', null, ['class' => 'form-control','placeholder'=>'Enter Class Name']) !!} 
      
     <br>
      {!! Form::text('class_code', null, ['class' => 'form-control','placeholder'=>'Enter Class Code']) !!}
      <br>    
           <!-- Status Field -->
    <div class="form-group col-sm-1" name="status" id="status1">
    <label class="container1">status
      <input type="checkbox" checked="checked1" name="status">
      <span class="checkmark"></span>
    </label>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        {!! Form::submit('Save Class', ['class' => 'btn btn-success']) !!}
      </div>
    </div>
  </div>
  </div>
 