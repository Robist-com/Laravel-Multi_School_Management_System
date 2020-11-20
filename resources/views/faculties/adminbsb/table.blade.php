<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>MANAGE STUDENT GROUP </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <a href="{{route('faculties.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a>
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($faculty))
                    <h2>Update Student Group</h2>
                    @else
                    <h2>Create Student Group</h2>
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

                    @if(isset($faculty))
                    {!! Form::model($faculty, ['route' => ['faculties.update', $faculty->faculty_id], 'method' =>
                    'patch', 'class' => 'form-horizontal form-label-left', 'autocomplete' => 'off']) !!}
                    @else
                    {!! Form::open(['route' => 'faculties.store', 'class' => 'form-horizontal form-label-left',
                    'autocomplete' => 'off']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control bootstrap-select" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($faculty)){{$faculty->school_id == $school->id ? 'selected' : ''}} @endif>
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
                            <div class="form-line">
                                <input type="text" name="faculty_name" id="faculty_name" class="form-control"
                                    placeholder="Enter Faculty" @if(isset($faculty)) value="{{$faculty->faculty_name}}"
                                    @endif>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <input type="text" name="faculty_code" id="faculty_code" class="form-control"
                                    placeholder="Enter Faculty Code" @if(isset($faculty))
                                    value="{{$faculty->faculty_code}}" @endif>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            @if(isset($faculty))
                            <select class="form-control bootstrap-select" name="faculty_status" id="status">
                                <option value="1" @if($faculty->faculty_status == '1') selected @endif>
                                    Active </option>
                                <option value="0" @if($faculty->faculty_status == '0') selected @endif>
                                    In active </option>
                            </select>
                            @else
                            <select class="form-control bootstrap-select" name="faculty_status" id="status">
                                <option value="1"> Active </option>
                                <option value="0"> In active </option>
                            </select>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if(isset($faculties))
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

                    <h2>Student Group Table</h2>
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
                                    <th class="column-title">Group Name</th>
                                    <th class="column-title">Group Code</th>
                                    <th class="column-title">Group Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="column-title">Group Name</th>
                                    <th class="column-title">Group Code</th>
                                    <th class="column-title">Group Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($faculties as $faculties)
                                <tr class="even pointer">

                                    <td>{!! $faculties->faculty_name !!}</td>

                                    <div id="wait" style="display:none;width:69px;height:89px;border:none 
                            solid black;position:absolute;top:0%;left:5%;padding:2px; background:none">
                                        <img src="{{asset('images/loading.gif')}}" width="64"
                                            height="64" /><br>Loading..
                                    </div>

                                    <td>{!! $faculties->faculty_code !!}</td>

                                    <td style="text-align:center">
                                        @if($faculties->faculty_status == 1)
                                        <label for="" style="color:#26B99A"><i
                                                class="fa fa-check-circle fa-lg"></i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                                        @endif
                                    </td>

                                    <td colspan="3">
                                        {!! Form::open(['route' => ['faculties.destroy', $faculties->faculty_id],
                                        'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a href="{!! url('print-faculty-single', [$faculties->faculty_id]) !!} "
                                                        target="_blank">
                                                        <i class="glyphicon glyphicon-print"></i> Print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('faculties.show', [$faculties->faculty_id]) !!}">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('faculties.edit', [$faculties->faculty_id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {{$faculties->faculty_name}} ?"><i
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