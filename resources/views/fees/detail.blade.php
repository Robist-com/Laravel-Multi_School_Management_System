<!DOCTYPE html>
<html>
<head>
<title>Examination Result</title>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
</head>
@include('table_style') 
<header>
<nav>

</nav>
</header>
<body>
<style>
.container{
	width:100%;
	padding: 15px;
	box-shadow: 0px 0px 2px;
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
	/* background:#ccc; */
}

/* tbody > tr > td:last-child{
	background:#ccc;
	
} */

</style>

<div class="collapse" id="collapseExample">
<div class="card card-body">
<div class="container">
<table class="table table-borderd table-condensed table-hover">
<thead>
<tr>
<th colspan="5" style="text-align: center; background:#580404">Subjects</th>
</tr>
</thead>
<tbody>
@foreach($data as $key => $student)
<td>{!! $student->semester_name!!}</td>
<td>{!! $student->semester_code!!}</td>
<td>{!! $student->faculty_name!!}</td>
<td>{!! $student->department_name!!}</td>
<td>{!! $student->course_name!!}</td>
<td>{!! $student->first_name!!}</td>
<td>{!! $student->degree_name!!}</td>

<tr>
{{-- @foreach($data as $key => $exam)
<td>{!! $exam->course->first_name !!}</td>
<td>{!! $exam->semester->semester_name !!}</td>
@endforeach --}}
</tr>
@endforeach 
{{-- @foreach($data2 as $key => $data)
<td>{!! $data->course_name !!}</td>
@endforeach --}}
</tbody>
</table>
</div>
</div>
</div>
</body>
</html>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header-store">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="myModalLabel">More About {{ $student->last_name }}</h4>
                    </div>
                <div class="modal-body">
                    <center>
                    	  <img src="{{asset('student_images/'.$student->image)}}"  
                          name="aboutme" width="140" height="140" border="0" class="img-circle">
                    <h3 class="media-heading">{{ $student->first_name ." ". $student->last_name }} <small>{{ $student->nationality }}</small></h3>
                    <span><strong>Acc: </strong></span>
                        <span class="label label-warning">{{ $student->semester_name }}</span>
                        <span class="label label-info">{{ $student->faculty_name }}</span>
                        <span class="label label-info">{{ $student->department_name }}</span>
                        <span class="label label-success">{{ $student->class_name }}</span>
                        <span class="label label-default">{{ $student->batch }}</span>
                    </center>
                    <hr>
                    <center>
                    <p class="text-left"><strong>Bio: </strong><br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sem dui, tempor sit amet commodo a, vulputate vel tellus.</p>
                    <br>
                    </center>
                </div>
                <div class="modal-footer">
                    <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal">I've heard enough about {{ $student->last_name }}</button>
                    </center>
                </div>
            </div>
        </div>
  

  