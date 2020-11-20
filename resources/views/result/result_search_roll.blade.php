<div class="row">
                <div class="col-md-12">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <!-- <table id="markList" class="table table-striped table-bordered table-hover"> -->
                        <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Shift</th>
                             <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                            <td><img src="{{asset('student_images/'.$student->image)}}" alt="" class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
                                <td>{{$student->roll_no}}</td>
                                <td>{{$student->first_name}} {{$student->last_name}}</td>
                                <td>{{$student->class_name}}</td>
                                <td>{{$student->department_name}}</td>
                                <td>{{$student->shift}}</td>
                                {{-- <td>{{$student->group}}</td> --}}

                                <td>
                                    {{-- @if($gradsystem=='' || $gradsystem=='auto') --}}
                                      <a title='Print' target="_blank" class='btn btn-info' href='{{url("/gradesheet/print")}}/{{$student->roll_no}}/{{$formdata->exam}}/{{$formdata->class}}'> <i class="glyphicon glyphicon-print icon-printer"></i></a>
                                    {{-- @else --}}
                                      {{-- <a title='Print' target="_blank" class='btn btn-info' href='{{url("/gradesheet/m_print")}}/{{$student->roll_no}}/{{$formdata->exam}}/{{$formdata->class}}?type={{ $type}}&examps_ids={{$exams_ids}}'> <i class="glyphicon glyphicon-print icon-printer"></i></a> --}}
                                    {{-- @endif --}}
                                </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>