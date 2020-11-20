
 <?php $url = Request::is('get-class-attendance/*');?>
   
   <h2><i class="fa fa-users"> STUDENTS IN CHARGE</i> </h2>
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
    <div class="card">
        <div class="body">
        <div class="clearfix"></div>
        <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
              <div class="btn-group pull-right">
                    <button type="button" class="btn bg-teal btn-round">SELECT CLASS</button>
                    <button type="button" class="btn bg-teal btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                    @foreach($teacher_class as $grade) 
                    <li>
                    <a data-toggle="tooltip" data-placement="left" title="{{$grade->class_name}}" class="dropdown-item" href="{{url('studentsincharge', $grade->class_code)}}">
                    <label for=""  class="active">{{$grade->semester_name}} </label> | {{$grade->class_code}}
                    </a></li>
                    @endforeach
                    </ul>
                    </div>
                <ul class="nav navbar-left panel_toolbox">
                <div class="pull-left">
                    <h3 > @if(isset($teacher_class_grade)) @foreach ($teacher_class_grade as $n => $result) <b style="font-weight:bold; color:red">{{$result->semester_name}}</b>  <b>{{$result->class_name}}</b> @endforeach    <i> Total Students  ({{ $classStudentListCount}})</i>@endif</h3>
                </div>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
           
            <div class="clearfix"></div>
            <div class="table-responsive">
<div  id="wait"></div>
    <!-- <table class="table table-striped1 table-hover" id="teachers-table"> -->
<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatable-responsive js-exportable" cellspacing="0" width="100%">

        <thead>
            <tr>
         <th>Photo</th>
        <th>Full Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Grade</th>
            </tr>
        </thead>
        <tbody>
        @foreach($allStudentList as $teacher)
            <tr id="tr_{{$teacher->id}}" class="contact">
            <td><a  href="{!! route('teachers.show', [$teacher->teacher_id]) !!}" title="View Profile">
            <img src="{{asset('student_images/' .$teacher->image)}}" alt=""
                class="rounded-circle"  width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></a>
            </td>
            <td> 
            {!! $teacher->first_name !!} {!! $teacher->last_name !!}
            
            </td>
            <td> @if($teacher->gender == 0)Male @else Female @endif</td>
            <td>{!! $teacher->email !!}</td>
            <td>{!! $teacher->phone !!}</td>
            <td>{!! $teacher->semester_name !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>


    @section('js')
        <script type="text/javascript">
 
           //  Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

$(document).ready(function(){
 
  var deleteLinks = document.querySelectorAll('#addAttendance');

    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            var choice = confirm(this.getAttribute('data-confirm'));

            if (choice) {
                  document.getElementById("attendance_form").submit(); //form id
            }
        });
    }

})

        </script>
        @endsection