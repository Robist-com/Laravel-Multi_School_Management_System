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
          Email:<i class="email"> utguniverisity@gmail.gm</i> 
        </address>
      </div>
    <br><br>
    <h3 style="text-align:center; font-size: bold; font-width:30px;font-weight: 600;"> Department PDF </h3>

{{-- Table Shift Start Here --}}
<table class="table" id="classAssignings-table" style="margin-left: 40px;">
        <!-- <caption style="margin-top:20px;" >Class Assigned PDF</caption> -->
    <thead>
        <tr>
        <th>Full Name</th>
        <th>Gender</th>
        <th>Nationality</th>
        <th>Passport</th>
        <th>Phone</th>
        <!-- <th>Date of Birth</th> -->
        <th>Faculty</th> 
        <th>Department</th> 
        <th>Batch</th> 
        
        <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admissions as $admission)
            <tr class="border">
            <td class="col-md-6 pull">{!! $admission->first_name !!} {!! $admission->last_name !!}</td>
            <td class="col-md-2 pull">@if($admission->gender == 1) Male  @else Female  @endif</td>
            <td class="col-md-6 pull">{!! $admission->nationality !!}</td>
            <td class="col-md-6 pull">{!! $admission->passport !!}</td>
            <td class="col-md-6 pull">{!! $admission->phone !!}</td>
            <!-- <td class="col-md-6 pull">{!! date($admission->dob) !!}</td> -->
            <td class="col-md-4 pull">{!! $admission->faculty_name !!}</td>
            <td class="col-md-4 pull">{!! $admission->department_name !!}</td>
            <td class="col-md-6 pull">{!! $admission->batch !!}</td>
            <td class="col-md-2 pull">@if($admission->status == 1) Active @else Inactive @endif</td>
                <td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




