@php 
use App\Institute;
$institute = Institute::first();
@endphp

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
    text-decoration:underline;
}
.pull{
    text-align:center;
    border: 1px solid;
}

th{
    text-align:center;
    border:1px solid;
}
table{
   align-content: center
}
.email{
    text-decoration:underline;
    color:blue;
}
</style>

<small class="pull-right"><?php echo date('D-M-Y'); ?></small>
    <div class="navbar-custom-menu">
      <div class="col-xs-12">
      <img src="img/image" >
      
      <h1 class="title">{{$institute->name}}</h1>
      <br><br>

        <!-- </h2> -->
      </div>
      <!-- /.col -->
    </div>
    <br>
<!-- large table okay -->
<div class="table-responsive-lg" style="margin-left: 40px;"> 
<div class="col-sm-4 invoice-col"  >
        <address>
          <h3 style="font-weight:300;font-size: 15px; font-style:bold"><b>Address, {{$institute->address}}.</b></h3>
          Kanifing South POBox<br>
          Kmc, Blcok C 94107<br>
          Phone: (+220) {{$institute->phoneNo}} / {{$institute->phoneNo1}}<br>
          Email:<i class="email"> {{$institute->email}}</i> 
        </address>
      </div>
    <br><br>