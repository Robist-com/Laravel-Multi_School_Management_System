


<table class="table table-striped jambo_table bulk_action" id="classSchedules-table">
          <thead>
            <tr class="headings">
              <th>
                <input type="checkbox" id="check-all" class="flat">
              </th>
              <th class="column-title">Classs </th>
              <th class="column-title">Stud Group & Class Group </th>
              <th class="column-title">Courses </th>
              <!-- <th class="column-title">Bill to Name </th> -->
              <th class="column-title">Grades </th>
              <th class="column-title">Days </th>
              <th class="column-title">Room </th>
              <th class="column-title">Date </th>
              <th class="column-title no-link last"><span class="nobr">Action</span>
              </th>
              <th class="bulk-actions" colspan="7">
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
            <td class="col-md-2" style="padding-top:70px;">{!! $classSchedule->class_name !!}</td>
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
            </tr>
        @endforeach

          </tbody>
        </table>

 