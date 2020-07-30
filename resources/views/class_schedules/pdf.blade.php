<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

            <style>
                .names{
                color: red;
                font-family: 'Times New Roman', Times, serif;
                font-display: bold;
                font-size: large;
                }
                table1{
                    border: 1px solid;
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
            </style>


<body>
        <div class="table-responsive-lg">
                
@include('pdf_header')

                {{---------------------------------table start here--------------------------------------}}
                
            <table class="table" id="classSchedules-table">
                    <caption style="margin-top:20px;" >Class Schedule PDF</caption>
                <thead>
                    <tr>
                <th style="text-align:center">Class </th>
                <th style="text-align:center">Details </th>
                </tr>
                </thead>
                <tbody>
                @foreach($classRoom as $key => $classSchedule)
                    <tr>
                    <!-- we will change this course_id to course okay. -->
                    <td style="text-align:center; border-right:1px solid;border-bottom:1px solid;
                    border-top:1px solid;border-left:1px solid;"
                     class="col-md-3"><span class="names">Class:</span> {!! $classSchedule->class_name !!}</td>
                    <div class="v"></div>
                    <td style="text-align:center; border-bottom:1px solid;border-right:1px solid;border-top:1px solid" class="col-md-9"><span class="names">Course:</span> {!! $classSchedule->course_name !!} |
                    <span class="names">Level:</span>  {!! $classSchedule->level !!}
                       <span class="names">Class Room:</span> {!! $classSchedule->classroom_name!!} |
                       <span class="names">Batch:</span> {!! $classSchedule->batch !!} |
                       <span class="names">Day:</span> {!! $classSchedule->name !!} |
                       <span class="names">Shift:</span> {!! $classSchedule->shift !!} |
                       <span class="names">Tiem:</span> {!! $classSchedule->time !!} |
                       <span class="names">Semester:</span> {!! $classSchedule->semester_name !!} |
                       <span class="names">Start Date:</span> {!! $classSchedule->start_date !!} |
                       <span class="names">End Date:</span> {!! $classSchedule->end_date !!} |
                       <span class="names">Status:</span> @if($classSchedule->status == 0)
                       <div style="color:green">Active</div> 
                            @else
                            <div style="color:red">InActive</div>
                        @endif 
                        {{-- <hr> --}}
                    </tr>
                   
                @endforeach
                </tbody>
            </table>
            
        </div>
        
       
    </body>
    </html>  
        