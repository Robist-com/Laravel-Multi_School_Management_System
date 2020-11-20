@extends('layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')
<section class="content-header">


<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money " aria-hidden="true"> CLASS FEE COLLECTION PORTAL</i></h1>

</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
        <div class="pull-right">
            <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-pdf-o text-red" style="color:white"></i> PDF </a>

            <a href="{{url('export-excel-xlsx-users')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-excel-o text-green" style="color:white"></i> Excel </a>

            <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-word-o text-blue" style="color:white"></i> Word </a>

            <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
            <i class="fa fa-print text-light-blue" style="color:white"></i> Print </a>
            </div>
            <div class="clearfix"></div>

                    <div class="panel  panel-default"> 
                    
                    <div class="panel-heading">
                      <h3 style="font-weight:bold;text-transform: uppercase;">
                       <i class="fa fa-money"></i> CLASS FEE<b style="color:red"> COLLECTION  </b>PORTAL
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
                        <form action="{{  route('StudentFeeListCollectionPayment')}}" method="post">
                             @csrf
                        
                            <div class="form-group col-sm-4">
                            <select class="form-control select_2_single" name="semester_id" id="grade_id">
                            <option value="">Select Grade</option>
                            @foreach($semester as $semester)
                            <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    
                        <!-- Level Id Field -->
                        <div class="form-group col-sm-4">
                            <select class="form-control select_2_single " name="degree_id" id="level_id">
                            <option value="">Select Level</option>
                    
                            </select>
                            </div>
                    
                                <!-- Level Id Field -->
                        <div class="form-group col-sm-4">
                            <select class="form-control select_2_single " name="class_id" id="class_id">
                            <option value="">Select Class</option>
                                @foreach($classes as $class)
                                <option value="{{$class->class_code}}">{{$class->class_name}}</option>
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
            <div class="text-center">
            
            </div>
        </div>

            @endsection

            @section('scripts')
                @include('fee.script.calculate') 
                @include('fee.script.payment')
<script>
$(document).ready(function(){
    
    

    // GET SEMESTER DEGREEE
    $('#grade_id').on('change',function(e){
     // getStudentsByclass()
        var grade_id = $(this).val();
        var level = $('#level_id')
            $(level).empty();
        $.get("{{ route('dynamicDegrees') }}",{grade_id:grade_id},function(data){  
    
            console.log(data);
            $.each(data,function(i,l){ 
            $(level).append($('<option/>',{
                value : l.id,
                text  : l.level
            }))
        }) 
    })
});

// GET SEMESTER DEGREEE
        $('#faculty_id').on('change',function(e){
         // getStudentsByclass()
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

$('#department_id').on('change',function(e){
    //var department_id = $(this).val();
    getStudentsByclass()
    alert(1)
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
        {'faculty_id':faculty_id,'department_id':department_id,'class_id':class_id,
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


         