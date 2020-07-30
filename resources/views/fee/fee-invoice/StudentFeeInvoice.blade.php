<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Payment Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>

<style>
    html.body{
        padding: 0px;
        margin:0px;
        width:100%;
        background:#fff;
        font-family:Arial, 'Sans Serif','Time News Romain';
        font-size:10px;
    }

    table{
        width:800px;
        margin:0 auto;
        text-align: left;
       border-collapse: collapse;
    }

    th{ padding-left:2px;}
    td{ padding: 2px;}

    .aeu{
        text-align: right;
        padding-right:10px;
        font-family:' time news romain', 'khmer OS Muol Light';
    }

    .line-top{
        border-left: 1px solid;
        padding-left:30px;
        weight:100%;
        font-family:' time news romain', 'khmer OS Muol Light';
    }

    .verify{
        font-family:' time news romain', 'khmer OS Muol Light';

    }

    .imageAeu{
        width:50px; height: 70px;
    }

    .th{
        background-color: #ddd;
        border: 1px solid;
        text-align:center;
    }
    .td{
        background-color: #fff;
        border: 1px solid;
        text-align:center;
    }

    .line-row{
        background-color:#fff;
        border: 1px solid;
        text-align: center;
    }

    #container{
        width: 100%;
        margin: 0 auto;
    }

    .khm-os{ font-family:' time news romain'; }
    .divide{ width: 100%; margin: 0 auto;}

    hr{
        width: 100%;
        margin-right: 0;
        margin-left: 0;
        padding: 0;
        margin-top:35px;
        margin-bottom:20px;
        border: 0 none;
        border-top: 1px dashed #322f32;
        background:none;
        height:0;
    }

    button{
        width: 100%;
        font-weight: bold;
        text-align: center;
        margin: 0 auto;
        cursor: pointer;
        height:100%;
    }

    .lenghth-limit{
            max-height: 350px; min-height: 350px;
    }

    .div-button{
        width: 100%;
        margin-top: 0;
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
        border-bottom: 1px solid;
        background: #ccc;
        height:50px;
    }
    @media print {
  footer {page-break-after: always;}
}
.print:last-child {
     page-break-after: auto;
}
</style>
<body>

<div class="div-button"><button onclick="printContent('divide')">Print</button></div>

<div id="divide">
            <?php for ($i = 0; $i < 1; ++$i) {
    ?>
  
        <div class="container">
        <div class="lenghth-limit print">
        
         {{---------------------}}
         <table class="print">
            <tr>
            
            <td style="padding-left:40px; width: 50px;">
                <img src="{{asset('FrontEnd/img/Logo_of_UTG.gif')}}" alt="logo" class="imageAeu" srcset="" >
                {{-- <img src="{{ asset ('img/Logo_of_UTG.gif')}}" class="imageAeu"> --}}

            </td>
            <td class="aeu">
                {{-- <b style="font-weight:normal;">Welcome To</b> --}}
                {{-- <b>Success University School</b> --}}
                <img src="{{url('images/markssheet/success.png')}}"style="width:50%; height:50px; margin-right:250px" class="imageAeu" alt="">

            </td><br>
            <td class="line-top1" style="">
        <b style="font-weight:normal;margin-right:300px;weight:100px;"><em>Hello</em>
            @if($invoice->gender == 0)Mr. @else Mrs. @endif {{$invoice->last_name}} <div class="d"></div></b>
                {{-- <br> --}}
                {{-- <b>RECEIPT</b> --}}
            </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: right;"></td>
                <td colspan="0" style="text-align: right; padding-left: 80px;">
                    <b>Invoice N<sup>o</sup>: {{ sprintf("%05d", $invoice->invoice_id)}}</b>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;"></td>
                <td colspan="2" style="text-align: right; padding-left: 60px;">
                    <b>Transaction Date N<sup>o</sup>: {{ date('d-M-Y',strtotime($invoice->transact_date))}}</b>
                </td>
            </tr>

            <tr>
                {{-- <td colspan="2" style="text-align: right;"></td> --}}
                <td colspan="2" style="text-align: left; padding-left: 50px;">
                <h3 style="text-transform:uppercase; font-weight:bold"> {{ $invoice->semester_name}}  <b style="color:red">{{$invoice->department_name}}</b></h3>
                </td>
            </tr>

         </table>

         {{--------------------------}}
         
            <table>
            <tr>
            <td style="width: 220px; padding: 5px 0px;">
                Roll No:<b> {{ $roll_no->username}}</b>
            </td>

            <td style="width: 200px; padding: 5px 0px;">
                 Name: <b>{{ $invoice->first_name ." ".$invoice->last_name}}</b>
            </td>

            <td style="width: 200px; padding: 5px 0px;">
                {{-- Last Name: <b>{{  }}</b> --}}
            </td>
            <td>Gender:
                <b>
                    @if ($invoice->gender==0) Male @else Female @endif
                </b>
            </td>
            </tr>
            </table>
        
            {{-----------------------}}

            {{-----------------------}}
            <table class="print">
            <thead>
                <tr>
                 {{-- <th class="th" style="text-align:left;">Description</th> --}}
                 <th style="width: 70px;" class="th">Admission Fee</th>
                 <th style="width: 70px;" class="th">Semester Fee</th>
                 {{-- <th style="width: 70px;" class="th">Dis%</th> --}}
                 <th style="width: 70px;" class="th">Amount</th>
                 <th class="th" style="width: 70px;">Paid Amount</th>
                 <th class="th" style="width: 70px;">Balance</th>
                </tr>
            </thead>

            <tbody>
            <tr>
                    <td class="line-row">
                               $ {{ number_format($invoice->admissionFee,2)}}
                    </td>

                    <td class="line-row">
                               $ {{$invoice->semesterFee,2}}
                    </td>

                    <td class="line-row">
                               $ {{ number_format($studentFee->amount,2)}}
                    </td>

                    <td class="line-row">
                               $ {{ number_format($invoice->paid_amount,2)}}
                    </td>

                    <td class="line-row">
                               $ {{ number_format($studentFee->amount-$totalPaid,2)}}
                    </td>
                    </tr>
            </tbody>
            <tr>
                <table class="table print" id="classAssignings-table">
                    <div class="panel">
                   <thead>
                        <tr>
            <th style="width: 70px;" class="th">TimeTable</th>
                        </tr>
                    </thead> 
                    <tbody class="td">
                    <td><div class=""><input type="hidden" name="" id=""></div></td>
                        @foreach ($timeTable as $timetable)
                            <tr>
                                {{-- <td class="col-md-6"><b id="first_name">{{$timetable->teacher_name}}</b><hr></td> --}}
                                <td class="col-md-6"><b id="first_name">{{$timetable->details}}</b><hr></td>
                            </tr>
                    @endforeach
                    </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <b style="vertical-align:top; float:left;margin-left:90px ">Cashier: {{$invoice->name}}</b>
                              <b style="margin-left:210px">  Printed By: {{Auth::user()->name}}</b> 
                            <br><br>
                               <p style="margin-left:250px; margin-bottom:9px;">Printed Date: {{date('d-M-Y H:i:s A')}}</p> 
                        </td>
                        <br>
                    </tr>
                    
                    <tr>
                        <td style="font-size: 15px; text-align: center;">
                            #92, Bailo Kanteh Street SerreKunda Easte, Banjul The Gambia, Postal Code: 00220
                        </td>
                        </tr>
                        <tr>
                        <td style="font-size: 15px; text-align: center;">
                            Phone:(+220) 4396236  Email: latrikundaupper@gmail.com
                        </td>
                        </tr>
                       
                </tfoot>
                    
                </table>
            </tr>
            
            </table>
                
            </div>
        </div>
{{-- <hr> --}}
                {{-- <br><br><br><br>
                <br><br><br><br> --}}
                {{-- <br><br><br><br>
                <br> --}}
    
        </div>
    </div>

        @if($i==0)
        <br>
        {{-- <hr> --}}
        @endif
        <?php
}?>

</div>

{{-----------------------}}
 <script type="text/javascript"> 
 
        function printContent(el){
            var restorepage = document.body.innerHTML;
            var printContent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = restorepage;
            window.close(); 
         }
 </script>



{{-----------------------}}
    
</body>
</html>