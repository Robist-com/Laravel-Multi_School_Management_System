{{-- @include('table_style') --}}
<h3 style="font-weight:bold"><i class="fa fa-user-o"></i> USERS ROLL ACCESS</h3>

<hr class="line">
<div class="table-responsive">
<div class="card card-default">
<div class="card-header">
<h4 style="font-weight:bold;">
<a  class="pull-right btn btn-success" href="{{url('home')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Back</i></a>

</h4>
</div>
<div class="panel-body">
<div  id="wait"></div>
</div>

<div class="x_content">
    <div class="col-md-12 col-sm-12 col-xs-12">
    <ul class="nav nav-pills my-3" >
        <li class="active "><a data-toggle="pill" href="#staff">Staff</a></li>
        @if (auth()->user()->group == "Admin" && auth()->user()->school_id == "")
        <li><a data-toggle="pill" href="#owners"> School Owners</a></li>
        @endif
    </ul>
    <div class="tab-content" style="margin-top: 10px">
    <div id="staff" class="tab-pane fade in active">
<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th style="text-align:center">Change User Role</th>
            <th>Status</th>
            <th>Registered Date</th>
            <th style="text-align:center">Action</th>
        </tr>

    </thead>

    <tbody>
        @foreach ($users as $key => $user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td id="role">{{$user->role['name']}}</td>
                <td>
                <input type="hidden" name="user_id" id="userid{{$user->id}}" value="{{$user->id}}">
                <select  class="form-control select_2_single" name="role_id" id="roleid{{$user->id}}">
                    <option selected disabled>Choose role...</option>
                    @foreach ($roles as $role)
                      <option value="{{$role->id}}" @if($role->id == $user->role_id) selected @endif>{{ $role->name }}</option>
                    @endforeach
                  </select>
                </td>

                <td style="text-align:center">
                    <input type="checkbox" data-id="{{ $user->id }}" name="status" 
                    class="flat" {{ $user->status == 0 ? 'checked' : '' }}>
                </td>

                <td>{{ date("d-M-Y", strtotime($user->created_at)) }}</td>

                <td>
               
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-users-single', [$user->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        @if(Auth::user()->group == "Admin")
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>

    <div id="owners" class="tab-pane fade in ">
<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Registered Date</th>
            <th style="text-align:center">Action</th>
        </tr>

    </thead>

    <tbody>
        @if (auth()->user()->group == 'Own')
            @foreach ($users as $key => $user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td id="role">{{$user->role['name']}}</td>
                <td style="text-align:center">
                    <input type="checkbox" data-id="{{ $user->id }}" name="status" 
                    class="flat" {{ $user->status == 0 ? 'checked' : '' }}>
                </td>

                <td>{{ date("d-M-Y", strtotime($user->created_at)) }}</td>

                <td>
               
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-users-single', [$user->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        @if(Auth::user()->group == "Admin")
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        @endif

         @if (auth()->user()->group == 'Own' && auth()->user()->school_id == '')
            @foreach ($SchoolOwnerusers as $key => $user)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td id="role">{{$user->role['name']}}</td>
                <td style="text-align:center">
                    <input type="checkbox" data-id="{{ $user->id }}" name="status" 
                    class="flat" {{ $user->status == 0 ? 'checked' : '' }}>
                </td>

                <td>{{ date("d-M-Y", strtotime($user->created_at)) }}</td>

                <td>
               
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-users-single', [$user->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        @if(Auth::user()->group == "Admin")
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
    </div>
</div>
</div>
</div>
</div> 