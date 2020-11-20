@extends('layouts.new-layouts.app')

@section('content')


            <div class="page-title">
              <div class="title_left">
              @include('flash::message')
              @include('adminlte-templates::common.errors')
                <h3>Attendance Report</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" name="roll_no1" id="roll_no1" placeholder="Search by...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" name="filter1" id="filter1" type="button">Go!</button>
                    </span>
                  </div>
                </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                        <a href="{{url('student/list/fee/collection')}}"><button type="submit" class="btn btn-round btn-warning"><i class="fa fa-refresh" aria-hidden="true"> Refresh </i></button></a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                  <div class="form-group col-sm-4">
                           <i class="fa fa-file-o"></i> <a href="{{route('getClasswiseAttendaceReport')}}"> Class Wise Attendance Report</a>
                    </div>

                    <div class="form-group col-sm-4">
                           <i class="fa fa-file-o"></i> <a href="{{url('attendance/monthly-report')}}"> Monthly Attendance Report</a>
                    </div>

                    <div class="form-group col-sm-4">
                    <i class="fa fa-file-o"></i> <a href="{{route('getYearlyAttendanceReport')}}"> Yearly Attendance Report</a>
                    </div>
                    </div>
                    <!-- <br>
                    <div class="row">
                    <div class="form-group col-sm-4">
                           <i class="fa fa-file-o"></i> <a href="{{route('getstudentLogindetailReport')}}"> Student Login Details</a>
                    </div>

                    <div class="form-group col-sm-4">
                    <i class="fa fa-file-o"></i> <a href="{{route('getadmissionReport')}}"> Admission Report</a>
                    </div> -->
                    

                    <!-- </div> -->
                    </div>
                    <div class="clearfix"></div>

                    @if(isset($studentattendancereport))
                    @include('report.attendance.report')
                    @elseif(isset($studentclasswiseattendancereport))
                    @include('report.attendance.classwise_report')
                    @elseif(isset($studentyearlyattendancereport))
                    @include('report.attendance.yearly_attendance_report')
                    @endif
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('scripts')

<script>
   $(document).ready(function(){
      
    $(function() {
    if (localStorage.getItem('gender')) {
        $("#gender option").eq(localStorage.getItem('gender')).prop('selected', true);
    }

    $("#gender").on('change', function() {
        localStorage.setItem('gender', $('option:selected', this).index());
    });
    
});

$(function() {
    if (localStorage.getItem('admission_date')) {
        $("#admission_date option").eq(localStorage.getItem('admission_date')).prop('selected', true);
    }

    $("#admission_date").on('change', function() {
        localStorage.setItem('admission_date', $('option:selected', this).index());
    });
    
});




   })
</script>
@endsection