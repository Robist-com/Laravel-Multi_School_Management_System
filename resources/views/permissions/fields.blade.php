
      <div class="modal-body">

        <!-- Name Field -->

        <!-- {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Role']) !!} -->
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Role"  @if(isset($role)) value="{{$role->name}}" @endif>

      </div>
      <div class="modal-footer">
      @if(!isset($role))
        {!! Form::submit('Create Permission', ['class' => 'btn btn-dark btn-round']) !!}
      @else
      {!! Form::submit('Update Permission', ['class' => 'btn btn-dark btn-round']) !!}
      @endif
      </div>
