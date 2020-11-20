<div class="page-title">
              <div class="title_left">
                <h2>MANAGE STUDENT GROUP</h2>
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
                  @if(isset($faculty))
                   <h2>Update Student Group</h2>
                   @else
                   <h2>Create Student Group</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('faculties.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($faculty))
                  {!! Form::model($faculty, ['route' => ['faculties.update', $faculty->faculty_id], 'method' => 'patch', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'off']) !!}
                  @else
                  {!! Form::open(['route' => 'faculties.store', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'off']) !!}
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($faculty)){{$faculty->school_id == $school->id ? 'selected' : ''}} @endif >
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
                        <input type="text" name="faculty_name" id="faculty_name" class="form-control" placeholder="Enter Faculty"  @if(isset($faculty)) value="{{$faculty->faculty_name}}" @endif>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="faculty_code" id="faculty_code" class="form-control" placeholder="Enter Faculty Code"  @if(isset($faculty)) value="{{$faculty->faculty_code}}" @endif>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($faculty))
                      {!! Form::hidden('faculty_status', '0') !!}
                    {!! Form::checkbox('faculty_status', '1', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('faculty_status', '0') !!}
                    {!! Form::checkbox('faculty_status', '1', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div>
                 
                    <div class="modal-footer">
                    @if(isset($faculty))
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-dark']) !!}
                    @else
                    <button type="submit" class="btn btn-round btn-dark">Save</button>
                    @if($department == 0)
                    <a href="{{route('departments.index')}}" class="btn btn-round btn-info pull-left">Create Class Group</a>
                   @endif
                   @endif
                    </div>
                   
                    {!! Form::close() !!}

                  </div>
                </div>
              </div>

              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table Student Group </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#faculty-add-modal"><i class="fa fa-plus-circle" aria-hidden="true"> Add New Student Group</i></a>
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
                            <th class="column-title">Group Name</th>
                            <th class="column-title">Group Code</th>
                            <th class="column-title">Group Status</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($faculties as $faculty)
                        <tr class="even pointer">
                          
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                            <td>{!! $faculty->faculty_name !!}</td>

                            <div id="wait" style="display:none;width:69px;height:89px;border:none 
                            solid black;position:absolute;top:0%;left:5%;padding:2px; background:none">
                            <img src="{{asset('images/loading.gif')}}"
                            width="64" height="64" /><br>Loading..</div>

                            <td>{!! $faculty->faculty_code !!}</td>

                            <td style="text-align:center">
                            @if($faculty->faculty_status == 1)
                                <label for="" style="color:#26B99A"><i class="fa fa-check-circle fa-lg"></i></i></label>
                            @else
                            <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                            @endif
                            </td>

                            <td colspan="3">
                                {!! Form::open(['route' => ['faculties.destroy', $faculty->faculty_id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! url('print-faculty-single', [$faculty->faculty_id]) !!} " target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                                    <a href="{!! route('faculties.show', [$faculty->faculty_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                    <a href="{!! route('faculties.edit', [$faculty->faculty_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
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
$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let facultyId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('faculties.update.status') }}',
            data: {'status': status, 'faculty_id': facultyId},
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
});
</script>
@endsection