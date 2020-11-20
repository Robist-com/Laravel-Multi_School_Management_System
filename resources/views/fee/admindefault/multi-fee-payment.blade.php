
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
                    <div  id="show-student-paid">
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
                        <div class="col-md-12 col-sm-12 col-xs-12" style1="margin-left: 43px;" id1="panel_fee">
                        <div class="table-responsive">

<table class="table table-striped jambo_table bulk_action"   id="show-fee-type">

                          <thead>
                          <tr>
                              <th style="text-align: center;">Grade</th> 
                              <th style="text-align: center;">Fee Type</th>
                              <th style="text-align: right;">Fee($)</th>
                              <th style="text-align: right;">Total Fee Amount</th>
                              <th style="text-align: right;">Paid Amount($)</th>
                              <th style="text-align: right;">Balance Amount($)</th>
                          </tr>
                          </thead>
                          <tr>
                          <td>
                          <input type="text" class="form-control" style=" border:none; text-align:center; font-weight:bold;" id="grade_name" value="{{$student->semester_name}}" readonly>
                          <input type="hidden" name="fee_id" class="form-control" style=" border:none; text-align:center; font-weight:bold;" id="grade_name" value="{{$student->fee_structure_id}}" readonly>
                          <input type="hidden" name="level_id1" class="form-control" style=" border:none; text-align:center; font-weight:bold;" id="fee_structure_id" value="{{$student->fee_structure_id}}" readonly>
                          </td>     
                          <td>
                          <input type="text" style="text-align:center; border:none" class="form-control"  value="{{$student->fee_type}}" id="admissionFee" readonly="">
                          </td> 
                          <td>
                          <input type="text" name="semester_id1" style="text-align:right; border:none" class="form-control" value="{{$student->semesterFee}}" id="semesterFee" readonly="">
                          </td>       
                          <td>
                          <input type="text" style="text-align:right; border:none" class="form-control" name="amount[]" value="" id="totalFee" readonly="">
                          </td>  
                      
                          <td>
                          <input type="text" class="form-control" style="text-align:right" name="paid_amount[]" id="Paid" required>
                          </td>
                      
                          <td>
                          <input type="text" width="12px" class="form-control" style="text-align:right; border:none" name="balance[]" id="balance" readonly>
                          </td>
                          </tr>
                      
                          <thead>
                          <tr>
                          <th colspan="2">Remark</th>
                          <th colspan="5">Description</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                          <td colspan="2">
                          <input type="text" name="remark[]" class="form-control" id="remark">
                          </td>
                          <td colspan="5">
                          <input type="text" name="description[]" class="form-control" id="description">
                          </td>
                          </tr>
                          </tbody>
                          </div>
                          </div>
                            </table>
                            </div>
                    </div>
                        </div>
                        </div>
                        </div>
                      @include('fee.detail')
                    </div>
                    </div> 
                   
                  </div>
                   
                    @endforeach
                      <div class="modal-footer" id="payment_submitButton">
                      <a href="{{route('All_Student_Fee_Transactios',[$student->student_id])}}" target="_blank"><button class="btn  btn-danger btn-round pull-left" type="button"><i class="glyphicon glyphicon-arraw-back"></i> Show all Transactions</button> </a>
                      <input type="submit" id="btn-go" name="btn-go" class="btn btn-success btn-round btn-payment pull-right" value="{{'Submit Payment'}}">
                    
              </div>
           

    @csrf


  

         