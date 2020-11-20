@extends('layouts.front_end')

@php

use App\Institute;

$institute = Institute::first();

@endphp

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
        border: 0;
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
        font-size:13px;
        border: 0;
    }

    input[name=username] {
    pointer-events: none;
    border: 0px solid #ffff !important;
    border: 1px solid #ffff;
 }

 .username{
    border: 0px solid #ffff !important;

 }

 .roll{
     font-size:12px
 }

 .onlineform .form-control {
    border-radius: 30px;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
    border-bottom-right-radius: 30px;
    border-bottom-left-radius: 30px;
}

textarea.form-control {
    height: auto;
}

textarea {
    resize: none;
    padding: 10px;
    border-radius: 0;
}

.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

</style>
@section('content')
{{-- the code start here --}}
<div class="academy-courses-area section-padding-100-0" id="content_hide">
<div class="container">
        <!-- <div class="col-lg-12"> -->
        <form method="post" href="{{route('StudentTakeAdmission')}}"  enctype="multipart/form-data" class="onlineform" id="onlineform" autocomplete="off">
        @csrf

          {{-- modal body start here --}}
          <div class="modal-body">
        {{---------------------------}}
            <div class="panel-heading">
                <h3><i class="fa " style="font-weight:bold; border:none"></i> ONLINE ADMISSION  <b class="pull-right1">
                <div class="row">
               <b class="roll col-md-4">Registration No.</b>
                <input type="text" class="form-control col-md-9 username"  name="username" id="username" value="{{ $rand_username_password}}"></b></h3>
                <input type="hidden" name="password" id="password" value="{{ $rand_username_password}}">
                </div>
                </div>
                {{-------------------------image-----------------}}
    
    <div class="col-lg-2 col-md-2 col-sm-3 pull-right">
    <div class="form-group pull-right">
    <table style="margin:0 auto; height:2%; width:4%">
    <fieldset>
    <legend for="gender">Image <b class="optional"> optional</b></legend>
    <thead>
        <tr class="info">
        </tr>
        </thead>
        <tbody>
        <tr>
    <td class="image">
{{-- Html::image is the same as asset okay they all calling from public folder okay --}}
        {!!Html::image('teacher_images/profile.jpg', 
        null, ['class'=>'teacher-image', 'id'=>'showImage'])!!}
        <input type="file" name="image" id="image"
        accept="image/x-png,image/png,image/jpg,image/jpeg">
    </td>
</tr>
<tr>
    <td style="text-align:center;background:;">
    <input type="button" name="browse_file" id="browse_file" 
    class="form-control  text-capitalize btn-choose" 
    class="btn btn-outline-danger" value="Choose">
    </td>
    </tr>
</tbody>
</table>
</fieldset>
</div>
</div>
<!-- </div>
</div> -->

<div class="panel-heading">
                <b><i class="fa fa-user"></i>  Student Infomation</b>
                <b class="pull-right"></b>
                </div>  
                <br> 
                <!-- <hr class="line">  -->
                <div class="panel-body">
 
        {{---------------First Name------------------}}
    <div class="row">
    <div class="col-md-4">
    <div class="form-group" >
    <fieldset>
    <legend for="gender">First Name <b> *</b></legend>
    <input type="text" name="first_name" id="first_name" class="form-control 
    text-capitalize"placeholder="Enter First Name Here" required>
    </fieldset>
    </div>
    </div>

{{---------------Last Name------------------}}

    <div class="col-md-4">
    <div class="form-group" >
    <fieldset>
    <legend for="gender">Last Name <b> *</b></legend>
    <input type="text" name="last_name" id="last_name" class="form-control  
    text-capitalize"placeholder="Enter Last Name Here" required>
    </fieldset>
    <input type="hidden" value="{{Auth::id()}}" name="user_id" id="user_id" >
    <input type="text" class="form-control" name="dateregistered" id="dateregistered" 
    readonly value="{{date('Y-m-d')}}">
    </div>
    </div>

    {{--------------------Email-----------------}}
            <div class="col-md-4">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Email <b> *</b></legend>
            <input type="text" name="email" id="email" class="form-control 
                         " placeholder="Enter Email " required>
            </fieldset>
            </div>
            <span id="error_email"></span>
            </div>

    </div>
    </div>
       
            {{--------------Gender------------------}}
    <div class="row">
    <div class="col-md-4">
    <div class="form-group" >
        <fieldset>
        <legend style="text-align:center1">Gender <b> *</b></legend>
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
        </fieldset>
        </div>
        </div>

                        {{----------------------Status------------------}}
    
    <div class="col-md-4">
        <div class="form-group" >
        <fieldset>
        <legend style="text-align:center1">Status <b> </b></legend>
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
        </fieldset>
        </div>
        </div>
            {{------------DOB-----------------}}
    
    <div class="col-md-4">
    <div class="form-group">
    <fieldset>
    <legend for="gender">Date of Birth <b> </b></legend>
    <input type="text" name="dob" id="dob" class="form-control  text-capitalize"
    placeholder="YYY-MM-DD" autocomplete="off">
    </fieldset>
    </div>
    </div>
    <!-- </div>
    </div> -->

            {{--------------------Nationality-----------------}}
        <!-- <div class="row"> -->
        <div class="col-md-4">
        <div class="form-group">
        <fieldset>
        <legend for="gender">Nationality <b> *</b></legend>
        <input type="text" name="nationality" id="nationality" class="form-control 
                        text-capitalize" placeholder="Enter Nationality " required>
        </fieldset>
        </div>
        </div>

            {{--------------------Passport-----------------}}
        <div class="col-md-4">
        <div class="form-group">
        <fieldset>
        <legend for="gender">Passport <b> </b></legend>
        <input type="text" name="passport" id="passport" class="form-control  text-capitalize"
                        placeholder="Enter Passport Number" >
        </fieldset>
        </div>
        </div>

            {{--------------------Phone-----------------}}
            <div class="col-md-4">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Phone <b> *</b></legend>
            <input type="text" name="phone" id="phone" class="form-control 
                         text-capitalize" placeholder="Enter Phone Number Here" required>
            </fieldset>
            </div>
            </div>
            {{--------------------Pamanet Address-----------------}}
            <div class="col-md-6">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Pamanet Address <b> </b></legend>
            <textarea placeholder="Enter Address " name="address" id="address"
            cols="40" rows="2" class="form-control  text-capitalize"></textarea>
            </fieldset>
            </div>
            </div>
            {{--------------------Current Address-----------------}}
            <div class="col-md-6">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Current Address <b> </b></legend>
            <textarea placeholder="Enter Current Address " name="current_address" id="current_address"
            cols="40" rows="2" class="form-control  text-capitalize"></textarea>
            </fieldset>
            </div>
            </div>

            </div>
                     

            <div class="panel-heading">
                <b><i class="fa fa-book"></i>  Academic Infomation</b>
                <b class="pull-right"></b>
                </div>   
                <hr class="line"> 
                <div class="panel-body">
            {{--------------------Grade-----------------}}
            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Grade <b> *</b></legend>
            <div class="selectWarapper">
            <select name="semester_id" id="semester_id" class="form-control select_2_single" required>
                <option value="0" selected="true" disabled="true">Choose Grade</option>
                 @foreach($Semester as $Semes)
                <option value="{{$Semes->id}}">{{$Semes->semester_name}} </option>
                @endforeach
            </select>
            </div>
            </fieldset>
            </div>
            </div>

              {{--------------------Degree-----------------}}
              <div class="col-md-4">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Level <b> *</b></legend>
                <div class="selectWarapper">
                <select name="degree_id" id="degree_id" class="form-control select_2_single" required>
                <option value="0" selected="true" disabled="true">Choose Level</option>
               
                </select>
                </div>
                </fieldset>
                </div>
                </div>

                {{--------------------Faculty-----------------}}
                <div class="col-md-4">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Student Group <b> *</b></legend>
                <div class="selectWarapper">
                <select name="faculty_id" id="faculty_id" class="form-control select_2_single" required>
                <option value="0" selected="true" disabled="true">Choose Student Group</option>
                @foreach($faculties as $faculty)
                <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}} </option>
                @endforeach
                </select>
                </div>
                </fieldset>
                </div>
                </div>
                </div>
                <div class="row">
                {{--------------------Department-----------------}}
                <div class="col-md-4">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Class Group <b> *</b></legend>
                <div class="selectWarapper">
                <select name="department_id" id="department_id" class="form-control select_2_single" required>
                <option value="0" selected="true" disabled="true1">Choose Class Group</option>

                </select>
                </div>
                </fieldset>
                </div>
                </div>

            {{--------------------Classes-----------------}}
            <div class="col-md-4">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Class <b> *</b></legend>
                <div class="selectWarapper">
                <select name="class_id" id="class_id" class="form-control select_2_single" required>
                <option value="" selected="true" disabled="true">Choose Class</option>
                {{-- @foreach($classes as $class)
                <option value="{{$class->class_code}} " >{{$class->class_name}} </option>
                @endforeach --}}
                </select>
                </div>
                </fieldset>
                </div>
                </div>
            {{-- </div> --}}

             {{--------------------Batch-----------------}}
             <div class="col-md-4">
                <div class="form-group">
                <fieldset>
                <legend for="gender">Batch <b> *</b></legend>
                <div class="selectWarapper">
                <select name="batch_id" id="batch_id" class="form-control select_2_single" required>
                <option value="0" selected="true" disabled="true">Choose Batch</option>
                @foreach($batches as $batch)
                @if($batch->is_current_batch == 1)
                <option value="{{$batch->id}}">{{$batch->batch}} </option>
                @endif
                @endforeach
                </select>
                </div>
                </fieldset>
                </div>
                </div>
            </div>
            </div>

            <div class="panel-heading" style="margin-top1: -20px;">
            <b><i class="fa fa-map-marker"></i> Guadians Details</b>
            </div>
            <hr class="line">
            <div class="panel-body">

            {{---------------Father Name------------------}}
            <div class="row">
            <div class="col-md-4">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Father Name <b> *</b></legend>
            <input type="text" name="father_name" id="father_name" class="form-control 
            text-capitalize" placeholder="Enter Father Name" required>
            </fieldset>
            </div>
            </div>

            {{---------------Father Phone Number------------------}}

            <div class="col-md-4">
            <div class="form-group">
            <fieldset>
            <legend for="gender">Father Phone Number <b> *</b></legend>
            <input type="text" name="father_phone" id="father_phone" class="form-control 
            text-capitalize" placeholder="+220 000 000 000" required>
            </fieldset>
            </div>
            </div>

            {{--------------- Mother Name------------------}}

            <div class="col-md-4">
            <div class="form-group">
            <fieldset>
            <legend for="gender"> Mother Name <b> </b></legend>
            <input type="text" name="mother_name" id="mother_name" class="form-control 
            text-capitalize" placeholder="Enter Mother Name" >
            </fieldset>
            </div>
            </div>
            </div>
            <!-- </div> -->
        </div>   <!-- modal-body end here -->  

                    <div class="modal-footer">
                   <a href="{{url('/')}}"> <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button></a>
                     {!! Form::button('Register Student', ['class' => 'btn btn-success', 'id'=>'btnRegister']) !!}
          </div><!-- moda-footer end here -->

        </div>
      </div>
      </div>
      </div>
      </div>
      </div>

{!! Form::close() !!}


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
<a href="{{url('/')}}"> <button type="button" class="btn btn-danger" data-dismiss="modal">Okay</button></a>
<!-- {!! Form::button('Register Student', ['class' => 'btn btn-success', 'id'=>'btnRegister']) !!} -->
</div>
</div>

</div>
</div>
@endsection