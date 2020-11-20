

@php 
    use App\Institute;
@endphp
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="main.js"></script>
<!------ Include the above in your HEAD tag ---------->
@include('admins.id_cards.id_card_style')
<button onclick="printContent('invoice')" class="btn btn-info" ><i class="fa fa-print"></i> Print 1</button>

<!--Author      : @arboshiki-->
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            {{-- <div class="div-button"><button onclick="printContent('invoice')">Print</button></div> --}}

            {{-- <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button> --}}
        </div>
        {{-- <hr> --}}
    </div>

    <style>
        .photo img {
            width: 80px;
            height:110px;
    		margin-top: 15px;
		}
    </style>
    @foreach($institute as $institute)
    <div class="invoice overflow-auto">
        <div style="min-width: 300px">
            <header>
           
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="#">
                            <img src="{{asset('institute_logo/' .$institute->logo)}}" style="width: 105px;" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                        {{$institute->name}}
                        <!-- <img src="{{url('images/markssheet/success.png')}}"style="width:50%; height:50px;" alt=""> -->
                        </h2>
                        
                    </div>
                </div>
            </header>
           
            <main>
                <div class="row contacts">
                <div class="col invoice-to ">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"> @if($institute->gender == 0)Mr. @else Mrs. @endif {{$institute->last_name}}</h2>
                        <div class="address">Roll N<sup>o</sup> {{ $institute->roll_no}}</div>
                        <div class="email"> Name: <b>{{ $institute->first_name ." ".$institute->last_name}}</b></div>

                        <hr>
                        <div class="photo">
                        <img src="{{asset('student_images/' .$institute->image)}}">
                        </div>
                        <h2 class="grade_name"><b>1</b> <b style="margin-left:80%">{{$institute->class_name}}</b></h2>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE N<sup>o</sup>: {{ sprintf("%05d", $institute->student_id)}}</h1>
                        {{-- <div class="date">Date of Invoice: 01/10/2018</div> --}}
                        <div class="date">Date of Transaction: </div>
                        <div class="date">Due Date: 30/10/2018</div>
                    </div>
                </div>
                
                
                <!-- <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div><br>
                    <div class="notice"><sup>All payment are not refundable or transferable.</sup></div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div> -->
            </main>
            <!-- <footer>
                <p style="margin-right:80%;">Cashier: </p>
                <p style="margin-left:80%;">  Printed By: {{Auth::user()->name}}</p> 
                <p>Printed Date: {{date('d-M-Y H:i:s A')}}</p> 
            </footer> -->
          
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
    @endforeach
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
     var style = "<style>";
            style = style + "table {width: 0%; font: 17px Calibri;}";
            style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
            style = style + "table, th, tr td {border: solid 2px #DDD; border-collapse: collapse;";
            style = style + "padding: 2px 3px; text-align: center;}";
            
            style = style + "padding: 2px 3px; text-align: center;}";
            style = style + "</style>";

            // var win = window.open('', '', 'height=700,width=1000');
            win.document.write(style); 

     document.body.outerHTML = restorepage;
     window.close(); 
  }
</script>