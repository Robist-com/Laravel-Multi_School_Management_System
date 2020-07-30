
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

      <div class="card">
        <div class="panel">
          <div class="panel-heading">
            <div class="card">
              <h3 style="text-transform:uppercase; font-weight:bold; margin-left:30%;">
                @if(isset($class_name))GRADE 7 <b style="color:red">MARKS</b></h3>
                @else
                  <b style="color:red">EXAM MARK</b></h3>
                @endif
              </div>
          </div>
          </div>
        </div>

       <div class="card">
        <div class="table-responsive">
            <table class="bordered-table">
                <thead>
                    <tr class="bordered-tr">
                      <th class="bordered-th">Session</th>
                      <th class="bordered-th">Teacher</th>
                      <th class="bordered-th">Course</th>
                      <th class="bordered-th">Exam</th>
                      <th class="bordered-th">Theory</th>
                      <th class="bordered-th">MCQ</th>
                      <th class="bordered-th">Practical</th>
                      <th class="bordered-th">Homework</th>
                      <th class="bordered-th">Total</th>
                      <th class="bordered-th">Grade</th>
                      <th class="bordered-th">Point</th>
                    </tr>
                </thead>

                {{-- {{$studentmarks}} --}}
                <tbody>
                    @if(count($studentmarks) > 0)
                    @foreach ($studentmarks as $n => $mark)
                    {{-- @if ($transaction->semester_id == 1) --}}

                            <tr class="bordered-tr">
                                <td class="bordered-td" style="text-align: center;background-color:#34495E; color:#fff">{{$mark->session}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->first_name}} {{$mark->last_name}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->course_name}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->type}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->written}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->mcq}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->practical}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->ca}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->total}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->grade}}</td>
                                <td class="bordered-td" style="text-align: center;">{{$mark->point}}</td>

                                {{-- <td style="text-align: center;width:112px;"> --}}
                                    {{-- <a href="{{ route ('StudentInvoicePrint', [$transaction->invoice_id])}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a> --}}
                                {{-- </td> --}}
                      {{-- @endif --}}
                     @endforeach
                    @else
                        <tr class="bordered-tr">
                          <td colspan="12" class=" bordered-td">
                           <div class="alert alert-danger text-center" style="font-weight:bolder">
                            {{-- No Transaction Found for {{$transaction->first_name}} {{$transaction->last_name}} --}}
                           </div>
                          </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div><br>


