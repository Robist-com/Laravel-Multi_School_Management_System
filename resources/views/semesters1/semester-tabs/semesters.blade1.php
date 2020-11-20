<!-- <div class="col-md-8 col-sm-8 col-xs-8"> -->
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table Grade</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      @if($count_in_active_grade)
                    <a data-toggle="modal" data-target="#semester_fields-modal1" title="Add Grade" class='btn btn-danger btn-round'><i class="glyphicon glyphicon-plus"> </i> you have <b>({{$count_in_active_grade}})</b> In Active Grades </a>
                       @else
                      <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#level-add"><i class="fa fa-plus-circle" aria-hidden="true"> Add New Level</i></a>
                       @endif
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action" id="semesters">
                        <thead>
                        <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                        <th class="column-title">Grade</th>
                        <th class="column-title">Code</th>
                        <th class="column-title">Duration</th>
                        <th class="column-title">Status</th>
                        <th class="column-title no-link last"><span class="nobr">Action</span>
                        <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
                    </tr>
            </thead>
            <tbody>
              @foreach($semesters as $key => $semester)
              @if($semester->status == "on")
              <tr class="even pointer">
                  <td class="a-center ">
                    <input type="checkbox" class="flat" name="table_records">
                  </td>
                  <td class="">{{$semester->semester_name}}</td>
                  <td class="">{{$semester->semester_code}}</td>
                  <td class="">{{$semester->semester_duration}}</td>
                  @if($semester->status == 'on')
                  <td class=""><label class="btn btn-success btn-round">Active</label></td>
                  @else
                  <td class="" ><label class="btn btn-danger btn-round">In-Active</label></td>
                  @endif
                  <td class="">
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
                    <i class="glyphicon glyphicon-eye-open"></i>
                  </a>
                       <a href="{!! route('semesters.edit', [$semester->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                       {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                   </div>
                   {!! Form::close() !!}
               </td>
           </tr>
          @endif
          @endforeach
         
       </tbody>
       
        </table>
        <tr>
       <td>
       <label class="btn btn-dark btn-round">you have <b>({{$count_active_grade}})</b> Active Grades </label></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       </tr>
    </div>
    </div>
</div>
</div>
</div>






   