  @php
      use App\Http\Controllers\Controller;
      use App\Roll;
      use App\Models\Admission;
      $students = Roll::onlineStudent();
  @endphp

 
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        @if(isset($students))
        <img src="{{asset('student_images/' .$students->image)}}" style="width:170px; height:70px" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{$students->first_name}} {{$students->last_name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        @endif
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ Request::is('account*') ? 'active' : '' }}">
          <a href="{{url('account')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

        </li>
        <li class="treeview">
          <a href="#">
         
            <i class="fa fa-user"></i>
            <span>Profile</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="{{ Request::is('student-biodata*') ? 'active' : '' }}">
            <li><a href="{{url('/student-biodata')}}"><i class="fa fa-circle-o"></i>Biodata</a></li>
            </li>
          </ul>
        </li>
        <li>
        <li class="{{ Request::is('student-timetable*') ? 'active' : '' }}">
        <a href="{{url('student-timetable')}}">
            <i class="fa fa-th"></i> <span>Time Tables</span>
          </a>
          </li>
        </li>
        <li><a href="{{url('student-class-homework')}}"><i class="fa fa-circle-o"></i>Home Works</a></li>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Lectures</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          {{-- we will make all this routes okay --}}
          <ul class="treeview-menu">
            <li><a href="{{url('student-class-homework')}}"><i class="fa fa-circle-o"></i>Home Works</a></li>
            <li><a href="{{url('student-choose-course')}}"><i class="fa fa-circle-o"></i> Choose Course</a></li>
            <li><a href="{{url('student-lecture-calendar')}}"><i class="fa fa-circle-o"></i> Academic Calendar</a></li>
            <li><a href="{{url('student-lecture-activity')}}"><i class="fa fa-circle-o"></i> Semester Activity</a></li>
          </ul>
        </li> -->
        <li class="treeview">
            <a href="#">
              <i class="fa fa-money"></i>
              <span>Transaction</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            <li class="{{ Request::is('student-transaction*') ? 'active' : '' }}">
              <li><a href="{{url('student-transaction')}}"><i class="fa fa-circle-o"></i> Fee Transaction</a></li>
              </li>
            </ul>
          </li>
          
        <li>
        <li class="{{ Request::is('student-exam-marks*') ? 'active' : '' }}">
        <a href="{{url('student-exam-marks')}}"><i class="fa fa-circle-o"></i> Exam Marks</a>
        </li>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Results</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="{{ Request::is('student-exam-resul*') ? 'active' : '' }}">
          <li><a href="{{url('student-exam-result')}}"><i class="fa fa-circle-o"></i> Result</a></li>
          </li>
          </ul>
        </li>
@if(isset($students))
        @if($students->status == 1)
        <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>Transcript</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            <li class="{{ Request::is('student-transcript*') ? 'active' : '' }}">
              <li><a href="{{url('student-transcript')}}"><i class="fa fa-circle-o"></i> Transcript</a></li>
            </li>
            </ul>
          </li>
          @endif
          @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
