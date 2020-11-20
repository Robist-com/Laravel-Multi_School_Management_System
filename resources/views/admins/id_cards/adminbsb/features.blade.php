                   @if(isset($card_templateEdit))
                   @if($card_templateEdit->card_title === 'student_id_card')

                   <div id="id_switcher_student">
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                   data-placement="right"
                                   title=" Check the features you want to include to your Student ID Card "></b>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12 switch">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Card Holder<input type="checkbox" name="card_holder"
                                           {{$card_templateEdit->roll_no == 'on' ? 'checked' : 'off'}}><span
                                           class="lever"></span></label>
                               </div>
                               @else
                               <div class="switch">
                                   <label>Card Holder<input type="checkbox" name="card_holder"><span
                                           class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>

                       @if(isset($card_templateEdit))
                       <div class="switch">
                           <label>Roll No<input type="checkbox" name="roll_no"
                                   {{$card_templateEdit->roll_no == 'on' ? 'checked' : 'off'}}><span
                                   class="lever"></span></label>
                       </div>
                       @else
                       <div class="switch">
                           <label>Roll No<input type="checkbox" name="roll_no"><span class="lever"></span></label>
                       </div>
                       @endif

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Student Name<input type="checkbox"
                                           {{$card_templateEdit->staff_card_holder == 'on' ? 'checked' : ''}}
                                           name="staff_card_holder"><span class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Class<input type="checkbox"
                                           {{$card_templateEdit->class == 'on' ? 'checked' : ''}} name="class"><span
                                           class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Grade<input type="checkbox"
                                           {{$card_templateEdit->grade == 'on' ? 'checked' : ''}} name="grade"><span
                                           class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Father Name<input type="checkbox"
                                           {{$card_templateEdit->father_name == 'on' ? 'checked' : ''}}
                                           name="father_name"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Mother Name<input type="checkbox"
                                           {{$card_templateEdit->mother_name == 'on' ? 'checked' : ''}}
                                           name="mother_name"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Address<input type="checkbox"
                                           {{$card_templateEdit->address == 'on' ? 'checked' : ''}} name="address"><span
                                           class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>
                   </div>
                   @elseif($card_templateEdit->card_title === 'staff_id_card')
                   <div id="id_switcher_staff">
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                   data-placement="right"
                                   title=" Check the features you want to include to your Staff ID Card "></b>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Card Holder<input type="checkbox"
                                           {{$card_templateEdit->staff_card_holder == 'on' ? 'checked' : ''}}
                                           name="staff_card_holder"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Staff Image<input type="checkbox"
                                           {{$card_templateEdit->staff_image == 'on' ? 'checked' : ''}}
                                           name="staff_image"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Roll No<input type="checkbox"
                                           {{$card_templateEdit->staff_roll_no == 'on' ? 'checked' : ''}}
                                           name="staff_roll_no"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Staff Name<input type="checkbox"
                                           {{$card_templateEdit->staff_name == 'on' ? 'checked' : ''}}
                                           name="staff_name"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Department<input type="checkbox"
                                           {{$card_templateEdit->staff_department == 'on' ? 'checked' : ''}}
                                           name="staff_department"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Address<input type="checkbox"
                                           {{$card_templateEdit->staff_address == 'on' ? 'checked' : ''}}
                                           name="staff_address"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>
                   </div>

                   @elseif($card_templateEdit->card_title === 'admit_card')

                   <div id="id_switcher_admit_card">
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                   data-placement="right"
                                   title=" Check the features you want to include to your Admit Card"></b>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Student Image<input type="checkbox"
                                           {{$card_templateEdit->admit_student_image == 'on' ? 'checked' : ''}}
                                           name="admit_student_image"><span class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Roll No<input type="checkbox"
                                           {{$card_templateEdit->admit_roll_no == 'on' ? 'checked' : ''}}
                                           name="admit_roll_no"><span class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Student Name<input type="checkbox"
                                           {{$card_templateEdit->admit_student_name == 'on' ? 'checked' : ''}}
                                           name="admit_student_name"><span class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Class<input type="checkbox"
                                           {{$card_templateEdit->admit_class == 'on' ? 'checked' : ''}}
                                           name="admit_class"><span class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Grade<input type="checkbox"
                                           {{$card_templateEdit->admit_grade == 'on' ? 'checked' : ''}}
                                           name="admit_grade"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Father Name<input type="checkbox"
                                           {{$card_templateEdit->admit_father_name == 'on' ? 'checked' : ''}}
                                           name="admit_father_name"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Address<input type="checkbox"
                                           {{$card_templateEdit->admit_address == 'on' ? 'checked' : ''}}
                                           name="admit_address"><span class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>
                   </div>
                   @elseif($card_templateEdit->card_title === 'leaving_certificate')

                   <div id="id_switcher_leaving_certificate">
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                   data-placement="right"
                                   title=" Check the features you want to include to your Leaving Certificate"></b>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Card Holder<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_card_holder == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_card_holder"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>School Name<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_school_name == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_school_name"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Student Image<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_student_image == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_student_image"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label> Roll No<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_roll_no == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_roll_no"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Student Name<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_student_name == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_student_name"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Class<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_class == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_class"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Grade<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_grade == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_grade"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Father Name<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_father_name == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_father_name"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Mother Name<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_mother_name == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_mother_name"><span class="lever"></span></label>
                               </div>
                               @endif

                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               @if(isset($card_templateEdit))
                               <div class="switch">
                                   <label>Address<input type="checkbox"
                                           {{$card_templateEdit->leaving_certificate_address == 'on' ? 'checked' : ''}}
                                           name="leaving_certificate_address"><span class="lever"></span></label>
                               </div>
                               @endif
                           </div>
                       </div>

                   </div>

                   @endif

                   @else

                   <div id="id_switcher_student">
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                   data-placement="right"
                                   title=" Check the features you want to include to your Student ID Card "></b>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Card Holder<input type="checkbox" name="card_holder"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Roll No<input type="checkbox" name="roll_no"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Student Name No<input type="checkbox" name="student_name"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Class<input type="checkbox" name="class"><span class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Grade<input type="checkbox" name="grade"><span class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Father Name<input type="checkbox" name="father_name"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Monther's Name<input type="checkbox" name="monther_name"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Address<input type="checkbox" name="address"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>
                   </div>

                   <div id="id_switcher_staff">
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                   data-placement="right"
                                   title=" Check the features you want to include to your Staff ID Card "></b>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Card Holder<input type="checkbox" name="staff_card_holder"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Staff Image<input type="checkbox" name="staff_image"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Roll No<input type="checkbox" name="staff_roll_no"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Staff Name<input type="checkbox" name="staff_name"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Department<input type="checkbox" name="staff_department"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Address<input type="checkbox" name="staff_address"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>
                   </div>



                   <div id="id_switcher_admit_card">
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                   data-placement="right"
                                   title=" Check the features you want to include to your Admit Card"></b>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Student<input type="checkbox" name="admit_student_image"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Roll No<input type="checkbox" name="admit_roll_no"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Student<input type="checkbox" name="admit_student_name"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Class<input type="checkbox" name="admit_class"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Grade<input type="checkbox" name="admit_grade"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Father<input type="checkbox" name="admit_father_name"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Address<input type="checkbox" name="admit_address"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>
                   </div>


                   <div id="id_switcher_leaving_certificate">
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip"
                                   data-placement="right"
                                   title=" Check the features you want to include to your Leaving Certificate"></b>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Card Holder<input type="checkbox" name="leaving_certificate_card_holder"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>School Name<input type="checkbox" name="leaving_certificate_school_name"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Student Image<input type="checkbox"
                                           name="leaving_certificate_student_image"><span class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Roll No<input type="checkbox" name="leaving_certificate_roll_no"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Student Name<input type="checkbox"
                                           name="leaving_certificate_student_name"><span class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Class<input type="checkbox" name="leaving_certificate_class"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Grade<input type="checkbox" name="leaving_certificate_grade"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Father Name<input type="checkbox" name="leaving_certificate_father_name"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Mother Name<input type="checkbox" name="leaving_certificate_mother_name"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="switch">
                                   <label>Address<input type="checkbox" name="leaving_certificate_address"><span
                                           class="lever"></span></label>
                               </div>
                           </div>
                       </div>

                   </div>


                   @endif