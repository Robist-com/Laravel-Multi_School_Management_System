@include('attendances.style')
<!-- @include('table_style')    -->
    @php
       $date = date('d-m-Y');
    @endphp

    <style>
   #attendance_date{
     background-color: #fff !important;
     border: 1px solid #fff !important;
   }
   .edit_atten{
    /* background-color: #fff !important; */
     border: 1px solid #fff !important;
   }
 </style>

<h2><i class="fa fa-calendar"> Edit Attendance</i> </h2>
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

    <?php
        $date = date('d-m-Y');
        $nameOfDay = date('l', strtotime($date));
        echo "<h4 style='color:red; font-weight:bolder;text-transform:uppercase'>$nameOfDay
            <b style='color:black'>Attendance</b></h4>  ";
        ?>
    
        <div class="modal-footer">
        <button type="submit" id="update_attendance" data-confirm="Are you sure you want to Update this Attendance ?" class="btn bg-teal btn-round "><i class="fa fa-refresh"></i> Update Attendance</button>
        </div>
  
            <form id="updateattendance_form" action="{{url('teacher_update_attendance')}}" method="post">
                @csrf

                <div  id="wait"></div>
                <div class="form-group ">
            <div class="col-md-2 pull-left">
                <label style="font-weight:bolder;">  Date: </label> 
                <input type="text" name="attendance_date"  id="attendance_date" class="form-control" value="{{ $date}}" readonly >
            </div>
            </div>
                <br><br>
                @if(auth()->user()->group == "Admin")
            <div class="col-md-12">
                <label for="">School <b style="color:red">*</b></label>
            <select name="school_id" id="school_id" class="form-control">
                <option value="">Select</option>
                @foreach(auth()->user()->school->all() as $school)
                <option value="{{$school->id}}" @if(isset($classstudentreport_single)){{$school->id == $classstudentreport_single->school_id ? 'selected' : '' }} @endif>{{$school->name}}</option>
                @endforeach
            </select>
            </div>
            @else
            <input type="hidden" name="school_id" id="school_id1" value="{{auth()->user()->school->id}}">
            @endif
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap js-exportable" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>Roll No.</th>
                    <th>Student Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Late</th>
                    <th>Sick</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($edit_attendances as $key => $item)
                <tr>
                <td>{{$item->roll_no}}
                <input type="hidden" id="roll_no" name="roll_no" value="{{$item->roll_no}}">
                <input type="hidden" name="teacher_id" id="teacher_id" value="{{$item->teacher_id}}">
                <input type="hidden" name="class_id" id="class_id" value="{{$item->class_code}}">
                <input type="hidden" name="course_id" id="course_id" value="{{$item->course_id}}">
                <input type="hidden" name="attendance_date" id="attendance_date" value="{{$date}}">
                <input type="hidden" name="edit_date" id="edit_date" value="{{$date}}">
                <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                </td>
                <td>
                <input class="atten" type="hidden" name="attendance_id[]" id="attendance_id" value="
                {{$item->attendance_id}}" class="form-control"
                style="border:none;" readonly>    
                <label for=""> {{$item->student_first_name }} {{$item->student_last_name}}</label>                                        
                </td>
                <td align="center">
                <div id="ck-button-present">
                <label>
                <input style="cursor:pointer;" class="atten" type="radio"id="attendance_status"
                name="attendance_status[{{$item->attendance_id}}]" value="present"
                @if ($item->attendance_status == "present")
                checked
               @endif />
                <span>Present</span>
                </label>
                </div>
                </td>
    
                <td align="center">
                <div id="ck-button-absent">
                <label>
                <input class="atten" type="radio"id="attendance_status"
                name="attendance_status[{{$item->attendance_id}}]" value="absent"
                 @if ($item->attendance_status == "absent")
                 checked
                @endif />
                <span>Absent</span>
                </label>
                </div>
                </td>
    
                <td align="center">
                <div id="ck-button-late">
                <label>
                <input class="atten" type="radio"id="attendance_status"
                name="attendance_status[{{$item->attendance_id}}]" value="late"
                @if ($item->attendance_status == "late")
                 checked
                @endif />
                <span>Late</span>
                </label>
                </div>
                </td>
    
                <td align="center">
                <div id="ck-button-sick">
                <label>
                <input class="atten" type="radio"id="attendance_status"
                 name="attendance_status[{{$item->attendance_id}}]" value="sick"
                @if ($item->attendance_status == "sick")
                checked
               @endif />
                <span>Sick</span>
                </label>
                </div>
                </td>

                <td align="center">
                <input class="form-control" type="text" id="attendance_reason" name="attendance_reason[{{$item->attendance_id}}]" value="{{$item->attendance_reason}}"  />
               
                </td>
                
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
    <button type="submit" id="update_attendance" data-confirm="Are you sure you want to Update this Attendance ?" class="btn bg-teal btn-round "><i class="fa fa-refresh"></i> Update Attendance</button>
    </div>
    </form>
    </div> </div> </div>


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

$(document).ready(function() {

    var deleteLinks = document.querySelectorAll('#update_attendance');

    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            var choice = confirm(this.getAttribute('data-confirm'));

            if (choice) {
                document.getElementById("updateattendance_form").submit(); //form id
            }
        });
    }

})
</script>
@endsection