     <!-- //------------------------------------------------MODAL START HERE------------------------------------------------------------- -->
     <div class="modal fade left" id="courses-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-ms  modal-right " style="width:60%">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-subscript" aria-hidden="true"> Add New Course</i></h5>
      </div>
      <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="subject_id" id="subject_id">
                    <div class="row">
                      <div class="col-md-12">
                          <hr>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">

                          <div class="col-md-6">
                          <div class="form-group">
                                  <input type="text" id="subject_code" class="form-control" value="{{old('course_code')}}" autofocus required name="course_code" placeholder="Course Code">
                              </div>
                          </div>

                        <div class="col-md-6">
                          <div class="form-group">
                                  <input type="text" id="subject_name" class="form-control" value="{{old('course_name')}}" required name="course_name" placeholder="Course Name">
                              </div>
                          </div>

                          <div class="col-md-12">
                          <div class="form-group">
                          <textarea value="{{old('description')}}" class="form-control" name="describtion" placeholder="Description" id="describtion" cols="40" rows="2"></textarea>
                                  <!-- <input type="text" id="describtion" class="form-control" > -->
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
              
                    <div class="col-md-4">
                      <div class="form-group">
                                <select name="department" class="form-control select_2_single" id="department_id">
                                  <option value="" >Select Class Group</option>
                                  @foreach ($department as $department)
                                  <option value="{{ $department->department_id }}" >{{ $department->department_name }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                      <div class="col-md-4">
                            <div class="form-group">
                                                <select name="class[]" class="form-control select_2_single" multiple data-hide-disabled="true" data-size="5" id="subject_class" >
                                                    <option value="">Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <select name="gradeSystem"  class="form-control select_2_single" id="grade_system">
                             <option value="">Grade System</option>
                              @if($gpa)
                             @foreach($gpa as $gp)
                              <option  value="{{$gp->for}}"> @if($gp->for=="1") 100 Marks @elseif($gp->for=="2") 75 Marks  @elseif($gp->for=="3") 50 Marks  @elseif($gp->for=="4") 30 Marks  @elseif($gp->for=="5") 25 Marks  @elseif($gp->for=="6") 20 Marks @elseif($gp->for=="7") 15 Marks @elseif($gp->for=="8") 10 Marks @endif </option>
                              <!--<option value="2">50 Marks </option>-->
                            @endforeach
                            @endif
                            </select>
                        </div>
                      </div>
                      <!-- Status Field -->
                    <div class=" col-sm-6">
                        <div class="form-group col-sm-1" name="status" id="status1">
                        <label class="container1">status
                        {!! Form::hidden('status', 0) !!}
                        {!! Form::checkbox('status', '1', null) !!}
                          <span class="checkmark"></span>
                        </label>
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-info">Update Student</button> -->
        {!! Form::submit('Create Course', ['class' => 'btn btn-success']) !!}
      </div>
    </div>
  </div>
  </div>
  </div>

