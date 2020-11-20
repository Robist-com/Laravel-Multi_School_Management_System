<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style.css" />
</head>

@foreach($id_cards as $card)
      
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

.page-header, .page-header-space {
  height: 100px;
}

.page-footer, .page-footer-space {
  height: 50px;

}

.page-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  border-top: 1px solid black; /* for demo */
  background: #ffff; /* for demo */
}

.page-header {
  position: fixed;
  top: 0mm;
  width: 100%;
  border-bottom: 1px solid black; /* for demo */
  background: #ffff; /* for demo */
}

.page {
  page-break-after: always;
  height:300px;
}

@page {
  margin: 20mm
}

@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   
   body {margin: 0;}
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
    		margin-top: 15px;
		}
		h2 {
			font-size: 15px;
			margin: 5px 0;
			margin-top: 12px;
		}
		h3 {
			font-size: 12px;
			margin: 2.5px 0;
			font-weight: 300;
		}
		.qr-code img {
			@if($card->grade == 'on')
			width: 70px;
			margin-top: 14px;
			@else
			width: 90px;
			margin-top: 15px;
			@endif
		}

		.signature img{
			width: 200px;
			background-size: 100px 120px;
			margin-top: 12px;
			font-size:120px;
		}
		p {
			font-size: 12px;
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
		.print_button{
			border-radius: 5px;
			background-color: #2A3F54;
			color: #ffffff; 
			cursor: pointer;

		}
</style>

<style>
    #print_content{
        border-radius: 0 .7px;
        height: 60px !important;
        width: 100%;
        padding: 0 5px 0 -5px;
        background: #2A3F54;
        color: #ffffff;
        font-size: 20px;
        font-weight: bold;
        /* font-family: serif; */
        font-family:'FontAwesome';
        content:"\f146";
        cursor:pointer;
    }
    #print_content:hover{
        background-color: rgb(42,63,74);
    }
</style>
@endforeach

<body>


  <div class="page-header" style="text-align: center">
        STAFF ID CARD
    <br/>
    <button type="button" style="background: dark">
    <a href="{{ url()->previous()}}">Return</a>
    </button>
    <button type="button" onClick="window.print()" id="print_content" class="print_button">
    Print
    </button>
  
  </div>

  <div class="page-footer">
    I'm The Footer
  </div>

  <table>

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
        <!-- <section class="container"> -->
		
		
		@foreach($institute as $institute)
		@foreach($id_cards as $card)
			<div class="col-lg-3 col-sm-6 left-half"  >
				<div class="thumbnail" style="height:70%">
                <!-- <div class="id-card-tag"></div>
                <div class="id-card-tag-strip"></div>
                <div class="id-card-hook"></div> -->
				@if($card->staff_card_holder == 'on')
                <div class="id-card-holder">
                @endif
				<div class="id-card">
                <!-- <div class="background" > -->
				<div class="header-color ">
                    <h2>{{$institute->name}}</h2>
				</div>
			
                <div class="header"> 
				@if($card->school_logo != ' ')
                    <img src="{{asset('institute_logo/' .$institute->logo)}}">
				@else
				<img src="{{asset('certificate_template/school_images/' .$card->school_logo)}}">
				@endif
                </div>
				
                <!-- student image -->
				@if($card->staff_image != 'off')
                <div class="photo">
                    <img src="{{asset('teacher_images/' .$institute->image)}}">
                </div>
				@endif

                @if($card->staff_name != 'off')
                <h2>{{$institute->first_name .' '. $institute->last_name}}</h2>
                @endif
                @if($card->staff_roll_no != 'off')
                <h2>{{$institute->roll_no}}</h2>
                @endif
                @if($card->staff_department != 'off')
                <h2>{{$institute->department_name}}</h2>
                @endif
				@if($card->staff_roll_no != 'off')
                <h2>{{$institute->semester_name}}</h2>
                @endif
                @if($card->qrcode)
                <div class="qr-code">
				<img src="{{asset('certificate_template/school_images/' .$card->qrcode)}}">
                    <!-- <img src="{{asset('school_images/signature/qrcode.png')}}"> -->
                </div>
                @endif

				@if($card->school_signature)
                <div class="signature">
				<img src="{{asset('certificate_template/school_images/' .$card->school_signature)}}">
                    <!-- <img src="{{asset('school_images/signature/signature.png')}}"> -->
                </div>
                @endif
                <!-- <h3>www.onetikk.info</h3> -->
                <hr>
				<div class="footer " >
                <!-- <p><strong>"PENGG"</strong>{{$institute->department_name}}<p> -->
                <p>{{$institute->school_address}} <strong>695033</strong></p>
                <p>Ph: {{$institute->phoneNo}} | E-ail: {{$institute->school_email}}</p>

            <!-- </div> -->
			@if($card->staff_card_holder == 'on')
            </div>
			@endif
            </div>
            </div>
            </div>
            </div>
            @endforeach
            @endforeach


          
<!-- </section> -->
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

  </table>

</body>

</html>