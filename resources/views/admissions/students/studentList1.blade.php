<div class="block-header">
<h3>STUDENT LIST </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
        </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    STUDENTS TABLE
                </h2>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Roll No.</th>
                                <th>Department</th>
                                <th>Class</th>
                                <th>Name</th>
                                <th>Date of Birth</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Roll No.</th>
                                <th>Department</th>
                                <th>Class</th>
                                <th>Name</th>
                                <th>Date of Birth</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allStudentList as $key => $student)
                            <tr>
                                <td>{{$student->username}}</td>
                                <td>{{$student->department_name}}</td>
                                <td>{{$student->class_name}}</td>
                                <td>{{$student->first_name ." ". $student->last_name}}</td>
                                <td>{{$student->dob}}</td>
                                <td>{{$student->phone}}</td>
                                <td>
                                <div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
                                {!! Form::open(['route' => ['admissions.destroy', $student->id], 'method' =>
                                    'delete']) !!}
                                    <!-- <div class='btn-group btn-xs'> -->
                                        <a href="{!! url('student/fee/list/collection/payment', [$student->student_id]) !!}"
                                        class="btn bg-light-blue waves-effect" title="Pay Fee"><i class="material-icons">attach_money</i></a>

                                        <a href="{!! url('student/fee/list/collection/payment', [$student->student_id]) !!}"
                                        class="btn bg-pink waves-effect" title="Promote Student"><i class="material-icons">near_me</i></a>

                                        <a href="{{route('admissions.edit', [$student->student_id])}}"  class="btn bg-dark waves-effect"> 
                                            <i class="material-icons">edit</i></a>

                                        {!! Form::button('<i class="material-icons">delete</i>', ['type' =>
                                        'submit', 'class' => 'btn bg-red waves-effect',  'title'=>'Delete', 'onclick' =>
                                        "return confirm('Are you sure?')"]) !!}
                                    <!-- </div> -->
                                    {!! Form::close() !!}
                                    </div>
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

<script>
    //  Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>

@endsection