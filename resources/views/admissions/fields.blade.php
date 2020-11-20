<style>
.teacher-image {
    height: 90px;
    padding-left: 1px;
    padding-right: 1px;

    background: #eee;
    width: 140px;
    margin: 0 auto;
    border-radius: 50%;
    vertical-align: middle;

}

.image {
    vertical-align: middle;
    width: 40px;
    height: 20px;
    border-radius: 50%;
}

.image>input[type="file"] {
    display: none;
}

.btn-choose {
    padding: 5px;
    text-align: center;
    border: 1px solid !important;
    color: black;
    border-radius: 50%;
}

.btn-choose:hover {
    background-color: #605ca8;
    transform: translateX(0);
    transition: all .3s ease;
    color: white;
}

fieldset {
    margin-top: 5px;
}

fieldset legend {
    display: block;
    width: 100%;
    padding: 0;
    font-size: 15px;
    border: 0;
    line-height: inherit;
    color: #797979;
    border-bottom: 1px solid #e5e5e5;
}

.info {
    float: right;
}

legend>b {
    color: red;
    font-size: 13px
}
</style>
{{-- the code start here --}}

<div class="">
    <div class="page-title">
        <div class="title_left">
            @if(auth()->user()->group == 'Owner' && auth()->user()->school->id)
            <h3 style="text-transform: uppercase; font-family:'Times New Roman', Times, serif">
                {{auth()->user()->school->name}} </h3>
            <h3 style="text-align:center ;text-transform: uppercase; font-family:'Times New Roman', Times, serif">
                Admision Center</h3>
            @else
            <h3 style="text-transform: uppercase; font-family:'Times New Roman', Times, serif">Ministry of Higher
                Education, Research, Science and Technology</h3>
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
    <form action="{{route('admissions.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data"
        class="form-horizontal form-label-left">
        @csrf
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>ADMISSIONS</h2>
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
                                            <small>Step 1 Student Details</small>
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
                                            @if(auth()->user()->group == "Admin")
                                            <div class="col-md-12">
                                                <label for="">School <b style="color:red">*</b></label>
                                                <div class="form-group">
                                                    <select name="school_id" id="school_id" class="form-control">
                                                        <option value="">Select School</option>
                                                        @foreach(auth()->user()->school->all() as $school)
                                                        <option value="{{$school->id}}"
                                                            @if(isset($classstudentreport_single)){{$school->id == $classstudentreport_single->school_id ? 'selected' : '' }}
                                                            @endif>{{$school->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @else
                                            <input type="hidden" name="school_id" id="school_id"
                                                value="{{auth()->user()->school->id}}">
                                            @endif
                                            <div class="x_title">
                                                <img src="https://webdevtrick.com/wp-content/uploads/preview-img.jpg" width="50px" height="30px"
                                                    id="preview1" style="pointer-events: none" />

                                                <!-- <input type="file" name="image" id="file-input"
                                                    accept="image/x-png,image/png,image/jpg,image/jpeg"
                                                    style="display:none"> -->

                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                    <div class="button-group pull-right">
                                                        <input type="text"
                                                            class="btn btn-danger btn-sm btn-round col-md-2"
                                                            value="{{date('Y')}}" name="year" id="dateregistered">
                                                        <input type="text"
                                                            class="btn btn-primary btn-sm  btn-round col-md-2"
                                                            value="{{date('F')}}" name="month" id="dateregistered">
                                                        <input type="text"
                                                            class="btn btn-success  btn-sm  btn-round col-md-2"
                                                            value="{{date('l')}}" name="day" id="dateregistered">
                                                    </div>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content collapse">
                                                {{-------------------------image-----------------}}

                                                <!-- <img src="{{ asset('/image/default.png') }}" width="120px"
                                                    height="110px" id="showImage" style="pointer-events: none" />
                                                <input type="file" name="image1" id="file-input"
                                                    accept="image/x-png,image/png,image/jpg,image/jpeg"
                                                    style="display:none">

                                                <input type="button" name="browse_file" id="browse_file"
                                                    class="form-control  text-capitalize btn-choose" style="width:120px"
                                                    class="btn btn-outline-danger" value="Choose"> -->

                                                    <div class="container animated bounce">
                                                        <div class="alert"></div>
                                                        <div id='img_container'><img id="preview" width="120px" height="90px" src="https://webdevtrick.com/wp-content/uploads/preview-img.jpg" alt="your image" title=''/></div> 
                                                        <div class="input-group"> 
                                                        <div class="custom-file">
                                                        <input type="file" id="inputGroupFile01" class="imgInp custom-file-input btn-choose" aria-describedby="inputGroupFileAddon01" style="display:none">
                                                        <label class="custom-file-label" for="inputGroupFile01" style="text-align:center; cursor:pointer">Choose file</label>
                                                    </div>
                                                    </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ======================== --}}

                                    <h2 class="StepTitle"> </h2>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Student Informtion</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>

                                                    {{---------------Roll Number / Username------------------}}

                                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" readonly
                                                                name="username" id="username"
                                                                value="{{ $rand_username_password}}">
                                                            <input type="hidden" name="password" id="password"
                                                                value="{{ $rand_username_password}}">
                                                        </div>
                                                    </div>
                                                    {{---------------Registration Date------------------}}

                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="hidden" value="{{Auth::id()}}" name="user_id"
                                                                id="user_id" required>
                                                            <input type="hidden" class="form-control"
                                                                name="dateregistered" id="dateregistered" readonly
                                                                value="{{date('Y-m-d')}}">
                                                            @if(auth()->user()->group == 'Owner' &&
                                                            auth()->user()->school->id)
                                                            <input type="hidden" name="school_id" id=""
                                                                value="{{auth()->user()->school->id}}">
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
                        text-capitalize" placeholder="Enter First Name Here">
                                                    </div>
                                                </div>

                                                {{---------------Last Name------------------}}

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="">Last Name <b>*</b></label>
                                                    <div class="form-group">
                                                        <input type="text" name="last_name" id="last_name" class="form-control  
                        text-capitalize" placeholder="Enter Last Name Here">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="">Email <b>*</b></label>
                                                    <div class="form-group">
                                                        <input id="email" name="email"
                                                            class="form-control col-md-7 col-xs-12" type="text"
                                                            placeholder="Enter E-mail">
                                                    </div>
                                                </div>

                                                {{------------DOB-----------------}}

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="">Date of Birth <b>*</b></label>
                                                    <div class="form-group">
                                                        <input type="text" name="dob" id="dob"
                                                            class="form-control  text-capitalize"
                                                            placeholder="YYY/MM/DD" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="">Gender<b>*</b></label>
                                                    <div class="form-group">
                                                        <div id="gender" class="btn-group" data-toggle="buttons">
                                                            <label class="btn btn-success"
                                                                data-toggle-class="btn-primary"
                                                                data-toggle-passive-class="btn-default">
                                                                <input type="radio" name="gender" value="male"> &nbsp;
                                                                Male &nbsp;
                                                            </label>
                                                            <label class="btn btn-primary"
                                                                data-toggle-class="btn-primary"
                                                                data-toggle-passive-class="btn-default">
                                                                <input type="radio" name="gender" value="female"> Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                                        <label for="">Matrital <b>*</b></label>
                                                        <div class="form-group">
                                                            <label class="btn btn-success"
                                                                data-toggle-class="btn-default"
                                                                data-toggle-passive-class="btn-default">
                                                                <input type="radio" name="gender" value="1"> &nbsp;
                                                                Active &nbsp;
                                                            </label>
                                                            <label class="btn btn-danger"
                                                                data-toggle-class="btn-default"
                                                                data-toggle-passive-class="btn-default">
                                                                <input type="radio" name="gender" value="0"> In Active
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group"> -->
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <label for=""> Nationality <b>*</b></label>
                                                    <select name="nationality" id="country_id" class="form-control">
                                                        <option value="" selected disabled> Select Country</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                <!-- </div> -->
                                            </div>
                                            <!-- <div class="form-group"> -->
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <label for=""> State <b>*</b></label>
                                                    <select name="state_id" id="state_id" class="form-control">
                                                        <option value="" selected disabled> Select Country</option>

                                                    </select>
                                                <!-- </div> -->
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <label for=""> City <b>*</b></label>
                                                    <select name="city_id" id="city_id" class="form-control">
                                                        <option value="" selected disabled> Select Country</option>

                                                    </select>
                                                </div>
                                            </div>

                                            {{--------------------Passport-----------------}}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <label for=""> Passport <b>*</b></label>
                                                <div class="form-group">
                                                    <input type="text" name="passport" id="passport"
                                                        class="form-control  text-capitalize"
                                                        placeholder="Enter Passport Number">
                                                </div>
                                            </div>

                                            {{--------------------Phone-----------------}}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
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
                                                        cols="40" rows="2"
                                                        class="form-control  text-capitalize"></textarea>
                                                </div>
                                            </div>

                                            {{--------------------Current Address-----------------}}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <label for=""> Current Address</label>
                                                <div class="form-group">
                                                    <textarea placeholder="Enter Current Address "
                                                        name="current_address" id="current_address" cols="40" rows="2"
                                                        class="form-control  text-capitalize"></textarea>
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
                                                            <select name="semester_id" id="semester_id"
                                                                class="form-control select_2_single">
                                                                <option value="0" selected="true" disabled="true">Choose
                                                                    Grade</option>
                                                                @foreach($Semester as $Semes)
                                                                <option value="{{$Semes->id}}">{{$Semes->semester_name}}
                                                                </option>
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
                                                            <select name="degree_id" id="degree_id"
                                                                class="form-control select_2_single">
                                                                <option value="0" selected="true" disabled="true">Choose
                                                                    Level</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{--------------------Faculty-----------------}}
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="">Student Group <b>*</b></label>
                                                    <div class="form-group">
                                                        <div class="selectWarapper">
                                                            <select name="faculty_id" id="faculty_id"
                                                                class="form-control select_2_single">
                                                                <option value="0" selected="true" disabled="true">Choose
                                                                    Student Group</option>
                                                                @foreach($faculties as $faculty)
                                                                <option value="{{$faculty->faculty_id}}">
                                                                    {{$faculty->faculty_name}} </option>
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
                                                            <select name="department_id" id="department_id"
                                                                class="form-control select_2_single">
                                                                <option value="0" selected="true" disabled="true1">
                                                                    Choose Class Group</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{--------------------Class-----------------}}
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="">Class <b>*</b></label>
                                                    <div class="form-group">
                                                        <div class="selectWarapper">
                                                            <select name="class_id" id="class_id"
                                                                class="form-control select_2_single">
                                                                <option value="" selected="true" disabled="true">Choose
                                                                    Class</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{--------------------Batch-----------------}}
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label for="">Academic Year <b>*</b></label>
                                                    <div class="form-group">
                                                        <div class="selectWarapper">
                                                            <select name="batch_id" id="batch_id"
                                                                class="form-control select_2_single">
                                                                <option value="0" selected="true" disabled="true">Choose
                                                                    Batch</option>
                                                                @foreach($batches as $batch)
                                                                @if($batch->is_current_batch == 1)
                                                                <option value="{{$batch->id}}">{{$batch->batch}}
                                                                </option>
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
                                            <section>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <ul class="nav navbar-right panel_toolbox">
                                                            <li><a class="collapse-link"><i
                                                                        class="fa fa-chevron-up"></i></a>
                                                            </li>
                                                        </ul>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="x_content">
                                                        {{---------------Father Name------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Father Namme</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="father_name"
                                                                        id="father_name" class="form-control date
                                                        text-capitalize" placeholder="Enter Father Name">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Father Phone Number------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Father Phone</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="father_phone"
                                                                        id="father_phone" class="form-control 
                                                        text-capitalize" placeholder="+220 000 000 000">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Father ocupetion------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Father Ocupation</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="father_phone"
                                                                        id="father_phone" class="form-control 
                                                        text-capitalize" placeholder="Job Title.....">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Father image------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Father Photo</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="file" name="father_image"
                                                                        id="father_image" class="form-control 
                                                        text-capitalize" placeholder="+220 000 000 000">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        {{--------------- Mother Name------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Mother Name</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="mother_name"
                                                                        id="mother_name" class="form-control 
                                                        text-capitalize" placeholder="Enter Mother Name">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Mother Phone Number------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Mother Phone</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="mother_phone"
                                                                        id="mother_phone" class="form-control 
                                                        text-capitalize" placeholder="+220 000 000 000">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Mother ocupetion------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Mother Ocupation</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="mother_ocupation"
                                                                        id="mother_ocupation" class="form-control 
                                                        text-capitalize" placeholder="job title ....">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Mother image------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Mother Photo</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="file" name="mother_image"
                                                                        id="mother_image" class="form-control 
                                                        text-capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                                <div class="col-md-2">
                                                                    <label for="">If Guadian is </label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="btn-group btn-group-justified"
                                                                        role="group"
                                                                        aria-label="Justified button group">
                                                                        <a href="javascript:void(0);"
                                                                            class="btn bg-pink waves-effect"
                                                                            role="button"><input type="hidden"
                                                                                name="father_check" id="father_check"
                                                                                value="Father">Father</a>
                                                                        <a href="javascript:void(0);"
                                                                            class="btn bg-pink waves-effect"
                                                                            role="button"><input type="hidden"
                                                                                name="mother_check" id="mother_check"
                                                                                value="Mother">Mother</a>
                                                                        <a href="javascript:void(0);"
                                                                            class="btn bg-pink waves-effect"
                                                                            role="button"><input type="hidden"
                                                                                name="other_check" id="other_check"
                                                                                value="Other">Other</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Guardian Name <b>*</b></label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="guardian_name"
                                                                        id="guardian_name" class="form-control 
                                                        text-capitalize" placeholder="Enter Guardian Name">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Guardian Relationship------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Guardian Relationship <b>*</b></label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="guardian_relationship"
                                                                        id="guardian_relationship" class="form-control 
                                                        text-capitalize" placeholder="Enter Guardian Relationship">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Guardian E-mail------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Guardian Email <b>*</b></label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="guardian_email"
                                                                        id="guardian_email" class="form-control 
                                                        text-capitalize" placeholder="Enter Guardian E-mail">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Guardian image------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Guardian Photo</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="file" name="guardian_image"
                                                                        id="guardian_image" class="form-control date">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Guardian Phone Number------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Guardian Phone</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="guardian_phone"
                                                                        id="guardian_phone" class="form-control 
                                                        text-capitalize" placeholder="+220 000 000 000">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Guardian ocupetion------------------}}

                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <label for="">Guardian Ocupation</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="guardian_ocupation"
                                                                        id="guardian_ocupation" class="form-control date
                                                        text-capitalize" placeholder="job title ....">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{---------------Guardian Address------------------}}

                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <label for="">Guardian Address</label>
                                                            <div class="input-group">
                                                                <div class="form-line">
                                                                    <textarea name="" id="" cols="60" rows="1" name="guardian_address"
                                                                        id="guardian_address" class="form-control 
                                                                        text-capitalize" placeholder="Enter Guardian Address"></textarea>
                                                                    <!-- <textarea type="text" > -->
                                                                </div>
                                                            </div>
                                                        </div>
                                        </section>

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
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                            role="button" aria-expanded="false"><i
                                                                class="fa fa-wrench"></i></a>
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
                                                        <input type="text" id="bank_name" name="bank_name"
                                                            required="required" class="form-control col-md-7 col-xs-12"
                                                            placeholder="Enter Bank Name">
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" id="account_number" name="account_number"
                                                            required="required" class="form-control col-md-7 col-xs-12"
                                                            placeholder="Enter Account Number">
                                                    </div>

                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <input type="text" id="salary_amount" name="salary_amount"
                                                            required="required" class="form-control col-md-7 col-xs-12"
                                                            placeholder=" Salary Amount">
                                                    </div>

                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <input id="medical_allowance" name="medical_allowance"
                                                            class=" form-control col-md-7 col-xs-12" type="text"
                                                            placeholder="Medical Allowance">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                        <button type="submit"
                                                            class="btn btn-lg btn-round btn-success pull-right">Register
                                                            Employee</button>
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










@section('scripts')

<script type="text/javascript">

$("#inputGroupFile01").change(function(event) {  
  RecurFadeIn();
  readURL(this);    
});
$("#inputGroupFile01").on('click',function(event){
  RecurFadeIn();
});
function readURL(input) {    
  if (input.files && input.files[0]) {   
    var reader = new FileReader();
    var filename = $("#inputGroupFile01").val();
    filename = filename.substring(filename.lastIndexOf('\\')+1);
    reader.onload = function(e) {
      debugger;      
      $('#preview').attr('src', e.target.result);
      $('#preview').hide();
      $('#preview').fadeIn(500);  
      $('#preview1').attr('src', e.target.result);
      $('#preview1').hide();
      $('#preview1').fadeIn(500);     
      $('.custom-file-label').text(filename);             
    }
    reader.readAsDataURL(input.files[0]);    
  } 
  $(".alert").removeClass("loading").hide();
}
function RecurFadeIn(){ 
  console.log('ran');
  FadeInAlert("Wait for it...");  
}
function FadeInAlert(text){
  $(".alert").show();
  $(".alert").text(text).addClass("loading");  
}

//------------------Date Of Birth Change-----------
$('#dob').datetimepicker({
        format:'Y/m/d',
        timepicker:false

    })
//---------------------Browse image----------------
// $('#browse_file').on('click', function() {
//     $('#image').click();
// })
// $('#image').on('change', function(e) {
//     showFile(this, '#showImage');
// })

// GET SEMESTER State
$('#country_id').on('change', function(e) {

    var country_id = $(this).val();
    var state_id = $('#state_id')

    $(state_id).empty();
    $(state_id).append($('<option>').text("--Select state--").attr('value', ""));
    $.get("{{ route('country_state') }}", {
        country_id: country_id
    }, function(data) {

        console.log(data);
        $.each(data, function(i, state) {
            $(state_id).append($('<option/>', {
                value: state.state_id,
                text: state.state_name
            }))
        })
    })
});

// GET SEMESTER State
$('#state_id').on('change', function(e) {

    var state_id = $(this).val();
    var city_id = $('#city_id')

    $(city_id).empty();
    $(city_id).append($('<option>').text("--Select city--").attr('value', ""));
    $.get("{{ route('state_city') }}", {
        state_id: state_id
    }, function(data) {

        console.log(data);
        $.each(data, function(i, city) {
            $(city_id).append($('<option/>', {
                value: city.city_id,
                text: city.city_name
            }))
        })
    })
});

// GET SEMESTER DEGREEE
$('#semester_id').on('change', function(e) {
    var grade_id = $(this).val();
    var degree = $('#degree_id')

    $(degree).empty();
    $(degree).append($('<option>').text("--Select level--").attr('value', ""));

    $.get("{{ route('dynamicDegrees') }}", {
        grade_id: grade_id
    }, function(data) {

        $.each(data, function(i, l) {
            console.log(data);
            $(degree).append($('<option>').text(l.level).attr('value', l.id));

        })
    })
});



// GET SEMESTER DEGREEE
$('#faculty_id').on('change', function(e) {

    var faculty_id = $(this).val();
    var department_id = $('#department_id')

    $(department_id).empty();
    $(department_id).append($('<option>').text("--Select class group--").attr('value', ""));
    $.get("{{ route('dynamicDepartments') }}", {
        faculty_id: faculty_id
    }, function(data) {

        $.each(data, function(i, d) {

            console.log(data);
            $(department_id).append($('<option>').text(d.department_name).attr('value', d
                .department_id));
        })
    })
});

$('#department_id').on('change', function(e) {

    var department_id = $(this).val();
    var class_id = $('#class_id')

    $(class_id).empty();
    $(class_id).append($('<option>').text("--Select Class--").attr('value', ""));
    $.get("{{ route('dynamicDepartmentsWithClass') }}", {
        department_id: department_id
    }, function(data) {

        $.each(data, function(i, c) {

            console.log(data);
            $(class_id).append($('<option>').text(c.class_name).attr('value', c.class_code));

        })
    })
});

//---------------------------------------
function showFile(fileInput, img, showName) {
    if (fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(img).attr('src', e.target.result);
        }
        reader.readAsDataURL(fileInput.files[0]);
    }
    $(showName).text(fileInput.files[0].name)
};
//------------------------------------------------------

$(document).ready(function() {
// alert(1)

})
</script>
@endsection