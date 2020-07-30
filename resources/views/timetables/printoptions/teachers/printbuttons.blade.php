{{-- -----------------------------PDF BUTTON--------------------- --}}


<!-- <div class="box box-primary"> -->
            <div class="box-body text-center">
            <div class="pull-right">
            @if(isset($class_name))
            <a href="{{url('print-single-teacher-timetable-pdf',$class_name->teacher_id)}}" class="btn btn  btn-x"> 
            @endif
            <i class="fa fa-file-pdf-o text-red" style="color:white"></i> PDF </a>

            <a href="{{url('export-excel-xlsx-level')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-excel-o text-green" style="color:white"></i> Excel </a>

            <a href="{{url('pdf-download-class-schedule')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-word-o text-blue" style="color:white"></i> Word </a>

            <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
            <i class="fa fa-print text-light-blue" style="color:white"></i> Print </a>
            </div>
            </div>
            <!-- </div> -->
            <div class="clearfix"></div>
            <div class="clearfix"></div>
