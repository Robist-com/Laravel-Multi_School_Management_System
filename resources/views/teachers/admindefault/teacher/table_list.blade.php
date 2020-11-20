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
                      @foreach ($teacherList as $key => $teacher)
                        <tr>
                          <td>
                          <th><input type="checkbox" id="check-all" class="flat"></th>
                      </td>
                      <td>{{$teacher->roll_no}}</td>
                      <td>{{$teacher->faculty_name}}</td>
                      <td>{{$teacher->department_name}}</td>
                      <td><a  href="{!! route('teachers.show', [$teacher->teacher_id]) !!}" class='btn btn-default btn-xs'title="View Profile">
                        {!! $teacher->first_name !!} {!! $teacher->last_name !!}</td>
                      <td>{{date('y-M-d', strtotime($teacher->dob))}}</td>
                      <td>{{$teacher->phone}}</td>
                      <td>
                  <div class='btn-group'>
                  <a href="{!! url('student/fee/list/collection/payment', [$teacher->student_id]) !!}" class="btn btn-success  btn-xs" title="Pay Salary"><i class="fa fa-usd"></i></a>
                  <!-- <a href="{!! url('student/fee/list/collection/payment', [$teacher->student_id]) !!}" class="btn btn-warning  btn-xs" title="Promote Student"><i class="far fa-paper-plane"></i></a> -->
                  <!-- <button type="button" class="btn btn-primary btn-xs accordion-toggle"  data-toggle="collapse"
                  data-target="#demo{{$key}}" title="View"><span class="fa fa-eye"></span></button> -->
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

                <div class="row">

<p>Media gallery design emelents</p>
  @foreach($teacherList as $teacher)
<div class="col-md-55">
  <div class="thumbnail">
    <div class="image view view-first">
      <img style="width: 100%; display: block;" src="{{asset('teacher_images/' .$teacher->image)}}" alt="image" />
      <div class="mask">
        <p> {!! $teacher->first_name !!} {!! $teacher->last_name !!}</p>
        <div class="tools tools-bottom">

          <a href="{!! route('teachers.show', [$teacher->teacher_id]) !!}" data-toggle="tooltip" data-placement="top" title="view details"><i class="fa fa-eye"></i></a>
          <a href="{!! url('student/fee/list/collection/payment', [$teacher->student_id]) !!}" data-toggle="tooltip" data-placement="top" title="Pay salary"><i class="fa fa-money"></i></a>
      </div>
      </div>
    </div>
    <div class="caption">
      <p>{{$teacher->roll_no}}</p>
      <p>{{$teacher->department_name}}</p>
    </div>
  </div>
</div>
@endforeach
</div>
              