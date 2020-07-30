  <!-- //--------------------MODAL START HERE------------->
  <div class="modal fade left" id="day-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-ms  modal-right " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sun-o" aria-hidden="true"> Add New Day</i></h5>
      </div>
      <div class="modal-body">

        <!-- Name Field -->

        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Day Here']) !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-info">Update Student</button> -->
        {!! Form::submit('Create Days', ['class' => 'btn btn-success']) !!}
      </div>
    </div>
  </div>
  </div>