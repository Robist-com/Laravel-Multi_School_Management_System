@extends('layouts.frontLayout.app')
@section('content')


<section class="col-lg-6 connectedSortable ui-sortable">
    <div class="row">
      <!-- left column -->
      <!-- <div class="col-md-6"> -->
        <!-- general form elements -->
        <!-- <div class="box box-primary"> -->
          <div class="box-header with-border">
            <!-- <h3 class="box-title">Information</h3> -->
          <!-- </div> -->
          <!-- /.box-header -->
          <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-blue">
            <div class="widget-user-image">
            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username" style="text-align:center">Notice Board</h3>
          </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
             
            </ul>
          </div>
        </div>

        
            <marquee behavior="side" scrollamount="2" direction="fade">
         
                  <p class="para"><i class="badge bg-purple-active">
                  {{$noticeMessage->type}}
                  
                  </p>
                  <p class="para"><i>
                  {{$noticeMessage->body}}
                  </p>
         
                  </marquee>
              
 </div>
  </section>



        <div class="col-lg-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Gallery</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
              </ol>
              <div class="carousel-inner">
                <div class="item active">
                <img src="{{asset('Gallary/banner1.jpg')}}" alt="First slide">

                  <div class="carousel-caption">
                    First Slide
                  </div>
                </div>
                <div class="item">
                  <img src="{{asset('Gallary/banner2.jpg')}}" alt="Second slide">

                  <div class="carousel-caption">
                    Second Slide
                  </div>
                </div>
                <!-- <div class="item">
                  <img src="{{asset('Gallary/banner3.jpg')}}" alt="Third slide">

                  <div class="carousel-caption">
                    Third Slide
                  </div>
                </div> -->
                <div class="item">
                  <img src="{{asset('Gallary/banner4.jpg')}}" alt="Third slide">

                  <div class="carousel-caption">
                    Fourth Slide
                  </div>
                </div>
                <div class="item">
                  <img src="{{asset('Gallary/banner5.jpg')}}" alt="Third slide">

                  <div class="carousel-caption">
                    Fifth Slide
                  </div>
                </div>
              </div>
              <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="fa fa-angle-left"></span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="fa fa-angle-right"></span>
              </a>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->


</section>













@endsection


@section('scripts')

<script>
    var IDLE_TIMEOUT = 60; //seconds
var _idleSecondsCounter = 0;
document.onclick = function() {
  _idleSecondsCounter = 0;
};
document.onmousemove = function() {
  _idleSecondsCounter = 0;
};
document.onkeypress = function() {
  _idleSecondsCounter = 0;
};

var myInterval = window.setInterval(CheckIdleTime, 5000);

function CheckIdleTime() {
  _idleSecondsCounter++;
  var oPanel = document.getElementById("SecondsUntilExpire");
  if (oPanel)
    oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
  if (_idleSecondsCounter >= IDLE_TIMEOUT) {
    // alert("Time expired!");
    window.location.replace("/student/logout");
    window.clearInterval(myInterval);
    // oPanel.innerHTML = ("Job Done");
  }
}
</script>
    
@endsection