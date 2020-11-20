<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>admit Card</title>



  </head>
  <body>
    
<section>
	<div class="container">
		<div class="admit-card">
			<div class="BoxA border- padding mar-bot"> 
				<div class="row">
					<div class="col-sm-4">
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
			<div class="BoxC border- padding mar-bot">
				<div class="row">
					<div class="col-sm-6">
						<h5>Enrollment No : 9910101</h5>
					</div>
				</div>
			</div>
			<div class="BoxD border- padding mar-bot">
				<div class="row">
					<div class="col-sm-10">
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <td><b>ROLL NO : {{$data->roll_no}}</b></td>
							  <td><b>Class: </b> {{$data->class_name}}           <b style=margin-right:20%></b> <b>Grade:</b>  {{$data->semester_name}} </td>
							</tr>
							<tr>
							  <td><b>Student Name: </b>{{$data->first_name .' '. $data->last_name}}</td>
							  <td><b>Sex: </b>@if($data->gender == 0) Male @else Female @endif</td>
							</tr>
							<tr>
							  <td><b>Father/Guadian Name: </b>{{$data->father_name}}</td>
							  <td><b>DOB: </b>{{date('Y/m/d', strtotime($data->dob))}}</td>
							</tr>
							<tr>
							  <td colspan="2" style="    height: 125px;"><b>Address: </b>{{$data->student_address}}</td>
							</tr>
						  </tbody>
						</table>
					</div>
					<div class="col-sm-2 txt-center">
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <th scope="row txt-center">
                <img width="123px" height="165px" src="{{asset('student_images/' .$data->image)}}">
                <!-- <img src="http://peoplehelp.in/mewaruni/assets/uploads/student_photo/cda1af3d3e81a4b46ef182a5336b778b.jpg" width="123px" height="165px" /></th> -->
							</tr>
							<tr>
							  <th scope="row txt-center">
                <img src="{{url('school_images/signature/signature.png')}}" height="50px" >
                <!-- <img src="http://peoplehelp.in/mewaruni/images/signature.png" /></th> -->
							</tr>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="BoxE border- padding mar-bot txt-center">
				<div class="row">
					<div class="col-sm-12">
						<h5>EXAMINATION VENUE</h5>
						<p>NH - 79 Gangrar Chittorgarh - 312901 <br> RAJASTHAN, INDIA</p>
					</div>
				</div>
			</div>
			<div class="BoxF border- padding mar-bot txt-center">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Subject/Paper</th>
									<th>Exam Date</th>
								</tr>
							</thead>
						  <tbody>
							<tr>
							  <td>1</td>
							  <td>English</td>
							  <td>5 July 2019</td>
							</tr>
							<tr>
							  <td>2</td>
							  <td>English</td>
							  <td>5 July 2019</td>
							</tr>
							<tr>
							  <td>3</td>
							  <td>English</td>
							  <td>5 July 2019</td>
							</tr>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
			<footer class="txt-center">
				<p>*** MEWAR UNIVERSITY ***</p>
			</footer>
			
		</div>
	</div>
	
</section>

<style>
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
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>