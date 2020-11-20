<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3>GRADES </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('semesters.index')}}" class="btn bg-teal btn-sm  pull-left" ><i class="material-icons">add</i> Add</a>
        </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <div class="header">

                    @if(isset($semes))
                    <h2>Update Grade</h2>
                    @else
                    <h2>Create Grade</h2>
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
                    @if(isset($semes))

                    {!! Form::model($semes, ['route' => ['semesters.update', $semes->id], 'method' => 'patch' ,
                    'autocomplete' => 'off']) !!}

                    @else

                    {!! Form::open(['route' => 'semesters.store' , 'autocomplete' => 'off']) !!}

                    @endif

                    @include('semesters.fields1')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Grades Table</h2>
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
                                    <th class="column-title">Grade</th>
                                    <th class="column-title">Code</th>
                                    <th class="column-title">Duration</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="column-title">Grade</th>
                                    <th class="column-title">Code</th>
                                    <th class="column-title">Duration</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </tfoot>

                            <tbody id="accordion">
                                @foreach($semesters as $key => $semester)

                                <tr class="even pointer">
                                    <td data-toggle="tooltip" data-placement="left"
                                        title="{!! $semester->semester_description !!}">{!! $semester->semester_name !!}
                                    </td>
                                    <td>{!! $semester->semester_code !!}</td>
                                    <td>{!! $semester->semester_duration !!}</td>
                                    <td>
                                        @if($semester->status == 'on')
                                        <label for="" style="color:#26B99A"><i
                                                class="material-icons">check_circle</i></i></label>
                                        @else
                                        <label for="" style="color:#D9534F"><i
                                                class="material-icons">not_interested</i></label>
                                        @endif

                                    </td>

                                    <td colspan="3">

                                        {!! Form::open(['route' => ['semesters.destroy', $semester->id], 'method' =>
                                        'delete', 'id' => 'delete_form']) !!}

                                        <div class="btn-group">

                                            <button type="button" class="btn bg-pink dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ACTION <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a data-id="{{$semester->id}}"
                                                        data-semester="{{$semester->semester}}"
                                                        data-semester_description="{{$semester->semester_description}}"
                                                        data-course_id="{{$semester->course['course_name']}}"
                                                        data-created_at="{{$semester->created_at}}"
                                                        data-updated_at="{{$semester->updated_at}}" data-toggle="modal"
                                                        data-target="#semester-show">
                                                        <i class="glyphicon glyphicon-print"></i> Print</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a data-id="{{$semester->id}}"
                                                        data-semester="{{$semester->semester}}"
                                                        data-semester_description="{{$semester->semester_description}}"
                                                        data-course_id="{{$semester->course['course_name']}}"
                                                        data-created_at="{{$semester->created_at}}"
                                                        data-updated_at="{{$semester->updated_at}}" data-toggle="modal"
                                                        data-target="#semester-show">
                                                        <i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>
                                                    <a href="{!! route('semesters.edit', [$semester->id]) !!}">
                                                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                                </li>

                                                <li role="separator" class="divider"></li>

                                                <li>

                                                    <a id="delete_link" href="#"
                                                        data-confirm="Are you sure want to delete {!! $semester->semester_name!!} and  {!! $semester->semester_code!!} ?"><i
                                                            class="material-icons">delete_forever</i> Delete</a>
                                                </li>

                                            </ul>
                                        </div>
                                        {!! Form::close() !!}
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
    $(document).ready(function() {
        // alert(1)

        $('#semester_name').on('keyup', function() {

            var randomString = function(length) {

                var text = "";

                // var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

                for (var i = 0; i < length; i++) {

                    text += possible.charAt(Math.floor(Math.random() * possible.length));

                }

                return text;
            }

            // random string length
            var random = randomString(5);
            var semester_name = $("#semester_name").val();

            if (semester_name !== '') {
                var elem = document.getElementById("semester_code").value = random + '-' +
                    semester_name;
            } else {
                var elem = document.getElementById("semester_code").value = '';
            }
        })

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

// document.getElementById("delete_link").onclick = function() { // button id

//       document.getElementById("delete_form").submit(); //form id

// }

//  Exportable table
$('.js-exportable').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});

    })
    </script>

    @endsection