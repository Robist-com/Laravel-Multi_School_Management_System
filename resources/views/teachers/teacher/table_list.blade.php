<div class="table-responsive" id="show-teacher-list">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:50px;">Roll No.</th>
                <th>Department</th>
                <th>Class</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th colspan="3">Action </th>
              </tr>
            </thead>
            <tbody id="items">
              @foreach ($teacherList as $key => $teacher)
              <tr>
                <td>{{$teacher->roll_no}}</td>
                <td>{{$teacher->faculty_name}}</td>
                <td>{{$teacher->department_name}}</td>
                <td><a  href="{!! route('teachers.show', [$teacher->teacher_id]) !!}" class='btn btn-default btn-xs'title="View Profile">
                  {!! $teacher->first_name !!} {!! $teacher->last_name !!}</td>
                <td>{{date('y-M-d', strtotime($teacher->dob))}}</td>
                <td>{{$teacher->phone}}</td>
                <td>
                  <div class='btn-group'>
                  <a href="{!! url('student/fee/list/collection/payment', [$teacher->student_id]) !!}" class="btn btn-success  btn-xs" title="Pay Fee"><i class="fa fa-usd"></i></a>
                  <a href="{!! url('student/fee/list/collection/payment', [$teacher->student_id]) !!}" class="btn btn-warning  btn-xs" title="Promote Student"><i class="far fa-paper-plane"></i></a>
                  <button type="button" class="btn btn-primary btn-xs accordion-toggle"  data-toggle="collapse"
                  data-target="#demo{{$key}}" title="View"><span class="fa fa-eye"></span></button>
                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'title'=>'Delete', 'onclick' => "return confirm('Are you sure?')"]) !!}
                      
                  </div>
                  {!! Form::close() !!}
                </td>
              </tr>
              @endforeach
          </tbody>
      </table>