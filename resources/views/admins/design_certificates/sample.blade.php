<style>
    #print_content{
        border-radius: 0 .7px;
        height: 60px !important;
        width: 100%;
        padding: 0 5px 0 -5px;
        background: #2A3F54;
        color: #ffffff;
        font-size: 20px;
        font-weight: bold;
        /* font-family: serif; */
        font-family:'FontAwesome';
        content:"\f146";
        cursor:pointer;
    }
    #print_content:hover{
        background-color: rgb(42,63,74);
    }
</style>

<div class="col-md-12">
  <button id="print_content"  class="btn btn-info btn-lg btn-block "  onclick="Printcontent('divide')"><span class="glyphicon glyphicon-search">Print</span></button>
  </div>
    <div class="row" id="divide">
<div>
    <div class="certificate_frame">
        <div class="certificate_background">
            <div class="row">
                <div class="col-md-10">
                    <div class="box">
                        <p class=" certificate_compnay_name ">
                            <span> School Name</span>
                        </p>

                        <img class="certificate_compnay_logo" src="{{url('certificate_template/school_images/school_logo.png')}} ">
                       <!-- <p class="certifcate_company_address">hello world</p> -->
                    </div>
                    <div class="box">
                        <p class=" certificate_title">
                            <span>Certificate of Proficiency</span>
                        </p>
                        <div class="certificate_information">
                            
                            <p class="certificate_certify_title">THIS IS TO CERTIFY THAT</p>
                            <h1 class="certificate_holder_name">Firstname Surname</h1>
                            <p>
                            Verify at company website a complation of this course. <br> 
                            Company has confirmed the participation of this 
                            individual in the course.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row end-xs">
                <div class="col-xs-10">
                    <div class="box">
                        <div class="certificate_issue_date">
                            <b>Issued on:</b> {{date('Y/m/d')}}.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row end-xs">
                <div class="col-xs-10">
                    <div class="box">
                        <div class="certificate_signature1 ">
                        <img src="{{url('school_images/signature/signature.png')}}" id="img_signature_center1">
                            <!-- <p >____________________________</p> -->
                            <p >Singature 1</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row end-xs">
                <div class="col-xs-5">
                    <div class="box">
                        <div class="certificate_signature2 ">
                        <img src="{{url('school_images/signature/signature.png')}}" id="img_signature_center2">
                            <!-- <p >____________________________</p> -->
                            <p >Singature 2</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="box">
                        <div class="certificate_signature3">
                        <img src="{{url('school_images/signature/signature.png')}}" id="img_signature_center3">
                            <!-- <p >____________________________</p> -->
                            <p >Singature 3</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<style>

.certificate_frame {
padding: 5mm;
width: 1085px;
height: 760px;
margin: 30px auto;
box-shadow: .5px .5px 7px #000;
border-radius: 2px;
overflow: hidden;
}

.certificate_background {
-webkit-print-color-adjust: exact;
background-image: url({{asset('school_images/signature/certificate_frame3.png')}});
/* url(https://image.ibb.co/eCPgQw/certificado_proesc_1.png); */
height: 755px;
width: 1085px;
background-size:cover;
opacity:;
background-repeat: no-repeat;
background-attachment: ;
background-position: ;
background: ;
background-color: ;
}

.certificate_compnay_name{
    font-size:44px;
    font-weight: bold;
    font-family: serif;
    margin: 5px 0 0 0;
    padding: 35px 0 0 0; /* top / left / bottom / right */
    display: block;
    text-align:center;
    word-spacing: ;
    letter-spacing: ;
    text-decoration: ;
    vertical-align:  ;
    text-transform: ;
    text-indent: ;
    line-height: ;
    border-width: ; 
    border-color: ;
    border-style:  ;
    border: ;
    float: ;
    clear: ;
    white-space: ;
    list-style-type: ;
    list-style-image: ;
}

.certificate_compnay_logo{
    width:110px;
    height:110px;
    padding: 0 300px 0 500px; /* top / left / bottom / right */
    margin: 5px 0 0 0;
    display: block;
    word-spacing: ;
    letter-spacing: ;
    text-decoration: ;
    vertical-align:  ;
    text-transform: ;
    text-indent: ;
    line-height: ;
    border-width: ; 
    border-color: ;
    border-style:  ;
    border: ;
    float: ;
    clear: ;
    white-space: ;
    list-style-type: ;
    list-style-image: ;
}

.certifcate_company_address{
    font-size:20px;
    font-weight: normal;
    font-family: serif;
    padding: 0 0 0 0; /* top / left / bottom / right */
    margin: 0 0 0 0;
    display: block;
    text-align:center;
    word-spacing: ;
    letter-spacing: ;
    text-decoration: ;
    vertical-align:  ;
    text-transform: ;
    text-indent: ;
    line-height: ;
    border-width: ; 
    border-color: ;
    border-style:  ;
    border: ;
    float: ;
    clear: ;
    white-space: ;
    list-style-type: ;
    list-style-image: ;
}

.certificate_title{
    font-size:30px;
    margin: 0 0 35px 0 ;
    padding:35px 0 0 0;
    text-align: center;
    font-weight: bold;
    display: block;
    word-spacing: ;
    letter-spacing: ;
    text-decoration: ;
    vertical-align:  ;
    text-transform: ;
    text-indent: ;
    line-height: ;
    border-width: ; 
    border-color: ;
    border-style:  ;
    border: ;
    float: ;
    clear: ;
    white-space: ;
    list-style-type: ;
    list-style-image: ;
}

.certificate_certify_title{
    font-size:20px;
    margin: 0 0 0 0 ;
    padding:0 0 0 0;
    text-align: center;
    font-weight: normal;
    font-family: serif;
    display: block;
    word-spacing: ;
    letter-spacing: ;
    text-decoration: ;
    vertical-align:  ;
    text-transform: ;
    text-indent: ;
    line-height: ;
    border-width: ; 
    border-color: ;
    border-style:  ;
    border: ;
    float: ;
    clear: ;
    white-space: ;
    list-style-type: ;
    list-style-image: ;
}

.certificate_holder_name{
    font-size: 50px;
    margin: 10px 0 10px 0 ;
    padding:0 0 0 0;
    font-weight: bold;
    font-family: serif;
    text-align: center;
    display: block;
    word-spacing: ;
    letter-spacing: ;
    text-decoration: ;
    vertical-align:  ;
    text-transform: ;
    text-indent: ;
    line-height: ;
    border-width: ; 
    border-color: ;
    border-style:  ;
    border: ;
    float: ;
    clear: ;
    white-space: ;
    list-style-type: ;
    list-style-image: ;
}


.certificate_information{
font-size: 22px;
text-align:center;
padding: 0px 120px 0px 160px; /* top / left / bottom / right */
font-family: serif;
margin: 5px 0 0 0;
word-spacing: ;
letter-spacing: ;
text-decoration: ;
vertical-align:  ;
text-transform: ;
text-indent: ;
line-height: ;
border-width: ; 
border-color: ;
border-style:  ;
border: ;
float: ;
clear: ;
white-space: ;
list-style-type: ;
list-style-image: ;
}

.certificate_signature1{
font-weight: bold;
font-family: serif;
margin:10px 0 0 40px; /* top / left / bottom / right */
justify-content: center; 
line-height: 22px;
font-size: 22px;
padding: 22px 0 0 0 ;
text-align: center;
word-spacing: ;
letter-spacing: ;
text-decoration: ;
vertical-align:  ;
text-transform: ;
text-indent: ;
line-height: ;
border-width: ; 
border-color: ;
border-style:  ;
border: ;
float: ;
clear: ;
white-space: ;
list-style-type: ;
list-style-image: ;

}

#img_signature_center1{
margin: 0 0 0 0 ;  /* top / left / bottom / right */
width:130px;
height: 70px;
border-radius: 0px;
word-spacing: ;
letter-spacing: ;
text-decoration: ;
vertical-align:  ;
text-transform: ;
text-indent: ;
line-height: ;
border-width: ; 
border-color: ;
border-style:  ;
border: ;
float: ;
clear: ;
white-space: ;
list-style-type: ;
list-style-image: ;
}

.certificate_signature2{
font-weight: bold;
font-family: serif;
float:left;
font-family: serif;
margin:0 0 0 200px; /* top / left / bottom / right */
justify-content: center; 
line-height: 22px;
font-size: 22px;
padding: 22px 0 0 0 ;
text-align: center;
word-spacing: ;
letter-spacing: ;
text-decoration: ;
vertical-align:  ;
text-transform: ;
text-indent: ;
line-height: ;
border-width: ; 
border-color: ;
border-style:  ;
border: ;
float: ;
clear: ;
white-space: ;
list-style-type: ;
list-style-image: ;
}

#img_signature_center2{
margin: 0 50px 0 50px ;  /* top / left / bottom / right */
width:130px;
border-radius: 0px;
word-spacing: ;
letter-spacing: ;
text-decoration: ;
vertical-align:  ;
text-transform: ;
text-indent: ;
line-height: ;
border-width: ; 
border-color: ;
border-style:  ;
border: ;
float: ;
clear: ;
white-space: ;
list-style-type: ;
list-style-image: ;

}


.certificate_signature3{
font-weight: bold;
font-family: serif;
font-size: 22px;
margin:0 0 0 200px; /* top / left / bottom / right */
justify-content: center; 
line-height: 22px;
padding: 22px 0 0 0 ;
text-align: center;
word-spacing: ;
letter-spacing: ;
text-decoration: ;
vertical-align:  ;
text-transform: ;
text-indent: ;
line-height: ;
border-width: ; 
border-color: ;
border-style:  ;
border: ;
float: ;
clear: ;
white-space: ;
list-style-type: ;
list-style-image: ;
}

#img_signature_center3{
margin: 0 0 0 0px ;  /* top / left / bottom / right */
width:130px;
border-radius: 0px;
word-spacing: ;
letter-spacing: ;
text-decoration: ;
vertical-align:  ;
text-transform: ;
text-indent: ;
line-height: ;
border-width: ; 
border-color: ;
border-style:  ;
border: ;
float: ;
clear: ;
white-space: ;
list-style-type: ;
list-style-image: ;
}


.certificate_issue_date{
font-weight: normal;
font-family: serif;
font-size: 22px;
text-align:center;
padding: 0px 120px 0px 160px; /* top / left / bottom / right */
font-family: serif;
margin: 5px 0 0 0;
word-spacing: ;
letter-spacing: ;
text-decoration: ;
vertical-align:  ;
text-transform: ;
text-indent: ;
line-height: ;
border-width: ; 
border-color: ;
border-style:  ;
border: ;
float: ;
clear: ;
white-space: ;
list-style-type: ;
list-style-image: ;
}

/*area de configuraçõa da pagina*/
@page {
size: 297mm 210mm;
margin: 5mm;
size: landscape
}
body {
margin: 0;
padding: 0px !important;
font-family: 'Open Sans', sans-serif
}
p{
margin: 0px;
}
/*SEMPRE DEIXAR NO FIM DO CODIGO configuração de impresão*/
@media print {
.certificate_frame {
padding: 0;
background: transparent;
margin: 0;
border-radius: 0;
box-shadow: none;
-webkit-box-shadow: none
}
}
</style>

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