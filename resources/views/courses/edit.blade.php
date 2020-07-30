@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Course
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($course, ['route' => ['courses.update', $course->id], 'method' => 'patch']) !!}

                                    <!-- Course Name Field -->
                <div class="form-group col-sm-6">
                <label >Course Name</label>
                    {!! Form::text('course_name', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Course Code Field -->
                <div class="form-group  col-sm-6">
                <label >Course Code</label>
                    {!! Form::text('course_code', null, ['class' => 'form-control']) !!}
                </div>
               
                <div class="col-md-6">
                      <div class="form-group">
                      <label for="">Department</label>
                                <select name="department" class="form-control select_2_single" id="department_id">
                                  <option value="" >Select Department</option>
                                  @foreach ($departments as $department)
                                  <option value="{{ $department->department_id }}" {{$department->department_id == $course->department ? 'selected' : ''}} >{{ $department->department_name }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                <div class="col-md-6">
                            <div class="form-group">
                            <label for="">Class</label>
                                                <select name="class" class="form-control select_2_single" multiple1 data-hide-disabled="true" data-size="5" id="subject_class" >
                                                    <option value="">Select Class</option>
                                                  {{-- @foreach($classes as $class)
                                                    <option value="{{$class->class_code}}"  {{$class->class_code == $course->class ? 'selected' : ''}}  >{{$class->class_name}}</option>
                                                  @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                <!-- Describtion Field -->
                <div class="form-group col-sm-6 col-lg-6">
                <label >Describtion </label>
                    {!! Form::textarea('describtion', null, ['class' => 'form-control', 'rows' => 2, 'cols' => 40]) !!}
                </div>
                      <div class="col-md-6">
                          <div class="form-group">
                          <label for="">Mark of the Subject</label>
                            <select name="gradeSystem"  class="form-control select_2_single" id="grade_system">
                             <option value="">Grade System</option>
                              @if($gpa)
                             @foreach($gpa as $gp)
                              <option  value="{{$gp->for}}" {{$gp->for == $course->gradeSystem ? 'selected' : ''}}> @if($gp->for=="1") 100 Marks @elseif($gp->for=="2") 75 Marks  @elseif($gp->for=="3") 50 Marks  @elseif($gp->for=="4") 30 Marks  @elseif($gp->for=="5") 25 Marks  @elseif($gp->for=="6") 20 Marks @elseif($gp->for=="7") 15 Marks @elseif($gp->for=="8") 10 Marks @endif </option>
                              <!--<option value="2">50 Marks </option>-->
                            @endforeach
                            @endif
                            </select>
                        </div>
                      </div>
                <!-- Status Field -->
                <div class="form-group  col-sm-2">
                <span class="input-group-addon">Status </span>
                    <label class="checkbox-inline">
                        {!! Form::hidden('status', 0) !!}
                        {!! Form::checkbox('status', '1', null) !!} Status
                    </label>
                </div>
                </div>
                    <div class="modal-footer">
                    <a href="{{route('courses.index')}}">{!! Form::button('Back', ['class' => 'btn btn-danger']) !!}</a>
                        {!! Form::submit('Update Course', ['class' => 'btn btn-info']) !!}
                    </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection


@section('scripts')

<script>
  $(document).ready(function(){
    // alert(1)
  })
$('#department_id').on('change',function(e){

var department_id = $(this).val();
var class_id = $('#subject_class')
    $(class_id).empty();
$.get("{{ route('dynamicDepartmentsWithClass') }}",{department_id:department_id},function(data){  
    
console.log(data);
$.each(data,function(i,c){
$(class_id).append($('<option/>',{
value : c.class_code,
text  : c.class_name
}))
}) 
})
});

</script>
    
    @endsection