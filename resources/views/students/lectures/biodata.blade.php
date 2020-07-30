@extends('layouts.frontLayout.app')

@section('content')

<style>

 input[readonly], textarea{
    background: white !important;
    border: none;
 }
 span{
     padding-left: 20px;
 }
 .input-icon{
   position: absolute;
   right: 3px;
   top: calc(50% - 0.5em); // this will bring our message inside the input field okay.
 }

 .input-wrapper{
   position: relative;
 }
/* .input-icon{
  position: absolute;
  right: 3px;
  top: calc(50% - 0.5em); Keep icon in center of input, regardless of the input height */
}
/* input{
  padding-left: 17px;
}
.input-wrapper{
  position: relative;
} */

 </style>

        <section class="content-header">
          <h1 class="label label-primary" style="text-transform:uppercase">
            {{$students->last_name}} Profile
          </h1>

          <ol class="breadcrumb">
            <li><a href="{{url('home')}}}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">User profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    @include('flash::message')
        @include('adminlte-templates::common.errors')
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="{{ asset('student_images/' .$students->image ) }}"
                  width="50" height="50" style="border-radius:50%; width:150px; height:150px; vartical-align:middle;" alt="students profile picture">

                  <h3 class="profile-username text-center">{!! $students->first_name !!} {!! $students->last_name !!}</h3>

                  <p class="text-muted text-center">students</p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                     <h3 class="label label-warning"> {{$students->semester_name}}</h3>
                    </li>
                    <li class="list-group-item">
                        <h3 class="label label-info"> {{$students->faculty_name}}</h3>
                    </li>
                    <li class="list-group-item">
                        <h3 class="label label-primary"> {{$students->department_name}}</h3>
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

                  <p class="text-muted">{!! $students->address !!}</p>

                  <hr>

                  <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                  <p>
                    <span class="label label-danger">UI Design</span>
                    <span class="label label-success">Coding</span>
                    <span class="label label-info">Javascript</span>
                    <span class="label label-warning">PHP</span>
                    <span class="label label-primary">Node.js</span>
                  </p>

                  {{-- <hr> --}}

                  {{-- <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> --}}
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab"><span class="fa fa-calendar"></span> Time Table</a></li>
                  <li><a href="#full-detail" data-toggle="tab"><span class="fa fa-user"></span> Personal Details</a></li>
                  <li><a href="#class-detail" data-toggle="tab"><span class="fa fa-board"></span> Academic Details</a></li>
                  <li><a href="#settings" data-toggle="tab"><span class="fa fa-settings"></span> Settings</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  {{-- <section class="content-header">
                  <h1 class="label label-primary">
                     Time Table
                  </h1>
                  </section> --}}
                  <div class="content">
               <div class="box box-primary">

               <div class="box-body">
                <div class="row">
                    @include('students.timetable.schedule')
                  </div>
                  </div>
                </div>
               </div>
              </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="full-detail">

                  {{-- <section class="content-header">
                  <h1 class="label label-primary">
                    profile
                  </h1>
                  </section> --}}
                  <div class="content">
               <div class="box box-primary">

               <div class="box-body">
                <div class="row">
                   @include('students.persional-detail')
                  </div>
                </div>
                </div>
                </div>
               </div>

                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="class-detail">

                    {{-- <section class="content-header">
                    <h1 class="label label-primary">
                      Academic Details
                    </h1>
                    </section> --}}
                    <div class="content">
                 <div class="box box-primary">

                 <div class="box-body">
                  <div class="row">

                      <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-3 control-label">Grade</label>

                            <div class="col-sm-6">
                              <input type="email" class="form-control" id="inputEmail"
                              value="{{$students->semester_name}}" readonly>
                            </div>
                          </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 control-label">Class</label>

                          <div class="col-sm-6">
                            <input type="email" class="form-control" id="inputName"
                          value="{{$students->class_name}}" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputName" class="col-sm-3 control-label">Session</label>
                          <div class="col-sm-4">
                            <input type="email" class="form-control" id="inputEmail"
                            value="{{$students->batch}}" readonly>
                          </div>
                      </div>
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Student Group</label>
                              <div class="col-sm-4">
                                <input type="email" class="form-control" id="inputEmail"
                                        value="{{$students->faculty_name}}" readonly>
                        </div>
                          </div>
                        <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Subjcet Group</label>
                              <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputName"
                                value="{{$students->department_name}}" readonly>
                              </div>
                            </div>
                      </form>
                    </div>
                  </div>
                  </div>
                  </div>
                 </div>

                    <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                  <section class="content-header">
                  <h1 class="label label-primary">
                      Change Password
                  </h1>
              </section>
              <div class="content">
                @include('adminlte-templates::common.errors')
               <div class="box box-primary">

               <div class="box-body">
                <div class="row">

                    <form action="{{url('student-update-password')}}" class="form-horizontal" method="post">
                      @csrf
                      {{-- we will use the ajax function we just making for testing okay. --}}
                      <div class="form-group">
                      <input type="hidden" name="email" id="" value="{{$students->email}}">
                            <label for="inputName" class="col-sm-3 control-label">Old Password</label>
                            <div class="col-sm-9">
                            <div class="input-wrapper">
                              <input type="text" value="" class="form-control" name="old_password" id="oldpassword"  autocomplete="off" value="{{ old('old_password')}}">
                              <i class="input-icon" id="messageError"></i>
                              {{-- this is the message id what we will use okay --}}
                              {{-- we will make style okay --}}
                            </div>
                            </div>
                          </div>
                          <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="new_password" id="newpassword"  autocomplete="off" value="{{ old('new_password')}}" >
                                </div>
                              </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-info" >Update Password</button>
                                  </div>
                            </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          </div>
                </div>
               </div>
              </div>

        </section>
        <!-- /.content -->
      {{-- </div> --}}

      @endsection

      {{-- here we will write our jqeury okay --}}

      @section('scripts')
        <script>
        $(document).ready(function(){
          $("#oldpassword").keyup(function(){
            // we are using the keyup function to check our data if it's valid or not okay.
            var old_password = $("#oldpassword").val();
              // alert(old_password);
            $.ajax({
              type: 'get',
              url: '/varify-password',
              data: {old_password:old_password},
              success: function(response){
                // here we will write condition oaky.
                if(response == "false"){
                  $("#messageError").html("<font color='red'> <b>Password Incorrect</b> </font>");
                }else if(response == "true"){
                  $("#messageError").html("<font color='green'><b>Correct Password</b></font>");
                }
              }
            });

          });
        });

        // so this part is finish we will work on the update-password function part okay.

        // we will make one route call update password okay


        </script>
      @endsection
