<div class="page-title">
              <div class="title_left">
                <h2>MANAGE TIMES</h2>
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
                  @if(isset($time))
                   <h2>Update time</h2>
                   @else
                   <h2>Create time</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('times.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($time))
                  {!! Form::model($time, ['route' => ['times.update', $time->time_id], 'method' => 'patch', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'off']) !!}
                  @else
                  {!! Form::open(['route' => 'times.store', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'off']) !!}
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($time)){{$time->school_id == $school->id ? 'selected' : ''}} @endif >
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
                    <select name="shift_id" id="shift_id" class="form-control select_2_single">
                        <option value="" selected disabled>Select Shift</option>
                        @foreach ($shifts as $shift)
                        <option value="{{$shift->shift_id}}" @if(isset($time)){{$shift->shift_id == $time->shift_id ? 'selected' : ''}} @endif>{{$shift->shift}}</option>
                        @endforeach
                    </select>
                    </div>
                    </div> 

                    <div class="form-group row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <input type="text" name="time" id="time-start" class="form-control" placeholder="Enter Start"  @if(isset($time)) value="{{$time->time}}" @endif>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <input type="text" name="end_time" id="time-end" class="form-control" placeholder="Enter End"  @if(isset($time)) value="{{$time->end_time}}" @endif>
                    </div>
                    </div> 

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($level))
                      {!! Form::hidden('status', '0') !!}
                    {!! Form::checkbox('status', '1', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('status', '0') !!}
                    {!! Form::checkbox('status', '1', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div>
                 
                    <div class="modal-footer">
                    @if(isset($time))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark" id="save-btn">Save</button>
                   @endif
                    </div>
                   
                    {!! Form::close() !!}

                  </div>
                </div>
              </div>

              <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table time</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#times-show"><i class="fa fa-plus-circle" aria-hidden="true"> Add New time</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Shift</th>
                            <th class="column-title">time</th>
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
                        @foreach($times as $time)
                        <tr class="even pointer">
                          
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                            </td>

                            <td class="">{!! $time->shift !!}</td>
                            <td class="">{!! $time->time . ' <i class="fa fa-exchange"></i> ' . $time->end_time !!}</td>
                            <td>
                            @if($time->status == '1')
                                <label for="" style="color:#26B99A"><i class="fa fa-check-circle fa-lg"></i></i></label>
                            @else
                            <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                            @endif
                            </td>

                            <td>{!! date('d-M-Y', strtotime($time->created_at )) !!}</td>

                            <td colspan="3">
                            {!! Form::open(['route' => ['times.destroy', $time->time_id], 'method' => 'delete']) !!}
                                <div class='btn-group'>

                                
                                <a data-time_id="{{$time->time_id}}" data-time="{{$time->time}}" 
                                    data-time_description="{{$time->time_description}}" data-course_id="{{$time->course['course_name']}}"
                                    data-created_at="{{$time->created_at}}" data-updated_at="{{$time->updated_at}}"
                                    data-toggle="modal" data-target="#time-show" class='btn btn-default btn-xs'>
                                    <i class="glyphicon glyphicon-eye-open"></i></a>
                                
                                
                                    <a data-time_id="{{$time->time_id}}" data-time="{{$time->time}}" 
                                    data-time_description="{{$time->time_description}}" data-course_id="{{$time->course['course_name']}}"
                                    href="{!! route('times.edit', [$time->time_id]) !!}" class='btn btn-default btn-xs'>
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
<div class="modal fade left" id="time-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                {!! Form::label('time', 'Time:') !!}
               <input type="text" name="time" id="time" readonly>
            </div>

            <div class="form-group">
                {!! Form::label('time', 'time:') !!}
               <input type="text" name="time" id="time" readonly>
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


$('#time-start').datetimepicker({
  i18n: {
                de: {
                    months: [
                        'January', 'February', 'March', 'April',
                        'May', 'Jun', 'July', 'August',
                        'September', 'October', 'November', 'December',
                    ],
                    dayOfWeek: [
                        "Su", "Mon", "Tu", "Wed",
                        "Thu", "Fri", "Sa",
                    ]
                }
            },
            datepicker: false,
            format: 'H:m A'
        // format: 'hh:mm A'
    });

    $('#time-end').datetimepicker({
  i18n: {
                de: {
                    months: [
                        'January', 'February', 'March', 'April',
                        'May', 'Jun', 'July', 'August',
                        'September', 'October', 'November', 'December',
                    ],
                    dayOfWeek: [
                        "Su", "Mon", "Tu", "Wed",
                        "Thu", "Fri", "Sa",
                    ]
                }
            },
            datepicker: false,
            format: 'H:m A'
        // format: 'hh:mm A'
    });

    $('document').ready(function(){
     $('#save-btn').hide();
// alert(1)
     $('#shift_id').on('change', function(){
       var shift = $('#shift_id').val();
      // alert(shift)
      if (shift != '') {
        $('#save-btn').show();
      }
     })
    });
    // {{-----------time view Side------------------}}
$('#time-view-modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var time= button.data('time')
var time= button.data('time')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var time_id = button.data('time_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW TIME INFORMATION');
modal.find('.modal-body #time').val(time);
modal.find('.modal-body #time').val(time);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #time_id').val(time_id);
});

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let timeId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('time/status/update') }}',
            data: {'status': status, 'time_id': timeId},
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
