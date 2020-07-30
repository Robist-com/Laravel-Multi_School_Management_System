<!-- ------------------------------------ ADD NEW STUDENT MODAL -------------------------------------- -->
<div class="modal modal fade" id="modal-role">
          <div class="modal-dialog" style="width:70%">
            <div class="modal-content">
              <div class="modal-header-store">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Subject</h4>
              </div>
              <div class="modal-body">
              
              <form role="form" action="{{url('/subject/create')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="subject_id" id="subject_id">
                    <div class="row">
                      <div class="col-md-12">
                          <hr>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-4">
                          <div class="form-group">
                                  <input type="text" id="subject_code" class="form-control" value="{{old('code')}}" autofocus required name="code" placeholder="Subject Code">
                              </div>
                          </div>

                        <div class="col-md-4">
                          <div class="form-group">
                                  <input type="text" id="subject_name" class="form-control" value="{{old('name')}}" required name="name" placeholder="Subject Name">
                              </div>
                          </div>

                        <div class="col-md-4" style="display:none">
                          <div class="form-group">
                          <label class="control-label" for="type">Type <b>*</b></label>

                          <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                              <select name="type" class="form-control select_2_single" id="type">
                              <option value="Core" @if(old('type')=='Core') selected @else selected @endif>Core</option>
                                <option value="Comprehensive"  @if(old('type')=='Comprehensive') selected @endif>Comprehensive</option>
                                <option value="Electives"  @if(old('type')=='Electives') selected @endif>Electives</option>
                              </select>
                          </div>
                      </div>
                        </div>

                                    </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-4" style="display:none">
                              <div class="form-group">
                                  <label class="control-label" for="stdgroup">Subject Group <b>*</b></label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                      <select name="subgroup" class="form-control select_2_single" id="subject_group" >
                                          <option value="N/A" selected>N/A</option>
                                          <option value="Bangla"  @if(old('subgroup')=='Bangla') selected @endif>Urdu</option>
                                          <option value="English"  @if(old('subgroup')=='English') selected @endif>English</option>


                                      </select>
                                  </div>
                              </div>
                          </div>
                    <div class="col-md-4">
                      <div class="form-group">
                                <select name="stdgroup" class="form-control select_2_single" id="student_group">
                                  <option value="" >Select Student Group</option>
                                  <option value="N/A" >N/A</option>
                                  <option value="Science" @if(old('stdgroup')=='Science') selected @endif>Science</option>
                                  <option value="Arts" @if(old('stdgroup')=='Arts') selected @endif>Arts</option>
                                  <option value="Commerce" @if(old('stdgroup')=='Commerce') selected @endif>Commerce</option>

                                </select>
                            </div>
                        </div>
                      <div class="col-md-4">
                            <div class="form-group">
                                                <select name="class[]" class="form-control select_2_single" multiple data-hide-disabled="true" data-size="5" id="subject_class" >
                                                    <option value="">Select Class</option>
                                                  @foreach($classes as $class)
                                                    <option value="{{$class->class_code}}"  @if(old('class.*')==$class->class_code) selected @endif >{{$class->class_name}}</option>
                                                  @endforeach

                                                </select>
                                            </div>
                                        </div>
                      <div class="col-md-3">
                          <div class="form-group">
                            <select name="gradeSystem"  class="form-control select_2_single" id="grade_system">
                             <option value="">Grade System</option>
                              @if($gpa)
                             @foreach($gpa as $gp)
                              <option  value="{{$gp->for}}"> @if($gp->for=="1") 100 Marks @elseif($gp->for=="3") 75 Marks  @elseif($gp->for=="2") 50 Marks  @elseif($gp->for=="4") 30 Marks  @elseif($gp->for=="5") 25 Marks  @elseif($gp->for=="6") 20 Marks @elseif($gp->for=="7") 15 Marks @elseif($gp->for=="8") 10 Marks @endif </option>
                              <!--<option value="2">50 Marks </option>-->
                            @endforeach
                            @endif
                            </select>
                        </div>
                      </div>
                  </div>
                </div>
               <div style="display:none">
                <div class="row">
                  <div class="col-md-12">
                      <h3 class="text-info">Exam Details</h3>
                      <hr>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                      <div class="col-md-3"></div>
                <div class="col-md-3">
                  <label>Full Marks</label>
                </div>
                  <div class="col-md-1"></div>
                <div class="col-md-3">
                <label>Pass Marks</label>
                </div>
                  <div class="col-md-2"></div>
                </div>
               </div>
                 <div class="row">
                 <div class="col-md-12">
  <div class="col-md-2"></div>
               <div class="col-md-4">
                        <div class="form-group">
                      <label for="totalfull" class="col-md-3 control-label">Total: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" value="0" name="totalfull"  placeholder="0">
                            </div>
                            </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
               <label for="totalpass" class="col-md-3 control-label">Total: </label>
                 <div class="col-md-3">
                     <input type="text" class="form-control" required value="0" name="totalpass"  placeholder="0">
                     </div>
                     </div>
               </div>
  <div class="col-md-2"></div>
               </div>
              </div>
              <div class="row">
                <div class="col-md-12">
 <div class="col-md-2"></div>
              <div class="col-md-4">
                       <div class="form-group">
                     <label for="wfull" class="col-md-3 control-label">Written: &nbsp;</label>
                       <div class="col-md-3">
                           <input type="text" class="form-control" name="wfull" value="0" required="true"  placeholder="0">
                           </div>
                           </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
              <label for="wpass" class="col-md-3 control-label">Written: &nbsp;</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" required name="wpass" value="0"  placeholder="0">
                    </div>
                    </div>
              </div>
 <div class="col-md-2"></div>
              </div>
             </div>
             <div class="row">
               <div class="col-md-12">
<div class="col-md-2"></div>
             <div class="col-md-4">
                      <div class="form-group">
                    <label for="mfull" class="col-md-3 control-label">MCQ: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" name="mfull" value="0" required="true" placeholder="0">
                          </div>
                          </div>
             </div>
             <div class="col-md-4">
               <div class="form-group">
             <label for="mpass" class="col-md-3 control-label">MCQ: </label>
               <div class="col-md-3">
                   <input type="text" class="form-control" required name="mpass" value="0"  placeholder="0">
                   </div>
                   </div>
             </div>
<div class="col-md-2"></div>
             </div>
            </div>
            <div class="row">
              <div class="col-md-12">
<div class="col-md-2"></div>
            <div class="col-md-4">
                     <div class="form-group">
                   <label for="sfull" class="col-md-3 control-label">SBA: </label>
                     <div class="col-md-3">
                         <input type="text" class="form-control" name="sfull" value="0" required="true" placeholder="0">
                         </div>
                         </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
            <label for="spass" class="col-md-3 control-label">SBA: </label>
              <div class="col-md-3">
                  <input type="text" class="form-control" required name="spass"  value="0" placeholder="0">
                  </div>
                  </div>
            </div>
<div class="col-md-2"></div>
            </div>
           </div>
           <div class="row">
             <div class="col-md-12">
           <div class="col-md-2"></div>
           <div class="col-md-4">
                    <div class="form-group">
                  <label for="pfull" class="col-md-3 control-label">Practical:&nbsp; </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="pfull" value="0" required="true"  placeholder="0">
                        </div>
                        </div>
           </div>
           <div class="col-md-4">
             <div class="form-group">
           <label for="ppass" class="col-md-3 control-label">Practical:&nbsp;</label>
             <div class="col-md-3">
                 <input type="text" class="form-control" name="ppass"  value="0" placeholder="0">
                 </div>
                 </div>
           </div>
           </div>
           <div class="col-md-2"></div>
           </div>
           </div>

                <div class="row">
                <div class="col-md-12">

                    <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Add</button>

                  </div>
                </div>
                </form>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        </div>
        <!-- /.modal -->


        @section('scripts')

<script>
// {{--------------------------Level Side-------------------------}} 
// $('#modal-role').on('show.bs.modal', function(event){

// var button = $(event.relatedTarget)
// var subject_name = button.data('subject_name')
// var subject_code = button.data('subject_code')
// var subject_class = button.data('subject_class')
// var grade_system = button.data('grade_system')
// var subject_group = button.data('subject_group')
// var student_group = button.data('student_group')
// var subject_id = button.data('subject_id')

// console.log(event);
// var modal = $(this)

// modal.find('.modal-title').text('EDIT LEVEL INFORMATION');
// modal.find('.modal-body #subject_name').val(subject_name);
// modal.find('.modal-body #subject_code').val(subject_code);
// modal.find('.modal-body #subject_class').val(subject_class);
// modal.find('.modal-body #grade_system').val(grade_system);
// modal.find('.modal-body #subject_group').val(subject_group);
// modal.find('.modal-body #student_group').val(student_group);
// modal.find('.modal-body #subject_id').val(subject_id);
// });   


$(document).on('click', '#Edit', function(data){
    var subject_id = $(this).data('subject_id');
    // alert(Scheduleid)
    // {{url("/subject/edit")}}
    // now we need to write route for this edit okay..
    $.get("{{route('edit')}}", {subject:subject_id}, function(data){
        $("#subject_name").val(data.subject_name);
        $("#subject_code").val(data.subject_code);
        // $("#shift_id").val(data.shift_id);
        // $("#time_id").val(data.time_id);
        // $("#day_id").val(data.day_id);
        // $("#classroom_id").val(data.classroom_id);
        // $("#batch_id").val(data.batch_id);
        // $("#batch_id").val(data.batch_id);
        // $("#semester_id").val(data.semester_id);
        // $("#start_date").val(data.start_date);
        // $("#end_date").val(data.end_date);
        // $("#class_id").val(data.class_id);
        // $("#Scheduleid").val(data.Scheduleid); 
        // $("#status").val(data.status);
            console.log(data);
        // we will use the input id's okay
        // let's check if we are ahving the data's or not okay..
    });
});

</script>
@endsection