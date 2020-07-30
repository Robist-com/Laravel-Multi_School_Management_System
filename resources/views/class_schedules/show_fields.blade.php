<!------------------------------ Modal start from here okay-------------------------------- -->
<div class="modal fade" id="Viewclassschedule-show" tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel"
aria-hidden="true">
   <div class="modal-dialog " style="width:90%">
       <div class="modal-content">
           <div class="modal-header"  > 
           <button type="button" class="close" data-dismiss="modal" 
           aria-hidden="true">&times;</button>
           <h4 class="modal-title"></h4>  
           </div>
            <div class="panel-body" style="border-bottom: 1px solid #ccc; ">
               <div class="modal-body">
           {{-- <form action="{{route('classSchedules.show','Scheduleid')}}" method="get">  --}}
            <div class="form-group">
           <div class="row"></div> 

           <input type="hidden" name="Scheduleid" id="Scheduleid"> 
<!-- Class Id Field -->
   <div class="form-group col-sm-4">
   <input type="text" class="form-control" name="class_id" id="class_id" readonly>
   </div>

   <!-- Course Id Field -->
   <div class="form-group col-sm-4">
  <input type="text" class="form-control" name="course_id" id="course_id" readonly>
</div>

<!-- Level Id Field -->
<div class="form-group col-sm-4">
   <input type="text" class="form-control" name="level_id" id="level_id" readonly>
</div>
<!-- i will skip the level first because we need to extra code for the level it will
be dynamic value by the select of the course okay.... -->

<!-- Shift Id Field -->
<div class="form-group col-sm-4">
   <input type="text" class="form-control" name="shift_id" id="shift_id" readonly>
</div>

<!-- Classroom Id Field -->
<div class="form-group col-sm-4">
   <input type="text" class="form-control" name="classroom_id" id="classroom_id"  readonly>
</div>

<!-- Batch Id Field -->
<div class="form-group col-sm-4">
<input type="text" class="form-control" name="batch_id" id="batch_id" readonly>
</div>

<!-- Day Id Field -->
<div class="form-group col-sm-4">
<input type="text" class="form-control" name="day_id" id="day_id" readonly>
</div>

<!-- Time Id Field -->
<div class="form-group col-sm-4">
<input type="text" class="form-control" name="time_id" id="time_id" readonly>
</div>

<!-- Semester Id Field -->
<div class="form-group col-sm-4">
<input  type="text" class="form-control" name="semester_id" id="semester_id" readonly>
</div>

<!-- Start Date Field -->
<div class="form-group col-sm-6">
       <label >Start Date</label>
       <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" readonly>
</div>

<!-- End Date Field -->
<div class="form-group col-sm-6">
       <label >End Date</label>
       <input type="text" class="form-control" name="end_date" id="end_date" autocomplete="off" readonly>
</div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6" name="status" id="status">
  <input type="text" name="status" id="status">
</div>
</div>
     <!-- </div> -->
     <!-- </div> -->
       <div class="modal-footer ">
        <button type="submit" class="btn btn-danger btn-sm" data-dismiss="modal">close</button>
         </div>
       </div>
   </div>
</div>
</div>
