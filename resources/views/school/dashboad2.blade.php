@extends('layouts.new-layouts.app')

@section('content')   


 
<div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-refresh"></i></div>
                  <div class="count">{{$transactionsCount}}</div>
                  <h3>Transactions</h3>
                  <span class="info-box-text alert "><a href="{{route('transactions.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view all transactions">view transaction </a></span>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-flash"></i></div>
                  <div class="count">{{$feeStructureCount}}</div>
                  <h3>Fee Structure</h3>
                  <span class="info-box-text alert "><a  href="{{route('feeStructures.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view all fee structures">view fee structure</a></span>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-usd"></i></div>
                  <div class="count">{{$feeCount}}</div>
                  <h3>Fees</h3>
                  <span class="info-box-text alert " ><a href="{{url('view/fee/collection')}}" data-toggle="tooltip" data-placement="right" title="Click to view all fee collection">view fees collection </a></span>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-home"></i></div>
                  <div class="count">{{$classroomCount}}</div>
                  <h3>ClassRooms</h3>
                  <span class="info-box-text alert " ><a href="{{route('classRooms.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view all classrooms ">view classroom</a></span>
                </div>
              </div>
            </div>
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-blackboard"></i></div>
                  <div class="count">{{$classCount}}</div>
                  <h3>Classes</h3>
                  <span class="info-box-text alert "><a href="{{route('classes.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view all classes">view classes </a></span>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-random"></i></div>
                  <div class="count">{{$semesterCount}}</div>
                  <h3>Grades</h3>
                  <span class="info-box-text alert "><a  href="{{route('semesters.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view all grades">view grades</a></span>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-calendar"></i></div>
                  <div class="count">{{$classschedulCount}}</div>
                  <h3>Class Schedule</h3>
                  <span class="info-box-text alert " ><a href="{{route('classSchedules.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view all class schedules">view class schedule </a></span>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">{{$batchCount}}</div>
                  <h3>Sessions</h3>
                  <span class="info-box-text alert " ><a href="{{route('batches.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view current session ">view session</a></span>
                </div>
              </div>
            </div>

            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-equalizer"></i></div>
                  <div class="count">{{$facultyCount}}</div>
                  <h3>Student Groups</h3>
                  <span class="info-box-text alert "><a href="{{route('faculties.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view all student groups ">view student group </a></span>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-sound-dolby"></i></div>
                  <div class="count">{{$departmentCount}}</div>
                  <h3>Class Groups</h3>
                  <span class="info-box-text alert "><a  href="{{route('departments.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view all class groups">view class group</a></span>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-signal"></i></div>
                  <div class="count">{{$levelCount}}</div>
                  <h3>Levels</h3>
                  <span class="info-box-text alert " ><a href="{{route('levels.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view all levels">view level </a></span>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="glyphicon glyphicon-option-horizontal"></i></div>
                  <div class="count">{{$dayCount}}</div>
                  <h3>Days</h3>
                  <span class="info-box-text alert " ><a href="{{route('days.index')}}" data-toggle="tooltip" data-placement="right" title="Click to view days ">view day</a></span>
                </div>
              </div>
            </div>
</div>
 
                <div class="row">
             <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Exams <small>Sessions {{date('Y')}}</small></h2>
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
                    @if($current_session_exams_count != 0)
                      @foreach($current_session_exams as $current_exam)
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">{{date("F", strtotime($current_exam->e_date))}}</p>
                        <p class="day">{{date("d", strtotime($current_exam->e_date))}}</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#" data-toggle="tooltip" data-placement="right" title="view {{$current_exam->class_name}} exam details">{{$current_exam->type}} Examination</a>
                        <p>{{$current_exam->class_name}}</p>
                      </div>
                    </article>
                    @endforeach
                    @else
                      <label for="">There is no Exams for this session {{date('Y')}} yet.</label>
                      @endif
                  </div>
                </div>
              </div>

             <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Exams Marks <small>Sessions {{date('Y')}}</small></h2>
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
                    @if($current_session_exams_marks_count != 0)
                      @foreach($current_session_exams_marks as $current_exam_mark)
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">{{$current_exam_mark->class_name}}</p>
                        <p class="day">{{$current_exam_mark->total_students}}</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#" data-toggle="tooltip" data-placement="top" title="view {{$current_exam_mark->class_name}} exam details">{{$current_exam_mark->exam_type}} Examination already marks</a>
                        <p></p>
                        <p>{{$current_exam_mark->subject_name}} ({{$current_exam_mark->subject_code}})</p>
                      </div>
                    </article>
                    @endforeach
                    @else
                      <label for="">Exams are not yet been mark for session {{date('Y')}}</label>
                      @endif
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Published Results <small>Sessions {{date('Y')}}</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      @if($current_session_puplished_result_count  != 0)
                      @foreach($current_session_puplished_result as $current_puplished_exam)
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">{{date('F', strtotime($current_puplished_exam->publish_date))}}</p>
                        <p class="day">{{date("d", strtotime($current_puplished_exam->publish_date))}}</p>
                      </a>
                      <div class="media-body">
                     
                        <a class="title" href="{{url('result/search')}}" data-toggle="tooltip" data-placement="right" title="view {{$current_puplished_exam->session}} exam results">{{$current_puplished_exam->exam_type}} Examination Published</a><br>
                        <b>{{$current_puplished_exam->total_students}}</b> <p> Students has Toke the exam</p>
                      </div>
                    </article>
                    @endforeach
                    @else
                      <label for="">Results are not yet published for session {{date('Y')}}</label>
                      @endif
                  </div>
                </div>
              </div>
              </div>

              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title bg-info">
                  <h2>Failed Students <small>Sessions {{date('Y')}}</small></h2>
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
                    <div class="row">
                      @if( $current_session_repeated_students  != 0)
                      @foreach($repeated_students as $current_exam_mark)
                     <div class="col-md-4 col-sm-4 col-xs-12">
                      <article class="media event">
                      <a class="pull-left date">
                      <p class="month">Total</p>
                        <p class="day">{{$current_exam_mark->student_fail}}</p>
                      </a>
                      <div class="media-body">
                      <a class="title" href="{{url('home/repeat_students')}}/{{$current_exam_mark->class_code}}/{{$current_exam_mark->exam_id}}" data-toggle="tooltip" data-placement="right" title=" there are {{$current_exam_mark->student_fail}} failed students in {{$current_exam_mark->class_name}}"> {{$current_exam_mark->exam_type}} view students </a>
                        <p>{{$current_exam_mark->class_name}} ({{$current_exam_mark->class_code}})</p>
                        <p>{{$current_exam_mark->subject_name}} ({{$current_exam_mark->subject_code}})</p>
                      </div>
                    </article>
                      </div>
                      @endforeach
                      @else
                      <label for="">There is no repeat student's for session {{date('Y')}}</label>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>

          
            
<div class="theme-options">
              <div id="theme-white"></div>
              <div id="theme-blue"></div>
              <div id="theme-green"></div>
              <div id="theme-purple"></div>
              <div id="theme-yellow"></div>
              <div id="theme-red"></div>
              <div id="theme-black"></div>
            </div>


@endsection