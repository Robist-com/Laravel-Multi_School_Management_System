<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
    @php
    use App\Http\Controllers\Controller;
    use App\Roll;
    use App\Marks;
    use App\HomeWork;
    use App\Institute;
    use App\StudentUploadHomeWork;
    use App\MeritList;
    use App\School;

    $url = request()->segment(2);
    $url_web = request()->segment(1);

    if(Institute::where('school_id') != ''){
    $institute = Institute::where('school_id', auth()->user()->school_id)->get();
    }
    else{
    $systemLogo = Institute::where('school_id', null)->first();
    }

    $school = School::where('id', auth()->user()->school_id)->get();

     if(auth()->user()){
        $institute_web =  Institute::where('institute.school_id', auth()->user()->school_id)
        ->join('schools', 'schools.id', '=', 'institute.school_id')->first();
        }
        else {
        $institute_web =  Institute::where('web', $url_web)
        ->join('schools', 'schools.id', '=', 'institute.school_id')->first();
        }


    $students = Roll::onlineStudent();
    $homeworkCount = 0;
    if(isset($homeworkCount)){
    $homeworkCount = StudentUploadHomeWork::where('teacher_id', Auth::user()->teacher_id)->count();
    }
    $submited_students = StudentUploadHomeWork::join('admissions', 'admissions.id', '=',
    'student_upload_homeworks.student_id')
    ->join('courses', 'courses.id', '=', 'student_upload_homeworks.subject_id')
    ->join('classes', 'classes.class_code', '=', 'student_upload_homeworks.class_code')
    ->where('teacher_id', Auth::user()->teacher_id)
    ->get();


    $resultCount = MeritList::where('roll_no', Session::get('studentSession'))->count();
    $markCount = Marks::where('roll_no', Session::get('studentSession'))->count();


    use App\Permission;

    use App\Http\Controllers\instituteController;
    $get_grad = new instituteController;
    $system_grade = $get_grad->index1();
    $get_permission = new Permission;
    $permissions = $get_permission->get_permission_by_role();
    $permision =array();
    foreach($permissions as $permission){
    $permision[] = $permission->permission_name;
    }


    use App\Models\ClassSchedule;
    $teacher_id = Auth::user()->teacher_id;
    $teacherclass = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
    ->select('semesters.id as semester_id','semesters.*','courses.*',
    'classes.id as class_id','classes.*')
    ->where(['teacher_id' => $teacher_id])
    ->first();

    $settings = '';

    @endphp

    <?php
    $template = App\Institute::where('school_id', auth()->user()->school_id)->first();
    ?>

    <style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
    }

    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate (-50%, - 50%);
        font: 14px arial;
    }

    #loader {
        visibility: hidden;
    }

    #wait {
        visibility: hidden;
    }

    #loading {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100vw;
        height: 100vh;
        background-color: rgba(192, 192, 192, 0.5);
        background-image: url("https://i.stack.imgur.com/MnyxU.gif");
        background-repeat: no-repeat;
        background-position: center;
    }

    border-top: 16px solid #3498db;
    /* Blue */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    top: 40%;
    left:35%;
    animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    */ .table-bordered {
        text-align: center !important
    }

    th {
        text-align: center;
    }

    td {
        text-align: center;
    }

/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

input{
    text-transform: capitalize !important;
}

    </style>



    @include('layouts.new-layouts.head')
    <!-- Themes Color -->
    <link href="{{asset('css/theme_swicher/themes_color.css')}}" rel="stylesheet">
    <!-- color CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">

    <link href="{{ asset('css/colors/blue.css') }}" id="theme" rel="stylesheet">

    <link href="" id="theme" rel="stylesheet">


    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if($institute)
    @foreach($institute as $key => $institute)
    <title>(AIS {{$institute->name}})</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('institute_logo/' .$institute->image) }}">

    @endforeach
    @endif

</head>


<body class="nav-md">

    <div class="preloader">
        <div class="loading">
            <!-- <img src = "https://i.stack.imgur.com/MnyxU.gif" width = "80">  -->
            <div class="fa fa-spinner fa-spin fa-5x" width="200"></div>
            <p> Please Wait </p>
        </div>
    </div>

    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <!-- sidebar fixed -->
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{url('home')}}" class="site_title"><span>
                                @if(auth()->user()->group == "Admin")
                                @foreach(Institute:: where('school_id' , null)->get() as $key => $institu)
                                {{$institu->name}}
                                @endforeach
                                @else
                                @foreach(Institute:: where('school_id' , auth()->user()->school_id)->get() as $key =>
                                $inst)
                                {{$inst->name}}
                                @endforeach
                                @endif
                            </span></a>
                    </div>




                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <!-- Favicon{{Institute:: where('school_id' , null)->get() }} -->
                            @if(auth()->user()->group == "Admin")
                            @foreach(Institute:: where('school_id' , null)->get() as $key => $institu)
                            <img src="{{ asset('institute_logo/' .$institu->image) }}" alt="..."
                                class="img-circle profile_img">
                            @endforeach
                            @else
                            @foreach(Institute:: where('school_id' , auth()->user()->school_id)->get() as $key =>
                            $inst)
                            <img src="{{ asset('institute_logo/' .$inst->image) }}" alt="..."
                                class="img-circle profile_img">
                            @endforeach
                            @endif
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{auth()->user()->name}}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    @include('layouts.new-layouts.sidebar')
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->

                    @include('layouts.new-layouts.footer-menu')
                    <!-- /menu footer buttons -->

                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    @foreach(Institute:: where('school_id' , auth()->user()->school_id)->get() as $key
                                    => $inst)
                                    <img src="{{ asset('institute_logo/' .$inst->image) }}" alt="">
                                    @endforeach
                                    {{auth()->user()->name}}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a data-toggle="modal" data-target=".settings-modal">
                                            <!-- <span class="badge bg-red pull-right">50%</span> -->
                                            <span >Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li>
                                     <?php $school_web = App\Institute::where('school_id', auth()->user()->school_id)->first()?>
                                    <li><a href="{{url('student/logout/' .$school_web->web)}}"
                                            onclick1="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                                class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>
                           
                            <form id="logout-form" action="#" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    @if(isset($homeworkCount))
                                    <span class="badge bg-green">{{$homeworkCount+$resultCount+$markCount}} </span>
                                    @else
                                    <span class="badge bg-red">0</span>
                                    @endif
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    @if($homeworkCount != 0)
                                    @foreach($submited_students as $student)
                                    <li>
                                        <a href="{{url('get-student-homework/' .$student->id)}}">

                                            <span class="image"><img src="{{asset('student_images/' .$student->image)}}"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>{{$student->first_name .' ' . $student->last_name }}</span>
                                                <span class="time">{{$student->created_at->diffForHumans()}}</span>
                                            </span>
                                            <span class="message">
                                                @if(Carbon\Carbon::now() == $student->created_at)have submit homework
                                                from ({{$student->class_name .' '. $student->semester_id }}) @else has
                                                submit homework from
                                                ({{$student->class_name .' '. 'Grade' .$student->semester_id }})@endif
                                            </span>
                                        </a>
                                    </li>
                                    @endforeach
                                    @else
                                    <li>
                                        <b style="margin-left:60px">you have ({{$homeworkCount}}) notification.</b>
                                    </li>
                                    @endif
                                    @if($homeworkCount > 3)
                                    <li>
                                        <div class="text-center">
                                            <a href="{{url('homework-list')}}">
                                                <strong>See All Homewors</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </li>

                            <li class="dropdown language">
                                <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown"
                                    class="dropdown-toggle" href="#">
                                    <?php $value = config('lang.locale'); ?>
                                    <img src="{{ asset('languages_images/'.$value.'.png') }}" alt="" width='18'
                                        height='13' alt="">
                                    <!-- <span class="username">English US</span> -->
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('locale/ar') }}"><img
                                                src="{{ asset('languages_images/ar.png') }}" width='18' height='13'
                                                alt=""> Arabic</a></li>
                                    <li><a href="{{ url('locale/bl') }}"><img
                                                src="{{ asset('languages_images/bl.png') }}" width='18' height='13'
                                                alt=""> Bengali</a></li>
                                    <li><a href="{{ url('locale/ch') }}"><img
                                                src="{{ asset('languages_images/ch.png') }}" width='18' height='13'
                                                alt=""> Chinese</a></li>
                                    <li><a href="{{ url('locale/en') }}"><img
                                                src="{{ asset('languages_images/en.png') }}" alt=""> English US</a></li>
                                    <li><a href="{{ url('locale/fr') }}"><img
                                                src="{{ asset('languages_images/fr.png') }}" alt=""> French</a></li>
                                    <li><a href="{{ url('locale/de') }}"><img
                                                src="{{ asset('languages_images/de.png') }}" alt=""> German</a></li>
                                    <li><a href="{{ url('locale/hi') }}"><img
                                                src="{{ asset('languages_images/hi.png') }}" width='18' height='13'
                                                alt=""> Hindi</a></li>
                                    <li><a href="{{ url('locale/id') }}"><img
                                                src="{{ asset('languages_images/id.png') }}" width='18' height='13'
                                                alt=""> Indonesian</a></li>
                                    <li><a href="{{ url('locale/it') }}"><img
                                                src="{{ asset('languages_images/it.png') }}" width='18' height='13'
                                                alt=""> Italian</a></li>
                                    <li><a href="{{ url('locale/ro') }}"><img
                                                src="{{ asset('languages_images/ro.png') }}" width='18' height='13'
                                                alt=""> Romanian</a></li>
                                    <li><a href="{{ url('locale/ru') }}"><img
                                                src="{{ asset('languages_images/ru.png') }}" alt=""> Russian</a></li>
                                    <li><a href="{{ url('locale/es') }}"><img
                                                src="{{ asset('languages_images/es.png') }}" alt=""> Spanish</a></li>
                                    <li><a href="{{ url('locale/th') }}"><img
                                                src="{{ asset('languages_images/th.png') }}" width='18' height='13'
                                                alt=""> Thai</a></li>
                                    <li><a href="{{ url('locale/tk') }}"><img
                                                src="{{ asset('languages_images/tk.png') }}" width='18' height='13'
                                                alt=""> Turkish</a></li>
                                </ul>
                            </li>
                            @foreach($school as $school) @if($school->is_active == 1)
                            <li>
                                <a href="{{route('school.online_admission', $institute_web->web)}}" target="_blank">Visit Site</a>
                            </li>
                            @endif
                            @endforeach

                            <!-- <li class="skin-change">
              <select name="skin_color" class="form-control" onchange="location=this.value">
                @if(isset($_COOKIE['skin']))
                  <option value="{{ url('change-skin/default')}}" @if($_COOKIE['skin'] == 'default') selected='selected' @endif>Default</option>
                  <option value="{{ url('change-skin/blue')}}" @if($_COOKIE['skin'] == 'blue') selected='selected' @endif>Blue</option>
                  <option value="{{ url('change-skin/green')}}" @if($_COOKIE['skin'] == 'green') selected='selected' @endif>Green</option>
                  <option value="{{ url('change-skin/purple')}}" @if($_COOKIE['skin'] == 'purple') selected='selected' @endif>Purple</option>
                  <option value="{{ url('change-skin/yellow')}}" @if($_COOKIE['skin'] == 'yellow') selected='selected' @endif>Yellow</option>
                  <option value="{{ url('change-skin/red')}}" @if($_COOKIE['skin'] == 'red') selected='selected' @endif>Red</option>
                  @else
                  <option>Change Skin</option>
                  <option value="{{ url('change-skin/default')}}">Default</option>
                  <option id="theme_blue" value="{{ url('change-skin/blue')}}">Blue</option>
                  <option id="theme_green" value="{{ url('change-skin/green')}}">Green</option>
                  <option id="theme_purple" value="{{ url('change-skin/purple')}}">Purple</option>
                  <option id="theme_yellow" value="{{ url('change-skin/yellow')}}">Yellow</option>
                  <option id="theme_red" value="{{ url('change-skin/red')}}">Red</option>
                  @endif
                </select>
            </li> -->


                            <?php $sessions = App\Models\Batch::where('is_current_batch', 1)->where('school_id', auth()->user()->school_id)->first();?>
                            <b style="font-family:times new romans; font-weight:bold; font-size:15px; margin-top:10%">
                                @if($sessions != null)
                                @if($sessions->is_current_batch == 1) Session : {{$sessions->batch}}@endif
                                @else <marquee behavior="" direction="">Please set your academic session you are using
                                    default session {{date('Y')}}</marquee>
                                @endif
                            </b>
                        </ul>

                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->

            <div class="right_col" role="main">
                <div class="page">
                    @yield('content')

                    <!-- modals -->
                    <div class="modal fade settings-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal"><span
                                            aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">General Settings</h4>
                                   
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <div class="col-md-6">
                                    <b>System Settings</b>
                                    <br><br>
                                    <div class="form-group col-md-4">
                                    <span>Change Theme</span>
                                    <!-- Rounded switch -->
                                    <label class="switch">
                                    <input type="checkbox" data-school_id="{{auth()->user()->school_id}}" id="theme_switcher"  class="flat1"
                                                    @if($template->template == 1) checked @endif >
                                    <span class="slider round"></span>
                                    </label>
                                       
                                            <!-- <label><input type="checkbox" data-width="200"
                                                    ><span
                                                    ></span></label> -->
                                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /modals -->
                </div>
                <!-- <div class="page">
          
          </div> -->
            </div>

            <!-- /page content -->

            <!-- footer content -->
            @include('layouts.new-layouts.footer')
            <!-- /footer content -->

        </div>
    </div>

    <!-- compose -->
    <div class="compose col-md-6 col-xs-12">
        <div class="compose-header">
            New Message
            <button type="button" class="close compose-close">
                <span>×</span>
            </button>
        </div>

        <div class="compose-body">
            <div id="alerts"></div>

            <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                    </ul>
                </div>

                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i
                            class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a data-edit="fontSize 5">
                                <p style="font-size:17px">Huge</p>
                            </a>
                        </li>
                        <li>
                            <a data-edit="fontSize 3">
                                <p style="font-size:14px">Normal</p>
                            </a>
                        </li>
                        <li>
                            <a data-edit="fontSize 1">
                                <p style="font-size:11px">Small</p>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i
                            class="fa fa-strikethrough"></i></a>
                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i
                            class="fa fa-underline"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i
                            class="fa fa-dedent"></i></a>
                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i
                            class="fa fa-align-left"></i></a>
                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i
                            class="fa fa-align-center"></i></a>
                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i
                            class="fa fa-align-right"></i></a>
                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i
                            class="fa fa-align-justify"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i
                            class="fa fa-link"></i></a>
                    <div class="dropdown-menu input-append">
                        <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                        <button class="btn" type="button">Add</button>
                    </div>
                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                </div>

                <div class="btn-group">
                    <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i
                            class="fa fa-picture-o"></i></a>
                    <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                </div>

                <div class="btn-group">
                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                </div>
            </div>

            <div id="editor" class="editor-wrapper"></div>
        </div>

        <div class="compose-footer">
            <button id="send" class="btn btn-sm btn-success" type="button">Send</button>
        </div>
    </div>

    <div id="loading"></div>
    <!-- /compose -->

    <!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->

    <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{asset('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
    <script src="{{asset('vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
    <script src="{{asset('vendors/google-code-prettify/src/prettify.js')}}"></script>

    <!-- iCheck -->
    <script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>


    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="{{asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <!-- Ion.RangeSlider -->
    <script src="{{asset('vendors/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
    <!-- Bootstrap Colorpicker -->
    <script src="{{asset('vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- jquery.inputmask -->
    <!-- <script src="{{asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script> -->
    <!-- jQuery Knob -->
    <script src="{{asset('vendors/jquery-knob/dist/jquery.knob.min.js')}}"></script>
    <!-- Cropper -->
    <!-- <script src="{{asset('vendors/cropper/dist/cropper.min.js')}}"></script> -->

    <!-- Datatables -->
    <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}""></script>
    <script src=" {{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}""></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}""></script>
    <script src=" {{asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}""></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}""></script>
    <script src=" {{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}""></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}""></script>
    <script src=" {{asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}""></script>
    <script src="{{asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}""></script>
    <script src=" {{asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}""></script>
    <script src="{{asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}""></script>
    <script src=" {{asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}""></script>
    <script src="{{asset('vendors/jszip/dist/jszip.min.js')}}""></script>
    <script src=" {{asset('vendors/pdfmake/build/pdfmake.min.js')}}""></script>
    <script src="{{asset('vendors/pdfmake/build/vfs_fonts.js')}}""></script>


 <!-- Dropzone.js -->
 <script src=" {{asset('vendors/dropzone/dist/min/dropzone.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->

    <!-- jQuery Smart Wizard -->
    <script src="{{asset('vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}"></script>

    <script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>

    <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('vendors/gauge.js/dist/gauge.min.js')}}"></script>

    <!-- Select2 -->
    <!-- <script src="{{asset('vendors/select2/dist/js/select2.full.min.js')}}"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <!-- Parsley -->
    <script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>
    <!-- Autosize -->
    <script src="{{asset('vendors/autosize/dist/autosize.min.js')}}"></script>
    <!-- starrr -->
    <script src="{{asset('vendors/starrr/dist/starrr.js')}}"></script>

    <!-- NProgress -->
    <script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>

    <!-- PNotify -->
    <script src="{{asset('vendors/pnotify/dist/pnotify.js')}}"></script>
    <script src="{{asset('vendors/pnotify/dist/pnotify.buttons.js')}}"></script>
    <script src="{{asset('vendors/pnotify/dist/pnotify.nonblock.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <!-- <script src="{{ asset('js/custom_theme/custom.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/custom_theme/dashboard2.js') }}"></script> -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/jquery-validate/1.19.1/additional-methods.min.js">
    </script>
    <script type="text/javascript" src=" https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js">
    </script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>


    <!-- ECharts -->
    <script src="{{asset('vendors/echarts/dist/echarts.min.js') }}"></script>
    <!-- <script src="{{asset('vendors/echarts/map/js/world.js') }}"></script> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"
        integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
        crossorigin="anonymous" />

    <!-- Custom Theme Scripts -->
    <!-- <script src="{{asset('build/js/custom.min.js')}}"></script> -->
    <script src="{{asset('build/js/custom.js')}}"></script>
    @yield('scripts')

    <script>
    $(document).ready(function() {

// alert(1)
        $('#theme_switcher').on('change', function(){
            // $('#theme_switcher').prop('checked');

            let template = $(this).prop('checked') === true ? 1 : 0;
            let school_id = $(this).data('school_id');
            let _token = $('#_token').val();

            // alert(_token)
            $.ajax({
            type: "post",
            // dataType: "json",
            url: '{{ route('update-template')}}',
            data: {
                'template': template,
                'school_id': school_id,
                '_token': _token
            },
            success: function(data) {
                console.log(data.message);

                window.location.reload(true);
                // success: function (data) {
                // toastr.options.closeButton = true;
                // toastr.options.closeMethod = 'fadeOut';
                // toastr.options.closeDuration = 100;
                // toastr.success(data.message);
                // }
            }
        });
        });

        // alert(1)
        $(".preloader").fadeOut();

        function onReady(callback) {
            var intervalId = window.setInterval(function() {
                if (document.getElementsByTagName('body')[0] !== undefined) {
                    window.clearInterval(intervalId);
                    callback.call(this);
                }
            }, 100);
        }

        function setVisible(selector, visible) {
            document.querySelector(selector).style.display = visible ? 'block' : 'none';
        }

        onReady(function() {
            setVisible('.page', true);
            setVisible('#loading', false);
        });

        $('#school_id').on('change', function(e) {
            // alert(1)
            var school_id = $(this).val();

            $.ajax({
                url: "{{ route('getSchoolInfo') }}",
                data: {
                    school_id: school_id
                },
                type: 'get',
                dataType: 'json',

                beforeSend: function() {
                    $('#loader').css("visibility", "visible");
                },
                success: function(json) {


                    $('#grade_id').empty();
                    $('#grade_id').append($('<option>').text("--Select grade--").attr(
                        'value', ""));
                    $.each(json, function(i, grade) {
                        console.log(grade);

                        $('#grade_id').append($('<option>').text(grade
                            .semester_name).attr('value', grade.id));
                    });
                },
                complete: function() {
                    $('#loader').css("visibility", "hidden");
                }
            });
            // getSchoolRelatedStudentBalance(school_id); getSchoolRelatedStudentTransaction(school_id);
            // getSchoolRelatedStaffs(school_id);
            $('#grade_id').prop('disabled', false);

        });

        // $('#attendance_date').datetimepicker({
        //       format: 'DD-MM-YYYY',
        //       // format: 'YYYY-MM-DD',
        //       useCurrent: false
        //       // autoCompelete: false
        //   });

        $('#attendance_date').datetimepicker({
            i18n: {
                de: {
                    months: [
                        'January', 'February', 'March', 'April',
                        'May', 'Jun', 'July', 'August',
                        'September', 'October', 'November', 'December',
                    ],
                    dayOfWeek: [
                        "Su", "Mon", "Tu", "Wed",
                        "Thu", "Fri", "Sa",
                    ]
                }
            },
            timepicker: false,
            format: 'Y-m-d'
        });


        // $('#class_id').prop('disabled',true);

        var school_id = $('#school_id').val();

        if (school_id != '') {
            $('#grade_id').prop('disabled', false);
        } else {
            $('#grade_id').prop('disabled', true);
        }

        $(function() {
            $('#grade_id').dblclick(function() {
                $(this).find('option,select').removeProp('disabled').removeClass('no-pointer');
            }).find(':option').addClass('no-pointer');
        });

        $('#grade_id').on('change', function(e) {

            var grade_id = $(this).val();
            var class_id = $('#class_id')
            $('#class_id').empty();
            $('#class_id').append($('<option>').text("--Select Class--").attr('value', ""));
            $.get("{{ route('getGradeRelatedClass') }}", {
                grade_id: grade_id
            }, function(data) {

                $.each(data, function(i, c) {
                    console.log(data);

                    $('#class_id').append($('<option>').text(c.class_name).attr('value',
                        c.class_code));
                })
                $('#class_id').prop('disabled', false);
            })
        });
        //   showloading ();

        //   function showLoading() {
        //   document.querySelector('#loading').classList.add('loading');
        //   document.querySelector('#loading-content').classList.add('loading-content');
        // }

        // function hideLoading() {
        //   document.querySelector('#loading').classList.remove('loading');
        //   document.querySelector('#loading-content').classList.remove('loading-content');
        // }

        // var spinner = $('#loader');
        // $(function() {
        //   $('form').submit(function(e) {
        //     e.preventDefault();
        //     spinner.show();
        //     $.ajax({
        //       url: 't2228.php',
        //       data: $(this).serialize(),
        //       method: 'post',
        //       dataType: 'JSON'
        //     }).done(function(resp) {
        //       spinner.hide();
        //       alert(resp.status);
        //     });
        //   });
        // });

        //   $('.select_2_single').select2({width: '100%', hight: '100%'});
        // });

        $(document).ready(function() {
            $('.select_2_multiple').select2({
                width: '100%',
                hight: '100%'
            });
        });

        $(".js-example-responsive").select2({
            width: 'resolve',
            height: 'resolve' // need to override the changed default
        });


        $("document").ready(function() {
            alert(1)
            setTimeout(function() {
                $("div.alert").remove();
            }, 5000); // 5 secs

        });

        $('#fullscreen').click(function() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        })

        // function toggleFullScreen() {
        //   if (!document.fullscreenElement) {
        //       document.documentElement.requestFullscreen();
        //   } else {
        //     if (document.exitFullscreen) {
        //       document.exitFullscreen(); 
        //     }
        //   }
        // }



        // var elem = document.querySelector('.js-switch');
        // var init = new Switchery(elem);

        // BUT FOR ME I WILL USE THIS ONE I HAVE ALREADY IMPLEMET OKAY

        // var and let is all the same in jquery i=okay

        // -------------------------------start here------------------------------------------


        // ---------------------------------------end's here okay----------------------------------

        // WHY I NORMALLY PUT CODE IN THE APP BECAUSE THE APP IS MASTER HEAD OF THE APPLICATION
        // SO THAT I WILL BE GLOBAL FUNCTION OKAY FOR THE ENTIRE APPLICATION.

        $(document).ready(function() {
            $(document).ajaxStart(function() {
                $("#wait").css("display", "block");
            });
            $(document).ajaxComplete(function() {
                $("#wait").css("display", "none");
            });
        });



    });

    // THATS THE CODE FOR LOADING PART OKAY THE AJAX PART

    // SO NOW LET'S GO TO THE CSS PART OKAY.

    // 
    </script>

</body>

</html>