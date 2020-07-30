@include('table_style')
<div class="table-responsive">
<div class="panel">
<h3 style="font-weight:bold"><i class="fa fa-building"></i> MANAGE CLASS GROUP</h3>
<hr class="line">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>

    <table class="table table-striped table-bordered table-hover" id="departments-table">
        <thead>
            <tr>
                <th>Student Group</th>
        <th>Class Group Name</th>
        <th align="center">Class Group Code</th>
        <th> Description</th>
        <th> Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($departments as $department)
            <tr>
                <td>{!! $department->faculty_name !!}</td>
            <td  >{!! $department->department_name !!}</td>
            <td align="center"><i class="badge badge-info sm-1">{!! $department->department_code !!}</i> </td>
            <td>{!! $department->department_description !!}</td>

            <td style="text-align:center">
                    <input type="checkbox" data-id="{{ $department->department_id }}" name="status" 
                    class="js-switch" {{ $department->department_status == 1 ? 'checked' : '' }}>
            </td>

                <td>
                    {!! Form::open(['route' => ['departments.destroy', $department->department_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('print-department-single', [$department->department_id]) !!}" target="__blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('departments.show', [$department->department_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('departments.edit', [$department->department_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
