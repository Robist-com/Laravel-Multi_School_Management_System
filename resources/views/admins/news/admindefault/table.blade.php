@extends('layouts.new-layouts.app')
@section('content')
@php

use App\Permission;

use App\Http\Controllers\instituteController;
$get_grad = new instituteController;
$system_grade = $get_grad->index1();
$get_permission = new Permission;
$permissions  = $get_permission->get_permission_by_role();
$permision =array();
foreach($permissions as $permission){
$permision[] = $permission->permission_name;
}

@endphp

@section('css')
<style>
        .school_active{
          font-weight:bold !important; 
          /* font-size:70% !important; */
           text-transform:uppercase; 
           /* background-color:green;  */
           color:#1A6AA4;
        }
        </style>
@stop
<div class="page-title">
              <div class="title_left">
                <h2>Manage School</h2>
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
            @if(isset($school))
            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-8">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update School</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a href="{{route('school.index')}}" class="btn btn-round btn-dark"> return</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                {!! Form::model($school, ['route' => ['school.update', $school->id], 'method' => 'patch' , 'autocomplete' => 'off']) !!}
                {!! csrf_field() !!}

                <div class="form-group col-md-6 has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="">Owner Name</label>
                <input type="text" class="form-control" name="name" value=" {{$school->user_name}}" placeholder="Full Name">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6 has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="">School Name</label>
            <input type="text" class="form-control" name="name" value="{{ $school->school_name }}" placeholder="Email">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6 has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="">Email</label>    
            <input type="email" class="form-control" name="email" value="{{ $school->email }}" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6 has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="">School Name</label>    
            <input type="email" class="form-control" name="email" value="{{ $school->email }}" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>


            <div class="btn-group">
                      <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                      <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                      <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                      <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                      <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                      <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                      <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                      <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                      <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                      <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                      <div class="dropdown-menu input-append">
                        <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                        <button class="btn" type="button">Add</button>
                      </div>
                      <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                      <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                      <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                    </div>
                  </div>

                  <div id="editor-one" class="editor-wrapper"></div>

                  <textarea name="description" id="descr" style="display:none;">{{ $school->description }} </textarea>
                  
                  <br />
                  @if(Auth::user()->role_id == 1)
                    <div class="form-group  col-sm-2">
                    <label class="checkbox-inline">
                    {!! Form::hidden('is_active', '0') !!}
                    {!! Form::checkbox('is_active', '1', null, ['class' => "checkbox"]) !!} is active
                    <!-- {!! Form::checkbox('is_active', '1', null, ['data-toggle' => "toggle", 'data-on' => 'Active', 'data-off' => 'In Active', 'data-onstyle' => 'success', 'data-onstyle' => 'danger']) !!} is active -->
                    </label>
                    </div>
                    @endif
                  <br><br>
                  <!-- <div class="ln_solid"></div> -->
                <div class="modal-footer">
                  <button type="submit"  class="btn btn-dark btn-round pull-right">Save School Changes</button>
                  </div>
        </form>

        </div>
       
     </div>
      @endif
              <div class="col-md-12 col-sm-12 col-xs-8">
                <div class="x_panel">
                  <div class="x_title">
                  @foreach($schools as $school)
                  <div class="school_active" style="font-size:15px">{{$school->school_name}}  <b style="background-color:green; color:#ffffff; border-radius:4px">Activation Table</b></div>
                    <!-- <b class="label label-success1 school_active" id="school_active"></b> -->
                    @endforeach
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr >
                            <th class="column-title">School Name</th>
                            <th class="column-title">Owner Name</th>
                            <th class="column-title">Owner Email</th>
                            <th class="column-title">Rating</th>
                            <th class="column-title">Status</th>
                            <th class="column-title">Created</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($schools as $school)
                        <tr >
                          
                            <td class="">{{$school->school_name}} </td>
                            <td class="">{!! $school->user_name !!}</td>
                            <td class="">{!! $school->email !!}</td>
                            <td class="">{!! $school->rating !!}</td>

                            <td>
                                @if($school->is_active == '1')
                                <label for="" class="btn btn-success btn-xs btn-round">Is active</label>
                                @else
                                <label class="btn btn-danger btn-xs btn-round">Not active</label>
                                @endif
                            </td>

                            <td>{!! date('d-M-Y', strtotime($school->created_at )) !!}</td>

                            <td colspan="3">
                            {!! Form::open(['route' => ['school.destroy', $school->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>

                                
                                <a data-time_id="{{$school->id}}" data-time="{{$school->time}}" 
                                    data-time_description="{{$school->time_description}}" data-course_id="{{$school->course['course_name']}}"
                                    data-created_at="{{$school->created_at}}" data-updated_at="{{$school->updated_at}}"
                                    data-toggle="modal" data-target="#time-show" class='btn btn-default btn-xs'>
                                    <i class="glyphicon glyphicon-eye-open"></i></a>
                                
                                
                                    <a data-time_id="{{$school->time_id}}" data-time="{{$school->time}}" 
                                    data-time_description="{{$school->time_description}}" data-course_id="{{$school->course['course_name']}}"
                                    href="{!! route('school.edit', [$school->id]) !!}" class='btn btn-default btn-xs'>
                                    <i class="glyphicon glyphicon-edit"></i></a>
                                    @if(in_array('school_delete',$permision))
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    @endif
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
            
<!-- /so now lets work on the button side -->

<!-- i will add the view modal here okay. -->

<!-- //---------------------MODAL START HERE----------------------- -->
<div class="modal fade left" id="time-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
        
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h4>
          
      </div>
      <div class="modal-body">
      <input type="hidden" name="time_id" id="time_id">
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- Year Field -->
            <div class="form-group">
                {!! Form::label('time', 'Time:') !!}
               <input type="text" name="time" id="time" readonly>
            </div>

            <div class="form-group">
                {!! Form::label('time', 'time:') !!}
               <input type="text" name="time" id="time" readonly>
            </div>
            <!-- Created At Field -->
            <div class="form-group">
                {!! Form::label('created_at', 'Created At:') !!}
                <input type="text" name="created_at" id="created_at" readonly>
            </div>

            <!-- Updated At Field -->
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <input type="text" name="updated_at" id="updated_at" readonly>
            </div>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>
  </div>
  @endsection

  @section('scripts')
  <!-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> -->
    <script>
    // {{-----------time view Side------------------}}
$('#time-view-modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var time= button.data('time')
var time= button.data('time')
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var time_id = button.data('time_id')

var modal = $(this)

modal.find('.modal-title').text('VIEW TIME INFORMATION');
modal.find('.modal-body #time').val(time);
modal.find('.modal-body #time').val(time);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #time_id').val(time_id);
});

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let timeId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('time/status/update') }}',
            data: {'status': status, 'time_id': timeId},
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
