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

            
            <form method="post" action="{{ url('/student-login') }}" autocomplete="off">
            {!! csrf_field() !!}

               <div class="row justify-content-center">
                <div class="col-md-5">
                @include('flash::message')
                @include('adminlte-templates::common.errors')
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control form-control-lg" autocomplete="off">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Password</label>
                            <input type="text" name="password" id="pword" class="form-control form-control-lg" autocomplete="off">
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

    

    @endsection