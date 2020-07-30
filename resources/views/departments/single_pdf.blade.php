
   


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
    text-decoration: underline;
    text-transform: uppercase;
    float:right; color:blue;margin-top:20px;margin-right: 15%;
    /* width:30px; */
}
/* .pul{
    text-align:center;
            border: 1px solid;
}
th{
    text-align:center;
            border: 1px solid;
} */


</style>
    <div class="row">
    <small class="pull-right"><?php echo date('D-M-Y'); ?></small>
    <div class="navbar-custom-menu">
      <div class="col-xs-12">
      <!-- <a href="#"><img src="{{asset('FrontEnd/img/Logo_of_UTG.gif')}}" alt="logo" srcset="" style="width:70px"></a> -->
      <h1 class="title">Academic Information System</h1>
      <br><br><br>
      @foreach ($departments as $department)

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
        <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;text-transform: uppercase;"> <b style="color:red">Department</b> <b style="color:brown">OF</b>   {!! $department->department_name !!} </h3>
         <!-- Table row -->
         <div class="row" class="pull-center">
        <div class="col-xs-12 table-responsive" style="margin-left: 40px;">
          <table class="table table-striped" style="margin-left:8px;">          

                  <tr>
                    <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
                            border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">{!! $department->faculty_name !!} </td>
                    <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
                            border-top:1px solid;border-left:1px solid;" class="col-md-2 pull">{!! $department->department_name !!} </td>
                             <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
                            border-top:1px solid;border-left:1px solid;" class="col-md-2 pull">{!! $department->department_code !!} </td>
                             <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
                            border-top:1px solid;border-left:1px solid;" class="col-md-2 pull">{!! $department->department_description !!} </td>
                    <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
                            border-top:1px solid;border-left:1px solid;"class="col-md-2 pull">@if($department->department_status == 1)  Active @else In-Active @endif </td>
                    </tr>
                   
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
   