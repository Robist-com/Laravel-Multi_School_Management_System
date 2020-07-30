
<!------------------------------ Modal start from here okay-------------------------------- -->
<div class="modal fade" id="add-timetable" tabindex="-1" role="dialog" 
 aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" 
            aria-hidden="true">&times;</button>
            <h4 class="modal-title">Class Scheduled</h4>
            </div>
             <div class="panel-body" style="border-bottom: 1px solid #ccc; ">
             <div class="form-group">

             @if($timetable)
     <form role="form" action="{{url('/timetable/update')}}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="tid" value="{{ $timetable->id }}">
        
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-info"> Time Table</h3>
              <hr>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname">Teacher <b>*</b></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                    <select name="teacher" class="form-control" required>
                     <option value="">---Select Teacher---</option>
                    @foreach($teachers as $teacher)
                      <option value="{{$teacher->teacher_id}}" @if($timetable->teacher_id == $teacher->teacher_id) selected @endif>{{$teacher->first_name}} {{$teacher->last_name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="gender">Class <b>*</b></label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                    <select name="class" id="class" class="form-control" required >

                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="section">Section <b>*</b></label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                    <select name="section" id="section1" class="form-control" required >
                     
                     
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="bloodgroup">Subject <b>*</b></label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                    <select name="subject" id="subject1" class="form-control " required >
                     
                    </select>

                  </select>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <label for="nationality">Start Time <b>*</b></label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <input type="text" id="timepicker1" class="form-control" value="{{$timetable->stattime}}" required  name="startt">
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group ">
                <label for="dob">End Time <b>*</b></label>
                <div class="input-group">

                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i> </span>
                  <input type="text" id="timepicker2"  class="form-control datepicker" name="endt" value="{{$timetable->endtime}}" required  data-date-format="">
                </div>


              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group ">
                <label for="photo">Day <b>*</b></label>
                <select name="day[]" class="form-control selectpicker" multiple data-hide-disabled="true" data-size="5">
                <option value="">---Select Day---</option>
                <option value="monday" @if($timetable->day=="monday") selected @endif>Monday</option>
                <option value="tuesday" @if($timetable->day=="tuesday") selected @endif>Tuesday</option>
                <option value="wednesday" @if($timetable->day=="wednesday") selected @endif>Wednesday</option>
                <option value="thursday" @if($timetable->day=="thursday") selected @endif>Thursday</option>
                <option value="friday" @if($timetable->day=="friday") selected @endif>Friday</option>
                <option value="saturday" @if($timetable->day=="saturday") selected @endif>Saturday</option>
                <option value="sunday" @if($timetable->day=="sunday") selected @endif>Sunday</option>
                </select>
              </div>
            </div>

          </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
          <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Update</button>
          <br>
        </div>
      </form>
      @else
          <form role="form" action="{{url('timetables')}}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-info"> Time Table</h3>
              <hr>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="form-group">
                    <select name="teacher" class="form-control select_2_single" required>
                   <option value="">---Select Teacher---</option>
                   
                    @foreach($teachers as $teacher)
                      <option value="{{$teacher->teacher_id}}" @if(old('teacher')==$teacher->teacher_id) selected @endif>{{$teacher->first_name}} {{$teacher->last_name}}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-4">
                <div class="form-group">
                    <select name="class" id="class" class="form-control select_2_single" >
                      @foreach($classes as $class)
                      <option value="{{$class->class_code}}" @if(old('class')==$class->class_code) selected @endif>{{$class->class_name }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <select name="course" id="course_id" class="form-control select_2_single " >
                    @foreach($coursese as $course)
                      <option value="{{$course->id}}" >{{$course->course_name }}</option>
                      @endforeach
                    </select>
              </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <select name="level" id="level_id" class="form-control select_2_single " >

                    </select>
              </div>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <input type="text" id="start_time" class="form-control" value="{{old('startt')}}"  name="start_time" placeholder=" Start Time">
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group ">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i> </span>
                  <input type="text" id="end_time"  class="form-control datepicker" name="end_time" value="{{old('endt')}}"  placeholder=" End Time">
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group ">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i> </span>
                  <select name="day[]" id="select" class="form-control select_2_multiple" multiple data-hide-disabled="true" data-size="5" >
                <option value="">---Select Day---</option>
                <option value="monday"    @if(old('day')=="monday")    selected @endif>Monday</option>
                <option value="tuesday"   @if(old('day')=="tuesday")   selected @endif>Tuesday</option>
                <option value="wednesday" @if(old('day')=="wednesday") selected @endif>Wednesday</option>
                <option value="thursday"  @if(old('day')=="thursday")  selected @endif>Thursday</option>
                <option value="friday"    @if(old('day')=="friday")    selected @endif>Friday</option>
                <option value="saturday"  @if(old('day')=="saturday")  selected @endif>Saturday</option>
                <option value="sunday"    @if(old('day')=="sunday")    selected @endif>Sunday</option>
                </select>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
        <!-- <div class="clearfix"></div> -->
    <div class="modal-footer ">
        <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
    <button type="submit" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"> Generate  TimeTable </i></button>
</div>
</form>
@endif
</div>
</div>
</div>
</div>

@section('scripts')
<script>
   $( document ).ready(function() {

 $('#end_time').datetimepicker({format: 'LT'});
  $('#start_time').datetimepicker( {format: 'LT'});
  $('.selectpicker').selectpicker();

 getCoursese();
//  getlevels(); 

  });

  $('#class').on('change',function(e){
    getCoursese();   
    getlevels(); 
  });

  $('#course_id').on('change',function(e){
    // getCoursese();   
    getlevels(); 
  });


function getCoursese()
{
  var class_id = $('#class').val();
  var course_id = $('#course_id')
             $(course_id).empty();
            //  $('#course_id').append($('<option>').text("--Select Course--").attr('value',""));
             $.get("{{ route('dynamicCourse') }}",{class_id:class_id},function(data){  
                    
                    // console.log(data);
                    $.each(data,function(i,course){
                    $(course_id).append($('<option/>',{
                        value : course.id,
                        text  : course.course_name
               }))
             }) 
         })
};

function getlevels()
{
                var course_id = $('#course_id').val();
                var level = $('#level_id')
                    $(level).empty();
             $.get("{{ route('dynamicLevels') }}",{course_id:course_id},function(data){  
                    
                    // console.log(data);
                    $.each(data,function(i,l){
                    $(level).append($('<option/>',{
                        value : l.level_id,
                        text  : l.level
               }))
             }) 
         })
};

// $('#course_id').on('change',function(e){
//                 var course_id = $(this).val();
//                 var level = $('#level_id')
//                     $(level).empty();
//              $.get("{{ route('dynamicLevels') }}",{course_id:course_id},function(data){  
                    
//                     // console.log(data);
//                     $.each(data,function(i,l){
//                     $(level).append($('<option/>',{
//                         value : l.level_id,
//                         text  : l.level
//                }))
//              }) 
//          })
//     });



function getsubjects1()
{
    var aclass = $('#1class').val();
   // alert(aclass);
    $.ajax({
      url: "{{url('/subject/getList')}}"+'/'+aclass,
      data: {
        format: 'json'
      },
      error: function(error) {
        alert("Please fill all inputs correctly!");
      },
      dataType: 'json',
      success: function(data) {
        $('#subject1').empty();
       //$('#section').append($('<option>').text("--Select Section--").attr('value',""));
        $.each(data, function(i, subject) {
          //console.log(student);
         
          
            var opt="<option value='"+subject.id+"'>"+subject.name + " </option>"

        
          //console.log(opt);
          $('#subject1').append(opt);

        });
        //console.log(data);

      },
      type: 'GET'
    });
};
</script>
@stop