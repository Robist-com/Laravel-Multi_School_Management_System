
@extends('layouts.new-layouts.app')

@section('content')
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        @include('adminlte-templates::common.errors')

            <div class="page-title">
              <div class="title_left">
                <h3>ROLES & PERMISSIONS</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" name="roll_no1" id="roll_no1" placeholder="Search by...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" name="filter1" id="filter1" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title ">
                  @if(isset($role))
                    <h2 style="font-weight:bold">Update Role</h2>
                  @else
                  <h2 style="font-weight:bold">Create Role</h2>
                  @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('roles.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($role))
                  {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch' , 'autocomplete' => 'off']) !!}
                  @else
                  {!! Form::open(['route' => 'roles.store'  , 'autocomplete' => 'off']) !!}
                  @endif
                    @include('roles.fields')

                    {!! Form::close() !!}
                    
                    @include('roles.table')
                    </div>
                   
                </div>
                <!-- </div>

                <div class="col-md-4 col-sm-4 col-xs-12"> -->
                <div class="x_panel ">
                  <div class="x_title">
                  @if(isset($role))
                    <h2 style="font-weight:bold">Update Permission</h2>
                  @else
                  <h2 style="font-weight:bold">Create Permission</h2>
                  @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('roles.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content collapse">
                  @if(isset($role))
                  {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}
                  @else
                  {{-- {!! Form::open(['route' => 'roles.store']) !!} --}}
                  @endif
                    @include('roles.fields')
                    {!! Form::close() !!}
                    
               
                    </div>
                   
                </div>
                </div>
                <!-- </div> -->

            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <h2 style="font-weight:bold"><i class="fa fa-money"></i> Permessions</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    @if(isset($permission))
                    {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'patch']) !!}
                    @else
                    <form action="{{route('permissions.store')}}" method="POST">

                    @endisset
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      @if(isset($permission))
                      <button type="submit" class="btn btn-round btn-dark"><i class="fa fa-plus-circle" aria-hidden="true"> Upsate Assign Permission </i></button></a>
                      @else
                        <button type="submit" class="btn btn-round btn-dark"><i class="fa fa-plus-circle" aria-hidden="true">  Assign Permission </i></button></a>
                      @endif
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

        
                    @csrf
                    <div class="col-md-12">
                    <select name="role_id" id="role_id" class="form-control">
                    <option value="">Select</option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}" @if(isset($permission))@if($permission->role_id === $role->id) selected @endif @endif>{{$role->name}}</option>
                    @endforeach
                    </select>
                    </div>
                    @error('role_id')@enderror
                    <br><br>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                   
                    <table class="table table-striped jambo_table bulk_action" id="feeStructures-table">
                <thead>
                <tr>
                    <th>Permissions</th>
                    <th>Create</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                    
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>Roles</td>
                    <td> <input type="checkbox" @isset($permission->permission['role']['add']) checked @endisset name="permission[role][add]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['role']['edit']) checked @endisset name="permission[role][edit]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['role']['view']) checked @endisset name="permission[role][view]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['role']['delete']) checked @endisset name="permission[role][delete]" class="flat1" id="permission_id" value="1"></td>
                </tr>
                <tr>
                    <td>Permissions</td>
                    <td> <input type="checkbox" @isset($permission->permission['permission']['add']) checked @endisset name="permission[permission][add]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['permission']['edit']) checked @endisset name="permission[permission][edit]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['permission']['view']) checked @endisset name="permission[permission][view]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['permission']['delete']) checked @endisset name="permission[permission][delete]" class="flat1" id="permission_id" value="1"></td>
                </tr>
                <tr>
                <td>Users</td>
                    <td> <input type="checkbox" @isset($permission->permission['user']['add']) checked @endisset name="permission[user][add]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['user']['edit']) checked @endisset name="permission[user][edit]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['user']['view']) checked @endisset name="permission[user][view]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['user']['delete']) checked @endisset name="permission[user][delete]" class="flat1" id="permission_id" value="1"></td>
                </tr>
                <tr>
                    <td>Results</td>
                    <td> <input type="checkbox" @isset($permission->permission['result']['add']) checked @endisset name="permission[result][add]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['result']['edit']) checked @endisset name="permission[result][edit]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['result']['view']) checked @endisset name="permission[result][view]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['result']['delete']) checked @endisset name="permission[result][delete]" class="flat1" id="permission_id" value="1"></td>
                </tr>
                <tr>
                    <td>Fees</td>
                    <td> <input type="checkbox" @isset($permission->permission['fee']['add']) checked @endisset name="permission[fee][add]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['fee']['edit']) checked @endisset name="permission[fee][edit]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['fee']['view']) checked @endisset name="permission[fee][view]" class="flat1" id="permission_id" value="1"></td>
                    <td> <input type="checkbox" @isset($permission->permission['fee']['delete']) checked @endisset name="permission[fee][delete]" class="flat1" id="permission_id" value="1"></td>
                </tr>
                </tbody>
            </table>

            </div>
            </div>

            </form>

                <div class="">
                
                </div>
            </div>
            </div>
            </div>
            </div>
            </div>
@endsection

