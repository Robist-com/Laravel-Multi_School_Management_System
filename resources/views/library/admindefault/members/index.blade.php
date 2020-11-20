@extends('layouts.new-layouts.app')

@section('content')
    <div class="content">
    @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
       
            <div class="clearfix"></div>

            <div class="page-title">
              <div class="title_left">
                @if(isset($add_book))
                <h2>Add Member</h2>
                @elseif(isset($book_update))
                <h2>Update Book</h2>
                @else
                <h2>Member List</h2>
                @endif
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" ="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> -->
                      @if(isset($add_member))
                      <a href="{{route('librarymember.index')}}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-sign-out" aria-hidden="true"> Return </i></button></a>
                      @elseif(isset($book_issue_return))
                      <a href="{!! route('issuebook.detail', [$issue_book->roll_no]) !!}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-sign-out" aria-hidden="true"> Issue Book </i></button></a>
                      @elseif(isset($issue_book))
                      <a href="{{route('librarymember.index')}}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-plus-circle" aria-hidden="true"> Return List </i></button></a>
                      @else
                      <a href="{{route('librarymember.add')}}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-plus-circle" aria-hidden="true"> Add Member </i></button></a>
                      @endif 
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                @if(isset($add_member))
                  @if(isset($member))
                  {!! Form::model($member, ['route' => ['librarymember.update', $member->id], 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @else
                  {!! Form::open(['route' => 'librarymember.store', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($member)){{$member->school_id == $school->id ? 'selected' : ''}} @endif >
                            {{$school->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @else
                      <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                  @endif
                  
                    <div class="form-group row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Roll No<b style="color:red">*</b></label>
                        <input type="text" name="roll_no" id="roll_no" class="form-control"   @if(isset($member)) value="{{$member->roll_no}}" @endif autocomplete="off">
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Library Card No<b style="color:red">*</b></label>
                        <input type="text" name="library_card" id="library_card" class="form-control" value="{{rand(11111,99990 )}}"   @if(isset($member)) value="{{$member->library_card}}" @endif autocomplete="off">
                    </div>
                    </div> 

                    <div class="form-group row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Member Type <b style="color:red">*</b></label>
                    <select name="member_type" id="member_type" class="form-control">
                      <option value="student" >Student</option>
                      <option value="staff"> Staff</option>
                      <option value="other"> Other</option>
                    </select>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Join Date <b style="color:red">*</b></label>
                        <input type="text" name="join_date" id="date" class="form-control" value="{{date('Y-m-d')}}"  @if(isset($member)) value="{{$member->join_date}}" @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($member))
                      {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div>
                 
                    <div class="modal-footer">
                    @if(isset($member))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                   @endif
                    </div>
                   
                    {!! Form::close() !!}
                    @endif
                    

                    @if(isset($issue_book))
                  @if(isset($book_issue_return))
                  {!! Form::model($book_issue_return, ['route' => ['issuebook.update', $book_issue_return->id], 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @else
                  {!! Form::open(['route' => 'issuebook.store', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($member)){{$member->school_id == $school->id ? 'selected' : ''}} @endif >
                            {{$school->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @else
                      <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                  @endif
                    <div class="col-md-12">
                     <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" style="height:300px" src="{{asset('student_images/' .$issue_book->image)}}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h2 style="text-align:center; text-transform:capitalize">{!! $issue_book->first_name .' '. $issue_book->last_name !!}</h2>
                      <hr>
                      <ul class="list-unstyled user_data">
                      <li><i class="fa fa-link fa-lg user-profile-icon"></i>  <label for="">Roll Number </label> <label for="" class="label label-success">{{$issue_book->roll_no}}</label>
                        </li>
                        <hr>
                        <li>
                          <i class="fa fa-cc-amex user-profile-icon"> </i> <label for="">Library Card </label> <label for="" class="label label-success">{{$issue_book->library_card}}</label>
                        </li>
                        <hr>
                        <li>
                          <i class="fa fa-male fa-lg user-profile-icon"> </i> <label for="">Gender </label> <label for="" class="label label-success">@if($issue_book->gender = 0) Male @else Female @endif</label>
                        </li>
                        <hr>
                        <li>
                          <i class="fa fa-user fa-lg user-profile-icon"> </i> <label for="">Member Type </label> <label for="" class="label label-success">{{$issue_book->member_type}}</label>
                        </li>
                        <hr>
                        <li>
                          <i class="fa fa-phone-square fa-lg user-profile-icon"> </i> <label for="">Mobile Phone </label> <label for="" class="label label-success">{{$issue_book->phone}}</label>
                        </li>
                      </ul>

                      <br />

                      </div>
                
                  <div class="col-md-9">
                  <div class="x_panel">
                  @if(isset($book_issue_return))
                  <h2>Return Book</h2>
                  @else
                  <h2>Issue Book</h2>
                  @endif
                  <div class="x_title">
                  </div>
                  @if(!$book_issue_return)
                    <div class="form-group row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">Books <b style="color:red">*</b></label>
                    <select name="book_id" id="book_id" class="form-control">
                      <option value="0" selected>select</option>
                      @foreach(App\Books::where('school_id', auth()->user()->school_id)->get() as $book)
                      <option value="{{$book->id}}" >{{$book->book_title}}</option>
                      @endforeach
                    </select>
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">Return Date <b style="color:red">*</b></label>
                        <input type="text" name="due_return_date" id="date" class="form-control" value="{{date('Y-m-d')}}"  @if(isset($member)) value="{{$member->join_date}}" @endif autocomplete="off">
                        <input type="hidden" name="student_id" id="student_id" class="form-control" value="{{$issue_book->student_id}}"  @if(isset($member)) value="{{$member->join_date}}" @endif autocomplete="off">
                        <input type="hidden" name="issue_date" id="issue_date" class="form-control" value="{{date('Y-m-d')}}"  @if(isset($member)) value="{{$member->issue_date}}" @endif autocomplete="off">
                    </div>
                    </div>
                    @endif
                    @if(isset($book_issue_return))
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">Return Date <b style="color:red">*</b></label>
                    <input type="text" name="return_date" id="date" value="{{date('Y-m-d')}}" class="form-control">
                  </div>
                  </div>
                  @endif
                    <div class="pull-right">
                    @if(isset($book_issue_return))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                   @endif
                    </div>
                    </div>
                    </div>
                    </form>
                    <div class="col-md-9">
                  <div class="x_panel">
                  <h2>Books Issued</h2>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr class="headings">
                           
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Issued Book Title">Book</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Issued Book Number">Book no</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Issued Date">Issue D</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Issued Due Return Date">Due Return Date</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Return Date">Return Date</th>
                            
                          </tr>
                        </thead>
                          <?php $dateNow = date("d")+1;
                          
                          $timenow = [];
                          foreach ($issue_list as $key => $value) {
                            $timenow = $value->due_return_date;
                          }
                          $now = date('Y-m-d');
                          $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $now);
                          $end_date = \Carbon\Carbon::createFromFormat('Y-m-d',   $timenow);
                          $different_days = $start_date->diffInDays($end_date);
                          ?>
                        <tbody>
                        @foreach($issue_list as $member)
                        <tr class="even pointer">
                            <td class="">{!! $member->book_title!!}</td>
                            <td class="">{!! $member->book_number !!}</td>
                            <td class="">{!!date('d/m/Y', strtotime( $member->issue_date)) !!}</td>
                            <td class="">@if($member->return_date == '' && $now >=  $member->due_return_date) <label for="">@if($different_days == 0) please return the book @else you are Find {{$different_days}} @endif
                              </label> @else {!!date('d/m/Y', strtotime( $member->due_return_date)) !!} @endif</td>
                            <td class="" >@if($member->return_date == '') <a href="{!! route('issuebook.edit', [$member->issue_book_id]) !!}" > <i class="fa fa-reply fa-lg" data-toggle="tooltip" data-placement="top" title="Return Book"></i> @elseif($member->return_date > $member->due_return_date)  <label for="" data-toggle="modal" data-target="#return_book" class="label label-danger"  data-level_id="{{$member->student_id}}" data-email="{{$member->email}}"><b for="" data-toggle="tooltip" data-placement="top" title="SEND A MESSAGE">{!!date('d/m/Y', strtotime( $member->return_date)) !!}</b></label> @else  {!!date('d/m/Y', strtotime( $member->return_date)) !!} @endif</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    
                    </div>
                    </div>
                    </div>
                    {!! Form::close() !!}
                    @endif
                  </div>
                  
                </div>

                
               
              </div>
             
              @if(isset($member_list))

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr class="headings">
                           
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Roll Number">Roll N<s>o.</s></th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Member Full Name">Name</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Library Card Number">Library Card No.</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Member Type">Member Type</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Member Phone Number">Phone</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Member Status">Status</th>
                            <th class="column-title no-link last" data-toggle="tooltip" data-placement="top" title="Issue Book or Return Book"><span class="nobr">Issue / Return</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($member_list as $member)
                        <tr class="even pointer">
                            <td class="">{!!  $member->roll_no !!}</td>
                            <td class="">{!! $member->first_name .' '. $member->last_name !!}</td>
                            <td class="">{!! $member->library_card !!}</td>
                            <td class="">{!! $member->member_type !!}</td>
                            <td class="">{!! $member->phone !!}</td>
                            <td class="">@if($member->status == 'on') <label for="" class="label label-success">Active</label>@else <label for="" class="label label-danger">In Active</label> @endif</td>
                            <td >
                                <div class='btn-group'>
                                    <a data-level_id="{{$member->id}}" data-level="{{$member->level}}" 
                                    data-level_description="{{$member->level_description}}" data-course_id="{{$member->course['course_name']}}"
                                    href="{!! route('issuebook.detail', [$member->roll_no]) !!}" class='btn btn-default btn-xs'>
                                    <i class="fa fa-external-link-square"></i></a>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                @endif
            </div>
                


        <div class="modal fade" id="return_book" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-head">Send Email</span> </h4>
            </div>
            {!! Form::model(NULL, ['url' => ['issuebook.update'], 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                @csrf
            <div class="modal-body">
            @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($member)){{$member->school_id == $school->id ? 'selected' : ''}} @endif >
                            {{$school->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @else
                      <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                    @endif
<!-- Level Field -->
                <!-- <div class="form-group">
                    <label for="">Return Date <b style="color:red">*</b></label>
                    <input type="text" name="return_date" id="date" value="{{date('d-m-Y')}}" class="form-control">
                </div> -->
                <div class="form-group">
                <input type="text" name="email_user" id="email_user" class="form-control">
                </div>
                <div class="form-group">
                <textarea name="" id="" cols="10" rows="5" class="form-control"></textarea>
                </div>

                <!-- Submit Field -->
                </div>
                <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                {!! Form::submit('Return Book', ['class' => 'btn btn-success']) !!}
                </div>
                </form>
                </div>
                </div>
                </div>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="level-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-level-up">Add New Level</span> </h4>
            </div>
            <form action="{{route('levels.update','$member->id')}}" method="post"> 
            @csrf
            @method('PUT')
            <!-- <form action="{{route('levels.store')}}" method="POST" id="frm-level-create"> -->
            <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
            <div class="modal-body" style="background:#EEEEEE" >

<!-- Level Field -->
<div class="form-group">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::text('level', null, ['class' => 'form-control', '' => 'Enter Level Here','readonly']) !!}
</div>
<input type="hidden" id="level_id" name="level_id">
<!-- Course Id Field -->
<div class="form-group">
    {!! Form::label('course_id', 'Course Name:') !!}
    <input type="text" name="course_id" id="course_id" class="form-control"  readonly>
</div>
<!-- Level Description Field -->
<div class="form-group">
<label for="level_description">Level Description:</label>
<input type="text" class="form-control" name="level_description" id="level_description" readonly>
    <!-- {!! Form::text('level_description', null, ['class' => 'form-control', 'cols' => 40, 'rows' =>2, ''=> 'Level Description']) !!} -->
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <input type="text" class="form-control" name="created_at" id="created_at" readonly>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <input type="text" class="form-control" name="updated_at" id="updated_at" readonly>
</div>
<!-- Submit Field -->
</div>
<div class="modal-footer">
<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
 <!-- {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!} -->
</div>
</form>
 </div>
</div>
</div>
</div>
@endsection

@section('scripts')

<script>

   
$('#date').datetimepicker({
    format: 'YYYY-MM-DD'
});

// {{--------------------------Level Side-------------------------}} 
$('#return_book').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var level = button.data('level')
var course_id = button.data('course_id')
var level_description = button.data('level_description')
var level_id = button.data('level_id')
var email = button.data('email')

// $('#email_user').val(email);

var modal = $(this)

modal.find('.modal-title').text('Send Email');
modal.find('.modal-body #level').val(level);
modal.find('.modal-body #course_id').val(course_id);
modal.find('.modal-body #level_description').val(level_description);
modal.find('.modal-body #level_id').val(level_id);
modal.find('.modal-body #email_user').val(email);
});

// {{--------------------------Level view Side-------------------------}} 
$('#level-show').on('show.bs.modal', function(event){

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

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 'on' : 'off';
        let levelId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('level/status/update') }}',
            data: {'status': status, 'level_id': levelId},
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



