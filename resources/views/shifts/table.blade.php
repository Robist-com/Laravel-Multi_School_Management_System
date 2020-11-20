<div class="page-title">
              <div class="title_left">
                <h2>MANAGE SHIFTS</h2>
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
                  @if(isset($shift))
                   <h2>Update shift</h2>
                   @else
                   <h2>Create shift</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('shifts.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($shift))
                  {!! Form::model($shift, ['route' => ['shifts.update', $shift->shift_id], 'method' => 'patch', 'class' => 'form-horizontal form-label-left' , 'autocomplete' => 'off']) !!}
                  @else
                  {!! Form::open(['route' => 'shifts.store', 'class' => 'form-horizontal form-label-left' , 'autocomplete' => 'off']) !!}
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($shift)){{$shift->school_id == $school->id ? 'selected' : ''}} @endif >
                            {{$school->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @else
                      <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                  @endif
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="shift" id="shift" class="form-control" placeholder="Enter shift"  @if(isset($shift)) value="{{$shift->shift}}" @endif>
                        <br>
                        <i class="fa fa-info-circle bg-blue"> </i><i> Please do not enter duplicate Shift name!</i>
                    </div>
                    </div> 

                   {{-- <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($shift))
                      {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div> --}}
                 
                    <div class="modal-footer">
                    @if(isset($shift))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                   @endif
                    </div>
                   
                    {!! Form::close() !!}

                  </div>
                </div>
              </div>

              <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table Shift</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#shift-show"><i class="fa fa-plus-circle" aria-hidden="true"> Add New shift</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead class="text-center">
                        <tr class="headings a-center">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">shift</th>
                            <th class="column-title">Status</th>
                            <th class="column-title">Created</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($shifts as $shift)
                        <tr class="even pointer column-title">
                          
                          <td class="a-center column-title">
                            <input type="checkbox" class="flat" name="table_records">
                            </td>

                            <td class="">{!! $shift->shift !!}</td>
                            <td>
                            @if($shift->is_current_batch == '1')
                                <label for="" style="color:#26B99A"><i class="fa fa-check-circle fa-lg"></i></i></label>
                            @else
                            <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                            @endif
                            </td>

                            <td>{!! date('d-M-Y', strtotime($shift->created_at )) !!}</td>

                            <td colspan="3">
                            {!! Form::open(['route' => ['shifts.destroy', $shift->shift_id], 'method' => 'delete']) !!}
                                <div class='btn-group'>

                                
                                <a data-shift_id="{{$shift->shift_id}}" data-shift="{{$shift->shift}}" 
                                    data-shift_description="{{$shift->shift_description}}" data-course_id="{{$shift->course['course_name']}}"
                                    data-created_at="{{$shift->created_at}}" data-updated_at="{{$shift->updated_at}}"
                                    data-toggle="modal" data-target="#shift-show" class='btn btn-default btn-xs'>
                                    <i class="glyphicon glyphicon-eye-open"></i></a>
                                
                                
                                    <a data-shift_id="{{$shift->shift_id}}" data-shift="{{$shift->shift}}" 
                                    data-shift_description="{{$shift->shift_description}}" data-course_id="{{$shift->course['course_name']}}"
                                    href="{!! route('shifts.edit', [$shift->shift_id]) !!}" class='btn btn-default btn-xs'>
                                    <i class="glyphicon glyphicon-edit"></i></a>
                                
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


<!-- /so now lets work on the button side -->

<!-- i will add the view modal here okay. -->

<!-- //---------------------MODAL START HERE----------------------- -->
<div class="modal fade left" id="shift-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="shift_id" id="shift_id">
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- Year Field -->
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
var shift= button.data('shift')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var shift_id = button.data('shift_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW SHIFT INFORMATION');
modal.find('.modal-body #shift').val(shift);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #shift_id').val(shift_id);
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
