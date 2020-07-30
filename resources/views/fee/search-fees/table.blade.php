<div class="table-responsive">
<h1 style="font-weight:bold;"><i class="fa fa-money" aria-hidden="true"></i> COLLECT FEES</h1>
<div class="panel"></div>
<div class="panel-body" style="border:0px solid">
    <div class="col-md-3">
    <label for="">Roll No:</label>
        <div class="form-group">
        <input type="text" name="roll_no" id="roll_no" class="form-control" placeholder=" Search Student by Roll No.">
        </div>
    </div>

    <div class="col-md-3">
    <label for="">Grade</label>
        <div class="form-group">
        <select name="semester_id" id="semester_id" class="form-control select_2_single">
        <option value="" selected="true">Select Grade</option>
        @foreach($semester as $semester)
            <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
        @endforeach
        </select>
        </div>
    </div>

    <div class="col-md-3">
    <label for="">Class</label>
        <div class="form-group">
        <select name="class_code" id="class_code" class="form-control select_2_single">
            <option value="" selected="true">Select Class</option>
            @foreach($classes as $classes)
            <option value="{{$classes->class_code}}">{{$classes->class_name}}</option>
        @endforeach
        </select>
        </div>
    </div>
    <div class="col-md-3">
    <label for="">Filter</label>
        <div class="form-group">
        <!-- <button class="btn btn-warning btn-xs" id="filter" style="height:30px">Find</button> -->
        <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
        </div>
    </div>
</div>
</div>
<br>
<div class="panel panel-default" id=collect_fee>
<div class="panel-heading">
    <h4 style="font-weight:bold;  color:red">STUDENT FOUND</h4> <b id="show-total" style="margin-left:80%"><span id="total_records" class="btn btn-danger"></span> </b> 
</div>
<!-- <h3 style="text-align:center; font-size: 20px; font-weight:bold" id="show-total"><span id="total_records" class="btn btn-danger"></span>  Paid Students Found <b > <label id="roll_id"> in -- Class -- <label for="" id="class_name" class="btn btn-info"></label>  -- <span>Grade -- <label for="" id="semester_name" class="btn btn-warning"></label></span></label></h3> -->
    <div class="panel-body" style="padding-bottom:4px;">

     <form action="{{ count($readStudentFee) != 0? route("exstraPay")  : route("savePayment")}}" method="POST" id="frmPayment">
     @csrf

        <div id="show-student-paid">

        </div>
        @include('fee.fee-payment-class-detail')

        </div>
        <div class="modal-footer">
                        <input type="submit" id="btn-go" name="btn-go" class="btn btn-success btn-payment pull-right" value="{{count($readStudentFee)!= 0 ? 'Update Pay' : 'Submit Payment'}}">
                        @if(count($readStudentFee)!= 0)
                        <a href="{{ url('printInvoice','invoice_id') }}" class="btn btn-primary btn-sm" target="_blank">Print</a>
                        @endif
                    </div>
    </form>
    <div class="panel-body">
                @if(count($readStudentFee)!= 0)
                @include('fee.list.studentFeelist')
                <input type="hidden" value="0" id="disabled">
                @endif
            </div>
            <div class="tab-pane" id="messages">
            </div>
          </div>
    </div>

    <div class="panel panel-default" id=multi_collect_fee>
<div class="panel-heading">
<input type="checkbox" name="" id="" style="margin-left:5%">
    <h4 style="font-weight:bold; margin-left:10%; color:red">STUDENT FOUND</h4> <b id="show-multi_total" style="margin-left:60%"><span id="multi_total_records" class="btn btn-danger"></span> </b> 
</div>
<!-- <h3 style="text-align:center; font-size: 20px; font-weight:bold" id="show-total"><span id="total_records" class="btn btn-danger"></span>  Paid Students Found <b > <label id="roll_id"> in -- Class -- <label for="" id="class_name" class="btn btn-info"></label>  -- <span>Grade -- <label for="" id="semester_name" class="btn btn-warning"></label></span></label></h3> -->
    <div class="panel-body" style="padding-bottom:4px;">


    {!! Form::open(array('route' => 'MultipleSavePayment', 'id'=> 'mult', 'method'=>'post')) !!}
    <!-- <form action="{{ count($readStudentFee) != 0? route("exstraPay")  : route("savePayment")}}" method="POST" id="frmPayment"> -->
     @csrf

        <div id="show-multi-student-paid">

        </div>
        @include('fee.fee-payment-class-detail')

        </div>
        <div class="modal-footer">
                        <input type="submit" id="btn-go" name="btn-go" class="btn btn-success btn-payment pull-right" value="{{count($readStudentFee)!= 0 ? 'Update Pay' : 'Submit Payment'}}">
                        @if(count($readStudentFee)!= 0)
                        <a href="{{ url('printInvoice','invoice_id') }}" class="btn btn-primary btn-sm" target="_blank">Print</a>
                        @endif
                    </div>
    </form>


            <div class="panel-body">
                @if(count($readStudentFee)!= 0)
                @include('fee.list.studentFeelist')
                <input type="hidden" value="0" id="disabled">
                @endif
            </div>
            <div class="tab-pane" id="messages">
            </div>
          </div>
    </div>
