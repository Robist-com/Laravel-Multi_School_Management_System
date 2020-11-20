<div class="page-title">
    <div class="title_left">
        <h2>Manage Session</h2>
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
                @if(isset($batch))
                <h2>Update Session</h2>
                @else
                <h2>Create Session</h2>
                @endif
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <a href="{{route('batches.index')}}"><button type="submit" class="btn btn-round btn-success"><i
                                class="fa fa-plus-circle" aria-hidden="true"> Add </i></button></a>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if(isset($batch))
                {!! Form::model($batch, ['route' => ['batches.update', $batch->id], 'method' => 'patch', 'class' =>
                'form-horizontal form-label-left']) !!}
                @else
                {!! Form::open(['route' => 'batches.store', 'class' => 'form-horizontal form-label-left']) !!}
                @endif

                @if(auth()->user()->group == "Admin")
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <select class="form-control" name="school_id" id="school_id">
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
                        <input type="text" name="batch" id="batch" class="form-control" placeholder="Enter Batch"
                            @if(isset($batch)) value="{{$batch->batch}}" @endif>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Batch name"
                            @if(isset($batch)) value="{{$batch->name}}" @endif>
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if(isset($batch))
                        {!! Form::hidden('is_current_batch', '0') !!}
                        {!! Form::checkbox('is_current_batch', '1', null, ['class' => 'flat']) !!} Is Current Session
                        @else
                        <!-- <label class="checkbox-inline"> -->
                        {!! Form::hidden('is_current_batch', '0') !!}
                        {!! Form::checkbox('is_current_batch', '1', null, ['class' => 'flat']) !!} Is Current Session
                        <!-- </label> -->
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    @if(isset($batch))
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
                <h2>Table Session </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <a class="btn btn-success btn-round" data-toggle="modal" data-target="#batch-add-modal"><i
                            class="fa fa-plus-circle" aria-hidden="true"> Add New Batch</i></a>
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
                                <th class="column-title">Session </th>
                                <th class="column-title">Name </th>
                                <th class="column-title">Is Current </th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                                @if($session)
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                            class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                                @else
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                            class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($batches as $batch)
                            @if($batch->is_current_batch == 1)
                            <tr class="even pointer" style="background-color:aqua">

                                <td class="a-center ">
                                    <input type="checkbox" checked disabled class="flat" name="table_records">
                                </td>
                                <td class=" ">{{ $batch->batch }}</td>
                                <td class=" ">{{ $batch->name }}</td>

                                <td>
                                    @if($batch->is_current_batch == '1')
                                    <label for="" style="color:#26B99A"><i
                                            class="fa fa-check-circle fa-lg"></i></i></label>
                                    @else
                                    <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                                    @endif
                                </td>
                                <td class=" ">
                                    {!! Form::open(['route' => ['batches.destroy', $batch->id], 'method' => 'delete'])
                                    !!}
                                    <div class='btn-group'>
                                        <a href="{!! url('print-batches-single', [$batch->id]) !!}" target="__blank"
                                            class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>

                                        <!-- ---------------------------------------here is the batch view button code ---------------------------------------- -->
                                        <a data-toggle="modal" data-target="#batch-view-modal"
                                            data-batch_id="{{$batch->id}}" data-year="{{$batch->batch}}"
                                            data-created_at="{{$batch->created_at}}"
                                            data-updated_at="{{$batch->updated_at}}" class='btn btn-default btn-xs'>
                                            <i class="glyphicon glyphicon-eye-open"></i></a>
                                        <!-- -------------------------------------------------------------------- -->
                                        <!-- now lets save and see the output -->
                                        <a href="{!! route('batches.edit', [$batch->id]) !!}"
                                            class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' =>
                                        'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are
                                        you sure?')"]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @else
                            <tr class="even pointer">

                                <td class="a-center ">
                                    <input type="checkbox" class="flat" name="table_records">
                                </td>

                                <td class=" ">{{ $batch->batch }}</td>
                                <td class=" ">{{ $batch->name }}</td>
                                <td>
                                    @if($batch->is_current_batch == '1')
                                    <label for="" style="color:#26B99A"><i
                                            class="fa fa-check-circle fa-lg"></i></i></label>
                                    @else
                                    <label for="" style="color:#D9534F"><i class="fa fa-ban fa-lg"></i></label>
                                    @endif
                                </td>
                                <td class=" ">
                                    {!! Form::open(['route' => ['batches.destroy', $batch->id], 'method' => 'delete'])
                                    !!}
                                    <div class='btn-group'>
                                        <a href="{!! url('print-batches-single', [$batch->id]) !!}" target="__blank"
                                            class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>

                                        <!-- ---------------------------------------here is the batch view button code ---------------------------------------- -->
                                        <a data-toggle="modal" data-target="#batch-view-modal"
                                            data-batch_id="{{$batch->id}}" data-year="{{$batch->batch}}"
                                            data-created_at="{{$batch->created_at}}"
                                            data-updated_at="{{$batch->updated_at}}" class='btn btn-default btn-xs'>
                                            <i class="glyphicon glyphicon-eye-open"></i></a>
                                        <!-- -------------------------------------------------------------------- -->
                                        <!-- now lets save and see the output -->
                                        <a href="{!! route('batches.edit', [$batch->id]) !!}"
                                            class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' =>
                                        'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are
                                        you sure?')"]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- INSERT HERE I WILL ADD THE MODAL AND SOME SCRIP FILES OKAY SO  JUST FOLLOW EME STEP BY STEP. -->

<!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
<div class="modal fade left" id="batch-view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-id-badge" aria-hidden="true"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="batch_id" id="batch_id">
                <!-- we are using this hidden id to fetch our data by id okay. -->

                <!-- batch Field -->
                <div class="form-group">
                    {!! Form::label('batch', 'Batch:') !!}
                    <input type="text" name="batch" id="batch" readonly>
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
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                {!! Form::submit('Create Batch', ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </div>
</div>
</div>


@section('scripts')

<script>
// {{-----------Level view Side------------------}} 
$('#batch-view-modal').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var year = button.data('year')
    var created_at = button.data('created_at')
    var updated_at = button.data('updated_at')
    var batch_id = button.data('batch_id')

    var modal = $(this)

    modal.find('.modal-title').text('VIEW BATCH INFORMATION');
    modal.find('.modal-body #year').val(year);
    modal.find('.modal-body #created_at').val(created_at);
    modal.find('.modal-body #updated_at').val(updated_at);
    modal.find('.modal-body #batch_id').val(batch_id);
});

// this is just bootstrap simple code you can read the bootstrap modal.find okay.


$(document).ready(function() {
    $('.js-switch').change(function() {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let batchId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('
            batch / status / update ') }}',
            data: {
                'status': status,
                'batch_id': batchId
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