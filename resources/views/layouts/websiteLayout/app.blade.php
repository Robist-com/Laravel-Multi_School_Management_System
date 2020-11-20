<!DOCTYPE html>
<html lang="en">

<head>
  <title>Academics &mdash; Website by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('website/fonts/icomoon/style.css')}}">

  <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('website/css/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{ asset('website/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{ asset('website/css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{ asset('website/css/owl.theme.default.min.css')}}">

  <link rel="stylesheet" href="{{ asset('website/css/jquery.fancybox.min.css')}}">

  <link rel="stylesheet" href="{{ asset('website/css/bootstrap-datepicker.css')}}">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css')}}">

  <link rel="stylesheet" href="{{ asset('website/css/aos.css')}}">
  <link href="{{ asset('website/css/jquery.mb.YTPlayer.min.css')}}" media="all" rel="stylesheet" type="text/css">

<!-- <link rel="stylesheet" href="{{ asset('website/css/style.css')}}"> -->
<!-- <link rel="stylesheet" href="{{ asset('website/css/style.blade')}}"> -->
@include('school.website.style')
<meta name="csrf-token" content="{{ csrf_token() }}">



<?php 
use App\Institute;
use Illuminate\Support\Str;
$url = request()->segment(3);
$url_active = request()->segment(2);

if(auth()->user()){
  $institute =  Institute::where('institute.school_id', auth()->user()->school_id)
  ->join('schools', 'schools.id', '=', 'institute.school_id')->get();
}
else {
  $institute =  Institute::where('web', $url)
  ->join('schools', 'schools.id', '=', 'institute.school_id')->get();
}

if(auth()->user()){
$latest_news = DB::table('school_news')
  ->join('institute', 'institute.school_id', '=', 'school_news.school_id')
  ->where('institute.school_id', auth()->user()->school_id)->where('status', 1)
  ->select('title', 'news_date', 'school_news.id as news_id')
  ->get();
}
else {
  $latest_news = DB::table('school_news')
  ->join('institute', 'institute.school_id', '=', 'school_news.school_id')
  ->where('web', $url)->where('status', 1)->select('title', 'news_date', 'school_news.id as news_id')
  ->get();
}

if(auth()->user()){
  $theme_settings = App\FrontCms::join('institute', 'institute.school_id', '=', 'front_cms.school_id')
  ->where('institute.school_id',  auth()->user()->school_id)->where('theme_status', 1)->first();
}else{
  $theme_settings = App\FrontCms::join('institute', 'institute.school_id', '=', 'front_cms.school_id')
  ->where('web', $url)->where('theme_status', 1)->first();
  }

              
?>

<style>
    .teacher-image{
        height:100px;
        padding-left:1px;
        padding-right: 1px;

        background: #eee;
        width:150px;
        margin: 0 auto;
        /* border-radius: 50%; */
        vertical-align: middle;
        cursor: pointer;
       
    }

    .image > input[type="file"]{
        display: none;
        cursor: pointer;
    }

    .btn-choose{
        padding: 5px;
        text-align: center;
        border:1px solid !important;
        color: black;
        border-radius: 0%;
        /* width:55%; */
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
    fieldset label{
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
    label >b{
        color:red;
        font-size:13px;
        border: 0;
    }



 .roll{
     font-size:15px;
     /* background-color: #5E7391; */
     /* weight:5px !important; */
 }

 .onlineform .form-control {
    border-radius: 30px;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
    border-bottom-right-radius: 30px;
    border-bottom-left-radius: 30px;
}

.pull-right-image{
  float:right;
}

input[id=username1] {
    pointer-events: none;
    border: 0px solid #ffff !important;
    border: 1px solid #ffff;
 }

 .username{
    border: 0px solid #ffff !important;

 }

.theme_head_color{
  background-color: {{$theme_settings->head_background_color}};
  
}

.theme_footer_color{
  background-color: {{$theme_settings->footer_background_color}};
  
}

</style>



</head>
@foreach($institute as $institute)
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
  
    <div class="py-2 theme_head_color">  
      <div class="container">
        <div class="row align-items-center" >
        @if(count($latest_news) > 0)
        <div class="col-md-12 row">
       <div class="col-md-3">
       <a href="#" class="btn btn-round" style="background-color:#BD0745; color:#fff;">Latest News: </a> 
       </div>
       <div class="col-md-12">
       <marquee behavior="" direction=""  onmouseover="this.stop();"
           onmouseout="this.start();">
       @foreach($latest_news as $result)
           <a href="{{url('get/news/' .$result->news_id)}}" class="stop"><b style='color:yellow; font-family:times new romans;'>{{date('d F Y', strtotime($result->news_date))}}</b> <b style="font-family:times new romans; color:#fff">{{$result->title}}</b></a>
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           &nbsp;&nbsp;
           @endforeach
           </marquee>
          </div>
           </div>
           
        @endif
        
          <div class="col-lg-9 d-none d-lg-block">
            <a href="{{url('school/contact_us/' .$institute->web)}}" class="small mr-3" style="color:#fff"><span class="icon-question-circle-o mr-2"></span> Have a questions?</a> 
            <a href="#" class="small mr-3" style="color:#fff"><span class="icon-phone2 mr-2"></span> {{$institute->phoneNo}}</a> 
            <a href="#" class="small mr-3" style="color:#fff"><span class="icon-envelope-o mr-2"></span> {{$institute->email}} </a> 
          </div>
          <div class="col-lg-3 text-right">
            <a href="{{url('school/login/' .$institute->web)}}" class="small btn btn-bg login mr-3" ><span class="icon-unlock-alt"></span> Log In</a>
            <a href="{{url('school/register/' .$institute->web)}}" class="small btn btn-bg login px-4 py-2 "><span class="icon-users"></span> Register</a>
          </div>
        </div>
      </div>
    </div>
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
          @if(Auth()->user())
          <a href="{{url('school/website')}}" class="d-block">
              <img src="{{asset('institute_logo/' .$institute->image)}}" alt="Image" class="img-fluid" width="80px">
            </a>
          @else
            <a href="{{url('school/site/' .$institute->web)}}" class="d-block">
              <img src="{{asset('institute_logo/' .$institute->image)}}" alt="Image" class="img-fluid" width="80px">
            </a>
          @endif
          </div>
          <div class="mr-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
               @if($url_active == 'website')
               <li class="active">
               @elseif($url_active == 'site')
               <li class="active">
               @else
               <li>
               @endif
               
                @if(Auth()->user())
                  <a href="{{url('school/website')}}" class="nav-link text-left">Home</a>
                @else
                  <a href="{{url('school/site/' .$institute->web)}}" class="nav-link text-left">Home</a>
                @endif
                </li>
                <li class="has-children">
                  <a href="#" class="nav-link text-left">About Us</a>
                  <ul class="dropdown">
                    @if($url_active == 'our_teachers')
                    <li class="active">
                    @else
                    <li>
                    @endif
                    <a href="{{url('school/our_teachers/' .$institute->web)}}">Our Teachers</a>
                    </li>
                    @if($url_active == 'about_us')
                    <li class="active">
                    @else
                    <li>
                    @endif
                    <a href="{{url('school/about_us/' .$institute->web)}}">Our School</a></li>
                  </ul>
                </li>
                <li class="has-children">
                  <a href="#" class="nav-link text-left">Academics</a>
                  <ul class="dropdown">
                    @if($url_active == 'our_teachers')
                    <li class="active">
                    @else
                    <li>
                    @endif
                    <a href="{{url('school/our_teachers/' .$institute->web)}}">Our Teachers</a>
                    </li>
                    @if($url_active == 'about_us')
                    <li class="active">
                    @else
                    <li>
                    @endif
                    <a href="{{url('school/about_us/' .$institute->web)}}">Our School</a></li>
                  </ul>
                </li>
                @if($url_active == 'online_admission')
               <li class="active">
               @else
               <li>
               @endif
                  <a href="{{url('school/online_admission/' .$institute->web)}}" class="nav-link text-left">Online Admissions</a>
                </li>
                @if($url_active == 'gallary')
               <li class="active">
               <a href="{{url('school/gallary/' .$institute->web)}}" class="nav-link text-left">Gallary</a>
               <li>
               @else
               <li>
                  <a href="{{url('school/gallary/' .$institute->web)}}" class="nav-link text-left">Gallary</a>
                </li>
               @endif


                @if($url_active == 'events')
               <li class="active">
               @else
               <li>
               @endif
                  <a href="{{url('school/events/' .$institute->web)}}" class="nav-link text-left">Event</a>
                </li>
                <!-- @if($url_active == 'contact_us')
               <li class="active">
               @else
               <li class="has-children">
               @endif
                    <a href="{{url('school/news/' .$institute->web)}}" class="nav-link text-left">News</a>
                  </li> -->
                  @if($url_active == 'contact_us')
               <li class="active">
               @else
               <li>
               @endif
                    <a href="{{url('school/contact_us/' .$institute->web)}}" class="nav-link text-left">Contact Us</a>
                  </li>
              </ul>                                                                                                                                                                                                                                                                                          </ul>
            </nav>

          </div>
          <div class="ml-auto">
            <div class="social-wrap">
              <a href="{{$theme_settings->facebook_link}}" target="_blank"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>
              <!-- <a href="#"><span class="icon-linkedin"></span></a> -->

              <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                class="icon-menu h3"></span></a>
            </div>
          </div>
         
        </div>
      </div>

    </header>

@yield('content')
    <!-- Start from here -->
        <div class="site-section ftco-subscribe-1 " style="background-image: url('{{ asset('website/images/bg_1.jpg')}}')">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <h2>Subscribe to us!</h2>

            <h2>{{$url_active}}</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,</p>
          </div>
          <div class="col-lg-5">
            <form action="" class="d-flex">
              <input type="text" class="rounded form-control mr-2 py-3" placeholder="Enter your email">
              <button class="btn btn-bg rounded py-3 px-4" type="submit">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div> 


    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <p class="mb-4"><img src="{{asset('institute_logo/' .$institute->image)}}" alt="Image" class="img-fluid" width="70px"></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae nemo minima qui dolor, iusto iure.</p>  
            <p><a href="#">Learn More</a></p>
          </div>
          <div class="col-lg-3">
            <h3 class="footer-heading"><span>Our School</span></h3>
            <ul class="list-unstyled">
                <li><a href="#">Acedemic</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Our Interns</a></li>
                <li><a href="#">Our Leadership</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Human Resources</a></li>
            </ul>
          </div>
          <div class="col-lg-3">
              <h3 class="footer-heading"><span>Our Courses</span></h3>
              <ul class="list-unstyled">
                  <li><a href="#">Math</a></li>
                  <li><a href="#">Science &amp; Engineering</a></li>
                  <li><a href="#">Arts &amp; Humanities</a></li>
                  <li><a href="#">Economics &amp; Finance</a></li>
                  <li><a href="#">Business Administration</a></li>
                  <li><a href="#">Computer Science</a></li>
              </ul>
          </div>
          <div class="col-lg-3">
              <h3 class="footer-heading"><span>Contact</span></h3>
              <ul class="list-unstyled">
                  <li><a href="#">Help Center</a></li>
                  <li><a href="#">Support Community</a></li>
                  <li><a href="#">Press</a></li>
                  <li><a href="#">Share Your Story</a></li>
                  <li><a href="#">Our Supporters</a></li>
              </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="copyright">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >{{$institute->name}}</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    

  </div>
  <!-- .site-wrap -->


  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>

  <script src="{{ asset('website/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{ asset('website/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{ asset('website/js/jquery-ui.js')}}"></script>
  <script src="{{ asset('website/js/popper.min.js')}}"></script>
  <script src="{{ asset('website/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('website/js/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('website/js/jquery.stellar.min.js')}}"></script>
  <script src="{{ asset('website/js/jquery.countdown.min.js')}}"></script>
  <script src="{{ asset('website/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{ asset('website/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{ asset('website/js/aos.js')}}"></script>
  <script src="{{ asset('website/js/jquery.fancybox.min.js')}}"></script>
  <script src="{{ asset('website/js/jquery.sticky.js')}}"></script>
  <script src="{{ asset('website/js/jquery.mb.YTPlayer.min.js')}}"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{url('/js/bootstrap-datepicker.js')}}"></script>

  <script src="{{ asset('website/js/main.js')}}"></script>
</body>
@endforeach


@yield('scripts')

<script>
$(document).ready(function(){

//   $('.owl-carousel').owlCarousel({
//     items:1,
//     margin:10,
//     autoHeight:true
// });

// $(".owl-carousel").owlCarousel({
//   autoplay: true,
//   items: 1,
//   loop: true,
//   navigation : false, 
//   slideSpeed : 300,
//   paginationSpeed : 400,
//   singleItem:true
//   autoHeight:false
// })
// alert(1)
      // ------------------Date Of Birth Change-----------
      
          $('#attendance_date').datepicker({
                // format: 'DD-MM-YYYY',
                // format: 'Y-MM-DD',
                useCurrent: false,
                format: 'yyyy-mm-dd'
                // startDate: '-3d'
                // autoCompelete: false
            });
        //---------------------Browse image----------------
                        $('#showImage').on('click',function(){
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
            $(degree).append($('<option>').text("--Select Level--").attr('value',""));
        $.get("{{ route('PrimaryLevel') }}",{grade_id:grade_id},function(data){  
    
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
        $(department_id).append($('<option>').text("--Select Student Group--").attr('value',""));
    $.get("{{ route('dynamicStudentGroup') }}",{faculty_id:faculty_id},function(data){  
        
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
    $(class_id).append($('<option>').text("--Select Student Group--").attr('value',""));
$.get("{{ route('dynamicDepartmentClass') }}",{department_id:department_id},function(data){  
    
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

        // $('#content_show').show();
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
      var school_id = $('#school_id').val();
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
                  school_id: school_id,
                  dateregistered: dateregistered,
                  _token:_token
              },
              cache: false,
              success: function(response){
                  // console.log(response);
                //   var response = JSON.parse(response);
                  if(response.message){
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.options.positionClass = 'toast-top-full-width';
                    toastr.success(response.message);
                    $('#content_show').show();
                    Reset();
                    $('#content_hide').hide();
                   

                  }
                  else if(response.statusCode==201){
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