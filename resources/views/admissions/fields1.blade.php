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
    width: 120px;
    /* border-radius: 50%; */
}

.btn-choose:hover {
    background-color: #009688;
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

select {
    border-bottom: 1px solid #c9c9c9;
    border-top: 0;
    border-left: 0;
    border-right: 0;
    color: #444444;
    -webkit-appearance: button;
    -webkit-border-radius: 2px;
    -webkit-padding-end: 20px;
    -webkit-padding-start: 2px;
    -webkit-user-select: none;
    background-color: white;
    background-image:
}
</style>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3>  ADMISSION CENTER </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            @if(auth()->user()->group == 'Owner' && auth()->user()->school->id)
            <a style="text-transform: uppercase; text-decoration:none; color:black; font-family:'Times New Roman', Times, serif; text-align:left">
                {{auth()->user()->school->name}} </a>
            <a style="text-align:left ; text-decoration:none; color:black; text-transform: uppercase; font-family:'Times New Roman', Times, serif">
                Admision Center</a>
            @else
            <h3 style="text-transform: uppercase; text-decoration:none; color:black; font-family:'Times New Roman', Times, serif">Ministry of Higher
                Education, Research, Science and Technology</h3>
            @endif
        </div>


<div class="row clearfix">
    <!-- Colorful Panel Items With Icon -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="button-group ">
                    <input type="text" class="btn btn-danger btn-sm btn-round col-md-2" value="{{date('Y')}}"
                        name="year" id="dateregistered1" readonly>
                    <input type="text" class="btn btn-primary btn-sm  btn-round col-md-2" value="{{date('F')}}"
                        name="month" id="dateregistered1" readonly>
                    <input type="text" class="btn btn-success  btn-sm  btn-round col-md-2" value="{{date('l')}}"
                        name="day" id="dateregistered1" readonly>
                </div>
                <br>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
          
            <div class="body">
           
                <div class="row clearfix">
                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                        <div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true">
                            
                            <div class="panel panel-col-pink">
                                <div class="panel-heading" role="tab" id="headingOne_17">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion_17"
                                            href="#collapseOne_17" aria-expanded="true" aria-controls="collapseOne_17">
                                            <i class="material-icons">person</i> Student Details  <i class="material-icons pull-right">add</i></a>
                                    </h4>
                                </div>
                                <div id="collapseOne_17" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="headingOne_17">
                                    <div class="panel-body">
                                        <div class="row clearfix">
                                  
                                            <div class="col-md-4">
                                                <span>Note: please fill all required fields.!</span>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Registeration Date <b>*</b></label>
                                                <div class="input-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control date"
                                                            placeholder="Message" value="{{date('Y-m-d')}}" readonly>
                                                    </div>
                                                    <input type="hidden" value="{{Auth::id()}}" name="user_id"
                                                        id="user_id" required>
                                                    <input type="hidden" class="form-control" name="dateregistered"
                                                        id="dateregistered" readonly value="{{date('Y-m-d')}}">
                                                    @if(auth()->user()->group == 'Owner' &&
                                                    auth()->user()->school->id)
                                                    <input type="hidden" name="school_id" id="school_id"
                                                        value="{{auth()->user()->school->id}}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Roll No.<b>*</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">vpn_key</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control date" readonly
                                                            name="username" id="username"
                                                            value="{{ $rand_username_password}}">
                                                        <input type="hidden" name="password" id="password"
                                                            value="{{ $rand_username_password}}">
                                                        <!-- <input type="text" class="form-control date" placeholder="Recipient's username"> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-md-4">
                                                <label>First Name <b>*</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="first_name" id="first_name"
                                                            class="form-control date" placeholder="Firstname">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Last Name <b>*</b></label>
                                                <div class="input-group">
                                                    <div class="form-line">
                                                        <input type="text" name="last_name" id="last_name"
                                                            class="form-control date" placeholder="Lastname">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>E-mail <b>*</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">email</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="email" id="email"
                                                            class="form-control date" placeholder="E-mail">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ----------------- -->
                                        {{------------DOB-----------------}}
                                        <div class="row clearfix">
                                            <div class="col-md-4">
                                                <label for="">Date of Birth <b>*</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">date_range</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="dob" id="dob" class="form-control date"
                                                            placeholder="Ex: 30/07/2016">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="row clearfix"> -->
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label for=""> Gender <b>*</b></label>
                                                <div class="form-group">
                                                    <div class="selectWarapper">
                                                        <select name="gender" id="gender"
                                                            class="form-control bootstrap-select">
                                                            <option value="" selected disabled> Select Gender</option>
                                                            <option value="male"> Male </option>
                                                            <option value="female"> Female </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label for=""> Matrital <b>*</b></label>
                                                <div class="form-group">
                                                    <div class="selectWarapper">
                                                        <select name="matrital" id="matrital"
                                                            class="form-control bootstrap-select">
                                                            <option value="" selected disabled> Select matrital</option>
                                                            <option value="single"> Single</option>
                                                            <option value="married"> Married</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label for=""> Nationality <b>*</b></label>
                                                <div class="form-group">
                                                    <div class="selectWarapper">
                                                        <select name="nationality" id="country_id"
                                                            class="form-control bootstrap-select">
                                                            <option value="" selected disabled> Select Country</option>
                                                            @foreach($countries as $country)
                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label for=""> State <b>*</b></label>
                                                <div class="form-group">
                                                    <div class="selectWarapper">
                                                        <select name="state_id" id="state_id"
                                                            class="form-control bootstrap-select">
                                                            <option value="" selected disabled> Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <label for=""> City <b>*</b></label>
                                                <div class="form-group">
                                                    <div class="selectWarapper">
                                                        <select name="city_id" id="city_id"
                                                            class="form-control bootstrap-select">
                                                            <option value="" selected disabled> Select City </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            {{--------------------Passport-----------------}}
                                            <div class="col-md-6">
                                                <label for=""> Passport <b>*</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">nfc</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="passport" id="passport"
                                                            class="form-control date  text-capitalize"
                                                            placeholder="Enter Passport Number">
                                                    </div>
                                                </div>
                                            </div>

                                            {{--------------------Phone-----------------}}

                                            <div class="col-md-6">
                                                <b>Mobile Phone Number</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">phone_iphone</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="phone" id="phone"
                                                            class="form-control mobile-phone-number"
                                                            placeholder="Ex: +00 (000) 000-00-00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            {{--------------------Pamanet Address-----------------}}
                                            <div class="col-md-6">
                                                <label for=""> Pamanet Address <b>*</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="address" id="address"
                                                            class="form-control date  text-capitalize"
                                                            placeholder="Enter Address ">
                                                    </div>
                                                </div>
                                            </div>

                                            {{--------------------Current Address-----------------}}

                                            <div class="col-md-6">
                                                <b>Current Address</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="current_address" id="current_address"
                                                            class="form-control date  text-capitalize"
                                                            placeholder="Enter Current Address">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-col-cyan">
                                <div class="panel-heading" role="tab" id="headingTwo_17">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion_17" href="#collapseTwo_17" aria-expanded="false"
                                            aria-controls="collapseTwo_17">
                                            <i class="material-icons">school</i> Academic Details
                                           <i class="material-icons pull-right">add</i></a>
                                    </h4>
                                    
                                </div>
                                <div id="collapseTwo_17" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingTwo_17">
                                    <div class="panel-body">
                                        <section>

                                        <div class="container animated bounce">
                                    <div class="alert"></div>
                                    <div id='img_container'><img id="preview" width="120px" height="90px" src="https://webdevtrick.com/wp-content/uploads/preview-img.jpg" alt="your image" title=''/></div> 
                                    <div class="input-group"> 
                                    <div class="custom-file">
                                    <input type="file" id="inputGroupFile01" name="image"  class="imgInp custom-file-input btn-choose" aria-describedby="inputGroupFileAddon01" style="display:none">
                                    <label class="custom-file-label" for="inputGroupFile01" style="text-align:center; cursor:pointer">Choose file</label>
                                </div>
                                </div>
                                </div>

                                            {{--------------------Grade-----------------}}
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <label for="">Grade <b>*</b></label>
                                                <div class="form-group">
                                                    <div class="selectWarapper">
                                                        <select name="semester_id" id="semester_id"
                                                            class="form-control bootstrap-select">
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
                                                            class="form-control bootstrap-select">
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
                                                            class="form-control bootstrap-select">
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
                                                            class="form-control bootstrap-select">
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
                                                            class="form-control bootstrap-select">
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
                                                            class="form-control bootstrap-select">
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
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-col-teal">
                                <div class="panel-heading" role="tab" id="headingThree_17">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion_17" href="#collapseThree_17" aria-expanded="false"
                                            aria-controls="collapseThree_17">
                                            <i class="material-icons">group</i> Parent Guardian Detail  <i class="material-icons pull-right">add</i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_17" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingThree_17">
                                    <div class="panel-body">
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
                                                                    <input type="text" name="guardian_address"
                                                                        id="guardian_address" class="form-control 
                                                        text-capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-col-orange">
                                <div class="panel-heading" role="tab" id="headingFour_17">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion_17" href="#collapseFour_17" aria-expanded="false"
                                            aria-controls="collapseFour_17">
                                            <i class="material-icons">cloud_download</i> Upload Documents  <i class="material-icons pull-right">add</i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour_17" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingFour_17">
                                    <div class="panel-body">
                                        <section>
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
                                        </section>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    </div>
                                </div>

                               
                            </div>
                           
                        </div>
                        <button type="submit" id="btn-sub" class="btn btn-success btn-block btn-lg">
        Save Admission
    </button>

                    </div>
                </div>
               
            </div>
        </div>
       
    </div>

    <!-- <form action="" method="post"> -->

 
<!-- </form> -->


    <!-- #END# Colorful Panel Items With Icon -->
</div>

@section('js')


<script type="text/javascript">
$(document).ready(function() {

   

    $('#btn-sub').on('click', function(){
      

    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var father_name = $('#father_name').val();
    var father_phone = $('#father_phone').val();
    var mother_name = $('#mother_name').val();
    var gender = $('#gender').val();
    var phone = $('#phone').val();
    var dob = $('#dob').val();
    var email = $('#email').val();
    var matrital = $('#matrital').val();
    var nationality = $('#nationality').val();
    var passport = $('#passport').val();
    var address = $('#address').val();
    var current_address = $('#current_address').val();
    var department_id = $('#department_id').val();
    var faculty_id = $('#faculty_id').val();
    var semester_id = $('#semester_id').val();
    var degree_id = $('#degree_id').val();
    var class_id = $('#class_id').val();
    var school_id = $('#school_id').val();
    var dateregistered = $('#dateregistered').val();
    var batch_id = $('#batch_id').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var user_id = $('#user_id').val();
    var image = $('#inputGroupFile01').val();
    var acceptance = 'accept';
    
     var _token = $('input[name="_token"]').val();

    // alert(class_id)

            // $student->dateregistered = date('Y-m-d');
            // $student->batch_id = $request->batch_id;
            // $student->acceptance = 'accept';


        $.ajax({
        type: "Post",
        url: '{{ route('admissions.save')}}',
        data: {
            '_token': _token,
            'first_name': first_name,
            'last_name': last_name,
            'father_name': father_name,
            'father_phone': father_phone,
            'mother_name': mother_name,
            'gender': gender,
            'phone': phone,
            'dob': dob,
            'email': email,
            'matrital': matrital,
            'nationality': nationality,
            'passport': passport,
            'address': address,
            'current_address': current_address,
            'department_id': department_id,
            'faculty_id': faculty_id,
            'semester_id': semester_id,
            'degree_id': degree_id,
            'class_id': class_id,
            'school_id': school_id,
            'dateregistered': dateregistered,
            'batch_id': batch_id,
            'acceptance': acceptance,
            'username': username,
            'password': password,
            'user_id': user_id,
        },
        success: function(data) {
            console.log(data);
            // success: function (data) {
            // toastr.options.closeButton = true;
            // toastr.options.closeMethod = 'fadeOut';
            // toastr.options.closeDuration = 100;
            // toastr.success(data.message);
            // }
        }
    });
    })






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

    // alert(1)
    //------------------Date Of Birth Change-----------
    $('#dob').datetimepicker({
        format:'Y-m-d',
        timepicker:false

    })
    //---------------------Browse image----------------
    $('#browse_file').on('click', function() {
        $('#image').click();
    })
    $('#image').on('change', function(e) {
        showFile(this, '#showImage');
    })

    // GET SEMESTER State
    $('#country_id').on('change', function(e) {
        var country_id = $(this).val();
        var state_id = $('#state_id')

        // alert(country_id)
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
        // $('#nice').val('nice');
        $('#degree_id').empty();
        $('#degree_id').append('This one');

        $.get("{{ route('dynamicDegrees') }}", {
            grade_id: grade_id
        }, function(data) {

            $.each(data, function(i, l) {
                console.log(data);
                $('#degree_id').append($('<option>').text(l.level).attr('value', l.id));

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
                $(department_id).append($('<option>').text(d.department_name).attr(
                    'value', d
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
                $(class_id).append($('<option>').text(c.class_name).attr('value', c
                    .class_code));

            })
        })
    });

    //---------------------------------------
    // function showFile(fileInput, img, showName) {
    //     if (fileInput.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             $(img).attr('src', e.target.result);
    //         }
    //         reader.readAsDataURL(fileInput.files[0]);
    //     }
    //     $(showName).text(fileInput.files[0].name)
    // };
    //------------------------------------------------------
    // {{----------------------------Update class Schedule Status---------------------}}  

    // $(document).ready(function() {

    //     // function Status(){
    //     $('.js-switch').change(function() {
    //         let status = $(this).prop('checked') === true ? 1 : 0;
    //         let studentId = $(this).data('id');
    //         // alert(studentId)
    //         $.ajax({
    //             type: "GET",
    //             dataType: "json",
    //             url: '{{ url('
    //             student / status / update ') }}',
    //             data: {
    //                 'status': status,
    //                 'student_id': studentId
    //             },
    //             success: function(data) {
    //                 console.log(data.message);
    //                 // success: function (data) {
    //                 toastr.options.closeButton = true;
    //                 toastr.options.closeMethod = 'fadeOut';
    //                 toastr.options.closeDuration = 100;
    //                 toastr.success(data.message);
    //                 // }
    //             }
    //         });
    //     });



    // }
    // })


    // alert(1)

})
</script>
@endsection