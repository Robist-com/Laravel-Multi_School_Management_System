<div class="modal fade" id="level-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-level-up">Add New Level</span> </h4>
            </div>
            <form action="{{route('levels.store')}}" method="POST" id="frm-level-create">
            <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
            <div class="modal-body">
            <div class="col-md-6">
                          <div class="form-group">
                          <select name="semester_id" class="form-control select_2_single" id="semester_id">
                              <option value="selected ">semester </option>
                              @foreach($semester as $key => $semes)
                               <option value="{{$semes->id}}">{{$semes->semester_name}}</option>
                               @endforeach 
                              </select>
                              </div>
                          </div>

                          <!-- <div class="col-md-6">
                          <div class="form-group">
                          <select name="semester_id" class="form-control select_2_single" id="semester_id">
                              <option value="selected ">Department </option>
                              @foreach($department as $key => $depart)
                               <option value="{{$depart->department_id}}">{{$depart->department_name}}</option>
                               @endforeach 
                              </select>
                              </div>
                          </div> -->
                          
                          <div class="col-md-6">
                          <div class="form-group">
                            {!! Form::text('level', null, ['class' => 'form-control', 'placeholder' => 'Enter Level Here']) !!}
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <select name="course_id[]" id="course_id" class="form-control select_2_multiple" multiple data-hide-disabled="true" data-size="5" id="subject_class" >
                            <option value="">Select Course</option>
                          @foreach($courses  as $key => $cour)
                            <option value="{{$cour->id}}" >{{$cour->course_name}}</option>
                          @endforeach
                        </select>
                    </div>
                    </div>

                    <!-- Status Field -->
                    <div class="form-group  col-sm-2">
                    <label class="checkbox-inline">
                    {!! Form::hidden('status', 'off') !!}
                    {!! Form::checkbox('status', 'on', null) !!} Status
                    </label>
                    </div>

                <div class="form-group">
                    {!! Form::textarea('level_description', null, ['class' => 'form-control', 'cols' => 40, 'rows' =>2, 'placeholder'=> 'Level Description']) !!}
                </div>

<!-- Submit Field -->
</div>
<div class="modal-footer">
<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
 {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!}
</div>
</form>
 </div>
</div>
</div>

@section('scripts')

<!-- <script>
// {{--------------------------Level Side-------------------------}} 
$('#add-more-level').on('click',function(){

var courses = $('#course_id option');
var course = $('#frm-level-create').find('#course_id');
alert(course);
    $(course).empty();
    $.each(courses,function(i,cour){
         $(course).append($("<option/>",{
            value : $(cour).val(),
            text  : $(cour).text(),
        }))
    })
});
</script> -->

@endsection