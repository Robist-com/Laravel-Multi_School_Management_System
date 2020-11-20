<?php 

use App\models\ClassSchedule;
use App\models\Attendance;
use App\Marks;
$id = Auth::user()->teacher_id;
$students_in_charge_total = ClassSchedule::join('admissions', 'admissions.class_code', '=', 'class_schedule.class_id')
                                        ->where('admissions.acceptance','accept')
                                        ->where('admissions.school_id', auth()->user()->school_id)
                                        ->where('class_schedule.teacher_id', $id)->count();

$class_in_charge_total = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                        ->where('classes.school_id', auth()->user()->school_id)
                                        ->where('class_schedule.teacher_id', $id)->count();

$course_in_charge_total = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                                        ->where('courses.school_id', auth()->user()->school_id)
                                        ->where('class_schedule.teacher_id', $id)->count(); 

$no_exam_marks = Marks::join('batches', 'batches.id', '=', 'marks.session')
                            ->join('exam', 'exam.id', '=', 'marks.exam')->select('exam.type')
                            ->where('marks.school_id', auth()->user()->school_id)->first(); 



 $date = date('Y-m-d');
$current_year = date('Y');
$last_year = date('Y', strtotime("-1 year"));
$year_before_last = date('Y', strtotime("-2 year"));

// dd($date);
$current_month = date('F');
$last_month = date('F', strtotime("-1 month"));
$month_before_last_month = date('F', strtotime("-2 month"));
$month_before2_last_month = date('F', strtotime("-3 month"));

$attend_mark = Attendance::where('attendances.teacher_id', $id)->where('school_id', auth()->user()->school_id)->get(); 
$attend_mark1 = '';
foreach ($attend_mark as $key => $attend_mark) {
  $attend_mark1  =   $attend_mark->attendance_date;
}


?>

<div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <a href="{{url('studentsincharge')}}"><i class="material-icons">school</i></a>
                        </div>
                        <div class="content">
                            <div class="text">STUDENTS</div>
                            <div class="number count-to" data-from="0" data-to="{{$students_in_charge_total}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                        <a href="{{url('mark-teacher-attendance')}}"><i class="material-icons">event</i> view promote students</a>  
                        </div>
                        <div class="content" href="{{route('PromoteStudents')}}">
                            <div class="text">Attendance @if($attend_mark1 == $date)<b> Already Mark </b> @else <b style="color:red"> Not Mark Yet </b> @endif </div>
                            <div class="number count-to" data-from="0" data-to="190" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                   
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                           <a href="{{url('teacher/gradesheet')}}"> <i class="material-icons">forum</i></a>
                        </div>
                        <div class="content">
                            <div class="text">RESULTS</div>
                            <div class="number count-to" data-from="0" data-to="{{$current_session_repeated_students}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                        <a href="{{url('classincharge')}}"><i class="material-icons">person_outline</i></a>
                        </div>
                        <div class="content">
                            <div class="text">CLASS IN CHARGE</div>
                            <div class="number count-to" data-from="0" data-to="{{$class_in_charge_total}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-9 col-sm-6">
                                    <h2>Month of {{$current_month}} Attendance Chart</h2>
                                </div>
                                <div class="col-xs-9 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <a href="{{url('classincharge')}}"><i class="material-icons">person_outline</i></a>
                        </div>
                        <div class="content">
                            <div class="text">ASSIGNED SUBJECT</div>
                            <div class="number count-to" data-from="0" data-to="{{$course_in_charge_total}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect">
                        <div class="icon">
                           <a href="{{url('mark/entry')}}"><i class="material-icons">person_outline</i></a> 
                        </div>
                        <div class="content">
                            <div class="text">@if($no_exam_marks)<b style="color1:green"> {{$no_exam_marks->type}} Exam Marks</b> @else <b style="color:red">No Marks Yet</b> @endif</div>
                            <div class="number count-to" data-from="0" data-to="{{$studentsCount}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_outline</i>
                        </div>
                        <div class="content">
                            <div class="text">LIBRIANS</div>
                            <div class="number count-to" data-from="0" data-to="{{$studentsCount}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_outline</i>
                        </div>
                        <div class="content">
                            <div class="text">RECEPTIONIST</div>
                            <div class="number count-to" data-from="0" data-to="{{$studentsCount}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-pink">
                            <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                                 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                                 data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                                 data-fill-Color="rgba(0, 188, 212, 0)">
                                12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                            </div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    TODAY
                                    <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                                </li>
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                                </li>
                                <li>
                                    LAST WEEK
                                    <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-cyan">
                            <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    #socialtrends
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                                <li>
                                    #materialdesign
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                                <li>#adminbsb</li>
                                <li>#freeadmintemplate</li>
                                <li>#bootstraptemplate</li>
                                <li>
                                    #freehtmltemplate
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    TODAY
                                    <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST WEEK
                                    <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST MONTH
                                    <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST YEAR
                                    <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    ALL
                                    <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>TASK INFOS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Status</th>
                                            <th>Manager</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Task A</td>
                                            <td><span class="label bg-green">Doing</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Task B</td>
                                            <td><span class="label bg-blue">To Do</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Task C</td>
                                            <td><span class="label bg-light-blue">On Hold</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Task D</td>
                                            <td><span class="label bg-orange">Wait Approvel</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Task E</td>
                                            <td>
                                                <span class="label bg-red">Suspended</span>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>BROWSER USAGE</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>

          <!-- top tiles -->
          <div class="row tile_count">
          <!-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-graduation-cap"></i> {{__('dashboard_lang.students')}} </span>
              <div class="count">{{$students_in_charge_total}}</div>
              <a href="{{url('studentsincharge')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to student portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> View Students</span></a>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-calendar"></i> ATTENDANCE</span>
              <div class="count" style="font-size:18px"> @if($attend_mark1 == $date)<b> Already Mark </b> @else <b style="color:red"> Not Mark Yet </b> @endif </div>
              <a href="{{url('mark-teacher-attendance')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to attendance portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> View Attendance</span></a>
            </div> -->
            <!-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-fax"></i> RESULTS</span>
             
              <a href="{{url('teacher/gradesheet')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to result portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> View Results</span></a>
            </div> -->
            <!-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> CLASS IN CHARGE</span>
              <div class="count">{{$class_in_charge_total}}</div>
              <a href="{{url('classincharge')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to classes portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> View Classes</span></a>
            </div> -->
            <!-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-newspaper-o"></i> ASSIGNED SUBJECT</span>
              <div class="count">{{$course_in_charge_total}}</div>
              <a href="{{url('enter-subject-detail')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to subjects portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i> View subjects</span></a>
            </div> -->
            <!-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-external-link"></i> ENTER MARKS</span>
              <div class="count" style="font-size:20px">@if($no_exam_marks)<b style="color1:green"> {{$no_exam_marks->type}}</b> @else <b style="color:red">No Marks Yet</b> @endif</div>
              <a href="{{url('mark/entry')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to marks portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i> Enter Marks</span></a>
            </div>
          </div> -->
          <br />

          <div class="row">

          <!-- <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Month of {{$current_month}} Attendance Chart</h2>
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
                  <div class="x_content">

                    <div id="mainb" style="height:350px;"></div>

                  </div>
                </div>
              </div> -->
          <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Last 3 Months Chart</h2>
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
                  <div class="x_content">

                    <div id="echart_mini_pie" style="height:350px;"></div>

                  </div>
                </div>
              </div>
          </div> -->


          <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
     

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.stock.min.js"></script>

    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
         
     @section('js')

     <script>

$(document).read(function(){

$.get("{{ url('chart/dynamic') }}",function(data){  
    
// $.each(data,function(i,c){
    console.log(data);

//     $('#class_id').append($('<option>').text(c.class_name).attr('value', c.class_code));
//   })
//   $('#class_id').prop('disabled',false);
}) 
});

</script>
    
 
     @endsection