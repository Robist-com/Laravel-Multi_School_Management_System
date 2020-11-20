@include('class_schedule-table_style')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>CLASS SCHEDULES </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <a class="btn bg-teal btn-round" data-toggle="modal" data-target="#classschedule-show"><i
                class="fa fa-plus-circle" aria-hidden="true"> Generate Schedule</i></a>
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">

                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
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
                    <div id="wait"></div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table js-exportable" >
                            <thead>
                                <tr class="headings">
                                    <!-- <th>
                <input type="checkbox" id="check-all" class="flat">
              </th> -->
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
                                        <!-- <th class="bulk-actions" colspan="8">
                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
              </th> -->
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($classSchedule as $key => $classSchedule)
                                <tr class="even pointer">
                                    <!-- <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records">
              </td> -->
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
                                            <div><i class="badge badge-success"> {!! $classSchedule->time .'--'.
                                                    $classSchedule->end_time!!}</i> </div>
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
                                            Start <i class="badge badge-success">{!! date("d-M-Y",
                                                strtotime($classSchedule->start_date))!!}</i>
                                        </div>

                                        <div class="top_row">
                                            End <i class="badge badge-success">{!! date("d-M-Y",
                                                strtotime($classSchedule->end_date))!!}</i>
                                        </div>
                                    </td>

                                    <td colspan="3">
                                        {!! Form::open(['route' => ['classSchedules.destroy',
                                        $classSchedule->schedule_id],
                                        'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                PINK <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a href="{!! url('print-faculty-single', [$classSchedule->schedule_id]) !!} "
                                                        target="_blank">
                                                        <i class="glyphicon glyphicon-print"></i> Print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a
                                                        href="{!! route('classSchedules.show', [$classSchedule->schedule_id]) !!}">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a
                                                        href="{!! route('classSchedules.edit', [$classSchedule->schedule_id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {{$classSchedule->class_name}} Schedule ?"><i
                                                            class="material-icons">delete_forever</i> Delete</a>
                                                </li>

                                            </ul>
                                        </div>
                                        {!! Form::close() !!}
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

    @section('js')
    <script type="text/javascript">

    </script>
    @endsection