


<style>
.style > a{
    text-decoration:none;
    font-weight: bold;
    color: #fff;
    font-size: 18px;
}

.style:hover {
  color: #fff;
  box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
  background:#290642;

}
.style{
    background:#393534;
    box-shadow: -10px 25px 50px rgba(0, 0, 0, 0.3);
}

.style > a:hover {
  /* color: #290642; */
  box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
  color: #DB0B1B;

}
</style>

<div class="table-responsive">
<!-- <div class="panel">
    <div class="panel-body"> -->
    <div  id="wait"></div>

    <button class="btn btn-info btn-round style"><a  href="{{ route('FeeReport') }}" data-toggle="modal" data-target1="#generatePaper-show">Student Rports </button></a>
    <button class="btn btn-info btn-round style"><a  href="{{ route('FeeReport') }}" data-toggle="modal" data-target1="#generatePaper-show">Transaction Rports </button></a>
    <button class="btn btn-info btn-round style "  ><a href="{{ route('FeeReport') }}" data-toggle="modal" data-target1="#generatequestion-show">Finance Reports</button></a>
    <button class="btn btn-info btn-round style" ><a href="#" data-toggle="modal" data-target="#ReportList">Attendance Report</button></a>

    <button class="btn btn-info btn-round style" ><a  href="paper/generate"  data-target="1#generatepaper-show"> Generate  Paper</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <button class="btn btn-info btn-round style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>



@include('attendances.attendance_report.report_list')





</div>