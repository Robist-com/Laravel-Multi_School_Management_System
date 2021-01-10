   <!-- page content -->
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                  <div class="count">{{$schoolsCount}}</div>
                  <h3>Schools</h3>
                  <span class="info-box-text alert "><a href="{{url('all/student/list')}}" data-toggle="tooltip" data-placement="top" title="Click to view all students">view students </a></span>
                </div>
              </div>

              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count">{{ $StaffusersCount }}</div>
                  <h3>Staffs</h3>
                  <span class="info-box-text alert "><a href="{{route('users.index')}}" data-toggle="tooltip" data-placement="top" title="Click to view all promote students">view staffs</a></span>
                </div>
              </div>

              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count">{{$teachersCount}}</div>
                  <h3>Teachers</h3>
                  <span class="info-box-text alert " ><a href="{{route('teachers.index')}}" data-toggle="tooltip" data-placement="top" title="Click to view all students">view teachers </a></span>
                </div>
              </div>
              
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">{{$current_session_repeated_students}}</div>
                  <h3>Repeated</h3>
                  <span class="info-box-text alert " ><a href="{{route('teachers.index')}}" data-toggle="tooltip" data-placement="top" title="Click to view current student repeating ">view repeat students of session {{date('Y')}}</a></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registered schools</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                    <ul class="nav nav-pills my-3" >
                      <li class="active "><a data-toggle="pill" href="#home">Active Schools</a></li>
                      
                      <li><a data-toggle="pill" href="#menu2">Inactive Schools</a></li>
                    </ul>

                    <div class="tab-content" style="margin-top: 10px">
                      <div id="home" class="tab-pane fade in active">
                        {{-- <h3>ACTIVE</h3> --}}
                          <table class="table table-striped jambo_table bulk_action text-left" style="text-align: center !important">
                            <thead>
                              <tr>
                                <th>N <sup>o</sup></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                              </tr>
                              <tbody >
                                @foreach ($activeschools as $key => $active)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td style="text-align: left">{{ $active->name }}</td>
                                    <td style="text-align: left">{{ $active->email }}</td>
                                    <td style="text-align: left">{{ $active->address }}</td>
                                    <td style="text-align: left">
                                      <div class="btn-group">
                                        <button class="btn btn-sm btn-info"> <a href="#" style="color: #fff"> <i class="fa fa-envelope"></i> Send</a></button>
                                        <button class="btn btn-sm btn-primary"> <a href="{{ route('school.show', $active->school_id) }}" style="color: #fff"> <i class="fa fa-email"></i> Show </a></button>
                                        <button class="btn btn-sm btn-danger"> <a href="#" style="color: #fff"> <i class="fa fa-unlock"></i> unlock </a></button>
                                      </div>
                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </thead>
                          </table>
                      </div>
                      
                      <div id="menu2" class="tab-pane fade">
                        {{-- <h3>INACTIVE</h3> --}}
                       <table class="table table-striped jambo_table bulk_action text-left" style="text-align: center !important">
                            <thead>
                              <tr>
                                <th>N <sup>o</sup></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                              </tr>
                              <tbody >
                                @foreach ($inactiveschools as $key => $inactive)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td style="text-align: left">{{ $inactive->name }}</td>
                                    <td style="text-align: left">{{ $inactive->email }}</td>
                                    <td style="text-align: left">{{ $inactive->address }}</td>
                                    <td style="text-align: left">
                                      <div class="btn-group">
                                        <button class="btn btn-sm btn-info"> <a href="{{ route('school.show', $inactive->school_id) }}" style="color: #fff"> <i class="fa fa-envelope"></i> Send </a></button>
                                        <button class="btn btn-sm btn-primary"> <a href="{{ route('school.show', $inactive->school_id) }}" style="color: #fff"> <i class="fa fa-email"></i> Show </a></button>
                                        <button class="btn btn-sm btn-danger"> <a href="{{ route('school.show', $inactive->school_id) }}" style="color: #fff"> <i class="fa fa-unlock"></i> unlock </a></button>
                                      </div>
                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </thead>
                      </table>
                      </div>
                    </div>

                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                      <div>
                        <div class="x_title">
                          <h2>Top Profiles</h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                              </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">
                            @foreach($top_staff as $top)
                          <li class="media event">
                            <a class="pull-left border-aero profile_thumb">
                              <i class="fa fa-user1 aero"><img src="{{ asset('teacher_images/' .$top->image) }}"class="img-circle profile_img " ></i>
                            </a>
                            <div class="media-body">
                              <a class="title" href="#">@if($top->gender == 0)Mr. {{$top->first_name . ' ' . $top->last_name}} @else Ms. {{$top->first_name . ' ' . $top->last_name}} @endif </a>
                              <p><strong>$2300. </strong> Agent Avarage Sales </p>
                              <p> <small>12 Sales Today</small>
                              </p>
                            </div>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="row">
            <div class="col-md-7 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{date('F')}} Month Attendance Chart </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="mainb" style="height:300px;"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-5 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 3 Months Attendance Chart </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="echart_mini_pie" style="height:300px;"></div>

                  </div>
                </div>
              </div>
          </div>
          </div>

          <table class="table" id="admissions-table">
          <thead>
          <th class="column-title">Student </th>
          <th class="column-title">Exam </th>
          <th class="column-title">Subject </th>
          <th class="column-title">Class </th>
          <th class="column-title">Status </th>
          <th class="column-title">Grade </th>
          </thead>
          <tbody>
          <tr>
          @foreach($studentAdmission as $key => $repeat)
           <td class=" " data-toggle="tooltip" data-placement="top" title="{{$repeat->country . ' '  . $repeat->count}}">{{$repeat->country}}</td>
           @endforeach
          </tr>
          </tbody>
         
          </table>

          
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Repeated Students List</h3>
                  </div>
                  <div class="col-md-3 pull-right">
                  <h2>Repeated Students Chart</h2>
                  </div>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="table-responsive">
                @if($current_session_repeated_students > 0)
                      <table class="table table-striped jambo_table bulk_action">
                      <!-- <table id="datatable-buttons" class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable-buttons_info" style="width: 690px;"> -->
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Student </th>
                            <th class="column-title">Exam </th>
                            <th class="column-title">Subject </th>
                            <th class="column-title">Class </th>
                            <th class="column-title">Status </th>
                            <th class="column-title">Grade </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="even pointer">
                           
                            @foreach($repeated_students as $key => $repeat)
                            <!-- <td class=" " data-toggle="tooltip" data-placement="top" title="{{$repeat->first_name . ' '  . $repeat->last_name}}">{{$repeat->roll_no}}</td>
                            <td class=" " data-toggle="tooltip" data-placement="top" title="{{$repeat->batch}}">{{$repeat->type}}</td>
                            <td class=" " data-toggle="tooltip" data-placement="top" title="{{$repeat->subject_code}}">{{$repeat->subject_name}}</td>
                            <td class=" " data-toggle="tooltip" data-placement="top" title="{{$repeat->class_code}}">{{$repeat->class_name}}</td>
                            <td class=" text-red" data-toggle="tooltip" data-placement="top" title="student need to repeat {{$repeat->subject_name}} subject to able to promote to next grade!">@if($repeat->grade == 'F') <label class="label label-danger">Fail</label> @endif</td>
                            <td class=" ">{{$repeat->grade_name}}</td>
                            <td class=" "><a href="#" class="fa fa-mobile"></a></td> -->
                            @endforeach
                          </tr>
                      </tbody>
                    </table>
                    @else
                      <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
                      <h2 style="margin-left:190px">No Repeated Student Yet for  Session!</h2>
                    </div>
                    @endif
                </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 bg-white">
                  <!-- <div class="x_title">
                   
                    <div class="clearfix"></div>
                  </div> -->

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    
                  <div id="echart_pie2" style="height:350px;"></div>
                  </div>
                <div class="clearfix"></div>
                </div>

              <div class="clearfix"></div>
              </div>
              </div>

              </div>
              <br />
          