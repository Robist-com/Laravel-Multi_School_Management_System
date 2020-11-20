<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>MANAGE CLASS GROUP </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <a href="{{route('departments.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a>
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($department))
                    <h2>Update Class Group</h2>
                    @else
                    <h2>Create Class Group</h2>
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


                    @if(isset($department))
                    {!! Form::model($department, ['route' => ['departments.update', $department->department_id],
                    'method' => 'patch', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'off']) !!}
                    @else
                    {!! Form::open(['route' => 'departments.store', 'class' => 'form-horizontal form-label-left',
                    'autocomplete' => 'off']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($department)){{$department->school_id == $school->id ? 'selected' : ''}}
                                    @endif>
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
                            <select name="faculty_id" id="faculty_id" class="form-control bootstrap-select"
                                id="bootstrap-select">
                                <option value="0" selected="true" disabled="true" style="margin-right:20px">Choose
                                    Student Group</option>
                                @foreach($faculties as $key => $faculty)
                                <option value="{{$faculty->faculty_id}}" @if(isset($department))
                                    {{$faculty->faculty_id == $department->faculty_id ? 'selected' : ''}} @endif>
                                    {{$faculty->faculty_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <input type="text" name="department_name" id="department_name" class="form-control"
                                    placeholder="Enter Department" @if(isset($department))
                                    value="{{$department->department_name}}" @endif>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <input type="text" name="department_code" id="department_code" class="form-control"
                                    placeholder="Enter Department Code" @if(isset($department))
                                    value="{{$department->department_code}}" @endif>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-line">
                                {!! Form::textarea('department_description', null, ['class' => 'form-control border',
                                'cols' => 40, 'rows' =>2, 'placeholder'=> 'Department Description']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            @if(isset($department))
                            <select class="form-control bootstrap-select" name="department_status" id="status">
                                <option value="1" @if($department->department_status == '1') selected @endif>
                                    Active </option>
                                <option value="0" @if($department->department_status == '0') selected @endif>
                                    In active </option>
                            </select>
                            @else
                            <select class="form-control bootstrap-select" name="department_status" id="status">
                                <option value="1"> Active </option>
                                <option value="0"> In active </option>
                            </select>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if(isset($department))
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

                    <h2>Level Table</h2>
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
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th class="column-title">Student Group </th>
                                    <th class="column-title">Class Group </th>
                                    <th class="column-title">Group Code</th>
                                    <th class="column-title">Description</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="column-title">Student Group </th>
                                    <th class="column-title">Class Group </th>
                                    <th class="column-title">Group Code</th>
                                    <th class="column-title">Description</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($departments as $department)
                                <tr class="even pointer">

                                    <td>{!! $department->faculty_name !!}</td>

                                    <div id="wait" style="display:none;width:69px;height:89px;border:none 
                            solid black;position:absolute;top:0%;left:5%;padding:2px; background:none">
                                        <img src="{{asset('images/loading.gif')}}" width="64"
                                            height="64" /><br>Loading..
                                    </div>

                                    <td>{!! $department->department_name !!}</td>
                                    <td>{!! $department->department_code !!}</td>
                                    <td>{!! $department->department_description !!}</td>

                                    <td style="text-align:center">
                                        @if($department->department_status == 1)
                                        <label for="" style="color:#26B99A"><i
                                                class="fa fa-check-circle fa-lg"></i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                                        @endif
                                    </td>

                                    <td colspan="3">
                                        {!! Form::open(['route' => ['departments.destroy', $department->department_id],
                                        'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a href="{!! url('print-faculty-single', [$department->department_id]) !!} "
                                                        target="_blank">
                                                        <i class="glyphicon glyphicon-print"></i> Print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a
                                                        href="{!! route('departments.show', [$department->department_id]) !!}">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a
                                                        href="{!! route('departments.edit', [$department->department_id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {{$department->department_name}} ?"><i
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