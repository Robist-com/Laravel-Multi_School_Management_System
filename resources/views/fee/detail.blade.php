
<style>
/* .container{
	width:100%;
	padding: 15px;
	box-shadow: 0px 0px 2px;
	margin: 0 auto;
} */

table {
	width: 100%;
	border-collapse: collapse;
	/* text-align: left; */
}

/* tr , th, td { */
	/* border: 1px solid; */
	/* padding: 5px; */
/* } */

</style>

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
                        <span class="label label-warning">{{ $student->username }}</span>
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
  

  