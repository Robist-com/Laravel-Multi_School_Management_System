@extends('layouts.new-layouts.app')
@section('content')
@include('fee.stylesheet.css-payment')

<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')
    @include('adminlte-templates::common.errors')
            <div class="page-title">
              <div class="title_left">
                <h2>CLASS FEE COLLECTION PORTAL</h2>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" name="roll_no1" id="roll_no1" placeholder="Search by...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" name="filter1" id="filter1" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{url('student/list/fee/collection')}}"><button type="submit" class="btn btn-round btn-warning"><i class="fa fa-refresh" aria-hidden="true"> Refresh </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <form action="{{  route('StudentFeeListCollectionPayment')}}" method="post">
                             @csrf
                        
                            <div class="form-group col-sm-2">
                            <label for="">Grade <b style="color:red">*</b></label>
                            <select class="form-control select_2_single" name="semester_id" id="grade_id">
                            <option value="">Select Grade</option>
                            @foreach($semester as $semester)
                            <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    
                        <!-- Level Id Field -->
                        <div class="form-group col-sm-2">
                        <label for="">Level <b style="color:red">*</b></label>
                            <select class="form-control select_2_single " name="degree_id" id="level_id">
                            <option value="">Select Level</option>
                    
                            </select>
                            </div>
                    
                                <!-- Level Id Field -->
                        <div class="form-group col-sm-2">
                        <label for="">Class <b style="color:red">*</b></label>
                            <select class="form-control select_2_single " name="class_id" id="class_id">
                            <option value="">Select Class</option>
                                @foreach($classes as $class)
                                <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                                @endforeach
                            </select>
                            </div>
                    
                            <!-- Level Id Field -->
                        <div class="form-group col-sm-3">
                          <label for="">Faculty <b style="color:red">*</b></label>
                            <select class="form-control select_2_single " name="faculty_id" id="faculty_id">
                            <option value="">Select Faculty</option>
                                @foreach($faculty as $faculty)
                                <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                                @endforeach
                            </select>
                            </div>
                        <!-- Course Id Field -->
                        <div class="form-group col-sm-3">
                          <label for="">Deperment <b style="color:red">*</b></label>
                        <select class="form-control select_2_single" name="department_id" id="department_id">
                            <option selected disabled>Select Department</option>
                        </select>
                        </div>
                        
                        <div class="form-group col-sm-2 pull-right" style="margin-top:5%">
                        <button type="submit" class="btn btn-dark pull-right btn-round " ><i class="fa fa-search"></i> filter</button>
                        </div>
                        </form>
                       
            @if(isset($data))
            <hr>
            <div class="title_left">
                <h2>STUDENT LIST</h2>
              </div>
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
      @endif
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
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


         