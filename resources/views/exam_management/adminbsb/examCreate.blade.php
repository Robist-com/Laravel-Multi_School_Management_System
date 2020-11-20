
       <!------------------------------ Modal start from here okay-------------------------------- -->
       <div class="modal fade-center" id="createExam" tabindex="-1" role="dialog"
      aria-labelledby="myModalLabel"
      aria-hidden="true"  style="margin-left: 20%;">
       <div class="modal-dialog" style="width:80%">
        <div class="modal-content ">
        <div class="modal-header bg-teal">
            <button type="button" class="close" data-dismiss="modal" 
            aria-hidden="true">&times;</button>
            <h4 class="modal-title">Create Exam</h4>
            </div>
             <div class="modal-body">
             <div class="panel-body">
             <div class="form-group">
              <form role="form" action="{{url('/insert/exam')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <label for="name">Exam Type <b style="color:red">*</b></label>
                         <select name="type"  id="type" class="form-control bootstrap-select" required>
                            <option value="1st Term Exam">1st Term Exam</option>
                            <option value="2nd Term Exam">2nd Term Exam</option>
                            <option value="3rd Term Exam">3rd Term Exam</option>
                            <option value="3rd Term Exam">Final Exam</option>
                            <option value="Quiz">Quiz</option>
                            </select>
                          </fieldset>
                        </div>

                         <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <label for="name">Session   <b style="color:red">*</b></label>
                        <div class="form-line">
                        <input type="text" name="session" value="{{date('Y')}}" id="exam_code_id" class="form-control datepicker2">
                          </fieldset>
                        </div>
                        </div>

                         <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <label for="name">Exam Date   <b style="color:red">*</b></label>
                        <div class="form-line">
                        <input type="text" name="e_date" id="e_date_id" class="form-control datepicker3">
                          </fieldset>
                        </div>
                        </div>

                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <label for="name">Class Group   <b style="color:red">*</b></label>
                           <select  name="department_id" class="form-control bootstrap-select " id="department1" required>

                      <option value="">--Select Class Group--</option>
                      @foreach($departments as $department)
                      <option value="{{$department->department_id}}" @if(old('class')==$department->department_id) selected @endif>{{$department->department_name}}</option>
                      @endforeach
                    </select>
                    </fieldset>
                    </div>

                    <div class="form-group col-md-8 col-sm-8 col-xs-12">
                        <label for="name">Class  <b style="color:red">*</b></label>
                           <select name="class[]"  id="class_Create_Question" class="form-control select_2_multiple" multiple data-actions-box="true" data-hide-disabled="true" data-size="5"  required>
                    </select>
                    </fieldset>
                    </div>

                   
                  </div>
                  </div>
                  </div>
                  <!-- </div> -->
                <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
                <button type="submit" class="btn bg-teal btn-sm"><i class="glyphicon glyphicon-plus"></i> Create Exam</button>
             </div>
          <!-- </div>
          </div> -->
        </form>
      </div>
    </div>
    </div>
    <!-- </div>
  </div> -->


