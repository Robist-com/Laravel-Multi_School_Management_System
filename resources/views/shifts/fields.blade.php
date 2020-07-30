
    <!-- //-----------------------MODAL START HERE--------------------- -->
    <div class="modal fade left" id="shift-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-ms  modal-right " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-shirtsinbulk" aria-hidden="true"> Shifts</i></h5>
      </div>
      <div class="modal-body">

        <!-- Shift Field -->

            {!! Form::text('shift', null, ['class' => 'form-control','placeholder'=>'Enter Shift']) !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        {!! Form::submit('Create Shift', ['class' => 'btn btn-success']) !!}
      </div>
    </div>
  </div>
  </div>

  