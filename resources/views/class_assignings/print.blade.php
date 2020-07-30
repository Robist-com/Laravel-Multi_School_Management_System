
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
/* .pulll{
    text-align:center;
    border:1px solid;
    border-top:1px solid;
    border-bottom:1px solid
}
td1{
    text-align:center;
    border:1px solid
} */
/* </style>

<style> */
.container{
	width:100%;
	padding: 15px;
	/* box-shadow: 0px 0px 2px; */
	margin: 0 auto;
}

table {
	width: 100%;
	border-collapse: collapse;
	text-align: left;
}

tr , th, td {
	border: 1px solid;
	padding: 5px;
}

th{
	background:#ccc;
}

tbody > tr > td:last-child{
	background:#ccc;
	
}
.badge{
    padding-top:2px;
    margin-top:3px;
}

</style>
<!-- <body onload="window.print();"> -->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
    <small class="pull-right"><?php echo date('D-M-Y'); ?></small>
    <div class="navbar-custom-menu">
      <div class="col-xs-12">
      <a href="#"><img src="{{asset('FrontEnd/img/Logo_of_UTG.gif')}}" alt="logo" srcset="" style="width:70px; margin-left:30px"></a>
      <h1 class="title">Academic Information System</h1>
      @foreach($classAssignings as $key =>  $classAssigning)

        <!-- </h2> -->
      </div>
      <!-- /.col -->
    </div>
    <br>
    <div class="row no-print">
        <div class="col-xs-12">
          <!-- <a href="print-admission.php" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
          <button type="button" class="btn btn-danger pull-right" >
            <a href="{{ url('pdf-download-class-assign-single', [$classAssigning->class_assign_id])}}" style="color:#fff"><i class="fa fa-download"></i> Generate PDF</a>
          </button>
          <button type="button" class="btn btn-info pull-right" style="margin-right: 5px;"><i class="fa fa-print" onclick="window.print();"></i> Print
          </button>
        </div>
      </div>
      @endforeach
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col" style="margin-left: 40px;" >
        <address>
          <h3 style="font-weight:300;font-size: 15px; font-style:bold"><b>Address, UTG University.</b></h3>
          Latrikunda Sabiji POBox<br>
          Kmc, Blcok C 94107<br>
          Phone: (+220) 439-6236<br>
          Email: latrikunddaubs@gmail.com
        </address>
      </div>
      </div>
      <!-- </div> -->

         <!-- Table row -->
         <div class="row">
        <div class="col-xs-12 table-responsive" style="margin-left: 10px;padding-right: 50px;">
          <table class="table table-striped" style="margin-left:8px;">
            <thead>
            @foreach ($classAssignings as $classAssigning)
            <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> {!! $classAssigning->first_name !!} {!! $classAssigning->last_name !!} 's Time Table </h3>

                    <tr>
                    <!-- we will change this course_id to course okay. -->
                    <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
                    border-top:1px solid;border-left:1px solid;"
                     class="col-md-2">{!! $classAssigning->first_name !!} {!! $classAssigning->last_name !!}</td>
                     <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
                    border-top:1px solid;border-left:1px solid;" class="col-md-2">{!! $classAssigning->semester_name !!}</td>
                     <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
                    border-top:1px solid;border-left:1px solid;" class="col-md-3">{!! $classAssigning->course_name !!}</td>
                    <div class="v"></div>
                    <td style="text-align:center; border-bottom:1px solid;border-right:1px solid;border-top:1px solid" class="col-md-8" style="margin-right:100px;">
                    <span class="names">Class:</span> {!! $classAssigning->class_name !!} |
                    <span class="names">Level:</span>  {!! $classAssigning->level !!}
                       <span class="names">Batch:</span> {!! $classAssigning->batch !!} |
                       <span class="names">Day:</span> {!! $classAssigning->name !!} |
                       <span class="names">Shift:</span> {!! $classAssigning->shift !!} |
                       <span class="names">Tiem:</span> {!! $classAssigning->time !!} |
                       <span class="names">ClassRoom:</span> {!! $classAssigning->classroom_name !!} |
                     </td>
                    </tr>
                   
                @endforeach
            </tbody>
        </div>
        <!-- /.col -->
      </div>
      </div>
      </div>
      </div>
        <!-- /.row -->
    </section>
   

   