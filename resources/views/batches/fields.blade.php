  <!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
  <div class="modal fade left" id="batch-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-ms  modal-right " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"> Add New Batch</i></h5>
      </div>
      <div class="modal-body">
      <!-- ITS THE MODAL BOOTSTRAP MODAL THAT WE IMPLIMENT BEFORE WITH OUR LEVEL AND COURSE INSERT OKAY..  -->
      <!-- YOU CAN WRITE THE CODE AT YOUR END OKAY. -->
      <!-- <div class="form-group col-md-12"> -->
    {!! Form::text('batch', null, ['class' => 'form-control','placeholder'=>'Enter Batch Year']) !!}
    <!-- </div> -->
     <!-- <div class="col-md-3"> -->

    <br>
     <div class="form-group" name="is_current_batch">
                    <label class="checkbox-inline">
                    {!! Form::hidden('is_current_batch', '0') !!}
                    {!! Form::checkbox('is_current_batch', '1', null) !!} Is Current Batch
                    </label>
                    </div>
     <!-- Status Field -->
     <!-- <div class=" col-sm-6">
                    <div class=" col-sm-1" name="status" id="status1">
                    <label class="container12">Is Current Batch
                    {!! Form::hidden('is_current_batch', 0) !!}
                    {!! Form::checkbox('is_current_batch', '1', null) !!}
                        <span class="checkmark"></span>
                    </label>
                    </div>   
                </div> -->

      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!}
      </div>
    </div>
  </div>
  </div>
  </div>



  