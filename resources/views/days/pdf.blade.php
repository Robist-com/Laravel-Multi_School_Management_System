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
</style>

<small class="pull-right"><?php echo date('D-M-Y'); ?></small>
    <div class="navbar-custom-menu">
      <div class="col-xs-12">
      <!-- <a href="#"><img src="{{asset('FrontEnd/img/Logo_of_UTG.gif')}}" alt="logo" srcset="" style="width:70px"></a> -->
      <h1 class="title">Academic Information System</h1>
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
          <h3 style="font-weight:300;font-size: 15px; font-style:bold"><b>Address, UTG University.</b></h3>
          Kanifing South POBox<br>
          Kmc, Blcok C 94107<br>
          Phone: (+220) 3939919 / 4396236<br>
          Email: utguniverisity@gmail.gm
        </address>
      </div>
    <br><br>
    <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> Days PDF </h3>

{{-- Table Day Start Here --}}
<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
            <th>Days</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($days as $day)
            <tr class="border">
                <td class="col-md-3 pull">{!! $day->name !!} </td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




