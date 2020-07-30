<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Academic Information System| (AIS)</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
.title{
    color: #636b6f;
    /* padding: 0 5px; */
    font-size: 25px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
    float:right; color:blue;margin-top:20px;margin-right: 15%;
    /* width:30px; */
}
.pull{
    text-align:center;
            border: 1px solid;
}
th{
    text-align:center;
            border: 1px solid;
}


</style>
    <div class="row">
    <small class="pull-right"><?php echo date('D-M-Y'); ?></small>
    <div class="navbar-custom-menu">
      <div class="col-xs-12">
      <!-- <a href="#"><img src="{{asset('FrontEnd/img/Logo_of_UTG.gif')}}" alt="logo" srcset="" style="width:70px"></a> -->
      <h1 class="title">Academic Information System</h1>
      <br><br><br>
      @foreach($teachers as $teacher)
        <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> {!! $teacher->first_name !!} {!! $teacher->last_name !!}'s Profile </h3>
        @endforeach
        <!-- </h2> -->
      </div>
      <!-- /.col -->
    </div>
    <br>
    <!-- <div class="row invoice-info"> -->
    <div class="table-responsive">
      <div class="col-sm-4 invoice-col" style="margin-left: 40px;" >
        <address>
          <h3 style="font-weight:300;font-size: 15px; font-style:bold"><b>Address, UTG University.</b></h3>
          Latrikunda Sabiji POBox<br>
          Kmc, Blcok C 94107<br>
          Phone: (+220) 439-6236<br>
          Email: latrikunddaubs@gmail.com
        </address>
      </div>
        <br>
         <!-- Table row -->
         <div class="row" class="pull-center">
        <div class="col-xs-12 table-responsive" style="margin-left: 40px;">
          <table class="table table-striped" style="margin-left:8px;">
            @foreach($teachers as $teacher)
            <tr>
<!--  THE LIKE THE PDF FILE OKAY. -->
                         <td>
							<tr><th scope="col">Full Name </th> 
                            <td  class="col-md-3 pull">{!! $teacher->first_name !!} {!! $teacher->last_name !!} </td>
                            </tr>
							<tr><th scope="col">nationality</th> 
                            <td class="col-md-3 pull"> {!! $teacher->nationality !!}</td>
                            </tr>
							<tr><th scope="col">Dirth of Birth</th> 
                            <td class="col-md-3 pull">{!! $teacher->dob !!} </td>
                            </tr>
							<tr><th scope="col">Gender </th> 
                            <td class="col-md-3 pull"> @if($teacher->gender == 0) Male @else Female @endif</td>
                            </tr>
							<tr><th scope="col">Phone</th> 
                            <td class="col-md-3 pull">{!! $teacher->phone !!} </td>
                            </tr>
							<tr><th scope="col">Email </th> 
                            <td class="col-md-3 pull"> {!! $teacher->email !!}</td>
                            </tr>
							<tr><th scope="col">Address </th> 
                            <td class="col-md-3 pull"> {!! $teacher->address !!}</td>
                            </tr>
							<tr><th scope="col">passport </th> 
                            <td class="col-md-3 pull">{!! $teacher->passport !!} </td>
                            </tr>
							<tr><th scope="col">Status </th> 
                            <td class="col-md-3 pull"> @if($teacher->status == 0) Single  @else  Married @endif</td>
                            </tr>
                            <!-- </td> -->
                            </tr>
							</table>
                            @endforeach
            <!-- </tbody> -->
        </div>
        <!-- /.col -->
      </div>
      </div>
      </div>
        <!-- /.row -->
    </section>
    </div>
   