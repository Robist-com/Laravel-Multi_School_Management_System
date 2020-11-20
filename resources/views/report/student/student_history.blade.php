<hr>
                    <strong>Select Criteria</strong>
                    <hr>
                    <div class="row">
                       <form action="{{route('poststudenthistoryReport')}}" method="POST">
                           @csrf

                           @if(auth()->user()->group == "Admin")
                        <div class="col-md-12">
                       
                            <label for="">School <b style="color:red">*</b></label>
                        <select name="school_id" id="school_id" class="form-control">
                            <option value="">Select</option>
                            @foreach(auth()->user()->school->all() as $school)
                            <option value="{{$school->id}}" @if(isset($classstudentreport_single)){{$school->id == $classstudentreport_single->school_id ? 'selected' : '' }} @endif>{{$school->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <br>
                          <br>
                        @endif
                        <div class="col-md-5">
                            <label for="">Class <b style="color:red">*</b></label>
                        <select name="class_id" id="class_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($classes as $class)
                            <option value="{{$class->class_code}}" @if(isset($classstudentreport_single)){{$class->class_code == $classstudentreport_single->class_code ? 'selected' : '' }} @endif>{{$class->class_name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-5">
                        <label for="">Academic Year <b></b></label>
                        <select name="batch_id" id="batch_id" class="form-control" onchange="getData(this);">
                            <option value="" selected="true">Select</option>
                            @foreach($batches as $batch)
                            <option value="{{$batch->id}}" @if(isset($classstudentreport_single)){{$batch->id == $classstudentreport_single->batch_id ? 'selected' : '' }} @endif>{{$batch->batch}}</option>
                           @endforeach
                        </select>
                        </div>
                           
                        <div class=" pull-right " style="margin-top:25px" >
                        <button type="submit" class="btn btn-dark btn-round"><i class="fa fa-search"></i>search</button>
                        </div>

                        </form>
                    </div>
                   

                    @if(isset($poststudenthistoryreport))
                    <hr>
                    <b>Student History</b>
                    <hr>
                    <div class="responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Roll No</th>
                          <th>Student Name</th>
                          <th>Admission Date</th>
                          <th>Session</th>
                          <th>Dob</th>
                          <!-- <th>Mobile Number</th> -->
                          <!-- <th>Passport Number</th> -->
                          <th>Father Name</th>
                          <th>Father Mobile</th>
                          <th>Mother Name</th>

                        </tr>
                      </thead>

                      <tbody>
                      @foreach($poststudenthistoryreport as $classstudent)
                        <tr>
                        <td>{{ $classstudent->username }}</td>
                        <td><a href="{{route('admissions.show', $classstudent->id)}}">{{ $classstudent->first_name. ' ' .$classstudent->last_name }}</a></td>
                        <td>{{date('Y/m/d', strtotime($classstudent->registereddate))}}</td>
                        <td>{{$classstudent->batch}}</td>
                        <td>{{$classstudent->class_name}}</td>
                        </td>
                        <!-- <td class="text-right">{{$classstudent->phone}}</td> -->
                        <!-- <td class="text-right">{{ $classstudent->passport}}</td> -->
                        <td>{{ $classstudent->father_name }}</td>
                        <td>{{ $classstudent->father_phone }}</td>
                        <td>{{ $classstudent->mother_name }}</td>

                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                    </div>
                    @endif