<div class="modal fade" id="ReportList" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
      <div class="modal-content">
        <div class="modal-header-store">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          <h5 class="modal-title" id="exampleModalLongTitle"> Attendance Report</h5>
        </div>
        <div class="modal-body">
@php 
if(isset($class_id)){

}else{
 $class_id ='';
}
 @endphp

<div class="panel  panel-default"> 
                    
    <div class="panel-heading">
      <!-- <h3><a href="{{route('attendances.index')}}"><button class="pull-right" style="margin-left:300px;margin-bottom:50px" title="Back to Attendance List">Back</button></a></h3> -->
      <h3 style="font-weight:bold;text-transform: uppercase; text-align:left">
       <i class="fa fa-calendar"></i> GENERATE ATTENDANCE<b style="color:red"> REPORT </b>
      </h3>
      </div>
      <div class="panel-body">
      <div  id="wait"></div>

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#classReport">
        Class Wise Report
      </button>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#monthReport">
       Monthly Report
      </button>

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#yearReport">
        Yearly Report
       </button>

            </div>
        </div>

            {{-- </div> --}}
           

        @section('scripts')
         <script>
            $('#classReport').on('show.bs.modal', function () {
                var modalParent = $(this).attr('data-modal-parent');
                $(modalParent).css('opacity', 0);
            });
            
            $('.modal-child').on('hidden.bs.modal', function () {
                var modalParent = $(this).attr('data-modal-parent');
                $(modalParent).css('opacity', 1);
            });



            $(function () {
            $('#attendance_month').datetimepicker({
                viewMode: 'months',
                format: 'MMMM'
            });

            $('#attendance_year').datetimepicker({
                viewMode: 'years',
                format: 'YYYY'
            });

            $('#monthly_date').datetimepicker({
                viewMode: 'months',
                format: 'MMMM'
            });

            $('#yearly_date').datetimepicker({
                viewMode: 'years',
                format: 'YYYY'
            });

            $('#month').datetimepicker({
                viewMode: 'months',
                format: 'MMMM'
            });

            $('#year').datetimepicker({
                viewMode: 'years',
                format: 'YYYY'
            });

            
        });
    </script>
@endsection

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
@include('attendances.attendance_report.modal.class.class_report')
@include('attendances.attendance_report.modal.month.month_report')
@include('attendances.attendance_report.modal.year.year_report')