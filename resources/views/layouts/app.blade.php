@php
  use App\Http\Controllers\Controller;
  use App\Roll;
  use App\Marks;
  use App\HomeWork;
  use App\StudentUploadHomeWork;
  use App\MeritList;
  $students = Roll::onlineStudent();
  $homeworkCount = StudentUploadHomeWork::where('teacher_id', Auth::user()->teacher_id)->count();
  $resultCount = MeritList::where('roll_no', Session::get('studentSession'))->count();
  $markCount = Marks::where('roll_no', Session::get('studentSession'))->count();
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Academic Information System| (AIS)</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap 3.3.7 -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <!-- <link rel="stylesheet" href="{{asset('css/easion.css')}}"> -->
    <link rel="stylesheet" href="{{asset('css/app_style.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
{{-- <link rel="stylesheet" href="{{asset('js/teacher/css/easion.css')}}"> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script> --}}
    {{-- <script src="{{asset('js/teacher/js/chart-js-config.js')}}"></script> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{asset('/js/easion.js')}}"></script> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('inbox.compo')
@php
    use App\Inbox;
@endphp

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> -->
    @yield('css')
</head>

@include('table_style') 
<style>
.modal-header-store{
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color:#605ca8;
    /* part 3 start here okay */
    -webkit-bottom-top-left-radius: 5px;
    -webkit-bottom-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.btn-primary > a{
    text-decoration:none;
    font-weight: bold;
    color: #fff;
    font-size: 18px;
}

.btn-primary:hover {
  color: #fff;
  box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
  background:#290642;

}
.btn-primary{
    background:#393534;
    box-shadow: -10px 25px 50px rgba(0, 0, 0, 0.3);
}

.btn-primary > a:hover {
  /* color: #290642; */
  box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
  color: #DB0B1B;

}

.modal-header-edit{
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color:#581845;
    -webkit-bottom-top-left-radius: 5px;
    -webkit-bottom-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

#editContact{
    background-color:#581845;
    color:#fff
}

.modal-header-delete{
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color:#800000;
    -webkit-bottom-top-left-radius: 5px;
    -webkit-bottom-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.modal-header-show{
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color:#FFC300;
    -webkit-bottom-top-left-radius: 5px;
    -webkit-bottom-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

#AddRows{
    background-color:#C70039;
}
.modal-title{
    color:#ffff;
}

div > input{
    border-radius:3px;
    height:40px;
}

textarea.form-control {
    border-radius: 1rem;
	font-size: 15px;
    border:1px solid #cccccc;
	outline: 0;
	-webkit-appearance: none;
}

textarea.form-control:focus {
	border-color: #339933;
}

[class^='select2'] {
    border-radius: 1rem;
    border-color: #339933;
    font-size: 15px;
}

select{
    border-radius: 1rem;
}


.selectWarapper{
  border-radius:20px;
  /* display:inline-block; */
  overflow:hidden;
  /* background:#cccccc; */
  border:1px solid #cccccc;
}
/* Customize the inpur (the form-control) */

input.form-control {
    border-radius: 1rem;
	-webkit-appearance: none;
    height:30px;
    border:1px solid #cccccc;
    font-size: 15px;
}
input.form-control:focus {
	border-color: #339933;
}

i.fa{ /* Chrome, Firefox, Opera, Safari 10.1+ */
    /* border: 1px solid #ccc;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-moz-box-shadow: 2px 2px 1px #666;
	-webkit-box-shadow: 2px 2px 1px #666; */
	/* box-shadow: 2px 2px 3px #666;  */
    border-radius: 1rem;
	/* font-size: 17px; */
	/* padding: 4px 7px; */
	outline: 0;
	-webkit-appearance: none;
    /* height:30px; */
}

.glyphicon{ /* Chrome, Firefox, Opera, Safari 10.1+ */
    
    border-radius: 1rem;
	outline: 0;
	-webkit-appearance: none;
    /* height:30px; */
}

.line{
    border: none;
    height: 3px;
    /* Set the hr color */
    color: #03C49E; /* old IE */
    background-color: #024181;
    padding-bottom:2px;
    margin-top:2px;
 /* Modern Browsers */
}


/* Customize CheckBo the label (the container1) */
.container2 {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container2 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container2:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container2 input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container2 input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container2 .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}


/* Customize Radio Button the label (the container) */
.container1 {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container1 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom radio button */
.checkmark-redio {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container1:hover input ~ .checkmark-redio {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container1 input:checked ~ .checkmark-redio {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark-redio:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container1 input:checked ~ .checkmark-redio:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container1 .checkmark-redio:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}

.modal-content  {
    -webkit-border-radius: 20px !important;
    -moz-border-radius: 20px !important;
    border-radius: 20px !important; 
}

.modal-dialog  {
    -webkit-border-radius: 20px !important;
    -moz-border-radius: 20px !important;
    border-radius: 20px !important; 
}

/* THE CSS PART START HERE OKAY */

#wait {
  display:none;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 70px;
  height: 70px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* // SO THATS THE CODE OF SPINNER OKAY */

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

    fieldset > label {
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

label >b{
        color:red;
        font-size:13px
    }

select {
    -webkit-appearance: none;
    -webkit-border-radius: 0px; 
}


</style>


<body class="skin-purple-light sidebar-mini sidebar-collapse ">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>(AIS) ACADEMIC INFORMATION SYSTEM</b>
            </a>
            @php
            $messagecount =  Inbox::where('user_id',Auth::user()->id)->count();

            $usermessage = Inbox::join('users', 'users.id', '=', 'inboxes.user_id' )
                                 ->join('teachers', 'teachers.teacher_id','=', 'users.teacher_id')->get();

          @endphp
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu ">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <span><i class="fa fa-envelope fa-lg"><sup class="badge" style="background:red; ">
                                  {{ $messagecount}}
                                </sup></i></span>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                {{-- <span class="hidden-xs">Message</span> --}}
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header" style="background-color: white">
                                @foreach ( $usermessage as $item)

                               <a href="/inboxes">{{ $item->subject}}</a>

                                @endforeach
                                </li>
                                <!-- Menu Footer-->
                                    <li class="user-footer">

                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <span><i class="fa fa-globe fa-lg"></i><sup class="badge" style="background:red; ">{{$homeworkCount+$resultCount+$markCount}}</sup></span>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                {{-- <span class="hidden-xs">Notification</span> --}}
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <!-- <li class="user-header"> -->
                                @if($homeworkCount)
                                <li>
                                    <a href="{{url('homework-list')}}">
                                    <i class="fa fa-users text-aqua"></i> {{$homeworkCount}} new submit Homework
                                    </a>
                                    @else
                                </li>
                                @endif
                               <!-- <p> {{$homeworkCount}}</p>
                                    here is the notifaction -->
                              
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="http://infyom.com/images/logo/blue_logo_150x150.jpg"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="http://infyom.com/images/logo/blue_logo_150x150.jpg"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        {!! Auth::user()->name !!}
                                        <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                    <li class="user-footer">
                                    <div class="pull-left" >
                                        <a href="/lockscreen" class="btn btn-default btn-flat">Lock Screen</a>
                                    </div>
                                    <div class="pull-left" style="margin-left:10px">

                                        @if(Auth::user()->user_role == 1)
                                        <a href="{!! route('teachers.show', Auth::user()->id) !!}" class="btn btn-default btn-flat">Profile</a>
                                        @else
                                        <a href="{!! route('teachers.show', Auth::user()->teacher_id) !!}" class="btn btn-default btn-flat">Profile</a>
                                        @endif
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! route('logout-action') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout-action') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2016 <a href="#">Company</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container1">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/') !!}">
                    InfyOm Generator
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/home') !!}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/login') !!}">Login</a></li>
                    <li><a href="{!! url('/register') !!}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container1-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jQuery 3.1.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

     <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css"> -->
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/jquery-validate/1.19.1/additional-methods.min.js"></script>
    <script type="text/javascript" src=" https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

    <script src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{url('/js/bootstrap-datepicker.js')}}"></script>

    @yield('scripts')

<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {

    $('.select_2_single').select2({width: '100%', hight: '100%'});
});

$(document).ready(function() {
    $('.select_2_multiple').select2({width: '100%', hight: '100%'});
});

$(".js-example-responsive").select2({
    width: 'resolve',
    height: 'resolve' // need to override the changed default
});


$("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, 5000 ); // 5 secs

});

// var elem = document.querySelector('.js-switch');
// var init = new Switchery(elem);

// BUT FOR ME I WILL USE THIS ONE I HAVE ALREADY IMPLEMET OKAY

// var and let is all the same in jquery i=okay

// -------------------------------start here------------------------------------------
let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    // let switchery = new Switchery(html,  { size: 'small' }); // you can change the size from here okay
    let switchery = new Switchery(html, { color: '#0A9913',  secondaryColor: '#F80A20', jackColor: '#fff',
     jackSecondaryColor: '#fff' });
});

// ---------------------------------------end's here okay----------------------------------

// WHY I NORMALLY PUT CODE IN THE APP BECAUSE THE APP IS MASTER HEAD OF THE APPLICATION
// SO THAT I WILL BE GLOBAL FUNCTION OKAY FOR THE ENTIRE APPLICATION.

$(document).ready(function(){
  $(document).ajaxStart(function(){
    $("#wait").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait").css("display", "none");
  });
});

// THATS THE CODE FOR LOADING PART OKAY THE AJAX PART

// SO NOW LET'S GO TO THE CSS PART OKAY.

</script>

{{-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}
{{-- 
<script>
        CKEDITOR.replace( 'editor1',{
        // skin : 'office2003',
        height: '70',
        toolbarLocation : 'bottom'
        });
        config.toolbarLocation = 'bottom';
        // config.height = 100;
</script> --}}

{{-- <script>
    $(document).ready(function(){
        $('#tags').tagsInput({
        width: 'auto',
        onAddTag: addTag,
        onRemoveTag: removeTag,
        delimiter: [',', ';', ' ']
    });

    $('#tags').importTags('tags');
    })

    </script> --}}


</body>
</html>
