
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Academic Information System| (AIS)</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
.title{
    color: #636b6f;
    /* padding: 0 5px; */
    font-size: 25px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-decoration: underline;
    text-transform: uppercase;
    float:right; color:blue;margin-top:20px;margin-right: 15%;
    /* width:30px; */
}
.pulll{
    text-align:center;
    border:1px solid;
    border-top:1px solid;
    border-bottom:1px solid
}
td1{
    text-align:center;
    border:1px solid
}
</style>
<!-- <body onload="window.print();"> -->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
    <small class="pull-right"><?php echo date('D-M-Y'); ?></small>
    <div class="navbar-custom-menu">
      <div class="col-xs-12">
      <!-- <a href="#"><img src="{{asset('FrontEnd/img/Logo_of_UTG.gif')}}" alt="logo" srcset="" style="width:70px; margin-left:30px"></a> -->
      <!-- <h1 class="title">Academic Information System</h1> -->


        <!-- </h2> -->
      </div>
      <!-- /.col -->
    </div>
    <br>
    <div class="row no-print">
        <div class="col-xs-12">
          <!-- <a href="print-admission.php" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
          <button type="button" class="btn btn-danger pull-right" >
            <!-- <a href="" style="color:#fff"><i class="fa fa-download"></i> Generate PDF</a> -->
          <!-- </button> -->
          <button type="button" class="btn btn-info pull-right" style="margin-right: 5px;"><i class="fa fa-print" onclick="window.print();"></i> Print
          </button>
        </div>
      </div>

    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col" style="margin-left: 40px;" >
        <address>
        
        <div class="container-fluid">
            <div class="row">
                <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
                        <div class="" id="" >
                            <button class="btn-print" onclick="printDiv('printableArea')">Print</button>
                              @for($i=0;$i<count($gmcqs);$i++)
                                  <?php  
                                  $mcqNum = 1; 
                                  $shortNum = 1; 
                                  $longNum = 1; 
                                  ?>
          <div id="printableArea">
          <div class="wraperResult1">
          <div class="resHdr">
          <img src="{{asset('FrontEnd/img/Logo_of_UTG.gif')}}" alt="" class="resLogo">
          <div class="schoolIdentity">
         <img src="{{url('images/markssheet/school-title.png')}}" alt="">
         <div class="hdrText hdr-result">
        <div style="width:115px;margin:0 auto;"><hr></div>
         <h4>Year 2020</h4>
        </div><!-- end of hdrText -->
         </div><!-- end of schoolIdentity -->
        </div><!-- end of resHdr -->

        <div class="resContainer">
        <div class="resTophdr">
        <div class="restopleft">
        <table class="std-information" style="float:left">
        <tr>
        <th class="left">Name:</th>
        <td class="">..................... </td> 
        <th class="right">RollNo:</th>
        <td class="">..................... </td>
        <th class="left">Year:</th>
        <td class=""> .....................</td> 
        </tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
        <th class="left">Class:</th>
        <td class=""> ..................... </td>
        <th class="left">Section:</th>
        <td class=""> ..................... </td>
        <th class="left">Subject:</th>
        <td class="right"> ................. </td>
        </tr>
                     
        </table>
        </div><!-- end of restopleft -->
        </div>
          
        </address>
      </div>
      </div>
      <br><br>
      @foreach($gmcqs[$i] as $qc)
                            <div class="print">
                                @if($qc->question_type == 1)
                                   @if( $longNum==1)
                                  <h1><span class="badge badge-info">Long Question</span></h1><hr>
                                  @endif
                                    <p style="font-size: 1.2rem">{{$longNum}}: {{ $qc->question_name }}</p>

                                       <?php $longNum++; ?>
                                @elseif($qc->question_type == 2)
                                     <!-- <h1><span class="badge badge-info">Multiple Choice </span></h1><hr> -->
                                    <p style="font-size: 1.2rem">{{ $mcqNum }}: {{ $qc->question_name }}</p>
                                    <?php
                                    
                                       $questionNum = 1;
                                        if($qc->choices!=''){
                                        $choices = explode(";", $qc->choices);
                                        }else{
                                        $choices = array();
                                        }
                                        $choicenum = 1;
                                       
                                    ?>
                                    <div class="form-group">
                                        
                                        <!-- <div class="form-inline container"> -->
                                            @if($choices)
                                            @foreach($choices as $choice)
                                                <div class="form-check col-sm-3">
                                                    <label for="mc_c{{ $choicenum }}" class="form-check-label">
                                                        <input class="form-check-input1" type="checkbox" name="answer[{{ $questionNum }}]" id="mc_c{{ $choicenum }}" value="{{ $choicenum++ }}">
                                                        {{ $choice }}
                                                    </label>
                                                </div>
                                                &nbsp &nbsp
                                                <!-- &nbsp &nbsp -->
                                                 <!-- <br><br> -->
                                            @endforeach
                                            @endif
                                        <!-- </div> -->
                                    </div>  
                                 <?php  $mcqNum++; ?>
                                @elseif($qc->question_type == 3)
                               
                                @if( $shortNum==1)
                                  <h1><span class="badge badge-info">Short Question</span></h1><hr>
                                @endif
                                    <p style="font-size: 1.2rem">{{ $shortNum }}: {{ $qc->question_name }}</p>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                           
                                        </div>
                                    </div>
                                     <?php $shortNum++; ?>
                                @endif
                            
                            </div>
                           
                        @endforeach
                    </form>
                </main>
            </div>
        </div>
        <footer></footer>
      </div>
      </div>
      </div>
      </div>
      @endfor

      </div>
      </div>
    </div>
        <!-- /.row -->
    </section>
   

   