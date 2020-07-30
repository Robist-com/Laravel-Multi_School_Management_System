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

<td>semester_name</td>
<td>semester_code</td>
<td>faculty_name</td>
<td>department_name</td>
<td>course_name</td>
<td>first_name</td>
<td>level</td>

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
                    <h4 class="modal-title" id="myModalLabel">More About student lastname</h4>
                    </div>
                <div class="modal-body">
                    <center>
                    	  <img src="{{asset('student_images/')}}"  
                          name="aboutme" width="140" height="140" border="0" class="img-circle">
                    <h3 class="media-heading">fitsr name and last name <small>nationality</small></h3>
                    <span><strong>Acc: </strong></span>
                        <span class="label label-warning">semester</span>
                        <span class="label label-info">faculty</span>
                        <span class="label label-info">department</span>
                        <span class="label label-success">class</span>
                        <span class="label label-default">batch</span>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">I've heard enough about lastname</button>
                    </center>
                </div>
            </div>
        </div>
  

