@extends('layouts.new-layouts.app')

@section('content')
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="page-title">
              <div class="title_left">
                <h2>School Events</h2>
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
                  @if(isset($event))
                   <h2>Update event</h2>
                   @else
                   <h2>Create event</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('event.create')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($event))
                  {!! Form::model($event, ['url' => ['event/update', $event->id], 'method' => 'post', 'class' => 'form-horizontal form-label-left']) !!}
                  <input type="hidden" name="event_id" id="event_id" value="{{$event->id}}">
                  @else

                  <form action="{{route('event.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($event)){{$event->school_id == $school->id ? 'selected' : ''}} @endif >
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
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter event"  @if(isset($event)) value="{{$event->name}}" @endif>
                    </div>
                    </div>
                    <br>
                    <br>
                    <!-- <br> -->
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="place" id="place" class="form-control" placeholder="Enter place"  @if(isset($event)) value="{{$event->place}}" @endif>
                    </div>
                    </div>
                    <br>
                    <br>
                    <!-- <br> -->
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Enter start date"  @if(isset($event)) value="{{$event->start_date}}" @endif>
                    </div>
                    </div>
                    <br>
                    <br>
                    <!-- <br> -->
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Enter End Date"  @if(isset($event)) value="{{$event->end_date}}" @endif>
                    </div>
                    </div>
                    <br>
                    <br>
                    <!-- <br> -->
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <textarea  name="body" id="body" row="5" class="form-control" placeholder="Enter End Date"  > @if(isset($event)) value="{{$event->body}}" @endif </textarea>
                    </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <!-- <br> -->
                    
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="file" name="event_image" id="event_image" class="form-control" placeholder="Enter event"  @if(isset($event)) value="{{$event->banner_image}}" @endif>
                    </div>
                    </div>
                    <br>
                    <br>
                    <!-- <br> -->

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($event))
                      {!! Form::hidden('status', '0') !!}
                    {!! Form::checkbox('status', '1', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('status', '0') !!}
                    {!! Form::checkbox('status', '1', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div>
                 
                    <div class="modal-footer">
                    @if(isset($event))
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
                    <h2>Table event </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#event-add-modal"><i class="fa fa-plus-circle" aria-hidden="true"> Add New event</i></a>
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
                            <th class="column-title">event</th>
                            <th class="column-title">Place</th>
                            <th class="column-title">Start Date</th>
                            <th class="column-title">End Date</th>
                            <th class="column-title">Status</th>
                            <th class="column-title">image</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($events as $event)
                        <tr class="even pointer">
                          
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                          </td>
                            <td>{!! $event->name !!}</td>
                            <td>{!! $event->place !!}</td>
                            <td>{!! $event->start_date !!}</td>
                            <td>{!! $event->end_date !!}</td>
                            <td >
                            @if($event->status == 1)
                            <label for="" class="text-green">Active</label>
                            @else
                            <label for="">In active</label>
                            @endif
                            </td>
                            <td data-toggle="tooltip" data-placement="right" title="View Full detail">
                            <img id="myImg" src="{{asset('school_images/event/' .$event->image)}}" alt="" width="15px" srcset="">
                            </td>
                            <!-- <td>{!! date('d-M-Y', strtotime($event->created_at)) !!}</td> -->
                            <td>
                            {!! Form::open(['route' => ['event.delete', $event->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                            <!-- -----------------------------------------------Days view button start here--------------------------------------------------- -->
                                <a data-toggle="modal" data-target="#event-view-modal" data-event="{{$event->name}}" data-image="<img src='{{asset('school_images/event/' .$event->image)}}' alt='' width='15px' srcset=''>"
                                data-created_at="{{$event->created_at}}" data-updated_at="{{$event->updated_at}}" data-day_id="{{$event->id}}" 
                                class='btn btn-default btn-xs'> <i class="glyphicon glyphicon-eye-open"></i></a>
                                <!-- ---------------------------------------------------ends here----------------------------------------------------------------- -->
                                <a href="{!! route('event.edit', [$event->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
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



<!-- we gonna past it here  -->
<!-- soyou can write this code at your end okay -->
<!-- //---------------------MODAL START HERE----------------------- -->
<div class="modal fade left" id="event-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content"  id="img01">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
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
        <button  type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!}
      </div>
    </div>
  </div>
  </div>
  </div>

  </div>
  @endsection
  @section('scripts')

    <script>


       
$('#start_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#end_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });


    var modal = document.getElementById("event-view-modal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
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
$('#event-view-modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var event = button.data('event') //thats the input name and the id's okay so make sure yours be like the same at your end okay.
var event_image = button.data('event_image') //thats the input name and the id's okay so make sure yours be like the same at your end okay.
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

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let dayId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('days/status/update') }}',
            data: {'status': status, 'day_id': dayId},
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

  <!-- so now we will use some style to hide our input border okay.  -->
          





