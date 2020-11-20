<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3>SUBJECTS </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('courses.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a>
        </div>

    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($course))
                    <h2>Update Subject</h2>
                    @else
                    <h2>Create Subject</h2>
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
                    @if(isset($course))
                    {!! Form::model($course, ['route' => ['courses.update', $course->id], 'method' => 'patch', 'class'
                    =>
                    'form-horizontal form-label-left']) !!}
                    @else
                    {!! Form::open(['route' => 'courses.store', 'class' => 'form-horizontal form-label-left']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control bootstrap-select" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($course)){{$course->school_id == $school->id ? 'selected' : ''}} @endif>
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
                        <select name="department" class="form-control bootstrap-select" id="department_id">
                          <option value="" >Select Department</option>
                          @foreach ($department as $department)
                          <option value="{{ $department->department_id}}" @if(isset($course)){{$department->department_id == $course->department ? 'selected' : ''}} @endif >{{ $department->department_name }}</option>
                          @endforeach
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <select name="class[]" class="form-control bootstrap-select" multiple data-hide-disabled="true" data-size="5" id="subject_class" >
                         @foreach($classes as $class)
                          <option value="{{$class->class_code}}"  @if(isset($course)) {{$class->class_code == $course->class ? 'selected' : ''}}  @endif >{!! $class->class_name .'-- '. $class->class_code !!}</option>
                        @endforeach
                     
                     </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <select name="gradeSystem"  class="form-control bootstrap-select" id="grade_system">
                             <option value="">Grade System</option>
                              @if($gpa)
                             @foreach($gpa as $gp)
                              <option  value="{{$gp->for}}" @if(isset($course)){{$gp->for == $course->gradeSystem ? 'selected' : ''}} @endif> @if($gp->for=="1") 100 Marks @elseif($gp->for=="2") 75 Marks  @elseif($gp->for=="3") 50 Marks  @elseif($gp->for=="4") 30 Marks  @elseif($gp->for=="5") 25 Marks  @elseif($gp->for=="6") 20 Marks @elseif($gp->for=="7") 15 Marks @elseif($gp->for=="8") 10 Marks @endif </option>

                            @endforeach
                            @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @if(isset($course))
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="1" @if($course->status == '1') selected @endif>
                                    Active </option>
                                <option value="0" @if($course->status == '0') selected @endif>
                                    In active </option>
                            </select>
                            @else
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="1"> Active </option>
                                <option value="0"> In active </option>
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(isset($course))
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

                    <h2>Subject Table</h2>
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
                                <th class="column-title">Subject</th>
                                <th class="column-title">Code</th>
                                <th class="column-title">Class</th>
                                <th class="column-title">Department</th>
                                <th class="column-title">Status</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th class="column-title">Subject</th>
                                <th class="column-title">Code</th>
                                <th class="column-title">Class</th>
                                <th class="column-title">Department</th>
                                <th class="column-title">Status</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                                </tr>
                            </tfoot>
                            <tbody>
                              
                            @foreach($courses as $subject)
                            <tr class="even pointer">
                                <td data-toggle="tooltip" data-placement="right" title=""
                                    data-original-title="{!! $subject->description !!}">{!! $subject->course_name !!}</td>
                                <td class="badge badge-success" style="text-align: center;">{!! $subject->course_code !!}
                                </td>
                                <td>{!! $subject->class !!}</td>
                                <td>{!! $subject->department_name !!}</td>
                                <td>
                                    @if($subject->status == '1')
                                    <label for="" style="color:#26B99A"><i
                                            class="material-icons">check_circle</i></label>
                                    @else
                                    <label for="" style="color:#D9534F"><i class="material-icons">not_interested </i></label>
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open(['route' => ['courses.destroy', $subject->subject_id], 'method' =>
                                    'delete']) !!}

                                    <div class="btn-group">
                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{!! route('courses.show', [$subject->subject_id]) !!}"
                                                        target="__blank"><i class="glyphicon glyphicon-print"></i>
                                                        Print</a></li>
                                                <li role="separator" class="divider"></li>

                                                <li> <a data-toggle="modal" href="{!! route('courses.show', [$subject->subject_id]) !!}"><i
                                                            class="glyphicon glyphicon-eye"></i> View</a></li>

                                                <li role="separator" class="divider"></li>

                                                <li> <a href="{!! route('courses.edit', [$subject->subject_id]) !!}"><i
                                                            class="glyphicon glyphicon-edit"></i> Edit</a></li>
                                                <li role="separator" class="divider"></li>
                                                <!-- <li> -->
                                                <!-- <input type="submit" name="" id="" onclick="return confirm('Areyou sure?')"> -->
                                                <li><a id="delete_link" href="#"
                                                        onclick="return confirm('Are you sure?')"><i
                                                          class="material-icons">delete_forever</i> Delete</a></li>

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
</div>
</div>


<script type="text/javascript" src="{{asset('js/bootstrap-filestyle.min.js')}}"> </script>
<script type="text/javascript" src="{{asset('js/bootstrap-filestyle.min.js')}}"> </script>

<!-- <input type="file" class="filestyle"> -->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" style="width: 100%;">
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

@section('js')

<script type="text/javascript">
$(document).ready(function() {
    $('.view_data').click(function() {
        var certificateid = $(this).attr("id");
        $('#myModal').modal("show");
        // $.ajax({
        //     url: "{{ url('course/status/update') }}",
        //     method: "get",
        //     data: {certificateid: certificateid},
        //     success: function (data) {
        //         $('#certificate_detail').html(data);
        //         $('#myModal').modal("show");
        //     }
        // });
    });

    document.getElementById("delete_link").onclick = function() {
        document.getElementById("delete_form").submit();
    }

    //  Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


    $('#class_name').on('keyup', function() {

        var randomString = function(length) {

            var text = "";

            // var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            for (var i = 0; i < length; i++) {

                text += possible.charAt(Math.floor(Math.random() * possible.length));

            }

            return text;
        }

        // random string length
        var random = randomString(5);
        var class_name = $("#class_name").val();

        if (class_name !== '') {
            var elem = document.getElementById("class_code").value = random + '-' + class_name;
        } else {
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