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
  
  <!-- //--------------------MODAL START HERE------------->
  <!-- <div class="modal fade left" id="feestructure-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-lg  modal-right " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sun-o" aria-hidden="true"> ADD NEW FEE STRUCTURE</i></h5>
      </div> -->
      <!-- <div class="modal-body">
        <div class="panel-body"> -->

           @if(auth()->user()->group == "Admin") 
        <!-- Name Field -->
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        <select name="school_id" id="school_id" class="form-control select_2_single">
            <option value="">Select School</option>
            @foreach($schools as $key => $school)
                <option value="{{$school->id}}" @if(isset($feeStructure)) {{ $school->id == $feeStructure->school_id ? 'selected' : '' }} @endif>{{$school->name}}</option>
            @endforeach
        </select>
        </div>
        </div>
        @else
        <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
        @endif
          <!-- Name Field -->
          <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        <select name="semester_id" id="semester_id" class="form-control select_2_single">
            <option value="">Select Grade</option>
            @foreach($semesters as $key => $semester)
                <option value="{{$semester->id}}" @if(isset($feeStructure)) {{ $semester->id == $feeStructure->semester_id ? 'selected' : '' }} @endif>{{$semester->semester_name}}</option>
            @endforeach
        </select>
        </div>
        </div>

            <!-- Name Field -->
            <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        <select name="degree_id" id="degree_id" class="form-control select_2_single">
        @if(isset($feeStructure))
        @if(isset($levels))
        @foreach($levels as $key => $levels)
            <option value="{{$levels->id}}" @if(isset($feeStructure)) {{ $feeStructure->semester_id == $levels->grade_id ? 'selected' : '' }} @endif>{{$levels->level}}</option>
        @endforeach
        @endif
        @endif
        </select>
        </div>
        </div>

         <!-- Name Field -->
         <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="form-group">
          <select name="faculty_id" id="faculty_id" class="form-control select_2_single">
              <option value="">Select Faculty</option>
              @foreach($faculties as $key => $faculty)
                  <option value="{{$faculty->faculty_id}}" @if(isset($feeStructure)) {{ $faculty->faculty_id == $feeStructure->faculty_id ? 'selected' : '' }} @endif>{{$faculty->faculty_name}}</option>
              @endforeach
          </select>
          </div>
          </div>

           <!-- Name Field -->
           <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
            <select name="department_id" id="department_id" class="form-control select_2_single">
            @if(isset($feeStructure))
            @if(isset($departments))
            @foreach($departments as $key => $departments)
                <option value="{{$departments->department_id}}"{{ $feeStructure->faculty_id == $departments->faculty_id ? 'selected' : '' }}>{{$departments->department_name}}</option>
            @endforeach
            @endif
            @endif
            </select>
            </div>
            </div>

        <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="form-group">
        {!! Form::text('fee_type', null, ['class' => 'form-control', 'placeholder' => 'Enter Fee Type']) !!}
        </div>
        </div>
        
        <!-- Name Field -->
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        <div class="input-wrapper">
        {!! Form::number('semesterFee', null, ['class' => 'form-control', 'style'=>'text-align:right', 'placeholder' => 'Enter Semester Fee',
            'onkeyup'=> 'NumbersOnly(event, this);', 'onfucus'=>"this.value=''"]) !!}
            <i class="fa fa-money fa-lg input-icon"></i>
            </div>
        </div>
        <!-- </div>

      </div> -->
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
        <!-- <button type="submit" class="btn btn-info">Update Student</button> -->
        {!! Form::submit('Generate Fee Structure', ['class' => 'btn btn-success btn-round']) !!}
      </div>
    <!-- </div> -->
    <!-- </div>
  </div> -->

  @section('scripts')

<script>

$('#semester_id').on('change',function(e){

var grade_id = $(this).val();
var degree = $('#degree_id')
    $(degree).empty();
$.get("{{ route('dynamicDegrees') }}",{grade_id:grade_id},function(data){  
    
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