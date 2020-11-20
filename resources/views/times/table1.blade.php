<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3>TIMES </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('times.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a>
        </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($time))
                    <h2>Update time</h2>
                    @else
                    <h2>Create time</h2>
                    @endif

                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    @if(isset($time))
                    {!! Form::model($time, ['route' => ['times.update', $time->time_id], 'method' => 'patch', 'class' =>
                    'form-horizontal form-label-left', 'autocomplete' => 'off']) !!}
                    @else
                    {!! Form::open(['route' => 'times.store', 'class' => 'form-horizontal form-label-left',
                    'autocomplete' => 'off']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">School <b class="error">*</b></label>
                            <select class="form-control bootstrap-select" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($time)){{$time->school_id == $school->id ? 'selected' : ''}} @endif>
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
                            <label for="">Shift <b class="error">*</b></label>
                            <select name="shift_id" id="shift_id" class="form-control bootstrap-select" required>
                                <option value="" selected disabled>Select Shift</option>
                                @foreach ($shifts as $shift)
                                <option value="{{$shift->shift_id}}"
                                    @if(isset($time)){{$shift->shift_id == $time->shift_id ? 'selected' : ''}} @endif>
                                    {{$shift->shift}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <label for="">Start Time <b class="error">*</b></label>
                            <div class="form-line">
                                <input required type="text" name="time" id="time-start" class="form-control"
                                    placeholder="Enter Start" @if(isset($time)) value="{{$time->time}}" @endif>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <label for="">End Time <b class="error">*</b></label>
                            <div class="form-line">
                                <input required type="text" name="end_time" id="time-end" class="form-control"
                                    placeholder="Enter End" @if(isset($time)) value="{{$time->end_time}}" @endif>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">Status <b class="error">*</b></label>
                            @if(isset($time))
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="1" @if($time->status == '1') selected @endif>
                                    Active </option>
                                <option value="0" @if($time->status == '0') selected @endif>
                                    In active </option>
                            </select>
                            @else
                            <select class="form-control bootstrap-select" name="status" id="status" required>
                                <option value="1"> Active </option>
                                <option value="0"> In active </option>
                            </select>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if(isset($time))
                        {!! Form::submit('Save Changes', ['class' => 'btn bg-teal']) !!}
                        @else
                        <button type="submit" class="btn btn-round bg-teal" id="save-btn">Save</button>
                        @endif
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="header">

                    <h2>Times Table</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th class="column-title">Shift</th>
                                    <th class="column-title">Time</th>
                                    <th class="column-title">Status</th>
                                    <!-- <th class="column-title">Created</th> -->
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="column-title">Shift</th>
                                    <th class="column-title">Time</th>
                                    <th class="column-title">Status</th>
                                    <!-- <th class="column-title">Created</th> -->
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($times as $time)
                                <tr class="even pointer">

                                    <td class="">{!! $time->shift !!}</td>
                                    <td class="">{!! $time->time . ' <i class="material-icons">compare_arrows</i> ' . $time->end_time
                                        !!}</td>
                                    <td>
                                    @if($time->status == '1')
                                        <label for="" style="color:#26B99A"><i
                                                class="material-icons">check_circle</i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="material-icons">not_interested</i></label>
                                        @endif
                                    </td>

                                    <!-- <td>{!! date('d-M-Y', strtotime($time->created_at )) !!}</td> -->

                                    <td colspan="3">

                                        {!! Form::open(['route' => ['times.destroy', $time->time_id], 'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ACTION <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a data-time_id="{{$time->time_id}}" data-time="{{$time->time}}"
                                                        data-time_description="{{$time->time_description}}"
                                                        data-course_id="{{$time->course['course_name']}}"
                                                        data-created_at="{{$time->created_at}}"
                                                        data-updated_at="{{$time->updated_at}}" data-toggle="modal"
                                                        data-target="#time-show">
                                                        <i class="glyphicon glyphicon-print"></i> Print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a data-time_id="{{$time->time_id}}" data-time="{{$time->time}}"
                                                        data-time_description="{{$time->time_description}}"
                                                        data-course_id="{{$time->course['course_name']}}"
                                                        data-created_at="{{$time->created_at}}"
                                                        data-updated_at="{{$time->updated_at}}" data-toggle="modal"
                                                        data-target="#time-show">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('times.edit', [$time->time_id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {!! $time->time!!} and  {!! $time->end_time!!} ?"><i
                                                            class="material-icons">delete_forever</i> Delete</a>
                                                </li>

                                            </ul>
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
    <div class="modal fade left" id="time-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header-store">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i>
                    </h4>

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
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


@section('js')

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



$('document').ready(function() {
    $('#save-btn').hide();
    // alert(1)
    $('#shift_id').on('change', function() {
        var shift = $('#shift_id').val();
        // alert(shift)
        if (shift != '') {
            $('#save-btn').show();
        }
    })
});
// {{-----------time view Side------------------}}
$('#time-view-modal').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var time = button.data('time')
    var time = button.data('time')
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

var deleteLinks = document.querySelectorAll('#delete_link');

for (var i = 0; i < deleteLinks.length; i++) {
    deleteLinks[i].addEventListener('click', function(event) {
        event.preventDefault();

        var choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            document.getElementById("delete_form").submit(); //form id
        }
    });
}

// document.getElementById("delete_link").onclick = function() { // button id

//       document.getElementById("delete_form").submit(); //form id

// }

//  Exportable table
$('.js-exportable').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});
</script>
@endsection