<div class="page-title">
              <div class="title_left">
                <h2>MANAGE CLASSROOM</h2>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  @if(isset($classRoom))
                   <h2>Update Class Room</h2>
                   @else
                   <h2>Create Class Room</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('classRooms.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($classRoom))
                  {!! Form::model($classRoom, ['route' => ['classRooms.update', $classRoom->classroom_id], 'method' => 'patch', 'class' => 'form-horizontal form-label-left']) !!}
                  @else
                  {!! Form::open(['route' => 'classRooms.store', 'class' => 'form-horizontal form-label-left']) !!}
                  @endif
                  
                   @if(auth()->user()->group == "Admin")
                   <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <select name="school_id" id="school_id" class="form-control">
                        <option value="">Select School</option>
                        @foreach(auth()->user()->school->all() as $school)
                        <option value="{{$school->id}}" @if(isset($classRoom)) @if($school->id === $classRoom->school_id) selected  @endif @endif>{{$school->name}}</option>
                        @endforeach
                      </select>
  
                    </div>
                    </div>
                   @else
                   <input type="hidden" name="school_id" id="school_id" class="form-control"   value="{{auth()->user()->school->id}}" >
                   @endif

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="classroom_name" id="classroom_name" class="form-control" placeholder="Enter ClassRoom Name"  @if(isset($classRoom)) value="{{$classRoom->classroom_name}}" @endif>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="classroom_code" readonly id="classroom_code" class="form-control" placeholder="Enter ClassRoom Code"  @if(isset($classRoom)) value="{{$classRoom->classroom_code}}" @endif>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea name="classroom_description" id="classroom_description" class="form-control" cols="30" rows="2" placeholder="Enter ClassRoom Description" > @if(isset($classRoom)) {{$classRoom->classroom_description}} @endif</textarea>
                    </div>
                    </div>
                
                    

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($classRoom))
                      {!! Form::hidden('classroom_status', '0') !!}
                    {!! Form::checkbox('classroom_status', '1', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('classroom_status', '0') !!}
                    {!! Form::checkbox('classroom_status', '1', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div>
                 
                    <div class="modal-footer">
                    @if(isset($classRoom))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                   @endif
                    </div>
                   
                    {!! Form::close() !!}

                  </div>
                </div>
              </div>

              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table ClassRoom </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#classroom-add-modal"><i class="fa fa-plus-circle" aria-hidden="true"> Add New ClassRoom</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">ClassRoom </th>
                            <th class="column-title">Code </th>
                            <th class="column-title">Description </th>
                            <th class="column-title">Status </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($classRooms as $classRoom)
                        <tr class="even pointer">
                          
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                          </td>
                            <td>{!! $classRoom->classroom_name !!}</td>
                        <td class="badge">{!! $classRoom->classroom_code !!}</td>
                        <td>{!! $classRoom->classroom_description !!}</td>
                        <td >
                            @if($classRoom->classroom_status == 1)
                            <label for="" style="color:#26B99A"><i class="fa fa-check-circle fa-lg"></i></i></label>
                            @else
                            <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                            @endif
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
							
						
                  </div>
                </div>
              </div>
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

    $('#classroom_name').on('keyup', function(){

var randomString = function(length) {

var text = "";

// var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
var possible = "ABCDE56789FGHIJKLMNOPQRSTUVWXYZ01234";

for(var i = 0; i < length; i++) {

  text += possible.charAt(Math.floor(Math.random() * possible.length));

}

return text;
}

// random string length
var random = randomString(3);
var class_name = $("#classroom_name").val();
  
if (class_name !== '') {
  var elem = document.getElementById("classroom_code").value = random +'-'+ class_name;
}else{
  var elem = document.getElementById("classroom_code").value = '';
}
  // alert(random)
// insert random string to the field

})

// $('#classroom_code').attr('disabled', true);


})  
  
    
    
    </script>




  @endsection
