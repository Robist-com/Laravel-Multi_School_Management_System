@php 
    use App\Institute;
    $institute = Institute::first();
@endphp
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="main.js"></script>
<!------ Include the above in your HEAD tag ---------->
@include('fee.fee-invoice.fee_invoice_style')
<button onclick="printContent('invoice')" class="btn btn-info" ><i class="fa fa-print"></i> Print</button>

<!--Author      : @arboshiki-->
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            {{-- <div class="div-button"><button onclick="printContent('invoice')">Print</button></div> --}}

            {{-- <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button> --}}
        </div>
        {{-- <hr> --}}
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="#">
                            <img src="{{asset('institute_logo/' .$institute->image)}}" style="width: 105px;" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                        {{$institute->name}}
                        <!-- <img src="{{url('images/markssheet/success.png')}}"style="width:50%; height:50px;" alt=""> -->
                        </h2>
                        <div>#92, {{$institute->address}}, Banjul The Gambia, Postal Code: {{$institute->post_code}}</div>
                        <div>Phone:({{$institute->code}}) {{$institute->phoneNo}}  </div>
                        <div>Email: {{$institute->email}}</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"> @if($invoice->gender == 0)Mr. @else Mrs. @endif {{$invoice->last_name}}</h2>
                        <div class="address">Roll N<sup>o</sup> {{ $roll_no->username}}</div>
                        <div class="email"> Name: <b>{{ $invoice->first_name ." ".$invoice->last_name}}</b></div>

                        <hr>
                        <h2 class="grade_name"><b>{{$invoice->semester_name}}</b> <b style="margin-left:80%">{{$invoice->class_name}}</b></h2>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE N<sup>o</sup>: {{ sprintf("%05d", $invoice->invoice_id)}}</h1>
                        {{-- <div class="date">Date of Invoice: 01/10/2018</div> --}}
                        <div class="date">Date of Transaction: {{ date('d-M-Y',strtotime($invoice->transact_date))}}</div>
                        <div class="date">Due Date: 30/10/2018</div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">TYPE</th>
                            <th class="text-right">ADMISSION FEE</th>
                            <th class="text-right"> FEE</th>
                            <th class="text-right">FEE AMOUNT </th>
                            <th class="text-right">PAID AMOUNT</th>
                            <th class="text-right">BALANCE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="no">{{$invoice->invoice_id}}</td>
                            <td class="text-center"><h3>
                                <p>
                                    {{$invoice->fee_type}}
                                </p>
                            </td>
                            <td class="unit">$ {{ number_format($invoice->admissionFee,2)}}</td>
                            <td class="qty"> $ {{number_format($invoice->semesterFee,2)}}</td>
                            <td class="total">$ {{ number_format($studentFee->amount,2)}}</td>
                            <td class="total">$ {{ number_format($invoice->paid_amount,2)}}</td>
                            <td class="total"> $ {{ number_format($invoice->balance,2)}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>$ {{ number_format($invoice->paid_amount,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>$ {{ number_format($invoice->paid_amount,2)}}</td>
                        </tr>
                    </tfoot>
                </table>
                
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div><br>
                    <div class="notice"><sup>All payment are not refundable or transferable.</sup></div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
            </main>
            <footer>
                <p style="margin-right:80%;">Cashier: {{$invoice->name}}</p>
                <p style="margin-left:80%;">  Printed By: {{Auth::user()->name}}</p> 
                <p>Printed Date: {{date('d-M-Y H:i:s A')}}</p> 
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>

<script>
    // $('#printInvoice').click(function(){
    //         Popup($('.invoice')[0].innerHTML);
    //         function Popup(data) 
    //         {
    //             var restorepage = document.body.innerHTML;
    //             var printContent = document.getElementById(data).innerHTML;
    //             // document.body.innerHTML = printContent;
    //             window.print();
    //             // document.body.innerHTML = restorepage;
    //             return true;
    //         }
    //     });
    $(document).ready(function(){
        
    })

    function printContent(el){
     var restorepage = document.body.outerHTML;
     var printContent = document.getElementById(el).outerHTML;
     document.body.outerHTML = printContent;
     window.print();
     document.body.outerHTML = restorepage;
     window.close(); 
  }
</script>