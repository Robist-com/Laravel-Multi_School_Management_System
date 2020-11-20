<hr>
                    <strong>Select Criteria</strong>
                    <hr>
                    <div class="row">
                       <form action="{{route('poststudentReport')}}" method="POST">
                           @csrf

                        @if(auth()->user()->group == "Admin")
                        <div class="col-md-12">
                       
                            <label for="">School <b style="color:red">*</b></label>
                        <select name="school_id" id="school_id" class="form-control">
                            <option value="">Select</option>
                            @foreach(auth()->user()->school->all() as $school)
                            <option value="{{$school->id}}" @if(isset($school)){{$school->id == $classstudentreport_single->school_id ? 'selected' : '' }} @endif>{{$school->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <br>
                          <br>
                        @endif
                       

                        <div class="col-md-4">
                            <label for="">Class <b style="color:red">*</b></label>
                        <select name="class_id" id="class_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($classes as $class)
                            <option value="{{$class->class_code}}" @if(isset($classstudentreport)){{$class->class_code == $classstudentreport_single->class_code ? 'selected' : '' }} @endif>{{$class->class_name}}</option>
                            @endforeach
                        </select>
                        </div>
                         
                        <div class="col-md-4">
                        <label for="">Section <b></b></label>
                        <select name="department" id="department" class="form-control" onchange="getData(this);" @if(request('department')) selected @endif>
                            <option value="" selected="true">Select</option>
                            <option value="1"  @if(request('department')) selected @endif>IS</option>
                            <option value="2" @if(request('department')) selected @endif>IT</option>
                        </select>
                        </div>
                        <div class="col-md-4">
                        <label for="">Gender <b></b></label>
                        <select name="gender" id="gender" class="form-control" @if(request('gender')) selected @endif>
                            <option value="">Select</option>
                            <option value="0" {{$class->gender == '0' ? 'selected' : '' }} @if(request('gender')) selected @endif>Male</option>
                            <option value="1" {{$class->gender == $classstudentreport_single->gender ? 'selected' : '' }} @if(request('gender')) selected @endif>Female</option>
                        </select>
                        </div>
                           
                        <div class=" pull-right " style="margin-top:10px" >
                        <button type="submit" class="btn btn-dark btn-round"><i class="fa fa-search"></i>search</button>
                        </div>

                        </form>
                    </div>
                   

                    @if(isset($classstudentreport))
                    <hr>
                    <b>Student Report</b>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Roll No</th>
                          <th>Student Name</th>
                          <th>Father Name</th>
                          <th>Gender</th>
                          <th>Date of Birth</th>
                          <th>Mobile Number</th>
                          <th>Passport Number</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($classstudentreport as $classstudent)
                        <tr>
                        <td>{{ $classstudent->username }}</td>
                        <td><a href="{{route('admissions.show', $classstudent->id)}}">{{ $classstudent->first_name. ' ' .$classstudent->last_name }}</a></td>
                        <td>{{ $classstudent->father_name }}</td>
                        <td>@if($classstudent->gender == 0) Male @else Female @endif</td>
                        <td>{{date('Y/m/d', strtotime($classstudent->dob))}}</td>
                        </td>
                        <td class="text-right">{{$classstudent->phone}}</td>
                        <td class="text-right">{{ $classstudent->passport}}</td>
                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                    @endif