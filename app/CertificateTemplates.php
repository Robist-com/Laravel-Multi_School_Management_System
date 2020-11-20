<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateTemplates extends Model
{
    protected $table = 'certificate_templates';

    protected $fillable = ['status','school_header_color','school_header_bgcolor',
     'school_footer_color', 'school_footer_bgcolor', 'user_id', 'school_id',
     'school_background_image' , 'school_signature', 'school_logo','qrcode',

    'address','mother_name','card_title',
    'father_name', 'grade', 'class','student_image',
    'student_name', 'roll_no', 'card_holder', 
    
    'staff_address','staff_card_title',
     'staff_grade', 'staff_department','staff_image',
    'staff_name', 'staff_roll_no', 'staff_card_holder', 
    
    'admit_address','admit_mother_name','admit_card_title',
    'admit_father_name', 'admit_grade', 'admit_class','admit_student_image',
    'admit_student_name', 'admit_roll_no',
    
    'leaving_certificate_address','leaving_certificate_mother_name',
    'leaving_certificate_father_name', 'leaving_certificate_grade', 'leaving_certificate_class',
    'leaving_certificate_student_image','leaving_certificate_student_name', 'leaving_certificate_roll_no',
    
    
    
    ];
}
