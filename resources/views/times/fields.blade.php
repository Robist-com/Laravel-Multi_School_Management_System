<div class="modal fade" id="times-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-clock-o">Add New Time</span> </h4>
            </div>
            <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
            <div class="modal-body">

<!-- Time Field -->
    <select name="shift_id" id="shift_id" class="form-control select_2_single">
        <option value="" selected disabled>Select Shift</option>
        @foreach ($shifts as $shift)
        <option value="{{$shift->shift_id}}">{{$shift->shift}}</option>
        @endforeach
    </select>
    <br><br>
    {!! Form::text('time', null, ['class' => 'form-control', 'placeholder' => 'Enter Time Here']) !!}


</div>
<div class="modal-footer">
<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
 {!! Form::submit('Save', ['class' => 'btn btn-success btn-sm']) !!}
</div>
 {!! Form::close() !!}
 </div>
</div>
</div>
