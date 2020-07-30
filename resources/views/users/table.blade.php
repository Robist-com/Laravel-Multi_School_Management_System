@include('table_style')
<h3 style="font-weight:bold"><i class="fa fa-user-o"></i> USERS ROLL ACCESS</h3>

<hr class="line">
<div class="table-responsive">
<div class="panel panel-default">
<div class="panel-heading">
<h4 style="font-weight:bold; color:red" ><i class="fa fa-o"></i> USERS</h4>
</div>
<div class="panel-body">
<div  id="wait"></div>
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
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
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td id="role">{{$user->role['name']}}</td>
                <td>
                <input type="hidden" name="user_id" id="userid{{$user->id}}" value="{{$user->id}}">
                <select  class="form-control select_2_single" name="role_id" id="roleid{{$user->id}}">
                    <option selected disabled>Choose role...</option>
                    @foreach ($roles as $role)
                      <option value="{{$role->id}}">{{ $role->name }}</option>
                    @endforeach
                  </select>
                </td>

                <td style="text-align:center">
                    <input type="checkbox" data-id="{{ $user->id }}" name="status" 
                    class="js-switch" {{ $user->status == 0 ? 'checked' : '' }}>
                </td>

                <td>{{ date("d-M-Y", strtotime($user->created_at)) }}</td>

                <td>
               
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-users-single', [$user->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        @if(Auth::user()->role_id == 1)
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
</div> 