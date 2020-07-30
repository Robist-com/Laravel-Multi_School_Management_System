@include('table_style')
<style>

input:read-only{
    border:none;
    border-color: transparent;
}
</style>


<div class="table-responsive">
<div class="panel">
<h1 style="font-weight:bold"><i class="fa fa-user-o"></i> MANAGE BATCHES</h1>
<hr class="line">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>
    <table class="table table-striped table-bordered table-hover" id="batches-table">
        <thead>
            <tr>
                <th>Batch</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Created At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($batches as $batch)
            <tr>
                <td>{!! $batch->batch !!}</td>

                <td style="text-align:center">
                <input type="checkbox" data-id="{{ $batch->id }}" name="status" 
                class="js-switch" {{ $batch->status == 1 ? 'checked' : '' }}>
                </td>

                <td style="text-align:center">{!! date('d-M-Y', strtotime($batch->created_at)) !!}</td>

                <td>
                    {!! Form::open(['route' => ['batches.destroy', $batch->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    <a href="{!! url('print-batches-single', [$batch->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>

                    <!-- ---------------------------------------here is the batch view button code ---------------------------------------- -->
                        <a data-toggle="modal" data-target="#batch-view-modal" data-batch_id="{{$batch->id}}"
                        data-year="{{$batch->batch}}" data-created_at="{{$batch->created_at}}"
                        data-updated_at="{{$batch->updated_at}}"
                         class='btn btn-default btn-xs'>
                         <i class="glyphicon glyphicon-eye-open"></i></a>
                         <!-- -------------------------------------------------------------------- -->
                         <!-- now lets save and see the output -->
                        <a href="{!! route('batches.edit', [$batch->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- INSERT HERE I WILL ADD THE MODAL AND SOME SCRIP FILES OKAY SO  JUST FOLLOW EME STEP BY STEP. -->

<!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
<div class="modal fade left" id="batch-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="batch_id" id="batch_id"> 
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- batch Field -->
            <div class="form-group">
                {!! Form::label('batch', 'Batch:') !!}
               <input type="text" name="batch" id="batch" readonly>
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
    // {{-----------Level view Side------------------}} 
$('#batch-view-modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var year = button.data('year')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var batch_id = button.data('batch_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW BATCH INFORMATION');
modal.find('.modal-body #year').val(year);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #batch_id').val(batch_id);
});
    
    // this is just bootstrap simple code you can read the bootstrap modal.find okay.

    
    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let batchId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('batch/status/update') }}',
            data: {'status': status, 'batch_id': batchId},
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