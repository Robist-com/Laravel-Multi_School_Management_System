

<div class="modal fade" id="attendance-show" style="display: none;">
     <div class="modal-dialog style="width:90%">
     <div class="modal-content">
     <div class="modal-header-store">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">×</span></button>
     <h4 class="modal-title">Mark Class Attendance</h4>
     </div>
                                   
<div class="modal-body">
                                  
            <div class="box-body">
            <div class="form-group">
            <div class=" well row">
            <label class=" col-md-4 text-right">Class <span
            class="text-danger">*</span></label>
            <h4> <div class="col-md-6 text" >
            <select name="class" id="class" class="form-control select_2_single">                                                  
            <option value="0" disabled="true" selected="true" >Select Class</option>
            @foreach ($classes as $item)
            <option value="{!! $item->id !!}">{!! $item->class_name !!}</option>
            @endforeach
            </select>
                                                        
                                                        
                                                       
            </div>
            </h4>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <label class="col-md-4 text-right" style="margin-top:10px;">
            </label>
            <h4>
             <div class="well col-md-8 text-right">
                 <span class=" pull-left">
         <?php
            $date = date('d-m-Y');
           $nameOfDay = date('l', strtotime($date));
           echo "<span style='color:red'>$nameOfDay</span>";
        ?>
             Attendance 
             </span> <br>
            <b style="font-weight:bolder;">  Date: </b>  <?php echo date('d-m-Y')?>
           
                
            </div></h4>
            </div>
            </div>
            </div>
            <div class="form-group" id="student_details">
            <div class="table-responsive">
            <table class="table table-striped table-bordered" >
            <thead>
            <tr>
                <th>Roll No.</th>
                <th>Student Name</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
                <th>Sick</th>
            </tr>
            </thead>
            <!-- <tbody id="student"> -->
           
        </tbody>                                        
            </table>
            </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger"
            data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn  bg-navy"><span
            class="glyphicon glyphicon-pencil"> Mark-Attendance</button>
            </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            </div>
            </div>
@section('scripts');
            <script>
            
        //     $('#class').on('change',function(){
        //         var class_id = $(this).val();
        //         var tbody = $('#tbody')
                
        // $.get("{{ url('/get/attendance/class') }}",{class_id:class_id},function(data){  
                    
        //     console.log(data);


        // }) 
                        
        //     });

    //         $("#class").on('change', function(){
	// 	var classid = $("#class").val();
	// 	// alert(classid);

	// 	$.ajax({
	// 		type: 'get',
	// 		dataType: 'html',
	// 		url: '{{ url ('/get/attendance/class')}}',
	// 		data: {'class_id': classid},
            
	// 		success:function(data){
	// 			console.log(data);
	// 				$("#student").html(data);
                    
	// 		}
	// 	});
	// });

            </script>
    @endsection