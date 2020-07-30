<div class="content">
<div class="table-responsive">
<div  id="wait"></div>
    <table class="table table-striped1 table-hover" id="teachers-table">
        <thead>
        <button style="margin-bottom: 10px; display:none" class="btn btn-danger delete_all" data-url="{{ url('delete_multiple_teacher') }}"><i class="fa fa-trash"></i> Delete All Selected</button>
            <b class="btn btn-sm pull-right" id="divoutput"></b>
            <tr>
         <th width="50px"><input type="checkbox" id="master" style="display:none"></th>
         <th>Photo</th>
        <th>Full Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Phone</th>
        <th rowspan="2">Status</th>
        <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($teachers as $teacher)
            <tr id="tr_{{$teacher->id}}" class="contact">
            <td><input type="checkbox" class="sub_chk" data-id="{{$teacher->id}}"></td>
            <td><a  href="{!! route('teachers.show', [$teacher->teacher_id]) !!}" title="View Profile">
            <img src="{{asset('teacher_images/' .$teacher->image)}}" alt=""
                class="rounded-circle"  width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></a>
            </td>
            <td> 
            {!! $teacher->first_name !!} {!! $teacher->last_name !!}
            
            </td>
            <td> @if($teacher->gender == 0)Male @else Female @endif</td>
            <td>{!! $teacher->email !!}</td>
            <td>{!! $teacher->phone !!}</td>

            <td style="text-align:center">
                    <input type="checkbox" data-id="{{ $teacher->teacher_id }}" name="status"
                    class="js-switch" {{ $teacher->status == 1 ? 'checked' : '' }}>
            </td>
            <td colspan="3">
                    {!! Form::open(['route' => ['teachers.destroy', $teacher->teacher_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! url('mark-teacher-attendance', [$teacher->teacher_id]) !!}" title="Mark Attendance" target="_blank" title="Mark Attendance" class='btn btn-info btn-xs'> <i class="glyphicon glyphicon-calendar"></i></a>
                        <a href="{!! url('generate-teacher-timetable', [$teacher->teacher_id]) !!} " target="_blank" title="View TimeTable" class='btn btn-primary btn-xs'> <i class="far fa-calendar"></i></a>
                        <a href="{!! url('prints-teachers', [$teacher->teacher_id]) !!} " title="Print Teacher" target="_blank" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{!! route('teachers.edit', [$teacher->teacher_id]) !!}" title="Edit"  class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>



