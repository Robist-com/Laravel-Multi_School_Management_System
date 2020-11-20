@extends('layouts.app')

@section('content')
    <section class="content-header">

<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true"> Fee Report</i></h1>
<a  class="pull-left btn btn-danger" href="{{route('Reports')}}" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-back-arrow" aria-hidden="true">Return</i></a>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">


        <div class="panel"></div>
          <div class="panel-body" style="border:0px solid">
        <div class="col-md-2">
        <label for="" class="fa fa-search text-red"> </label> <span style="font-size:13px; margin-left:35px"> Filter by Roll</span>
            <div class="form-group">
            <input type="text" name="roll_no" id="roll_no" class="form-control" placeholder="Enter Roll No.">
            </div>
        </div>

        <div class="col-md-4">
        <label for="" class="fa fa-search text-red"> </label> <span style="font-size:13px; margin-left:100px"> Filter by Grade & Class</span>
       <div class="input-group ">
       <select name="semester_id" id="semester_id" class="form-control select_2_single">
            <option value="" selected="true">Select Class</option>
            @foreach($semesters as $semester)
                <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
            @endforeach
            </select>
           <div class="input-group-addon">and</div>
           <select name="class_code" id="class_code" class="form-control select_2_single">
                <option value="" selected="true">Select Class</option>
                @foreach($classes as $classes)
                <option value="{{$classes->class_code}}">{{$classes->class_name}}</option>
            @endforeach
            </select>
       </div>
      </div>

      

        <div class="col-md-4">
        <label for="" class="fa fa-search text-red"> </label> <span style="font-size:13px; margin-left:100px"> Filter by Date Range</span>
       <div class="input-group input-daterange">
           <input type="text" name="from_date" id="from_date" readonly class="form-control" />
           <div class="input-group-addon">to</div>
           <input type="text"  name="to_date" id="to_date" readonly class="form-control" />
       </div>
      </div>
      <div class="col-md-2">
      <label for="">Filter</label>
      <div class="form-group">
       <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
       </div>
       </div>
       
     
    </div>
    </div>
    <br>

        @include('report.fee_report.table')

    </div>
</div>
</div> 
<!-- </div>  -->

    @endsection

@section('scripts')
    <script>
    $(document).ready(function(){
    $('#show-total').hide();
    $('#fee_report').hide();
      var date = new Date();
      
      $('.input-daterange').datepicker({
      todayBtn: 'linked',
      format: 'yyyy-mm-dd',
      autoclose: true
    });

    var _token = $('input[name="_token"]').val();

    fetch_data();

    function fetch_data_roll_no(roll_no = '')
    {
      $.ajax({
      url:"{{ route('showFeeReport') }}",
      method:"POST",
      data:{roll_no:roll_no,  _token:_token},
      //  dataType:"json",
      success:function(response)
      {
        // var output = '';
        
        $('#total_records').text(response.length);
        for(var count = 0; count < response.length; count++)
        {

        
        }
        $('#show-student-paid').html(response);
        $('class_name').html(response.class_name);
        $('#show-total').show();
        $('#print-student-transaction').show();
        $('#fee_report').show();
        // $('.show-student-paid').html(data) 
      }
      })
    }

    function fetch_data(class_code = '', semester_id = '')
    {
      $.ajax({
      url:"{{ route('showFeeReport') }}",
      method:"POST",
      data:{class_code:class_code, semester_id:semester_id, _token:_token},
      //  dataType:"json",
      success:function(response)
      {
        var output = '';
        
        for(var count = 0; count < response.length; count++)
        {

        }
        $('#show-student-paid').html(response);
        $('#show-total').show();
        $('#fee_report').show();
        $('#print-student-transaction').hide();
        // $('.show-student-paid').html(data) 
      }
      })
    }

  

    fetch_data();
    fetch_data_by_daterange();
    fetch_data_roll_no();

function fetch_data_by_daterange(from_date = '', to_date = '')
{
 $.ajax({
  url:"{{ route('showFeeReport') }}",
  method:"POST",
  data:{from_date:from_date, to_date:to_date, _token:_token},
//    dataType:"json",
  success:function(response)
  {
   var output = '';
   
   $('#total_records').text(response.length);
   $('#show-student-paid').html(response);
   $('#show-total').show();
   $('#fee_report').show();
   $('#print-student-transaction').hide();
   // $('.show-student-paid').html(data) 
  }
 })
}

    //Filter by Class Code 
$('#class_code').on('change',function(){

      var class_code = $('#class_code').val();
      var semester_id = $('#semester_id').val();

      if(class_code != '' &&  semester_id != '')
      {
      fetch_data(class_code, semester_id);
      $('#roll_id').show();
      $('#print-student-transaction').hide();

      }
      else if( semester_id == '' )
      {
        alert('Grade Field is required');
      }
      else
      {
      alert('Both Date is required');
      $('#show-total').hide();
      $('#fee_report').hide();
      }
    });


$('#filter').click(function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var roll_no = $('#roll_no').val();

      if(from_date != '' &&  to_date != '' && roll_no == '')
      {
        
      fetch_data_by_daterange(from_date, to_date);
      $('#roll_id').show();
      $('#print-student-transaction').hide();


      }
      else if(from_date == '' &&  to_date == '' && roll_no != '')
      {
        fetch_data_roll_no(roll_no)
        $('#roll_id').hide();
        $('#print-student-transaction').show();

      }
      else
      {
      alert('Both Date is required');
      $('#show-total').hide();
      $('#fee_report').hide();
      }
    });

    $('#refresh').click(function(){
      $('#semester_id').val('');
      $('#class_code').val('');
      $('#roll_no').val('');
      $('#from_date').val('');
      $('#to_date').val('');
      fetch_data();
      $('#show-total').hide();
      $('#fee_report').hide();
    });

    $('#class_code').on('change', function(){

      var cla = $(this).val();
      $('#class_name').text(cla);
      $('#roll_no').val('');
    });

    $('#semester_id').on('change', function(){
        var sem = $(this).val();
      $('#semester_name').text(sem);
      $('#roll_no').val('');
    })

    $('#roll_no').on('keyup', function(){
            $('#class_code').val('');
            $('#semester_id').val('');
            $('#from_date').val('');
            $('#to_date').val('');
        
    })

    $('#from_date').on('change', function(){
        var sem = $(this).val();
      $('#semester_name').text(sem);
      $('#roll_no').val('');
    })

    });
    </script>
    @endsection