{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}



    
{{-- @endsection --}}

<!------------------------------ Modal start from here okay-------------------------------- -->
<div class="modal fade-center" id="generateresult-show" tabindex="-1" role="dialog" 
        aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" 
            aria-hidden="true">&times;</button>
            <h4 class="modal-title">Publish Results</h4>
            </div>
             <div class="modal-body">
             <div class="panel-body">
             <div class="form-group">
                <form role="form" action="{{url('/result/generate')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-12">
                
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label" for="class">Class</label>
                                    <select name="class" id="class" class="form-control select_2_single" require="true">
                                    <option value="0" selected="true">Select Class</option>
                                        @foreach(App\Models\Classes::all(); as $class)
                                        <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                        <!-- {{ Form::select('class',$classes,'',['class'=>'form-control select_2_single','id'=>'class','required'=>'true'])}} -->
                                    </div>
                                </div>
                
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="section">Department</label>
                                       <select class="form-control select_2_single" id="department" required name="section">
                                       </select>
                
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="section">Batch</label>
                                    <select id="session"  class="form-control select_2_single" name="session"  >
                                        @foreach(App\Models\Batch::all(); as $batch)
                                        <option value="{{$batch->id}}">{{$batch->batch}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             {{-- <input type="hidden" id="session"  class="form-control " name="session" value=""   data-date-format="yyyy"> --}}
           
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="exam">Examination</label>
                                        <?php  $data=[
                                                ''=>'--Select Exam--',
                                                
                                        ];?>

                                <select name="exam" id="exam" class="form-control select_2_single" require="true">
                                    <option value="0" selected="true">Select Exam</option>
                                        @foreach(App\Exam::all(); as $exam)
                                        <option value="{{$exam->id}}">{{$exam->exam_code}}</option>
                                        @endforeach
                                    </select>
                                        <!-- {{ Form::select('exam',$data,'',['class'=>'form-control select_2_single','id'=>'exam','required'=>'true'])}} -->
                
                
                                    </div>
                            </div>
                
                
                        </div>
                    </div>
                
                    <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-th"></i> Generate Result </button>
                    </div>
                </div>
                </form>
 
            </div>
         </div>
       </div>
   </div>
</div>
</div>
   </div>

   {{-- @stop --}}
   @section('scripts')
   <script src="{{url('/js/bootstrap-datepicker.js')}}"></script>
   <script type="text/javascript">
        $( document ).ready(function() {
            // alert(1);
            getdepartment();
                getexam();
            // getsections();
            $(".datepicker2").datepicker( {
                format: " yyyy", // Notice the Extra space at the beginning
                viewMode: "years",
                minViewMode: "years",
                autoclose:true

            });
            // $('#markList').dataTable();
            
             $('#class').on('change', function (e) {
       
                //getexam();
                getdepartment();
                getexam();
                alert(1);
                // subject();
               });
             $('#section').on('change', function (e) {
       
                    getexam();
                    //getsections();
               });
               
        getexam();
        });

function getdepartment()
{
    var aclass = $('#class').val();
    //  var session = $('#session').val();
     if(session==''){
       session =2020;
     }
   // alert(aclass);
    $.ajax({
      url: "{{url('/department/getList')}}"+'/'+aclass+'/'+session,
      data: {
        format: 'json'
      },
      error: function(error) {

      },
      dataType: 'json',
      success: function(data) {
        $('#department').empty();
      // $('#section').append($('<option>').text("--Select Section--").attr('value',""));
        $.each(data, function(i, department) {
          //console.log(student);
         
            //var opt="<option value='"+section.id+"'>"+section.name + " </option>"
          var opt="<option value='"+department.department_id+"'>"+department.department_name +' (  ' + department.students +' ) '+ "</option>"

          //console.log(opt);
          $('#department').append(opt);

        });
        //console.log(data);

      },
      type: 'GET'
    });
};

 function getexam()
{
    var aclass = $('#class').val();
   // alert(aclass);
    $.ajax({
      url: "{{url('/exam/getList')}}"+'/'+aclass,
      data: {
        format: 'json'
      },
      error: function(error) {
        alert("Please fill all inputs correctly!");
      },
      dataType: 'json',
      success: function(data) {
        $('#exam').empty();
       $('#exam').append($('<option>').text("--Select--").attr('value',""));
        $.each(data, function(i, exam) {
          //console.log(student);
         
          
            var opt="<option value='"+exam.id+"'>"+exam.type + " </option>"

        
          //console.log(opt);
          $('#exam').append(opt);

        });
        //console.log(data);

      },
      type: 'GET'
    });
};
    </script>
@stop
