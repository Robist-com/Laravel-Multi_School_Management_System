
                   
        <div class="box box-primary" id="show-promotestudent-form">
            <div class="box-body">
            <div  id="wait"></div>
                       @foreach ($data as $student)
            <div class="panel" style="height:10%">
                    <h4 class="col-sm-10 "style="margin-left:15px;font-weight:bolder" id="inputEmail3">{{ $student->username }}</h5>
                <div class="panel-body">
                         @csrf
                        <div class="col-md-2">
                          <a href="#aboutModal" data-toggle="modal" data-target="#myModal">
                            <img src="{{asset('student_images/'.$student->image)}}"  
                          name="aboutme" width="120" height="120" border="0" class="img-circle"></a>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group row">
                                <h5  class="col-sm-3" style="font-weight:bolder">Name</h5>
                                <div class="col-sm-9">
                                <h6  class="col-sm-10 " id="inputEmail3">{{$student->first_name ." ". $student->last_name}}</h6>
                              </div>
                              </div>
                             
                              <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Father</h5>
                                <div class="col-sm-9">
                                <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$student->father_name}}</h6>
                                </div>
                              </div>
                              <div class="form-group row">
                                <strong><h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Mobile</h5></strong>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$student->phone}}</h6>
                                </div>
                              </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Faculty</h5>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$student->faculty_name}}</h6>
                                </div>
                              </div>
                              <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Department</h5>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-10 col-form-label" id="inputEmail3">{{$student->department_name}}</h6>
                                </div>
                              </div>
                              <div class="form-group row">
                                <h5 for="inputEmail3" style="font-weight:bolder" class="col-sm-3 col-form-label">Class</h5>
                                <div class="col-sm-9">
                                  <h6  class="col-sm-5 col-form-label" id="inputEmail3">{{$student->class_name}}</h6>
                                </div>
                              </div>

                              
                              <!-- <input type="hidden" name="class_code" value="{{$student->class_code}}" id="StudentID"> -->
                              <input type="hidden" name="student_id_single" value="{{$student->student_id}}" id="StudentID">
                              <input type="hidden" name="student_name" value="{{$student->first_name}} {{$student->last_name}}" id="StudentID">
                              <input type="hidden" name="level_id" value="{{$student->degree_id}}" id="LevelID">
                              <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="UserID">
                              <input type="hidden" name="transact_date" value="{{ date('Y-m-d-H:i:s')}}" id="TransacDate">
                              @include('fee.detail')
                    
                </div>
               
                </div>
                </div>
                </div>
                </div>
                </div>

                <hr class="line">
             <div class="modal-body">
             <div class="col-md-6">
                    <label for=""> </label> <span style="font-size:13px; margin-left:100px"> PROMOTE STUDENT</span>
                <div class="input-group ">
                <select name="semester_id" id="semester_id" class="form-control select_2_single">
                        <option value="" selected="true">FROM GRADE</option>
                        <option value="{{$student->semester_name}}" selected="true">{{$student->semester_name}}</option>
                        </select>
                    <div class="input-group-addon"><i class="fas fa-sync-alt text-red" aria-hidden="true"></i></div>
                    <select name="grade_id" id="grade_id" class="form-control select_2_single">
                            <option value="" selected="true">TO GRADE</option>
                            @foreach($semester as $grade)
                            <option value="{{$grade->id}}">{{$grade->semester_name}}</option>
                            @endforeach
                        </select>

                    <div class="input-group-addon"><i class="fas fa-sync-alt text-red" aria-hidden="true"></i></div>
                    <select name="class_code" id="class_code" class="form-control select_2_single">
                            <option value="" selected="true">TO CLASS</option>
                            @foreach($classes as $class)
                            <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                            @endforeach
                    </select>
                </div>
                </div>
             </div>
             </div>
                
                @endforeach
                      <div class="modal-footer">
                      <input type="submit" id="btn_single_promote" name="btn-go" class="btn btn-info btn-payment pull-right" value="{{'Promote Student'}}">
                      <div class="modal-footer">
                      </div>
                      </div>
                
                     
                     
        </div>
    @csrf


  

         