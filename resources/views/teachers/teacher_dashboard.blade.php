@php 

use App\models\ClassSchedule;

$id = Auth::user()->teacher_id;
$students_in_charge_total = ClassSchedule::join('admissions', 'admissions.class_code', '=', 'class_schedule.class_id')
                                        ->where('class_schedule.teacher_id', $id)->count();

$class_in_charge_total = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                        ->where('class_schedule.teacher_id', $id)->count();

@endphp

@include('dashboard_style')

    <section class="content-header">
    <div class="panel">
    <div class="panel-body">
    <h4 class="pull-left" id="dashbaord"><i class="glyphicon glyphicon-dashboard" aria-hidden="true"></i>{{Auth::user()->name}}'<sup>s</sup> Dashboard</h4>

    </div>
    </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

            <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
    <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-education"></i>2</span>

    <div class="info-box-content">
    <span class="info-box-text alert "><a href="{{url('teacher/gradesheet')}}"> RESULTS</a></span>
     </div>
         <!-- /.info-box-content -->
     </div>
    <!-- /.info-box -->
    </div>
    <!-- /.col -->

      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-user"></i>{{$students_in_charge_total}}</span>

          <div class="info-box-content">
            <span class="info-box-text alert " ><a href="{{url('studentsincharge')}}"> STUDENTS IN CHARGE</a></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-equalizer"></i>{{$class_in_charge_total}}</span>

          <div class="info-box-content">
            <span class="info-box-text alert "><a  href="{{url('classincharge')}}"> CLASS IN CHARGE</a></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-fuchsia"><i class="glyphicon glyphicon-sound-dolby">3</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "><a  href="{{url('enter-subject-detail')}}"> ASSIGNED SUBJECT</a></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-gray"><i class="glyphicon glyphicon-random" >5</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "><a  href="{{url('mark/entry')}}"> ENTER MARKS</a></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->




      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-purple"><i class="glyphicon glyphicon-blackboard">2</i></span>

          <div class="info-box-content">
            <span class="info-box-text alert "> CLASSESE</span>
            <span class="info-box-number"></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-teal"><i class="glyphicon glyphicon-calendar">4</i></span>

          <div class="info-box-content">
          <span class="info-box-text alert "><a  href="{{url('mark-teacher-attendance')}}"> ATTENDANCE</a></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-tasks">2</i></span>
          <div class="info-box-content">
          <span class="info-box-text alert "><a  href="{{url('generate-teacher-timetable')}}"> TIMETABLE</a></span>

          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-tasks">2</i></span>
          <div class="info-box-content">
          <span class="info-box-text alert "><a  href="{{url('send-class-homework')}}"> Home Works</a></span>

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
        <div class="text-center">

        </div>
    </div>


   <!-- Main content -->
   <!-- <section class="content"> -->
    <!-- Info boxes -->

