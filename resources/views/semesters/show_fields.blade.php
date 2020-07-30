<!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
<div class="modal fade left" id="semester_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="semester_id" id="semester_id"> 
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- batch Field -->
            <div class="form-group">
                {!! Form::label('semester_id', 'Semester Id:') !!}
               <input type="text" name="semester_id" id="semester_id" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('semester name', 'Semester Name:') !!}
               <input type="text" name="semester_name" id="semester_name" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('semester code', 'Semester Code:') !!}
               <input type="text" name="semester_code" id="semester_code" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('semester duration', 'Semester Duration:') !!}
               <input type="text" name="semester_duration" id="semester_duration" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('semester description', 'Semester Description:') !!}
               <input type="text" name="semester_description" id="semester_description" readonly>
            </div>
            
            <!-- Created At Field -->
            <div class="form-group">
                {!! Form::label('created_at', 'Created At:') !!}
                <input type="text" name="created_at" id="created_at" readonly>
            </div>

            <!-- Updated At Field -->
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <input type="text" name="updated_at" id="updated_at" readonly>
            </div>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <!-- {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!} -->
      </div>
    </div>
  </div>
  </div>
  </div>
