@extends('layouts.websiteLayout.app')

@section('content')
<?php $url = request()->segment(3);?>
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
              <h2 class="mb-0">Forgot Password</h2>
              <p>Please provide your student roll number to reset your password or contact help desk <a href="#">Help Desk</a></p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{url('school/site/' .$url)}}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Forgot Password</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">

            
            <form method="post" action="{{ url('/forgot-password') }}">
            {!! csrf_field() !!}

               <div class="row justify-content-center">
                <div class="col-md-5">
                @include('flash::message')
                @include('adminlte-templates::common.errors')
                <input type="hidden" name="token" value="">

                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" autocomplete="off" placeholder="Enter your student roll number" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('username'))
                        <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
                   
                <div class="row">
                <div class="col-md-12">
                <a href="{{url('school/login/' .$url)}}"><i class="fa fa-key"></i> Login</a>
                    <button type="submit" class="btn btn-primary" style="float:right">
                        <i class="fa fa-btn fa-refresh"></i>Reset Password
                    </button>
                </div>
            </div>

                    <!-- <a href="{{url('student-forgot-password')}}">Forgot Password</a> -->
                </div>
            </div>


        </form>
            

          
        </div>
    </div>

    

    @endsection