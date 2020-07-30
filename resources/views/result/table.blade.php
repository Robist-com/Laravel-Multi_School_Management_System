


@include('table_style')
<style>

</style>

<div class="table-responsive">
<div class="panel">
<h1 style="font-weight:bold"><i class="fa fa-user-o"></i> MANAGE RESULTS</h1>
<hr class="line">
    <div class="panel-body">
    <div  id="wait"></div>

    <button class="btn btn-dark style"><a data-toggle="modal" data-target="#generateresult-show"> Publish Result</button></a>
    <button class="btn btn-dark style "  ><a href="{{url('result/search')}}">Search Result</button></a>
    {{-- <button class="btn btn-info style" ><a href="question/list"> Question List</button></a> --}}
    {{-- <button class="btn btn-dark style" ><a href="{{url('/gradesheet')}}" data-toggle="modal" data-target="#generateGradesheet-show"> Generate  Gradesheet</button></a> --}}
    <button class="btn btn-dark style" ><a href="{{url('/gradesheet')}}"> Generate  Gradesheet</button></a>
    {{-- <button class="btn btn-info style" ><a data-toggle="modal" data-target="#generatequestion-show"> Generate  Paper</button></a> --}}
    </div>
</div>
    <table class="table" id="admissions-table">
        <thead>
            <tr>
         <th>Image</th>
         <th>Full Name</th>
        <th>Faculty</th> 
        <th>Department</th> 
        <th>Batch</th> 
        <th>Gender</th>
        <th>Status</th>
        <th colspan="3">Action</th>
            </tr>
    </thead>
<tbody>
    {{-- {{$students}} --}}
    @foreach($students as $student)
    <tr>
        <td>{{$student->regiNo}}</td>
        <td>{{$student->roll_no}}</td>
        <td>{{$student->firstName}} {{$student->middleName}} {{$student->lastName}}</td>
        <td>{{$formdata->postclass}}</td>
        <td>{{$student->section}}</td>
        <td>{{$student->shift}}</td>
        <td>{{$student->group}}</td>

        <td>
            @if($gradsystem=='' || $gradsystem=='auto')
              <a title='Print' target="_blank" class='btn btn-info' href='{{url("/gradesheet/print")}}/{{$student->regiNo}}/{{$formdata->exam}}/{{$formdata->class}}'> <i class="glyphicon glyphicon-print icon-printer"></i></a>
            @else
              <a title='Print' target="_blank" class='btn btn-info' href='{{url("/gradesheet/m_print")}}/{{$student->regiNo}}/{{$formdata->exam}}/{{$formdata->class}}?type={{ $type}}&examps_ids={{$exams_ids}}'> <i class="glyphicon glyphicon-print icon-printer"></i></a>
            @endif
        </td>
@endforeach
           
       

        </tbody>
    </table>
</div>

@section('scripts')
<script src="{{url('/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
     $( document ).ready(function() {
         // alert(1);
        //  getdepartment();
            //  getexam();
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
            //  alert(1);
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



