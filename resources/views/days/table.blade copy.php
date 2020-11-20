<style>
    input:read-only
    {
        border:none;
        border-color:transparent;
    }
</style>
@include('table_style')
<div class="table-responsive">
<div class="panel">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>
    <table class="table table-striped table-bordered table-hover" id="days-table">
        <thead>
            <tr>
                <th>Day's</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($days as $day)
            <tr>
                <td>{!! $day->name !!}</td>
                <td >
                <input type="checkbox" data-id="{{ $day->day_id }}" name="status" 
                class="js-switch" {{ $day->status == 1 ? 'checked' : '' }}>
                </td>
                <td>{!! date('d-M-Y', strtotime($day->created_at)) !!}</td>
                <td>
                    {!! Form::open(['route' => ['days.destroy', $day->day_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    <!-- -----------------------------------------------Days view button start here--------------------------------------------------- -->
                        <a data-toggle="modal" data-target="#day-view-modal" data-day="{{$day->name}}"
                           data-created_at="{{$day->created_at}}" data-updated_at="{{$day->updated_at}}" data-day_id="{{$day->day_id}}" 
                           class='btn btn-default btn-xs'> <i class="glyphicon glyphicon-eye-open"></i></a>
                        <!-- ---------------------------------------------------ends here----------------------------------------------------------------- -->
                        <a href="{!! route('days.edit', [$day->day_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- we gonna past it here  -->
<!-- soyou can write this code at your end okay -->
<!-- //---------------------MODAL START HERE----------------------- -->
<div class="modal fade left" id="day-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="day_id" id="day_id"> 
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- Year Field -->
            <div class="form-group">
                {!! Form::label('day', 'Day:') !!}
               <input type="text" name="day" id="day" readonly>
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
        {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!}
      </div>
    </div>
  </div>
  </div>
  </div>


  @section('scripts')

    <script>
    // {{-----------day view Side------------------}} 
$('#day-view-modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var day = button.data('day') //thats the input name and the id's okay so make sure yours be like the same at your end okay.
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var day_id = button.data('day_id') // this day_id is the hidden input id that we assigned in our form okay.

var modal = $(this)

modal.find('.modal-title').text('VIEW DAY INFORMATION');
modal.find('.modal-body #day').val(day);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #day_id').val(day_id);
});

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let dayId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('days/status/update') }}',
            data: {'status': status, 'day_id': dayId},
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

  <!-- so now we will use some style to hide our input border okay.  -->