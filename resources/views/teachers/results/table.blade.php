
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
              
                @foreach($class_assign as $exam_term) 
                <b>{{$exam_term->class_name}}</b> ({{$exam_term->type}}) <b style="color:red"> RESULT CARD</b> ({{$exam_term->session}})</h3>
                @endforeach
              </div>
          </div>
          </div>
        </div>

       <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered table-responsive-md table-striped text-center">
                <thead>
                    <tr class="bordered-tr">
                      <th class="bordered-th">Student</th>
                      <!-- <th class="bordered-th">Class</th> -->
                      <!-- <th class="bordered-th">Exam</th> -->
                      <!-- <th class="bordered-th">Exam Year</th> -->
                      <th class="bordered-th">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($isGenerated) > 0)
                    @foreach ($isGenerated as $n => $result)

                            <tr class="bordered-tr">
                                {{-- <td class="bordered-td" style="text-align: center;background-color:#34495E; color:#fff">{{$mark->id}}</td> --}}
                                <td class="bordered-td" style="text-align: center;">{{$result->roll_no}} </td>
                                <!-- <td class="bordered-td" style="text-align: center;">{{$result->class}} </td> -->
                                <!-- <td class="bordered-td" style="text-align: center;">{{$result->type}} </td> -->
                                <!-- <td class="bordered-td" style="text-align: center;">{{$result->batch}}</td> -->


                                <td style="text-align: center;width:112px;">
                                    {{-- <a title='Print' target="_blank" class='btn btn-info' href='{{url("/gradesheet/print")}}/{{$result->roll_no}}/{{$result->exam}}/{{$result->class}}'> <i class="glyphicon glyphicon-print icon-printer"></i></a> --}}

                                    <a href="{{url("/gradesheet/print")}}/{{$result->roll_no}}/{{$result->exam}}/{{$result->class}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a>
                                </td>
                            </tr>
                     @endforeach
                    @else
                   <tr>
				<td style="background:#fffff" style="border: none; text-transform:uppercase; text-align:center" text-black>
					
                @foreach ($class_assign as $n => $result)
                <ul class="nav nav-pills" role="tablist" style="text-align:center">
                <li role="presentation" class="active"><a href="#"> THERE IS NO EXAM RESULT YET FOR <span class="badge">{{$result->semester_name}}</span></a></li>
                <li role="presentation"><a href="#">{{$result->class_name}}</a></li>
                </ul>
				@endforeach
				</td>
				<td style="background:#fffff" style="border: none;"></td>
                       
                   </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div><br>

<style>
    .active{
        background:#fffff !important;
    }
</style>
