<div class="content">
                  <div class="table-responsive" id="show-teacher-list">
                  <table id="datatable-checkbox" class="table table-striped table-bordered jambo_table bulk_action">
                      <thead>
                        <tr>
                          <th>
                        <th><input type="checkbox" id="check-all" class="flat"></th>
                        </th>
                        <th>Roll No.</th>
                        <th>Department</th>
                        <th>Class</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Phone</th>
                        <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach ($allStudentList as $key => $student)
                        <tr>
                          <td>
                          <th><input type="checkbox" id="check-all" class="flat"></th>
                      </td>
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
                          <a href="{{route('admissions.edit', [$student->student_id])}}"> <button type="button" class="btn btn-primary btn-xs "
                            title="View"><span class="fa fa-pencil"></span></button></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'title'=>'Delete', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            </div>
                            {!! Form::close() !!}
                </td>
                        </tr>
                        @endforeach
              </tbody>
                  
              </table>
                  </div>
                </div>
              