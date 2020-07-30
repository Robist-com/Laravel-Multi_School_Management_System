<!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
<div class="modal fade left" id="faculty-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-ms  modal-right " role="document">
      <div class="modal-content">
        <div class="modal-header-store">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-leanpub" aria-hidden="true"> Add New Student Group</i></h5>
        </div>
        <div class="modal-body">

<!-- Faculty Name Field -->

    {!! Form::text('faculty_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Group Name']) !!}

<br>
<!-- Faculty Code Field -->

    {!! Form::text('faculty_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Group Code']) !!}

<br>
<!-- Faculty Status Field -->
<div class="form-group col-sm-6 pull-left" style="margin-left:30px;" >
    {!! Form::label('faculty_status', 'Group Status:') !!}
    <label class="checkbox-inline" style="margin-left:30px;">
        {!! Form::hidden('faculty_status', 0) !!}
        {!! Form::checkbox('faculty_status', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  {!! Form::submit('Save Group', ['class' => 'btn btn-success']) !!}
</div>
</div>
</div>
</div>
