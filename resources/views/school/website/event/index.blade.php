<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>EVENTS </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <a href="{{route('event.create')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a>
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($event))
                    <h2>Update event</h2>
                    @else
                    <h2>Create event</h2>
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
                    @if(isset($event))
                    {!! Form::model($event, ['url' => ['event/update', $event->id], 'method' => 'post', 'class' =>
                    'form-horizontal form-label-left']) !!}
                    <input type="hidden" name="event_id" id="event_id" value="{{$event->id}}">
                    @else

                    <form action="{{route('event.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @endif

                        @if(auth()->user()->group == "Admin")
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="" >School <b class="error">*</b></label>
                                <select required class="form-control bootstrap-select" name="school_id" id="school_id">
                                    <option>Choose School</option>
                                    @foreach (auth()->user()->school->all() as $school)
                                    <option value="{{ $school->id }}"
                                        @if(isset($event)){{$event->school_id == $school->id ? 'selected' : ''}} @endif>
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
                            <label for="" >Event Name <b class="error">*</b></label>
                                <input required type="text" name="name" id="name" class="form-control bootstrap-select"
                                    placeholder="Enter event" @if(isset($event)) value="{{$event->name}}" @endif>
                            </div>
                        </div>
                        <br>
                        <br>
                        <!-- <br> -->
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="" >Place <b class="error">*</b></label>
                                <input required type="text" name="place" id="place" class="form-control bootstrap-select"
                                    placeholder="Enter place" @if(isset($event)) value="{{$event->place}}" @endif>
                            </div>
                        </div>
                        <br>
                        <br>
                        <!-- <br> -->
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="" >Start Date <b class="error">*</b></label>
                                <input required type="text" name="start_date" id="start_date"
                                    class="form-control bootstrap-select" placeholder="Enter start date"
                                    @if(isset($event)) value="{{$event->start_date}}" @endif>
                            </div>
                        </div>
                        <br>
                        <br>
                        <!-- <br> -->
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="" >End Date <b class="error">*</b></label>
                                <input required type="text" name="end_date" id="end_date" class="form-control bootstrap-select"
                                    placeholder="Enter End Date" @if(isset($event)) value="{{$event->end_date}}" @endif>
                            </div>
                        </div>
                        <br>
                        <br>
                        <!-- <br> -->
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="" >Message <b class="error">*</b></label>
                                <textarea required name="body" id="body" row="5" class="form-control bootstrap-select"
                                    placeholder="Enter End Date"> @if(isset($event)) value="{{$event->body}}" @endif </textarea>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <!-- <br> -->

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="" >Image <b class="error">*</b></label>
                                <input type="file" name="event_image" id="event_image"
                                    class="form-control bootstrap-select" placeholder="Enter event" @if(isset($event))
                                    value="{{$event->banner_image}}" @endif>
                            </div>
                        </div>
                        <br>
                        <br>
                        <!-- <br> -->

                        <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="" >Status <b class="error">*</b></label>
                            @if(isset($level))
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="1" @if($level->status == 1) selected @endif>
                                    Active </option>
                                <option value="0" @if($level->status == 0) selected @endif>
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
                            @if(isset($event))
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
                    <h2>Events Table</h2>
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
                        <table class="table table-striped jambo_table js-exportable">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">event</th>
                                    <th class="column-title">Place</th>
                                    <th class="column-title">Start Date</th>
                                    <th class="column-title">End Date</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">image</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($events as $event)
                                <tr class="even pointer">
                                    <td>{!! $event->name !!}</td>
                                    <td>{!! $event->place !!}</td>
                                    <td>{!! $event->start_date !!}</td>
                                    <td>{!! $event->end_date !!}</td>
                                    <td>
                                        @if($event->status == 1)
                                        <label for="" style="color:#26B99A"><i
                                                class="material-icons">check_circle</i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="material-icons">not_interested</i></label>
                                        @endif
                                    </td>
                                    <td data-toggle="tooltip" data-placement="right" title="View Full detail">
                                        <img id="myImg" src="{{asset('school_images/event/' .$event->image)}}" alt=""
                                            width="15px" srcset="">
                                    </td>

                                    <td colspan="3">
                                        {!! Form::open(['route' => ['event.delete', $event->id], 'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a data-event_id="{{$event->id}}" data-event="{{$event->event}}"
                                                        data-event_description="{{$event->event_description}}"
                                                        data-course_id="{{$event->course['course_name']}}"
                                                        data-created_at="{{$event->created_at}}"
                                                        data-updated_at="{{$event->updated_at}}" data-toggle="modal"
                                                        data-target="#event-show">
                                                        <i class="glyphicon glyphicon-print"></i> print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a data-event_id="{{$event->id}}" data-event="{{$event->event}}"
                                                        data-event_description="{{$event->event_description}}"
                                                        data-course_id="{{$event->course['course_name']}}"
                                                        data-created_at="{{$event->created_at}}"
                                                        data-updated_at="{{$event->updated_at}}" data-toggle="modal"
                                                        data-target="#event-show">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('event.edit', [$event->id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                <a id="delete_link" href="#"
                                                    data-confirm= "Are you sure want to delete {{$event->event}} ?"><i
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
    <div class="modal fade left" id="event-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content" id="img01">
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
                        {!! Form::label('event', 'event:') !!}
                        <input type="text" name="event" id="event" readonly>
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', 'image:') !!}
                        <img src="" name="event_image" id="event_image" alt="" srcset="">
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

</div>

@section('js')

<script>
$('#start_date').datetimepicker({
    format: 'Y-m-d',
    timepicker: false
});

$('#end_date').datetimepicker({
    format: 'Y-m-d',
    timepicker: false
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



var modal = document.getElementById("event-view-modal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}






// {{-----------event view Side------------------}} 
$('#event-view-modal').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var event = button.data(
        'event') //thats the input name and the id's okay so make sure yours be like the same at your end okay.
    var event_image = button.data(
        'event_image') //thats the input name and the id's okay so make sure yours be like the same at your end okay.
    var created_at = button.data('created_at')
    var updated_at = button.data('updated_at')
    var day_id = button.data('day_id') // this day_id is the hidden input id that we assigned in our form okay.

    var modal = $(this)

    modal.find('.modal-title').text('VIEW event INFORMATION');
    modal.find('.modal-body #event').val(event);
    modal.find('.modal-body #event_image').val(event_image);
    modal.find('.modal-body #created_at').val(created_at);
    modal.find('.modal-body #updated_at').val(updated_at);
    modal.find('.modal-body #day_id').val(day_id);
});

// $(document).ready(function() {
//     $('.js-switch').change(function() {
//         let status = $(this).prop('checked') === true ? 1 : 0;
//         let dayId = $(this).data('id');
//         $.ajax({
//             type: "GET",
//             dataType: "json",
//             url: '{{ url('
//             days / status / update ') }}',
//             data: {
//                 'status': status,
//                 'day_id': dayId
//             },
//             success: function(data) {
//                 console.log(data.message);
//                 // success: function (data) {
//                 toastr.options.closeButton = true;
//                 toastr.options.closeMethod = 'fadeOut';
//                 toastr.options.closeDuration = 100;
//                 toastr.success(data.message);
//                 // }
//             }
//         });
//     });
// })
</script>
@endsection

<!-- so now we will use some style to hide our input border okay.  -->