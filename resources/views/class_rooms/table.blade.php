@include('table_style')
<div class="table-responsive">
<div class="panel">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>
    <table class="table table-striped table-bordered table-hover" id="classRooms-table">
        <thead>
            <tr>
                <th>Classroom Name</th>
        <th>Classroom Code</th>
        <th> Description</th>
        <th> Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($classRooms as $classRoom)
            <tr>
                <td>{!! $classRoom->classroom_name !!}</td>
            <td class="badge">{!! $classRoom->classroom_code !!}</td>
            <td>{!! $classRoom->classroom_description !!}</td>
            <td >
                <input type="checkbox" data-id="{{ $classRoom->classroom_id }}" name="status" 
                class="js-switch" {{ $classRoom->classroom_status == 1 ? 'checked' : '' }}>
                </td>
                <td>
                    {!! Form::open(['route' => ['classRooms.destroy', $classRoom->classroom_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    <!-- INSIDE HERE WE NEED TO ADD SOME CODES OKAY TO ABLE TO FIND OUR DATAS BY THAT ATTRIBUTES OKAY. -->
                       <a href="http://" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                    <!-- ----------------------------------------------------------------------SHOW SIDE START HERE------------------------------------------------------------------------- -->
                        <!-- <a href="{!! route('classRooms.show', [$classRoom->classroom_id]) !!}" class='btn btn-default btn-xs'> -->
                       
                        <a data-toggle="modal" data-target="#classroom-view-modal" data-classroom_id="{{$classRoom->classroom_id}}"
                        data-classroom_name="{{$classRoom->classroom_name}}" data-classroom_code="{{$classRoom->classroom_description}}" 
                        data-status="{{$classRoom->status}}" data-created_at="{{$classRoom->created_at}}"
                        data-updated_at="{{$classRoom->updated_at}}" class='btn btn-warning btn-xs'> <i class="glyphicon glyphicon-eye-open"></i>
                        </a> 

<!-- WE DON'T NEED IT OKAY..  -->
                        <!-- ----------------------------------------------------------------SHOW SIDE END HERE---------------------------------------------- -->
                   
                   
                    <!-- ---------------------------------------------------------------------EDIT SIDE START HERE-------------------------------------------------------------------------- -->

                        <a href="{!! route('classRooms.edit', [$classRoom->classroom_id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                       
                    <!-- ----------------------------------------------------------------------EDIT SIDE END HERE------------------------------------------------------------------------- -->

                    <!-- ----------------------------------------------------------------------DELETE SIDE ------------------------------------------------------------------------- -->

                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- HERE I WILL ADDONE MODAL FOR THE VIEW OKAY..  -->
<!-- I ALREADY CREATED THAT JUST MAKE OUR TUTORIAL EASY OKAY. -->

<style>

input:read-only{
    border:none;
    border-color: transparent;
}
</style>


<!-- INSERT HERE I WILL ADD THE MODAL AND SOME SCRIP FILES OKAY SO  JUST FOLLOW EME STEP BY STEP. -->

<!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
<div class="modal fade left" id="classroom-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="classroom_id" id="classroom_id"> 
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- batch Field -->
            <div class="form-group">
                {!! Form::label('classroom_id', 'Class Room Id:') !!}
               <input type="text" name="classroom_id" id="classroom_id" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('classroom_name', 'Class Room Name:') !!}
               <input type="text" name="classroom_name" id="classroom_name" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('classroom_code', 'Class Room Code:') !!}
               <input type="text" name="classroom_code" id="classroom_code" readonly>
            </div>

             <!-- Status Field -->
             <div class="form-group">
                {!! Form::label('status', 'Status:') !!}
                <input type="text" name="status" id="status" readonly>
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

<!-- HERE WE HAVE SCRIT CODE BELOW OKAY-->
<!-- LET ME SHOW YOU THAT STEP BY STEP TO UNDERSTAND THE CONCEPT OKAY... -->

  @section('scripts')

    <script>
    // {{-----------Level view Side------------------}} 
$('#classroom-view-modal').on('show.bs.modal', function(event){ // THIS ID IS THE ID OF THE MODAL WHICH WILL HANDLE THE MODAL WHEN YOU CLCIK THE BUTTON VIEW OKAY.

var button = $(event.relatedTarget) // AS YOU KNOW WE HAVE BEEN USING THIS FUNCTION NOW SINCE OUR STARTING OF THIS PROJECT I HOPE YOU GUYS WILL HAVE CLEAR UNDERSTANDING OF IT NOW.
var classroom_name = button.data('classroom_name') //THIS BLUE COLOR LATERS ARE THE VARIABLE NAME AND THE RED COLOR LATTERS ARE THE ID OF THE INPUT OKAY.
var classroom_code = button.data('classroom_code')
var status = button.data('status')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var classroom_id = button.data('classroom_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW CLASSROOM INFORMATION');
modal.find('.modal-body #classroom_name').val(classroom_name);
modal.find('.modal-body #classroom_code').val(classroom_code);
modal.find('.modal-body #status').val(status);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #classroom_id').val(classroom_id);
});
    
    // this is just bootstrap simple code you can read the bootstrap modal.find okay.

    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let classroomId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('classrooms/status/update') }}',
            data: {'status': status, 'classroom_id': classroomId},
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
