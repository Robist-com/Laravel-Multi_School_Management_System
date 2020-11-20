@extends('layouts.frontLayout.app')
@php 
use App\Roll;
$students = Roll::onlineStudent();
@endphp

<?php 
$date = date('Y-m-d');
?>
@section('content')
            <style>
                .names{
                color: red;
                font-family: 'Times New Roman', Times, serif;
                font-display: bold;
                font-size: large;
                }
                table{
                    border: 0px solid;
                    width:100%;
                }
                .vl {
            border-left: 6px solid green;
            height: 500px;
            position: absolute;
            left: 50%;
            margin-left: -3px;
            top: 0;
            }
            h6{
            display: inline-block
            }
            h5{
            display: inline-block
            }

.bordered-table {
    border:1px solid black;
    border-collapse: collapse;
}
.bordered-tr {
  border-left: 1px solid #000;
  border-right: 1px solid #000;
}

.bordered-td {
    border-left: 1px solid black;
    border-right: 1px solid black;
    border-bottom: 1px solid black;
}

.bordered-th {
    border-left: 1px solid #000;
    border-right: 1px solid #000;
    border-bottom: 1px solid black;

    text-align: center;
}

            </style>


    {{-- <body> --}}

    <div class="content">

            <div class="clearfix"></div>
            @include('flash::message')
            <div class="box box-primary">
                <div class="box-body">

      <div class="card">
        <div class="panel">
          <div class="panel-heading">
            <div class="card">
              <h3 style="text-transform:uppercase; font-weight:bold; margin-left:30%;">
                 <b style="color:red"> home works Table</b> </h3>
              </div>
          </div>
          </div>
        </div>

       <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered table-responsive-md table-striped text-center">
                <thead>
                    <tr class="bordered-tr">
                      <th class="bordered-th">Class</th>
                      <th class="bordered-th">Subject</th>
                      <th class="bordered-th">Body</th>
                      <th class="bordered-th">File</th>
                      <th class="bordered-th">Start</th>
                      <th class="bordered-th">End</th>
                      <th class="bordered-th">Upload File Here <i class="glyphicon glyphicon-upload icon-edit"></i></th>
                      <th class="bordered-th">Status</th>
                    
                    </tr>
                </thead>

                <tbody>
               
                    @if(count($class_assign) > 0)
                    @foreach ($class_assign as $n => $homework)
                   
                            <form action="{{url('upload-class-homework')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="class_code" id="id_class" value="{{$homework->class_code}}" class="form-control" placeholder="Enter Class ">
                                <input type="hidden" name="subject_id" id="id_subject_id" value="{{$homework->subject_id}}" class="form-control" placeholder="Enter Subject ">
                                <input type="hidden" name="grade" id="id_grade" value="{{$homework->semester_id}}" class="form-control" placeholder="Enter Subject ">
                                <input type="hidden" name="teacher_id" id="id_teacher_id" value="{{$homework->teacher_id}}" class="form-control" placeholder="Enter Subject ">
                                <input type="hidden" name="homework_id" id="id_homework_id" value="{{$homework->homework_id}}" class="form-control" placeholder="Enter Subject ">
                                <input type="hidden" name="student_id" id="id_student_id" value="{{$homework->student_id}}" class="form-control" placeholder="Enter Subject ">
                                <input type="hidden" name="status" id="id_status" value="1" class="form-control" placeholder="Enter Subject ">
                                <input type="hidden" name="school_id" id="school_id" value="{{$students->school_id}}" class="form-control" placeholder="School ID ">
   
                            <tr class="bordered-tr">
                                <td class="bordered-td" style="text-align: center;">{{$homework->class_code}} </td>
                                <td class="bordered-td" style="text-align: center;">{{$homework->course_name}} </td>
                                <td class="bordered-td" style="text-align: center;"> {{$homework->body}}</td>
                                <td class="bordered-td" style="text-align: center;"><button type="button" class="btn btn-primary btn-xs accordion-toggle"  data-toggle="collapse" id="playvideo"
                                data-target="#demo{{$n}}" title="Click to download"><span class="fa fa-download"></span> {{$homework->file}}</button></td>
                                <td class="bordered-td" style="text-align: center;">{{$homework->start_date}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$homework->end_date}}</td>
                               
                                {{date('Y-m-d')}}
                                <td style="text-align: center;width:112px;">
                                  @if($homework->end_date != $date)
                                  <label for="" class="label label-danger">homework expired</label>
                                  @else
                                  <a title='Upload Homework'  class='btn btn-default btn-sm'> <input type="file" name="homework_file" id="" required> </a>
                                  <input type="submit" name="" id="upload_id{{$n}}"  class='btn btn-info btn-sm' value="Upload">
                                  @endif
                                </td>
                                <td>
                                   <a class="btn btn-success1 btn-xs status_class" name="status_name" id="status_id{{$n}}" > </a>
                                </td>
                            </tr>
                            <tr>
                            <td colspan="9" class="hiddenrow">
                                @include('teachers.homework.pdfFile')
                            </td>
                        </tr>
                        </form>
                     @endforeach
                    @else
                   <tr>
				<td style="background:#fffff" style="border: none; text-transform:uppercase; text-align:center" text-black>
				<td style="background:#fffff" style="border: none; text-transform:uppercase; text-align:center" text-black>
				<td style="background:#fffff" style="border: none; text-transform:uppercase; text-align:center" text-black>
				<td style="background:#fffff" style="border: none; text-transform:uppercase; text-align:center" text-black>
                <ul class="nav nav-pills" role="tablist" style="text-align:center">
                <li role="presentation" class="active"><a href="#"> THERE IS NO HOMEWORK YET FOR <span class="badge">{{$students->first_name}} {{$students->last_name}}</span></a></li>
                <li role="presentation"><a href="#">{{$students->class_code}}</a></li>
                </ul>
               
				</td>
				<td style="background:#fffff" style="border: none;"></td>
				<td style="background:#fffff" style="border: none;"></td>
				<td style="background:#fffff" style="border: none;"></td>
				<td style="background:#fffff" style="border: none;"></td>
                       
                   </tr>
                    @endif
                   
                </tbody>
              
            </table>
            
        </div>
    </div><br>

    </div></div></div></div>

@endsection

<style>
.status_submit{
    background-color:#00A65A;
    color:#ffff;
}
a.status_submit:hover {
    color:#ffff;
}

.status_pending{
    background-color: red;
}
</style>


<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->

<script>

</script>

<script>

@foreach($uploaded_homework as $key => $upload)
$(document).ready(function(){
     

    if(!$('input{{$key}}').val() ){
        $("#upload_id{{$key}}").hide();
        $("#status_id{{$key}}").removeClass('status_pending').addClass('status_submit').text('Submited');
    }else{
        $("#upload_id{{$key}}").show();
        $("#status_id{{$key}}").removeClass('status_submit').addClass('status_pending').text('Pending');
    }

});

// function closePdf(){

// var omyFrame = document.getElementById("myframe");
// omyFrame.style.display="none";
// // alert(1);

// }

// function openPdf(){
// var omyFrame = document.getElementById("myframe");
// omyFrame.style.display="block";

// // alert(1);

// }
@endforeach
</script>

