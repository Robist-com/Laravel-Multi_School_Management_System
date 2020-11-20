@extends('layouts.app')
<title>Date Range Fiter Data in Laravel using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
 </head>
@section('content')
@include('table_style') 
    <section class="content-header">
<h1 class="pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 50px"><i class="fa fa-money" aria-hidden="true"> Student Fee Report</i></h1>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            <div class="pull-right">
            <a href="{{url('pdf-download-class')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-pdf-o text-red" style="color:white"></i> PDF </a>

            <a href="{{url('export-excel-xlsx-class')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-excel-o text-green" style="color:white"></i> Excel </a>

            <a href="{{url('pdf-download-class')}}" class="btn btn  btn-x"> 
            <i class="fa fa-file-word-o text-blue" style="color:white"></i> Word </a>

            <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
            <i class="fa fa-print text-light-blue" style="color:white"></i> Print </a>
            </div>
           

        <div class="clearfix"></div>
        <div class="col-md-5">
       <div class="input-group input-daterange">
           <input type="text" name="from_date" id="from_date" readonly class="form-control" />
           <div class="input-group-addon">to</div>
           <input type="text"  name="to_date" id="to_date" readonly class="form-control" />
       </div>
      </div>
      <div class="col-md-2">
       <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
       </div>
     
       <div class="clearfix"></div>
       <br>
        <div class="panel-body" style="padding-bottom:4px;">
        <table class="table table-boredred table-hover table-striped table-condesed" class="display" style="width:100%" id="fee_report">
    <tbody id="show-student-paid">
    @foreach($data as $key => $data)
        <tr>
        <td style="text-align:center;">{{$key+1}}</td>
        <td style="text-align:center;">{{$data->name}}</td>
        <td style="text-align:center;">{{$data->fee_type}}</td>
        <td style="text-align:center;">{{$data->first_name}} {{$data->last_name}}</td>
        <td style="text-align:center;">{{$data->transaction_date}}</td>
        <td style="text-align:center;">{{$data->school_fee}}</td>
        <td style="text-align:center;">{{$data->student_fee}}</td>
        <td style="text-align:center;">{{$data->paid_amount}}</td>
        <td style="text-align:center;">{{$data->balance}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@csrf
        
</div>
</div>
</div>
</div>



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

 function fetch_data(from_date = '', to_date = '')
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
    // $('.show-student-paid').html(data) 
   }
  })
 }

 $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   fetch_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
   $('#show-total').hide();
   $('#fee_report').hide();
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  fetch_data();
  $('#show-total').hide();
  $('#fee_report').hide();
 });

 $('#fee_report').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );


});

// $('#from1').datetimepicker({
//             format: 'YYYY-MM-DD',
//             useCurrent: false

//         })

// $('#from').datepicker({
//           todayBtn: 'linked',
//           changeMonth:true,
//           changeYear:true,
//           format: 'yyyy-mm-dd',
//           autoclose: true,
//           onSelect: function(from){
//             showFee(from,$('#to').val())
//           }
//       });

          
// $('#to').datepicker({
//           todayBtn: 'linked',
//           changeMonth:true,
//           changeYear:true,
//           format: 'yyyy-mm-dd',
//           autoclose: true,
//           onSelect: function(to){
//             showFee($('#from').val(),to)
              
//             }
//           });

//           //------------------------

//           function showFee(from,to){
//               $.get("{{ route('showFeeReport')}}",{from:from,to:to},function(data){
                  
//                 $('.show-student-paid').html(data) 
//               })
//           }
</script>
@endsection