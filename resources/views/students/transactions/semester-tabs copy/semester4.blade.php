
            <style>
              .names{
              color: red;
              font-family: 'Times New Roman', Times, serif;
              font-display: bold;
              font-size: large;
              }
              table{
                  border: 0px solid;
                  width:100%;
              }
              .vl {
          border-left: 6px solid green;
          height: 500px;
          position: absolute;
          left: 50%;
          margin-left: -3px;
          top: 0;
          }
          h6{
          display: inline-block
          }
          h5{
          display: inline-block
          }

.bordered-table {
  border:1px solid black;
  border-collapse: collapse;
}
.bordered-tr {
border-left: 1px solid #000;
border-right: 1px solid #000;
}

.bordered-td {
  border-left: 1px solid black;
  border-right: 1px solid black;
  border-bottom: 1px solid black;
}

.bordered-th {
  border-left: 1px solid #000;
  border-right: 1px solid #000;
  border-bottom: 1px solid black;

  text-align: center;
}

          </style>


  {{-- <body> --}}

    <div class="card">
      <div class="panel">
        <div class="panel-heading">
          <div class="card">
            <h3 style="text-transform:uppercase; font-weight:bold; margin-left:30%;">
              @if(isset($class_name))smester 4 <b style="color:red">TIMETABLE</b> PLAN</h3>
              @else
                <b style="color:red">TIMETABLE</b> PLAN</h3>
              @endif
            </div>
        </div>
        </div>
      </div>

     <div class="card">
      <div class="table-responsive">
        <table class="bordered-table">
            <thead>
                <tr class="bordered-tr">
                  <th class="bordered-th">#</th>
                  <th class="bordered-th">Transaction Date</th>
                  <th class="bordered-th">Cashier</th>
                  <th class="bordered-th">Paid Amount ($)</th>
                  <th class="bordered-th">Remark</th>
                  <th class="bordered-th">Description</th>
                  <th class="bordered-th">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($studenttransaction) > 0)
                @foreach ($studenttransaction as $n => $transaction)
                @if ($transaction->semester_id == 4)

                        <tr class="bordered-tr">
                            <td class="bordered-td" style="text-align: center;background-color:#34495E; color:#fff">{{++$n}}</td>
                            <td class="bordered-td" style="text-align: center;">{{date('d-M-Y',strtotime($transaction->transaction_date))}}</td>
                            <td class="bordered-td" style="text-align: center;">{{$transaction->first_name}}</td>
                            <td class="bordered-td" style="text-align: center;"><span class="fa fa-usd"></span>  {{number_format($transaction->paid_amount,2)}}</td>
                            <td class="bordered-td" style="text-align: center;">{{$transaction->remark}}</td>
                            <td class="bordered-td" style="text-align: center;">{{$transaction->description}}</td>

                            <td style="text-align: center;width:112px;">
                                <a href="{{ route ('StudentInvoicePrint', [$transaction->invoice_id])}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a>
                            </td>
                  @endif
                 @endforeach
                @else
                    <tr class="bordered-tr">
                      <td colspan="12" class=" bordered-td">
                       <div class="alert alert-danger text-center" style="font-weight:bolder">
                        {{-- No TimeTble Found for {{$teacher->first_name}} {{$teacher->last_name}} --}}
                       </div>
                      </td>
                    </tr>
                @endif
            </tbody>
        </table>
      </div>
  </div><br>
  {{-- <p style="margin-left:250px; margin-bottom:9px;">Printed Date: {{date('d-M-Y H:i:s A')}}</p>  --}}
    {{-- <br>
  <table class="bordered-table">
       <tbody>
         <tr>
           <td class="bordered-td"style="text-align: center;">
            <br>
            Approved,
            Major Head / Secretary

            <br><br><br><br>
              <sup>
                name:
              </sup>
          </td>
           <td class="bordered-td"style="text-align: center;">
            <br>
            Approved By,
            Academic Lecturer

            <br><br><br><br>
              <sup>
                name:
              </sup>
          </td>
           <td class="bordered-td"style="text-align: center;">
            <br>
            Approved,
            Professor

            <br><br><br><br>
              <sup>
                name:
              </sup>
          </td>
         </tr>
       </tbody>
     </table> --}}
  {{-- </body>
  </html>
       --}}
