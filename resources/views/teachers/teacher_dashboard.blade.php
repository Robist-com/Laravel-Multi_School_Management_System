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

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->

          <!-- top tiles -->
          <div class="row tile_count">
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
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
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-fax"></i> RESULTS</span>
              <a href="{{url('teacher/gradesheet')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to result portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> View Results</span></a>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> CLASS IN CHARGE</span>
              <div class="count">{{$class_in_charge_total}}</div>
              <a href="{{url('classincharge')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to classes portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> View Classes</span></a>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-newspaper-o"></i> ASSIGNED SUBJECT</span>
              <div class="count">{{$course_in_charge_total}}</div>
              <a href="{{url('enter-subject-detail')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to subjects portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i> View subjects</span></a>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-external-link"></i> ENTER MARKS</span>
              <div class="count" style="font-size:20px">@if($no_exam_marks)<b style="color1:green"> {{$no_exam_marks->type}}</b> @else <b style="color:red">No Marks Yet</b> @endif</div>
              <a href="{{url('mark/entry')}}" data-toggle="tooltip" data-placement="bottom" title="Click to nagivate to marks portal"> 
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i> Enter Marks</span></a>
            </div>
          </div>
          <!-- /top tiles -->


  
          <!-- <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Twitter Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Conventional Media</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Bill boards</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div> -->
          <br />

          <div class="row">

          <div class="col-md-8 col-sm-8 col-xs-12">
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
              </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
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
          </div>


          <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
     

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.stock.min.js"></script>


    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  
         
     @section('scripts')

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