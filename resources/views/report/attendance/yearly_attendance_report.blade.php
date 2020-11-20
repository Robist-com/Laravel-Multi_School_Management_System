                <hr>
                <strong>Select Criteria</strong>
                <hr>
                <form action="{{route('PostYearlyAttendanceReport')}}" method="post">
                    @csrf
                    
                    @if(auth()->user()->group == "Admin")
                        <div class="col-md-12">
                            <label for="">School <b style="color:red">*</b></label>
                        <select name="school_id" id="school_id" class="form-control">
                            <option value="">Select</option>
                            @foreach(auth()->user()->school->all() as $school)
                            <option value="{{$school->id}}" @if(isset($school)){{$school->id == request('school_id') ? 'selected' : '' }} @endif>{{$school->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <br>
                        @else
                        <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                          <br>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label" for="class">Class</label>
                                            <select id="class" id="class_id" name="class_id" class="form-control" >
                                              <option value="">Select</option>
                                                @foreach($classes2 as $class)
                                                    <option value="{{$class->class_code}}" @if($class->class_code === request('class_id')) selected @endif >{{$class->class_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                           
                                <div class="col-md-5">
                                    <div class="form-group ">
                                        <label for="dob">Year <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text" class="form-control datepicker" name="yearly_date" required  data-date-format="yyyy" value="{{$year}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button style="margin-top: 25px;" class="btn btn-dark btn-round pull-right"  type="submit"><i class="glyphicon glyphicon-print"></i> Get List</button>
                                        </div>
                                </div>
                                </div>
                                </div>
                                </form>

                              @if(isset($yearly_attend))
                            <!-- <hr> -->
                         
                          <form action="{{url('/yearly_attendance')}}" method="get">
                            <input type="hidden" class="form-control" name="yearly_date" id="attendance_year" placeholder="Year" value="{{request('yearly_date')}}">
                          <input type="hidden" class="form-control" name="class_id" id="class_id" placeholder="Year" value="{{request('class_id')}}">
            
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-default btn-round btn-sm"><i class="fa fa-pdf-o"></i> PDF Report</button>
                        </div>
                    </form>
                    <b>Class Wise Report</b>
                      <hr>
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                  <thead>
                      <tr class="bordered-tr">
                          <th class="bordered-th">Roll No.</th>
                          <th  class="bordered-th">Student Name</th>
                          <th  class="bordered-th">Attendance</th>
                          @if(request('class_id'))
                          <th  class="bordered-th">Class</th>
                          @endif
                          <th  class="bordered-th">Year</th>
                      </tr>
                  </thead>
                  <tbody>
              @foreach ($yearly_attend as $key => $item)
                <tr class="bordered-tr">
                <td class="bordered-td">{{$item->roll_no}}</td>
                <td  class="bordered-td">{{$item->student_first_name }} {{$item->student_last_name}}</td>
                <td  class="bordered-td">
                  @if($item->attendance_status == 'present')
                  <span class="label label-success">Present</span>
                  @elseif($item->attendance_status == 'absent')
                  <span class="label label-danger">Absent</span>
                  @elseif($item->attendance_status == 'sick')
                  <span class="label label-warning">Sick</span>
                  @elseif($item->attendance_status == 'late')
                  <span class="label label-info">Late</span>
                  @endif
                </td>
                @if(request('class_id'))
                <td  class="bordered-td">{{$item->class_name }} </td>
                @endif
                <td  class="bordered-td">{{$item->year }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        </div>
      </div>
                    

        
    @section('scripts')
    <script src="{{url('')}}/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">

        $( document ).ready(function() {

            $(".datepicker2").datepicker( {
                format: " yyyy", // Notice the Extra space at the beginning
                viewMode: "years",
                minViewMode: "years",
                autoclose:true

            });

            $(".datepicker").datepicker({
                autoclose:true,
                format:"yyyy",
                changeMonth: true,
                changeYear: true,
                viewMode: "year",
                // minViewMode: "months",

            });

            $("#btnPrint" ).click(function() {
                $('input[name="print_view"]').val(1);
                var qstring = $( "form" ).serialize();
                var url = "<?php echo url(''); ?>/class_wise_attendance?"+qstring;
                window.open(url, '_blank');
                window.focus();
            });


            // getsections();
  $('#class').on('change',function() {
    // getsections();
  });
  $('#session').on('change',function() {
    // getsections();
  });


        });
function getsections()
{
    var aclass = $('#class').val();
    var session = $('#session').val();
   // alert(aclass);
    $.ajax({
      url: "{{url('/section/getList')}}"+'/'+aclass+'/'+session,
      data: {
        format: 'json'
      },
      error: function(error) {
        alert("Please fill all inputs correctly!");
      },
      dataType: 'json',
      success: function(data) {
        $('#section').empty();
       $('#section').append($('<option>').text("--Select Section--").attr('value',""));
        $.each(data, function(i, section) {
          //console.log(student);
         
          
        var opt="<option value='"+section.id+"'>"+section.name +' (  ' + section.students +' ) '+ "</option>"

        
          //console.log(opt);
          $('#section').append(opt);

        });
        //console.log(data);

      },
      type: 'GET'
    });
};

    </script>
@stop