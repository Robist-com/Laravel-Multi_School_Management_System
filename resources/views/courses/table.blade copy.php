@include('table_style')
<div class="table-responsive">
<div class="panel">
<h1 style="font-weight:bold"><i class="fa fa-user-o"></i> MANAGE SUBJECTS</h1>
<hr class="line">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>
    <table class="table table-striped table-bordered table-hover" id="courses-table">
        <thead>
            <tr>
        <th>Subject Name</th>
        <th>Code</th>
        <th>Class</th>
        <th>Department</th>
        <th>Describtion</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{!! $course->course_name !!}</td>
            <td class="badge">{!! $course->course_code !!}</td>
            <td>{!! $course->class_name !!}</td>
            <td>{!! $course->department_name !!}</td>
            <td>{!! $course->describtion !!}</td>
            <td >
                <input type="checkbox" data-id="{{ $course->id }}" name="status" 
                class="js-switch" {{ $course->status == 1 ? 'checked' : '' }}>
                <!-- <input type="checkbox" data-id="{{ $course->id }}" name="status" 
                class="js-switch" {{ $course->status == 1 ? 'checked' : '' }}> -->
                </td>
                <td>
                    {!! Form::open(['route' => ['courses.destroy', $course->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="#" data-toggle="modal"  data-target="#level-add" class='btn btn-success btn-xs' title="Add Level"><i class="glyphicon glyphicon-plus"></i></a>
                        <a href="{!! route('courses.show', [$course->id]) !!}" class='btn btn-default btn-xs'title="Print"><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('courses.show', [$course->id]) !!}" class='btn btn-warning btn-xs'title="View"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('courses.edit', [$course->id]) !!}" class='btn btn-info btn-xs' title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title'=> 'Delete', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{-- </div> --}}

