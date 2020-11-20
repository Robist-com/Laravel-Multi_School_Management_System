<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3>CLASS ROOM </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('classRooms.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a>
        </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($classRoom))
                    <h2>Update class Room</h2>
                    @else
                    <h2>Create class Room</h2>
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
                    @if(isset($classRoom))
                    {!! Form::model($classRoom, ['route' => ['classRooms.update', $classRoom->classroom_id], 'method' =>
                    'patch', 'class' => 'form-horizontal form-label-left']) !!}
                    @else
                    {!! Form::open(['route' => 'classRooms.store', 'class' => 'form-horizontal form-label-left']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="">School <b class="error">*</b></label>
                            <select name="school_id" id="school_id" class="form-control bootstrap-select">
                                <option value="">Select School</option>
                                @foreach(auth()->user()->school->all() as $school)
                                <option value="{{$school->id}}" @if(isset($classRoom)) @if($school->id ===
                                    $classRoom->school_id) selected @endif @endif>{{$school->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    @else
                    <input type="hidden" name="school_id" id="school_id" class="form-control"
                        value="{{auth()->user()->school->id}}">
                    @endif

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="">Room Name <b class="error">*</b></label>
                        <div class="form-line">
                            <input required type="text" name="classroom_name" id="classroom_name" class="form-control"
                                placeholder="Enter ClassRoom Name" @if(isset($classRoom))
                                value="{{$classRoom->classroom_name}}" @endif>
                        </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="">Code <b class="error">*</b></label>
                        <div class="form-line">
                            <input required type="text" name="classroom_code" readonly id="classroom_code" class="form-control"
                                placeholder="Enter ClassRoom Code" @if(isset($classRoom))
                                value="{{$classRoom->classroom_code}}" @endif>
                        </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="">Description </label>
                        <div class="form-line">
                            <textarea name="classroom_description" id="classroom_description" class="form-control"
                                cols="30" rows="2"
                                placeholder="Enter ClassRoom Description"> @if(isset($classRoom)) {{$classRoom->classroom_description}} @endif</textarea>
                        </div>
                        </div>
                    </div>



                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">Status <b class="error">*</b></label>
                            @if(isset($classroom_status))
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="1" @if($classroom_status->status == '1') selected @endif>
                                    Active </option>
                                <option value="0" @if($classroom_status->status == '0') selected @endif>
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
                        @if(isset($classRoom))
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

                    <h2>classRooms Table</h2>
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
                                    <th class="column-title">Class Room</th>
                                    <th class="column-title">Code </th>
                                    <th class="column-title">Description</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="column-title">Class Room</th>
                                    <th class="column-title">Code </th>
                                    <th class="column-title">Description</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($classRooms as $classRoom)
                                <tr class="even pointer">

                                    <td>{!! $classRoom->classroom_name !!}</td>
                                    <td class="badge">{!! $classRoom->classroom_code !!}</td>
                                    <td>{!! $classRoom->classroom_description !!}</td>
                                    <td>
                                        @if($classRoom->classroom_status == '1')
                                        <label for="" style="color:#26B99A"><i
                                                class="material-icons">check_circle</i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="material-icons">not_interested</i></label>
                                        @endif
                                    </td>

                                    <td colspan="3">

                                        {!! Form::open(['route' => ['classRooms.destroy', $classRoom->classroom_id],
                                        'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ACTION <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a data-classRoom_id="{{$classRoom->classroom_id}}"
                                                        data-classRoom="{{$classRoom->classRoom}}"
                                                        data-classRoom_description="{{$classRoom->classRoom_description}}"
                                                        data-course_id="{{$classRoom->course['course_name']}}"
                                                        data-created_at="{{$classRoom->created_at}}"
                                                        data-updated_at="{{$classRoom->updated_at}}" data-toggle="modal"
                                                        data-target="#classRoom-show">
                                                        <i class="glyphicon glyphicon-print"></i> Print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a data-classRoom_id="{{$classRoom->classroom_id}}"
                                                        data-classRoom="{{$classRoom->classRoom}}"
                                                        data-classRoom_description="{{$classRoom->classRoom_description}}"
                                                        data-course_id="{{$classRoom->course['course_name']}}"
                                                        data-created_at="{{$classRoom->created_at}}"
                                                        data-updated_at="{{$classRoom->updated_at}}" data-toggle="modal"
                                                        data-target="#classRoom-show">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('classRooms.edit', [$classRoom->classroom_id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {!! $classRoom->classroom_name !!} ?"><i
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

    <!-- HERE I WILL ADDONE MODAL FOR THE VIEW OKAY..  -->
    <!-- I ALREADY CREATED THAT JUST MAKE OUR TUTORIAL EASY OKAY. -->

    <style>
    input:read-only {
        border: none;
        border-color: transparent;
    }
    </style>


    <!-- INSERT HERE I WILL ADD THE MODAL AND SOME SCRIP FILES OKAY SO  JUST FOLLOW EME STEP BY STEP. -->

    <!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
    <div class="modal fade left" id="classroom-view-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&classRooms;</span>
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
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <!-- {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!} -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- HERE WE HAVE SCRIT CODE BELOW OKAY-->
<!-- LET ME SHOW YOU THAT STEP BY STEP TO UNDERSTAND THE CONCEPT OKAY... -->

@section('js')

<script>
// {{-----------Level view Side------------------}} 
$('#classroom-view-modal').on('show.bs.modal', function(
    event) { // THIS ID IS THE ID OF THE MODAL WHICH WILL HANDLE THE MODAL WHEN YOU CLCIK THE BUTTON VIEW OKAY.

    var button = $(event
            .relatedTarget
            ) // AS YOU KNOW WE HAVE BEEN USING THIS FUNCTION NOW SINCE OUR STARTING OF THIS PROJECT I HOPE YOU GUYS WILL HAVE CLEAR UNDERSTANDING OF IT NOW.
    var classroom_name = button.data(
            'classroom_name'
            ) //THIS BLUE COLOR LATERS ARE THE VARIABLE NAME AND THE RED COLOR LATTERS ARE THE ID OF THE INPUT OKAY.
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


    $('#classroom_name').on('keyup', function() {

        var randomString = function(length) {

            var text = "";

            // var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            var possible = "ABCDE56789FGHIJKLMNOPQRSTUVWXYZ01234";

            for (var i = 0; i < length; i++) {

                text += possible.charAt(Math.floor(Math.random() * possible.length));

            }

            return text;
        }

        // random string length
        var random = randomString(3);
        var class_name = $("#classroom_name").val();

        if (class_name !== '') {
            var elem = document.getElementById("classroom_code").value = random + '-' + class_name;
        } else {
            var elem = document.getElementById("classroom_code").value = '';
        }
        // alert(random)
        // insert random string to the field

    })

    // $('#classroom_code').attr('disabled', true);



</script>




@endsection