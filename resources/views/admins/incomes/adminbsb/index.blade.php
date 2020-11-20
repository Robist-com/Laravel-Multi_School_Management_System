<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>INCOMES </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <a href="{{route('income.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a>
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($income))
                    <h2>Update Incomes</h2>
                    @else
                    <h2>Create Incomes</h2>
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
                    @if(isset($income))
                    {!! Form::model($income, ['route' => ['income.update', $income->id], 'method' => 'post', 'class' =>
                    'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    @else
                    {!! Form::open(['route' => 'income.store', 'class' => 'form-horizontal form-label-left', 'enctype'
                    => 'multipart/form-data']) !!}
                    @csrf
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control bootstrap-select" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($income)){{$income->school_id == $school->id ? 'selected' : ''}} @endif>
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
                            <label for="">Income Type <b style="color:red">*</b></label>
                            <select name="income_type_id" id="income_type_id" class="form-control bootstrap-select"
                                id="bootstrap-select">
                                <option value="0" selected="true" disabled="true" style="margin-right:20px">Select
                                    Income Type</option>
                                @foreach($inc_type as $key => $type)
                                <option value="{{$type->id}}" @if(isset($income))
                                    {{$type->id == $income->income_type_id ? 'selected' : ''}} @endif>{{$type->type}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">Income Name <b style="color:red">*</b></label>
                            <div class="form-line">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"
                                    @if(isset($income)) value="{{$income->name}}" @endif autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">Income Invoice Number <b style="color:red">*</b></label>
                            <div class="form-line">
                                <input type="text" name="invoice_number" id="invoice_number" class="form-control"
                                    placeholder="Enter Invoice Number" @if(isset($income))
                                    value="{{$income->invoice_number}}" @endif autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">Income Date <b style="color:red">*</b></label>
                            <div class="form-line">
                                <input type="text" name="date" id="date" class="form-control" placeholder="Enter Name"
                                    @if(isset($income)) value="{{$income->date}}" @endif autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">Income Amount <b style="color:red">*</b></label>
                            <div class="form-line">
                                <input type="number" name="amount" id="amount" class="form-control"
                                    placeholder="Enter Name" @if(isset($income)) value="{{$income->amount}}" @endif
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">Income Document <b style="color:red">*</b></label>
                            <div class="form-line">
                                <input type="file" name="file_document" id="file" class="form-control"
                                    placeholder="Enter Name" @if(isset($income)) value="{{$income->file}}" @endif
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="">Income Description <b style="color:red">*</b></label>
                            <div class="form-line">
                                {!! Form::textarea('description', null, ['class' => 'form-control border', 'cols' => 40,
                                'rows' =>2, 'placeholder'=> ' Description', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select name="status" id="status" class="form-control bootstrap-select">
                                @if(isset($income))
                                <option value="1" @if($income->status == 1) selected @endif> Active </option>
                                <option value="0" @if($income->status == 0) selected @endif> In Active </option>
                                @else
                                <option value="1"> Active </option>
                                <option value="0"> In Active </option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if(isset($income))
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

                    @if(isset($income))
                    <h2>Update Incomes</h2>
                    @else
                    <h2>Create Incomes</h2>
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

                    <!-- <div class="table-responsive"> -->
                    <!-- <table class="table table-striped jambo_table bulk_action"> -->
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive js-exportable"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">Name</th>
                                <th class="column-title">Invoice Number</th>
                                <th class="column-title">date</th>
                                <th class="column-title">Type</th>
                                <th class="column-title">Amount</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($incomes as $income)
                            <tr class="even pointer">
                                <td class="">{!! $income->name !!}</td>
                                <td class="">{!! $income->invoice_number !!}</td>
                                <td class="">{!!date('d/m/Y', strtotime( $income->date)) !!}</td>

                                <td>{!! $income->type!!}</td>
                                <td class="">{!! $income->amount !!}</td>

                                <td>

                                {!! Form::open(['route' => ['levels.destroy', $income->id], 'method' =>
                                        'delete', 'id' => 'delete_form'])!!}

                                        <div class="btn-group">
                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{!! url('print-class-single', [$income->id]) !!}"
                                                        target="__blank"><i class="glyphicon glyphicon-print"></i>
                                                        Print</a></li>
                                                <li role="separator" class="divider"></li>

                                                <li> <a data-toggle="modal" data-target="#class-view-modal"
                                                        data-batch_id="{{$income->id}}"
                                                        data-class_name="{{$income->class_name}}"
                                                        data-class_code="{{$income->class_code}}"
                                                        data-created_at="{{$income->created_at}}"
                                                        data-updated_at="{{$income->updated_at}}"><i
                                                            class="glyphicon glyphicon-eye"></i> View</a></li>

                                                <li role="separator" class="divider"></li>

                                                <li> <a href="{!! route('income.edit', [$income->id]) !!}"><i
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
        <!-- </div> -->
    </div>



    <div class="modal fade" id="income-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-head">Add New Income Type</span> </h4>
                </div>
                <form action="{{route('incometype.store')}}" method="POST" id="frm-level-create"
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
                                        @if(isset($income)){{$income->school_id == $school->id ? 'selected' : ''}}
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
                            <label for="">Income Type <b style="color:red">*</b></label>
                            {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Enter Income
                            Type']) !!}
                        </div>
                        <!-- Submit Field -->
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                        {!! Form::submit('Create Income Type', ['class' => 'btn btn-success']) !!}
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
                <form action="{{route('levels.update','$income->id')}}" method="post">
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

@section('js')

<script>
$('#date').datetimepicker({
    format: 'Y-m-d'
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

$('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>

@endsection