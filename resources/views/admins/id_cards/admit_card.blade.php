<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>admit Card</title>


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

  </head>
  <body >
  <div class="col-md-12">
  <button id="print_content" class="btn btn-info btn-lg btn-block "  onclick="Printcontent('divide')"><span class="glyphicon glyphicon-search">Print </span></button>
  </div>
    <div class="row" id="divide">
    <?php for ($i=0; $i < 2; $i++) { ?> 
<section>
	<div class="container">
		<div class="admit-card">
			<div class="BoxA border- padding mar-bot"> 
				<div class="row header_color">
					<div class="col-sm-4 ">
						<h5>{{$data->name}}</h5>
						<p>Tel: {{$data->phoneNo}}   <br>  E-mail:  {{$data->school_email}}</p>
						<p>Address: {{$data->address}} <br> Banjul, The Gambia</p>
					</div>
					<div class="col-sm-4 txt-center">
          <img class="logo" src="{{url('institute_logo/' .$data->logo)}}" width="100px;">
					</div>
					<div class="col-sm-4">
						<h5>Admit Card</h5>
						<p>Session: {{$data->session}}</p>
					</div>
				</div>
			</div>
      @if($admit_cards->admit_roll_no != 'off')
			<div class="BoxC border- padding mar-bot">
				<div class="row">
					<div class="col-sm-6">
						<h5>Enrollment No : {{$data->roll_no}}</h5>
					</div>
				</div>
			</div>
      @endif
			<div class="BoxD border- padding mar-bot">
				<div class="row">
					<div class="col-sm-10">
						<table class="table table-bordered">
						  <tbody>
             
							<tr>
              @if($admit_cards->admit_roll_no != 'off')
							  <td><b>ROLL NO : {{$data->roll_no}}</b></td>
                @endif
                @if($admit_cards->admit_class != 'off')
							  <td><b>Class: </b> {{$data->class_name}}           <b style=margin-right:20%></b> <b>Grade:</b>  {{$data->semester_name}} </td>
                @endif
							</tr>
							<tr>
              @if($admit_cards->admit_student_name != 'off')
							  <td><b>Student Name: </b>{{$data->first_name .' '. $data->last_name}}</td>
                @endif
                @if($admit_cards->admit_gender != 'off')
							  <td><b>Sex: </b>@if($data->gender == 0) Male @else Female @endif</td>
                @endif
							</tr>
							<tr>
              @if($admit_cards->admit_father_name != 'off')
							  <td><b>Father/Guadian Name: </b>{{$data->father_name}}</td>
                @endif
                @if($admit_cards->admit_dob != 'off')
							  <td><b>DOB: </b>{{date('Y/m/d', strtotime($data->dob))}}</td>
                @endif
							</tr>
              @if($admit_cards->admit_address != 'off')
							<tr>
							  <td colspan="2" style=" height: 125px;"><b>Address: </b>{{$data->student_address}}</td>
							</tr>
              @endif
						  </tbody>
						</table>
					</div>
					<div class="col-sm-2 txt-center">
						<table class="table table-bordered">
						  <tbody>
              @if($admit_cards->admit_student_image != 'off')
							<tr>
							  <th scope="row txt-center">
                <img class="pic"  src="{{asset('student_images/' .$data->image)}}">
							</tr>
              @endif
              @if($admit_cards->school_signature != 'off')
							<tr>
							  <th scope="row txt-center">
                <img src="{{url('school_images/signature/signature.png')}}" class="signature" >
							</tr>
              @endif
						  </tbody>
						</table>
					</div>
				</div>
			</div>
			<footer class="txt-center footer">
				<p>*** {{$data->name}} ***</p>
				<p>{{$data->address}} </p>
			</footer>
			
		</div>
	</div>
	
</section>

@if($i == 0)
    <!-- <br><br><br><br><br><br><br><br><br>
    <br><br><br> -->
  <hr class="dot">
    <!-- <br><br> -->
    <!-- <hr> -->
    @endif
    <?php } ?>

<style>

.pic{
  @if($admit_cards->admit_address != 'off')
 
  height: 123px; 
   @else 
   height: 70px
   @endif

  
}

.signature{
  @if($admit_cards->admit_address != 'off')
  height: 50px; 
   @else 
   height: 25px;
   @endif
  }

.container{
  width:1000px;
 justify-content:center;
 padding-left:2%;
}

hr.dot {
  border-top: 1px dashed gray;
}
.txt-center {
    text-align: center;
}
.border- {
    border: 1px solid #000 !important;
}
.padding {
    padding: 15px;
}
.mar-bot {
    margin-bottom: 15px;
}
.admit-card {
    border: 2px solid #000;
    padding: 15px;
    margin: 20px 0;
}
.BoxA h5, .BoxA p {
    margin: 0;
   
}

.header_color{
  background-color: {{$admit_cards->school_header_bgcolor}};
    color: {{$admit_cards->school_header_color}};
    font-family: times new roman;
}

     
.footer{
    background-color: {{$admit_cards->school_footer_bgcolor}};
    color: {{$admit_cards->school_footer_color}};
}

h5 {
    text-transform: uppercase;
}
table img {
    width: 100%;
    margin: 0 auto;
}
.table-bordered td, .table-bordered th, .table thead th {
    border: 1px solid #000000 !important;
}
</style>

<script>


    function Printcontent(el) {
        // alert(1)
        var restorpage = document.body.innerHTML;
        var printContent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printContent; 
        window.print();
        document.body.innerHTML = restorpage; 
        window.close();
    }
</script>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>