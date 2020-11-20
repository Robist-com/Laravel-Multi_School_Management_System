@include('table_style')
<style>

input:read-only{
    border:none;
    border-color:transparent;
}
</style>


<div class="table-responsive">
<div class="panel">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>
    <table class="table table-striped table-bordered table-hover" id="shifts-table">
        <thead>
            <tr>
                <th>Shift</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($times as $time)
            <tr>
                <td>{!! $time->time !!}</td>
                <td>{!! $time->shift !!}</td>
                <td >
                <input type="checkbox" data-id="{{ $time->time_id }}" name="status"
                class="js-switch" {{ $time->status == 1 ? 'checked' : '' }}>
                </td>
                <td>{!! date('d-M-Y', strtotime($time->created_at )) !!}</td>
                <td>
                    {!! Form::open(['route' => ['times.destroy', $time->time_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>

                    <a href="{!! url('shift', [$time->time_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
<!-----------------------view button START HERE----------------------- -->

                        <a data-toggle="modal" data-target="#shift-view-modal"
                         data-shift_id="{{$time->time_id}}" data-time="{{$time->time}}"
                         data-shift="{{$time->shift}}"
                         data-created_at="{{$time->created_at}}" data-updated_at="{{$time->updated_at}}"
                          class='btn btn-warning btn-xs'>
                        <i class="glyphicon glyphicon-eye-open"></i></a>
<!-----------------------view button end HERE----------------------- -->

                        <a href="{!! route('times.edit', [$time->time_id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- /so now lets work on the button side -->

<!-- i will add the view modal here okay. -->

<!-- //---------------------MODAL START HERE----------------------- -->
<div class="modal fade left" id="shift-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
        
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h4>
          
      </div>
      <div class="modal-body">
      <input type="hidden" name="time_id" id="time_id">
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- Year Field -->
            <div class="form-group">
                {!! Form::label('shift', 'Time:') !!}
               <input type="text" name="time" id="time" readonly>
            </div>

            <div class="form-group">
                {!! Form::label('shift', 'Shift:') !!}
               <input type="text" name="shift" id="shift" readonly>
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
      </div>
    </div>
  </div>
  </div>
  </div>


  @section('scripts')

    <script>
    // {{-----------Shift view Side------------------}}
$('#shift-view-modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var time= button.data('time')
var shift= button.data('shift')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var time_id = button.data('time_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW TIME INFORMATION');
modal.find('.modal-body #time').val(time);
modal.find('.modal-body #shift').val(shift);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #time_id').val(time_id);
});

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let shiftId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('shift/status/update') }}',
            data: {'status': status, 'shift_id': shiftId},
            success: function (data) {
                console.log(data.message);
                // success: function (data) {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
// }
            }
        });
    });
})

</script>
  @endsection
