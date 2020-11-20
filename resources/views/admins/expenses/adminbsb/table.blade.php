<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3> ADD EXPENSES TYPES </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <a href="{{route('expensestype.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a>

            <!-- <a class="btn bg-teal pull-right" data-toggle="modal" data-target="#expense-type"><i
                                class="fa fa-plus-circle" aria-hidden="true"> Add New</i></a> -->
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($expen_type))
                    <h2>Update expense Type</h2>
                    @else
                    <h2>Create expense Type</h2>
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
                    @if(isset($expen_type))
                    {!! Form::model($expen_type, ['route' => ['expensestype.update', $expen_type->id], 'method' =>
                    'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    @else
                    {!! Form::open(['route' => 'expensestype.store', 'class' => 'form-horizontal form-label-left',
                    'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control bootsrap-select" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($expen_type)){{$expen_type->school_id == $school->id ? 'selected' : ''}}
                                    @endif>
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
                            <label for="">expense Type <b style="color:red">*</b></label>
                            <div class="form-line">
                            <input type="text" name="type" id="type" class="form-control" placeholder="Enter Type"
                                @if(isset($expen_type)) value="{{$expen_type->type}}" @endif autocomplete="off">
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select name="status" id="status" class="form-control bootstrap-select">
                            @if(isset($expen_type))
                                <option value="1" @if($expen_type->status == 1) selected @endif> Active</option>
                                <option value="0" @if($expen_type->status == 0) selected @endif> In Active</option>
                                @else
                                <option value="1"> Active</option>
                                <option value="0"> In Active</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if(isset($expen_type))
                        {!! Form::submit('Save Changes', ['class' => 'btn bg-teal']) !!}
                        @else
                        <button type="submit" class="btn btn-round bg-teal">Save</button>
                        @endif
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>


            <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="header">

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
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive js-exportable"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">expense Type</th>
                                <th class="column-title">Created at</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expense_type as $expense)
                            <tr class="even pointer">
                                <td class="">{!! $expense->type !!}</td>
                                <td class="">{!!date('d/m/Y', strtotime( $expense->created_at)) !!}</td>
                                <td colspan="3">
                                        {!! Form::open(['route' => ['expensestype.delete', $expense->id],
                                        'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ACTION <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a href="{!! url('print-faculty-single', [$expense->id]) !!} "
                                                        target="_blank">
                                                        <i class="glyphicon glyphicon-print"></i> Print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a
                                                        href="{!! route('expensestype.detail', [$expense->id]) !!}">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a
                                                        href="{!! route('expensestype.edit', [$expense->id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {{$expense->type}} ?"><i
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
        <!-- </div> -->
    </div>



    <div class="modal fade" id="expense-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-head">Add New expense Type</span> </h4>
                </div>
                <form action="{{route('expensestype.store')}}" method="POST" id="frm-level-create"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @if(auth()->user()->group == "Admin")
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select class="form-control" name="school_id" id="school_id">
                                    <option>Choose School</option>
                                    @foreach (auth()->user()->school->all() as $school)
                                    <option value="{{ $school->id }}"
                                        @if(isset($expense)){{$expense->school_id == $school->id ? 'selected' : ''}}
                                        @endif>
                                        {{$school->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                        @endif
                        <!-- Level Field -->
                        <div class="form-group">
                            <label for="">expense Type <b style="color:red">*</b></label>
                            {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Enter expense
                            Type']) !!}
                        </div>
                        <!-- Submit Field -->
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                        {!! Form::submit('Create expense Type', ['class' => 'btn btn-success']) !!}
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
                <form action="{{route('levels.update','$expense->id')}}" method="post">
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
</div>
@endsection

@section('js')

<script>
$('#date').datetimepicker({
    format: 'Y-m-d'
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

// $(document).ready(function(){
//     $('.js-switch').change(function () {
//         let status = $(this).prop('checked') === true ? 'on' : 'off';
//         let levelId = $(this).data('id');
//         $.ajax({
//             type: "GET",
//             dataType: "json",
//             url: '{{ url('level/status/update') }}',
//             data: {'status': status, 'level_id': levelId},
//             success: function (data) {
//                 console.log(data.message);
//                 // success: function (data) {
//                 toastr.options.closeButton = true;
//                 toastr.options.closeMethod = 'fadeOut';
//                 toastr.options.closeDuration = 100;
//                 toastr.success(data.message);
// // }
//             }
//         });
//     });
// }) 
</script>