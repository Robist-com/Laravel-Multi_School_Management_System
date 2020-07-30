  <!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
  <div class="modal fade left" id="classroom-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-ms  modal-right " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"> Add New ClassRoom</i></h5>
      </div>
      <div class="modal-body">
       <div class="">
       {!! Form::text('classroom_name', null, ['class' => 'form-control','placeholder'=>'Enter ClassRoom']) !!}
       </div>
       <br>
       <div class="">
       {!! Form::text('classroom_code', null, ['class' => 'form-control','placeholder'=>'Enter Code']) !!}
       </div>
       <br>
       <div class="">
       {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>'Enter Description','rows' => '2']) !!}
       </div>
       <br>
        <!-- Status Field -->
        <div class=" col-sm-6">
                    <div class=" col-sm-1" name="status" id="status1">
                    <label class="container1">status
                    {!! Form::hidden('status', 0) !!}
                    {!! Form::checkbox('status', '1', null) !!}
                        <span class="checkmark"></span>
                    </label>
                    </div>   
                </div>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        {!! Form::submit('Create ClassRoom', ['class' => 'btn btn-success btn-sm']) !!}
      </div>
    </div>
  </div>
  </div>
  </div>



  