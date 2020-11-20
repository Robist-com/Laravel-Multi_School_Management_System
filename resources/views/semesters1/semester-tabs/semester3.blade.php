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
                      <table class="table table-striped jambo_table bulk_action" id="semesters-table">
                        <thead>
                        <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
           <th style="text-align: center;">Grade</th>
               <th style="text-align: center;">Code</th>
               <th style="text-align: center;">Duration</th>
               <th style="text-align: center;">Level</th>
               <th style="text-align: center;" colspan="3">Action</th>
           </tr>
       </thead>
       <tbody id="accordion">
       {{-- @foreach($Semester1Subjects as $key => $semester) --}}
           @foreach($semesters as $key => $semester)
           @if ($semester->id == 3 ) 
 
         <tr>
            <td style="text-align: center;">{{$semester->semester_name}}</td>
            <td style="text-align: center;">{{$semester->semester_code}}</td>
            <td style="text-align: center;">{{$semester->semester_duration}}</td>
            <td style="text-align: center;">{{$semester->semester_description}}</td>
            @if($semester->status == 'on')
            <td style="text-align: center;"><label class="btn btn-success">Active</label></td>
            @else
            <td style="text-align: center;"><label class="btn btn-danger">In-Active</label></td>
            @endif
          <td style="text-align: center;">
                   {!! Form::open(['route' => ['semesters.destroy', $semester->id], 'method' => 'delete']) !!}
                   <div class='btn-group'>
                   <a data-toggle="modal" data-target="#semester_fields-modal" title="Add semester subject" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-plus"></i></a>
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

                       <!-- <!-- ------ -->
                       <!-- SO NOW LET'S TRY IT OUT AND SEE.... -->
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
    {{-- </div> --}}