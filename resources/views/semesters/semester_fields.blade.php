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
  <div class="modal fade left" id="semester_fields-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-lg  modal-right " role="document">
    <div class="modal-content">
      <div class="modal-header-store">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sun-o" aria-hidden="true"> ADD NEW FEE STRUCTURE</i></h5>
      </div>
      <div class="modal-body">
        <div class="panel-body">
        <form action="{{  route ('semesters.create.subjects')}}" method="post">
        @csrf

        <!-- Name Field -->
        <div class="col-md-6">
        <div class="form-group">
        <select name="semester_id" id="semester" class="form-control select_2_single">
            <option value="">Select Semester</option>
            @foreach($semester as $semest)
                <option value="{{$semest->id}}">{{$semest->semester_name}}</option>
            @endforeach
        </select>
        </div>
        </div>

        <!-- Name Field -->
        <div class="col-md-6">
          <div class="form-group">
          <select name="degree_id" id="degree_id" class="form-control select_2_single" >
              <option value="">Select Level</option>
          </select>
          </div>
          </div>

           <!-- Name Field -->
        <div class="col-md-6">
          <div class="form-group">
          <select name="faculty_id" id="faculty_id" class="form-control select_2_single">
              <option value="">Select Faculty</option>
              @foreach($faculties as $faculty)
                <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
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
            <div class="col-md-12">
        <div class="form-group">
        <select name="course_id[]" id="course_id" class="form-control select_2_single" multiple>
            <option value="">Select Course</option>
            @foreach($courses as $course)
                <option value="{{$course->id}}">{{$course->course_name}}</option>
            @endforeach
        </select>
        </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-info">Update Student</button> -->
        {!! Form::submit('Generate Fee Structure', ['class' => 'btn btn-success']) !!}
      </div>
      </form>
    </div>
    </div>
  </div>

  @section('scripts')

<script>

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