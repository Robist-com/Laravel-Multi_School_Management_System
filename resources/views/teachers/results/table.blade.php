
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

              <h4 style="text-transform:uppercase; font-weight:bold; 1margin-left:25%; text-align:center">
                @foreach($class_assign as $exam_term) 
                <b>{{$exam_term->class_name}}</b> ({{$exam_term->type}}) <b style="color:red"> RESULT CARD</b> ({{$exam_term->batch}})
                @endforeach
                </h4>
                <hr>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap js-exportable" cellspacing="0" width="100%">

                <thead>
                    <tr class="bordered-tr">
                      <th class="bordered-th">Student</th>
                      <th class="bordered-th">Father Name</th>
                      <th class="bordered-th">Father Phone</th>
                      <th class="bordered-th">Email</th>
                      <th class="bordered-th">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(count($isGenerated) > 0)
                    @foreach ($isGenerated as $n => $result)

                            <tr class="bordered-tr">
                                <td>
                                <img src="{{asset('student_images/' .$result->image)}}" title="{{$result->first_name}} {{$result->last_name}} {{$result->roll_no}} {{$result->father_name}} "
                                    class12="rounded-circle1"  width="50" height="50" data-toggle="tooltip" data-placement="top" style="border-radius1:50%; vertical-alight:middle;">
                                </td>
                                <td>
                                {{$result->father_name}}
                                </td>
                                <td>
                                {{$result->phone}}
                                </td>
                                <td>
                                {{$result->email}}
                                </td>

                                <td style="text-align: center;width:112px;">
                                    <a title='send email' data-toggle="tooltip" data-placement="left" target="_blank" class='btn btn-info btn-xs' href='{{url("/gradesheet/print")}}/{{$result->roll_no}}/{{$result->exam}}/{{$result->class}}'> <i class="fa fa-envelope-o"></i></a> 

                                    <a data-toggle="tooltip" data-placement="top" href="{{url("/gradesheet/print")}}/{{$result->roll_no}}/{{$result->exam}}/{{$result->class}}" target="_blank" class="btn btn-default btn-xs"  title="Print report"><i class="fa fa-print"></i></a>
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
        <!-- </div>
    </div><br> -->

<style>
    .active{
        background:#fffff !important;
    }
</style>
