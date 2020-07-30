<table class="table table-boredred table-hover table-striped table-condesed" class="display" style="width:100%" id="fee_report">
    <thead>
        <tr>
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">Accountant</th>
            <th style="text-align:center;">Student ID</th>
            <th style="text-align:center;">Student Name</th>
            <th style="text-align:center;">Transaction Date</th>
            <th style="text-align:center;">School Fee</th>
            <th style="text-align:center;">Discount (%)</th>
            <th style="text-align:center;">Student Amount</th>
            <th style="text-align:center;">Paid Amount</th>
        </tr>
        <tbody>
            @foreach($fees as $key => $fee)
            <tr>
                <td style="text-align:center;">{{++$key}}</td>
                <td style="text-align:center;">{{$fee->name}}</td>
                <td style="text-align:center;">{{sprintf("%05d",$fee->student_id)}}</td>
                <td style="text-align:center;">{{$fee->first_name." ".$fee->last_name}}</td>
                <td style="text-align:center;">{{$fee->transaction_date}}</td>
                <td style="text-align:center;">${{number_format($fee->school_fee,2)}}</td>
                <td style="text-align:center;">{{$fee->discount}}%</td>
                <td style="text-align:center;">${{number_format($fee->student_fee,2)}}</td>
                <td style="text-align:center;">${{number_format($fee->paid,2)}}</td>
            </tr>
            @endforeach
        </tbody>
    </thead>
</table>

<script>
$(document).ready(function() {
    $('#fee_report').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>