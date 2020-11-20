@extends('layouts.websiteLayout.app')

@section('content')

<?php 
use App\Institute;

$url = request()->segment(3);

if(auth()->user()){
  $institute =  Institute::where('school_id', auth()->user()->school_id)
  ->join('schools', 'schools.id', '=', 'institute.school_id')->get();
}
else {
  $institute =  Institute::where('web', $url)
  ->join('schools', 'schools.id', '=', 'institute.school_id')->get();
}


?>

    
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Admissions</h2>
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p> -->
              @foreach($batches as $batch) 
              <p>{{$batch->name}} </p>
              <p>{{$batch->session}}  {{$batch->batch}} </p>
              @endforeach
            </div>
          </div>
        </div>
      </div> 
      @include('flash::message')

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{url('school/website')}}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Admissions</span>
      </div>
    </div>

    <div class="site-section" id="content_hide">
        <div class="container">
        <div class="row">
        <!-- <div class="roll col-md-12 btn-bg"><b style="margin-right:5px;  justify:center">Registration No.</b></div> -->
        <form method="post" href="{{route('StudentTakeAdmission')}}"  enctype="multipart/form-data" class="onlineform" id="onlineform">
        @csrf
               
               <!-- <div class="col-md-6"> -->
                 <br>
               @if(auth()->user())
                    <input type="hidden" readonly class="form-control col-md-9 username"  name="username" id="username1" value="{{auth()->user()->school_id}}{{ $rand_username_password}}">
                    <input type="hidden" name="password" id="password" value="{{auth()->user()->school_id}}{{ $rand_username_password}}">
                    <input type="hidden" id="school_id" name="school_id" value="{{auth()->user()->school_id}}" class="form-control form-control-lg">
                    @else
                    @foreach($contact_us as $contact)
                    <div class="col-md-12" >
                    <input type="hidden" id="school_id" name="school_id" value="{{$contact->school_id}}" class="form-control form-control-lg">
                    <input type="hidden" class="form-control col-md-9 username"  name="username" id="username1" value="{{$contact->school_id}}{{ $rand_username_password}}" readonly></b>
                    <input type="hidden" name="password" id="password" value="{{$contact->school_id}}{{ $rand_username_password}}">
                    </div>
                @endforeach
                @endif
                </div>
                

                <div class="row">
              <div class="col-lg-6">
                <div class="post-entry-big ">
                <div class="image">
                    {!!Html::image('teacher_images/profile.jpg', 
                    null, ['class'=>'teacher-image', 'id'=>'showImage'])!!}
                    <input type="file" name="image" id="image"
                    accept="image/x-png,image/png,image/jpg,image/jpeg"  style="cursor:pointer">
                    <span id="browse_file" ></span>
                    <input type="button" name="browse_file" 
                    class="form-control  text-capitalize btn-choose" 
                    class="btn btn-outline-danger" value="Choose" style="display:none">
                    </div>
                </div>
              </div>
            </div>
              <br>
            <div class="row justify-content-center1">
                <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-12 form-group btn-bg" >
                    <b class=""><i class="fa fa-user"></i>  Student Infomation</b>
                    <b class="pull-right"></b>
                    </div>  
                    <br> 
                    <br> 
            {{---------------First Name------------------}}
                  <div class="col-md-4">
                  <div class="form-group" >
                  <label for="gender">First Name <b> *</b></label>
                  <input type="text" name="first_name" id="first_name" class="form-control 
                  text-capitalize"placeholder="Enter First Name Here" required>
                  </div>
                  </div>

          {{---------------Last Name------------------}}

              <div class="col-md-4">
              <div class="form-group" >
              <label for="gender">Last Name <b> *</b></label>
              <input type="text" name="last_name" id="last_name" class="form-control  
              text-capitalize"placeholder="Enter Last Name Here" required>
            
              <input type="hidden" value="{{Auth::id()}}" name="user_id" id="user_id" >
              <input type="hidden" class="form-control" name="dateregistered" id="dateregistered" 
              readonly value="{{date('Y-m-d')}}">
              </div>
              </div>

    {{--------------------Email-----------------}}
            <div class="col-md-4">
            <div class="form-group">
            <label for="gender">Email <b> *</b></label>
            <input type="text" name="email" id="email" class="form-control 
                         " placeholder="Enter Email " required>
            </div>
            <span id="error_email"></span>
            </div>
          <!-- </div> -->
          <!-- </div> -->
            {{--------------Gender------------------}}
    <!-- <div class="row"> -->
          <div class="col-md-4">
          <div class="form-group" >
            
              <label style="text-align:center1">Gender <b> *</b></label>
              <table style="width:100%;" required>
              <tr style="border-bottom: 0px solid #ccc;">
              <td>
                  <label class="container1">Male
                  <input type="radio" name="gender" id="gender" value="0" * checked >
                  <span class="checkmark-redio"></span>
                  </label>
              </td>
              <td>
              <label class="container1">Female
                  <input type="radio" name="gender" id="gender" value="1" *>
                  <span class="checkmark-redio"></span>
                  </label>
              </td>
              </tr>
              </table>
            
              </div>
              </div>

            {{----------------------Status------------------}}
    
            <div class="col-md-4">
                <div class="form-group" >
              
                <label style="text-align:center1">Status <b> </b></label>
                <table style="width:100%">
                <tr style="border-bottom: 0px solid #ccc;">
                <td>
                    <label class="container1">Single
                    <input type="radio" name="status" id="status" value="0" * checked>
                    <span class="checkmark-redio"></span>
                    </label>
                </td>
                <td>
                <label class="container1">Married
                    <input type="radio" name="status" id="status" value="1" *>
                    <span class="checkmark-redio"></span>
                    </label>
                </td>
                </tr>
                </table>
       
              </div>
              </div>
            {{------------DOB-----------------}}
    
            <div class="col-md-4">
            <div class="form-group">
          
            <label for="gender">Date of Birth <b> </b></label>
            <input type="text" name="dob" id="attendance_date" class="form-control  text-capitalize"
            placeholder="YYY-MM-DD" autocomplete="off">
          
            </div>
            </div>

            {{--------------------Nationality-----------------}}
            <div class="col-md-4">
            <div class="form-group">
          
            <label for="gender">Nationality <b> *</b></label>
            <input type="text" name="nationality" id="nationality" class="form-control 
                            text-capitalize" placeholder="Enter Nationality " required>
          
            </div>
            </div>
            {{--------------------Passport-----------------}}
            <div class="col-md-4">
            <div class="form-group">
          
            <label for="gender">Passport <b> </b></label>
            <input type="text" name="passport" id="passport" class="form-control  text-capitalize"
                            placeholder="Enter Passport Number" >
          
            </div>
            </div>
            {{--------------------Phone-----------------}}
            <div class="col-md-4">
            <div class="form-group">
           
            <label for="gender">Phone <b> *</b></label>
            <input type="text" name="phone" id="phone" class="form-control 
                         text-capitalize" placeholder="Enter Phone Number Here" required>
           
            </div>
            </div>
            {{--------------------Pamanet Address-----------------}}
            <div class="col-md-6">
            <div class="form-group">
            <label for="gender">Pamanet Address <b> </b></label>
            <textarea placeholder="Enter Address " name="address" id="address"
            cols="40" rows="2" class="form-control  text-capitalize"></textarea>
            </div>
            </div>
            {{--------------------Current Address-----------------}}
            <div class="col-md-6">
            <div class="form-group">
            <label for="gender">Current Address <b> </b></label>
            <textarea placeholder="Enter Current Address " name="current_address" id="current_address"
            cols="40" rows="2" class="form-control  text-capitalize"></textarea>
            </div>
            </div>
            
            <div class="col-md-12 form-group btn-bg">
            <b>  Academic Infomation</b>
                <b class="pull-right"></b>
                </div>   
                <hr> 
                <!-- <div class="panel-body"> -->
            {{--------------------Grade-----------------}}
            <!-- <div class="row"> -->
            <div class="col-md-4">
            <div class="form-group">
            <label for="gender">Grade <b> *</b></label>
            <div class="selectWarapper">
            <select name="semester_id" id="semester_id" class="form-control select_2_single" required>
                <option value="0" selected="true" disabled="true">Choose Grade</option>
                 @foreach($Semester as $Semes)
                <option value="{{$Semes->id}}">{{$Semes->semester_name}} </option>
                @endforeach
            </select>
            </div>
            </div>
            </div>
            <!-- </div> -->

              {{--------------------Degree-----------------}}
              <div class="col-md-4">
              <div class="form-group">
              <label for="gender">Level <b> *</b></label>
              <div class="selectWarapper">
              <select name="degree_id" id="degree_id" class="form-control select_2_single" required>
              <option value="0" selected="true" disabled="true">Choose Level</option>
              </select>
              </div>
              </div>
              </div>

                {{--------------------Faculty-----------------}}
                <div class="col-md-4">
                <div class="form-group">
                <label for="gender">Student Group <b> *</b></label>
                <div class="selectWarapper">
                <select name="faculty_id" id="faculty_id" class="form-control select_2_single" required>
                <option value="0" selected="true" disabled="true">Choose Student Group</option>
                @foreach($faculties as $faculty)
                <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}} </option>
                @endforeach
                </select>
                </div>
                </div>
                </div>

                <!-- <div class="row"> -->
                {{--------------------Department-----------------}}
                <div class="col-md-4">
                <div class="form-group">
                <label for="gender">Class Group <b> *</b></label>
                <div class="selectWarapper">
                <select name="department_id" id="department_id" class="form-control select_2_single" required>
                <option value="0" selected="true" disabled="true1">Choose Class Group</option>
                </select>
                </div>
                </div>
                </div>

            {{--------------------Classes-----------------}}
                <div class="col-md-4">
                <div class="form-group">
                <label for="gender">Class <b> *</b></label>
                <div class="selectWarapper">
                <select name="class_id" id="class_id" class="form-control select_2_single" required>
                <option value="" selected="true" disabled="true">Choose Class</option>
                </select>
                </div>
                </div>
                </div>

             {{--------------------Batch-----------------}}
                <div class="col-md-4">
                <div class="form-group">
                <label for="gender">Batch <b> *</b></label>
                <div class="selectWarapper">
                <select name="batch_id" id="batch_id" class="form-control select_2_single" required>
                <option value="0" selected="true" disabled="true">Choose Batch</option>
                @foreach($batches as $batch)
                <option value="{{$batch->batch_id}}" selected>{{$batch->batch}} </option>
                @endforeach
                </select>
                </div>
                </div>
                </div>
                
                <div class="col-md-12 form-group btn-bg">
                <b></i>Guadians Details</b>
                  <b class="pull-right"></b>
                  </div>   
                  <hr> 

                {{---------------Father Name------------------}}
                <div class="col-md-4">
                <div class="form-group">
                <label for="gender">Father Name <b> *</b></label>
                <input type="text" name="father_name" id="father_name" class="form-control 
                text-capitalize" placeholder="Enter Father Name" required>
                </div>
                </div>

                {{---------------Father Phone Number------------------}}

                <div class="col-md-4">
                <div class="form-group">
                <label for="gender">Father Phone Number <b> *</b></label>
                <input type="text" name="father_phone" id="father_phone" class="form-control 
                text-capitalize" placeholder="+220 000 000 000" required>
                </div>
                </div>

                {{--------------- Mother Name------------------}}

                <div class="col-md-4">
                <div class="form-group">
                <label for="gender"> Mother Name <b> </b></label>
                <input type="text" name="mother_name" id="mother_name" class="form-control 
                text-capitalize" placeholder="Enter Mother Name" >
              
                </div>
                </div>
                </div>
                  </div>
                  </div>

                    <!-- <div class="row"> -->
                    <div class="modal-footer">
                    @foreach($institute as $institute)
                   <a href="{{url()->previous()}}" class="btn btn-danger"> Cancel</a>
                     @endforeach
                     {!! Form::button('Submit Application', ['class' => 'btn btn-bg', 'id'=>'btnRegister']) !!}
          </div><!-- moda-footer end here -->

                    <!-- </div> -->
                </div>
            </div>
            </form>

          
        </div>
    </div>

    
<div class="academy-courses-area section-padding-100-0" id="content_show">
<div class="container">


<div class="panel">
<div class="modal-body" style="text-align:center">
<h3 >Thank you for filling out your information!</h3>

<p>We’ve sent you an email with your login credentials username and password<br>
    at the email address you provided. Please enjoy, and let us know if there’s anything else we can help you with. <br>

The {{$institute->name}}</p>

</div>
<div class="modal-footer">
<a href="{{url('school/site/' .$institute->web)}}"> <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button></a>
</div>
</div>

</div>
</div>

@endsection