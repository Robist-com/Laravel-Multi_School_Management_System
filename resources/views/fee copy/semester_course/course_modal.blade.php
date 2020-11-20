   <!-- Modal -->
   <div class="modal fade" id="classschedule-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" 
            aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-user-o">Generate a Class For Teacher</i></h4>
            </div>
      <div class="modal-body">
	  <div class="panel-body">
      {!! Form::open(array('route' => 'insertCourse', 'id'=> 'mult', 'method'=>'post')) !!}
        @csrf
        <div class="" id='note'></div>
	  <div class="col-md-4">
            <select name="semester_id" id="semester_id" class="form-control select_2_single">
                <option value="" selected disabled>Select Semester</option>
                    @foreach($semesters as $key => $semester)
                <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                @endforeach
            </select>
	  </div>
	  <div class="col-md-4">
      <select name="department_id" id="department_id" class="form-control select_2_single">
                    <option value="" selected disabled>Select Department</option>
                    @foreach($departments as $key => $department)
                <option value="{{$department->department_id}}">{{$department->department_name}}</option>
                @endforeach
            </select>
	  </div>
      <div class="col-md-4">
      <select name="level_id" id="level_id" class="form-control select_2_single">
                <option value="" selected disabled>Select Degree</option>
                    @foreach($levels as $key => $level)
                <option value="{{$level->level_id}}">{{$level->level}}</option>
                @endforeach
            </select>
	  </div>
	  </div>
      @if($classAssignings)
	  <div class="table-responsive">
        <table class="table table-striped table-hover" id="classAssignings">
    	<thead>
        <tr>
            <th><div class="form-group col-sm-1" id="multi_subjects">
			<label class="container2"style="height:3px;">All
            <input type="checkbox" name="multiclass">
			<span class="checkmark"></span>
			</label>
			</div></th>
            <th>Semester</th> 
            <th>Course</th>
            <th style="text-align: center; background:#ccc">Days</th>
            <th style="text-align: center; background:#ccc">Room and Class</th>
            <th>Teacher</th>

        </tr>
   		</thead>
			<tbody>
			@foreach ($classAssignings as $classAssigning)
			<tr>
			<td>
			<div class="form-group col-sm-1" id="multi_subjects">
			<label class="container2">
            <input type="checkbox" name="multiclass[]" value="{{$classAssigning->class_assign_id}}">
			<span class="checkmark"></span>
			</label>
			</div>
			</td>
            <td>
			<div class="top_row">
				<div>{!! $classAssigning->semester_name!!}</div>
				</div>
				<div class="top_row">
				<i class="badge badge-success"> {!! $classAssigning->batch !!}</i>
				</div>
			</td>
            <td>
    		<div class="top_row">
        		<div>{!! $classAssigning->course_name !!}</div>
        	</div>
        	<div class="top_row">
        		<i class="badge badge-success"> {!! $classAssigning->level !!}</i>
        	</div>
 			</td>
			<td>
			<div class="top_row">
				<div><i class="badge badge-success">{!! $classAssigning->name !!}</i>
				<i class="badge badge-success"> {!! $classAssigning->shift !!}</i></div>
				</div>
				<div class="top_row">
				<div><i class="badge badge-success"> {!! $classAssigning->time !!}</i> </div>
				</div>
			</td>

			<td> 
			<i class="badge badge-success">{!! $classAssigning->classroom_name !!}</i> 
			<i class="badge badge-success">{!! $classAssigning->class_name !!}</i>
			</td>
			<td >{!! $classAssigning->first_name !!} {!! $classAssigning->last_name !!}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
      </div>
      @endif
      </div>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
