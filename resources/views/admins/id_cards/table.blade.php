
        <!-- <section class="container"> -->
			<!-- <div class="col-lg-3 col-sm-6 left-half"  > -->
				<div class="thumbnail" style="height:70%">
                <!-- <div class="id-card-tag"></div>
                <div class="id-card-tag-strip"></div>
                <div class="id-card-hook"></div> -->
				@if($card->card_holder == 'on')
                <div class="id-card-holder">
                @endif
				<div class="id-card">
                <!-- <div class="background" > -->
				<div class="header-color ">
                    <h2>School Name</h2>
				</div>
			
                <div class="header"> 
				@if($card->school_logo == 'default')
				<img src="{{asset('certificate_template/school_images/school_logo.png')}}">
				@endif
                </div>
				
                <!-- student image -->
				@if($card->student_image != 'off')
                <div class="photo">
                <img src="{{asset('certificate_template/school_images/student_image.png')}}">
                </div>
				@endif

                @if($card->student_name != 'off')
                <h2>Student Name</h2>
                @endif
                @if($card->roll_no != 'off')
                <h2>Roll No</h2>
                @endif
                @if($card->class != 'off')
                <h2>Class</h2>
                @endif
				@if($card->grade != 'off')
                <h2>Grade</h2>
                @endif
                @if($card->qrcode)
                <div class="qr-code">
                    <img src="{{asset('school_images/signature/qrcode.png')}}">
                </div>
                @endif

				@if($card->qrcode)
                <div class="signature">
                    <img src="{{asset('school_images/signature/signature.png')}}">
                </div>
                @endif
                <!-- <h3>www.onetikk.info</h3> -->
                <hr>
				<div class="footer " >
                <p><strong>"PENGG"</strong>HOUSE,4th Floor, TC 11/729(4), Division Office Road <p>
                <p>Near PMG Junction, Thiruvananthapuram Kerala, India <strong>695033</strong></p>
                <p>Ph: 9446062493 | E-ail: info@onetikk.info</p>

            </div>
			@if($card->card_holder == 'on')
            </div>
			@endif
            <!-- </div> -->
            </div>
            </div>
            </div>
           
<!-- </section> -->


@foreach($card_template as $card)
      
        <style>

.header-color{
    background-color: {{$card->school_header_bgcolor}};
    color: {{$card->school_header_color}};
    font-family: times new roman;
}

     
.footer{
    background-color: {{$card->school_footer_bgcolor}};
    color: {{$card->school_footer_color}};
}


.background
{
  background-image: url('{{asset('school_images/signature/signature.png')}}') ;
  background-size: 100px 120px;
  background-position: 100px 350px;
  background-repeat: no-repeat;
  position: relative;
    font-size:120px;
    /* opacity: 0.7; */
    
}
    
    body {
			/* background-color: #d7d6d3; */
			font-family:'verdana';
		}
		.id-card-holder {
            /* width: 225px; */
            width:321px;
		    padding: 4px;
		    margin: 0 auto;
		    background-color: #1f1f1f;
		    border-radius: 5px;
		    position: relative;
		}
		.id-card-holder:after {
		    content: '';
		    width: 7px;
		    display: block;
		    background-color: #0a0a0a;
		    height: 100px;
		    position: absolute;
		    top: 105px;
		    border-radius: 0 5px 5px 0;
		}
		.id-card-holder:before {
		    content: '';
		    width: 7px;
		    display: block;
		    background-color: #0a0a0a;
		    height: 100px;
		    position: absolute;
		    top: 105px;
		    left: 320px;
		    border-radius: 5px 0 0 5px;
		}
		.id-card {
			
			background-color: #fff;
			padding: 10px;
			border-radius: 10px;
            text-align: center;
            /* height:700px; */
            width:300px;
			box-shadow: 0 0 1.5px 0px #b9b9b9;
		}
		.id-card img {
			margin: 0 auto;
		}
		.header img {
			width: 100px;
    		margin-top: 15px;
		}
		.photo img {
            width: 80px;
            height:110px;
    		/* margin-top: 15px; */
		}
		h2 {
			font-size: 15px;
			margin: 5px 0;
		}
		h3 {
			font-size: 12px;
			margin: 2.5px 0;
			font-weight: 300;
		}
		.qr-code img {
			width: 50px;
		}
		p {
			font-size: 5px;
			margin: 2px;
		}
		.id-card-hook {
			background-color: #000;
            /* width: 70px; */
            width:300px;
		    margin: 0 auto;
		    height: 15px;
		    border-radius: 5px 5px 0 0;
		}
		.id-card-hook:after {
			content: '';
		    background-color: #d7d6d3;
            /* width: 47px; */
            width:300px;
		    height: 6px;
		    display: block;
		    margin: 0px auto;
		    position: relative;
		    top: 6px;
		    border-radius: 4px;
		}
		.id-card-tag-strip {
            /* width: 45px; */
            width:300px;
		    height: 40px;
		    background-color: #0950ef;
		    margin: 0 auto;
		    border-radius: 5px;
		    position: relative;
		    top: 9px;
		    z-index: 1;
		    border: 1px solid #0041ad;
		}
		.id-card-tag-strip:after {
			content: '';
		    display: block;
            /* width: 100%; */
            width:300px;
		    height: 1px;
		    background-color: #c1c1c1;
		    position: relative;
		    top: 10px;
		}
		.id-card-tag {
			width: 0;
			height: 0;
			border-left: 100px solid transparent;
			border-right: 100px solid transparent;
			border-top: 100px solid #0958db;
			margin: -10px auto -30px auto;
		}
		.id-card-tag:after {
			content: '';
		    display: block;
		    width: 0;
		    height: 0;
		    border-left: 50px solid transparent;
		    border-right: 50px solid transparent;
		    border-top: 100px solid #d7d6d3;
		    margin: -10px auto -30px auto;
		    position: relative;
		    top: -130px;
		    left: -50px;
		}
       
</style>
   
@endforeach
