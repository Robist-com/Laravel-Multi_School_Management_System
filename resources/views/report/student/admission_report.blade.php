
@php
use Carbon\Carbon;
$now = Carbon::now();
$year = $now->year;
$month = $now->month;
$week =  $now->weekOfYear;
$lastweek = \Carbon\Carbon::today()->subDays(7);

@endphp
<hr>
                      <!-- <div class="col-md-4">
                        <p>Date Range Picker with opening to right and left</p>
                      </div>
                      <div class="col-md-4">
                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                          <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>
                      </div> -->
                    <!-- </div> -->

<!-- {{$week }} -->
<!-- {{$month }}
{{$year }}
{{$lastweek }}
{{now()->subWeek()->startOfWeek()}} -->

                    <strong>Select Criteria</strong>
                    <hr>
                    <div class="row">
                       <form action="{{route('postadmissionReport')}}" method="POST">
                           @csrf

                           @if(auth()->user()->group == "Admin")
                        <div class="col-md-12">
                            <label for="">School <b style="color:red">*</b></label>
                        <select name="school_id" id="school_id" class="form-control">
                            <option value="">Select</option>
                            @foreach(auth()->user()->school->all() as $school)
                            <option value="{{$school->id}}" @if(isset($school)){{$school->id == request('school_id') ? 'selected' : '' }} @endif>{{$school->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <br>
                          <br>
                        @endif

                        <div class="col-md-5">
                        <label for="">Admission Date<b style="color:red">*</b></label>
                        <select name="admission_date" id="admission_date" class="form-control">
                        <option value="" selected="true">Select</option>
                        <option value="{{$now }}">Today</option>
                        <option value="{{date('Y', strtotime($week))}}">This Week</option>
                        <option value="{{$lastweek }}">Last Week</option>
                        <option value="{{$month}}" >This Month</option>
                        <option value="{{$year}}" >This Year</option>
                        </select>
                        </div>
                           
                        <div class=" pull-right " style="margin-top:25px" >
                        <button type="submit" class="btn btn-dark btn-round"><i class="fa fa-search"></i>search</button>
                        </div>

                        </form>
                    </div>
                   

                    @if(isset($studentacademicreport))
                    <hr>
                    <b>Admission Report</b>
                    <hr>
                    <div class="responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Roll No</th>
                          <th>Student Name</th>
                          <th>Admission Date</th>
                          <th>Session</th>
                          <th>Class</th>
                          <!-- <th>Mobile Number</th> -->
                          <!-- <th>Passport Number</th> -->
                          <th>Father Name</th>
                          <th>Father Mobile</th>
                          <th>Mother Name</th>

                        </tr>
                      </thead>


                      <tbody>
                      @foreach($admissionReport as $classstudent)
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