<hr>
                    <strong>Select Criteria</strong>
                    <hr>
                    <div class="row">
                       <form action="{{route('poststudentguadianReport')}}" method="POST">
                           @csrf

                        @if(auth()->user()->group == "Admin")
                          <div class="col-md-12">
                        
                              <label for="">School <b style="color:red">*</b></label>
                          <select name="school_id" id="school_id" class="form-control bootstrap-select">
                              <option value="">Select</option>
                              @foreach(auth()->user()->school->all() as $school)
                              <option value="{{$school->id}}" @if(isset($classstudentreport_single)){{$school->id == $classstudentreport_single->school_id ? 'selected' : '' }} @endif>{{$school->name}}</option>
                              @endforeach
                          </select>
                          </div>
                          <br>
                          <br>
                        @endif

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Class <b style="color:red">*</b></label>
                        <select name="class_id" id="class_id" class="form-control bootstrap-select">
                            <option value="">Select</option>
                            @foreach($classes as $class)
                            <option value="{{$class->class_code}}" @if(isset($classstudentreport_single)){{$class->class_code == $classstudentreport_single->class_code ? 'selected' : '' }} @endif>{{$class->class_name}}</option>
                            @endforeach
                        </select>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Section <b></b></label>
                        <select name="department" id="department" class="form-control bootstrap-select" onchange="getData(this);">
                            <option value="" selected="true">Select</option>
                            <option value="1">IS</option>
                            <option value="2">IT</option>
                        </select>
                        </div>
                        <button type="submit" class="btn bg-teal btn-round pull-right"><i class="fa fa-search"></i>search</button>
                        </div>

                        </form>
                    </div>
                   

                    @if(isset($poststudentguidianreport))
                    <hr>
                    <b>Guadian Report</b>
                    <hr>
                    <div class="responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered js-exportable">
                      <thead>
                        <tr>
                          <th>Roll No</th>
                          <th>Student Name</th>
                          <th>Gender</th>
                          <th>Date of Birth</th>
                          <th>Mobile </th>
                          <th>Passport</th>
                          <th>Father </th>
                          <th>Father Mobile</th>
                          <th>Mother </th>

                        </tr>
                      </thead>

                      <tbody>
                      @foreach($poststudentguidianreport as $classstudent)
                        <tr>
                        <td>{{ $classstudent->username }}</td>
                        <td><a href="{{route('admissions.show', $classstudent->id)}}">{{ $classstudent->first_name. ' ' .$classstudent->last_name }}</a></td>
                        <td>@if($classstudent->gender == 0) Male @else Female @endif</td>
                        <td>{{date('Y/m/d', strtotime($classstudent->dob))}}</td>
                        </td>
                        <td class="text-right">{{$classstudent->phone}}</td>
                        <td class="text-right">{{ $classstudent->passport}}</td>
                        <td>{{ $classstudent->father_name }}</td>
                        <td>{{ $classstudent->father_phone }}</td>
                        <td>{{ $classstudent->mother_name }}</td>

                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                    </div>
                    @endif