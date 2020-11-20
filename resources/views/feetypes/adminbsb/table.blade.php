<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>MANAGE FEE TYPES </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <a href="{{route('feetypes.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a>
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($feetype))
                    <h2>Update Fee Type</h2>
                    @else
                    <h2>Create Fee Type</h2>
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

                    @if(isset($feetype))
                    {!! Form::model($feetype, ['route' => ['feetypes.update', $feetype->id], 'method' => 'post', 'class'
                    => 'form-horizontal form-label-left' , 'autocomplete' => 'off']) !!}
                    @else
                    {!! Form::open(['route' => 'feetypes.store', 'class' => 'form-horizontal form-label-left' ,
                    'autocomplete' => 'off']) !!}
                    @endif

                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select name="school_id" id="school_id" class="form-control">
                                @foreach(auth()->user()->school->all(); as $school)
                                <option value="{{$school->id}}" @if(isset($feetype)) @if($feetype->school_id ===
                                    $school->id )selected @endif @endif>{{$school->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="school_id" id="school_id" class="form-control"
                        placeholder="Enter Fee Type" value="{{auth()->user()->school->id}}">
                    @endif

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-line">
                                <input type="text" name="fee_type" id="fee_type" class="form-control"
                                    placeholder="Enter Fee Type" @if(isset($feetype)) value="{{$feetype->type}}" @endif
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if(isset($feetype))
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
                                    <th class="column-title">No</th>
                                    <th class="column-title">Fee Type</th>
                                    @if(auth()->user()->group == "Admin")
                                    <th class="column-title">School Name</th>
                                    @endif
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="column-title">No</th>
                                    <th class="column-title">Fee Type</th>
                                    @if(auth()->user()->group == "Admin")
                                    <th class="column-title">School Name</th>
                                    @endif
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($feetypes as $key => $feetype)
                                <tr class="even pointer">

                                    <td class="">{!! $key+1 !!}</td>
                                    <td class="">{!! $feetype->type !!}</td>
                                    @if(auth()->user()->group == "Admin")
                                    <td>{!! $feetype->name !!}</td>
                                    @endif

                                    <td colspan="3">
                                        {!! Form::open(['route' => ['feetypes.delete', $feetype->id], 'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a href="{!! route('feetypes.edit', [$feetype->id]) !!}">
                                                        <i class="glyphicon glyphicon-print"></i> Print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('feetypes.edit', [$feetype->id]) !!}">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('feetypes.edit', [$feetype->id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {{$feetype->type}} ?"><i
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


    @section('js')

    <script>
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

    $(document).ready(function() {
        $('.js-switch').change(function() {
            let status = $(this).prop('checked') === true ? 'on' : 'off';
            let levelId = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ url('
                level / status / update ') }}',
                data: {
                    'status': status,
                    'level_id': levelId
                },
                success: function(data) {
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