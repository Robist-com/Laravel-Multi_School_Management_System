<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}

.select{
  color: #ffffff !important;
  text-decoration:none;
}
a:hover{
    text-decoration: none !important;
    color: #000000
}

a{
    text-decoration: none !important;
    color: #000000
}
</style>

<?php
 $classwise = request()->segment(1);
 $classwise2 = request()->segment(2);

 $monthly = request()->segment(2); 
 $monthly2 = request()->segment(3); 

 $yearly = request()->segment(1); 
 $yearly2 = request()->segment(2); 
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>ATTENDANCE REPORTS </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <!-- <a href="{{route('expenses.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a> -->
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">

                @if($classwise == 'classwise')
                <h2>Class Wise Report</h2>
                @elseif($classwise2 == 'classwise')
                <h2>Class Wise Report</h2>

                @elseif($monthly == 'monthly-report')
                <h2>Monthly Report</h2>
                @elseif($monthly2 == 'monthly-report')
                <h2>Monthly Report</h2>

                @elseif($yearly == 'yearly')
                <h2>Yearly Report</h2>
                @elseif($yearly2 == 'yearly')
                <h2>Yearly Report</h2>

                @else
                <h2>Attendance Reports</h2>
                @endif
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
                <div class="form-group row">
                  <!-- <div class="form-group"> -->
                    @if($classwise == 'classwise')
                  <div class="col-sm-4 btn bg-teal ">
                           <i class="fa fa-file-o"></i> <a class="select" href="{{route('getClasswiseAttendaceReport')}}"> Class Wise Attendance Report</a>
                    </div>
                    @elseif($classwise2 == 'classwise')
                    <div class="col-sm-4 btn bg-teal ">
                           <i class="fa fa-file-o"></i> <a class="select" href="{{route('getClasswiseAttendaceReport')}}"> Class Wise Attendance Report</a>
                    </div>
                    @else
                    <div class="col-sm-4">
                           <i class="fa fa-file-o"></i> <a  href="{{route('getClasswiseAttendaceReport')}}"> Class Wise Attendance Report</a>
                    </div>
                    @endif

                    @if($monthly == 'monthly-report')
                  <div class="col-sm-4 btn bg-teal ">
                  <i class="fa fa-file-o"></i> <a class="select"  href="{{url('attendance/monthly-report')}}"> Monthly Attendance Report</a>
                    </div>
                    @elseif($monthly2 == 'monthly-report')
                    <div class="col-sm-4 btn bg-teal ">
                  <i class="fa fa-file-o"></i> <a class="select"  href="{{url('attendance/monthly-report')}}"> Monthly Attendance Report</a>
                    </div>
                    @else
                    <div class="col-sm-4">
                    <i class="fa fa-file-o"></i> <a  href="{{url('attendance/monthly-report')}}"> Monthly Attendance Report</a>
                    </div>
                    @endif

                    @if($yearly == 'yearly')
                  <div class="col-sm-4 btn bg-teal ">
                  <i class="fa fa-file-o"></i> <a class="select" href="{{route('getYearlyAttendanceReport')}}"> Yearly Attendance Report</a>
                    </div>
                    @elseif($yearly2 == 'yearly')
                    <div class="col-sm-4 btn bg-teal ">
                  <i class="fa fa-file-o"></i> <a class="select" href="{{route('getYearlyAttendanceReport')}}"> Yearly Attendance Report</a>
                    </div>
                    @else
                    <div class="col-sm-4">
                    <i class="fa fa-file-o"></i> <a href="{{route('getYearlyAttendanceReport')}}"> Yearly Attendance Report</a>
                    </div>
                    @endif
                      <!-- <div class="col-sm-4" id="monthly">
                           <i class="fa fa-file-o"></i> <a  href="{{url('attendance/monthly-report')}}"> Monthly Attendance Report</a>
                    </div> -->
                    <!-- </div>

                    <div class="form-group"> -->
                    <!-- <div class="col-sm-4" id="yearly">
                    <i class="fa fa-file-o"></i> <a href="{{route('getYearlyAttendanceReport')}}"> Yearly Attendance Report</a>
                    </div> -->
                    </div>
                    </div>
                    <div class="clearfix"></div>

                    
                      @if($template->template == '0')

                      <div class="clearfix"></div>

                    @if(isset($studentattendancereport))
                    @include('report.admindefault.attendance.report')
                    @elseif(isset($studentclasswiseattendancereport))
                    @include('report.admindefault.attendance.classwise_report')
                    @elseif(isset($studentyearlyattendancereport))
                    @include('report.admindefault.attendance.yearly_attendance_report')
                    @endif
                          <!-- </div> -->

                      @else

                      @if(isset($studentattendancereport))
                    @include('report.adminbsb.attendance.report')
                    @elseif(isset($studentclasswiseattendancereport))
                    @include('report.adminbsb.attendance.classwise_report')
                    @elseif(isset($studentyearlyattendancereport))
                    @include('report.adminbsb.attendance.yearly_attendance_report')
                    @endif
                          <!-- </div> -->

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

@section('js')

<script>


   $(document).ready(function(){
     
      // alert(1)
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