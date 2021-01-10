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
                <h3>Add expense</h3>
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
                  @if(isset($expense))
                   <h2>Update expense</h2>
                   @else
                   <h2>Create expense</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('expenses.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($expense))
                  {!! Form::model($expense, ['route' => ['expenses.update', $expense->id], 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @else
                  {!! Form::open(['route' => 'expenses.store', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($expense)){{$expense->school_id == $school->id ? 'selected' : ''}} @endif >
                            {{$school->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @else
                      <input type="hidden" name="school_id" id="school_id" value="{{ auth()->user()->school_id}}">
                  @endif

                  <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="">expense Type <b style="color:red">*</b></label>
                    <select name="expense_type_id" id="expense_type_id" class="form-control select_2_single" id="select_2_single">
                    <option value="0" selected="true" disabled="true" style="margin-right:20px">Select expense Type</option>
                    @foreach($e_type as $key => $type)
                    <option value="{{$type->id}}" @if(isset($expense)) {{$type->id == $expense->expense_type_id ? 'selected' : ''}}  @endif>{{$type->type}}</option>
                    @endforeach
                    </select>
                    </div>
                    </div>
                 
                  
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">expense Name <b style="color:red">*</b></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"  @if(isset($expense)) value="{{$expense->name}}" @endif autocomplete="off">
                    </div>
                    </div> 

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">expense Invoice Number <b style="color:red">*</b></label>
                        <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="Enter Invoice Number"  @if(isset($expense)) value="{{$expense->invoice_number}}" @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">expense Date <b style="color:red">*</b></label>
                        <input type="text" name="date" id="date" class="form-control" placeholder="Enter Name"  @if(isset($expense)) value="{{$expense->date}}" @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">expense Amount <b style="color:red">*</b></label>
                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter Name"  @if(isset($expense)) value="{{$expense->amount}}" @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">expense Document <b style="color:red">*</b></label>
                        <input type="file" name="file_document" id="file" class="form-control" placeholder="Enter Name"  @if(isset($expense)) value="{{$expense->file}}" @endif autocomplete="off">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="">expense Description <b style="color:red">*</b></label>
                    {!! Form::textarea('description', null, ['class' => 'form-control border', 'cols' => 40, 'rows' =>2, 'placeholder'=> ' Description', 'autocomplete' => 'off']) !!}
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($expense))
                      {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div>
                 
                    <div class="modal-footer">
                    @if(isset($expense))
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
                    <h2>Table expense</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#expense-type"><i class="fa fa-plus-circle" aria-hidden="true"> Add New Type</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <!-- <div class="table-responsive"> -->
                      <!-- <table class="table table-striped jambo_table bulk_action"> -->
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Name</th>
                            <th class="column-title">Invoice Number</th>
                            <th class="column-title">date</th>
                            <th class="column-title">Type</th>
                            <th class="column-title">Amount</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($expenses as $expense)
                        <tr class="even pointer">
                          
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                            </td>

                            <td class="">{!! $expense->name !!}</td>
                            <td class="">{!! $expense->invoice_number !!}</td>
                            <td class="">{!!date('d/m/Y', strtotime( $expense->date)) !!}</td>
                                
                            <td>{!! $expense->type!!}</td>
                            <td class="">{!! $expense->amount !!}</td>

                            <!-- <td>
                                @if($expense->status == 'on')
                                <label for="" class="text-green">Yes</label>
                                @else
                                <label for="">No</label>
                                @endif
                            </td> -->

                            <td >
                            {!! Form::open(['route' => ['levels.destroy', $expense->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                <a data-level_id="{{$expense->id}}" data-level="{{$expense->level}}" 
                                    data-level_description="{{$expense->level_description}}" data-course_id="{{$expense->course['course_name']}}"
                                    data-created_at="{{$expense->created_at}}" data-updated_at="{{$expense->updated_at}}"
                                    data-toggle="modal" data-target="#level-show" class='btn btn-default btn-xs'>
                                    <i class="glyphicon glyphicon-eye-open"></i></a>
                                
                                    <!-- <a href="{!! route('levels.show', [$expense->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                                
                                    <a data-level_id="{{$expense->id}}" data-level="{{$expense->level}}" 
                                    data-level_description="{{$expense->level_description}}" data-course_id="{{$expense->course['course_name']}}"
                                    href="{!! route('expense.edit', [$expense->id]) !!}" class='btn btn-default btn-xs'>
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
              <!-- </div> -->
            </div>



        <div class="modal fade" id="expense-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-head">Add New expense Type</span> </h4>
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
                            @if(isset($expense)){{$expense->school_id == $school->id ? 'selected' : ''}} @endif >
                            {{$school->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @else
                      <input type="hidden" name="school_id" id="school_id" value="{{ auth()->user()->school_id}}">
                  @endif
<!-- Level Field -->
                <div class="form-group">
                    <label for="">Expense Type <b style="color:red">*</b></label>
                    {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Enter Expense Type']) !!}
                </div>
                <!-- Submit Field -->
                </div>
                <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                {!! Form::submit('Create expense Type', ['class' => 'btn btn-success']) !!}
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
            <form action="{{route('levels.update','$expense->id')}}" method="post"> 
            @csrf
            @method('PUT')
            <!-- <form action="{{route('levels.store')}}" method="POST" id="frm-level-create"> -->
            <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
            <div class="modal-body" style="background:#EEEEEE" >

<!-- Level Field -->
<div class="form-group">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::text('level', null, ['class' => 'form-control', 'placeholder' => 'Enter Level Here','readonly']) !!}
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
    <!-- {!! Form::text('level_description', null, ['class' => 'form-control', 'cols' => 40, 'rows' =>2, 'placeholder'=> 'Level Description']) !!} -->
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

