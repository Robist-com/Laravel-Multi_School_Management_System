@extends('layouts.app')

@section('content')


<style>

    input[readonly], textarea{
       background: white !important;
       border: none;
    }
    span{
        padding-left: 20px;
    }
    </style>


    <section class="content-header">
    <a  class="pull-left btn btn-danger" href="{{route('teachers.index')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>
    </section> 
    <div class="content">
    <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       {{ $teacher->last_name }} profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

                {{-- THIS IS THE IMAGE CODE START HERE --}}
                <img class="profile-user-img img-responsive img-circle"
                src="{{ asset('teacher_images/' .$teacher->image ) }}"
                width="50" height="50" style="border-radius:50%;
                width:150px; height:150px; vartical-align:middle;"
                 alt="Teacher profile 	picture">
                {{-- IMAGE CODE END HERE OKAY --}}

              <h3 class="profile-username text-center">{{$teacher->first_name}} {{$teacher->last_name}}</h3>

              <p class="text-muted text-center">Teacher</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">

          <div class="tabbable boxed parentTabs">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab"><i class="fa fa-calendar fa-lg"></i> TimeTable</a></li>
              <li><a href="#timeline" data-toggle="tab"><i class="fa fa-gear fa-lg"></i> Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="activity">
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
                <div class="tab-pane fade" id="timeline">
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
                                 <span> Male </span>
                                  @else
                                   <span> Female </span>
                                  @endif
                              </div>

                                  <label for="inputName" class="col-sm-2 control-label">Status</label>

                                  <div class="col-sm-3">
                                    <p> @if($teacher->status == 0)
                                          Single
                                          @else Marriged
                                        @endif
                                      </p>
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
                                    <button class="btn btn-primary btn-lg"><i class="fa fa-refresh"></i>Update Profile</button>
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

                            <footer>
                              <button class="btn btn-primary"> Change Password</button>
                            </footer>
                          </form>
                      </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
            </div>
        </div>
    {{-- </div> --}}
@endsection
