@if($marks)
<div class="table">
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap js-exportable table-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
          <th>Roll No</th>
          <th>Subject</th>
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
          <td data-toggle="tooltip" data-placement="right" title="{{$mark->first_name}} {{$mark->last_name}}">{{$mark->roll_no}}</td>
          <td>@foreach(App\Models\Course::where('course_code', request('subject'))->get() as $course ) {{$course->course_name}} @endforeach</td>
          <td>{{$mark->written}}</td>
          <td>{{$mark->mcq}}</td>
          <td>{{$mark->practical}}</td>
          <td>{{$mark->ca}}</td>
          <td>{{$mark->total}}</td>

          <td>@if($mark->grade > 'C') <label data-toggle="tooltip" data-placement="left" title="{{$mark->first_name}} {{$mark->last_name}} fail this subject " for="" class="label label-danger">{{$mark->grade}} @else <label for="" class="label label-success">{{$mark->grade}}  @endif</label></td>
          <td>{{$mark->point}}</td>
          <td>@if($mark->Absent == ' off') Yes @else No @endif</td>
          <td>
            <a id="cursor" class='btn btn-dark bg-pink btn-round btn-xs' data-toggle="tooltip" data-placement="left" title="Edit {{$mark->first_name}} {{$mark->last_name}} mark" href='{{url("/teacher/mark/edit")}}/{{$mark->id}}'> <i class="glyphicon glyphicon-edit icon-white"></i></a>
          </td>
          @endforeach
        </tbody>
      </table>
      </div>
  @endif