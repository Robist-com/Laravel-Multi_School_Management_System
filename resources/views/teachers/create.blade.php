
@extends('layouts.new-layouts.app')

@section('content')
        <!-- page content -->
        <style>
    .teacher-image{
        height:90px;
        padding-left:1px;
        padding-right: 1px;

        background: #eee;
        width:140px;
        margin: 0 auto;
        border-radius: 50%;
        vertical-align: middle;
       
    }
    .image{
        vertical-align: middle;
        width:40px;
        height: 20px;
        border-radius: 50%;
    }
    .image > input[type="file"]{
        display: none;
    }

    .btn-choose{
        padding: 5px;
        text-align: center;
        border:1px solid !important;
        color: black;
        border-radius: 50%;
    }

    .btn-choose:hover{
    background-color: #605ca8;
    transform: translateX(0);
    transition: all .3s ease;
    color:white;
}

    fieldset{
        margin-top: 5px;
    }
    fieldset legend{
        display: block;
        width:100%;
        padding: 0;
        font-size: 15px;
        border: 0;
        line-height: inherit;
        color: #797979;
        border-bottom: 1px solid #e5e5e5;
    }

    .info{
        float: right;
    }
    legend >b{
        color:red;
        font-size:13px
    }

</style>
{{-- the code start here --}}
 
<div class="">
    <div class="page-title">
      <div class="title_left">
      @if(auth()->user()->group == 'Owner' && auth()->user()->school->id) 
      <h3 style="text-transform: uppercase; font-family:'Times New Roman', Times, serif">{{auth()->user()->school->name}} </h3> 
      <h3 style="text-align:center ;text-transform: uppercase; font-family:'Times New Roman', Times, serif">Admision Center</h3>
      @else
      <h3 style="text-transform: uppercase; font-family:'Times New Roman', Times, serif">Ministry of Higher Education, Research, Science and Technology</h3> 
      @endif
       
      </div>

      <div class="title_right">
         
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                  </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <form action="{{route('teachers.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" class="form-horizontal form-label-left">
      @csrf
    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>TEACHER REGISTRATION</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Smart Wizard -->
            <div id="wizard" class="form_wizard wizard_horizontal">
              <ul class="wizard_steps">
                <li>
                  <a href="#step-1">
                    <span class="step_no">1</span>
                    <span class="step_descr">
                                      Step 1<br />
                                      <small>Step 1 Teacher Details</small>
                                  </span>
                  </a>
                </li>
                <li>
                  <a href="#step-2">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                                      Step 2<br />
                                      <small>Step 2 Academic Details</small>
                                  </span>
                  </a>
                </li>
                <li>
                  <a href="#step-3">
                    <span class="step_no">3</span>
                    <span class="step_descr">
                                      Step 3<br />
                                      <small>Step 3 Upload Documents</small>
                                  </span>
                  </a>
                </li>
                <li>
                  <a href="#step-4">
                    <span class="step_no">4</span>
                    <span class="step_descr">
                                      Step 4<br />
                                      <small>Step 4 Salary Detils</small>
                                  </span>
                  </a>
                </li>
              </ul>
              
              <div id="step-1">
                  <div class="row">
                   {{-- ====================== --}}
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <img src="{{ asset('/image/default.png') }}" width="50px" height="30px" id="showImage1" style="pointer-events: none"/>
                      <input type="file" name="image" id="file-input"
                      accept="image/x-png,image/png,image/jpg,image/jpeg" style="display:none">
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        </li>
                        <div class="button-group pull-right">
                        <input type="text" class="btn btn-danger btn-sm btn-round col-md-2" value="{{date('Y')}}" name="year" id="dateregistered">
                        <input type="text" class="btn btn-primary btn-sm  btn-round col-md-2" value="{{date('F')}}" name="month" id="dateregistered">
                        <input type="text" class="btn btn-success  btn-sm  btn-round col-md-2" value="{{date('l')}}" name="day" id="dateregistered">
                        </div>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content collapse">
                          {{-------------------------image-----------------}}
  
                      <img src="{{ asset('/image/default.png') }}" width="120px" height="110px" id="showImage" style="pointer-events: none"/>
                      <input type="file" name="image1" id="file-input"
                      accept="image/x-png,image/png,image/jpg,image/jpeg" style="display:none">

                          <input type="button" name="browse_file" id="browse_file" 
                          class="form-control  text-capitalize btn-choose" style="width:120px" 
                          class="btn btn-outline-danger" value="Choose">
                  </div>
                </div>
                </div>

              {{-- ======================== --}}
               
                  <h2 class="StepTitle">  </h2>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Teacher Informtion</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                            
                        {{---------------Roll Number / Username------------------}}
                  
                  <div class="col-md-12 col-sm-6 col-xs-12">
                   <div class="form-group">
                   <input type="text" class="form-control" readonly name="roll_no" id="roll_no" value="{{ $rand_username_password}}">
                   <input type="hidden" name="password" id="password" value="{{ $rand_username_password}}">
                   </div>
                    </div>
                    {{---------------Registration Date------------------}}
                  
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                          <input type="hidden" value="{{Auth::id()}}" name="user_id" id="user_id" required>
                                  <input type="hidden" class="form-control" name="dateregistered" id="dateregistered" 
                                  readonly value="{{date('Y-m-d')}}">
                                  @if(auth()->user()->group == 'Owner' && auth()->user()->school->id) 
                                  <input type="hidden" name="school_id" id="" value="{{auth()->user()->school->id}}">
                                  @endif
                          </div>
                      </div>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <br />
                      
                      {{---------------First Name------------------}}
    
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       <label for="">First Name <b>*</b></label>
                        <div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control 
                        text-capitalize"placeholder="Enter First Name Here">
                        </div>
                    </div>

                    {{---------------Last Name------------------}}
                
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       <label for="">Last Name <b>*</b></label>
                        <div class="form-group">
                        <input type="text" name="last_name" id="last_name" class="form-control  
                        text-capitalize"placeholder="Enter Last Name Here">
                        </div>
                        </div>
                
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="">Email <b>*</b></label>
                            <div class="form-group">
                              <input id="email" name="email" class="form-control col-md-7 col-xs-12" type="text" placeholder="Enter E-mail">
                            </div>
                            </div>

                            {{------------DOB-----------------}}
    
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="">Date of Birth <b>*</b></label>
                          <div class="form-group">
                          <input type="text" name="dob" id="dob" class="form-control  text-capitalize"
                          placeholder="YYY-MM-DD" autocomplete="off">
                          </div>
                          </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="">Gender<b>*</b></label>
                            <div class="form-group">
                              <div id="gender" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="gender" value="female"> Female
                                </label>
                              </div>
                              </div>
                              </div>

                              <div class="col-md-6 col-sm-6 col-xs-12">
                              <div id="marital_status" class="btn-group" data-toggle="buttons">
                              <label for="">Matrital <b>*</b></label>
                              <div class="form-group">
                                <label class="btn btn-success" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="marital_status" value="1"> &nbsp; Single &nbsp;
                                </label>
                                <label class="btn btn-danger" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="marital_status" value="0"> Marriage
                                </label>
                              </div>
                            </div>
                          </div>
                          </div>

                          <div class="form-group">
                           <div class="col-md-4 col-sm-6 col-xs-12">
                           <label for=""> Nationality <b>*</b></label>
                             <select name="nationality" id="nationality" class="form-control">
                               <option value="" selected disabled> Select Country</option>
                               <option value=""> Select Country</option>
                             </select>
                            </div>
                          </div>

                          {{--------------------Passport-----------------}}
                          <div class="col-md-4 col-sm-6 col-xs-12">
                          <label for=""> Passport <b>*</b></label>
                            <div class="form-group">
                            <input type="text" name="passport" id="passport" class="form-control  text-capitalize"
                                        placeholder="Enter Passport Number">
                            </div>
                            </div>

                          {{--------------------Phone-----------------}}
                          <div class="col-md-4 col-sm-6 col-xs-12">
                          <label for=""> Phone</label>
                          <div class="form-group">
                          <input type="text" name="phone" id="phone" class="form-control 
                                      text-capitalize" placeholder="Enter Phone Number Here">
                          </div>
                          </div>

                          {{--------------------Pamanet Address-----------------}}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for=""> Pamanet Address</label>
                          <div class="form-group">
                          <textarea placeholder="Enter Address " name="address" id="address"
                          cols="40" rows="2" class="form-control  text-capitalize"></textarea>
                          </div>
                          </div>
              
                          {{--------------------Current Address-----------------}}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for=""> Current Address</label>
                          <div class="form-group">
                          <textarea placeholder="Enter Current Address " name="current_address" id="current_address"
                          cols="40" rows="2" class="form-control  text-capitalize"></textarea>
                          </div>
                          </div>
                        
                    </div>
                  </div>
                </div>

              </div>
              <div id="step-2">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2> Academic Information </h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <br /> 

                        {{--------------------Grade-----------------}}
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       <label for="">Grade <b>*</b></label>
                        <div class="form-group">
                        <div class="selectWarapper">
                        <select name="semester_id" id="semester_id" class="form-control select_2_single" >
                            <option value="0" selected="true" disabled="true">Choose Grade</option>
                            @foreach($Semester as $Semes)
                            <option value="{{$Semes->id}}">{{$Semes->semester_name}} </option>
                            @endforeach
                        </select>
                        </div>
                        
                        </div>
                        </div>

                          {{--------------------Degree-----------------}}
                         <div class="col-md-6 col-sm-6 col-xs-12">
                         <label for="">Level <b>*</b></label>
                            <div class="form-group">
                            <div class="selectWarapper">
                            <select name="degree_id" id="degree_id" class="form-control select_2_single" >
                            <option value="0" selected="true" disabled="true">Choose Level</option>
                            </select>
                            </div>
                            </div>
                            </div>

                            {{--------------------Faculty-----------------}}
                           <div class="col-md-6 col-sm-6 col-xs-12">
                           <label for="">Student Group <b>*</b></label>
                            <div class="form-group">
                            <div class="selectWarapper">
                            <select name="faculty_id" id="faculty_id" class="form-control select_2_single" >
                            <option value="0" selected="true" disabled="true">Choose Student Group</option>
                            @foreach($faculties as $faculty)
                            <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}} </option>
                            @endforeach
                            </select>
                            </div>
                            </div>
                            </div>

                            {{--------------------Department-----------------}}
                           <div class="col-md-6 col-sm-6 col-xs-12">
                           <label for="">Class Group <b>*</b></label>
                            <div class="form-group">
                            <div class="selectWarapper">
                            <select name="department_id" id="department_id" class="form-control select_2_single" >
                            <option value="0" selected="true" disabled="true1">Choose Class Group</option>
                            </select>
                            </div>
                            </div>
                            </div>

                        {{--------------------Class-----------------}}
                       <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="">Class <b>*</b></label>
                            <div class="form-group">
                            <div class="selectWarapper">
                            <select name="class_id" id="class_id" class="form-control select_2_single" >
                            <option value="" selected="true" disabled="true">Choose Class</option>
                            </select>
                            </div>
                            </div>
                            </div>

                        {{--------------------Batch-----------------}}
                       <div class="col-md-6 col-sm-6 col-xs-12">
                            <label for="">Academic Year <b>*</b></label>
                            <div class="form-group">
                            <div class="selectWarapper">
                            <select name="batch_id" id="batch_id" class="form-control select_2_single" >
                            <option value="0" selected="true" disabled="true">Choose Batch</option>
                            @foreach($batches as $batch)
                            @if($batch->is_current_batch == 1)
                            <option value="{{$batch->id}}">{{$batch->batch}} </option>
                            @endif
                            @endforeach
                            </select>
                            </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <!-- </div>
                        </div>
                        </div> -->
                        

              <div id="step-3">

                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Parent Guardian Detail</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                      {{---------------Father Name------------------}}

                     <div class="col-md-3 col-sm-6 col-xs-12">
                     <label for="">Father Namme</label>
                      <div class="form-group">
                      <input type="text" name="father_name" id="father_name" class="form-control 
                      text-capitalize" placeholder="Enter Father Name" >
                      </div>
                      </div>

                      {{---------------Father Phone Number------------------}}

                     <div class="col-md-3 col-sm-6 col-xs-12">
                     <label for="">Father Phone</label>
                      <div class="form-group">
                      <input type="text" name="father_phone" id="father_phone" class="form-control 
                      text-capitalize" placeholder="+220 000 000 000">
                      </div>
                      </div>

                      {{---------------Father ocupetion------------------}}

                      <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="">Father Ocupation</label>
                      <div class="form-group">
                      <input type="text" name="father_phone" id="father_phone" class="form-control 
                      text-capitalize" placeholder="+220 000 000 000">
                      </div>
                      </div>

                      {{---------------Father image------------------}}

                      <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="">Father Photo</label>
                      <div class="form-group">
                      <input type="file" name="father_image" id="father_image" class="form-control 
                      text-capitalize" placeholder="+220 000 000 000">
                      </div>
                      </div>


                      {{--------------- Mother Name------------------}}

                     <div class="col-md-3 col-sm-6 col-xs-12">
                     <label for="">Mother Name</label>
                      <div class="form-group">
                      <input type="text" name="mother_name" id="mother_name" class="form-control 
                      text-capitalize" placeholder="Enter Mother Name" >
                      </div>
                      </div>

                      {{---------------Mother Phone Number------------------}}

                     <div class="col-md-3 col-sm-6 col-xs-12">
                     <label for="">Mother Phone</label>
                      <div class="form-group">
                      <input type="text" name="mother_phone" id="mother_phone" class="form-control 
                      text-capitalize" placeholder="+220 000 000 000">
                      </div>
                      </div>

                      {{---------------Mother ocupetion------------------}}

                      <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="">Mother Ocupation</label>
                      <div class="form-group">
                      <input type="text" name="mother_ocupation" id="mother_ocupation" class="form-control 
                      text-capitalize" placeholder="jobe title ....">
                      </div>
                      </div>

                      {{---------------Mother image------------------}}

                      <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="">Mother Photo</label>
                      <div class="form-group">
                      <input type="file" name="mother_image" id="mother_image" class="form-control 
                      text-capitalize">
                      </div>
                      </div>
                      <br><br>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 ">
                        <div class="col-md-3">
                        <label for="">If Guadian is </label>
                        </div>
                        <div class="col-md-2">
                          <input name="father_check" id="father_check" checked type="checkbox" class="flat"> Father
                        </div>
                        <div class="col-md-2">
                          <label for="">
                            <input name="mother_check" id="mother_check" class="flat" type="checkbox"> Mother
                            </label>
                            </div>
                            <div class="col-md-2">
                            <label for="">
                          <input type="checkbox" id="other_check" name="other_check" class="flat"> Other
                          </label>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <i class="fa fa-info-circle"><input type="button" class="btn btn-default btn-xs" name="" id=""></i></div>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                     <label for="">Father Namme</label>
                      <div class="form-group">
                      <input type="text" name="father_name" id="father_name" class="form-control 
                      text-capitalize" placeholder="Enter Father Name" >
                      </div>
                      </div>

                      {{---------------Father Phone Number------------------}}

                     <div class="col-md-3 col-sm-6 col-xs-12">
                     <label for="">Father Phone</label>
                      <div class="form-group">
                      <input type="text" name="father_phone" id="father_phone" class="form-control 
                      text-capitalize" placeholder="+220 000 000 000">
                      </div>
                      </div>

                      {{---------------Father ocupetion------------------}}

                      <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for=""> Father Ocupation</label>
                      <div class="form-group">
                      <input type="text" name="father_phone" id="father_phone" class="form-control 
                      text-capitalize" placeholder="+220 000 000 000">
                      </div>
                      </div>

                      {{---------------Father image------------------}}

                      <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="">Father Photo</label>
                      <div class="form-group">
                      <input type="file" name="father_image" id="father_image" class="form-control 
                      text-capitalize" placeholder="+220 000 000 000">
                      </div>
                      </div>


                      {{--------------- Mother Name------------------}}

                     <div class="col-md-3 col-sm-6 col-xs-12">
                     <label for="">Mother Name</label>
                      <div class="form-group">
                      <input type="text" name="mother_name" id="mother_name" class="form-control 
                      text-capitalize" placeholder="Enter Mother Name" >
                      </div>
                      </div>

                      {{---------------Mother Phone Number------------------}}

                     <div class="col-md-3 col-sm-6 col-xs-12">
                     <label for="">Mother Phone</label>
                      <div class="form-group">
                      <input type="text" name="mother_phone" id="mother_phone" class="form-control 
                      text-capitalize" placeholder="+220 000 000 000">
                      </div>
                      </div>

                      {{---------------Mother ocupetion------------------}}

                      <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="">Mother Ocupation</label>
                      <div class="form-group">
                      <input type="text" name="mother_ocupation" id="mother_ocupation" class="form-control 
                      text-capitalize" placeholder="jobe title ....">
                      </div>
                      </div>

                      {{---------------Mother image------------------}}

                      <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="">Mother Photo</label>
                      <div class="form-group">
                      <input type="file" name="mother_image" id="mother_image" class="form-control 
                      text-capitalize">
                      </div>
                      </div>

                      </div>
                        </div>
                        </div>
                        </div>
                        <!-- </div>
                        </div> -->
                       

              </div>
              <div id="step-4">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Salary Detail <small>Portal</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <br />
       
                          <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="bank_name" name="bank_name" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Bank Name">
                            </div>
                         
                           <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="account_number" name="account_number" required="required" class="form-control col-md-7 col-xs-12" placeholder="Enter Account Number">
                            </div>
                          
                            <div class="col-md-2 col-sm-6 col-xs-12">
                              <input type="text" id="salary_amount" name="salary_amount" required="required" class="form-control col-md-7 col-xs-12" placeholder=" Salary Amount">
                            </div>

                            <div class="col-md-2 col-sm-6 col-xs-12">
                              <input id="medical_allowance" name="medical_allowance" class=" form-control col-md-7 col-xs-12" type="text" placeholder="Medical Allowance">
                          </div>
                          </div>
 
                          <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                              <button type="submit" class="btn btn-lg btn-round btn-success pull-right">Register Employee</button>
                            </div>
                          </div>
                        {{-- </form> --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End SmartWizard Content -->
          </div>
        </div>
      </div>
    </div>
  </form>
  </div>
  </div>
  </div>
  </div>
        <!-- /page content -->

      
@endsection
        



@section('scripts')

<script type="text/javascript">
$(document).ready(function(){
    // alert(1)
})
//------------------Date Of Birth Change-----------
            $('#dob').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false
            })
//---------------------Browse image----------------
                $('#browse_file').on('click',function(){
                    $('#image').click();                 
                })
                $('#image').on('change', function(e){
                    showFile(this, '#showImage');
                })

// GET SEMESTER DEGREEE
// $('#semester_id').on('change',function(e){

// var degree_id = $(this).val();
// var degree = $('#degree_id')
//     $(degree).empty();
// $.get("{{ route('dynamicDegrees') }}",{degree_id:degree_id},function(data){  

//     console.log(data);
//     $.each(data,function(i,l){
//     $(degree).append($('<option/>',{
//         value : l.id,
//         text  : l.level
// }))
// }) 
// })
// });

// GET SEMESTER DEGREEE
$('#semester_id').on('change',function(e){
var grade_id = $(this).val();
var degree = $('#degree_id')
    $(degree).empty();
$.get("{{ route('dynamicDegrees') }}",{grade_id:grade_id},function(data){  

    console.log(data);
    $.each(data,function(i,l){
    $(degree).append($('<option/>',{
        value : l.id,
        text  : l.level
    }))
}) 
})
});



// GET SEMESTER DEGREEE
$('#faculty_id').on('change',function(e){

var faculty_id = $(this).val();
var department_id = $('#department_id')
$(department_id).empty();
$.get("{{ route('dynamicDepartments') }}",{faculty_id:faculty_id},function(data){  

console.log(data);
$.each(data,function(i,l){
$(department_id).append($('<option/>',{
value : l.department_id,
text  : l.department_name
}))
}) 
})
});

$('#department_id').on('change',function(e){

var department_id = $(this).val();
var class_id = $('#class_id')
$(class_id).empty();
$.get("{{ route('dynamicDepartmentsWithClass') }}",{department_id:department_id},function(data){  

console.log(data);
$.each(data,function(i,c){
$(class_id).append($('<option/>',{
value : c.class_code,
text  : c.class_name
}))
}) 
})
});

//---------------------------------------
function showFile(fileInput,img,showName){
if (fileInput.files[0]){
  var reader = new FileReader();
  reader.onload = function(e){
      $(img).attr('src', e.target.result);
  }
  reader.readAsDataURL(fileInput.files[0]);
}
$(showName).text(fileInput.files[0].name)
};
//------------------------------------------------------
// {{----------------------------Update class Schedule Status---------------------}}  

$(document).ready(function(){

// function Status(){
    $('.js-switch').change(function () {
    let status = $(this).prop('checked') === true ? 1 : 0;
    let studentId = $(this).data('id');
    // alert(studentId)
    $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ url('student/status/update') }}',
        data: {'status': status, 'student_id': studentId},
        success: function (data) {
            console.log(data.message);
            // success: function (data) {
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
// }
        }
    });
});

// }
})

$(document).ready(function(){


})
</script>
@endsection