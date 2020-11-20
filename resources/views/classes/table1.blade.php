<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3>CLASSES </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('classes.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a>
        </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($classes))
                    <h2>Update Class</h2>
                    @else
                    <h2>Create Class</h2>
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
                    @if(isset($classes))
                    {!! Form::model($classes, ['route' => ['classes.update', $classes->id], 'method' => 'patch', 'class'
                    =>
                    'form-horizontal form-label-left']) !!}
                    @else
                    {!! Form::open(['route' => 'classes.store', 'class' => 'form-horizontal form-label-left']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control bootstrap-select" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($classes)){{$classes->school_id == $school->id ? 'selected' : ''}} @endif>
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
                            <select class="form-control bootstrap-select" name="grade_id" id="grade_id">
                                <option>Select Grade</option>
                                @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}"
                                    @if(isset($classes)){{$classes->grade_id == $semester->id ? 'selected' : ''}}
                                    @endif>
                                    {{$semester->semester_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control bootstrap-select" name="department_id" id="department_id">
                                <option>Select</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->department_id }}"
                                    @if(isset($classes)){{$classes->department_id == $department->department_id ? 'selected' : ''}}
                                    @endif>
                                    {{$department->department_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12">Default Input</label> -->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <input type="text" name="class_name" id="class_name" class="form-control date"
                                    placeholder="Enter Class Name" @if(isset($classes)) value="{{$classes->class_name}}"
                                    @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <input type="text" name="class_code" readonly id="class_code" class="form-control"
                                    placeholder="Enter Class Code" @if(isset($classes)) value="{{$classes->class_code}}"
                                    @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @if(isset($classes))
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="on" @if($classes->status == 'on') selected @endif>
                                    Active </option>
                                <option value="off" @if($classes->status == 'off') selected @endif>
                                    In active </option>
                            </select>
                            @else
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="on"> Active </option>
                                <option value="off"> In active </option>
                            </select>
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

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="header">

                    <h2>Class Table</h2>
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
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
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
                                </tr>
                            </tfoot>



                            <tbody>
                                @foreach($classe as $classes)
                                <tr class="even pointer">
                                    <td class=" ">{!! $classes->class_name !!}</td>
                                    <td class=" ">{!! $classes->department_name !!}</td>
                                    <td class=" "> {!! $classes->class_code !!} <i
                                            class="success fa fa-long-arrow-up"></i>
                                    </td>
                                    <td class=" "> {{$classes->students}} </td>
                                    <td class=" ">
                                        @if($classes->status == 'on')
                                        <label for="" style="color:#26B99A"><i class="material-icons">check_circle
                                            </i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i class="material-icons">not_interested
                                            </i></label>
                                        @endif
                                        @if(auth()->user()->group == "Admin")
                                    <td>{{auth()->user()->school->name}}</td>
                                    @endif
                                    </td class=" ">
                                    <td>


                                        {!! Form::open(['route' => ['classes.destroy', $classes->id], 'method' =>
                                        'delete', 'id' => 'delete_form'])!!}

                                        <div class="btn-group">
                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{!! url('print-class-single', [$classes->id]) !!}"
                                                        target="__blank"><i class="glyphicon glyphicon-print"></i>
                                                        Print</a></li>
                                                <li role="separator" class="divider"></li>

                                                <li> <a data-toggle="modal" data-target="#class-view-modal"
                                                        data-batch_id="{{$classes->id}}"
                                                        data-class_name="{{$classes->class_name}}"
                                                        data-class_code="{{$classes->class_code}}"
                                                        data-created_at="{{$classes->created_at}}"
                                                        data-updated_at="{{$classes->updated_at}}"><i
                                                            class="glyphicon glyphicon-eye"></i> View</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li> <a href="{!! route('classes.edit', [$classes->id]) !!}"><i
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
        //     url: "{{ url('classes/status/update') }}",
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