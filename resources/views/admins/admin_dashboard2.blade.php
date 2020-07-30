@include('dashboard_style')


    <div class="content" id="dasboard2" style="display:none">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

            <div class="row">
    

      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-gray"><i class="fa fa-money" ></i></span>

          <div class="info-box-content">
            <span class="info-box-text alert-2 "><a  href="{{url('mark/entry')}}">FEES TABLE</a></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <div class="responsive">
        <table  class="table table-hover" id="allfees-table">
        <thead>
            <tr>
        <th>Photo</th>
        <th>Roll No.</th>
        <th>Grade</th>
        <th>Fee Type</th>
        <th>Fee Amount</th>
        <th>Paid Amount</th>
        <th>Balance</th>
        <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($student_fees as $fees)
            <tr>
            <td><img src="{{asset('student_images/'.$fees->image)}}" alt=""
            class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
            <td>{{ $fees->username }}</td>
            <td>{{ $fees->semester_name }}</td>
            <td>{{ $fees->fee_type }}</td>
            <!-- <td>{{ $fees->fee_structure_id }}</td> -->
            <td>{{ number_format($fees->semesterFee,2) }}</td>
            <td>{{ number_format($fees->paid_amount,2) }}</td>
            @if($fees->balance > 0.00)
            <td><label for="" class="btn btn-danger btn-xs">{{ $fees->balance}}</label></td>
            @else
            <td><label for="" class="btn btn-info btn-xs">Completed</label></td>
            @endif
                <td>
                    {!! Form::open(['route' => ['deleteStudentFee', $fees->student_fee_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ url('all/student/transactions', [$fees->student_id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this? This will delete the related table details!')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
          <!-- </div> -->
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

 <!-- /.col -->
 <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-tasks"></i></span>
          <div class="info-box-content">
          <span class="info-box-text alert-2 "><a  href="{{url('generate-teacher-timetable')}}"> TRANSACTIONS TABLE</a></span>

          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      
      <!-- /.col -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <div class="responsive">
        <table  class="table table-hover" id="allfees-table">
        <thead>
            <tr>
        <th>Photo</th>
        <th>Roll No.</th>
        <th>Grade</th>
        <th>Fee Type</th>
        <th>Fee Amount</th>
        <th>Paid Amount</th>
        <th>Balance</th>
        <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transactions as $fees)
            <tr>
            <td><img src="{{asset('student_images/'.$fees->image)}}" alt=""
            class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
            <td>{{ $fees->username }}</td>
            <td>{{ $fees->semester_name }}</td>
            <td>{{ $fees->fee_type }}</td>
            <!-- <td>{{ $fees->fee_structure_id }}</td> -->
            <td>{{ number_format($fees->semesterFee,2) }}</td>
            <td>{{ number_format($fees->paid_amount,2) }}</td>
            @if($fees->balance > 0.00)
            <td><label for="" class="btn btn-danger btn-xs">{{ $fees->balance}}</label></td>
            @else
            <td><label for="" class="btn btn-info btn-xs">Completed</label></td>
            @endif
                <td>
                    {!! Form::open(['route' => ['deleteStudentFee', $fees->student_fee_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ url('all/student/transactions', [$fees->student_id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this? This will delete the related table details!')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
          <!-- </div> -->
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      
     

      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-tasks">2</i></span>
          <div class="info-box-content">
          <span class="info-box-text alert-2 "><a  href="{{url('send-class-homework')}}"> Home Works</a></span>

          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

            </div>
        </div>
        <div class="text-center">

        </div>
    </div>


   <!-- Main content -->
   <!-- <section class="content"> -->
    <!-- Info boxes -->

@section('scripts')
<script>
  
$(document).ready(function(){
  $('#dasboard2').hide();
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let facultyId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('faculties.update.status') }}',
            data: {'status': status, 'faculty_id': facultyId},
            success: function (data) {
                console.log(data.message);
                // success: function (data) {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
// }
            }
        });
    });

$('#change_dashboard2').on('click', function(){
  $('#dasboard1').hide();
  $('#dasboard2').show();
})

$('#change_dashboard1').on('click', function(){
  $('#dasboard2').hide();
  $('#dasboard1').show();
})



});
</script>
@endsection