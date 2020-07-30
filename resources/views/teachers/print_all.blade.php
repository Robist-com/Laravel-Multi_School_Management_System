@php 
use App\Institute;
$institute = Institute::first();
@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$institute->name}} | (AIS)</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="icon" href="{{ asset('institute_logo/' .$institute->image) }}">


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
.pulll{
    text-align:center;
    border:1px solid;
    border-top:1px solid;
    border-bottom:1px solid
}
td1{
    text-align:center;
    border:1px solid
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
      <a href="#"><img src="{{ asset('institute_logo/' .$institute->image) }}" alt="logo" srcset="" style="width:70px; margin-left:30px"></a>
      <h1 class="title">{{$institute->name}}</h1>
     
        <!-- </h2> -->
      </div>
      <!-- /.col -->
    </div>
    <br>
    <div class="row no-print">
        <div class="col-xs-12">
          <button type="button" class="btn btn-danger pull-right" >
            <a href="{{ url('pdf-download-teacher-single') }}" style="color:#fff"><i class="fa fa-download"></i> Generate PDF</a>
          </button>
          <button type="button" class="btn btn-info pull-right" style="margin-right: 5px;"><i class="fa fa-print" onclick="window.print();"></i> Print
          </button>
        </div>
      </div>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col" style="margin-left: 40px;">
        <address>
          <h3 style="font-weight:300;font-size: 15px; font-style:bold"><b>Address, {{$institute->address}}.</b></h3>
          Latrikunda Sabiji POBox<br>
          Kmc, Blcok C 94107<br>
          Phone: (+220) {{$institute->phoneNo}}<br>
          Email: {{$institute->email}}
        </address>
      </div>
      </div>
      <!-- </div> -->
      @foreach($teachers as $teacher)
         <!-- Table row -->
         <div class="row">
        <div class="col-xs-12 table-responsive" style="margin-left: 10px;padding-right: 50px;">
          <table class="table table-striped" style="margin-left:8px;">
            <thead>
            
            <!-- <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> <b style="color:red">Teacher</b>  {!! $teacher->first_name !!} {!! $teacher->last_name !!} </h3> -->
            <tr>
            <td><img src="{{asset('teacher_images/' .$teacher->image)}}" alt="" 
                class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
                <td>
							<tr>
              <th style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">Full Name </th> 
              <th style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">nationality</th>
              <th style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">Dirth of Birth</th>
              <th style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-2 pull">Gender </th>
              <th style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">Phone</th>
              <th style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">Email </th>
              <th style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-6 pull">Address </th>
              <th style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">passport </th> 
              <th style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-2 pull">Status </th>
              </tr>
              <tr>
              <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">{!! $teacher->first_name !!} {!! $teacher->last_name !!} </td>
							 <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull"> {!! $teacher->nationality !!}</td>
							 <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">{!! $teacher->dob !!} </td>
							 <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull"> @if($teacher->gender == 0) Male @else Female @endif</td>
							<!-- <tr><th >Phone</th> <td> </td></tr> -->
						  <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">{!! $teacher->phone !!} </td>
						  <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull"> {!! $teacher->email !!}</td>
							 <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull"> {!! $teacher->address !!}</td>
							 <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull">{!! $teacher->passport !!} </td>
							 <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
              border-top:1px solid;border-left:1px solid;" class="col-md-3 pull"> @if($teacher->status == 0) Single  @else  Married @endif</td>
                </tr>
							</table>
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


