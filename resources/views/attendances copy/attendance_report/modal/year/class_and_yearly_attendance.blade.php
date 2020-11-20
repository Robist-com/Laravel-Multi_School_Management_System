@include('attendances.attendance_report.modal.report_pdf_header')
@php 
use App\Institute;
$institute = Institute::first();
@endphp   
      
      <div class="card">
        <div class="panel">
          <div class="panel-heading">

            <h3 style="text-transform:uppercase; font-weight:bold; text-align:center; color:red"> 
                    Class and yearly <b>Attendance</b>
                <br>
              </h3>
            <h4 style="text-transform:uppercase; font-weight:bold; text-align:center;"> 
            @if (isset($class_and_year))
              {{ $class_and_year->faculty_name}}
              @endif
                <br>
              </h4>
              <h2 style="text-transform:uppercase; font-weight:bold; text-align:center;">{{$institute->name}}</h2>
               <h3 style="text-transform:uppercase; font-weight:bold; text-align:center;">
                <b style="color:royalblue"> 
               @if (isset($class_and_year))
               {{ $class_and_year->class_name}}  ( {{ $class_and_year->year}} ) </b>  ATTENDANCE REPORT
                @else
               <label style="text-transform:uppercase; font-weight:bold; text-align:center;"> ATTENDANCE REPORT</label>
               @endif</h3>
          </div>
          <br><br>
        
            <br><br>
       <div class="card">
        <div class="table-responsive">
          <table class="bordered-table" id="student">
            <thead>
                <tr class="bordered-tr">
                    <th class="bordered-th">Roll No.</th>
                    <th  class="bordered-th">Student Name</th>
                    <th  class="bordered-th">Attendance</th>
                    <th  class="bordered-th">Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($monthly_attend as $key => $item)
                <tr class="bordered-tr">
                <td class="bordered-td">{{$item->roll_no}}</td>
                <td  class="bordered-td">{{$item->student_first_name }} {{$item->student_last_name}}</td>
                <td  class="bordered-td">{{$item->attendance_status }}</td>
                <td  class="bordered-td">{{$item->attendance_date }} </td>
                
                </tr>
                @endforeach
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
        