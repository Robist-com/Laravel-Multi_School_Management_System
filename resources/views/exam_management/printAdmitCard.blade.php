<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('website/css/jquery-ui.css')}}">

    <script src="{{ asset('website/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('website/js/bootstrap.min.js')}}"></script>
<style>
  #admit{
     height:480px;
     background-color:#dcdcdc;
   }
 .bg{
   width: 100%;
   background-color:#dcdcdc;
 }
 .bg2{
   width: 100%;
    background-color:#cccccc;
 }
 .bg3{
    width: 100%;
    background-color:#dcdcdc;
 }
 #pic{
   width: 40%;
 }
 #info
 {
   width: 60%;
 }
table {
border-spacing: 0;
border-collapse: separate;

}
table td{
  padding-left: 5px;
}
.content{
    text-align:left;
}
.content img{
    vertical-align:bottom;
    margin: 0px;
}
.logo{
  height: 150px;
  width: 200px;
}
.lefthead{
  width: 30%;
}
.righthead{
  width: 70%;
}
.righthead p{
  margin: 0px;
  padding: 0px;
}
</style>
</head>

<body >

<button id="print_content" class="btn btn-info btn-round fa fa-print" onclick="Printcontent('divide')"></button>
    <div class="row" id="divide">
    <?php for ($i=0; $i < 2; $i++) { ?> 
        
<div id="admit">
  <table class="bg">
    <tr>
    <td class="lefthead">

     <img class="logo" src="{{url('institute_logo/' .$data->logo)}}">
    </td>
    <td class="righthead">
     <h3>{{$data->name}}</h3><pre>
      <p><strong>Establish:</strong> {{$data->establish}}</p>
      <p><strong>Web:</strong> {{$data->campus}}</p>
      <p><strong>Email:</strong> {{$data->email}}</p>
      <p><strong>Phone:</strong> {{$data->phoneNo}}</p>
      <p><strong>Address:</strong> {{$data->address}}</p>
          </pre>
   </td>

   </tr>

 </table>
 <table class="bg2">
   <tr><td>
    Applicant's Copy
  </td>
  <td>Class {{$data->class_name}} Admission Exam(Session:{{$data->session}})</td>
  <td >
    <strong>Admit Card</strong>
  </td>
</tr>
</table>

<table class="bg3">
  <tr>
    <td id="info">
      <table>
        <tr>
          <td>Roll No</td>
          <td>:</td>
          <td> {{$data->seatNo}} </td>
          </tr>
        <tr>
          <td>Campus</td>
          <td>:</td>
          <td> {{$data->campus}} </td>
          </tr>
        <tr>

          <td>Class </td>
          <td>:</td>
          <td> {{$data->class_name}} </td>
          </tr>
          <tr>
            <td>Full Name </td>
              <td>:</td>
              <td> {{$data->first_name}} </td>
              </tr>
              <tr>
                <td>Father's Name</td>
                <td>:</td>
                <td> {{$data->father_name}} </td>
                </tr>
                <tr>
                  <td>Mother's Name</td>
                  <td>:</td>
                  <td> {{$data->mother_name}} </td>
                  </tr>
                  <tr>
                    <td>Date Of Birth</td>
                    <td>:</td>
                    <td> {{$data->dob}} </td>
                    </tr>
        </table>
     </td>

    <td id="pic">
       <img style="float:left; width:160px; height:150px;" src="{{asset('student_images/' .$data->image)}}">
     </td>

  </tr>
  <tr>

    <td class="content">

    <img src="{{url('school_images/signature/signature.png')}}">
    </td>
  </tr>
  <tr>

    <td style="vertical-align:top;width:100%" >
       Signature Of Authority&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This Admit Card is Electronically Produced.
    </td>

  </tr>
 </table>
<p style="color:red;text-align:center">Admission test will be held on xxth XXXX at Campus 1.</p>
<p style="text-align:right;margin-right:10px;">Software develop by-<strong>Alagie Singhateh<strong></p>
</div>

@if($i == 0)
    <br><br><br><br><br><br><br><br><br>
    <br><br><br>
    <br><br>
    <!-- <hr> -->
    @endif
    <?php } ?>
</body>


    </div>
    <script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>

  
<!-- </body> -->
<script src="{{ asset('website/js/main.js')}}"></script>

<script>


    function Printcontent(el) {
        // alert(1)
        var restorpage = document.body.innerHTML;
        var printContent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printContent; 
        window.print();
        document.body.innerHTML = restorpage; 
        window.close();
    }
</script>
</html>
