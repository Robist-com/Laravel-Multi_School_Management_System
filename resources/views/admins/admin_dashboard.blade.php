@include('dashboard_style')

    <section class="content-header">
    <div class="panel">
    <div class="panel-body">
    <h1 class="pull-left" id="dashbaord"><i class="fa fa-dashboard" aria-hidden="true"> Dashboard</i></h1>

    <div class="col-md-3 pull-right">
    <button class="btn btn-info" id="change_dashboard1"> Change Dashboard 1</button>
    </div>

    <div class="col-md-3 pull-right">
    <button class="btn btn-info" id="change_dashboard2"> Change Dashboard 2</button>
    </div>

     <div class="col-md-3 pull-right">
     <a href="inboxes"><button class="btn btn-info">inbox</button></a>
     <a href="{{url('online/students')}}"><button class="btn btn-info">Online</button></a>
    </div>

    {{-- <div class="col-md-3 pull-right">
      <a href="online/students"><button class="btn btn-info">Online</button></a>
     </div> --}}

    </div>
    </div>
    </section>

@include('admins.admin_dashboard2')
   

    <div class="content">
        <div class="clearfix"></div>



        <div class="clearfix"></div>
        <div class="box box-primary" id="dasboard1">
        <div class="box-body">

    <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
    <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-file"></i>New</span>

    <div class="info-box-content">
    <span class="info-box-text alert "><a href="{{route('admissions.index')}}"> ADMISSIONS</a></span>
     </div>
     
         <!-- /.info-box-content -->
     </div>
    <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
    <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-education"></i>{{$studentsCount}}</span>

    <div class="info-box-content">
    <span class="info-box-text alert "><a href="{{url('all/student/list')}}"> STUDENTS</a></span>
     </div>
     
         <!-- /.info-box-content -->
     </div>
    <!-- /.info-box -->
    </div>
    <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-user"></i>{{$teachersCount}}</span>

          <div class="info-box-content">
            <span class="info-box-text alert " ><a href="{{route('teachers.index')}}"> TEACHERS</a></span>
            <!-- <span class="info-box-number">{{$teachersCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-equalizer"></i>{{$facultyCount}}</span>

          <div class="info-box-content">
            <span class="info-box-text alert "><a  href="{{route('PromoteStudents')}}"> PROMOTO STUDENT</a></span>
            <!-- <span class="info-box-number">{{$facultyCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-equalizer"></i>{{$facultyCount}}</span>

          <div class="info-box-content">
            <span class="info-box-text alert "><a  href="{{route('faculties.index')}}"> STUDENT GROUP</a></span>
            <!-- <span class="info-box-number">{{$facultyCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-fuchsia"><i class="glyphicon glyphicon-sound-dolby">{{$departmentCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "><a  href="{{route('departments.index')}}"> CLASS GROUP</a></span>
            <!-- <span class="info-box-number">{{$departmentCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-gray"><i class="glyphicon glyphicon-random" >{{$semesterCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "><a  href="{{route('semesters.index')}}"> GRADES</a></span>
            <!-- <span class="info-box-number">{{$semesterCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-usd">{{$feeCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "><a  href="{{url('view/fee/collection')}}"> FEES</a></span>
            <!-- <span class="info-box-number">{{$batchCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-lighten-1"><i class="glyphicon glyphicon-flash">{{$feeStructureCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "><a style="color:black" href="#"> FEE STRUCTURE</a></span>
            <span class="info-box-number"></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-olive"><i class="glyphicon glyphicon-usd">{{$batchCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert ">SALARIES</span>
            <!-- <span class="info-box-number">{{$batchCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-lime"><i class="glyphicon glyphicon-refresh">{{$batchCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert"><a href="{{route('transactions.index')}}">TRANSACTIONS</a> </span>
            <!-- <span class="info-box-number"></span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-maroon"><i class="glyphicon glyphicon-compressed">{{$batchCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "> BATCHES</span>
            <span class="info-box-number"></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-purple"><i class="glyphicon glyphicon-blackboard">{{$classCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "> CLASSESE</span>
            <span class="info-box-number"></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-maroon"><i class="glyphicon glyphicon-signal">{{$levelCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "> LEVELS</span>
            <span class="info-box-number"></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-darken-4"><i class="glyphicon glyphicon-option-horizontal">{{$dayCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "> DAY'S</span>
            <!-- <span class="info-box-number"></span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-orange"><i class="glyphicon glyphicon-retweet">{{$shiftCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "> SHIFTS</span>
            <!-- <span class="info-box-number">{{$shiftCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-navy"><i class="glyphicon glyphicon-time">{{$timeCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "> TIME'S</span>
            <!-- <span class="info-box-number">{{$timeCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for sm devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-black"><i class="glyphicon glyphicon-home">{{$classroomCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "> Class Rooms</span>
            <!-- <span class="info-box-number">{{$classroomCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-teal"><i class="glyphicon glyphicon-calendar">{{$classschedulCount}}</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert ">CLASS SCHEDULE'S</span>
            <!-- <span class="info-box-number">{{$classschedulCount}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-tasks"></i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "> CLASS ASSIGNED'S</span>
            <!-- <span class="info-box-number"></span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

            </div>
        </div>

    </div>


   <!-- Main content -->
   <!-- <section class="content"> -->
    <!-- Info boxes -->

