
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Academic Information System| (AIS)</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
.title{
    color: #636b6f;
    /* padding: 0 5px; */
    font-size: 25px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-decoration: underline;
    text-transform: uppercase;
    float:right; color:blue;margin-top:20px;margin-right: 15%;
    /* width:30px; */
}
.container{
	width:100%;
	padding: 15px;
	/* box-shadow: 0px 0px 2px; */
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
    text-align:center;
    
    
}

th{
	background:#605ca8;
    text-align:center;
    color:#fff;
    font-weight:bold;
}

tbody > tr > td:last-child{
	/* background:#ccc; */
	
}
.badge{
    padding-top:2px;
    margin-top:3px;
}

.top_row {
    display: table;
    width: 100%;
}

.top_row > div {
    display: table-cell;
    width: 50%;
    border-bottom: 1px solid #eee;
}

body{
  background:#ecf0f5;
}
</style>
<!-- <body onload="window.print();"> -->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
    <small class="pull-right"><?php echo date('D-M-Y'); ?></small>
    <div class="navbar-custom-menu">
      <div class="col-xs-12">
      <a href="#"><img src="{{asset('FrontEnd/img/Logo_of_UTG.gif')}}" alt="logo" srcset="" style="width:70px; margin-left:30px"></a>
      <h1 class="title">Academic Information System</h1>
     
        <!-- </h2> -->
      </div>
      <!-- /.col -->
    </div>
    <br>
    <div class="row no-print">
        <div class="col-xs-12">
          <button type="button" class="btn btn-danger pull-right" >
            <a href="{{ url('pdf-download-teacher-single') }}" style="color:#fff"><i class="fa fa-download"></i> Generate PDF</a>
          </button>
          <button type="button" class="btn btn-info pull-right" style="margin-right: 5px;"><i class="fa fa-print" onclick="window.print();"></i> Print
          </button>
        </div>
      </div>

    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col" style="margin-left: 40px;" >
        <address>
          <h3 style="font-weight:300;font-size: 15px; font-style:bold"><b>Address, UTG University.</b></h3>
          Latrikunda Sabiji POBox<br>
          Kmc, Blcok C 94107<br>
          Phone: (+220) 439-6236<br>
          Email: latrikunddaubs@gmail.com
        </address>
      </div>
      </div>
      <!-- </div> -->
     @foreach ($classAssignings as $classAssigning)
         <!-- Table row -->
         <div class="row">
        <div class="col-xs-12 table-responsive" style="margin-left: 10px;padding-right: 50px;">
          <table class="table table-striped" style="margin-left:8px;" id="table-class-info">

            <thead>
        <tr>
            <th rowspan="2">Teacher</th>
            <th rowspan="2">Course</th>
            <th rowspan="2">Semester</th> 
            <th rowspan="2"style="text-align: center; background:#ff9222">Days</th>
            <th rowspan="2"style="text-align: center; background:#ff9222">Room and Class</th>
        </tr>
    </thead>

          
            <tr>

<tr>
<td class="col-md-2" style="padding-top:70px;">{!! $classAssigning->first_name !!} {!! $classAssigning->last_name !!}</td>
<td>
    <div class="top_row">
        <div>{!! $classAssigning->course_name !!}</div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classAssigning->level !!}</i>
        </div>
 </td>

<td>
    <div class="top_row">
        <div>{!! $classAssigning->semester_name!!}</div>
        <!-- <div>World</div> -->
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classAssigning->batch !!}</i>
        </div>
 </td>


 <td>
    <div class="top_row">
        <div><i class="badge badge-success">{!! $classAssigning->name !!}</i></div>
        <div><i class="badge badge-success"> {!! $classAssigning->time !!}</i> </div>
        </div>
        <div class="top_row">
        <i class="badge badge-success"> {!! $classAssigning->shift !!}</i>
        </div>
 </td>

<td> 
<i class="badge badge-success">{!! $classAssigning->classroom_name !!}</i> 
<i class="badge badge-success">{!! $classAssigning->class_name !!}</i>
</td>
</tr>
</table>
@endforeach
            </tbody>
        </div>
        <!-- /.col -->
      </div>
      </div>
      </div>
      </div>
        <!-- /.row -->
    </section>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
  MargeCommonRows($('#table-class-info'));

alert('hello')

// Escape last column
function MargeCommonRows(table){
	var firstColumnBrakes = [];
	$.each(table.find('th'),function(i){
		var previous = null, cellToExtend = null, rowspan = 1;
		table.find("td:nth-child("+i+")").each(function(index,e){
			var jthis = $(this),content = jthis.text();
			if(previous == content && content !== "" && $.inArray(index, firstColumnBrakes) === -1){
				jthis.addClass('hidden');
				cellToExtend.attr('rowspan',(rowspan = rowspan+1));
			}else{
				if(i==1) firstColumnBrakes.push(index);
				rowspan = 1;
				previous = content;
				cellToExtend = jthis;
			}
		});
	});
	$('td.hidden').remove();
}

});
</script>

</body>
</html>
