
<div class="x_panel">
<div class="title_right">
@include('class_schedule-table_style')
                </div>
              <div class="x_title">
                <h2>Filter </h2>
                <ul class="nav navbar-right panel_toolbox">
                  
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                <li><a class="collapse-link "><i class="fa fa-chevron-up "></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content collapse">

                <div class="row">

                  <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                  <select class="form-control select_2_single" name="course_id" id="cour_id">
                    <option value="">Select Subject</option>
                    @foreach($course as $cour)
                    <option value="{{$cour->id}}">{{$cour->course_name}}</option>
                    @endforeach
                </select>
                  </div>

                  <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                  <select class="form-control select_2_single" name="course_id" id="cour_id">
                            <option value="">Select Subject</option>
                            @foreach($course as $cour)
                            <option value="{{$cour->id}}">{{$cour->course_name}}</option>
                            @endforeach
                        </select>
                  </div>

                  <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                  <select class="form-control select_2_single " name="level_id" id="leve_id">
                        <option value="">Select Level</option>
                        @foreach($level as $lev)
                            <option value="{{$lev->id}}">{{$lev->level}}</option>
                            @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>


            <div class="clearfix"></div>

<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
  <div class="x_panel">
    <div class="x_title">
    <h2>List Schedule</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <a class="btn btn-success btn-round"  data-toggle="modal" data-target="#classschedule-show"><i class="fa fa-plus-circle" aria-hidden="true"> Generate Schedule</i></a>
      </ul>
      <div class="clearfix"></div>
    </div>

    <div class="x_content">

      <div  id="wait"></div>
      <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action" id="classSchedules-table">
          <thead>
            <tr class="headings">
              <th>
                <input type="checkbox" id="check-all" class="flat">
              </th>
              @if(auth()->user()->group == "Admin")
              <th class="column-title">School </th>
              @endif
              <th class="column-title">Classs </th>
              <th class="column-title">Stud Group & Class Group </th>
              <th class="column-title">Courses </th>
              <!-- <th class="column-title">Bill to Name </th> -->
              <th class="column-title">Grades </th>
              <th class="column-title">Days </th>
              <th class="column-title">Room </th>
              <th class="column-title">Date </th>
              <th class="column-title no-link last"><span class="nobr">Action</span>
              <!-- </th> -->
              <th class="bulk-actions" colspan="8">
                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
              </th>
            </tr>
          </thead>

          <tbody>

          @foreach($classSchedule as $key => $classSchedule)
          <tr class="even pointer">
              <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records">
              </td>
              @if(auth()->user()->group == "Admin")
            <td class="" style="padding-top1:70px;">{!! $classSchedule->name !!}</td>
            @endif
            <td class="" style="padding-top1:70px;">{!! $classSchedule->class_name !!}</td>
            <td>
                <div class="top_row">
                    <div>{!! $classSchedule->faculty_name !!}</div>
                    </div>
                    <div class="top_row">
                    <i class="badge badge-success"> {!! $classSchedule->department_name !!}</i>
                    </div>
            </td>

            <td>
                <div class="top_row">
                    <div>{!! $classSchedule->course_name !!}</div>
                    </div>
                    <div class="top_row">
                    <i class="badge badge-success"> {!! $classSchedule->level !!}</i>
                    </div>
            </td>

            <td>
                <div class="top_row">
                    <div>{!! $classSchedule->semester_name!!}</div>
                    <!-- <div>World</div> -->
                    </div>
                    <div class="top_row">
                    <i class="badge badge-success"> {!! $classSchedule->batch !!}</i>
                    </div>
            </td>


            <td>
                <div class="top_row">
                    <div><i class="badge badge-success">{!! $classSchedule->name !!}</i></div>
                    <div><i class="badge badge-success"> {!! $classSchedule->time !!}</i> </div>
                    </div>
                    <div class="top_row">
                    <i class="badge badge-success"> {!! $classSchedule->shift !!}</i>
                    </div>
                </td>

                <td> 
                    <i class="badge badge-success">{!! $classSchedule->classroom_name !!}</i> 
                    <i class="badge badge-success">{!! $classSchedule->classroom_code !!}</i> 
                </td>

                <td> 
                <div class="top_row">
                    Start <i class="badge badge-success">{!! date("d-M-Y", strtotime($classSchedule->start_date))!!}</i> 
                </div>

                <div class="top_row">
                    End <i class="badge badge-success">{!! date("d-M-Y", strtotime($classSchedule->end_date))!!}</i>
                </div>
                </td>
                <td>
                <a href="{{route('classSchedules.edit', $classSchedule->schedule_id)}}"
                 class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </td>
              
            </tr>
        @endforeach

          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
</div>
<!-- /page content -->

 