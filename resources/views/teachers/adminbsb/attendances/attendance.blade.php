<?php $url = Request::is('get-class-attendance/*');?>
   
   <h2><i class="fa fa-calendar"> Attendance</i> </h2>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <!-- <a href="{{route('shifts.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a> -->
    </div>
    <br><br>
    <div class="card">
        <div class="body">
            <div class="demo-splite-button-dropdowns pull-right">
                <div class="btn-group">
                    <button type="button" class="btn bg-teal waves-effect">MARK CLASS ATTENDANCE</button>
                    <button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Select Class</span>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach($classes as $grade)
                        <li>
                            <a data-toggle="tooltip" data-placement="left" title="{{$grade->class_name}}"
                                class="dropdown-item" href="{{url('get-class-attendance', $grade->class_code)}}">
                                <label for="" class="active">{{$grade->semester_name}} </label> | {{$grade->class_code}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br>
            <br>
            <!-- @include('table_style')  -->
            <?php 
            $day = '';
            $date = date('Y-m-d');
            $today_full = date('l');
            $today = date('d : Y');
            ?>

            <style>
            .btn-block {
                height: 28px;
                text-emphasis: center;
                text-anchor: top;
            }
            </style>

            @php
            $date = date('Y-m-d'); // this for the date current date
            @endphp

            @if($url)
            <div class="modal-footer">
                <button type="submit" id="addAttendance"  data-confirm="Are you sure you want to mark {{$today_full .' '. $today}}  Attendance ?"
                    class="btn bg-teal btn-round pull-right"><i class="fa fa-pencil"></i>
                    Mark-Attendance</button>
                <a href="{{url('mark-teacher-attendance')}}" 
                    class="btn btn-danger btn-round pull-right"><i class="fa fa-close"></i>
                    Cancel</a>
            </div>
            @endif
            <div class="content">
                <div class="clearfix"></div>

                @include('flash::message')

                <div class="clearfix"></div>
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                @if($attendances != $date)
                                <form id="attendance_form" action="{{url('MarkAttendanceClass')}}" method="post">
                                    @csrf
                                    @if(isset($classes))
                                    @include('teachers.attendances.mark_attendance')

                                    @if($url)
                                    <div class="modal-footer">
                                        <button type="submit" id="addAttendance"  data-confirm="Are you sure you want to mark {{$today_full .' '. $today}} 's Attendance ?"
                                            class="btn bg-teal btn-round pull-right"><i class="fa fa-pencil"></i>
                                            Mark-Attendance</button>
                                        <a href="{{url('mark-teacher-attendance')}}" 
                                            class="btn btn-danger btn-round pull-right"><i class="fa fa-close"></i>
                                            Cancel</a>
                                    </div>
                                    @endif
                                    @endif
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- here will be our js part okay --}}
        @if($classes)
        @endif
        @section('js')
        <script type="text/javascript">
        // {{-- i will explain this script later okay  --}}


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