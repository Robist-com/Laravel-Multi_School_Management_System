@extends('layouts.app')

@section('content')

@include('table_style')

<div class="content">

    <section class="content-header">
        <h1 class="pull-left">Marks Entry</h1>
        <h1 class="pull-right">
           <a type="button" href="{{url('mark/create')}}" class="btn btn-primary pull-right  style" style="margin-top: -10px;margin-bottom: 5px" >back</a>
        </h1>
    </section>

    <div class="clearfix"></div>
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="box box-primary" data-widget="box-widget">
                    <div class="box-header">
                    <h3 class="box-title">Marks Entry</h3>
                        <div class="box-tools">
                        <!-- This will cause the box to collapse when clicked -->
                        <button class="btn btn-box-tool " data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                        </div>
                        </div>
                        <!-- /.box-header -->
                    <div class="box-body collapse">

         <form role="form" action="{{url('/mark/create')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row">
                  <div class="col-md-12">
                  <div class="col-md-7">
                  <div class="row">
                  <div class="col-md-12">

                    <div class="col-md-3">
                      <div class="form-group">
                      <label class="control-label" for="class">Class</label>
                          <select id="class" name="class" class="form-control select_2_single" >
                              <option value="" selected disabled>--Select--</option>
                            @foreach($classes as $class)
                              <option value="{{$class->class_code}}" @if($class_code==$class->class_code) selected @endif>{{$class->class_name}}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>
                      <div class="col-md-4">
                        <div class="form-group">
                        <label class="control-label" for="section">Department</label>
                            <select id="department" name="department"  class="form-control select_2_single" >
                              <option value="">--Select--</option>
                           </select>

                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group ">
                         <label for="session">Batch</label>
                         <select id="session" name="session" class="form-control select_2_single" required="true">
                                <option value="" selected disabled>--Select--</option>
                                    @foreach($batches as $batch)
                                    <option value="{{$batch->id}}">{{$batch->batch}}</option>
                                    @endforeach
                              </select>
                                <!-- <input type="text" id="session" required="true" class="form-control datepicker2" name="session" value="{{$session}}"  data-date-format="yyyy"> -->
                            </div>
                        </div>
                          <input type="hidden" name="shift" value="Morning">
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="col-md-5">
                      <div class="form-group">
                      <label class="control-label" for="subject">Courses</label>

                          <select id="subject" name="subject" class="form-control select_2_single" required="true">
                            <option value="">--Select--</option>
                           
                          </select>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                      <label class="control-label" for="exam">Examination</label>

                          <select name="exam" id="exam" required="true" class="form-control select_2_single" >
                           <option value="">-Select-</option>
                              @if($exams)
                              @foreach($exams as $exm)
                              <option value="{{$exm->id}}" @if($exm->id==$exam) selected @endif>{{$exm->type}}</option>
                               @endforeach
                               @endif
                         </select>
                    </div>
                </div>

                </div>
              </div>
            </div>
            <div class="col-md-5">
            <div class="panel">
                <div class="row">
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-2 style" style="color:#5555">
                      <label>Marks</label>
                    </div>
                    <div class="col-md-2 style" style="color:#5555">
                       <label>Written</label>
                    </div>
                    <div class="col-md-2 style" style="color:#5555">
                     <label>MCQ</label>
                    </div>
                    <div class="col-md-2 style" style="color:#5555">
                       <label>Practical</label>
                    </div>
                    <div class="col-md-2 style" style="color:#5555">
                       <label>SBA</label>
                    </div>
                  </div>
            </div>
               <div class="row">
                 <div class="col-md-2 label label-primary style">
                 <label>Full Marks</label>
                 </div>
                 <div class="col-md-2">
                   <label id="tfull">0</label>
                 </div>
                 <div class="col-md-2">
                    <label id="wfull">0</label>
                 </div>
                 <div class="col-md-2">
                  <label id="mfull">0</label>
                 </div>
                 <div class="col-md-2">
                    <label id="pfull">0</label>
                 </div>
                 <div class="col-md-2">
                    <label id="cfull">0</label>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-2 label label-primary style">
                 <label >Pass Marks</label>
                 </div>
                 <div class="col-md-2">
                   <label id="tpass">0</label>
                 </div>
                 <div class="col-md-2">
                    <label id="wpass">0</label>
                 </div>
                 <div class="col-md-2">
                  <label id="mpass">0</label>
                 </div>
                 <div class="col-md-2">
                    <label id="ppass">0</label>
                 </div>
                 <div class="col-md-2">
                    <label id="cpass">0</label>
                 </div>
               </div>
            </div>
          </div>
        </div>

        {{-- <div class="row"> --}}
                           <div class="col-md-12">
                               <div class="table-responsive">
                                   <table id="studentList" class="table table-striped table-bordered table-hover">
                                       <thead>
                                       <tr>
                                           <!-- <th>Registration No</th> -->
                                           <th>Roll No</th>
                                          <th>Name</th>
                                            <th>Written</th>
                                              <th>MCQ</th>
                                                <th>Practical</th>
                                                  <th>SBA</th>
                                                  <th>Absent</th>
                                       </tr>
                                       </thead>
                                       <tbody>


                                       <tbody>
                               </table>
                           </div>
                       </div>

        {{-- </div> --}}

        <!--button save -->
        <div class="row">
         <div class="col-md-12">
           <button class="btn btn-primary pull-right" id="btnsave" type="submit"><i class="glyphicon glyphicon-plus"></i>Save</button>
             </form>
         </div>
           </div>
           </div>
        </div>
        </div>
        <div class="text-center"> 
        </div>
        </div>
    </div>
@stop
@section('scripts')
<script src="{{url('/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
//
    $( document ).ready(function() {
      //$('#class').trigger('change');
     <?php if($session){ ?>
      getstudent();
       subject();
      <?php } ?>
     //  getdepartments();
  $('#class').on('change',function() {
    //alert(434);

    getdepartment();
    getexam();
    subject();
  });
  $('#session').on('change',function() {
          getstudent();
        });
       $('#btnsave').hide();
       /* $('#class').on('change', function (e) {
           
            });*/

$(".datepicker2").datepicker( {
    format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years",
    minViewMode: "years",
    autoclose:true

}).on('changeDate', function (ev) {
    
         getstudent();

        });

        $( "#subject" ).change(function() {
        //   alert(434);
          $.ajax({
                url: "{{url('/course/getmarks')}}"+'/'+$('#subject').val()+'/'+$('#class').val(),
                data: {
                    format: 'json'
                },
                error: function(error) {
                   console.log(error);
                },
                dataType: 'json',
                success: function(data) {
                  $('#tfull').text(data[0]['totalfull']);
                  $('#tpass').text(data[0]['totalpass']);

                  $('#wfull').text(data[0]['wfull']);
                  $('#wpass').text(data[0]['wpass']);

                  $('#mfull').text(data[0]['mfull']);
                  $('#mpass').text(data[0]['mpass']);

                  $('#pfull').text(data[0]['pfull']);
                  $('#ppass').text(data[0]['ppass']);

                  $('#cfull').text(data[0]['sfull']);
                  $('#cpass').text(data[0]['spass']);
                  getstudent();
                },
                type: 'GET'
            });



             });



    });


 function subject()
 {
   var val = $('#class').val();
            $.ajax({
                url:"{{url('/class/getcourses')}}"+'/'+val,
                type:'get',
                dataType: 'json',
                success: function( json ) {
                    $('#subject').empty();
                    $('#subject').append($('<option>').text("--Select--").attr('value',""));
                    $.each(json, function(i, subject) {
                        // console.log(subject);

                        $('#subject').append($('<option>').text(subject.course_name).attr('value', subject.course_code));
                    });
                }
            });
 }

function getstudent()
{


var aclass = $('#class').val();
     var department =  $('#department').val();
    // var shift = $('#shift').val();
    // alert(1);
    var shift =  "Morning";
    
     var batch = $('#session').val().trim();
      //alert(session);
     $.ajax({
           url: "{{url('/student/getsList')}}"+'/'+aclass+'/'+department+'/'+batch,
           data: {
               format: 'json'
           },
           error: function(error) {
              alert(error);
           },
           dataType: 'json',
           success: function(data) {

             $("#studentList").find("tr:gt(0)").remove();
             if(data.length>0)
             {
               $('#btnsave').show();
             }
             for(var i =0;i < data.length;i++)
              {
                addRow(data[i],i);
              }

           },
           type: 'GET'
       });





}


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
        //alert("Please fill all inputs correctly!");
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

    function addRow(data,index) {
     var table = document.getElementById('studentList');
     var rowCount = table.rows.length;
     var row = table.insertRow(rowCount);
    // var cell1 = row.insertCell(0);
  //  var chkbox = document.createElement("label");
    // chkbox.type = "checkbox";
     //chkbox.name="chkbox[]";
    // cell1.appendChild(chkbox);
    var tm = $('#tfull').text();

    if(tm ==''){
    tm = 25;
    }
    var wm = $('#wfull').text();
    if(wm ==''){
    wm = 25;
    }
    var mm=$('#mfull').text();
    if(mm ==''){
    mm = 25;
    }
    var pm=$('#pfull').text();
    if(pm ==''){
    pm = 25;
    }
    var cm = $('#cfull').text();
    if(cm ==''){
    cm = 25;
    }
     var cell2 = row.insertCell(0);
     var regiNo = document.createElement("label");

     regiNo.innerHTML=data['studentRollss'];
     cell2.appendChild(regiNo);
     var hdregi = document.createElement("input");
     hdregi.name="roll[]";
     hdregi.value=data['studentRollss'];
    hdregi.type="hidden";
    cell2.appendChild(hdregi);


    //  var cell3 = row.insertCell(0);
    //  var rollno = document.createElement("label");
    //   rollno.innerHTML=data['student'];
    //  cell3.appendChild(rollno);
  /*   var hdroll = document.createElement("input");
     hdroll.name="rollNo[]";
     hdroll.value=data['rollNo'];
    hdroll.type="hidden";
    cell3.appendChild(hdroll);*/



     var cell4 = row.insertCell(1);
     var name = document.createElement("label");
      name.innerHTML=data['first_name']+'  '+data['last_name'];
     cell4.appendChild(name);

     var cell5 = row.insertCell(2);
     var written = document.createElement("input");
     written.type="number";

     written.name = "written[]";
     written.required = "true";
     written.size="2";
     written.maxlength="2";
     written.max = wm;
     written.class="form-control";
     cell5.appendChild(written);

     var cell6 = row.insertCell(3);
     var mcq = document.createElement("input");
     mcq.type="number";

     mcq.name = "mcq[]";
     mcq.required = "true";
     mcq.size="2";
      mcq.max = mm;
     cell6.appendChild(mcq);

     var cell7 = row.insertCell(4);
     var practical = document.createElement("input");
     practical.type="number";

     practical.name = "practical[]";
     practical.required = "true";
      practical.size="2";
      practical.max = pm;
     cell7.appendChild(practical);

     var cell8 = row.insertCell(5);
     var ca = document.createElement("input");
     ca.type="number";

     ca.name = "ca[]";
     ca.required = "true";
     ca.max = cm;
     ca.size="2";
     cell8.appendChild(ca);

      var cell9 = row.insertCell(6);
     var chkbox = document.createElement("input");
     chkbox.type = "text";
        chkbox.placeholder="No";
      chkbox.name="absent[]";
      chkbox.size="3";
      cell9.appendChild(chkbox);
 };

</script>

@stop
