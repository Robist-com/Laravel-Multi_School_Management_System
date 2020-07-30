@extends('layouts.app')

@section('content')
@include('table_style')
    @php 
   if(isset($class)){

   }else{
    $class ='';
   }
    @endphp
     <section class="content-header">
      <div class="box box-primary">
        <div class="box-body">
      <h2><i class="glyphicon glyphicon-user"></i> @if($class!='') Teacher Timetable @else Student Timetable @endif</h2>
    </div>
    <hr class="line">
  </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                
  <ul class="nav nav-pills">
    <li class="nav-item active"><a class="nav-link active" data-toggle="pill" href="#home">Monday</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu1">Tuesday</a></li>
    <li class="nav-item"><a  class="nav-link"data-toggle="pill" href="#menu2">Wednesday</a></li>
    <li class="nav-item"><a  class="nav-link"data-toggle="pill" href="#menu3">Thursday</a></li>
     <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu4">Friday</a></li>
      <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu5">Sturday</a></li>
       <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu6">Sunday</a></li>
  </ul>
<br>
<br>
<br>
  <div class="tab-content">

         <!-- MONDAY TIME TABLE  -->
    <div id="home" class="tab-pane in fade active">
      @include('timetables.days.monday')  
    </div>
  {{-- </div> --}}

      <!-- TUESDAY TIME TABLE  -->
    <div id="menu1" class="tab-pane fade">
      @include('timetables.days.tuesday')  
    </div>

        <!-- WEDNESDAY TIME TABLE  -->
    <div id="menu2" class="tab-pane fade">
      @include('timetables.days.wednesday')  
        
    </div>

            <!-- THURSDAY TIME TABLE  -->
    <div id="menu3" class="tab-pane">
      @include('timetables.days.thursday')  
     
    </div>

    <!-- FRIDAY TIME TABLE  -->
    <div id="menu4" class="tab-pane">
      @include('timetables.days.friday')  
      
      </div>

      <!-- SATURDAY TIME TABLE  -->
    <div id="menu5" class="tab-pane">
      @include('timetables.days.saturday')  
     
      </div>

          <!-- SUNDAY TIME TABLE  -->
       <div id="menu6" class="tab-pane" style="width:200px">
        @include('timetables.days.sunday')  
    </div>
  </div>
</div>
<div class="text-center">

</div>
</div>
    <!-- The Modal -->
<div class="modal"  data-backdrop="" id="teacherModal" role="dialog" aria-labelledby="preview-modal" aria-hidden="true" style="margin-top: 100px;" >
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header-store">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Teacher Detail</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <table id="classList" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th style="width:30%">Name</th>
              <th style="width:30%">Phone</th>
              <th style="width:30%">Email</th>
            </tr>
          </thead>
          <tbody id="tdetails">
            
          </tbody>
          </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script>

function getteacherinfo(teacher_id){
    //alert(teacher_id)
       $.ajax({
      url:"{{ url('/get/teacher') }}"+"/"+teacher_id,
      method:"GET",
      //data:{name:class_name,code:class_code,description:class_des, _token:_token},
      success:function(data){
          $("#tdetails").html(data);

          $('#teacherModal').modal('show');
      },

            error: function (textStatus, errorThrown) {
                alert(JSON.stringify(textStatus));
            }
     });
  }
 $('#timepicker1').timepicker();
  $('#timepicker2').timepicker();

  function confirmed(teacher_id){
    var x = confirm('Are you sure you want to delete timetable?');
                if (x){
                  window.location = "{{url('/timetable/delete/')}}/"+teacher_id;
                 return true;
                }else{
                  return false;
                }
  }
</script>
@endsection