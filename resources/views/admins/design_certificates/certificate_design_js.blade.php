<script>



$(document).ready(function(){

// $('input.example').on('change', function() {
    // alert(1)
// $('input.example1').not(this).prop('checked', false);  
// });

$(".switch:not([checked])").on('change' , function(){
    // alert(1)
  $(".switch1").not(this).prop("checked" , false);
});

   var  certificate_frame_width = $('#certificate_frame_width').val();
   var  certificate_frame_height = $('#certificate_frame_height').val();
   $('#hide_content').hide();
   $('#hide_content').focus();
   

   $("#certificate_type").keyup(function() {
if($(this).val() == "") {
    $("#hide_content").hide();
    $('#frame_message1').text('Certificate Type Can not be Empty! Provide a name to Create Certificate.');
} else {
    $("#hide_content").show();
    $('#frame_message1').text('');
}
});


  
$("#certificate_frame_width").keyup(function() {
if($(this).val() == "") {
    $("#create_certificateBtn").attr("disabled", true);
    $('#frame_message').text('Frame Width can not be Empty!');
} else {
    $('#create_certificateBtn').attr("disabled", false);
    $('#frame_message').text('');
}
});

$("#certificate_frame_height").keyup(function() {
if($(this).val() == "") {
    $("#create_certificateBtn").attr("disabled", true);
    $('#frame_message').text('Frame Height can not be Empty!');
} else {
    $('#create_certificateBtn').attr("disabled", false);
    $('#frame_message').text('');
}
});

$("#certificate_title_content").keyup(function() {
if($(this).val() == "") {
    $("#create_certificateBtn").attr("disabled", true);
    $('#req_title').show();
    $('#frame_message').text('Certificate Title is required, please provide a title for the certificate.!');
} else {
    $('#create_certificateBtn').attr("disabled", false);
    $('#frame_message').text('');
    $('#req_title').hide();
}
});

$("#certificate_certify_content").keyup(function() {
if($(this).val() == "") {
    $("#create_certificateBtn").attr("disabled", true);
    $('#frame_message').text('Certificate Title is required, please provide a title for the certificate.!');
    $('#req_certify').show();
} else {
    $('#create_certificateBtn').attr("disabled", false);
    $('#frame_message').text('');
    $('#req_certify').hide();
}
});

$("#certificate_information_text").keyup(function() {
if($(this).val() == "") {
    $("#create_certificateBtn").attr("disabled", true);
    $('#frame_message').text('Certificate Information is required, please provide a Information for the certificate.!');
    $('#req_info').show();
} else {
    $('#create_certificateBtn').attr("disabled", false);
    $('#frame_message').text('');
    $('#req_info').hide();
}
});

$("#certificate_issue_date_value").keyup(function() {
if($(this).val() == "") {
    $("#create_certificateBtn").attr("disabled", true);
    $('#frame_message').text('Certificate Issue Date is required, please provide a Date for the certificate.!');
    $('#req_issue').show();
} else {
    $('#create_certificateBtn').attr("disabled", false);
    $('#frame_message').text('');
    $('#req_issue').hide();
}
});




$('#req_title').text('Required');
    $('#req_title').addClass( "unchecked" );

    $('#req_certify').text('Required');
    $('#req_certify').addClass( "unchecked" );


    $('#req_info').text('Required');
    $('#req_info').addClass( "unchecked" );

    $('#req_issue').text('Required');
    $('#req_issue').addClass( "unchecked" );
  

    var card_title =  $('#card_title').val();
    $('.certificate_frame_head').hide();
    $('.certificate_frame_body').hide();
    $('.certificate_frame_head1').hide();
    $('.certificate_frame_body1').hide();
    $('.certificate_frame_head2').hide();
    $('.certificate_frame_body2').hide();
    $('.certificate_frame_head3').hide();
    $('.certificate_frame_body3').hide();
   

    $('.frame_background_head').hide();
    $('.frame_background_body').hide();
    $('#select_bg_img').hide();
    $('.frame_background_head1').hide();
    $('.frame_background_body1').hide();

    $('.certificate_school_name_head').hide();
    $('.certificate_school_name_body').hide();
    $('.certificate_school_name_head1').hide();
    $('.certificate_school_name_body1').hide();
    $('.certificate_school_name_head2').hide();
    $('.certificate_school_name_body2').hide();
    $('.certificate_school_name_head3').hide();
    $('.certificate_school_name_body3').hide();

    $(".certificate_logo_head").hide();
    $(".certificate_logo_body").hide();
    $(".certificate_logo_head1").hide();
    $(".certificate_logo_body1").hide();
    $(".certificate_logo_head2").hide();
    $(".certificate_logo_body2").hide();
    $(".certificate_logo_head3").hide();
    $(".certificate_logo_body3").hide();
    $("#select_logo_img").hide();
    
    $(".certificate_address_head").hide();
    $(".certificate_address_body").hide();
    $(".certificate_address_head1").hide();
    $(".certificate_address_body1").hide();
    $(".certificate_address_head2").hide();
    $(".certificate_address_body2").hide();
    $(".certificate_address_head3").hide();
    $(".certificate_address_body3").hide();
    
    $(".certificate_title_head").hide();
    $(".certificate_title_body").hide();
    $(".certificate_title_head1").hide();
    $(".certificate_title_body1").hide();
    $(".certificate_title_head2").hide();
    $(".certificate_title_body2").hide();
    $(".certificate_title_head3").hide();
    $(".certificate_title_body3").hide();
    $(".certificate_title_content").hide();
    
    $(".certificate_certify_head").hide();
    $(".certificate_certify_body").hide();
    $(".certificate_certify_head1").hide();
    $(".certificate_certify_body1").hide();
    $(".certificate_certify_head2").hide();
    $(".certificate_certify_body2").hide();
    $(".certificate_certify_head3").hide();
    $(".certificate_certify_body3").hide();
    $(".certificate_certify_content").hide();


    $(".certificate_holdername_head").hide();
    $(".certificate_holdername_body").hide();
    $(".certificate_holdername_head1").hide();
    $(".certificate_holdername_body1").hide();
    $(".certificate_holdername_head2").hide();
    $(".certificate_holdername_body2").hide();
    $(".certificate_holdername_head3").hide();
    $(".certificate_holdername_body3").hide();
    $(".certificate_holdername_content").hide();

    $(".certificate_information_head").hide();
    $(".certificate_information_body").hide();
    $(".certificate_information_head1").hide();
    $(".certificate_information_body1").hide();
    $(".certificate_information_head2").hide();
    $(".certificate_information_body2").hide();
    $(".certificate_information_head3").hide();
    $(".certificate_information_body3").hide();
    $(".certificate_information_content").hide();

    $(".certificate_issue_date_head").hide();
    $(".certificate_issue_date_body").hide();
    $(".certificate_issue_date_head1").hide();
    $(".certificate_issue_date_body1").hide();
    $(".certificate_issue_date_head2").hide();
    $(".certificate_issue_date_body2").hide();
    $(".certificate_issue_date_head3").hide();
    $(".certificate_issue_date_body3").hide();
    $("#certificate_issue_date_content").hide();

    $(".certificate_signature1_head").hide();
    $(".certificate_signature1_body").hide();
    $(".certificate_signature1_head1").hide();
    $(".certificate_signature1_body1").hide();
    $(".certificate_signature1_head2").hide();
    $(".certificate_signature1_body2").hide();
    $(".certificate_signature1_head3").hide();
    $(".certificate_signature1_body3").hide();
    $(".certificate_signature1_content").hide();

    $(".certificate_signature1img_head").hide();
    $(".certificate_signature1img_body").hide();
    $(".certificate_signature1img_head1").hide();
    $(".certificate_signature1img_body1").hide();
    $(".certificate_signature1img_head2").hide();
    $(".certificate_signature1img_body2").hide();
    $(".certificate_signature1img_head3").hide();
    $(".certificate_signature1img_body3").hide();
    $("#select_signature1_img").hide();
    $("#signatureImg1").hide();
    $("#signatureImg2").hide();
    $("#signatureImg3").hide();

    $(".certificate_signature2_head").hide();
    $(".certificate_signature2_body").hide();
    $(".certificate_signature2_head1").hide();
    $(".certificate_signature2_body1").hide();
    $(".certificate_signature2_head2").hide();
    $(".certificate_signature2_body2").hide();
    $(".certificate_signature2_head3").hide();
    $(".certificate_signature2_body3").hide();
    $(".certificate_signature2_content").hide();

    $(".certificate_signature2img_head").hide();
    $(".certificate_signature2img_body").hide();
    $(".certificate_signature2img_head1").hide();
    $(".certificate_signature2img_body1").hide();
    $(".certificate_signature2img_head2").hide();
    $(".certificate_signature2img_body2").hide();
    $(".certificate_signature2img_head3").hide();
    $(".certificate_signature2img_body3").hide();
    $("#select_signature2_img").hide();

    $(".certificate_signature3_head").hide();
    $(".certificate_signature3_body").hide();
    $(".certificate_signature3_head1").hide();
    $(".certificate_signature3_body1").hide();
    $(".certificate_signature3_head2").hide();
    $(".certificate_signature3_body2").hide();
    $(".certificate_signature3_head3").hide();
    $(".certificate_signature3_body3").hide();
    $(".certificate_signature3_content").hide();

    $(".certificate_signature3img_head").hide();
    $(".certificate_signature3img_body").hide();
    $(".certificate_signature3img_head1").hide();
    $(".certificate_signature3img_body1").hide();
    $(".certificate_signature3img_head2").hide();
    $(".certificate_signature3img_body2").hide();
    $(".certificate_signature3img_head3").hide();
    $(".certificate_signature3img_body3").hide();
    $("#select_signature3_img").hide();



  if(card_title == 'student_id_card'){
    $('#id_switcher_student').show();
    $('#id_switcher_staff').hide();
    $('#id_switcher_leaving_certificate').hide();
    $('#id_switcher_admit_card').hide();
    // alert(card_title)
  }else if(card_title == 'staff_id_card'){
  
    $('#id_switcher_staff').show();
    $('#id_switcher_student').hide();
    $('#id_switcher_admit_card').hide();
    $('#id_switcher_leaving_certificate').hide();
  
  }else if(card_title == 'admit_card'){
  
    $('#id_switcher_admit_card').show();
    $('#id_switcher_staff').hide();
    $('#id_switcher_student').hide();
    $('#id_switcher_leaving_certificate').hide();
  }
  else if(card_title == 'leaving_certificate'){
  
    $('#id_switcher_leaving_certificate').show();
    $('#id_switcher_staff').hide();
    $('#id_switcher_student').hide();
    $('#id_switcher_admit_card').hide();
  
  }else{
      $('#id_switcher_student').hide();
      $('#id_switcher_staff').hide();
      $('#id_switcher_admit_card').hide();
      $('#id_switcher_leaving_certificate').hide();
    }
  });

  

     // Checkbox for Names 
     $(function () {
         $('#certificate_frame_add_css').hide();
         $('#certificate_frame_mess').hide();
         $('#certificate_frame_enable').text('Disable');
         $('#certificate_frame_enable').addClass( "unchecked");
         
        $("#check_frame").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_frame_head").show();
                $(".certificate_frame_body").show();
                $('#school_frame_select').text("Selected");

                $('#certificate_frame_enable').text('Enable');
                $('#certificate_frame_enable').addClass( "checked" ).removeClass("unchecked");
                $('#certificate_frame_mess').show();
                $('#certificate_frame_info').hide();
                $('#certificate_frame_add_css').show();
                // $('#signature_person1').show();
                // $('#signature_person1').focus();

            } else {
                $(".certificate_frame_head").hide();
                $(".certificate_frame_body").hide();
                $(".certificate_frame_head1").hide();
                $(".certificate_frame_body1").hide();
                $(".certificate_frame_head2").hide();
                $(".certificate_frame_body2").hide();
                $(".certificate_frame_head3").hide();
                $(".certificate_frame_body3").hide();
                $('#school_frame_select').text("");

                $('#certificate_frame_enable').text('Disable');
                $('#certificate_frame_enable').addClass( "unchecked" ).removeClass(" checked");
                $('#certificate_frame_mess').hide();
                $('#certificate_frame_info').show();
                $('#signature_person1').hide();
                $('#signature_person1').val('');
                $("#signatureImg1").hide();
                $('#certificate_frame_add_css').hide();
            }
        });

        $("#add_frame_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_frame_head1").show();
                $(".certificate_frame_body1").show();
            } else {
                $(".certificate_frame_head1").hide();
                $(".certificate_frame_body1").hide();
            }
        });

        $("#add_frame_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_frame_head2").show();
                $(".certificate_frame_body2").show();
            } else {
                $(".certificate_frame_head2").hide();
                $(".certificate_frame_body2").hide();
            }
        });

        $("#add_frame_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_frame_head3").show();
                $(".certificate_frame_body3").show();
            } else {
                $(".certificate_frame_head3").hide();
                $(".certificate_frame_body3").hide();
            }
        });
    });

           // FRAME BACKGROUND CSS PROPS

    $(function () {
        $('#frame_background_add_css').hide();
         $('#frame_background_mess').hide();
         $('#frame_background_enable').text('Disable');
         $('#frame_background_enable').addClass( "unchecked");

        $("#frame_background").click(function () {
            if ($(this).is(":checked")) {
                $(".frame_background_head").show();
                $(".frame_background_body").show();
                $('#select_bg_img').show();
                $('#school_background_select').text("Selected ");

                $('#frame_background_enable').text('Enable');
                $('#frame_background_enable').addClass( "checked" ).removeClass("unchecked");
                $('#frame_background_mess').show();
                $('#frame_background_info').hide();
                $('#frame_background_add_css').show();

            } else {
                $(".frame_background_head").hide();
                $(".frame_background_body").hide();
                $('#select_bg_img').hide();
                $(".frame_background_head1").hide();
                $(".frame_background_body1").hide();
                $('#school_background_select').text(" ");

                $('#frame_background_enable').text('Disable');
                $('#frame_background_enable').addClass( "unchecked" ).removeClass("checked");
                $('#frame_background_mess').hide();
                $('#frame_background_info').show();
                $('#signature_person1').hide();
                $('#signature_person1').val('');
                $("#signatureImg1").hide();
                $('#frame_background_add_css').hide();
            }
        });

        $("#add_frame_background_css").click(function () {
            if ($(this).is(":checked")) {
                $(".frame_background_head1").show();
                $(".frame_background_body1").show();
               
            } else {
                $(".frame_background_head1").hide();
                $(".frame_background_body1").hide();
                
            }
        });
    });

    $(function () {

        $('#certificate_school_add_css').hide();
         $('#certificate_school_mess').hide();
         $('#certificate_school_enable').text('Disable');
         $('#certificate_school_enable').addClass( "unchecked");

        $("#certificate_school_name").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_school_name_head").show();
                $(".certificate_school_name_body").show();
                $('#school_name_select').text("Selected ");

                $('#certificate_school_enable').text('Enable');
                $('#certificate_school_enable').addClass( "checked" ).removeClass("unchecked");
                $('#certificate_school_mess').show();
                $('#certificate_school_info').hide();
                $('#certificate_school_add_css').show();
                
            } else {
                $(".certificate_school_name_head").hide();
                $(".certificate_school_name_body").hide();
                $(".certificate_school_name_head1").hide();
                $(".certificate_school_name_body1").hide();
                $(".certificate_school_name_head2").hide();
                $(".certificate_school_name_body2").hide();
                $(".certificate_school_name_head3").hide();
                $(".certificate_school_name_body3").hide();
                $('#school_name_select').text("");

                $('#certificate_school_enable').text('Disable');
                $('#certificate_school_enable').addClass( "unchecked" ).removeClass(" checked");
                $('#certificate_school_mess').hide();
                $('#certificate_school_info').show();
                $('#signature_person1').hide();
                $('#signature_person1').val('');
                $("#signatureImg1").hide();
                $('#certificate_school_add_css').hide();
            }
        });

        $("#add_name_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_school_name_head1").show();
                $(".certificate_school_name_body1").show();
            } else {
                $(".certificate_school_name_head1").hide();
                $(".certificate_school_name_body1").hide();
               
            }
        });

        $("#add_name_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_school_name_head2").show();
                $(".certificate_school_name_body2").show();
            } else {
                $(".certificate_school_name_head2").hide();
                $(".certificate_school_name_body2").hide();
            }
        });

        $("#add_name_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_school_name_head3").show();
                $(".certificate_school_name_body3").show();
            } else {
                $(".certificate_school_name_head3").hide();
                $(".certificate_school_name_body3").hide();
            }
        });
    });


    $(function () {
        
        $('#certificate_logo_add_css').hide();
         $('#certificate_logo_mess').hide();
         $('#certificate_logo_enable').text('Disable');
         $('#certificate_logo_enable').addClass( "unchecked");

        $("#certificate_logo").click(function () {
        if ($(this).is(":checked")) {
        $(".certificate_logo_head").show();
        $(".certificate_logo_body").show();
        $("#select_logo_img").show();
        $('#school_logo_select').text("Selected ");

        $('#certificate_logo_enable').text('Enable');
        $('#certificate_logo_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_logo_mess').show();
        $('#certificate_logo_info').hide();
        $('#certificate_logo_add_css').show();

         } else {
        $(".certificate_logo_head").hide();
        $(".certificate_logo_body").hide();
        $("#select_logo_img").hide();
        $(".certificate_logo_head1").hide();
        $(".certificate_logo_body1").hide();
        $(".certificate_logo_head2").hide();
        $(".certificate_logo_body2").hide();
        $(".certificate_logo_head3").hide();
        $(".certificate_logo_body3").hide();
        $('#school_logo_select').text("");

        $('#certificate_logo_enable').text('Disable');
        $('#certificate_logo_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_logo_mess').hide();
        $('#certificate_logo_info').show();
        $('#signature_person1').hide();
        $('#signature_person1').val('');
        $("#signatureImg1").hide();
        $('#certificate_logo_add_css').hide();
        }
        });

        $("#add_logo_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_logo_head1").show();
                $(".certificate_logo_body1").show();
            } else {
                $(".certificate_logo_head1").hide();
                $(".certificate_logo_body1").hide();
            
            }
        });

        $("#add_logo_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_logo_head2").show();
                $(".certificate_logo_body2").show();
            } else {
                $(".certificate_logo_head2").hide();
                $(".certificate_logo_body2").hide();
            }
        });

        $("#add_logo_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_logo_head3").show();
                $(".certificate_logo_body3").show();
            } else {
                $(".certificate_logo_head3").hide();
                $(".certificate_logo_body3").hide();
            }
        });
    });

    
    $(function () {

        $('#certificate_address_add_css').hide();
         $('#certificate_address_mess').hide();
         $('#certificate_address_enable').text('Disable');
         $('#certificate_address_enable').addClass( "unchecked");

        $("#certificate_address").click(function () {
        if ($(this).is(":checked")) {
        $(".certificate_address_head").show();
        $(".certificate_address_body").show();
        $('#school_address_select').text("Selected ");

        $('#certificate_address_enable').text('Enable');
        $('#certificate_address_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_address_mess').show();
        $('#certificate_address_info').hide();
        $('#certificate_address_add_css').show();

         } else {
        $(".certificate_address_head").hide();
        $(".certificate_address_body").hide();
        $(".certificate_address_head1").hide();
        $(".certificate_address_body1").hide();
        $(".certificate_address_head2").hide();
        $(".certificate_address_body2").hide();
        $(".certificate_address_head3").hide();
        $(".certificate_address_body3").hide();
        $('#school_address_select').text("");

        $('#certificate_address_enable').text('Disable');
        $('#certificate_address_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_address_mess').hide();
        $('#certificate_address_info').show();
        $('#signature_person1').hide();
        $('#signature_person1').val('');
        $("#signatureImg1").hide();
        $('#certificate_address_add_css').hide();
        }
        });

        $("#add_address_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_address_head1").show();
                $(".certificate_address_body1").show();
            } else {
                $(".certificate_address_head1").hide();
                $(".certificate_address_body1").hide();
            
            }
        });

        $("#add_address_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_address_head2").show();
                $(".certificate_address_body2").show();
            } else {
                $(".certificate_address_head2").hide();
                $(".certificate_address_body2").hide();
            
            }
        });

        $("#add_address_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_address_head3").show();
                $(".certificate_address_body3").show();
            } else {
                $(".certificate_address_head3").hide();
                $(".certificate_address_body3").hide();
            
            }
        });
    });

    $(function () {
        $('#certificate_title_add_css').hide();
         $('#certificate_title_mess').hide();
         $('#certificate_title_enable').text('Disable');
         $('#certificate_title_enable').addClass( "unchecked");

        $("#certificate_title").click(function () {
        if ($(this).is(":checked")) {
       
        $(".certificate_title_content").show();
        $("#certificate_title_content").focus();
        $('#school_title_select').text("Selected ");

        $('#certificate_title_enable').text('Enable');
        $('#certificate_title_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_title_mess').show();
        $('#certificate_title_info').hide();
        Check_not_Empty();
      

         } else {
        $(".certificate_title_head").hide();
        $(".certificate_title_body").hide();
        $(".certificate_title_head1").hide();
        $(".certificate_title_body1").hide();
        $(".certificate_title_head2").hide();
        $(".certificate_title_body2").hide();
        $(".certificate_title_head3").hide();
        $(".certificate_title_body3").hide();
        $(".certificate_title_content").hide();
        $('#school_title_select').text("");
        

        $('#certificate_title_enable').text('Disable');
        $('#certificate_title_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_title_mess').hide();
        $('#certificate_title_info').show();
        $('#signature_person1').hide();
        $("#certificate_title_content").val('');
        $("#signatureImg1").hide();
        $('#certificate_title_add_css').hide();
        }
        });

        $("#add_title_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_title_head1").show();
                $(".certificate_title_body1").show();
            } else {
                $(".certificate_title_head1").hide();
                $(".certificate_title_body1").hide();
            
            }
        });

        $("#add_title_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_title_head2").show();
                $(".certificate_title_body2").show();
            } else {
                $(".certificate_title_head2").hide();
                $(".certificate_title_body2").hide();
            
            }
        });

        $("#add_title_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_title_head3").show();
                $(".certificate_title_body3").show();
            } else {
                $(".certificate_title_head3").hide();
                $(".certificate_title_body3").hide();
            
            }
        });

        $("#certificate_title_content").keyup(function() {

        if($(this).val() == "") {
            $(".certificate_title_head").hide();
            $(".certificate_title_body").hide();
            $('#certificate_title_add_css').hide();
        } else {
            $(".certificate_title_head").show();
            $(".certificate_title_body").show()
            $('#certificate_title_add_css').show();

        }
});

    });

    $(function () {
        $('#certificate_certify_add_css').hide();
         $('#certificate_certify_mess').hide();
         $('#certificate_certify_enable').text('Disable');
         $('#certificate_certify_enable').addClass( "unchecked");

        $("#certificate_certify").click(function () {
        if ($(this).is(":checked")) {
        
        $(".certificate_certify_content").show();
        $("#certificate_certify_content").focus();
        $('#school_certify_select').text("Selected ");

        $('#certificate_certify_enable').text('Enable');
        $('#certificate_certify_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_certify_mess').show();
        $('#certificate_certify_info').hide();
        

         } else {
        $(".certificate_certify_head").hide();
        $(".certificate_certify_body").hide();
        $(".certificate_certify_head1").hide();
        $(".certificate_certify_body1").hide();
        $(".certificate_certify_head2").hide();
        $(".certificate_certify_body2").hide();
        $(".certificate_certify_head3").hide();
        $(".certificate_certify_body3").hide();
        $(".certificate_certify_content").hide();
        $('#school_certify_select').text("");

        $('#certificate_certify_enable').text('Disable');
        $('#certificate_certify_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_certify_mess').hide();
        $('#certificate_certify_info').show();
        $('#signature_person1').hide();
        $("#certificate_certify_content").val('');
        $("#signatureImg1").hide();
        $('#certificate_certify_add_css').hide();
        }
        });

        $("#add_certify_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_certify_head1").show();
                $(".certificate_certify_body1").show();
            } else {
                $(".certificate_certify_head1").hide();
                $(".certificate_certify_body1").hide();
            
            }
        });

        $("#add_certify_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_certify_head2").show();
                $(".certificate_certify_body2").show();
            } else {
                $(".certificate_certify_head2").hide();
                $(".certificate_certify_body2").hide();
            
            }
        });

        $("#add_certify_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_certify_head3").show();
                $(".certificate_certify_body3").show();
            } else {
                $(".certificate_certify_head3").hide();
                $(".certificate_certify_body3").hide();
            
            }
        });
        
        $("#certificate_certify_content").keyup(function() {

        if($(this).val() == "") {
            $(".certificate_certify_head").hide();
            $(".certificate_certify_body").hide();
            $('#certificate_certify_add_css').hide();
        } else {
            $(".certificate_certify_head").show();
            $(".certificate_certify_body").show();
            $('#certificate_certify_add_css').show();

        }
    });
    });

    $(function () {
        $('#certificate_holdername_add_css').hide();
         $('#certificate_holdername_mess').hide();
         $('#certificate_holdername_enable').text('Disable');
         $('#certificate_holdername_enable').addClass( "unchecked");

        $("#certificate_holdername").click(function () {
        if ($(this).is(":checked")) {
        $(".certificate_holdername_head").show();
        $(".certificate_holdername_body").show();
        $('#school_holder_select').text("Selected ");

        $('#certificate_holdername_enable').text('Enable');
        $('#certificate_holdername_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_holdername_mess').show();
        $('#certificate_holdername_info').hide();
        $('#certificate_holdername_add_css').show();

         } else {
        $(".certificate_holdername_head").hide();
        $(".certificate_holdername_body").hide();
        $(".certificate_holdername_head1").hide();
        $(".certificate_holdername_body1").hide();
        $(".certificate_holdername_head2").hide();
        $(".certificate_holdername_body2").hide();
        $(".certificate_holdername_head3").hide();
        $(".certificate_holdername_body3").hide();

        $('#certificate_holdername_enable').text('Disable');
        $('#certificate_holdername_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_holdername_mess').hide();
        $('#certificate_holdername_info').show();
        $('#signature_person1').hide();
        $('#signature_person1').val('');
        $("#signatureImg1").hide();
        $('#certificate_holdername_add_css').hide();
        $('#school_holder_select').text(" ");
        }
        });

        $("#add_holdername_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_holdername_head1").show();
                $(".certificate_holdername_body1").show();
            } else {
                $(".certificate_holdername_head1").hide();
                $(".certificate_holdername_body1").hide();
            
            }
        });

        $("#add_holdername_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_holdername_head2").show();
                $(".certificate_holdername_body2").show();
            } else {
                $(".certificate_holdername_head2").hide();
                $(".certificate_holdername_body2").hide();
            
            }
        });

        $("#add_holdername_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_holdername_head3").show();
                $(".certificate_holdername_body3").show();
            } else {
                $(".certificate_holdername_head3").hide();
                $(".certificate_holdername_body3").hide();
            
            }
        });
    });

    $(function () {
        $('#certificate_information_add_css').hide();
         $('#certificate_information_mess').hide();
         $('#certificate_information_enable').text('Disable');
         $('#certificate_information_enable').addClass( "unchecked");

        $("#certificate_information").click(function () {
        if ($(this).is(":checked")) {

        $(".certificate_information_content").show();
        $(".certificate_information_content").focus();
        $('#school_info_select').text("Selected");

        $('#certificate_information_enable').text('Enable');
        $('#certificate_information_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_information_mess').show();
        $('#certificate_information_info').hide();
  

         } else {

        $(".certificate_information_head").hide();
        $(".certificate_information_body").hide();
        $(".certificate_information_head1").hide();
        $(".certificate_information_body1").hide();
        $(".certificate_information_head2").hide();
        $(".certificate_information_body2").hide();
        $(".certificate_information_head3").hide();
        $(".certificate_information_body3").hide();
        $(".certificate_information_content").hide();
        $('#school_info_select').text("");

        $('#certificate_information_enable').text('Disable');
        $('#certificate_information_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_information_mess').hide();
        $('#certificate_information_info').show();
        $('#certificate_information_add_css').hide();
        $(".certificate_information_content").val('');
        }
        });

        $("#add_information_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_information_head1").show();
                $(".certificate_information_body1").show();
            } else {
                $(".certificate_information_head1").hide();
                $(".certificate_information_body1").hide();
            
            }
        });

        $("#add_information_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_information_head2").show();
                $(".certificate_information_body2").show();
                
            } else {
                $(".certificate_information_head2").hide();
                $(".certificate_information_body2").hide();
                
            
            }
        });

        $("#add_information_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_information_head3").show();
                $(".certificate_information_body3").show();

            } else {
                $(".certificate_information_head3").hide();
                $(".certificate_information_body3").hide();
            
            }
        });

        $("#certificate_information_content").keyup(function() {

        if($(this).val() == "") {
            $(".certificate_information_head").hide();
            $(".certificate_information_body").hide();
            $('#certificate_information_add_css').hide();
        } else {
            $(".certificate_information_head").show();
            $(".certificate_information_body").show();
            $('#certificate_information_add_css').show();

        }
        });
    });

    $(function () {
        $('#certificate_issue_add_css').hide();
         $('#certificate_issue_mess').hide();
         $('#certificate_issue_enable').text('Disable');
         $('#certificate_issue_enable').addClass( "unchecked");

        $("#certificate_issue_date").click(function () {
        if ($(this).is(":checked")) {
        // $(".certificate_issue_date_head").show();
        // $(".certificate_issue_date_body").show();
        $("#certificate_issue_date_content").show();

        $('#certificate_issue_enable').text('Enable');
        $('#certificate_issue_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_issue_mess').show();
        $('#certificate_issue_info').hide();
        $('#school_issue_select').text("Selected ");
     

         } else {
        $(".certificate_issue_date_head").hide();
        $(".certificate_issue_date_body").hide();
        $(".certificate_issue_date_head1").hide();
        $(".certificate_issue_date_body1").hide();
        $(".certificate_issue_date_head2").hide();
        $(".certificate_issue_date_body2").hide();
        $(".certificate_issue_date_head3").hide();
        $(".certificate_issue_date_body3").hide();
        $("#certificate_issue_date_content").hide();
        $("#certificate_issue_date_content").val('');

        $('#certificate_issue_enable').text('Disable');
        $('#certificate_issue_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_issue_mess').hide();
        $('#certificate_issue_info').show();
        $("#signatureImg1").hide();
        $('#certificate_issue_add_css').hide();
        $('#school_issue_select').text(" ");

        }
        });

        $("#add_issue_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_issue_date_head1").show();
                $(".certificate_issue_date_body1").show();
            } else {
                $(".certificate_issue_date_head1").hide();
                $(".certificate_issue_date_body1").hide();
            
            }
        });

        $("#add_issue_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_issue_date_head2").show();
                $(".certificate_issue_date_body2").show();
            } else {
                $(".certificate_issue_date_head2").hide();
                $(".certificate_issue_date_body2").hide();
            
            }
        });

        $("#add_issue_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_issue_date_head3").show();
                $(".certificate_issue_date_body3").show();
            } else {
                $(".certificate_issue_date_head3").hide();
                $(".certificate_issue_date_body3").hide();
            
            }
        });

        $("#certificate_issue_date_content").keyup(function() {

        if($(this).val() == "") {
            $(".certificate_issue_date_head").hide();
            $(".certificate_issue_date_body").hide();
            $('#certificate_issue_add_css').hide();
        } else {
            $(".certificate_issue_date_head").show();
            $(".certificate_issue_date_body").show();
            $('#certificate_information_add_css').show();

        }
        });
    });

   
    $(function () {
        $(".certificate_signature1_head").hide();
        $(".certificate_signature1_body").hide();

        $("#certificate_signature1").click(function () {
        if ($(this).is(":checked")) {

        $('#certificate_signature1_enable').text('Enable');
        $('#certificate_signature1_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_signature1_mess').show();
        $('#certificate_signature1_info').hide();
        $('#signature_person1').show();
        $('#signature_person1').focus();
        $('#school_signature1_select').text("Selected ");

         } else {
        $(".certificate_signature1_head").hide();
        $(".certificate_signature1_body").hide();
        $(".certificate_signature1_head1").hide();
        $(".certificate_signature1_body1").hide();
        $(".certificate_signature1_head2").hide();
        $(".certificate_signature1_body2").hide();
        $(".certificate_signature1_head3").hide();
        $(".certificate_signature1_body3").hide();
        $("#signatureImg1").hide();

        
        $('#certificate_signature1_enable').text('Disable');
        $('#certificate_signature1_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_signature1_mess').hide();
        $('#certificate_signature1_info').show();
        $('#signature_person1').hide();
        $('#signature_person1').val('');
        $("#signatureImg1").hide();
        $('#certificate_signature1_add_css').hide();
        $('#school_signature1_select').text(" ");

        }
        });

        $("#add_signature1_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature1_head1").show();
                $(".certificate_signature1_body1").show();
            } else {
                $(".certificate_signature1_head1").hide();
                $(".certificate_signature1_body1").hide();
            
            }
        });

        $("#add_signature1_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature1_head2").show();
                $(".certificate_signature1_body2").show();
            } else {
                $(".certificate_signature1_head2").hide();
                $(".certificate_signature1_body2").hide();
            
            }
        });

        $("#add_signature1_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature1_head3").show();
                $(".certificate_signature1_body3").show();
            } else {
                $(".certificate_signature1_head3").hide();
                $(".certificate_signature1_body3").hide();
            
            }
        });
    });

    $(function () {
        $('.certificate_signature1_img_enable').addClass( "unchecked" )
        $("#certificate_signature1img").click(function () {
        if ($(this).is(":checked")) {

        $('.certificate_signature1_img_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_signature1_img_mess').show();
        $('#certificate_signature1_img_info').hide();
        $('#certificate_signature1_img_add_css').show();
        $('#school_signature1_select').text("Selected ");
        
        $('#signature_person1_img').show();
        $('#signature_person1_img').focus();
        $(".certificate_signature1img_head").show();
        $(".certificate_signature1img_body").show();
        $("#select_signature1_img").show();

         } else {
        $(".certificate_signature1img_head").hide();
        $(".certificate_signature1img_body").hide();
        $(".certificate_signature1img_head1").hide();
        $(".certificate_signature1img_body1").hide();
        $(".certificate_signature1img_head2").hide();
        $(".certificate_signature1img_body2").hide();
        $(".certificate_signature1img_head3").hide();
        $("#select_signature1_img").hide();
        $('#school_signature1_select').text("");

        $('.certificate_signature1_img_enable').addClass( "unchecked" ).removeClass("checked ");
        $('#certificate_signature1_img_mess').hide();
        $('#certificate_signature1_img_info').show();
        $('#certificate_signature1_img_add_css').hide();

        $('#signature_person1_img').hide();
        }
        });

        $("#add_signature1img_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature1img_head1").show();
                $(".certificate_signature1img_body1").show();
            } else {
                $(".certificate_signature1img_head1").hide();
                $(".certificate_signature1img_body1").hide();
            
            }
        });

        $("#add_signature1img_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature1img_head2").show();
                $(".certificate_signature1img_body2").show();
            } else {
                $(".certificate_signature1img_head2").hide();
                $(".certificate_signature1img_body2").hide();
            
            }
        });

        $("#add_signature1img_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature1img_head3").show();
                $(".certificate_signature1img_body3").show();
            } else {
                $(".certificate_signature1img_head3").hide();
                $(".certificate_signature1img_body3").hide();
            
            }
        });
    });

    $("#signature_person1").keyup(function() {

        if($(this).val() == "") {
            $(".certificate_signature1_head").hide();
            $(".certificate_signature1_body").hide();
            $("#signatureImg1").hide();
            $('#certificate_signature1_add_css').hide();
        } else {
            $(".certificate_signature1_head").show();
            $(".certificate_signature1_body").show();
            $("#signatureImg1").show();
            $('#certificate_signature1_add_css').show();

        }
  });
  
  $('#certificate_signature1_add_css').hide();
  $('#certificate_signature1_enable').text('Disable');
  $('#signature_person1').hide();
  $('#certificate_signature1_mess').hide();
  $('#certificate_signature1_enable').addClass( "unchecked")

  $('#certificate_signature1_img_add_css').hide();
  $('#signature_person1_img').hide();
  $('#certificate_signature1_img_mess').hide();
  $('#certificate_signature1_img_enable').addClass( "unchecked")


  //   SIGNATURE 2

    
  $(function () {
        $("#certificate_signature2").click(function () {
        if ($(this).is(":checked")) {

        $('#certificate_signature2_enable').text('Enable');
        $('#certificate_signature2_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_signature2_mess').show();
        $('#certificate_signature2_info').hide();
        $('#signature_person2').show();
        $('#signature_person2').focus();
        $('#school_signature2_select').text("Selected ");

         } else {
        $(".certificate_signature2_head").hide();
        $(".certificate_signature2_body").hide();
        $(".certificate_signature2_head1").hide();
        $(".certificate_signature2_body1").hide();
        $(".certificate_signature2_head2").hide();
        $(".certificate_signature2_body2").hide();
        $(".certificate_signature2_head3").hide();
        $(".certificate_signature2_body3").hide();
        $('#school_signature2_select').text("");


        $('#certificate_signature2_enable').text('Disable');
        $('#certificate_signature2_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_signature2_mess').hide();
        $('#certificate_signature2_info').show();
        $('#signature_person2').hide();
        $('#signature_person2').val('');
        $("#signatureImg2").hide();
        $('#certificate_signature2_add_css').hide();
        return true;
        }

        });

        $("#add_signature2_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature2_head1").show();
                $(".certificate_signature2_body1").show();

            } else {
                $(".certificate_signature2_head1").hide();
                $(".certificate_signature2_body1").hide();
            
            }
        });

        $("#add_signature2_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature2_head2").show();
                $(".certificate_signature2_body2").show();
            } else {
                $(".certificate_signature2_head2").hide();
                $(".certificate_signature2_body2").hide();
            
            }
        });

        $("#add_signature2_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature2_head3").show();
                $(".certificate_signature2_body3").show();
            } else {
                $(".certificate_signature2_head3").hide();
                $(".certificate_signature2_body3").hide();
            
            }
        });
    });

    $(function () {
        $("#certificate_signature2img").click(function () {
        if ($(this).is(":checked")) {


        $('.certificate_signature2_img_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_signature2_img_mess').show();
        $('#certificate_signature2_img_info').hide();
        $('#certificate_signature2_img_add_css').show();
        
        $('#signature_person2_img').show();
        $('#signature_person2_img').focus();

        $(".certificate_signature2img_head").show();
        $(".certificate_signature2img_body").show();
        $("#select_signature2_img").show();


         } else {
        $(".certificate_signature2img_head").hide();
        $(".certificate_signature2img_body").hide();
        $(".certificate_signature2img_head1").hide();
        $(".certificate_signature2img_body1").hide();
        $(".certificate_signature2img_head2").hide();
        $(".certificate_signature2img_body2").hide();
        $(".certificate_signature2img_head3").hide();
        $("#select_signature2_img").hide();

        $('.certificate_signature2_img_enable').addClass( "unchecked" ).removeClass("checked ");
        $('#certificate_signature2_img_mess').hide();
        $('#certificate_signature2_img_info').show();
        $('#certificate_signature2_img_add_css').hide();
        $('#school_signature2_select').text("");

        }
        });

        $("#add_signature2img_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature2img_head1").show();
                $(".certificate_signature2img_body1").show();
            } else {
                $(".certificate_signature2img_head1").hide();
                $(".certificate_signature2img_body1").hide();
            
            }
        });

        $("#add_signature2img_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature2img_head2").show();
                $(".certificate_signature2img_body2").show();
            } else {
                $(".certificate_signature2img_head2").hide();
                $(".certificate_signature2img_body2").hide();
            
            }
        });

        $("#add_signature2img_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature2img_head3").show();
                $(".certificate_signature2img_body3").show();
            } else {
                $(".certificate_signature2img_head3").hide();
                $(".certificate_signature2img_body3").hide();
            
            }
        });
    });


  $("#signature_person2").keyup(function() {

    if($(this).val() == "") {
        $(".certificate_signature2_head").hide();
        $(".certificate_signature2_body").hide();
        $("#signatureImg2").hide();
        $('#certificate_signature2_add_css').hide();
    } else {
        $(".certificate_signature2_head").show();
        $(".certificate_signature2_body").show();
        $("#signatureImg2").show();
        $('#certificate_signature2_add_css').show();

    }
  });
  

  $('#certificate_signature2_add_css').hide();
  $('#certificate_signature2_enable').text('Disable');
  $('#signature_person2').hide();
  $('#certificate_signature2_mess').hide();
  $('#certificate_signature2_enable').addClass( "unchecked")


  $('#certificate_signature2_img_add_css').hide();
  $('#signature_person2_img').hide();
  $('#certificate_signature2_img_mess').hide();
  $('.certificate_signature2_img_enable').addClass( "unchecked")




// SIGNATURE 3

 
$(function () {
        $("#certificate_signature3").click(function () {
        if ($(this).is(":checked")) {

        $('#certificate_signature3_enable').text('Enable');
        $('#certificate_signature3_enable').addClass( "checked" ).removeClass("unchecked");
        $('#certificate_signature3_mess').show();
        $('#certificate_signature3_info').hide();
        $('#signature_person3').show();
        $('#signature_person3').focus();
        $('#school_signature3_select').text("Selected ");

         } else {
        $(".certificate_signature3_head").hide();
        $(".certificate_signature3_body").hide();
        $(".certificate_signature3_head1").hide();
        $(".certificate_signature3_body1").hide();
        $(".certificate_signature3_head2").hide();
        $(".certificate_signature3_body2").hide();
        $(".certificate_signature3_head3").hide();
        $(".certificate_signature3_body3").hide();
        $("#signatureImg3").hide();
        $('#school_signature3_select').text("");

        $('#certificate_signature3_enable').text('Disable');
        $('#certificate_signature3_enable').addClass( "unchecked" ).removeClass(" checked");
        $('#certificate_signature3_mess').hide();
        $('#certificate_signature3_info').show();
        $('#signature_person3').hide();
        $('#signature_person3').val('');
        $("#signatureImg3").hide();
        $('#certificate_signature3_add_css').hide();
        }
        });

        $("#add_signature3_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature3_head1").show();
                $(".certificate_signature3_body1").show();
            } else {
                $(".certificate_signature3_head1").hide();
                $(".certificate_signature3_body1").hide();
            
            }
        });

        $("#add_signature3_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature3_head2").show();
                $(".certificate_signature3_body2").show();
            } else {
                $(".certificate_signature3_head2").hide();
                $(".certificate_signature3_body2").hide();
            
            }
        });

        $("#add_signature3_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature3_head3").show();
                $(".certificate_signature3_body3").show();
            } else {
                $(".certificate_signature3_head3").hide();
                $(".certificate_signature3_body3").hide();
            
            }
        });
    });


    $(function () {
        $('.certificate_signature3_img_enable').addClass( "unchecked" );

        $("#certificate_signature3img").click(function () {
        if ($(this).is(":checked")) {

        $('.certificate_signature3_img_enable').addClass( "checked" ).removeClass("unchecked");

        $('#certificate_signature3_img_mess').show();
        $('#certificate_signature3_img_info').hide();
        $('#certificate_signature3_img_add_css').show();
        
        $('#signature_person3_img').show();
        $('#signature_person3_img').focus();

        $(".certificate_signature3img_head").show();
        $(".certificate_signature3img_body").show();
            
        $("#select_signature3_img").show();

         } else {
        $(".certificate_signature3img_head").hide();
        $(".certificate_signature3img_body").hide();
        $(".certificate_signature3img_head1").hide();
        $(".certificate_signature3img_body1").hide();
        $(".certificate_signature3img_head2").hide();
        $(".certificate_signature3img_body2").hide();
        $(".certificate_signature3img_head3").hide();
        $("#select_signature3_img").hide();


        $('.certificate_signature3_img_enable').addClass( "unchecked" ).removeClass("checked ");
        $('#certificate_signature3_img_mess').hide();
        $('#certificate_signature3_img_info').show();
        $('#certificate_signature3_img_add_css').hide();

        $('#signature_person3_img').hide();
        }
        });

        $("#add_signature3img_css").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature3img_head1").show();
                $(".certificate_signature3img_body1").show();
            } else {
                $(".certificate_signature3img_head1").hide();
                $(".certificate_signature3img_body1").hide();
            }
        });

        $("#add_signature3img_css1").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature3img_head2").show();
                $(".certificate_signature3img_body2").show();
            } else {
                $(".certificate_signature3img_head2").hide();
                $(".certificate_signature3img_body2").hide();
            
            }
        });

        $("#add_signature3img_css2").click(function () {
            if ($(this).is(":checked")) {
                $(".certificate_signature3img_head3").show();
                $(".certificate_signature3img_body3").show();
            } else {
                $(".certificate_signature3img_head3").hide();
                $(".certificate_signature3img_body3").hide();
            
            }
        });
    });


$("#signature_person3").keyup(function() {

if($(this).val() == "") {
    $(".certificate_signature3_head").hide();
    $(".certificate_signature3_body").hide();
    $("#signatureImg3").hide();
    $('#certificate_signature3_add_css').hide();
} else {
    $(".certificate_signature3_head").show();
    $(".certificate_signature3_body").show();
    $("#signatureImg3").show();
    $('#certificate_signature3_add_css').show();

}
});

$('#certificate_signature3_add_css').hide();
  $('#certificate_signature3_enable').text('Disable');
  $('#signature_person3').hide();
  $('#certificate_signature3_mess').hide();
  $('#certificate_signature3_enable').addClass( "unchecked")


  $('#certificate_signature3_img_add_css').hide();
//   $('#certificate_signature3_img_enable').text('Disable');
  $('#signature_person3_img').hide();
  $('#certificate_signature3_img_mess').hide();
  $('#certificate_signature3_img_enable').addClass( "unchecked")

    
    //  End Checkbox for Names

  
  $('#card_title').on('change', function(){
  
    var card_title =  $('#card_title').val();
  
    if(card_title == 'student_id_card'){
      $('#id_switcher_student').show();
      $('.certificate_frame_head').show();
      $('.certificate_frame_body').show();
      $('#id_switcher_staff').hide();
      $('#id_switcher_leaving_certificate').hide();
      $('#id_switcher_admit_card').hide();
      // alert(card_title)
    }else if(card_title == 'staff_id_card'){
  
      $('#id_switcher_staff').show();
      $('#id_switcher_student').hide();
      $('#id_switcher_admit_card').hide();
      $('#id_switcher_leaving_certificate').hide();
  
    }else if(card_title == 'admit_card'){
  
      $('#id_switcher_admit_card').show();
      $('#id_switcher_staff').hide();
      $('#id_switcher_student').hide();
      $('#id_switcher_leaving_certificate').hide();
    }
    else if(card_title == 'leaving_certificate'){
  
      $('#id_switcher_leaving_certificate').show();
      $('#id_switcher_staff').hide();
      $('#id_switcher_student').hide();
      $('#id_switcher_admit_card').hide();
  
    }else{
    
    }
    
  })
  
      function Printcontent(el) {
          // alert(1)
          var restorpage = document.body.innerHTML;
          var printContent = document.getElementById(el).innerHTML;
          document.body.innerHTML = printContent; 
          window.print();
          document.body.innerHTML = restorpage; 
          window.close();
      }
  
     
//   $('#certificate_issue_date_content').datetimepicker({
//       format: 'YYYY-MM-DD'
//   });

  $('#certificate_issue_date_content').datetimepicker({
            i18n: {
                de: {
                    months: [
                        'January', 'February', 'March', 'April',
                        'May', 'Jun', 'July', 'August',
                        'September', 'October', 'November', 'December',
                    ],
                    dayOfWeek: [
                        "Su", "Mon", "Tu", "Wed",
                        "Thu", "Fri", "Sa",
                    ]
                }
            },
            timepicker: false,
            format: 'Y-m-d'
        });
  
  
  // {{--------------------------Level Side-------------------------}} 
  $('#return_book').on('show.bs.modal', function(event){
  
  var button = $(event.relatedTarget)
  var level = button.data('level')
  var course_id = button.data('course_id')
  var level_description = button.data('level_description')
  var card_id = button.data('card_id')
  var student_name = button.data('student_name')
  
  // $('#email_user').val(email);
  
  var modal = $(this)
  
  modal.find('.modal-title').text('Send Email');
  modal.find('.modal-body #level').val(level);
  modal.find('.modal-body #course_id').val(course_id);
  modal.find('.modal-body #level_description').val(level_description);
  modal.find('.modal-body #card_id').val(card_id);
  modal.find('.modal-body #student_name').val(student_name);
  
  $('#student_name_text').text(student_name)
  
  
  
  });
  
  // {{--------------------------Level view Side-------------------------}} 
  $('#level-show').on('show.bs.modal', function(event){
  
  var button = $(event.relatedTarget)
  var level = button.data('level')
  var course_id = button.data('course_id')
  var level_description = button.data('level_description')
  var created_at = button.data('created_at')
  var updated_at = button.data('updated_at')
  var level_id = button.data('level_id')
  
  var modal = $(this)
  
  modal.find('.modal-title').text('VIEW LEVEL INFORMATION');
  modal.find('.modal-body #level').val(level);
  modal.find('.modal-body #course_id').val(course_id);
  modal.find('.modal-body #level_description').val(level_description);
  modal.find('.modal-body #created_at').val(created_at);
  modal.find('.modal-body #updated_at').val(updated_at);
  modal.find('.modal-body #level_id').val(level_id);
  });

//   $(document).ready(function(){


//   function ekUpload() {
//   function Init() {
//     console.log("Upload Initialised");

//     var fileSelect = document.getElementById("file-upload"),
//       fileDrag = document.getElementById("file-drag"),
//       submitButton = document.getElementById("submit-button");

//     fileSelect.addEventListener("change", fileSelectHandler, false);

//     // Is XHR2 available?
//     var xhr = new XMLHttpRequest();
//     if (xhr.upload) {
//       // File Drop
//       fileDrag.addEventListener("dragover", fileDragHover, false);
//       fileDrag.addEventListener("dragleave", fileDragHover, false);
//       fileDrag.addEventListener("drop", fileSelectHandler, false);
//     }
//   }

//   function fileDragHover(e) {
//     var fileDrag = document.getElementById("file-drag");

//     e.stopPropagation();
//     e.preventDefault();

//     fileDrag.className =
//       e.type === "dragover" ? "hover" : "modal-body file-upload";
//   }

//   async function fileSelectHandler(e) {
//     // Fetch FileList object
//     var files = e.target.files || e.dataTransfer.files;

//     // Cancel event and hover styling
//     fileDragHover(e);

//     // Process all File objects
//     for (let i = 0; i < files.length; i++) {
//       const f = files[i];
//       if (await hasAlpha(f)) {
//         console.log('Selected image is transparent');
//         parseFile(f);
//         uploadFile(f);
//       }
//       else {
//         console.log('Selected image is not transparent');
//         document.querySelector('#response').classList.remove('hidden');
//         document.querySelector('#file-image').classList.add('hidden');
//         output('<strong class="warning">Image background is not transparent</strong>');
//       }
//     }
//   }

//   // Output
//   function output(msg) {
//     // Response
//     var m = document.getElementById("messages");
//     m.innerHTML = msg;
//   }

//   function hasAlpha(file) {
//     return new Promise((resolve, reject) => {
//       let hasAlpha = false;
//       const canvas = document.querySelector('canvas');
//       const ctx = canvas.getContext('2d');
    
//       const img = new Image();
//       img.crossOrigin = 'Anonymous';
//       img.onerror = reject;
//       img.onload = function() {
//         canvas.width = img.width;
//         canvas.height = img.height;
      
//         ctx.drawImage(img, 0, 0);
//         const imgData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
      
//         for (let j = 0; j < imgData.length; j += 4) {
//           if (imgData[j + 3] < 255) {
//             hasAlpha = true;
//             break;
//           }
//         }
//         resolve(hasAlpha);
//       };
//       img.src = URL.createObjectURL(file);
//     });
//   }

//   function parseFile(file) {
//     console.log(file.name);
//     output("<strong>" + encodeURI(file.name) + "</strong>");

//     // var fileType = file.type;
//     // console.log(fileType);
//     var imageName = file.name;

//     var isGood = /\.(?=svg|jpg|png|jpeg)/gi.test(imageName);
//     if (isGood) {
//       document.getElementById("start").classList.add("hidden");
//       document.getElementById("response").classList.remove("hidden");
//       document.getElementById("notimage").classList.add("hidden");
//       // Thumbnail Preview
//       document.getElementById("file-image").classList.remove("hidden");
//       document.getElementById("file-image").src = URL.createObjectURL(file);
//     } else {
//       document.getElementById("file-image").classList.add("hidden");
//       document.getElementById("notimage").classList.remove("hidden");
//       document.getElementById("start").classList.remove("hidden");
//       document.getElementById("response").classList.add("hidden");
//       document.getElementById("file-upload-form").reset();
//     }
//   }

//   function uploadFile(file) {
//     var xhr = new XMLHttpRequest(),
//       fileInput = document.getElementById("class-roster-file"),
//       fileSizeLimit = 1024; // In MB

//     if (xhr.upload) {
//       // Check if file is less than x MB
//       if (file.size <= fileSizeLimit * 1024 * 1024) {
//         // File received / failed
//         xhr.onreadystatechange = function(e) {
//           if (xhr.readyState == 4) {
//             // Everything is good!
//             // document.location.reload(true);
//           }
//         };

//         // Start upload
//         xhr.open(
//           "POST",
//           document.getElementById("file-upload-form").action,
//           true
//         );
//         xhr.setRequestHeader("X-File-Name", file.name);
//         xhr.setRequestHeader("X-File-Size", file.size);
//         xhr.setRequestHeader("Content-Type", "multipart/form-data");
//         xhr.send(file);
//       } else {
//         output("Please upload a smaller file (< " + fileSizeLimit + " MB).");
//       }
//     }
//   }

//   // Check for the various File API support.
//   if (window.File && window.FileList && window.FileReader) {
//     Init();
//   } else {
//     document.getElementById("file-drag").style.display = "none";
//   }
// }
// ekUpload();






  
//   $(document).ready(function(){
//       $('.js-switch').change(function () {
//           let status = $(this).prop('checked') === true ? 'on' : 'off';
//           let levelId = $(this).data('id');
//           $.ajax({
//               type: "GET",
//               dataType: "json",
//               url: '{{ url('level/status/update') }}',
//               data: {'status': status, 'level_id': levelId},
//               success: function (data) {
//                   console.log(data.message);
//                   // success: function (data) {
//                   toastr.options.closeButton = true;
//                   toastr.options.closeMethod = 'fadeOut';
//                   toastr.options.closeDuration = 100;
//                   toastr.success(data.message);
//   // }
//               }
//           });
//       });
//   }) ;



</script>