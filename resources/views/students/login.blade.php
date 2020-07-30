@php 
use App\Institute;
$institute = Institute::first();
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$institute->name}} | (AIS) </title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('institute_logo/' .$institute->image) }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition login-page">
<div class="login-box">
<img src="{{asset('institute_logo/' .$institute->image)}}" style="margin-left:40%;  border-radius: 50%;" width="60px" class="rounded" alt="" srcset="">
    <div class="login-logo">
        <a href="{{ url('/home') }}"><b>{{__("language.login_page_message") }}</b>{{__("language.pages") }}</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <p class="login-box-msg">{{__("language.login_info") }}</p>

        <form method="post" action="{{ url('/student-login') }}">
            {!! csrf_field() !!}

            {{-- as the student will login with his roll number not email so we 
                will chnge the email type to text okay --}}

            <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="{{__("language.username") }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="{{__("language.password") }}" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> {{__("language.remember_me") }}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> {{__("language.login") }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <i class="fa fa-key"></i> <a href="{{ url('/student-forgot-password') }}">{{__("language.forgot_password") }}</a><br> 
        <i class="fa fa-volume-control-phone"></i> <a href="{{ url('/register') }}" class="text-center">{{__("language.contact_desk") }}</a>
        <br><br>
        <div class="btn-group">
       <a href="{{ url('/login') }}" class="text-center btn btn-rounded btn-primary"> <i class="fa fa-key">  Login As Teacher</i> </a>
      
        </div>
        <div class="btn-group">
        <a href="{{ url('/parent') }}" class="text-center btn btn-rounded btn-primary"> <i class="fa fa-key">  Login As Parent</i> </a>
    </div>

    <div class="btn-group">
        <a href="{{ url('/') }}" class="text-center btn btn-rounded btn-primary"><i class="fa fa-home"> Home</i>  </a>
       
    </div>
    {{-- we will work on the forget and rest password soon okay. --}}
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
