@extends('layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')

<style>
th{
  text-align: center;
  font-family: 'Times New Roman', Times, serif;
  font-style: initial;
  font-weight: bold;
  font-size:large
}

</style>
<section class="content-header">
<div class="panel">
  <div class="panel-body">

    <div class="panel  panel-default"> 
                    
      <div class="panel-heading">
        <h3 style="font-weight:bold;text-transform: uppercase; text-decoration:underline">
         <i class="fa fa-money"></i> FEE<b style="color:red"> COLLECTION PORTAL</b>
        </h3>
        </div>
       
          <div class="tab-pane active" id="home">
          <div class="panel-body" id="add-class-info">
          <div class="form-group col-sm-1" style="padding-left:-0px;">
              <i class="badge glyphicon glyphicon-filter" style="background:red; font-weight:bold">FILTER-BY:</i>
          </div>
          <br>
          <br>
          <hr class="line">
          <form action="{{  route('StudentFeeListCollectionPayment')}}" method="get">
          
              <div class="form-group col-sm-4">
              <select class="form-control select_2_single" name="semester_id" id="semester_id">
              <option value="">Select Semester</option>
              @foreach($semester as $semester)
              <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
              @endforeach
          </select>
          </div>
      
          <!-- Level Id Field -->
          <div class="form-group col-sm-4">
              <select class="form-control select_2_single " name="degree_id" id="degree_id">
              <option value="">Select Degree</option>
      
              </select>
              </div>
      
                  <!-- Level Id Field -->
          <div class="form-group col-sm-4">
              <select class="form-control select_2_single " name="class_id" id="class_id">
              <option value="">Select Class</option>
                  @foreach($classes as $class)
                  <option value="{{$class->id}}">{{$class->class_name}}</option>
                  @endforeach
              </select>
              </div>
      
              <!-- Level Id Field -->
          <div class="form-group col-sm-4">
              <select class="form-control select_2_single " name="faculty_id" id="faculty_id">
              <option value="">Select Faculty</option>
                  @foreach($faculty as $faculty)
                  <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                  @endforeach
              </select>
              </div>
          <!-- Course Id Field -->
          <div class="form-group col-sm-4">
          <select class="form-control select_2_single" name="department_id" id="department_id">
              <option selected disabled>Select Department</option>
          </select>
          </div>
          <button type="submit" class="btn btn-info pull-right fa fa-search"; style="font-weight:bold;font-size:12px;"><i></i> filter</button>
          </div>                   
          </form>
         </div>
      </div>

  </div>

</div>
</section>
<div class="content">
  <div class="clearfix"></div>
@if($message = Session::get('success'))
<div class="alert-success">
  <p>{{$message}}</p>
</div>
@endif
  <div class="clearfix"></div>

  <div class="box box-primary">
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Roll No.</th>
                <th>Department</th>
                <th>Class</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody id="items">
              @foreach ($data as $student)
              <tr>
                <td>{{$student->username}}</td>
                <td>{{$student->department_name}}</td>
                <td>{{$student->class_name}}</td>
                <td>{{$student->first_name ." ". $student->last_name}}</td>
                <td>{{$student->dob}}</td>
                <td>{{$student->phone}}</td>
                <td>
                  <a href="{!! url('student/fee/list/collection/payment', [$student->student_id]) !!}" class="btn btn-danger" title="Pay Semester Fee"><i class="fa fa-tag"></i>Pay Fee</a>
                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <hr>
      <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            <ul class="pagination" id="myPager"></ul>
        </div>
      </div>
      </div>
    </div>
  </div>
  <div class="text-center">
    {{-- @include('fee.studentListpayment') --}}
  

  </div>
</div>
    
@endsection

@section('scripts')
@include('fee.script.calculate') 
@include('fee.script.payment')
<script>
$(document).ready(function(){



// GET SEMESTER DEGREEE
$('#semester_id').on('change',function(e){
getStudentsByclass()
var semester_id = $(this).val();
var degree = $('#degree_id')
$(degree).empty();
$.get("{{ route('dynamicDegrees') }}",{semester_id:semester_id},function(data){  

console.log(data);
$.each(data,function(i,l){
$(degree).append($('<option/>',{
value : l.id,
text  : l.level
}))
}) 
})
});

// GET SEMESTER DEGREEE
$('#faculty_id').on('change',function(e){
getStudentsByclass()
var faculty_id = $(this).val();
var department_id = $('#department_id')
$(department_id).empty();
$.get("{{ route('dynamicDepartments') }}",{faculty_id:faculty_id},function(data){  
    
console.log(data);
$.each(data,function(i,l){
$(department_id).append($('<option/>',{
value : l.department_id,
text  : l.department_name
}))
}) 
})
});

// GET SEMESTER DEGREEE
// $('#faculty_id').on('change',function(e){
function getStudentsByclass(){
var faculty_id = $('#faculty_id').val();
var department_id = $('#department_id').val()
var class_id = $('#class_id').val()
var semester_id = $('#semester_id').val()
var degree_id = $('#degree_id').val()
var student_id = $('#student_id')
$(student_id).empty();
$.get("{{ route('dynamicStudentsByClass') }}",
{faculty_id:faculty_id,'department_id':faculty_id,'class_id':class_id,
'semester_id':semester_id,'degree_id':degree_id},function(data){  

console.log(data);
$.each(data,function(i,l){
$(student_id).append($('<option/>',{
value : l.id,
text  : l.first_name + " " + l.last_name
// text  : 
}))
}) 
})
}

// });
});
</script>
@endsection 


