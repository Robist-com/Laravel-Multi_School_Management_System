
    @foreach($list_certificate as $card)
<div>
    <div class="certificate_frame">
        <div class="certificate_background">
            <div class="row end-xs">
                <div class="col-xs-10">
                    <div class="box">
                        <p class=" certificate_compnay_name ">
                            <span> {{$card->name}} </span>
                        </p>
                        <img class="certificate_compnay_logo" src="{{url('institute_logo/' .$card->logo)}} ">
                    </div>

                    <div class="box">
                        <p class=" certificate_title">
                            <span>@if($card->certificate_title_text != '') {{$card->certificate_title_text}} @else CERTIIFCATE TITLE @endif</span>
                        </p>
                        <div class="certificate_information">
                            <p class="certificate_certify_title">@if($card->certificate_certify_title_text != '') {{$card->certificate_certify_title_text}} @else EXAMPLE [THIS IS TO CERTIFY THAT ]@endif</p>
                            <h1 class="certificate_holder_name"> HOLDER NAME [Firstname and lastname] </h1>
                            <p>
                            @if($card->certificate_information_text != '') {{$card->certificate_information_text}} @else CERTIIFCATE INFORMATIONS @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row end-xs">
                <div class="col-xs-10">
                    <div class="box">
                        <div class="certificate_issue_date">
                            <b>Issued on:</b> @if($card->certificate_issue_date_value != '') {{date('d/m/Y', strtotime($card->certificate_issue_date_value))}} @else [12/05/2020] @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($card->signature_person1_text != '')
            <div class="row end-xs">
                <div class="col-xs-10">
                    <div class="box">
                        <div class="certificate_signature1 ">
                        @if($card->certificate_signature1 == 'on' && $card->certificate_signature_img_1_url != '')
                        <img src="{{url('certificate_design/school_certificates/' .$card->certificate_signature_img_1_url)}}" id="img_signature_center1"> 
                        <p >{{$card->signature_person1_text}}</p>
                        @elseif($card->certificate_signature1 == 'on' && $card->certificate_signature_img_1_url === '')
                        <p >____________________________</p>
                        <p >{{$card->signature_person1_text}}</p>
                        @else

                        @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($card->signature_person2_text != '')
            <div class="row end-xs">
                <div class="col-xs-5">
                    <div class="box">
                        <div class="certificate_signature2 ">
                        @if($card->certificate_signature2 == 'on' && $card->certificate_signature_img_2_url != '')
                        <img src="{{url('certificate_design/school_certificates/' .$card->certificate_signature_img_2_url)}}" id="img_signature_center2"> 
                        <p>{{$card->signature_person2_text}}</p>
                        @elseif($card->certificate_signature2 == 'on' && $card->certificate_signature_img_2_url === '')
                        <p >____________________________</p>
                        <p >{{$card->signature_person2_text}}</p>
                        @else

                        @endif
                        </div>
                    </div>
                </div>
               
            @endif

            @if($card->signature_person3_text != '')
                <div class="col-xs-5">
                    <div class="box">
                        <div class="certificate_signature3">
                        @if($card->certificate_signature3 == 'on' && $card->certificate_signature_img_3_url != '')
                        <img src="{{url('certificate_design/school_certificates/' .$card->certificate_signature_img_3_url)}}" id="img_signature_center3"> 
                        <p >{{$card->signature_person3_text}}</p>
                        @elseif($card->certificate_signature3 == 'on' && $card->certificate_signature_img_3_url === '')
                        <p >____________________________</p>
                        <p >{{$card->signature_person3_text}}</p>
                        @else
                        @endif
                        </div>
                    </div>
                </div>
                </div>
            @endif
                
          
        <!-- </div> -->
    </div>
</div>
@endforeach

@foreach($list_certificate as $cert_design)


<style>

.certificate_frame {
padding:  {{$cert_design->certificate_frame_padding}};
width:  {{$cert_design->certificate_frame_width}};
height: {{$cert_design->certificate_frame_height}};
margin: {{$cert_design->certificate_frame_margin}};
box-shadow: {{$cert_design->certificate_frame_box_shodow}};
border-radius:  {{$cert_design->certificate_frame_border_radius}};
overflow:  {{$cert_design->certificate_frame_overflow}}; 
}


.certificate_background {
-webkit-print-color-adjust: exact;
background-image: url({{asset('certificate_design/school_certificates/' .$cert_design->certificate_background_image)}});
/* url(https://image.ibb.co/eCPgQw/certificado_proesc_1.png); */
height:  {{$cert_design->certificate_background_height}};
width: {{$cert_design->certificate_background_width}};
background-size: {{$cert_design->certificate_background_size}};
opacity:{{$cert_design->certificate_background_opacity}};
background-repeat: {{$cert_design->certificate_background_repeat}};
background-attachment: ;
background-position: ;
background: ;
background-color: ;
}





.certificate_compnay_name{
    font-size: {{$cert_design->certificate_company_name_font_size}};
    font-weight: {{$cert_design->certificate_company_name_font_weight}};
    height: {{$cert_design->certificate_company_name_height}};
    font-family: {{$cert_design->certificate_company_name_font_family}};
    margin: {{$cert_design->certificate_company_name_margin}};
    padding: {{$cert_design->certificate_company_name_padding}}; /* top / left / bottom / right */
    display: {{$cert_design->certificate_company_name_display}};
    text-align: {{$cert_design->certificate_company_name_text_align}};

    /* word-spacing: {{$cert_design->certificate_company_name_font_weight}};
    letter-spacing: {{$cert_design->certificate_company_name_font_weight}};
    text-decoration: {{$cert_design->certificate_company_name_font_weight}};
    vertical-align:  {{$cert_design->certificate_company_name_font_weight}};
    text-transform: {{$cert_design->certificate_company_name_font_weight}};
    text-indent: {{$cert_design->certificate_company_name_font_weight}};
    line-height: {{$cert_design->certificate_company_name_font_weight}};
    border-width: {{$cert_design->certificate_company_name_font_weight}};
    border-color: {{$cert_design->certificate_company_name_font_weight}};
    border-style:  {{$cert_design->certificate_company_name_font_weight}}; */
    border: ;
    float: ;
    clear: ;
    white-space: ;
    list-style-type: ;
    list-style-image: ;
}




.certificate_compnay_logo{
    width: {{$cert_design->certificate_logo_width}};
    height: {{$cert_design->certificate_logo_height}};
    padding: {{$cert_design->certificate_logo_padding}}; 
    margin: {{$cert_design->certificate_logo_margin}};
    display: {{$cert_design->certificate_logo_display}};

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
    width: {{$cert_design->certificate_company_address_width}};
    height: {{$cert_design->certificate_company_address_height}};
    font-size: {{$cert_design->certificate_company_address_font_size}};
    font-weight: {{$cert_design->certificate_company_address_font_weight}};
    font-family: {{$cert_design->certificate_company_address_font_family}};
    padding: {{$cert_design->certificate_company_address_padding}};
    margin: {{$cert_design->certificate_company_address_margin}};
    display: {{$cert_design->certificate_company_address_display}};
    text-align: {{$cert_design->certificate_company_address_text_align}};
    
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
    font-size: {{$cert_design->certificate_title_font_size}};
    font-family: {{$cert_design->certificate_title_font_family}};
    margin: {{$cert_design->certificate_title_margin}};
    padding: {{$cert_design->certificate_title_padding}};
    text-align: {{$cert_design->certificate_title_text_align}};
    font-weight: {{$cert_design->certificate_title_font_weight}};
    display: {{$cert_design->certificate_title_font_display}};

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
    font-size: {{$cert_design->certificate_certify_title_font_size}};
    font-family: {{$cert_design->certificate_certify_title_font_family}};
    margin: {{$cert_design->certificate_certify_title_margin}};
    padding: {{$cert_design->certificate_certify_title_padding}};
    text-align: {{$cert_design->certificate_certify_text_align}};
    font-weight: {{$cert_design->certificate_certify_title_font_weight}};
    display: {{$cert_design->certificate_certify_title_font_display}};

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

    font-size: {{$cert_design->certificate_holder_font_size}};
    font-family: {{$cert_design->certificate_holder_font_family}};
    margin: {{$cert_design->certificate_holder_margin}};
    padding: {{$cert_design->certificate_holder_padding}};
    text-align: {{$cert_design->certificate_holder_text_align}};
    font-weight: {{$cert_design->certificate_holder_font_weight}};
    display: {{$cert_design->certificate_holder_font_display}};

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
    font-size: {{$cert_design->certificate_information_font_size}};
    font-family: {{$cert_design->certificate_information_font_family}};
    margin: {{$cert_design->certificate_information_margin}};
    padding: {{$cert_design->certificate_information_padding}};
    text-align: {{$cert_design->certificate_information_text_align}};
    font-weight: {{$cert_design->certificate_information_font_weight}};
    display: {{$cert_design->certificate_information_font_display}};
/* 
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
list-style-image: ; */
}


.certificate_signature1{
    font-size: {{$cert_design->certificate_signature1_font_size}};
    font-family: {{$cert_design->certificate_signature1_font_family}};
    float: {{$cert_design->certificate_signature1_float}};
    margin: {{$cert_design->certificate_signature1_margin}};
    padding: {{$cert_design->certificate_signature1_padding}};
    text-align: {{$cert_design->certificate_signature1_text_align}};
    font-weight: {{$cert_design->certificate_signature1_font_weight}};
    display: {{$cert_design->certificate_signature1_font_display}};
    line-height: {{$cert_design->certificate_signature1_line_height}};
}

/* #certificate_img_signature1{
margin: 0 0 0 0 ; 
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
} */

#img_signature_center1{
margin: {{$cert_design->certificate_img_signature1_margin}};
padding: {{$cert_design->certificate_img_signature1_padding}};
width: {{$cert_design->certificate_img_signature1_width}};
height: {{$cert_design->certificate_img_signature1_height}};
font-size: {{$cert_design->certificate_img_signature1_font_size}};
font-family: {{$cert_design->certificate_img_signature1_font_family}};
text-align: {{$cert_design->certificate_img_signature1_text_align}};
font-weight: {{$cert_design->certificate_img_signature1_font_weight}};
display: {{$cert_design->certificate_img_signature1_font_display}};
justify-content: {{$cert_design->certificate_img_signature1_font_display}}; 
line-height: {{$cert_design->certificate_img_signature1_line_height}};
border-radius: {{$cert_design->certificate_img_signature1_border_radius}};
border-radius: {{$cert_design->certificate_img_signature1_border_radius}};
background-color: rgba(255, 255, 255, .5);
}


.certificate_signature2{
    font-size: {{$cert_design->certificate_signature2_font_size}};
    font-family: {{$cert_design->certificate_signature2_font_family}};
    float: {{$cert_design->certificate_signature2_float}};
    margin: {{$cert_design->certificate_signature2_margin}};
    padding: {{$cert_design->certificate_signature2_padding}};
    text-align: {{$cert_design->certificate_signature2_text_align}};
    font-weight: {{$cert_design->certificate_signature2_font_weight}};
    display: {{$cert_design->certificate_signature2_font_display}};
    line-height: {{$cert_design->certificate_signature2_line_height}};
}

#img_signature_center2{
margin: {{$cert_design->certificate_img_signature2_margin}};
padding: {{$cert_design->certificate_img_signature2_padding}};
width: {{$cert_design->certificate_img_signature2_width}};
height: {{$cert_design->certificate_img_signature2_height}};
font-size: {{$cert_design->certificate_img_signature2_font_size}};
font-family: {{$cert_design->certificate_img_signature2_font_family}};
text-align: {{$cert_design->certificate_img_signature2_text_align}};
font-weight: {{$cert_design->certificate_img_signature2_font_weight}};
display: {{$cert_design->certificate_img_signature2_font_display}};
justify-content: {{$cert_design->certificate_img_signature2_font_display}}; 
line-height: {{$cert_design->certificate_img_signature2_line_height}};
border-radius: {{$cert_design->certificate_img_signature2_border_radius}};
border-radius: {{$cert_design->certificate_img_signature2_border_radius}};
background-color: rgba(255, 255, 255, .5);
}


.certificate_signature3{
    font-size: {{$cert_design->certificate_signature3_font_size}};
    font-family: {{$cert_design->certificate_signature3_font_family}};
    float: {{$cert_design->certificate_signature3_float}};
    margin: {{$cert_design->certificate_signature3_margin}};
    padding: {{$cert_design->certificate_signature3_padding}};
    text-align: {{$cert_design->certificate_signature3_text_align}};
    font-weight: {{$cert_design->certificate_signature3_font_weight}};
    display: {{$cert_design->certificate_signature3_font_display}};
    line-height: {{$cert_design->certificate_signature3_line_height}};
}

#img_signature_center3{
    margin: {{$cert_design->certificate_img_signature3_margin}};
    padding: {{$cert_design->certificate_img_signature3_padding}};
    width: {{$cert_design->certificate_img_signature3_width}};
    height: {{$cert_design->certificate_img_signature3_height}};
    font-size: {{$cert_design->certificate_img_signature3_font_size}};
    font-family: {{$cert_design->certificate_img_signature3_font_family}};
    text-align: {{$cert_design->certificate_img_signature3_text_align}};
    font-weight: {{$cert_design->certificate_img_signature3_font_weight}};
    display: {{$cert_design->certificate_img_signature3_font_display}};
    justify-content: {{$cert_design->certificate_img_signature3_font_display}}; 
    line-height: {{$cert_design->certificate_img_signature3_line_height}};
    border-radius: {{$cert_design->certificate_img_signature3_border_radius}};
    border-radius: {{$cert_design->certificate_img_signature3_border_radius}};
    opacity: 0.5;
}




.certificate_issue_date{
    font-size: {{$cert_design->certificate_issue_date_font_size}};
    font-family: {{$cert_design->certificate_issue_date_font_family}};
    margin: {{$cert_design->certificate_issue_date_margin}};
    padding: {{$cert_design->certificate_issue_date_padding}};
    text-align: {{$cert_design->certificate_issue_date_text_align}};
    font-weight: {{$cert_design->certificate_issue_date_font_weight}};
    display: {{$cert_design->certificate_issue_date_font_display}};
    justify-content: {{$cert_design->certificate_issue_date_font_display}}; 
    width: {{$cert_design->certificate_issue_date_width}};

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
@endforeach
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