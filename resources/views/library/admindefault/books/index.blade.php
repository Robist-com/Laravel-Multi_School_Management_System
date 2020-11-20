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
                <h2>Add Book</h2>
                @elseif(isset($book_update))
                <h2>Update Book</h2>
                @else
                <h2>Book List</h2>
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
                      @if(isset($add_book))
                      <a href="{{route('book.index')}}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-sign-out" aria-hidden="true"> Return </i></button></a>
                      @else
                      <a href="{{route('book.add')}}"><button type="submit" class="btn btn-round btn-dark"><i class="fa fa-plus-circle" aria-hidden="true"> Add Book </i></button></a>
                      @endif 
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                @if(isset($add_book))
                  @if(isset($book))
                  {!! Form::model($book, ['route' => ['book.update', $book->id], 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @else
                  {!! Form::open(['route' => 'book.store', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($book)){{$book->school_id == $school->id ? 'selected' : ''}} @endif >
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
                    <label for="">Book Title <b style="color:red">*</b></label>
                        <input type="text" name="book_title" id="book_title" class="form-control"   @if(isset($book)) value="{{$book->book_title}}" @endif autocomplete="off">
                    </div>
                    <!-- </div> 

                    <div class="form-group"> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Book Number <b style="color:red">*</b></label>
                        <input type="text" name="book_number" id="book_number" class="form-control"   @if(isset($book)) value="{{$book->book_number}}" @endif autocomplete="off">
                    </div>
                    </div> 

                    <div class="form-group row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">ISBN Number<b style="color:red">*</b></label>
                        <input type="text" name="isbn_number" id="isbn_number" class="form-control"   @if(isset($book)) value="{{$book->isbn_number}}" @endif autocomplete="off">
                    </div>
                    <!-- </div> 

                    <div class="form-group"> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Publisher<b style="color:red">*</b></label>
                        <input type="text" name="publisher" id="publisher" class="form-control"   @if(isset($book)) value="{{$book->publisher}}" @endif autocomplete="off">
                    </div>
                    </div> 

                    <div class="form-group row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Author<b style="color:red">*</b></label>
                        <input type="text" name="author" id="author" class="form-control"   @if(isset($book)) value="{{$book->author}}" @endif autocomplete="off">
                    </div>
                    <!-- </div> 

                    <div class="form-group"> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Subject<b style="color:red">*</b></label>
                        <input type="text" name="subject" id="subject" class="form-control"   @if(isset($book)) value="{{$book->subject}}" @endif autocomplete="off">
                    </div>
                    </div> 

                    <div class="form-group row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Rac Number <b style="color:red">*</b></label>
                        <input type="text" name="rac_number" id="rac_number" class="form-control"   @if(isset($book)) value="{{$book->rac_number}}" @endif autocomplete="off">
                    </div>
                    <!-- </div>

                    <div class="form-group"> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Post Date <b style="color:red">*</b></label>
                        <input type="text" name="post_date" id="date" class="form-control"   @if(isset($book)) value="{{$book->post_date}}" @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Book Qty <b style="color:red">*</b></label>
                        <input type="number" name="book_qty" id="book_qty" class="form-control"   @if(isset($book)) value="{{$book->book_qty}}" @endif autocomplete="off">
                    </div>
                    <!-- </div>

                    <div class="form-group"> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Book Price <b style="color:red">*</b></label>
                        <input type="number" name="book_price" id="book_price" class="form-control"   @if(isset($book)) value="{{$book->book_price}}" @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for=""> Description </label>
                    {!! Form::textarea('description', null, ['class' => 'form-control border', 'cols' => 40, 'rows' =>2, ''=> ' Description', 'autocomplete' => 'off']) !!}
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($book))
                      {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div>
                 
                    <div class="modal-footer">
                    @if(isset($book))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                   @endif
                    </div>
                   
                    {!! Form::close() !!}
                    @endif
                  </div>
                  
                </div>
               
              </div>
             
              @if(isset($book_list))

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <!-- <div class="x_title">
                    <h2>Table Expense</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#expense-type"><i class="fa fa-plus-circle" aria-hidden="true"> Add New Type</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div> -->

                  <div class="x_content">
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr class="headings">
                           
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Title">Title</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Number">Number</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book ISBN Number">ISBN Num</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Publisher">Publisher</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Author">Author</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Subject">Subject</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Rack Number">Rack Num</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Total Quantity">Qty</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book In Stock">in Stock</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Price">price</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Added Date">Date</th>
                            <th class="column-title no-link last" data-toggle="tooltip" data-placement="top" title="Book Operations"><span class="nobr">Action</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($book_list as $book)
                        <tr class="even pointer">
                            <td class="">{!! $book->book_title !!}</td>
                            <td class="">{!! $book->book_number !!}</td>
                            <td class="">{!! $book->isbn_number !!}</td>
                            <td class="">{!! $book->publish !!}</td>
                            <td class="">{!! $book->author !!}</td>
                            <td class="">{!! $book->subject !!}</td>
                            <td class="">{!! $book->rac_number !!}</td>
                            <td class="">{!! $book->book_qty !!}</td>
                            <td class="">{!! $book->available !!}</td>
                            <td class="">{!! $book->book_price !!}</td>
                            <td class="">{!!date('d/m/Y', strtotime( $book->date)) !!}</td>

                            <td >
                            {!! Form::open(['route' => ['levels.destroy', $book->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                <a data-level_id="{{$book->id}}" data-level="{{$book->level}}" 
                                    data-level_description="{{$book->level_description}}" data-course_id="{{$book->course['course_name']}}"
                                    data-created_at="{{$book->created_at}}" data-updated_at="{{$book->updated_at}}"
                                    data-toggle="modal" data-target="#level-show" class='btn btn-default btn-xs'>
                                    <i class="glyphicon glyphicon-eye-open"></i></a>
                                
                                    <a data-level_id="{{$book->id}}" data-level="{{$book->level}}" 
                                    data-level_description="{{$book->level_description}}" data-course_id="{{$book->course['course_name']}}"
                                    href="{!! route('book.edit', [$book->id]) !!}" class='btn btn-default btn-xs'>
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
                @endif
            </div>
                


        <div class="modal fade" id="expense-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-head">Add New Expense Type</span> </h4>
            </div>
            <form action="{{route('expensestype.store')}}" method="POST" id="frm-level-create" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
            @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($book)){{$book->school_id == $school->id ? 'selected' : ''}} @endif >
                            {{$school->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @else
                      <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                  @endif
<!-- Level Field -->
                <div class="form-group">
                    <label for="">Expense Type <b style="color:red">*</b></label>
                    {!! Form::text('type', null, ['class' => 'form-control', '' => 'Enter Expense Type']) !!}
                </div>
                <!-- Submit Field -->
                </div>
                <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                {!! Form::submit('Create Expense Type', ['class' => 'btn btn-success']) !!}
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
            <form action="{{route('levels.update','$book->id')}}" method="post"> 
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
$('#level-edit').on('show.bs.modal', function(event){

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



