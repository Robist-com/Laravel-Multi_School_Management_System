<div class="page-title">
              <div class="title_left">
                <h2>MANAGE CLASSES</h2>
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
                  @if(isset($classes))
                   <h2>Update Class</h2>
                   @else
                   <h2>Create Class</h2>
                   @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{route('classes.index')}}"><button type="submit" class="btn btn-round btn-success">Add</button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if(isset($classes))
                  {!! Form::model($classes, ['route' => ['classes.update', $classes->id], 'method' => 'patch', 'class' => 'form-horizontal form-label-left']) !!}
                  @else
                  {!! Form::open(['route' => 'classes.store', 'class' => 'form-horizontal form-label-left']) !!}
                  @endif

                  @if(auth()->user()->group == "Admin")
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                            @if(isset($classes)){{$classes->school_id == $school->id ? 'selected' : ''}} @endif >
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
                          <select class="form-control" name="grade_id" id="grade_id">
                            <option>Select Grade</option>
                            @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}"
                            @if(isset($classes)){{$classes->grade_id == $semester->id ? 'selected' : ''}} @endif >
                            {{$semester->semester_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select class="form-control" name="department_id" id="department_id">
                            <option>Select</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->department_id }}"
                            @if(isset($classes)){{$classes->department_id == $department->department_id ? 'selected' : ''}} @endif >
                            {{$department->department_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    <div class="form-group">
                    <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12">Default Input</label> -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="class_name" id="class_name" class="form-control" placeholder="Enter Class Name"  @if(isset($classes)) value="{{$classes->class_name}}" @endif>
                    </div>
                    </div>
                    <div class="form-group">
                  
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="class_code" readonly id="class_code" class="form-control" placeholder="Enter Class Code"  @if(isset($classes)) value="{{$classes->class_code}}" @endif>
                    </div>
                    </div>
                    <div class="form-group">
                  
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($classes))
                    <!-- <input type="checkbox" class="flat" value="{{ $classes->id }}" checked="checked"> Checked -->
                    <input type="checkbox"value="{{ $classes->status }}" name="status" 
                    class="flat" {{ $classes->status == 'on' ? 'checked' : '' }}>
                    @else
                    <input type="checkbox" class="flat" name="status" > Status
                    @endif
                    </div>
                    </div>
                    <div class="modal-footer">
                    @if(isset($classes))
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
                    <h2>Table design <small>Custom design</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
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
                            <th class="column-title">Class </th>
                            <th class="column-title">Class Group</th>
                            <th class="column-title">Code </th>
                            <th class="column-title">Students </th>
                            <th class="column-title">Status</th>
                            @if(auth()->user()->group == "Admin")
                            <th class="column-title">School</th>
                            @endif
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($classe as $classes)
                          <tr class="even pointer">
                          
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">{!! $classes->class_name !!}</td>
                            <td class=" ">{!! $classes->department_name !!}</td>
                            <td class=" "> {!! $classes->class_code !!} <i class="success fa fa-long-arrow-up"></i></td>
                            <td class=" "> {{$classes->students}} </td>
                            <td class=" ">
                            @if($classes->status == 'on')
                                <label for="" style="color:#26B99A"><i class="fa fa-check-circle fa-lg"></i></i></label>
                            @else
                            <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                            @endif
                                @if(auth()->user()->group == "Admin")
                                <td>{{auth()->user()->school->name}}</td>
                                @endif
                            </td class=" ">
                            <td>
                            {!! Form::open(['route' => ['classes.destroy', $classes->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                            <a href="{!! url('print-class-single', [$classes->id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <!-- <a href="{!! route('classes.show', [$classes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                        <!-- ---------------------------------------here is the class view button code ---------------------------------------- -->
                        <a data-toggle="modal" data-target="#class-view-modal" data-batch_id="{{$classes->id}}"
                        data-class_name="{{$classes->class_name}}" data-class_code="{{$classes->class_code}}" data-created_at="{{$classes->created_at}}"
                        data-updated_at="{{$classes->updated_at}}"
                         class='btn btn-warning btn-xs'>
                         <i class="glyphicon glyphicon-eye-open"></i></a>
                         <!-- -------------------------------------------------------------------- -->
                       
                        <a href="{!! route('classes.edit', [$classes->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                            </td>
                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>
							<div class="view_data btn btn-info"></div>
						
                  </div>
                </div>
              </div>
            </div>

<script type="text/javascript" src="{{asset('js/bootstrap-filestyle.min.js')}}"> </script>
<script type="text/javascript" src="{{asset('js/bootstrap-filestyle.min.js')}}"> </script>

<!-- <input type="file" class="filestyle"> -->

            <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" style="width: 100%;" >
    <div class="modal-dialog modal-lg" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="certificate_detail">

            </div>
        </div>
    </div>
</div>

@section('scripts')

<script type="text/javascript">
    $(document).ready(function () {
        $('.view_data').click(function () {
            var certificateid = $(this).attr("id");
            $('#myModal').modal("show");
            // $.ajax({
            //     url: "{{ url('classes/status/update') }}",
            //     method: "get",
            //     data: {certificateid: certificateid},
            //     success: function (data) {
            //         $('#certificate_detail').html(data);
            //         $('#myModal').modal("show");
            //     }
            // });
        });

$('#class_name').on('keyup', function(){

var randomString = function(length) {

var text = "";

// var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

for(var i = 0; i < length; i++) {

  text += possible.charAt(Math.floor(Math.random() * possible.length));

}

return text;
}

// random string length
var random = randomString(5);
var class_name = $("#class_name").val();
  
if (class_name !== '') {
  var elem = document.getElementById("class_code").value = random +'-'+ class_name;
}else{
  var elem = document.getElementById("class_code").value = '';
}
  // alert(random)
// insert random string to the field

})

// $('#class_code').attr('disabled', true);

    });

   

    
// Via JavaScript
$(":file").filestyle();

// Via data attributes
</script>

@endsection