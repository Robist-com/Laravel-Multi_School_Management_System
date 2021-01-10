@extends('layouts.websiteLayout.app')

@section('content')
    
    <?php $url = request()->segment(3); ?>

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
              <h2 class="mb-0">Login</h2>
              <p>by using your school roll number and password, if you have any problem regarding to your login credentials, you can contact help desk <a href="#">Help Desk</a></p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{url('school/site/' .$url)}}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Login</span>
      </div>
    </div>

  

    <div class="site-section">
        <div class="container">

            <ul class="nav nav-pills" id="myTab" role="tablist" style="width: 950px !important; justify-content:center">
              <li class="nav-item">
                <a class="nav-link nav-pil active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> <i class="fa fa-graduation-cap"></i> STUDENT LOGIN</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-pil" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-graduation-cap"></i> TEACHER LOGIN</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-pil" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-university"></i> SCHOOL LOGIN</a>
              </li>
            </ul>

              <div class="tab-content pr-5" id="myTabContent" style="width: 1000px !important; justify-content:center">
                <div class="tab-pane fade show active my-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                 <form method="post" action="{{ url('/student-login') }}" autocomplete="off">
            {!! csrf_field() !!}

               <div class="row justify-content-center">
                <div class="col-md-5">
                  {{-- <span align="center" style="text-align: center !important">STUDENT LOGIN</span> --}}

                @include('flash::message')
                @include('adminlte-templates::common.errors')
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="username">Roll Number</label>
                            <input type="text" placeholder="Enter Roll Number" name="username" id="username" class="form-control form-control-lg" autocomplete="off">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Password</label>
                            <input type="password" placeholder="Enter Password" name="password" id="pword" class="form-control form-control-lg" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Log In" class="btn btn-bg btn-lg px-5">
                        </div>
                    </div>
                    <a href="{{url('student/forgot-password/' .$url)}}">Forgot Password</a>
                </div>
            </div>
        </form>
                </div>
                <div class="tab-pane fade my-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <form method="post" action="{{ url('login/action') }}" autocomplete="off">
            {!! csrf_field() !!}

               <div class="row justify-content-center">
                <div class="col-md-5">
                @include('flash::message')
                @include('adminlte-templates::common.errors')
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="username">Email</label>
                            <input type="email" placeholder="Enter E-mail" name="email" id="username" class="form-control form-control-lg" autocomplete="off">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Password</label>
                            <input type="password" placeholder="Enter Password" name="password" id="pword" class="form-control form-control-lg" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Log In" class="btn btn-bg btn-lg px-5">
                        </div>
                    </div>
                    <a href="{{url('student/forgot-password/' .$url)}}">Forgot Password</a>
                </div>
            </div>
        </form>
                </div>
                <div class="tab-pane fade my-5" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <form method="post" action="{{ url('login/action') }}" autocomplete="off">
                  {!! csrf_field() !!}

               <div class="row justify-content-center">
                <div class="col-md-5">
                @include('flash::message')
                @include('adminlte-templates::common.errors')
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="username">Email</label>
                            <input type="email" placeholder="Enter E-mail" name="email" id="username" class="form-control form-control-lg" autocomplete="off">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Password</label>
                            <input type="password" placeholder="Enter Password" name="password" id="pword" class="form-control form-control-lg" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Log In" class="btn btn-bg btn-lg px-5">
                        </div>
                    </div>
                    <a href="{{url('student/forgot-password/' .$url)}}">Forgot Password</a>
                </div>
            </div>
        </form>
                </div>
              </div>
        </div>
    </div>

    <style>
      .nav-pil{
        color: black !important;
      }
      .nav-pil.active{
        color: rgb(255, 255, 255) !important;
        background: rgb(79,195,247) !important;
      }

    </style>

    @endsection