<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3>LEVELS </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('levels.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a>
        </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($level))
                    <h2>Update level</h2>
                    @else
                    <h2>Create level</h2>
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
                    @if(isset($level))
                    {!! Form::model($level, ['route' => ['levels.update', $level->id], 'method' => 'patch', 'class' =>
                    'form-horizontal form-label-left' , 'autocomplete' => 'off', 'id' => 'form_validation']) !!}
                    @else
                    {!! Form::open(['route' => 'levels.store', 'class' => 'form-horizontal form-label-left' ,
                    'autocomplete' => 'off', 'id' => 'form_validation']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="" class="error">*</label>
                            <select class="form-control bootstrap-select" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($level)){{$level->school_id == $school->id ? 'selected' : ''}} @endif>
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
                        <label for="" >Grade <b class="error">*</b></label>
                            <select name="semester_id" id="semester_id" class="form-control bootstrap-select"
                                id="select_2_single" required>
                                <option value="" selected="true" disabled="true" style="margin-right:20px">Select Grade</option>
                                @foreach($semester as $key => $semester)
                                <option value="{{$semester->id}}" @if(isset($level))
                                    {{$semester->id == $level->grade_id ? 'selected' : ''}} @endif>
                                    {{$semester->semester_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="" >Level <b class="error">*</b></label>
                            <div class="form-line">
                                <input type="text" name="level" id="level" class="form-control"
                                    placeholder="Enter Level" @if(isset($level)) value="{{$level->level}}" @endif
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="" >Subject <b class="error">*</b></label>
                            <select name="course_id[]" id="course_id" class="form-control bootstrap-select" multiple
                                data-hide-disabled="true" data-size="5" id="subject_class" required>
                                <option value="" selected="true" disabled="true">Select Subject</option>
                                @foreach($course as $key => $cour)
                                <option value="{{$cour->id}}" @if(isset($level))
                                    {{$cour->id == $level->course_id ? 'selected' : ''}} @endif>{{$cour->course_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="" >Description </label>
                            <div class="form-line">
                                {!! Form::textarea('level_description', null, ['class' => 'form-control date', 'cols' =>
                                40,
                                'rows' =>2, 'placeholder'=> 'Level Description']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="" >Status <b class="error">*</b></label>
                            @if(isset($level))
                            <select class="form-control bootstrap-select" name="status" id="status">
                                <option value="on" @if($level->status == 'on') selected @endif>
                                    Active </option>
                                <option value="off" @if($level->status == 'off') selected @endif>
                                    In active </option>
                            </select>
                            @else
                            <select class="form-control bootstrap-select" name="status" id="status" required>
                                <option value="on"> Active </option>
                                <option value="off"> In active </option>
                            </select>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    @if(isset($level))
                    {!! Form::submit('Save Changes', ['class' => 'btn bg-teal']) !!}
                    @else
                    <button type="submit" class="btn btn-round bg-teal">Save</button>
                    @endif
                </div>

                {!! Form::close() !!}

            </div>
        </div>
        <!-- </div> -->

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
                                    <th class="column-title">Grade</th>
                                    <th class="column-title">Level</th>
                                    <th class="column-title">Subject</th>
                                    <th class="column-title">Description</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="column-title">Grade</th>
                                    <th class="column-title">Level</th>
                                    <th class="column-title">Subject</th>
                                    <th class="column-title">Description</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($levels as $level)
                                <tr class="even pointer">

                                    <td class="">{!! $level->grade['semester_name'] !!}</td>
                                    <td class="">{!! $level->level !!}</td>

                                    <td>{!! $level->course['course_name'] !!}</td>
                                    <td class="text-center">@if($level->level_description == "") -------------- @else {!! $level->level_description !!} @endif</td>

                                    <td>
                                        @if($level->status == 'on')
                                        <label for="" style="color:#26B99A"><i
                                                class="material-icons">check_circle</i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="material-icons">not_interested</i></label>
                                        @endif
                                    </td>

                                    <td colspan="3">
                                        {!! Form::open(['route' => ['levels.destroy', $level->id], 'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a data-level_id="{{$level->id}}" data-level="{{$level->level}}"
                                                        data-level_description="{{$level->level_description}}"
                                                        data-course_id="{{$level->course['course_name']}}"
                                                        data-created_at="{{$level->created_at}}"
                                                        data-updated_at="{{$level->updated_at}}" data-toggle="modal"
                                                        data-target="#level-show">
                                                        <i class="glyphicon glyphicon-print"></i> print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a data-level_id="{{$level->id}}" data-level="{{$level->level}}"
                                                        data-level_description="{{$level->level_description}}"
                                                        data-course_id="{{$level->course['course_name']}}"
                                                        data-created_at="{{$level->created_at}}"
                                                        data-updated_at="{{$level->updated_at}}" data-toggle="modal"
                                                        data-target="#level-show">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('levels.edit', [$level->id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                <a id="delete_link" href="#"
                                                    data-confirm= "Are you sure want to delete {{$level->level}} ?"><i
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



    <div class="modal fade" id="level-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-level-up">Add New Level</span> </h4>
                </div>
                <form action="{{route('levels.store')}}" method="POST" id="frm-level-create">
                    <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
                    <div class="modal-body">

                        <!-- Level Field -->
                        <div class="form-group">
                            <!-- {!! Form::label('level', 'Level:') !!} -->
                            {!! Form::text('level', null, ['class' => 'form-control', 'placeholder' => 'Enter Level
                            Here']) !!}
                        </div>
                        <input type="hidden" id="level_id" name="level_id">
                        <!-- Course Id Field -->
                        <div class="form-group">
                            <!-- {!! Form::label('course_id', 'Course:') !!} -->
                            <!-- {!! Form::number('course_id', null, ['class' => 'form-control']) !!} -->
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="">Select Course</option>
                                @foreach($course as $key => $cour)
                                <option value="{{$cour->id}}">{{$cour->course_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Level Description Field -->
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="level_description"
                                id="level_description"></textarea>
                            <!-- {!! Form::text('level_description', null, ['class' => 'form-control', 'cols' => 40, 'rows' =>2, 'placeholder'=> 'Level Description']) !!} -->
                        </div>

                        <!-- Submit Field -->
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                        {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ----------------------------------------------------------------------------------------------------------------- -->
    <div class="modal fade" id="level-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-level-up">Add New Level</span> </h4>
                </div>
                <form action="{{route('levels.update','$level->id')}}" method="post">
                    @csrf
                    @method('PUT')
                    <!-- <form action="{{route('levels.store')}}" method="POST" id="frm-level-create"> -->
                    <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
                    <div class="modal-body" style="background:#EEEEEE">

                        <!-- Level Field -->
                        <div class="form-group">
                            {!! Form::label('level', 'Level:') !!}
                            {!! Form::text('level', null, ['class' => 'form-control', 'placeholder' => 'Enter Level
                            Here','readonly']) !!}
                        </div>
                        <input type="hidden" id="level_id" name="level_id">
                        <!-- Course Id Field -->
                        <div class="form-group">
                            {!! Form::label('course_id', 'Course Name:') !!}
                            <input type="text" name="course_id" id="course_id" class="form-control" readonly>
                        </div>
                        <!-- Level Description Field -->
                        <div class="form-group">
                            <label for="level_description">Level Description:</label>
                            <input type="text" class="form-control" name="level_description" id="level_description"
                                readonly>
                            <!-- {!! Form::text('level_description', null, ['class' => 'form-control', 'cols' => 40, 'rows' =>2, 'placeholder'=> 'Level Description']) !!} -->
                        </div>

                        <!-- Created At Field -->
                        <div class="form-group">
                            {!! Form::label('created_at', 'Created At:') !!}
                            <input type="text" class="form-control" name="created_at" id="created_at" readonly>
                        </div>

                        <!-- Updated At Field -->
                        <div class="form-group">
                            {!! Form::label('updated_at', 'Updated At:') !!}
                            <input type="text" class="form-control" name="updated_at" id="updated_at" readonly>
                        </div>
                        <!-- Submit Field -->
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                        <!-- {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!} -->
                    </div>
                </form>
            </div>
        </div>
    </div>


    @section('js')

    <script type="text/javascript">
    $(document).ready(function() {

        // {{--------------------------Level Side-------------------------}} 
        $('#level-edit').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget)
            var level = button.data('level')
            var course_id = button.data('course_id')
            var level_description = button.data('level_description')
            var level_id = button.data('level_id')

            var modal = $(this)

            modal.find('.modal-title').text('EDIT LEVEL INFORMATION');
            modal.find('.modal-body #level').val(level);
            modal.find('.modal-body #course_id').val(course_id);
            modal.find('.modal-body #level_description').val(level_description);
            modal.find('.modal-body #level_id').val(level_id);
        });

        // {{--------------------------Level view Side-------------------------}} 
        $('#level-show').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget)
            var level = button.data('level')
            var course_id = button.data('course_id')
            var level_description = button.data('level_description')
            var created_at = button.data('created_at')
            var updated_at = button.data('updated_at')
            var level_id = button.data('level_id')

            var modal = $(this)

            modal.find('.modal-title').text('VIEW LEVEL INFORMATION');
            modal.find('.modal-body #level').val(level);
            modal.find('.modal-body #course_id').val(course_id);
            modal.find('.modal-body #level_description').val(level_description);
            modal.find('.modal-body #created_at').val(created_at);
            modal.find('.modal-body #updated_at').val(updated_at);
            modal.find('.modal-body #level_id').val(level_id);
        });

        var deleteLinks = document.querySelectorAll('#delete_link');

        for (var i = 0; i < deleteLinks.length; i++) {
            deleteLinks[i].addEventListener('click', function(event) {
                event.preventDefault();

                var choice = confirm(this.getAttribute('data-confirm'));

                if (choice) {
                      document.getElementById("delete_form").submit(); //form id
                }
            });
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