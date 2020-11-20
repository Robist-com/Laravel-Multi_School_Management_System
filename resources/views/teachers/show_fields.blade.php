<!-- page content -->
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Profile</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <a class="btn btn-dark btn-round " href="{{url()->previous()}}"><i class="fa fa-arrow-left m-right-xs"></i> Return</a>
                         <!-- <a  class="btn-dark btn-round"><i class="fa fa-arrow-left"></i> </a> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="{{ asset('teacher_images/' .$teacher->image ) }}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3>{{$teacher->first_name}} {{$teacher->last_name}}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> Teacher
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="http://www.kimlabs.com/profile/" target="_blank">{{$teacher->email}}</a>
                        </li>
                      </ul>

                      <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />

                      <!-- start skills -->
                      <h4>Skills</h4>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p>Web Applications</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </li>
                        <li>
                          <p>Website Design</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                          </div>
                        </li>
                        <li>
                          <p>Automation & Testing</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                          </div>
                        </li>
                        <li>
                          <p>UI / UX</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </li>
                      </ul>
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <!--  -->

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Time Table</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Settings</a>
                          </li>
                          <!-- <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                          </li> -->
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <div class="tabbable">
                
                @include('teachers.timetable.semester-tabs.tabs-header')
           
                  <div class="tab-content">
                      {{-- semester 1 tab --}}
                      @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '1') 
                    <div id="menu0" class="active tab-pane in fade">
                      <h3 style="font-weight:bold; color:red">GRADE 1</h3>
                      <hr class="line">
                      @include('teachers.timetable.semester-tabs.semester1')
                    </div>
                    @endif
                    @endforeach
                      {{-- semester 2 tab --}}
                      @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '2')
                      <div id="menu1" class=" tab-pane fade">
                      <h3 style="font-weight:bold; color:red">GRADE 2</h3>
                      <hr class="line">
                      @include('teachers.timetable.semester-tabs.semester2')
                    </div>
                    @endif
                    @endforeach
                     {{-- semester 3 tab --}}
                     @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '3')
                     <div id="menu2" class=" tab-pane fade">
                      <h3 style="font-weight:bold; color:red">GRADE 3</h3>
                      <hr class="line">
                      @include('teachers.timetable.semester-tabs.semester3')
                    </div>
                    @endif
                    @endforeach
                      {{-- semester 4 tab --}}
                      @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '4')
                      <div id="menu3" class=" tab-pane fade">
                        <h3 style="font-weight:bold; color:red">GRADE 4</h3>
                        <hr class="line">
                        @include('teachers.timetable.semester-tabs.semester4')
                      </div>
                      @endif
                    @endforeach
                        {{-- semester 5 tab --}}
                        @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '5')
                     <div id="menu4" class=" tab-pane fade">
                      <h3 style="font-weight:bold; color:red">GRADE 5</h3>
                      <hr class="line">
                      @include('teachers.timetable.semester-tabs.semester5')
                    </div>
                    @endif
                    @endforeach
                      {{-- semester 6 tab --}}
                      @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '6')
                      <div id="menu5" class=" tab-pane fade">
                        <h3 style="font-weight:bold; color:red">GRADE 6</h3>
                        <hr class="line">
                        @include('teachers.timetable.semester-tabs.semester6')
                      </div>
                      @endif
                    @endforeach
                        {{-- semester 7 tab --}}
                        @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '7')
                     <div id="menu6" class=" tab-pane fade">
                      <h3 style="font-weight:bold; color:red">GRADE 7</h3>
                      <hr class="line">
                      @include('teachers.timetable.semester-tabs.semester7')
                    </div>
                    @endif
                    @endforeach
                      {{-- semester 8 tab --}}
                      @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '8')
                      <div id="menu7" class=" tab-pane fade">
                        <h3 style="font-weight:bold; color:red">GRADE 8</h3>
                        <hr class="line">
                        @include('teachers.timetable.semester-tabs.semester8')
                      </div>
                      @endif
                    @endforeach
                    {{-- semester 9 tab --}}
                      @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '9')
                      <div id="menu8" class=" tab-pane fade">
                        <h3 style="font-weight:bold; color:red">GRADE 9</h3>
                        <hr class="line">
                        @include('teachers.timetable.semester-tabs.semester9')
                      </div>
                      @endif
                    @endforeach
                    {{-- semester 10 tab --}}
                      @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '10')
                      <div id="menu9" class=" tab-pane fade">
                        <h3 style="font-weight:bold; color:red">GRADE 10</h3>
                        <hr class="line">
                        @include('teachers.timetable.semester-tabs.semester10')
                      </div>
                      @endif
                    @endforeach
                    {{-- semester 11 tab --}}
                      @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '11')
                      <div id="menu10" class=" tab-pane fade">
                        <h3 style="font-weight:bold; color:red">GRADE 11</h3>
                        <hr class="line">
                        @include('teachers.timetable.semester-tabs.semester11')
                      </div>
                      @endif
                    @endforeach
                    {{-- semester 12 tab --}}
                      @foreach($enable_grade as $grade) 
                      @if($grade->status == 'on' && $grade->id == '12')
                      <div id="menu11" class=" tab-pane fade">
                        <h3 style="font-weight:bold; color:red">GRADE 12</h3>
                        <hr class="line">
                        @include('teachers.timetable.semester-tabs.semester12')
                      </div>
                      @endif
                    @endforeach
                  </div>
                </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                      <!-- start user projects -->
                      <div class="tabbable">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#detail" data-toggle="tab">Update Profile</a>
                        </li>
                        <li><a href="#changepassword" data-toggle="tab">Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                      <div id="detail" class="active tab-pane in fade">
                        <h3 style="font-weight:bold; text-transform:uppercase; color:red"> DETAILS</h3>
                        <hr class="line">
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 control-label">Full Name</label>

                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputName"
                          value="{{$teacher->first_name}} {{$teacher->last_name}}" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail" class="col-sm-3 control-label">Email</label>

                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEmail"
                            value="{{$teacher->email}}" readonly>
                          </div>
                        </div>

                        <div class="form-group col-sm-12">
                              <div class="row">
                          <label for="inputName" class="col-sm-3 control-label">Gender</label>

                          <div class="col-sm-4">
                              @if($teacher->gender == 0)
                             <label for="">Male</label>
                              @else
                               <label for="">Female</label>
                              @endif
                          </div>

                              <label for="inputName" class="col-sm-2 control-label">Status</label>

                              <div class="col-sm-3">
                                   @if($teacher->status == 0)
                                      <label for="">Single</label>
                                      @else 
                                      <label for="">Marriged</label>
                                    @endif
                              </div>
                            </div>
                          </div>
                        <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Date of Birth</label>

                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName"
                                value="{{date('Y-M-d', strtotime($teacher->dob))}}" readonly>
                              </div>
                            </div>
                            <div class="form-group">
                                  <label for="inputName" class="col-sm-3 control-label">Phone No.</label>

                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputName"
                                    value="+{{$teacher->phone}}" readonly>
                                  </div>
                                </div>
                                <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">Passport No.</label>

                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="inputName"
                                  value="{{$teacher->passport}}" readonly>
                                 </div>
                                </div>
                        <div class="form-group">
                          <label for="inputExperience" class="col-sm-3 control-label" >Address</label>

                          <div class="col-sm-9">
                            <textarea class="form-control" id="inputExperience" readonly>{{$teacher->address}}</textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputSkills" class="col-sm-3 control-label">Nationality</label>

                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputSkills"
                            value="{{$teacher->nationality}}" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                              <label for="inputSkills" class="col-sm-3 control-label">Register Date</label>

                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputSkills"
                                 value="{{date("y-M-d", strtotime ($teacher->dateregistered))}}" readonly>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputSkills" class="col-sm-3 control-label">Image</label>

                              <div class="col-sm-9">
                                <input type="file" class="form-control" id="inputSkills">
                              </div>
                            </div>

                              <div class="col-sm-9 pull-right">
                                <button class="btn  btn-dark btn-round "><i class="fa fa-refresh"></i>Update Profile</button>
                              </div>
                      </form>
                    </div>
                    <div id="changepassword" class=" tab-pane fade">
                      <h3 style="font-weight:bold; text-transform:uppercase; color:red">change password</h3>
                        <hr class="line">
                      <form action="#" method="post">
                        <div class="col-md-12">
                          <input type="text" name="" id="" class="form-control"><br>
                        </div>

                        <div class="col-md-12">
                          <input type="text" name="" id="" class="form-control"><br>
                        </div>
                        <div class="col-md-12">
                          <input type="text" name="" id="" class="form-control"><br>
                        </div>

                        <div class="modal-footer">
                          <button class="btn btn-dark btn-round"> Change Password</button>
                        </div>
                      </form>
                  </div>
                </div>
                            <!-- end user projects -->

                          </div>
                          <!-- <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                              photo booth letterpress, commodo enim craft beer mlkshk </p>
                          </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
        <!-- /page content -->