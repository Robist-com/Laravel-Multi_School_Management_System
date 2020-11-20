<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3>SHIFTS </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('shifts.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a>
        </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($shift))
                    <h2>Update shift</h2>
                    @else
                    <h2>Create shift</h2>
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
                    @if(isset($shift))
                    {!! Form::model($shift, ['route' => ['shifts.update', $shift->shift_id], 'method' => 'patch',
                    'class' => 'form-horizontal form-label-left' , 'autocomplete' => 'off']) !!}
                    @else
                    {!! Form::open(['route' => 'shifts.store', 'class' => 'form-horizontal form-label-left' ,
                    'autocomplete' => 'off']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">School <b class="error">*</b></label>
                            <select class="form-control bootstrap-select" name="school_id" id="school_id" required>
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($shift)){{$shift->school_id == $school->id ? 'selected' : ''}} @endif>
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
                            <div class="form-line">
                                <input type="text" name="shift" id="shift" class="form-control"
                                    placeholder="Enter shift" @if(isset($shift)) value="{{$shift->shift}}" @endif
                                    required>
                            </div>
                            <br>
                            <i class="fa fa-info-circle bg-blue"> </i><i> Please do not enter duplicate Shift!</i>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">Status <b class="error">*</b></label>
                            @if(isset($shift))
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="1" @if($shift->status == '1') selected @endif>
                                    Active </option>
                                <option value="0" @if($shift->status == '0') selected @endif>
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
                        @if(isset($shift))
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

                    <h2>Shift Table</h2>
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
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Created</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="column-title">Shift</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Created</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($shifts as $shift)
                                <tr class="even pointer column-title">

                                    <td class="">{!! $shift->shift !!}</td>
                                    <td>
                                        @if($shift->status == '1')
                                        <label for="" style="color:#26B99A"><i
                                                class="material-icons">check_circle</i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="material-icons">not_interested</i></label>
                                        @endif
                                    </td>

                                    <td>{!! date('d-M-Y', strtotime($shift->created_at )) !!}</td>

                                    <td colspan="3">
                                        {!! Form::open(['route' => ['shifts.destroy', $shift->shift_id], 'method' =>
                                        'delete', 'id' => 'delete_form']) !!}
                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a data-level_id="{{$shift->id}}" data-level="{{$shift->level}}"
                                                        data-level_description="{{$shift->level_description}}"
                                                        data-course_id="{{$shift->course['course_name']}}"
                                                        data-created_at="{{$shift->created_at}}"
                                                        data-updated_at="{{$shift->updated_at}}" data-toggle="modal"
                                                        data-target="#level-show">
                                                        <i class="glyphicon glyphicon-print"></i> print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a data-level_id="{{$shift->id}}" data-level="{{$shift->level}}"
                                                        data-level_description="{{$shift->level_description}}"
                                                        data-course_id="{{$shift->course['course_name']}}"
                                                        data-created_at="{{$shift->created_at}}"
                                                        data-updated_at="{{$shift->updated_at}}" data-toggle="modal"
                                                        data-target="#level-show">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('shifts.edit', [$shift->shift_id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {{$shift->shift}} ?"><i
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
    <div class="modal fade left" id="shift-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


@section('js')

<script type="text/javascript">
$(document).ready(function() {

    // {{--------------------------Level Side-------------------------}} 
    $('#level-edit').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)
        var level = button.data('level')
        var course_id = button.data('course_id')
        var level_description = button.data('level_description')
        var level_id = button.data('level_id')

        var modal = $(this)

        modal.find('.modal-title').text('EDIT LEVEL INFORMATION');
        modal.find('.modal-body #level').val(level);
        modal.find('.modal-body #course_id').val(course_id);
        modal.find('.modal-body #level_description').val(level_description);
        modal.find('.modal-body #level_id').val(level_id);
    });

    // {{--------------------------Level view Side-------------------------}} 
    $('#level-show').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)
        var level = button.data('level')
        var course_id = button.data('course_id')
        var level_description = button.data('level_description')
        var created_at = button.data('created_at')
        var updated_at = button.data('updated_at')
        var level_id = button.data('level_id')

        var modal = $(this)

        modal.find('.modal-title').text('VIEW LEVEL INFORMATION');
        modal.find('.modal-body #level').val(level);
        modal.find('.modal-body #course_id').val(course_id);
        modal.find('.modal-body #level_description').val(level_description);
        modal.find('.modal-body #created_at').val(created_at);
        modal.find('.modal-body #updated_at').val(updated_at);
        modal.find('.modal-body #level_id').val(level_id);
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