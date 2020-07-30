


@include('table_style')
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
<div class="panel">
    <div class="panel-body">
    <div  id="wait"></div>

    <button class="btn btn-info style"><a data-toggle="modal" data-target="#generatePaper-show"> Generate Question Paper</button></a>
    <button class="btn btn-info style "  ><a data-toggle="modal" data-target="#generatequestion-show"> Create Question </button></a>
    <button class="btn btn-info style" ><a href="question/list"> Question List</button></a>
    <!-- <button class="btn btn-info style" ><a  href="paper/generate"  data-target="1#generatepaper-show"> Generate  Paper</button></a> -->
    <button class="btn btn-info style" ><a data-toggle="modal" data-target="#createExam"> Create Exam</button></a>
    <!-- <button class="btn btn-info style" ><a data-toggle="modal" data-target="#generatequestion-show"> Generate  Paper</button></a> -->
    <!-- <button class="btn btn-info style">Make Paper</button> -->
    <!-- <button class="btn btn-info style">Make Paper</button> -->
    <!-- <button class="btn btn-info style">Make Paper</button>
    <button class="btn btn-info style">Make Paper</button>
    <button class="btn btn-info style">Make Paper</button>
    <button class="btn btn-info style">Make Paper</button> -->
    <!-- <button class="btn btn-info style">Make Paper</button> -->
    </div>
</div>
    <table class="table table-striped table-bordered table-hover" id="admissions-table">
        <thead>
            <tr>
            <th style="width:20%">Exam Name</th>
            <th style="width:10%">Exam Date</th>
            <th style="width:10%"> Session</th>
              <th style="width:20%">Class</th>
              <th style="width:20%">Class Group</th>
              <!-- <th style="width:15%">Action</th> -->
                <th colspan="3">Action</th>
            </tr>
            </thead>
                <tbody>
                @foreach($exams as $exam)

                <tr>
                <td>{{$exam->type}}</td>
                <td>{{$exam->e_date}}</td>
                <td>{{$exam->session}}</td>
                <td>{{$exam->class}}</td>
                <td>{{$exam->department}}</td>

                <td>
                    <a title='Edit' class='btn btn-info' href='{{url("/exam/edit")}}/{{$exam->id}}'> <i class="glyphicon glyphicon-edit icon-white"></i></a>&nbsp&nbsp<a title='Delete' class='btn btn-danger' href='{{url("/exam/delete")}}/{{$exam->id}}'> <i class="glyphicon glyphicon-trash icon-white"></i></a> </td>
                @endforeach
           
       

        </tbody>
    </table>
</div>

