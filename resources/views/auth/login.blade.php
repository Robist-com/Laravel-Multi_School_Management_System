@php 
use App\Institute;
$institute = Institute::first();
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if(isset($institute))
    <title> {{$institute->name}} | (AIS) </title>
@endif
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    <!-- Favicon -->
    @if(isset($institute))
    <link rel="icon" href="{{ asset('institute_logo/' .$institute->image) }}">
    @endif
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
@if(isset($institute))
<img src="{{asset('institute_logo/' .$institute->image)}}" style="margin-left:40%;  border-radius: 50%;" width="60px" class="rounded" alt="" srcset="">
@endif
    <div class="login-logo">
        <a href="{{ url('/home') }}"><b>Teacher Login </b>Page</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body" >
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="post" action="{{ url('login/action') }}">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" id="username" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
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
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

                    <div class="row">
                      <div class="btn-group" data-toggle1="buttons">
                        <label class="btn btn-success">
                            <input type="hidden" name="" id="admin_username" value="3939919@gmail.com">
                            <input type="hidden" name="" id="admin_password" value="superadmin">
                            <input type="radio" class="form-checkbox" name="checkku"> admin  
                        </label>
                        <label class="btn btn-info">
                        <input type="hidden" name="" id="teacher_username" value="admin@admin.com">
                        <input type="hidden" name="" id="teacher_password" value="superadmin">
                          <input type="radio" name="options" id="teacher_id"> Teacher
                        </label>
                        <label class="btn btn-warning">
                        <!-- <input type="hidden" name="" id="student_username" value="411160930000111">
                        <input type="hidden" name="" id="student_password" value="411160930000111"> -->
                        <input type="hidden" name="" id="student_username" value="ala@gmail.com">
                        <input type="hidden" name="" id="student_password" value="superadmin">
                          <input type="radio" name="options" id="student_id"> School
                        </label>
                        <!-- <label class="btn btn-warning">
                        <input type="hidden" name="" id="parent_username" value="ala@gmail.com">
                        <input type="hidden" name="" id="parent_password" value="superadmin">
                          <input type="radio" name="options" id="parent_id"> School
                        </label> -->
                        <!-- <label class="btn btn-dark">
                        <input type="hidden" name="" id="accountant_username" value="411160930000111">
                        <input type="hidden" name="" id="accountant_password" value="411160930000111">
                          <input type="radio" name="options" id="accountant_id"> Accountant
                        </label> -->
                        
                      </div>
                      </div>

                        <a href="{{ url('/password/reset') }}">I forgot my password</a><br>
                        <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>
                        <br><br>
                        <div class="btn-group">
                        <a href="{{ url('/student') }}" class="text-center btn btn-rounded btn-primary"> <i class="fa fa-key">  Login As Student</i> </a>
                        </div>
                        <div class="btn-group">
                        <a href="{{ url('/parent') }}" class="text-center btn btn-rounded btn-primary"> <i class="fa fa-key">  Login As Parent</i> </a>
                        </div>
                        <div class="btn-group">
                        <a href="{{ url('/') }}" class="text-center btn btn-rounded btn-primary"><i class="fa fa-home"> Home</i>  </a>
       
                        </div>
                        </div>

    <!-- /.login-box-body -->
                </div>
<!-- /.login-box -->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <!-- AdminLTE App -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<!-- <script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    </script> -->
    <script>

    $(document).ready(function(){	
        var admin_username = $('#admin_username').val();
        var admin_password = $('#admin_password').val();

        var teacher_username = $('#teacher_username').val();
        var teacher_password = $('#teacher_password').val();

        var student_username = $('#student_username').val();
        var student_password = $('#student_password').val();

	
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
                
            $('#username').val(admin_username);
            $('#password').val(admin_password);
			}else{
                $('#username').val('');
                $('#password').val('');
			}
        });
        
        $('#teacher_id').click(function(){
			if($(this).is(':checked')){
                
            $('#username').val(teacher_username);
            $('#password').val(teacher_password);
			}else{
			$('#username').val('');
            $('#password').val('');
			}
        });
        
        $('#student_id').click(function(){
			if($(this).is(':checked')){
                
            $('#username').val(student_username);
            $('#password').val(student_password);
			}else{
			$('#username').val('');
            $('#password').val('');
			}
		});
	});

    </script>


    <!-- <script>

        $(document).ready(function() {

        var remember = $('#admin_id').val($(this).is(':checked'));
        alert(remember)
        if (remember == 'true') 
        {
            alert(1)
            var email = $.cookie('email');
            var password = $.cookie('password');
            // autofill the fields
            $('#email').val(email);
            $('#password').val(password);
        }


        $("#login").submit(function() {
        if ($('#remember').is(':checked')) {
            var email = $('#email').val();
            var password = $('#password').val();

            // set cookies to expire in 14 days
            $.cookie('email', email, { expires: 14 });
            $.cookie('password', password, { expires: 14 });
            $.cookie('remember', true, { expires: 14 });                
        }
        else
        {
            // reset cookies
            $.cookie('email', null);
            $.cookie('password', null);
            $.cookie('remember', null);
        }
        });
        });


    $(document).ready(function() {
    //set initial state.
    // $('#admin_id').val($(this).is(':checked'));
    
    // $('#checkbox1').change(function() {
        if($(this).is(":checked")) {
            $('#username').val(admin_username);
            $('#password').val(admin_password);

            // var returnVal = confirm("Are you sure?");
            // $(this).attr("checked", returnVal);
        }
        $('#username').val($(this).is(':checked'));        
    // });
});


    $(document).ready(function() {

        var admin_username = $('#admin_username').val();
        var admin_password = $('#admin_password').val();


            // $('#username').val(admin_username);
            // $('#password').val(admin_password);
        
        // alert(admin_username)
        // alert(admin_password)

   

    $('#username').change(function() {
        if(this.checked) {
            var returnVal = confirm("Are you sure?");
            $(this).prop("checked", returnVal);
        }
        $('#admin_id').val(this.checked);        
    });
});

    // $('#admin_id').on('click', function(){
    //     alert(this.val())
    // })
</script> -->
</body>
</html>
