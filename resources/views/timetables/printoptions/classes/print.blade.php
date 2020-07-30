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


    <body>

      <div class="card">
        <div class="panel">
          <div class="panel-heading">
            <h3 style="text-transform:uppercase; font-weight:bold; margin-left:30%;">
              {{ $class_name->faculty_name}} <br>
              </h3>
              <sup style="text-transform:uppercase; font-weight:bold; margin-left:38%;">SUCCESS UNIVERSITY </sup>
              <h3 style="text-transform:uppercase; font-weight:bold; margin-left:40%;">STUDY PLAN</h3>
          </div>
          <br><br>
            <table>
              <tbody>
                <tr>
                  <td colspan="0" style="text-align: left;">
                    <b>Faculty      : </b><sup>{{ $class_name->faculty_name}}</sup>
                  </td>
                  <td></td>
                  <td colspan="0" style="text-align: right; ">
                    <b>Level        : </b><sup>{{ $class_name->degree_name}}</sup>
                </td>
                </tr>
                <tr>
                  <td colspan="0" style="text-align: left; ">
                    <b>Department   : </b><sup>{{ $class_name->department_name}}</sup>
                  </td>
                  <td></td>
                  <td colspan="0" style="text-align: right; ">
                    <b>Batch        :</b><sub> {{ $class_name->batch}}</sub>
                </td>
                </tr>
                <tr>
                  <td colspan="0" style="text-align: left; ">
                    <b>Class        : </b><sub>{{ $class_name->class_name}}</sub>
                  </td>
                  <td></td>
                  <td colspan="0" style="text-align: right; ">
                    <b>Semester     :</b> <sub>{{ $class_name->semester_name}}</sub>
                </td>
                </tr>
              </tbody>
            </table>
            <br><br>
       <div class="card">
        <div class="table-responsive">
            <table class="bordered-table">
                <thead>
                    <tr class="bordered-tr">
                      <th class="bordered-th">DAYS <br> <sup>TIME</sup></th>
                      <th class="bordered-th">CODE</th>
                      <th class="bordered-th">COURSE</th>
                      <th class="bordered-th">CLASS</th>
                      <th class="bordered-th">CREDIT</th>
                      <th class="bordered-th">ROOM</th>
                      <th class="bordered-th">SEMESTER</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($classtimetables_pdf) > 0)
                    @foreach ($classtimetables_pdf as $teacher)

                    <tr class="bordered-tr">
                       <td class="bordered-td"style="text-align: center;">{{$teacher->name}} <br><sup>{{ $teacher->time}}</sup></td>
                       <td class="bordered-td"style="text-align: center;">{{$teacher->code}}</a></td>
                       <td class="bordered-td"style="text-align: center;background-color:#f0f0f0" class="align-middle text-center">
                         {{$teacher->course_name}} <br><sup style="margin-bottom:7px;">{{$teacher->first_name}} {{$teacher->last_name}}</sup></td>
                       <td class="bordered-td"style="text-align: center;">@if(isset($teacher->class_name)) {{ $teacher->class_name }} @endif</td>
                       <td class="bordered-td"style="text-align: center;">----</td>
                       <td class="bordered-td"style="text-align: center;">{{$teacher->classroom_name}}</td>
                       <td class="bordered-td"style="text-align: center;">{{ $teacher->semester_name}}</td>
                      </tr>
                     @endforeach
                    @else
                        <tr class="bordered-tr"><td colspan="6" bordered-td>No TimeTble Found</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div><br>
    <p style="margin-left:250px; margin-bottom:9px;">Printed Date: {{date('d-M-Y H:i:s A')}}</p>
      <br>
    <table class="bordered-table">
         <tbody>
           <tr>
             <td class="bordered-td"style="text-align: center;">
              <br>
              Approved,
              Major Head / Secretary

              <br><br><br><br>
                <sup>
                  name:
                </sup>
            </td>
             <td class="bordered-td"style="text-align: center;">
              <br>
              Approved By,
              Academic Lecturer

              <br><br><br><br>
                <sup>
                  name:
                </sup>
            </td>
             <td class="bordered-td"style="text-align: center;">
              <br>
              Approved,
              Professor

              <br><br><br><br>
                <sup>
                  name:
                </sup>
            </td>
           </tr>
         </tbody>
       </table>
    </body>
    </html>
