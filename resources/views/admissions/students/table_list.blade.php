<div class="content">
<div class="table-responsive" id="show-student-list">

          <table class="table table-hover">
            <thead>
            <button style="margin-bottom: 10px; display:none" class="btn btn-danger delete_all" data-url="{{ url('delete_multiple_student') }}"><i class="fa fa-trash"></i> Delete All Selected</button>
            <b class="btn btn-sm pull-right" id="divoutput"></b>
              <tr>
                <th width="50px"><input type="checkbox" id="master" style="display:none"></th>
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
              @foreach ($allStudentList as $key => $student)
              <tr id="tr_{{$student->id}}" class="contact">
                <td><input type="checkbox" class="sub_chk" data-id="{{$student->id}}"></td>
                <td>{{$student->username}}</td>
                <td>{{$student->department_name}}</td>
                <td>{{$student->class_name}}</td>
                <td>{{$student->first_name ." ". $student->last_name}}</td>
                <td>{{$student->dob}}</td>
                <td>{{$student->phone}}</td>
                <td>
                  {!! Form::open(['route' => ['admissions.destroy', $student->id], 'method' => 'delete']) !!}
                  <div class='btn-group'>
                  <a href="{!! url('student/fee/list/collection/payment', [$student->student_id]) !!}" class="btn btn-success  btn-xs" title="Pay Fee"><i class="fa fa-usd"></i></a>
                  <a href="{!! url('student/fee/list/collection/payment', [$student->student_id]) !!}" class="btn btn-warning  btn-xs" title="Promote Student"><i class="far fa-paper-plane"></i></a>
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


</div>