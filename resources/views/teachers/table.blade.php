<div class="content">
<div class="table-responsive">
<div  id="wait"></div>
<table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
              <th>
                  <input type="checkbox" id="check-all" class="flat">
              </th>
   
         <th>Photo</th>
        <th>Full Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th class="column-title no-link last"><span class="nobr">Action</span>
              <th class="bulk-actions" colspan="8">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
              </th>
            </tr>
        </thead>
        <tbody>
        @foreach($teachers as $teacher)
        <tr class="even pointer">
              <td class="a-center ">
              <input type="checkbox" class="flat" name="table_records">
              </td>
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

            <td style="text-align:center1">
            @if($teacher->status == 1) <i class="fa fa-check-circle fa-lg" style="background:green"></i> @else <i class="fa fa-ban fa-lg" style="background:red"></i> @endif</td>
            <td>
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
</div>
<!-- </div> -->



