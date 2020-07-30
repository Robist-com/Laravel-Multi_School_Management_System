@if($marks)
<div class="row">
  <div class="col-md-12">
   
    <table id="markList" class="table  table-hover">
      <thead>
        <tr>
          <!-- <th>Regi No</th> -->
          <th>Roll No</th>
          <th>Name</th>
          <th>Written</th>
          <th>MCQ</th>
          <th>Practical</th>
          <th>SBA</th>
          <th>Total</th>
          <th>Grade</th>
          <th>Point</th>
          <th>Is Absent</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($marks as $mark)
        <tr>
          <td>{{$mark->roll_no}}</td>
          <td>{{$mark->first_name}} {{$mark->last_name}}</td>
          <td>{{$mark->written}}</td>
          <td>{{$mark->mcq}}</td>
          <td>{{$mark->practical}}</td>
          <td>{{$mark->ca}}</td>
          <td>{{$mark->total}}</td>

          <td>{{$mark->grade}}</td>
          <td>{{$mark->point}}</td>
          <td>{{$mark->Absent}}</td>
          <td>
            <a title='Edit' class='btn btn-info' href='{{url("/mark/edit")}}/{{$mark->id}}'> <i class="glyphicon glyphicon-edit icon-white"></i></a>
          </td>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif