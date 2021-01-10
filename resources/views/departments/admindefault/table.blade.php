<div class="page-title">
              <div class="title_left">
                <h2>MANAGE CLASS GROUP</h2>
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
                  @if(isset($department))
                   <h2>Update Class Group</h2>
                   @else
                   <h2>Create Class Group</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('departments.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($department))
                  {!! Form::model($department, ['route' => ['departments.update', $department->department_id], 'method' => 'patch', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'off']) !!}
                  @else
                  {!! Form::open(['route' => 'departments.store', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'off']) !!}
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($department)){{$department->school_id == $school->id ? 'selected' : ''}} @endif >
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
                    <select name="faculty_id" id="faculty_id" class="form-control select_2_single" id="select_2_single">
                    <option value="0" selected="true" disabled="true" style="margin-right:20px">Choose Student Group</option>
                    @foreach($faculties as $key => $faculty)
                    <option value="{{$faculty->faculty_id}}" @if(isset($department)) {{$faculty->faculty_id == $department->faculty_id ? 'selected' : ''}}  @endif>{{$faculty->faculty_name}}</option>
                    @endforeach
                    </select>
                    </div>
                    </div>
                  
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="department_name" id="department_name" class="form-control" placeholder="Enter Class Group"  @if(isset($department)) value="{{$department->department_name}}" @endif>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" readonly name="department_code" id="department_code" class="form-control" placeholder="Enter Class Group Code"  @if(isset($department)) value="{{$department->department_code}}" @endif>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    {!! Form::textarea('department_description', null, ['class' => 'form-control border', 'cols' => 40, 'rows' =>2, 'placeholder'=> 'Class Group Description']) !!}
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($department))
                      {!! Form::hidden('department_status', '0') !!}
                    {!! Form::checkbox('department_status', '1', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('department_status', '0') !!}
                    {!! Form::checkbox('department_status', '1', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div>
                 
                    <div class="modal-footer">
                    @if(isset($department))
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
                    <h2>Table Student Group </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#department-add-modal"><i class="fa fa-plus-circle" aria-hidden="true"> Add New Student Group</i></a>
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
                            <th class="column-title">Class Group Name</th>
                            <th class="column-title">Class Group Code</th>
                            {{-- <th class="column-title">Description</th> --}}
                            <th class="column-title">Status</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($departments as $department)
                        <tr class="even pointer">
                          
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                            <td>{!! $department->faculty_name !!}</td>

                            <div id="wait" style="display:none;width:69px;height:89px;border:none 
                            solid black;position:absolute;top:0%;left:5%;padding:2px; background:none">
                            <img src="{{asset('images/loading.gif')}}"
                            width="64" height="64" /><br>Loading..</div>

                            <td>{!! $department->department_name !!}</td>
                            <td>{!! $department->department_code !!}</td>

                            <td style="text-align:center">
                                @if($department->department_status == 1)
                                <label for="" style="color:#26B99A"><i class="fa fa-check-circle fa-lg"></i></i></label>
                                @else
                                <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                                @endif
                            </td>

                            <td colspan="3">
                                {!! Form::open(['route' => ['departments.destroy', $department->department_id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! url('print-faculty-single', [$department->department_id]) !!} " target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                                    <a href="{!! route('departments.show', [$department->department_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                    <a href="{!! route('departments.edit', [$department->department_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
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
