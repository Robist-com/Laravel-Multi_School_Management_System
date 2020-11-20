
                   <style>
                     #panel_fee{
                      visibility:hidden;
                      }
                      #payment_submitButton{
                        visibility:hidden;
                      }
                      #loader{
                        visibility:hidden;
                      }
                   </style>
                    <div  id="show-student-money">
                       @foreach ($data as $student)
                    <h4 class="col-sm-10 "style="margin-left:15px;font-weight:bolder" id="inputEmail3">{{ $student->username }}</h4>
                         @csrf
                         <div class="col-md-2 col-sm-2 col-xs-12">
                          <a href="#aboutModal" data-toggle="modal" data-target="#myModal">
                            <img src="{{asset('student_images/'.$student->image)}}"  
                          name="aboutme" width="120" height="120" border="0" class="img-circle"></a>
                        </div>
                           <div class="col-md-5 col-sm-5 col-xs-12">
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

                          <div class="col-md-5 col-sm-5 col-xs-12">
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
                              <input type="hidden" name="semester_id1" id="semester_id1" class="form-control" value="{{$student->semesterFee}}">         
                              <input type="hidden" name="department_id1" id="department_id1" class="form-control" value="{{$student->semesterFee}}">
                              <input type="hidden" name="level_id1" id="level_id1" class="form-control" value="{{$student->semesterFee}}">
                              
                            <input type="hidden" name="fee_id" value="{{$student->fee_structure_id}}" id="FeeID">
                            <input type="hidden" name="student_id" value="{{$student->student_id}}" id="StudentID">
                            <input type="hidden" name="level_id" value="{{$student->degree_id}}" id="LevelID">
                              <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="UserID">
                              <input type="hidden" name="transact_date" value="{{ date('Y-m-d-H:i:s')}}" id="TransacDate">
                              <input type="hidden" name="student_fee_id" id="student_fee_id">
                              <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                      
                        </div>
                        </div>
                        </div>
                        </div>
                      @include('fee.detail')
                    </div>
                    </div> 

                  </div>
                    <div class="col-md-11 col-sm-12 col-xs-12" style="margin-left: 43px;" id="panel_fee1">
                    @if(isset($fee_structure1))
                    @include('fee.fee-type')
                    @endif  
                    </div>
                    
                      <div class="modal-footer" id="payment_submitButton">
                      <a href="{{route('All_Student_Fee_Transactios',[$student->student_id])}}" target="_blank"><button class="btn  btn-danger btn-round pull-left" type="button"><i class="glyphicon glyphicon-arraw-back"></i> Show all Transactions</button> </a>
                      <input type="submit" id="btn-go" name="btn-go" class="btn btn-success btn-round btn-payment pull-right" value="{{'Submit Payment'}}">
                      @endforeach
              </div>
           

           
            @if(count($data)!="0")
            @if(count($readStudentFee)!= 0)
            @include('fee.list.studentFeelist')
            <input type="hidden" value="0" id="disabled">
            @endif
            @endif

    @csrf


  

         