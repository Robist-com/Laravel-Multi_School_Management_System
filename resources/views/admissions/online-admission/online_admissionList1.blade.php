@include('flash::message')

<div class="block-header">
<h3> ONLINE ADMISSION TABLE </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
           
        </div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    ONLINE ADMISSIONS TABLE
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
                                <th >Roll No.</th>
                                <th>Department</th>
                                <th>Class</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Reg Date</th>
                                <th>Phone</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th >Roll No.</th>
                                <th>Department</th>
                                <th>Class</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Reg Date</th>
                                <th>Phone</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allStudentList as $key => $student)
                            <!-- <tr id="tr_{{$student->id}}" class="contact"> -->
                            <tr class="even pointer">
                                <!-- <td><input type="checkbox" class="sub_chk" data-id="{{$student->id}}"></td> -->
                                <td>{{$student->username}}</td>
                                <td>{{$student->department_name}}</td>
                                <td>{{$student->class_name}}</td>
                                <td>{{$student->first_name ." ". $student->last_name}}</td>
                                <td align="center">
                                    <select style="cursor:pointer;" name="" id="" class="form-control bootstrap-select">
                                        <option value="pending" @if ($student->acceptance ==
                                            'pending') selected selected @endif >Pending</option>

                                        <option value="reject" @if ($student->acceptance ==
                                        'reject') selected selected @endif >Reject</option>

                                        <option value="reject" @if ($student->acceptance ==
                                        'accept') selected selected @endif >Accept</option>
                                    </select>
                                </td>

                                <td>{{date('Y-m-d', strtotime($student->dateregistered))}}</td>
                                <td>{{$student->phone}}</td>
                                <td>

                                <div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
                                {!! Form::open(['route' => ['admissions.destroy', $student->id], 'method' =>
                                    'delete']) !!}
                                        <a href="{{route('admissions.edit', [$student->student_id])}}"  class="btn bg-dark waves-effect"> 
                                            <i class="material-icons">edit</i></a>

                                        {!! Form::button('<i class="material-icons">delete</i>', ['type' =>
                                        'submit', 'class' => 'btn bg-red waves-effect',  'title'=>'Delete', 'onclick' =>
                                        "return confirm('Are you sure?')"]) !!}
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