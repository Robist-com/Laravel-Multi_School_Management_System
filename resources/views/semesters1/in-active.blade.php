
 <!-- //--------------------MODAL START HERE------------->
 <div class="modal fade left" id="semester_fields-modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-lg  modal-right " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sun-o" aria-hidden="true">IN ACTIVE</i></h5>
      </div>
      <div class="modal-body">
        <div class="panel-body">
        
        <table style="border-collapse:collapse;" class="table table-striped table-hover" id="semesters">
            <thead>
           <tr>
            <th style="text-align: center;">Grade</th>
               <th style="text-align: center;">Code</th>
               <th style="text-align: center;">Duration</th>
               <th style="text-align: center;">Level</th>
               <th style="text-align: center;" colspan="3">Action</th>
           </tr>
       </thead>
       <tbody id="accordion">
       
           @foreach($semesters as $key => $semester)
           @if($semester->status == "off")
         <tr>
          <td style="text-align: center;">{{$semester->semester_name}}</td>
          <td style="text-align: center;">{{$semester->semester_code}}</td>
          <td style="text-align: center;">{{$semester->semester_duration}}</td>
          <td style="text-align: center;">{{$semester->degree_name}}</td>
          @if($semester->status == 'on')
            <td style="text-align: center;"><label class="btn btn-success">Active</label></td>
            @else
            <td style="text-align: center;"><label class="btn btn-danger">In-Active</label></td>
            @endif
          <td style="text-align: center;">
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


        </div>
      </div>
    
    <!-- </div> -->
    </div>
  </div>