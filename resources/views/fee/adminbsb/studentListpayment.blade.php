<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>CLASS FEE COLLECTION PORTAL</h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"><i class="material-icons">attachment</i> File</li>
            </ol>
        </div>


        <div class="card">
            <div class="header">
                <h2>CLASS FEE COLLECTION PORTAL</h2>
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
                <form action="{{  route('StudentFeeListCollectionPayment')}}" method="post">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="">Grade <b style="color:red">*</b></label>
                                <select class="form-control bootstrap-select" name="semester_id" id="grade_id">
                                    <option value="">Select Grade</option>
                                    @foreach($semester as $semester)
                                    <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="">Level <b style="color:red">*</b></label>
                                <select class="form-control bootstrap-select " name="degree_id" id="level_id">
                                    <option value="">Select Level</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="">Class <b style="color:red">*</b></label>
                                <select class="form-control bootstrap-select " name="class_id" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->class_code}}">{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Faculty <b style="color:red">*</b></label>
                                <select class="form-control bootstrap-select " name="faculty_id" id="faculty_id">
                                    <option value="">Select Faculty</option>
                                    @foreach($faculty as $faculty)
                                    <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Deperment <b style="color:red">*</b></label>
                                <select class="form-control bootstrap-select" name="department_id" id="department_id">
                                    <option selected disabled>Select Department</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-teal pull-right btn-round "><i class="fa fa-search"></i>
                            filter</button>
                    </div>

                </form>

                @if(isset($data))
                <hr>
                <div class="title_left">
                    <h4>STUDENT LIST</h4>
                </div>

                <div class="responsive">
                    <table id="datatable-responsive" class="table table-bordered table-striped table-hover dataTable js-exportable">


                        <thead>
                            <tr>
                                <th>Roll No.</th>
                                <th>Department</th>
                                <th>Class</th>
                                <th>Name</th>
                                <th>Date of Birth</th>
                                <th>Phone</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span></th>
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
                                <th class="column-title no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </tfoot>

                        
                            <tbody id="items">
                                @foreach ($data as $student)
                                <tr>
                                    <td>{{$student->username}}</td>
                                    <td>{{$student->department_name}}</td>
                                    <td>{{$student->class_name}}</td>
                                    <td>{{$student->first_name ." ". $student->last_name}}</td>
                                    <td>{{$student->dob}}</td>
                                    <td>{{$student->phone}}</td>
                                    <td>
                                        <a href="{!! url('student/fee/list/collection/payment', [$student->student_id]) !!}"
                                            class="btn btn-danger" title="Pay Semester Fee"><i class="fa fa-tag"></i>Pay
                                            Fee</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                </div>
            </div>
        </div>
    </div>



    @section('js')
    @include('fee.script.calculate')
    @include('fee.script.payment')
    <script>
    $(document).ready(function() {


        var deleteLinks = document.querySelectorAll('#delete_link');

        for (var i = 0; i < deleteLinks.length; i++) {
            deleteLinks[i].addEventListener('click', function(event) {
                event.preventDefault();

                var choice = confirm(this.getAttribute('data-confirm'));

                if (choice) {
                    document.getElementById("delete_form").submit(); //form id
                }
            });
        }

        //  Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });


        // GET SEMESTER DEGREEE
        $('#grade_id').on('change', function(e) {
            // getStudentsByclass()
            var grade_id = $(this).val();
            var level = $('#level_id')
            $(level).empty();
            $.get("{{ route('dynamicDegrees') }}", {
                grade_id: grade_id
            }, function(data) {

                console.log(data);
                $.each(data, function(i, l) {
                    $(level).append($('<option/>', {
                        value: l.id,
                        text: l.level
                    }))
                })
            })
        });

        // GET SEMESTER DEGREEE
        $('#faculty_id').on('change', function(e) {
            // getStudentsByclass()
            var faculty_id = $(this).val();
            var department_id = $('#department_id')
            $(department_id).empty();
            $.get("{{ route('dynamicDepartments') }}", {
                faculty_id: faculty_id
            }, function(data) {

                console.log(data);
                $.each(data, function(i, l) {
                    $(department_id).append($('<option/>', {
                        value: l.department_id,
                        text: l.department_name
                    }))
                })
            })
        });

        $('#department_id').on('change', function(e) {
            //var department_id = $(this).val();
            getStudentsByclass()
            alert(1)
        });

        // GET SEMESTER DEGREEE
        // $('#faculty_id').on('change',function(e){
        function getStudentsByclass() {
            var faculty_id = $('#faculty_id').val();
            var department_id = $('#department_id').val()
            var class_id = $('#class_id').val()
            var semester_id = $('#semester_id').val()
            var degree_id = $('#degree_id').val()
            var student_id = $('#student_id')
            $(student_id).empty();
            $.get("{{ route('dynamicStudentsByClass') }}", {
                'faculty_id': faculty_id,
                'department_id': department_id,
                'class_id': class_id,
                'semester_id': semester_id,
                'degree_id': degree_id
            }, function(data) {

                console.log(data);
                $.each(data, function(i, l) {
                    $(student_id).append($('<option/>', {
                        value: l.id,
                        text: l.first_name + " " + l.last_name
                        // text  : 
                    }))
                })
            })
        }

        // });
    });
    </script>
    @endsection