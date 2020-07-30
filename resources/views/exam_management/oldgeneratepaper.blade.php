
  <!------------------------------ Modal start from here okay-------------------------------- -->
  <div class="modal fade" id="generatepaper-show" tabindex="-1" role="dialog" 
        aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" 
            aria-hidden="true">&times;</button>
            <h4 class="modal-title">Generate Paper</h4>
            </div>
             <div class="panel-body">
             <div class="form-group">


        <form role="form" action="{{url('/paper/generate')}}" method="post" target="_blank" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="col-md-12">

              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="class">Class <b>*</b></label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                    @if(isset($classes2))
                    {{ Form::select('class',$classes2,$formdata->class,['class'=>'form-control select_2_single','id'=>'class'])}}
                    @else
                    <select id="class" id="class" name="class" required="true" class="form-control" required >
                      @foreach($classes as $class)
                      <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                      @endforeach
                    </select>
                    @endif                                 </div>
                  </div>
                </div>

               <div class="col-md-4">
                  <div class="form-group ">
                    <label for="session">session <b>*</b></label>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                      <input type="text" id="session" value="{{date('Y')}}" required="true" class="form-control datepicker2" name="session" value=""   data-date-format="yyyy">
                    </div>
                  </div>
                </div>
              <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="subject">subject <b>*</b></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-book blue"></i></span>
                      @if(isset($subjects))
                      {{ Form::select('subject',$subjects,$formdata->subject,['class'=>'form-control','id'=>'subject','required'=>'true'])}}
                      @else
                      <select id="subject" id="subject" name="subject" required="true" class="form-control" required >
                        <option value="">--Select Subjects--</option>

                      </select>
                      @endif
                    </div>
                  </div>
                </div>
             
            </div>
            </div>
            <div class="row">
              <div class="col-md-12">
               
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="exam">Chaper <b>*</b></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                      
                      <select   name="chapter[]" id="chapter" class="form-control selectpicker" multiple data-actions-box="true" data-hide-disabled="true"   required="true">
                      </select>


                    </div>
                  </div>
                </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Levels <b>*</b></label>
                        <select name="level[]" class="form-control selectpicker" multiple data-actions-box="true" data-hide-disabled="true" data-size="5" required>
                          <option value="">---Select a Level---</option>
                          <option value="simple">Simple</option>
                          <option value="normal">Normal</option>
                          <option value="hard">Hard</option>
                        </select>
                    </div>
                  </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="exam">Number of Mcqs <b>*</b></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                      
                      <input type="number" name="mcqs" class="form-control" required >

                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="exam">Number of Short Questions <b>*</b></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                      
                      <input type="number" name="short" style="width: 390px;height: 36px;" required>

                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="exam">Number of long Questions <b>*</b></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                      
                      <input type="number" name="long" class="form-control" required>

                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="exam">Number of Prints <b>*</b></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                      
                      <input type="number" name="print" class="form-control" required>

                    </div>
                  </div>
                </div>

              </div>
            </div>
            </div>

        <div class="modal-footer ">
        <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
        <button type="submit" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-th"></i> Generate Questions Paper </button>
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





    @section('scripts')
    <script src="/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
     $( document ).ready(function() {
      
 
      $(".datepicker2").datepicker( {
        format: " yyyy", // Notice the Extra space at the beginning
        viewMode: "years",
        minViewMode: "years",
        autoclose:true

      });
      $('#markList').dataTable();
      $('#class').on('change', function (e) {
        getSubjects();
        getchapter();
       // getexam();
        getsections();
        
      });
      $('#section').on('change', function (e) {
          //getSubjects();
          //getsections();
          //getexam();
      });
      $('#subject').on('change', function (e) {
          //getSubjects();
          //getsections();
          //alert(43);
          //getexam();
          getchapter();
      });
          getSubjects();
          // getexam();
          getsections();
         

        $('#session').on('change',function() {
        //  getexam();
          getsections();
          
        });
         //getexam();
    });
    var getSubjects = function () {

      var val = $('#class').val();

       // alert(val);
      $.ajax({
        url:"{{url('/class/getsubjects')}}"+'/'+val,
        type:'get',
        dataType: 'json',
        success: function( json ) {


          $('#subject').empty();
          $('#subject').append($('<option>').text("--Select Subject--").attr('value',""));
          $.each(json, function(i, subject) {
             console.log(subject);

            $('#subject').append($('<option>').text(subject.name).attr('value', subject.id));
          });
        }
      });
    };

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
        //alert("Please fill all inputs correctly!");
      },
      dataType: 'json',
      success: function(data) {
        $('#section').empty();
      // $('#section').append($('<option>').text("--Select Section--").attr('value',""));
        $.each(data, function(i, section) {
          //console.log(student);
         
          
            //var opt="<option value='"+section.id+"'>"+section.name + " </option>"
            var opt="<option value='"+section.id+"'>"+section.name +' (  ' + section.students +' ) '+ "</option>"

        
          //console.log(opt);
          $('#section').append(opt);

        });
        //console.log(data);

      },
      type: 'GET'
    });
};
function getchapter()
{
     var aclass = $('#class').val();
     var subject = $('#subject').val();

     //alert(section);
    $.ajax({
      url: "{{url('/chapter/getList')}}"+'/'+aclass+'?subject='+subject,
      data: {
        format: 'json'
      },
      error: function(error) {
        alert("Please fill all inputs correctly!");
      },
      dataType: 'json',
      success: function(data) {
       $('#chapter').empty();
       $('#chapter').append($('<option>').text("--Select Exam--").attr('value',""));
       var options = [];
       $.each(data, function(i, exam) {
          //console.log(student);
         
          
            var opt="<option value='"+exam.chapter+"'>"+exam.chapter + " </option>"

        
          //console.log(opt);
          //$('#chapter').append(opt);
           options.push(opt);

        });
        //console.log(data);
       $("#chapter").html(options).selectpicker('refresh');
      },
      type: 'GET'
    });
};
   
    </script>
    @stop
