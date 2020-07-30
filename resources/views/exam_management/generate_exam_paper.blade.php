
       <!------------------------------ Modal start from here okay-------------------------------- -->
 <div class="modal fade-center" id="generatePaper-show" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal"
            aria-hidden="true">&times;</button>
            <h4 class="modal-title">Generate Exam Question Papers</h4>
            </div>
             <div class="modal-body">
             <div class="panel-body">
             <div class="form-group">

            <form role="form" action="{{url('/paper/generate')}}" method="post" target="_blank" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">

               <div class="form-group col-md-2">
                      <input type="text" id="session" value="{{date('Y')}}"  class="form-control" name="session" value=""  placeholder="Enter session Date  ">
                </div>

                <div class="form-group col-md-3">
                    @if(isset($classes2))
                    {{ Form::select('class',$classes2,$formdata->class,['class'=>'form-control','id'=>'class','required'=>'true'])}}
                    @else
                    <select id="class" id="class" name="class"  class="form-control select_2_single" required >
                    <option value="">---Select a Class---</option>
                      @foreach($classes as $class)
                      <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                      @endforeach
                    </select>
                    @endif
                    </div>

                    <div class="form-group col-md-3">
                      @if(isset($subjects))
                      {{ Form::select('course_id',$subjects,$formdata->subject,['class'=>'form-control select_2_single','id'=>'subject','required'=>'true'])}}
                      @else
                      <select id="course_id" name="course_id" required="true" class="form-control select_2_single" required >
                        <option value="">--Select Subjects--</option>

                      </select>
                      @endif
                    </div>

                    <div class="form-group col-md-4">
                      <input type="number" name="print" class="form-control" required placeholder="Enter Number of Copies to print">
                    </div>

                  <div class="form-group col-md-4">
                      <input type="number" name="mcqs" class="form-control" placeholder="Enter Number  of multiple choice question " >
                    </div>

                  <div class="form-group col-md-4">
                      <input type="number" name="short" class="form-control" placeholder="Enter Amount of Basic Questions ">

                    </div>

                  <div class="form-group col-md-4">
                      <input type="number" name="long" class="form-control"  placeholder="Number of Theory Questions ">
                </div>

                <div class="form-group col-md-4">
                    <select   name="chapter[]" id="chapter" class="form-control select_2_multiple" multiple data-actions-box="true" data-hide-disabled="true"   >

                    </select>
                  </div>

                <div class="form-group col-md-4">
                        <select  name="level[]" class="form-control select_2_multiple-level" multiple data-actions-box="true" data-hide-disabled="true" data-size="5">
                          <option value="simple">Quiz</option>
                          <option value="normal">pre Test</option>
                          <option value="hard">Class Work</option>
                        </select>
                        <!-- <br>
                        <br>
                        <label class="container2">Select All
                        <input type="checkbox" id="checkbox">
                        <span class="checkmark"></span>
                        </label> -->
                    </div>
                    </div>

        <div class="modal-footer ">
        <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
         <button type="submit" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-th"></i> Generate Questions Paper</button>
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
<!-- </div> -->

    @section('scripts')
    <script type="text/javascript">
     $( document ).ready(function() {

        $('#session').datetimepicker({
            viewMode: 'years',
            format: 'Y',
            // autoClose: true
        });

        $('#session_question').datetimepicker({
            viewMode: 'years',
            format: 'Y',
            // autoClose: true,
    //   });
        });

        $(document).ready(function() {
    $('.select_2_multiple-level').select2({
		placeholder: 'Select Paper Type',
		width: '100%',
		border: '1px solid #e4e5e7',
    });

    $('.select_2_multiple').select2({
		placeholder: 'Select Exam Term',
		width: '100%',
		border: '1px solid #e4e5e7',
    });
});

// $('.select_2_multiple').on("select2:select", function (e) {
//            var data = e.params.data.text;
//            if(data=='All'){
//             $(".select_2_multiple > option").prop("selected","selected");
//             $(".select_2_multiple").trigger("change");
//            }else{
//             $(".select_2_multiple > option").removeAttr("selected");
//            }
//     });

    $("#checkbox").click(function(){
        if($("#checkbox").is(':checked')){
            $(".select_2_multiple > option").prop("selected", "selected");
            $(".select_2_multiple").trigger("change");
        } else {
            $(".select_2_multiple > option").removeAttr("selected");
            $(".select_2_multiple").trigger("change");
        }
    });

    //   $('#markList').dataTable();
      $('#class').on('change', function (e) {
        getCourse();
        getchapter();
       // getexam();
        // getsections();
        // alert(1)

      });
    //   $('#section').on('change', function (e) {
    //       //getSubjects();
    //       //getsections();
    //       //getexam();
    //   });
      $('#course_id').on('change', function (e) {
          //getSubjects();
          //getsections();
          //alert(43);
          //getexam();
          getchapter();
      });
         getCourse();
          // getexam();
        //   getsections();


        $('#session').on('change',function() {
        //  getexam();
        //   getsections();

        });
         //getexam();
        //  alert(1)
    });


    var getCourse = function () {

      var val = $('#class').val();

      $.ajax({
        url:"{{url('/class/getcourses')}}"+'/'+val,
        type:'get',
        dataType: 'json',
        success: function( json ) {


          $('#course_id').empty();
          $('#course_id').append($('<option>').text("--Select Course--").attr('value',""));
          $.each(json, function(i, subject) {
             console.log(subject);

            $('#course_id').append($('<option>').text(subject.course_name).attr('value', subject.id));
            // $("#course_id").html(option).select_2_single('refresh');
          });

        }
      });
    };

function getchapter()
{
     var aclass = $('#class').val();
     var course = $('#course_id').val();

     //alert(section);
    $.ajax({
      url: "{{url('/chapter/getList')}}"+'/'+aclass+'?course_id='+course,
      data: {
        format: 'json'
      },
      error: function(error) {
        // alert("Please fill all inputs correctly!");
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




$(document).ready(function() {
                    $("#qt-0").change(function () {
                        $("#i-0").css('display', 'none');
                        $("#mc-0").css('display', 'none');
                        $("#tf-0").css('display', 'none');
                            // alert(1)
                        if($(this).val() == 1){
                            $("#i-0").css('display', 'inline');
                        }
                        else if ($(this).val() == 2){
                             $("#mc-0").css('display', 'inline');
                        }
                        else if($(this).val() == 3){
                            $("#tf-0").css('display', 'inline');
                        }
                    });
                    // alert(1)

   });


$(document).ready(function(){
// alert(1)
$('#class_id').on('change',function(e){
// $("#class_id").trigger('change');
    //  alert(1)
//  function subject()
//  {
   var val = $('#class_id').val();
            $.ajax({
                url:"{{url('/class/getcourses')}}"+'/'+val,
                type:'get',
                dataType: 'json',
                success: function( json ) {
                    $('#course_id_question').empty();
                    // $('#course_id_question').append($('<option>').text("--Select Course--").attr('value',""));
                    $.each(json, function(i, course) {
                        // console.log(subject);

                        $('#course_id_question').append($('<option>').text(course.course_name).attr('value', course.id));
                        // getsections();
                    });
                }
            });
//  }
});
});


    var newId = 1;
    var template = jQuery.validator.format(`
        <div class="row">
                <div class="col-md-9">
                    <label for="">Question <b>*</b></label>
                    <textarea class="form-control"name="question[{0}]" id="" cols="30" rows="5" placeholder="Input question here..." required></textarea>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Question Type <b>*</b></label>

                        <select name="qt[{0}]" id="qt-{0}" class="form-control qt" required>
                            <option value="">---Select a question type---</option>
                            <option value="1">Theory Question</option>
                            <option value="2">Multiple Choice</option>
                            <option value="3">Basic Question</option>
                            <option value="3">Yes / No Question</option>
                        </select>
                    </div>
                    <div class="form-group form-inline">
                        <label for="" class="pr-2">Points:</label><input type="number" class="form-control" min="1" name="points[]" value="1" style="max-width: 100px">

                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-danger btn-block btn-sm ml-1" onclick="removeQuestion()">Remove Question</button>
                    </div>
                </div>

                <div class="col-md-6" id="i-{0}" style="padding-top: 10px; display: none">
                    <label for="">Correct answer</label>
                    <input name="i[{0}]" type="text" class="form-control">
                </div>
                <div class="multiple-choice" id="mc-{0}" style="display: none">
                    <div class="col-md-12" style="padding-top: 10px;">
                        <div class="row">
                            <div class="col-sm-3"><label>Choice 1</label><input name="mc[{0}][0]" type="text" class="form-control"></div>
                            <div class="col-sm-3"><label>Choice 2</label><input name="mc[{0}][1]" type="text" class="form-control"></div>
                            <div class="col-sm-3"><label>Choice 3</label><input name="mc[{0}][2]" type="text" class="form-control"></div>
                            <div class="col-sm-3"><label>Choice 4</label><input name="mc[{0}][3]" type="text" class="form-control"></div>
                        </div>
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-md-8">
                                <label for="">Correct choice</label>
                                <select name="c-mc[{0}]" id="c-mc[{0}]" class="form-control">
                                    <option value="1">Choice 1</option>
                                    <option value="2">Choice 2</option>
                                    <option value="3">Choice 3</option>
                                    <option value="4">Choice 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" id="tf-{0}" style="padding-top: 10px;  display: none">
                    <label for="">Correct answer</label>
                    <input type="text" id="" class="form-control" name="tf[{0}]">
                    {{--<select name="tf[{0}]" id="" class="form-control">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>--}}
                </div>
                <script>
                    $("#qt-{0}").change(function () {
                        $("#i-{0}").css('display', 'none');
                        $("#mc-{0}").css('display', 'none');
                        $("#tf-{0}").css('display', 'none');

                        if($(this).val() == 1){
                            $("#i-{0}").css('display', 'inline');
                        }
                        else if ($(this).val() == 2){
                             $("#mc-{0}").css('display', 'inline');
                        }
                        else if($(this).val() == 3){
                            $("#tf-{0}").css('display', 'inline');
                        }
                    });
                <\/script>
        </div>
        <hr>
    `);

 function addQuestion(){
        $('#question').append(template(newId));
        newId++;
    }


$( document ).ready(function() {


  
  $('.datepicker2').datetimepicker({
            viewMode: 'years',
            format: 'Y',
            // autoClose: true,
    //   });
        });

 $('.datepicker3').datetimepicker({
            // viewMode: 'dates',
            format: 'Y-M-D',
            // autoClose: true,
    //   });
        });

  // getdepartments();
//  $('#class_Create_Question').on('change',function() {
//   getdepartments();


//   });


//   $('#class_Create_Question1').on('change',function(e){

// var class_id = $(this).val();
// var department_id = $('#department_id1')
//     $(department_id).empty();
// $.get("{{ route('dynamicDepartmentsWithClass') }}",{department_id:department_id},function(data){  
    
// console.log(data);
// $.each(data,function(i,d){
// $(department_id).append($('<option/>',{
// value : d.department_id,
// text  : d.department_name
// }))
// }) 
// })
// });

$('#department1').on('change',function(e){

var department_id = $(this).val();
var class_id = $('#class_Create_Question')
    $(class_id).empty();
$.get("{{ route('dynamicDepartmentsWithClass') }}",{department_id:department_id},function(data){  
    
console.log(data);
$.each(data,function(i,c){
$(class_id).append($('<option/>',{
value : c.id,
text  : c.class_name
}))
}) 
})
});


});

// function getdepartments()
// {
//     var aclass = $('#class_Create_Question').val();

//     $.ajax({
//       url: "{{url('/department/getList')}}"+'/'+aclass,
//       data: {
//         format: 'json'
//       },
//       error: function(error) {
//         //alert("Please fill all inputs correctly!");
//       },
//       dataType: 'json',
//       success: function(data) {
//         $('#department1').empty();
//       $('#department1').append($('<option>').text("--Select Department--").attr('value',""));
//         $.each(data, function(i, department) {
//           //console.log(student);

//             //var opt="<option value='"+section.id+"'>"+section.name + " </option>"
//           var opt="<option value='"+department.department_id+"'>"+department.department_name +"</option>"

//           //console.log(opt);
//           $('#department1').append(opt);
//           options.push(opt);
//         });
//         //console.log(data);
//         $("#department1").html(options).selectpicker('refresh');

//       },
//       type: 'GET'
//     });
// };



    </script>
    @stop
