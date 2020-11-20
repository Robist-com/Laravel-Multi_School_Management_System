@php 
use App\Institute;
$institute = Institute::where('school_id', null)->get();
@endphp

<!DOCTYPE html>
<html lang="{{app()->getLocale()}}"> 
<!-- so this will store any language we choose okay. -->

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    @if(isset($institute))
    @foreach($institute as $institute)
    <title>(AIS {{$institute->name}}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('institute_logo/' .$institute->image) }}">
    @endforeach
    @endif
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('FrontEnd/style.css') }}">

</head>
<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 65px;
                margin-bottom:50%;
                /* padding-bottom:100%; */
                /* margin-top:5px; */
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 5px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
<body>
    <!-- ##### Preloader ##### -->
    <div id="preloader">
        <i class="circle-preloader"></i>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 h-100">
                        <div class="header-content h-100 d-flex align-items-center justify-content-between">
                            <div class="academy-logo">
                            @if(isset($institute))
                            @foreach(Institute::where('school_id', null)->get() as $institute)
                                <a href="/"><img src="{{asset('institute_logo/' .$institute->image)}}" alt="logo" srcset="" style="width:70px"></a>
                            @endforeach
                            @endif
                            </div>
                            <div class="login-content" style="margin-bottom:20px;">

                     <!-- we check if the student is logged in  -->
                            @if(session::has('studentSession')) 
                            <button class="btn btn-info"><a href="{{url('/account')}}" style="color:#fff;">{{__('language.account')}}</a></button>
                            <button class="btn btn-danger"><a href="{{url('/logout')}}" style="color:#fff;">{{__('language.logout')}}</a></button>
                            <!-- show this links -->
                            <!-- <div class="top-right links">
                            <ul class="lang-list">
                            <li class="lang lang-en selected" title="EN">
                                <a href="locale/en">{{__('language.english')}}<img src="{{asset('languages_images/English-Language-Flag.png')}}" alt="" srcset="" style="width:35px"></a>
                                <a href="locale/fr">{{__('language.french')}}<img src="{{asset('languages_images/franch-language-flag.gif')}}" alt="" srcset="" style="width:35px"></a>
                                <a href="locale/chi">{{__('language.chinese')}}<img src="{{asset('languages_images/chinese-language-flag.webp')}}" alt="" srcset="" style="width:35px"></a>
                                <a href="locale/indo">{{__('language.indonesian')}}<img src="{{asset('languages_images/indonesian-language-flag.jpg')}}" alt="" srcset="" style="width:35px"></a>
                                <a href="locale/ara">{{__('language.arabic')}}<img src="{{asset('languages_images/Saudi_Arabia.flag.png')}}" alt="" srcset="" style="width:35px"></a>
                                </li>
                                </ul>
                            </div> -->
                            <div class="btn-group">
                    <button type="button" class="btn btn-dark">Language</button>
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                    <li>
                    <a data-toggle="tooltip" title="{{__('language.english')}}" class="dropdown-item" href="locale/en">
                    <label for=""  class="active"><img src="{{asset('languages_images/English-Language-Flag.png')}}" alt="" srcset="" style="width:35px">{{__('language.english')}}</label> 
                    </a></li>
                    <li>
                    <a data-toggle="tooltip" title="{{__('language.french')}}" class="dropdown-item" href="locale/fr">
                    <label for=""  class="active"><img src="{{asset('languages_images/franch-language-flag.gif')}}" alt="" srcset="" style="width:35px">{{__('language.french')}}</label> 
                    </a></li>
                    <li>
                    <a data-toggle="tooltip" title="{{__('language.chinese')}}" class="dropdown-item" href="locale/chi">
                    <label for=""  class="active"><img src="{{asset('languages_images/chinese-language-flag.webp')}}" alt="" srcset="" style="width:35px">{{__('language.chinese')}}</label> 
                    </a></li>

                    <li>
                    <a data-toggle="tooltip" title="{{__('language.indonesia')}}" class="dropdown-item" href="locale/indo">
                    <label for=""  class="active"><img src="{{asset('languages_images/indonesian-language-flag.jpg')}}" alt="" srcset="" style="width:35px">{{__('language.indonesian')}}</label> 
                    </a></li>

                    <li>
                    <a data-toggle="tooltip" title="{{__('language.arabic')}}" class="dropdown-item" href="locale/ara">
                    <label for=""  class="active"><img src="{{asset('languages_images/Saudi_Arabia.flag.png')}}" alt="" srcset="" style="width:35px">{{__('language.arabic')}}</label> 
                    </a></li>
                    </ul>
                        @else
                            <!-- if the student is not login  -->
                            <button class="btn btn-success pull-right" ><a href="{{url('/student')}}" style="color:#fff;">{{__('language.login')}}</a></button>
                            <!-- <button class="btn btn-success pull-right" ><a href="{{url('register/school')}}" style="color:#fff;">Register a School</a></button> -->
                            <button class="btn btn-success pull-right" ><a href="{{url('register/school')}}" style="color:#fff;">Register a School</a></button>
                            <!-- <div class="top-right links">
                            <ul class="lang-list">
                            <li class="lang lang-en selected" title="EN">
                                <a href="locale/en">{{__('language.english')}}<img src="{{asset('languages_images/English-Language-Flag.png')}}" alt="" srcset="" style="width:35px"></a>
                                <a href="locale/fr">{{__('language.french')}}<img src="{{asset('languages_images/franch-language-flag.gif')}}" alt="" srcset="" style="width:35px"></a>
                                <a href="locale/chi">{{__('language.chinese')}}<img src="{{asset('languages_images/chinese-language-flag.webp')}}" alt="" srcset="" style="width:35px"></a>
                                <a href="locale/indo">{{__('language.indonesian')}}<img src="{{asset('languages_images/indonesian-language-flag.jpg')}}" alt="" srcset="" style="width:35px"></a>
                                <a href="locale/ara">{{__('language.arabic')}}<img src="{{asset('languages_images/Saudi_Arabia.flag.png')}}" alt="" srcset="" style="width:35px"></a>
                                </li>
                                </ul>
                            </div> -->
                            <div class="btn-group">
                    <button type="button" class="btn btn-dark">Language</button>
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                    <li>
                    <a data-toggle="tooltip" title="{{__('language.english')}}" class="dropdown-item" href="locale/en">
                    <label for=""  class="active"><img src="{{asset('languages_images/English-Language-Flag.png')}}" alt="" srcset="" style="width:35px">{{__('language.english')}}</label> 
                    </a></li>
                    <li>
                    <a data-toggle="tooltip" title="{{__('language.french')}}" class="dropdown-item" href="locale/fr">
                    <label for=""  class="active"><img src="{{asset('languages_images/franch-language-flag.gif')}}" alt="" srcset="" style="width:35px">{{__('language.french')}}</label> 
                    </a></li>
                    <li>
                    <a data-toggle="tooltip" title="{{__('language.chinese')}}" class="dropdown-item" href="locale/chi">
                    <label for=""  class="active"><img src="{{asset('languages_images/chinese-language-flag.webp')}}" alt="" srcset="" style="width:35px">{{__('language.chinese')}}</label> 
                    </a></li>

                    <li>
                    <a data-toggle="tooltip" title="{{__('language.indonesia')}}" class="dropdown-item" href="locale/indo">
                    <label for=""  class="active"><img src="{{asset('languages_images/indonesian-language-flag.jpg')}}" alt="" srcset="" style="width:35px">{{__('language.indonesian')}}</label> 
                    </a></li>

                    <li>
                    <a data-toggle="tooltip" title="{{__('language.arabic')}}" class="dropdown-item" href="locale/ara">
                    <label for=""  class="active"><img src="{{asset('languages_images/Saudi_Arabia.flag.png')}}" alt="" srcset="" style="width:35px">{{__('language.arabic')}}</label> 
                    </a></li>
                    </ul>
                    </div>
                     </div>
                     @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="academy-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="academyNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.html">{{__('language.home')}}</a></li>
                                    <li><a href="#">{{__('language.pages')}}</a>
                                        <ul class="dropdown">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="about-us.html">About Us</a></li>
                                            <li><a href="course.html">Course</a></li>
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                            <li><a href="elements.html">Elements</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">{{__('language.mega_menu')}}</a>
                                        <div class="megamenu">
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="#">Home</a></li>
                                                <li><a href="#">Services &amp; Features</a></li>
                                                <li><a href="#">Accordions and tabs</a></li>
                                                <li><a href="#">Menu ideas</a></li>
                                                <li><a href="#">Students Gallery</a></li>
                                            </ul>
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="#">Home</a></li>
                                                <li><a href="#">Services &amp; Features</a></li>
                                                <li><a href="#">Accordions and tabs</a></li>
                                                <li><a href="#">Menu ideas</a></li>
                                                <li><a href="#">Students Gallery</a></li>
                                            </ul>
                                            <ul class="single-mega cn-col-4">
                                                <li><a href="#">Home</a></li>
                                                <li><a href="#">Services &amp; Features</a></li>
                                                <li><a href="#">Accordions and tabs</a></li>
                                                <li><a href="#">Menu ideas</a></li>
                                                <li><a href="#">Students Gallery</a></li>
                                            </ul>
                                            <div class="single-mega cn-col-4">
                                                <img src="img/bg-img/bg-1.jpg" alt="">
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="about-us.html">{{__('language.about_us')}}</a></li>
                                    <!-- <li><a href="course.html">{{__('language.course')}}</a></li> -->
                                    <li><a href="{{route('StudentAdmission')}}">Online Admission</a></li>
                                    <li><a href="contact.html">{{__('language.contact')}}</a></li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>
                        <!-- <style>
                           .test{
                            background-color:#DDA0DD !important;
                           }
                        </style> -->

                        <!-- Calling Info -->
                        <div class="calling-info test">
                            <div class="call-center test" >
                                <a href=""><i class="icon-telephone-2 test"></i> <span>(+62) 081290348080</span></a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    @yield('content')

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="main-footer-area section-padding-100-0">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <a href="#"><img src="img/core-img/logo2.png" alt=""></a>
                            </div>
                            <p>Cras vitae turpis lacinia, lacinia lacus non, fermentum nisi. Donec et sollicitudin est, in euismod erat. Ut at erat et arcu pulvinar cursus a eget.</p>
                            <div class="footer-social-info">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <h6>Usefull Links</h6>
                            </div>
                            <nav>
                                <ul class="useful-links">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Services &amp; Features</a></li>
                                    <li><a href="#">Accordions and tabs</a></li>
                                    <li><a href="#">Menu ideas</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <h6>Gallery</h6>
                            </div>
                            <div class="gallery-list d-flex justify-content-between flex-wrap">
                                <a href="img/bg-img/gallery1.jpg" class="gallery-img" title="Gallery Image 1"><img src="img/bg-img/gallery1.jpg" alt=""></a>
                                <a href="img/bg-img/gallery2.jpg" class="gallery-img" title="Gallery Image 2"><img src="img/bg-img/gallery2.jpg" alt=""></a>
                                <a href="img/bg-img/gallery3.jpg" class="gallery-img" title="Gallery Image 3"><img src="img/bg-img/gallery3.jpg" alt=""></a>
                                <a href="img/bg-img/gallery4.jpg" class="gallery-img" title="Gallery Image 4"><img src="img/bg-img/gallery4.jpg" alt=""></a>
                                <a href="img/bg-img/gallery5.jpg" class="gallery-img" title="Gallery Image 5"><img src="img/bg-img/gallery5.jpg" alt=""></a>
                                <a href="img/bg-img/gallery6.jpg" class="gallery-img" title="Gallery Image 6"><img src="img/bg-img/gallery6.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="footer-widget mb-100">
                            <div class="widget-title">
                                <h6>Contact</h6>
                            </div>
                            <div class="single-contact d-flex mb-30">
                                <i class="icon-placeholder"></i>
                                <p>4127/ 5B-C Mislane Road, Gibraltar, UK</p>
                            </div>
                            <div class="single-contact d-flex mb-30">
                                <i class="icon-telephone-1"></i>
                                <p>Main: 203-808-8613 <br>Office: 203-808-8648</p>
                            </div>
                            <div class="single-contact d-flex">
                                <i class="icon-contract"></i>
                                <p>office@yourbusiness.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @yield('scripts')
    <!-- ##### Footer Area Start ##### -->
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

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{asset('FrontEnd/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('FrontEnd/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('FrontEnd/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{asset('FrontEnd/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('FrontEnd/js/active.js')}}"></script>
</body>

@yield('scripts')

<script>
$(document).ready(function(){


      //------------------Date Of Birth Change-----------
    //   $('#dob').datetimepicker({
    //                     format: 'YYYY-MM-DD',
    //                     useCurrent: false
    //                 });
        //---------------------Browse image----------------
                        $('#browse_file').on('click',function(){
                            $('#image').click();                 
                        })
                        $('#image').on('change', function(e){
                            showFile(this, '#showImage');
                        })


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
    // {{----------------------------Update class Schedule Status---------------------}}  

$(document).ready(function(){

    $('#content_show').hide();
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
});

$('#email').blur(function(){
 var error_email = '';
 var email = $('#email').val();
 var _token = $('input[name="_token"]').val();
 var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 if(!filter.test(email))
 {    
  $('#error_email').html('<label class="text-danger">Invalid Email</label>');
  $('#email').addClass('has-error');
  $('#register').attr('disabled', 'disabled');
 }
 else
 {
  $.ajax({
   url:"{{ route('email_available.check') }}",
   method:"POST",
   data:{email:email, _token:_token},
   success:function(result)
   {
    if(result == 'unique')
    {
     $('#error_email').html('<label class="text-success"><i class="fa fa-check"></i></label>');
     $('#email').removeClass('has-error');
     $('#register').attr('disabled', false);
    }
    else
    {
     $('#error_email').html('<label class="text-danger"><i class="fa fa-check"></i>Email Already Registered! Sign in to your account.</label>');
     $('#email').addClass('has-error');
     $('#register').attr('disabled', 'disabled');
    }
   }
  })
 }
});

});


var _token = $('input[name="_token"]').val();

$('#btnRegister').on('click', function() {
      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var username = $('#username').val();
      var password = $('#password').val();
      var image = $('#image').val();
      var gender = $('#gender').val();
      var status = $('#status').val();
      var dob = $('#dob').val();
      var nationality = $('#nationality').val();
      var passport = $('#passport').val();
      var phone = $('#phone').val();
      var address = $('#address').val();
      var current_address = $('#current_address').val();
      var semester_id = $('#semester_id').val();
      var degree_id = $('#degree_id').val();
      var faculty_id = $('#faculty_id').val();
      var department_id = $('#department_id').val();
      var class_id = $('#class_id').val();
      var batch_id = $('#batch_id').val();
      var father_name = $('#father_name').val();
      var father_phone = $('#father_phone').val();
      var mother_name = $('#mother_name').val();
      var email = $('#email').val();
      var user_id = $('#user_id').val();
      var dateregistered = $('#dateregistered').val();

      if(first_name!="" && email!="" && phone!="" && father_name!="" && father_phone!= "" 
      && class_id!="" && nationality!=""){
        //   $("#butsave").attr("disabled", "disabled");
          $.ajax({
              url:"{{ route('StudentTakeAdmission') }}",
              type: "POST",
              data: {
                //   _token: $("#csrf").val(),
                  type: 1,
                  first_name: first_name,
                  last_name: last_name,
                  username: username,
                  password: password,
                  image: image,
                  gender: gender,
                  status: status,
                  dob: dob,
                  nationality: nationality,
                  passport: passport,
                  phone: phone,
                  address: address,
                  current_address: current_address,
                  semester_id: semester_id,
                  degree_id: degree_id,
                  faculty_id: faculty_id,
                  department_id: department_id,
                  class_id: class_id,
                  batch_id: batch_id,
                  father_name: father_name,
                  father_phone: father_phone,
                  mother_name: mother_name,
                  email: email,
                  user_id: user_id,
                  dateregistered: dateregistered,
                  _token:_token
              },
              cache: false,
              success: function(response){
                  console.log(response);
                //   var response = JSON.parse(response);
                  if(response.message){
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.options.positionClass = 'toast-bottom-full-width';
                    toastr.success(response.message);
                    Reset();
                    $('#content_hide').hide();
                    $('#content_show').show();

                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }


                  
              }
          });
      }
      else{
          alert('Please fill all the field !');
      }
//   });
});

function Reset()
 {
      var first_name = $('#first_name').val('');
      var last_name = $('#last_name').val('');
      var username = $('#username').val();
      var password = $('#password').val();
      var image = $('#image').val('');
      var gender = $('#gender').val('');
      var status = $('#status').val('');
      var dob = $('#dob').val('');
      $('#nationality').prop('selectedIndex',0);
      var passport = $('#passport').val('');
      var phone = $('#phone').val('');
      var address = $('#address').val('');
      var current_address = $('#current_address').val('');
      $('#semester_id').prop('selectedIndex',0);
      $('#degree_id').prop('selectedIndex',0);
      $('#faculty_id').prop('selectedIndex',0);
      $('#department_id').prop('selectedIndex',0);
      $('#class_id').prop('selectedIndex',0);
      $('#batch_id').prop('selectedIndex',0);
      var father_name = $('#father_name').val('');
      var father_phone = $('#father_phone').val('');
      var mother_name = $('#mother_name').val('');
      var email = $('#email').val('');
      var user_id = $('#user_id').val('');
      var dateregistered = $('#dateregistered').val();
 }

</script>

</html>