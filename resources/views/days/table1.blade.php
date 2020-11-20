<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<h3>DAYS </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('days.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a>
        </div>

    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($day))
                    <h2>Update Day</h2>
                    @else
                    <h2>Create Day</h2>
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
                    @if(isset($day))
                    {!! Form::model($day, ['route' => ['days.update', $day->day_id], 'method' => 'patch', 'class' =>
                    'form-horizontal form-label-left']) !!}
                    @else
                    {!! Form::open(['route' => 'days.store', 'class' => 'form-horizontal form-label-left']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control bootstrap-select" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($day)){{$day->school_id == $school->id ? 'selected' : ''}} @endif>
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
                            <div class="form-line">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Day"
                                    @if(isset($day)) value="{{$day->name}}" @endif>
                            </div>
                            <br>
                            <i class="fa fa-info-circle bg-blue"> </i><i> Please do not enter duplicate Day!</i>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @if(isset($day))
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="1" @if($day->status == '1') selected @endif>
                                    Active </option>
                                <option value="0" @if($day->status == '0') selected @endif>
                                    In active </option>
                            </select>
                            @else
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="1"> Active </option>
                                <option value="0"> In active </option>
                            </select>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if(isset($day))
                        {!! Form::submit('Save Changes', ['class' => 'btn bg-teal']) !!}
                        @else
                        <button type="submit" class="btn btn-round bg-teal">Save</button>
                        @endif
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="header">

                    <h2>Days Table</h2>
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
                                    <th class="column-title">Day</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Created</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="column-title">Day</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Created</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($days as $day)
                                <tr class="even pointer">

                                    <td>{!! $day->name !!}</td>
                                    <td>
                                        @if($day->status == '1')
                                        <label for="" style="color:#26B99A"><i
                                                class="material-icons">check_circle</i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="material-icons">not_interested</i></label>
                                        @endif
                                    </td>
                                    <td>{!! date('d-M-Y', strtotime($day->created_at)) !!}</td>
                                    <td>

                                        {!! Form::open(['route' => ['days.destroy', $day->day_id], 'method' =>
                                        'delete']) !!}
                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a data-toggle="modal" data-target="#day-view-modal"
                                                        data-day="{{$day->name}}" data-created_at="{{$day->created_at}}"
                                                        data-updated_at="{{$day->updated_at}}"
                                                        data-day_id="{{$day->day_id}}">
                                                        <i class="glyphicon glyphicon-print"></i>
                                                        View
                                                    </a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a data-toggle="modal" data-target="#day-view-modal"
                                                        data-day="{{$day->name}}" data-created_at="{{$day->created_at}}"
                                                        data-updated_at="{{$day->updated_at}}"
                                                        data-day_id="{{$day->day_id}}">
                                                        <i class="glyphicon glyphicon-eye-open"></i>
                                                        View
                                                    </a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('days.edit', [$day->day_id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                        Edit
                                                    </a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a id="delete_link" href="#"
                                                    data-confirm= "Are you sure want to delete {{$day->name}} ?"><i
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





    <!-- we gonna past it here  -->
    <!-- soyou can write this code at your end okay -->
    <!-- //---------------------MODAL START HERE----------------------- -->
    <div class="modal fade left" id="day-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i>
                    </h5>
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
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!}
                </div>
            </div>
        </div>
    </div>
</div>



@section('js')

<script type="text/javascript">
$(document).ready(function() {

    // {{-----------day view Side------------------}} 
    $('#day-view-modal').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)
        var day = button.data(
                'day'
                ) //thats the input name and the id's okay so make sure yours be like the same at your end okay.
        var created_at = button.data('created_at')
        var updated_at = button.data('updated_at')
        var day_id = button.data(
            'day_id') // this day_id is the hidden input id that we assigned in our form okay.

        var modal = $(this)

        modal.find('.modal-title').text('VIEW DAY INFORMATION');
        modal.find('.modal-body #day').val(day);
        modal.find('.modal-body #created_at').val(created_at);
        modal.find('.modal-body #updated_at').val(updated_at);
        modal.find('.modal-body #day_id').val(day_id);
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
    //  Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


    $('#class_name').on('keyup', function() {

        var randomString = function(length) {

            var text = "";

            // var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            for (var i = 0; i < length; i++) {

                text += possible.charAt(Math.floor(Math.random() * possible.length));

            }

            return text;
        }

        // random string length
        var random = randomString(5);
        var class_name = $("#class_name").val();

        if (class_name !== '') {
            var elem = document.getElementById("class_code").value = random + '-' + class_name;
        } else {
            var elem = document.getElementById("class_code").value = '';
        }
        // alert(random)
        // insert random string to the field

    })

    // $('#class_code').attr('disabled', true);

});




// Via JavaScript
$(":file").filestyle();

// Via data attributes
</script>

@endsection



<!-- so now we will use some style to hide our input border okay.  -->