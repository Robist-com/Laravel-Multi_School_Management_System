@include('table_style')
<div class="table-responsive">
<div class="panel">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>
    <table class="table table-striped table-bordered table-hover" id="academics-table">
        <thead>
            <tr>
                
                <th>Academic Year</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($academics as $academic)
            <tr>
            <td>{!! $academic->academic_year !!}</td>
            <td>
            <input type="checkbox" data-id="{{ $academic->academic_id }}" name="status" 
                class="js-switch" {{ $academic->status == 1 ? 'checked' : '' }}>
                </td>

                <td>{{ date('d-M-Y', strtotime($academic->created_at))}}</td>
                <td>
                    {!! Form::open(['route' => ['academics.destroy', $academic->academic_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                     <a href="http://" target="_blank" class="btn btn-default btn-xs" rel="noopener noreferrer"><i class="glyphicon glyphicon-print"></i></a>
                      <!-- --------------------------------------------------------------------------------- -->
                        <a data-toggle="modal" data-target="#academic-view-modal" data-academic_year="{!! $academic->academic_year !!}" data-academic_id="{!! $academic->academic_id !!}"
                        data-created_at="{!! $academic->created_at !!}" data-updated_at="{!! $academic->updated_at !!}"
                         class='btn btn-warning btn-xs'>
                        <i class="glyphicon glyphicon-eye-open"></i></a>

                        <!-- ---------------------------------------------------------------------------- -->
                        <a href="{!! route('academics.edit', [$academic->academic_id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- INSIDE HERE WE WILL ADD THE MODAL PART OKAY.... -->
<!-- I HAVE THE MODAL ALREADY SO I WILL COPY IT AND EXPLAIN OKAY. -->

<style>

input:read-only{
    border:none;
    border-color: transparent;
}
</style>


<!-- INSERT HERE I WILL ADD THE MODAL AND SOME SCRIP FILES OKAY SO  JUST FOLLOW EME STEP BY STEP. -->

<!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
<div class="modal fade left" id="academic-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="academic_id" id="academic_id"> 
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- batch Field -->
            <div class="form-group">
                {!! Form::label('academic_id', 'Academic Id:') !!}
               <input type="text" name="academic_id" id="academic_id" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('academic year', 'Academic Year:') !!}
               <input type="text" name="academic_year" id="academic_year" readonly>
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
        <!-- {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!} -->
      </div>
    </div>
  </div>
  </div>
  </div>


  @section('scripts')

    <script>
    // {{-----------Level view Side------------------}} 
$('#academic-view-modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var academic_year = button.data('academic_year')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var academic_id = button.data('academic_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW CLASSROOM INFORMATION');
modal.find('.modal-body #academic_year').val(academic_year);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #academic_id').val(academic_id);
});
    
    // this is just bootstrap simple code you can read the bootstrap modal.find okay.

     $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let academicId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('academics/status/update') }}',
            data: {'status': status, 'academic_id': academicId},
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