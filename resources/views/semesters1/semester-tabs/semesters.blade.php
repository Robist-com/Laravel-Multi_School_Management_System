<table class="table table-hover" id="semesters">
        <thead>
        <button style="margin-bottom: 10px; display:none" class="btn btn-danger delete_all" data-url="{{ url('delete_multiple_class') }}"><i class="fa fa-trash"></i> Delete All Selected</button>
            <b class="btn btn-sm pull-right" id="divoutput"></b>
            <tr>
                <th width="50px"><input type="checkbox" id="master" style="display:none"></th>
                <th>Grade</th>
                <th>Code</th>
                <th >Duration</th>
                <th style="text-align:center">Status</th>
                <th >Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($semesters as $key => $semester)
         @if($semester->status == "on")
            <tr id="tr_{{$semester->id}}" class="contact">
            <td><input type="checkbox" class="sub_chk" data-id="{{$semester->id}}"></td>
            <td >{{$semester->semester_name}}</td>
            <td >{{$semester->semester_code}}</td>
            <td >{{$semester->semester_duration}}</td>
            <!-- <td >{{$semester->degree_name}}</td> -->
            @if($semester->status == 'on')
            <td ><label class="btn btn-success">Active</label></td>
            @else
            <td ><label class="btn btn-danger">In-Active</label></td>
        @endif
        <td >
                   {!! Form::open(['route' => ['semesters.destroy', $semester->id], 'method' => 'delete']) !!}
                   <div class='btn-group'>
                   <!-- <a data-toggle="modal" data-target="#degree-show" title="Assign Degree" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-plus"></i></a> -->
                   <!-- --------------------------------------------------------------------------------- -->
                   <a data-toggle="modal" data-target="#semester_view_modal" 
                      data-semester_name="{!! $semester->semester_name !!}"
                      data-semester_id="{!! $semester->id !!}"  
                      data-semester_code="{!! $semester->semester_code !!}"
                      data-semester_duration="{!! $semester->semester_duration !!}" 
                      data-semester_description="{!! $semester->semester_description !!}" 
                      data-created_at="{!! $semester->created_at !!}"
                      data-updated_at="{!! $semester->updated_at !!}" 
                      class='btn btn-warning btn-xs'> 
                    <i class="glyphicon glyphicon-eye-open"></i></a>

                    
                       <a href="{!! route('semesters.edit', [$semester->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                       {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                   </div>
                   {!! Form::close() !!}
               </td>
           </tr>
          @endif
          @endforeach
          </tbody>
       <tr>
       <td>
       <label class="btn btn-success">you have <b>({{$count_active_grade}})</b> Active Grades </label></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       </tr>
     </table>








   