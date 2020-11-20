@extends('layouts.new-layouts.app')
@section('content')
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> -->



    <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Calendar <small>Click to add/edit events</small></h3>
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
          <div class="col-md-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Calendar Events <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  {{-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li> --}}
                  <div class="form-group">
                      {{-- <div class="col-md-6"></div> --}}
                  <li>
                    @can('isAdmin')
                    <a href="#" class="btn btn-sm btn-round btn-success" data-toggle="modal" data-target="#CalenderModalNew">Add events</a>
                     <a href="#" class="btn btn-sm btn-round btn-warning" data-toggle="modal" data-target="#CalenderModalEdit">Edit events</a>
                    <a href="#" class="btn btn-sm btn-round btn-danger" data-toggle="modal" data-target="#CalenderModalDelete">Delete events</a>
                    @endcan
                </i></a>
                  </li>
                </div>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
              <div class="response"></div>
              <div id='calendar'></div> 
               
  
              </div>
            </div>
          </div>
        </div>
      </div>


        <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
  
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
            </div>
            <div class="modal-body">
                    
              <div id="testmodal" style="padding: 5px 20px;">
                <form action="{{url('calendar/store')}}" method="post" class="form-horizontal calender">
                    @csrf

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Choose Code</label>
                        <div class="col-sm-9">
                          <input type="color" class="form-control" id="color" name="color" placeholder="Choose Code ">
                        </div>
                      </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="title" placeholder="Enter Event ">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" style="height:55px;" id="descr" name="description" placeholder="Enter Destription"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-4">
                  <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Start Date ">
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="end_date" name="end_date" placeholder="End  Date ">
                    </div>
                </div>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-round antoclose" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-dark btn-round antosubmit">Save Event</button>
            </div>
        </form>
          </div>
        </div>
      </div>
      <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
  
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
            </div>
            <div class="modal-body">
  
              <div id="testmodal2" style="padding: 5px 20px;">
                <form id="antoform2" class="form-horizontal calender" role="form">
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title2" name="title2">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                    </div>
                  </div>
  
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
            </div>
          </div>
        </div>
      </div>
  
      <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
      <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
      <!-- /calendar modal -->

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />


<script>
  $(document).ready(function () {
        //  alert(1)
        var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
 
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            events: SITEURL + "/event",
            displayEventTime: true,
            editable: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Event Title:');
                var venue = prompt('Venue:');
 
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                      alert(start)
                    $.ajax({
                        url: SITEURL + "/event/create",
                        data: 'title=' + title + '&start=' + start + '&end=' + end + '&venue=' + venue,
                        type: "POST",
                        success: function (data) {
                            displayMessage("Added Successfully");
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                    true
                            );
                }
                calendar.fullCalendar('unselect');
            },
             
            eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + '/event/update',
                            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                            type: "POST",
                            success: function (response) {
                                displayMessage("Updated Successfully");
                            }
                        });
                    },
            eventClick: function (event) {
                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/event/delete',
                        data: "&id=" + event.id,
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Deleted Successfully");
                            }
                        }
                    });
                }
            }
 
        });
  });
 
//   function displayMessage(message) {
//     $(".response").html("
// "+message+"
// ");
//     setInterval(function() { $(".success").fadeOut(); }, 1000);
//   }
</script>


@stop