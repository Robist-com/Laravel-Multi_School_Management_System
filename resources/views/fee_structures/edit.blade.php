@extends('layouts.app')

<style>
.input-icon{
  position: absolute;
  left: 3px;
  top: calc(60% - 0.5em); 
}
input{
  padding-left: 17px;
}
.input-wrapper{
  position: relative;
}
.line{
    font-weight:bold;
    color: blue;
}
</style>
  

@section('content')
    <section class="content-header">
    <h1 style="font-weight:bold"><i class="fa fa-money"></i> EDIT FEE STRUCTURE</h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($feeStructure, ['route' => ['feeStructures.update', $feeStructure->id], 'method' => 'patch']) !!}

                   <div class="modal-body">
        <div class="panel-body">

            
        <!-- Name Field -->
        <div class="col-md-6">
        <div class="form-group">
        <select name="semester_id" id="grade_id" class="form-control select_2_single">
            <option value="">Select Semester</option>
            @foreach($semesters as $key => $semester)
                <option value="{{$semester->id}}" {{ $semester->id == $feeStructure->semester_id ? 'selected' : '' }}>{{$semester->semester_name}}</option>
            @endforeach
        </select>
        </div>
        </div>

            <!-- Name Field -->
            <div class="col-md-6">
        <div class="form-group">
        <select name="degree_id" id="level_id" class="form-control select_2_single">
            <option value="">Select Degree</option>
        </select>
        </div>
        </div>

         <!-- Name Field -->
         <div class="col-md-6">
          <div class="form-group">
          <select name="faculty_id" id="faculty_id" class="form-control select_2_single">
              <option value="">Select Faculty</option>
              @foreach($faculties as $key => $faculty)
                  <option value="{{$faculty->faculty_id}}"  {{ $faculty->faculty_id == $feeStructure->faculty_id ? 'selected' : '' }}>{{$faculty->faculty_name}}</option>
              @endforeach
          </select>
          </div>
          </div>

           <!-- Name Field -->
           <div class="col-md-6">
            <div class="form-group">
            <select name="department_id" id="department_id" class="form-control select_2_single">
                <option value="">Select Department</option>
            </select>
            </div>
            </div>

        <!-- Name Field -->
        <div class="col-md-6">
        <div class="form-group">
        {!! Form::text('fee_type', null, ['class' => 'form-control', 'placeholder' => 'Enter Fee Type']) !!}
        </div>
        </div>
        
        <!-- Name Field -->
        <div class="col-md-6">
        <div class="form-group">
        <div class="input-wrapper">
        {!! Form::text('semesterFee', null, ['class' => 'form-control', 'style'=>'text-align:right', 'placeholder' => 'Enter Semester Fee',
            'onkeyup'=> 'NumbersOnly(event, this);', 'onfucus'=>"this.value=''"]) !!}
            <i class="fa fa-money fa-lg input-icon"></i>
            </div>
        </div>
        </div>

      </div>
      <div class="modal-footer">
        <a href="{{route('feeStructures.index')}}"><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></a>
        <!-- <button type="submit" class="btn btn-info">Update Student</button> -->
        {!! Form::submit('Generate Fee Structure', ['class' => 'btn btn-success']) !!}
      </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
   </div>
@endsection


@section('scripts')

<script>
// $('#course_id').on('change',function(e){
//                 var course_id = $(this).val();
//                 var level = $('#level_id')
//                     $(level).empty();
//              $.get("{{ route('dynamicLevels') }}",{course_id:course_id},function(data){  
                    
//                     console.log(data);
//                     $.each(data,function(i,l){
//                     $(level).append($('<option/>',{
//                         value : l.level_id,
//                         text  : l.level
//                }))
//              }) 
//          })
//     })


  // GET SEMESTER DEGREEE
  $('#grade_id').on('change',function(e){
    //   getStudentsByclass()
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


// REGULAR EXPRESSION 


function NumbersOnly(e , field) {

    var val = field.value;
    var num = /^([0-9-.]+[\.]?[0-9-.]?[0-9-.]?|[0-9-.]+)$/g;
    var number = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;

    // now we will check if the input value is number or charcater okay
        if (num.test(val)) {

        } else {
            val = number.exec(val);

            if (val) {
            field.value = val[0];
        } else {
            field.value =''    
       }
    //  if the value is character then the input field will be empty okay

    // else the input field will contain numbers okay

    }
}

</script>

  @endsection