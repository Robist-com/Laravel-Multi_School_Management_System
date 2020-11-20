{{-- -----------------------------PDF BUTTON--------------------- --}}


<!-- <div class="box box-primary"> -->
            <!-- <div class="col-md-12 col-sm-6 col-xs-12"> -->
            <!-- <div class="pull-right"> -->
            @if(isset($class_name))
            <a href="{{url('print-single-teacher-timetable-pdf',$class_name->teacher_id)}}" class="btn btn  btn-x" data-toggle="tooltip" data-placement="top" title="download timetable pdf"> 
            @endif
            <i class="fa fa-file-pdf-o text-red" style="color:red" ></i> PDF </a>

            <a href="{{url('export-excel-xlsx-level')}}" class="btn btn  btn-x" data-toggle="tooltip" data-placement="top" title="download timetable excel"> 
            <i class="fa fa-file-excel-o text-green" style="color:green"></i> Excel </a>

            <a href="{{url('pdf-download-class-schedule')}}" class="btn btn  btn-x" data-toggle="tooltip" data-placement="top" title="download timetable ms-word"> 
            <i class="fa fa-file-word-o text-blue" style="color:blue"></i> Word </a>

            <a href="#" onclick="window.print();" class="btn btn  btn-x" data-toggle="tooltip" data-placement="top" title="print timetable"> 
            <i class="fa fa-print text-light-blue" style="color:dark"></i> Print </a>
            <!-- </div> -->
            <!-- </div> -->
            <!-- </div> -->
            <div class="clearfix"></div>
            <div class="clearfix"></div>
