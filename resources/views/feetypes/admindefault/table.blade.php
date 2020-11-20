<div class="page-title">
              <div class="title_left">
                <h2>MANAGE FEE TYPES</h2>
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
                  @if(isset($feetype))
                   <h2>Update Fee Type</h2>
                   @else
                   <h2>Create Fee Type</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('feetypes.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($feetype))
                  {!! Form::model($feetype, ['route' => ['feetypes.update', $feetype->id], 'method' => 'post', 'class' => 'form-horizontal form-label-left' , 'autocomplete' => 'off']) !!}
                  @else
                  {!! Form::open(['route' => 'feetypes.store', 'class' => 'form-horizontal form-label-left' , 'autocomplete' => 'off']) !!}
                  @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <select name="school_id" id="school_id" class="form-control" >
                          @foreach(auth()->user()->school->all(); as $school)  
                        <option value="{{$school->id}}" @if(isset($feetype)) @if($feetype->school_id === $school->id )selected @endif @endif>{{$school->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    </div> 
                    @else
                    <input type="hidden" name="school_id" id="school_id" class="form-control" placeholder="Enter Fee Type" value="{{auth()->user()->school->id}}">
                    @endif

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="fee_type" id="fee_type" class="form-control" placeholder="Enter Fee Type"  @if(isset($feetype)) value="{{$feetype->type}}" @endif>
                    </div>
                    </div> 

                    <div class="modal-footer">
                    @if(isset($feetype))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                   @endif
                    </div>
                   
                    {!! Form::close() !!}

                  </div>
                </div>
              </div>

              <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table Levels</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#level-add"><i class="fa fa-plus-circle" aria-hidden="true"> Add New Level</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">No</th>
                            <th class="column-title">Fee Type</th>
                            @if(auth()->user()->group == "Admin") 
                            <th class="column-title">School Name</th>
                            @endif
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($feetypes as $key => $feetype)
                        <tr class="even pointer">
                          
                          <td class="a-center1 ">
                            <input type="checkbox" class="flat" name="table_records">
                            </td>

                            <td class="">{!! $key+1 !!}</td>
                            <td class="">{!! $feetype->type !!}</td>
                            @if(auth()->user()->group == "Admin") 
                            <td>{!! $feetype->name !!}</td>
                            @endif
                                
                            <td colspan="3">
                            {!! Form::open(['route' => ['feetypes.delete', $feetype->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('feetypes.edit', [$feetype->id]) !!}" class='btn btn-default btn-xs'>
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
              </div>
            </div>


@section('scripts')

<script>
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