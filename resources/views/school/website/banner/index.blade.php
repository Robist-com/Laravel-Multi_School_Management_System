@extends('layouts.new-layouts.app')

@section('content')
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="page-title">
              <div class="title_left">
                <h2>School Banners</h2>
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
                  @if(isset($banner))
                   <h2>Update banner</h2>
                   @else
                   <h2>Create banner</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('days.index')}}"><button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($banner))
                  {!! Form::model($banner, ['route' => ['banner.update', $banner->id], 'method' => 'patch', 'class' => 'form-horizontal form-label-left']) !!}
                  @else

                  <form action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($banner)){{$banner->school_id == $school->id ? 'selected' : ''}} @endif >
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
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter banner"  @if(isset($banner)) value="{{$banner->name}}" @endif>
                    </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="file" name="banner_image" id="banner_image" class="form-control" placeholder="Enter banner"  @if(isset($banner)) value="{{$banner->banner_image}}" @endif>
                    </div>
                    </div>
                    <br>
                    <br>
                    <br>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($banner))
                      {!! Form::hidden('status', '0') !!}
                    {!! Form::checkbox('status', '1', null, ['class' => 'flat']) !!} Status
                    @else
                    {!! Form::hidden('status', '0') !!}
                    {!! Form::checkbox('status', '1', null, ['class' => 'flat']) !!} Status
                    @endif
                    </div>
                    </div>
                 
                    <div class="modal-footer">
                    @if(isset($banner))
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
                    <h2>Table Banner </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#banner-add-modal"><i class="fa fa-plus-circle" aria-hidden="true"> Add New banner</i></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <!-- <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p> -->

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">banner</th>
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
                        @foreach($banners as $banner)
                        <tr class="even pointer">
                          
                          <td class="a-center ">
                            <input type="checkbox" class="flat" name="table_records">
                          </td>
                            <td>{!! $banner->name !!}</td>
                            <td >
                            @if($banner->status == 1)
                            <label for="" class="text-green">Active</label>
                            @else
                            <label for="">In active</label>
                            @endif
                            </td>
                            <td>{!! date('d-M-Y', strtotime($banner->created_at)) !!}</td>
                            <td>
                            {!! Form::open(['route' => ['banner.delete', $banner->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                            <!-- -----------------------------------------------Days view button start here--------------------------------------------------- -->
                                <a data-toggle="modal" data-target="#banner-view-modal" data-banner="{{$banner->name}}"
                                data-created_at="{{$banner->created_at}}" data-updated_at="{{$banner->updated_at}}" data-day_id="{{$banner->day_id}}" 
                                class='btn btn-default btn-xs'> <i class="glyphicon glyphicon-eye-open"></i></a>
                                <!-- ---------------------------------------------------ends here----------------------------------------------------------------- -->
                                <a href="{!! route('banner.edit', [$banner->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
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



<!-- we gonna past it here  -->
<!-- soyou can write this code at your end okay -->
<!-- //---------------------MODAL START HERE----------------------- -->
<div class="modal fade left" id="banner-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="day_id" id="day_id"> 
      <!-- we are using this hidden id to fetch our data by id okay. -->

            <!-- Year Field -->
            <div class="form-group">
                {!! Form::label('banner', 'banner:') !!}
               <input type="text" name="banner" id="banner" readonly>
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
        {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!}
      </div>
    </div>
  </div>
  </div>
  </div>

  </div>
  @endsection
  @section('scripts')

    <script>
    // {{-----------banner view Side------------------}} 
$('#banner-view-modal').on('show.bs.modal', function(event){

var button = $(event.relatedTarget)
var banner = button.data('banner') //thats the input name and the id's okay so make sure yours be like the same at your end okay.
var created_at = button.data('created_at')
var updated_at = button.data('updated_at')
var day_id = button.data('day_id') // this day_id is the hidden input id that we assigned in our form okay.

var modal = $(this)

modal.find('.modal-title').text('VIEW banner INFORMATION');
modal.find('.modal-body #banner').val(banner);
modal.find('.modal-body #created_at').val(created_at);
modal.find('.modal-body #updated_at').val(updated_at);
modal.find('.modal-body #day_id').val(day_id);
});

$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let dayId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('days/status/update') }}',
            data: {'status': status, 'day_id': dayId},
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

  <!-- so now we will use some style to hide our input border okay.  -->
          
 
