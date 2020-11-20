<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}

.select {
    color: #ffffff !important;
    text-decoration: none;
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
 $student = request()->segment(1);
 $student2 = request()->segment(1);

 $guidian = request()->segment(1); 
 $guidian2 = request()->segment(1); 

 $yearly = request()->segment(1); 
 $yearly2 = request()->segment(2); 

 
 $studenthistory = request()->segment(1); 
 $studenthistory2 = request()->segment(1); 

 $studentlogindetail = request()->segment(1); 
 $studentlogindetail2 = request()->segment(3); 

 $admission = request()->segment(1); 
 $admission2 = request()->segment(2); 

 

 

 
?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>STUDENT ACADEMICS REPORTS </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>

    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">

                    @if($student == 'student')
                    <h2>Student Report</h2>
                    @elseif($student2 == 'poststudent')
                    <h2>Student Report</h2>

                    @elseif($guidian == 'guadian')
                    <h2>Guidian Report</h2>
                    @elseif($guidian2 == 'poststudentguadian')
                    <h2>Guidian Report</h2>

                    @elseif($studenthistory == 'studenthistory')
                    <h2>Student History Report</h2>
                    @elseif($studenthistory2 == 'poststudenthistory')
                    <h2>Student History Report</h2>

                    @elseif($studentlogindetail == 'studentlogindetail')
                    <h2>Student Login Report</h2>
                    @elseif($studentlogindetail2 == 'detail')
                    <h2> Login Report</h2>

                    @elseif($admission == 'admission')
                    <h2> Admission Report</h2>
                    @elseif($admission2 == 'admission')
                    <h2> Admission Report</h2>

                    @else
                    <h2>Student Academics Reports</h2>
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

                        @if($student == 'student')
                        <div class="col-sm-4 btn bg-teal ">
                            <i class="fa fa-file-o"></i> <a class="select" href="{{route('getstudentReport')}}"> Student
                                Report</a>
                        </div>
                        @elseif($student2 == 'poststudent')
                        <div class="col-sm-4 btn bg-teal ">
                            <i class="fa fa-file-o"></i> <a class="select" href="{{route('getstudentReport')}}"> Student
                                Report</a>
                        </div>
                        @else
                        <div class="col-sm-4">
                            <i class="fa fa-file-o"></i> <a href="{{route('getstudentReport')}}"> Student Report</a>
                        </div>
                        @endif

                        @if($guidian == 'guadian')
                        <div class="col-sm-4 btn bg-teal ">
                            <i class="fa fa-file-o"></i> <a class="select" href="{{route('getguadianReport')}}"> Guadian
                                Report</a>
                        </div>
                        @elseif($guidian2 == 'poststudentguadian')
                        <div class="col-sm-4 btn bg-teal ">
                            <i class="fa fa-file-o"></i> <a class="select" href="{{route('getguadianReport')}}">
                                Guadian Report</a>
                        </div>
                        @else
                        <div class="col-sm-4">
                            <i class="fa fa-file-o"></i> <a href="{{route('getguadianReport')}}"> Guadian Report</a>
                        </div>
                        @endif

                        @if($studenthistory == 'studenthistory')
                        <div class="col-sm-4 btn bg-teal ">
                            <i class="fa fa-file-o"></i> <a class="select" href="{{route('getstudenthistoryReport')}}">
                                Student History</a>
                        </div>
                        @elseif($studenthistory2 == 'poststudenthistory')
                        <div class="col-sm-4 btn bg-teal ">
                            <i class="fa fa-file-o"></i> <a class="select" href="{{route('getstudenthistoryReport')}}">
                                Student History</a>
                        </div>
                        @else
                        <div class="col-sm-4">
                            <i class="fa fa-file-o"></i> <a href="{{route('getstudenthistoryReport')}}"> Student
                                History</a>
                        </div>
                        @endif

                        @if($studentlogindetail == 'studentlogindetail')
                        <div class="col-sm-4 btn bg-teal ">
                            <!-- <div class="form-group col-sm-4"> -->
                            <i class="fa fa-file-o"></i> <a class="select"
                                href="{{route('getstudentLogindetailReport')}}"> Student Login
                                Details</a>
                        </div>
                        @elseif($studentlogindetail2 == 'detail') 
                        <div class="col-sm-4 btn bg-teal ">
                            <i class="fa fa-file-o"></i> <a class="select"
                                href="{{route('getstudentLogindetailReport')}}"> Student Login
                                Details</a>
                        </div>
                        @else
                        <div class="col-sm-4">
                            <i class="fa fa-file-o"></i> <a href="{{route('getstudentLogindetailReport')}}"> Student
                                Login
                                Details</a>
                        </div>
                        @endif

                        @if($admission == 'admission')
                        <div class="col-sm-4 btn bg-teal ">
                            <!-- <div class="form-group col-sm-4"> -->
                            <i class="fa fa-file-o"></i> <a class="select" href="{{route('getadmissionReport')}}">
                                Admission Report</a>
                        </div>
                        @elseif($admission2 == 'admission')
                        <div class="col-sm-4 btn bg-teal ">
                            <i class="fa fa-file-o"></i> <a class="select" href="{{route('getadmissionReport')}}">
                                Admission Report</a>
                        </div>
                        @else
                        <div class="col-sm-4">
                            <i class="fa fa-file-o"></i> <a href="{{route('getadmissionReport')}}"> Admission Report</a>
                        </div>
                        @endif
                    </div>


                    @if($template->template == '0')

                    @if(isset($allstudentreport))
                    @include('report.admindefault.student.student_report')

                    @elseif(isset($studentguidianreport))
                    @include('report.admindefault.student.guadian_report')

                    @elseif(isset($studenthistoryreport))
                    @include('report.admindefault.student.student_history')

                    @elseif(isset($studentlogindetailreport))
                    @include('report.admindefault.student.student_login_detail')

                    @elseif(isset($studentacademicreport))
                    @include('report.admindefault.student.admission_report')
                    @endif

                    @else

                    @if(isset($allstudentreport))
                    @include('report.adminbsb.student.student_report')

                    @elseif(isset($studentguidianreport))
                    @include('report.adminbsb.student.guadian_report')

                    @elseif(isset($studenthistoryreport))
                    @include('report.adminbsb.student.student_history')

                    @elseif(isset($studentlogindetailreport))
                    @include('report.adminbsb.student.student_login_detail')

                    @elseif(isset($studentacademicreport))
                    @include('report.adminbsb.student.admission_report')
                    @endif

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
$(document).ready(function() {

  $('.js-exportable').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});

    $(function() {
        if (localStorage.getItem('gender')) {
            $("#gender option").eq(localStorage.getItem('gender')).prop(
                'selected', true);
        }

        $("#gender").on('change', function() {
            localStorage.setItem('gender', $('option:selected', this)
                .index());
        });

    });

    $(function() {
        if (localStorage.getItem('admission_date')) {
            $("#admission_date option").eq(localStorage.getItem(
                'admission_date')).prop('selected', true);
        }

        $("#admission_date").on('change', function() {
            localStorage.setItem('admission_date', $('option:selected',
                this).index());
        });

    });




})
</script>
@endsection