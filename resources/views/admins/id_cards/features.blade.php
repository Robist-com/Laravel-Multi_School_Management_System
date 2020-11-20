                   
                   @if(isset($card_templateEdit))
                   @if($card_templateEdit->card_title === 'student_id_card')
                   
                    <div id="id_switcher_student">
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                   <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" Check the features you want to include to your Student ID Card "></b>
                   </div>
                    </div>
                   
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('card_holder', 'off') !!}
                    {!! Form::checkbox('card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                    @else
                    {!! Form::hidden('card_holder', 'off') !!}
                    {!! Form::checkbox('card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('roll_no', 'off') !!}
                    {!! Form::checkbox('roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                    @else
                    {!! Form::hidden('roll_no', 'off') !!}
                    {!! Form::checkbox('roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('student_name', 'off') !!}
                    {!! Form::checkbox('student_name', 'on', null, ['class' => 'flat']) !!} Student Name
                    @else
                    {!! Form::hidden('student_name', 'off') !!}
                    {!! Form::checkbox('student_name', 'on', null, ['class' => 'flat']) !!}  Student Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('class', 'off') !!}
                    {!! Form::checkbox('class', 'on', null, ['class' => 'flat']) !!} Class
                    @else
                    {!! Form::hidden('class', 'off') !!}
                    {!! Form::checkbox('class', 'on', null, ['class' => 'flat']) !!} Class
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('grade', 'off') !!}
                    {!! Form::checkbox('grade', 'on', null, ['class' => 'flat']) !!} Grade
                    @else
                    {!! Form::hidden('grade', 'off') !!}
                    {!! Form::checkbox('grade', 'on', null, ['class' => 'flat']) !!} Grade
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('father_name', 'off') !!}
                    {!! Form::checkbox('father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                    @else
                    {!! Form::hidden('father_name', 'off') !!}
                    {!! Form::checkbox('father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('mother_name', 'off') !!}
                    {!! Form::checkbox('mother_name', 'on', null, ['class' => 'flat']) !!} Mother Name
                    @else
                    {!! Form::hidden('mother_name', 'off') !!}
                    {!! Form::checkbox('mother_name', 'on', null, ['class' => 'flat']) !!} Mother Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('address', 'off') !!}
                    {!! Form::checkbox('address', 'on', null, ['class' => 'flat']) !!} Address
                    @else
                    {!! Form::hidden('address', 'off') !!}
                    {!! Form::checkbox('address', 'on', null, ['class' => 'flat']) !!} Address
                    @endif
                    </div>
                    </div>
                    </div>
                    @elseif($card_templateEdit->card_title === 'staff_id_card')
                    <div id="id_switcher_staff">
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                   <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" Check the features you want to include to your Staff ID Card "></b>
                   </div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('staff_card_holder', 'off') !!}
                    {!! Form::checkbox('staff_card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                    @else
                    {!! Form::hidden('staff_card_holder', 'off') !!}
                    {!! Form::checkbox('staff_card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('staff_image', 'off') !!}
                    {!! Form::checkbox('staff_image', 'on', null, ['class' => 'flat']) !!} Staff Image
                    @else
                    {!! Form::hidden('staff_image', 'off') !!}
                    {!! Form::checkbox('staff_image', 'on', null, ['class' => 'flat']) !!} Staff Image
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('staff_roll_no', 'off') !!}
                    {!! Form::checkbox('staff_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                    @else
                    {!! Form::hidden('staff_roll_no', 'off') !!}
                    {!! Form::checkbox('staff_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('staff_name', 'off') !!}
                    {!! Form::checkbox('staff_name', 'on', null, ['class' => 'flat']) !!} Staff Name
                    @else
                    {!! Form::hidden('staff_name', 'off') !!}
                    {!! Form::checkbox('staff_name', 'on', null, ['class' => 'flat']) !!}  Staff Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('staff_department', 'off') !!}
                    {!! Form::checkbox('staff_department', 'on', null, ['class' => 'flat']) !!} Department
                    @else
                    {!! Form::hidden('staff_department', 'off') !!}
                    {!! Form::checkbox('staff_department', 'on', null, ['class' => 'flat']) !!} Department
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('staff_address', 'off') !!}
                    {!! Form::checkbox('staff_address', 'on', null, ['class' => 'flat']) !!} Address
                    @else
                    {!! Form::hidden('staff_address', 'off') !!}
                    {!! Form::checkbox('staff_address', 'on', null, ['class' => 'flat']) !!} Address
                    @endif
                    </div>
                    </div>
                    </div>

                    @elseif($card_templateEdit->card_title === 'admit_card')
                    
                    <div id="id_switcher_admit_card">
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                   <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" Check the features you want to include to your Admit Card"></b>
                   </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('admit_student_image', 'off') !!}
                    {!! Form::checkbox('admit_student_image', 'on', null, ['class' => 'flat']) !!} Student Image
                    @else
                    {!! Form::hidden('admit_student_image', 'off') !!}
                    {!! Form::checkbox('admit_student_image', 'on', null, ['class' => 'flat']) !!} Student Image
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('admit_roll_no', 'off') !!}
                    {!! Form::checkbox('admit_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                    @else
                    {!! Form::hidden('admit_roll_no', 'off') !!}
                    {!! Form::checkbox('admit_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('admit_student_name', 'off') !!}
                    {!! Form::checkbox('admit_student_name', 'on', null, ['class' => 'flat']) !!} Student Name
                    @else
                    {!! Form::hidden('admit_student_name', 'off') !!}
                    {!! Form::checkbox('admit_student_name', 'on', null, ['class' => 'flat']) !!}  Student Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('admit_class', 'off') !!}
                    {!! Form::checkbox('admit_class', 'on', null, ['class' => 'flat']) !!} Class
                    @else
                    {!! Form::hidden('admit_class', 'off') !!}
                    {!! Form::checkbox('admit_class', 'on', null, ['class' => 'flat']) !!} Class
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('admit_grade', 'off') !!}
                    {!! Form::checkbox('admit_grade', 'on', null, ['class' => 'flat']) !!} Grade
                    @else
                    {!! Form::hidden('admit_admit_grade', 'off') !!}
                    {!! Form::checkbox('admit_admit_grade', 'on', null, ['class' => 'flat']) !!} Grade
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('admit_father_name', 'off') !!}
                    {!! Form::checkbox('admit_father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                    @else
                    {!! Form::hidden('admit_father_name', 'off') !!}
                    {!! Form::checkbox('admit_father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('admit_address', 'off') !!}
                    {!! Form::checkbox('admit_address', 'on', null, ['class' => 'flat']) !!} Address
                    @else
                    {!! Form::hidden('admit_address', 'off') !!}
                    {!! Form::checkbox('admit_address', 'on', null, ['class' => 'flat']) !!} Address
                    @endif
                    </div>
                    </div>
                    </div>
                    @elseif($card_templateEdit->card_title === 'leaving_certificate')

                    <div id="id_switcher_leaving_certificate">
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                   <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" Check the features you want to include to your Leaving Certificate"></b>
                   </div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_card_holder', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                    @else
                    {!! Form::hidden('leaving_certificate_card_holder', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                    @endif
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_school_name', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_school_name', 'on', null, ['class' => 'flat']) !!} School Name
                    @else
                    {!! Form::hidden('leaving_certificate_school_name', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_school_name', 'on', null, ['class' => 'flat']) !!} School Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_student_image', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_student_image', 'on', null, ['class' => 'flat']) !!} Student Image
                    @else
                    {!! Form::hidden('leaving_certificate_student_image', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_student_image', 'on', null, ['class' => 'flat']) !!} Student Image
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_roll_no', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                    @else
                    {!! Form::hidden('leaving_certificate_roll_no', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_student_name', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_student_name', 'on', null, ['class' => 'flat']) !!} Student Name
                    @else
                    {!! Form::hidden('leaving_certificate_student_name', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_student_name', 'on', null, ['class' => 'flat']) !!}  Student Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_class', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_class', 'on', null, ['class' => 'flat']) !!} Class
                    @else
                    {!! Form::hidden('leaving_certificate_class', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_class', 'on', null, ['class' => 'flat']) !!} Class
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_grade', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_grade', 'on', null, ['class' => 'flat']) !!} Grade
                    @else
                    {!! Form::hidden('leaving_certificate_grade', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_grade', 'on', null, ['class' => 'flat']) !!} Grade
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_father_name', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                    @else
                    {!! Form::hidden('leaving_certificate_father_name', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_mother_name', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_mother_name', 'on', null, ['class' => 'flat']) !!} Mother Name
                    @else
                    {!! Form::hidden('leaving_certificate_mother_name', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_mother_name', 'on', null, ['class' => 'flat']) !!} Mother Name
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      @if(isset($card_templateEdit))
                      {!! Form::hidden('leaving_certificate_address', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_address', 'on', null, ['class' => 'flat']) !!} Address
                    @else
                    {!! Form::hidden('leaving_certificate_address', 'off') !!}
                    {!! Form::checkbox('leaving_certificate_address', 'on', null, ['class' => 'flat']) !!} Address
                    @endif
                    </div>
                    </div>
                   
                    </div>
                                       
                   @endif

                   @else

                   <div id="id_switcher_student">
                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                  <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" Check the features you want to include to your Student ID Card "></b>
                  </div>
                   </div>
                  
                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('card_holder', 'off') !!}
                   {!! Form::checkbox('card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                   @else
                   {!! Form::hidden('card_holder', 'off') !!}
                   {!! Form::checkbox('card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('roll_no', 'off') !!}
                   {!! Form::checkbox('roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                   @else
                   {!! Form::hidden('roll_no', 'off') !!}
                   {!! Form::checkbox('roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('student_name', 'off') !!}
                   {!! Form::checkbox('student_name', 'on', null, ['class' => 'flat']) !!} Student Name
                   @else
                   {!! Form::hidden('student_name', 'off') !!}
                   {!! Form::checkbox('student_name', 'on', null, ['class' => 'flat']) !!}  Student Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('class', 'off') !!}
                   {!! Form::checkbox('class', 'on', null, ['class' => 'flat']) !!} Class
                   @else
                   {!! Form::hidden('class', 'off') !!}
                   {!! Form::checkbox('class', 'on', null, ['class' => 'flat']) !!} Class
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('grade', 'off') !!}
                   {!! Form::checkbox('grade', 'on', null, ['class' => 'flat']) !!} Grade
                   @else
                   {!! Form::hidden('grade', 'off') !!}
                   {!! Form::checkbox('grade', 'on', null, ['class' => 'flat']) !!} Grade
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('father_name', 'off') !!}
                   {!! Form::checkbox('father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                   @else
                   {!! Form::hidden('father_name', 'off') !!}
                   {!! Form::checkbox('father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('mother_name', 'off') !!}
                   {!! Form::checkbox('mother_name', 'on', null, ['class' => 'flat']) !!} Mother Name
                   @else
                   {!! Form::hidden('mother_name', 'off') !!}
                   {!! Form::checkbox('mother_name', 'on', null, ['class' => 'flat']) !!} Mother Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('address', 'off') !!}
                   {!! Form::checkbox('address', 'on', null, ['class' => 'flat']) !!} Address
                   @else
                   {!! Form::hidden('address', 'off') !!}
                   {!! Form::checkbox('address', 'on', null, ['class' => 'flat']) !!} Address
                   @endif
                   </div>
                   </div>
                   </div>
             
                   <div id="id_switcher_staff">
                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                  <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" Check the features you want to include to your Staff ID Card "></b>
                  </div>
                   </div>
                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('staff_card_holder', 'off') !!}
                   {!! Form::checkbox('staff_card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                   @else
                   {!! Form::hidden('staff_card_holder', 'off') !!}
                   {!! Form::checkbox('staff_card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('staff_image', 'off') !!}
                   {!! Form::checkbox('staff_image', 'on', null, ['class' => 'flat']) !!} Staff Image
                   @else
                   {!! Form::hidden('staff_image', 'off') !!}
                   {!! Form::checkbox('staff_image', 'on', null, ['class' => 'flat']) !!} Staff Image
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('staff_roll_no', 'off') !!}
                   {!! Form::checkbox('staff_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                   @else
                   {!! Form::hidden('staff_roll_no', 'off') !!}
                   {!! Form::checkbox('staff_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('staff_name', 'off') !!}
                   {!! Form::checkbox('staff_name', 'on', null, ['class' => 'flat']) !!} Staff Name
                   @else
                   {!! Form::hidden('staff_name', 'off') !!}
                   {!! Form::checkbox('staff_name', 'on', null, ['class' => 'flat']) !!}  Staff Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('staff_department', 'off') !!}
                   {!! Form::checkbox('staff_department', 'on', null, ['class' => 'flat']) !!} Department
                   @else
                   {!! Form::hidden('staff_department', 'off') !!}
                   {!! Form::checkbox('staff_department', 'on', null, ['class' => 'flat']) !!} Department
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('staff_address', 'off') !!}
                   {!! Form::checkbox('staff_address', 'on', null, ['class' => 'flat']) !!} Address
                   @else
                   {!! Form::hidden('staff_address', 'off') !!}
                   {!! Form::checkbox('staff_address', 'on', null, ['class' => 'flat']) !!} Address
                   @endif
                   </div>
                   </div>
                   </div>

       
                   
                   <div id="id_switcher_admit_card">
                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                  <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" Check the features you want to include to your Admit Card"></b>
                  </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('admit_student_image', 'off') !!}
                   {!! Form::checkbox('admit_student_image', 'on', null, ['class' => 'flat']) !!} Student Image
                   @else
                   {!! Form::hidden('admit_student_image', 'off') !!}
                   {!! Form::checkbox('admit_student_image', 'on', null, ['class' => 'flat']) !!} Student Image
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('admit_roll_no', 'off') !!}
                   {!! Form::checkbox('admit_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                   @else
                   {!! Form::hidden('admit_roll_no', 'off') !!}
                   {!! Form::checkbox('admit_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('admit_student_name', 'off') !!}
                   {!! Form::checkbox('admit_student_name', 'on', null, ['class' => 'flat']) !!} Student Name
                   @else
                   {!! Form::hidden('admit_student_name', 'off') !!}
                   {!! Form::checkbox('admit_student_name', 'on', null, ['class' => 'flat']) !!}  Student Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('admit_class', 'off') !!}
                   {!! Form::checkbox('admit_class', 'on', null, ['class' => 'flat']) !!} Class
                   @else
                   {!! Form::hidden('admit_class', 'off') !!}
                   {!! Form::checkbox('admit_class', 'on', null, ['class' => 'flat']) !!} Class
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('admit_grade', 'off') !!}
                   {!! Form::checkbox('admit_grade', 'on', null, ['class' => 'flat']) !!} Grade
                   @else
                   {!! Form::hidden('admit_grade', 'off') !!}
                   {!! Form::checkbox('admit_grade', 'on', null, ['class' => 'flat']) !!} Grade
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('admit_father_name', 'off') !!}
                   {!! Form::checkbox('admit_father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                   @else
                   {!! Form::hidden('admit_father_name', 'off') !!}
                   {!! Form::checkbox('admit_father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('admit_address', 'off') !!}
                   {!! Form::checkbox('admit_address', 'on', null, ['class' => 'flat']) !!} Address
                   @else
                   {!! Form::hidden('admit_address', 'off') !!}
                   {!! Form::checkbox('admit_address', 'on', null, ['class' => 'flat']) !!} Address
                   @endif
                   </div>
                   </div>
                   </div>
                  

                   <div id="id_switcher_leaving_certificate">
                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                  <b class="fa fa-info-circle fa-lg" style="color:#146B99" data-toggle="tooltip" data-placement="right" title=" Check the features you want to include to your Leaving Certificate"></b>
                  </div>
                   </div>
                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_card_holder', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                   @else
                   {!! Form::hidden('leaving_certificate_card_holder', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_card_holder', 'on', null, ['class' => 'flat']) !!} Card Holder
                   @endif
                   </div>
                   </div>
                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_school_name', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_school_name', 'on', null, ['class' => 'flat']) !!} School Name
                   @else
                   {!! Form::hidden('leaving_certificate_school_name', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_school_name', 'on', null, ['class' => 'flat']) !!} School Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_student_image', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_student_image', 'on', null, ['class' => 'flat']) !!} Student Image
                   @else
                   {!! Form::hidden('leaving_certificate_student_image', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_student_image', 'on', null, ['class' => 'flat']) !!} Student Image
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_roll_no', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                   @else
                   {!! Form::hidden('leaving_certificate_roll_no', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_roll_no', 'on', null, ['class' => 'flat']) !!} Roll No
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_student_name', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_student_name', 'on', null, ['class' => 'flat']) !!} Student Name
                   @else
                   {!! Form::hidden('leaving_certificate_student_name', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_student_name', 'on', null, ['class' => 'flat']) !!}  Student Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_class', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_class', 'on', null, ['class' => 'flat']) !!} Class
                   @else
                   {!! Form::hidden('leaving_certificate_class', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_class', 'on', null, ['class' => 'flat']) !!} Class
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_grade', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_grade', 'on', null, ['class' => 'flat']) !!} Grade
                   @else
                   {!! Form::hidden('leaving_certificate_grade', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_grade', 'on', null, ['class' => 'flat']) !!} Grade
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_father_name', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                   @else
                   {!! Form::hidden('leaving_certificate_father_name', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_father_name', 'on', null, ['class' => 'flat']) !!} Father Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_mother_name', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_mother_name', 'on', null, ['class' => 'flat']) !!} Mother Name
                   @else
                   {!! Form::hidden('leaving_certificate_mother_name', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_mother_name', 'on', null, ['class' => 'flat']) !!} Mother Name
                   @endif
                   </div>
                   </div>

                   <div class="form-group">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     @if(isset($card_templateEdit))
                     {!! Form::hidden('leaving_certificate_address', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_address', 'on', null, ['class' => 'flat']) !!} Address
                   @else
                   {!! Form::hidden('leaving_certificate_address', 'off') !!}
                   {!! Form::checkbox('leaving_certificate_address', 'on', null, ['class' => 'flat']) !!} Address
                   @endif
                   </div>
                   </div>
                  
                   </div>
                  

                   @endif
                   
                   
             


