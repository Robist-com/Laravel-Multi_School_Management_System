<div class="page-title">
              <div class="title_left">
                <h2>MANAGE SCHOOL</h2>
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

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>School</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round" href="{{ url()->previous() }}"><i class="fa fa-back-circle" aria-hidden="true"> Back</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    @isset($school)
                        @include('school.admindefault.edit')
                    @endisset

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action text-left" style="text-align: center !important">
                        <thead>
                        <tr class="headings " >
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Name</th>
                            <th class="column-title">Email</th>
                            <th class="column-title">Owner</th>
                            <th class="column-title">Status</th>
                            {{-- <th class="column-title">Description</th> --}}
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($schools as $key => $school)
                        <tr class="even pointer">
                          
                          <td class="a-center1" width="3%">
                            <input type="checkbox" class="flat" name="table_records">
                            </td>

                            @if(auth()->user()->group == "Admin") 
                            <td style="text-align: left">{!! $school->name !!}</td>
                            @else
                            <td style="text-align: left">{!! $school->name !!}</td>
                            @endif
                            <td style="text-align: left">{!! $school->email !!}</td>
                            <td style="text-align: left">{!! auth()->user()->name !!}</td>
                            <td style="text-align: left">
                            @if($school->is_active == 1)
                                <label for="" style="color:#26B99A"><i class="fa fa-check-circle fa-lg"></i></i></label>
                            @else
                                <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                            @endif
                            </td>
                            
                                
                            <td colspan="3">
                            {!! Form::open(['route' => ['school.destroy', $school->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('school.edit', [$school->id]) !!}" class='btn btn-default btn-xs'>
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