<?php

namespace App\Http\Controllers;

use App\DesignCertificates;
use App\DesignCertificateProp;
use App\DesignCertificateProp1;
use DB;
use Illuminate\Http\Request;
use Flash;
use App\Models\Admission;
use App\Models\Classes; 
use App\Models\Teacher; 
class DesignCertificatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $card_template = DesignCertificates::all();
        $visitors = DesignCertificates::where('school_id', auth()->user()->school_id); 
        // truncate();
       return view('admins.design_certificates.index',compact('card_template','visitors'));
    }

    public function truncate()
    {
        $visitors = DesignCertificates::where('school_id', auth()->user()->school_id)->count();
        $visitors = DesignCertificateProp::where('school_id', auth()->user()->school_id)->count();
        $visitors = DesignCertificateProp1::where('school_id', auth()->user()->school_id)->count();
            
        if ( $visitors > 0) {

            Flash::success('Truncate Success!');
            DesignCertificates::where('school_id', auth()->user()->school_id)->truncate();
            DesignCertificateProp1::where('school_id', auth()->user()->school_id)->truncate();
            DesignCertificateProp::where('school_id', auth()->user()->school_id)->truncate();
            }else{ 
                Flash::warning('You have no Record yet!' .' '. 'Thank you! see you next time.');
            }
            // query()->
           
        // $visitors ->truncate();

       

        return redirect(route('design_certiifcate.index'));
        // view('admins.design_certificates.index',compact('visitors'))->with('visitors' , $visitors);
            // ->with('success', 'Truncate Done');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            // 'certificate_frame_height' => 'required|unique:products',
            // 'amount' => 'required|numeric',
            'certificate_frame_width' => 'required',
            'certificate_frame_height' => 'required',
            // 'description' => 'required',
        ]);


        // $rules = [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'message' => 'required|max:250',
        // ];
    
        // $customMessages = [
        //     'required' => 'The :attribute field is required.'
        // ];
    
        // $this->validate($request, $rules, $customMessages);

        // dd($request->all());
        $certificate_logo = 'off';
        $certificate_frame_background = 'off';

        $certificate_signature_img_1 = 'off';
        $certificate_signature_img_2 = 'off';
        $certificate_signature_img_3 = 'off';
 
        $certificate_signature1 = 'off';
        $certificate_signature2 = 'off';
        $certificate_signature3 = 'off';
        
        $certificate_issue_date = 'off';
        $certificate_certify_title = 'off';

        $certificate_company_address = 'off';
        $certificate_company_name = 'off';

        $certificate_title = 'off';

        if ($request->certificate_logo) {
            $certificate_logo = 'on';

        }

        if ($request->certificate_company_address) {
            $certificate_company_address = 'on';
        }
        
        // else
        if ($request->certificate_signature_img_1_url) {
            $certificate_signature_img_1 = 'on';

        }

        // else
        if ($request->certificate_signature_img_2_url) {
            $certificate_signature_img_2 = 'on';

        }
        // else
        if ($request->certificate_signature_img_3_url) {
            $certificate_signature_img_3 = 'on';

        }
        // else
        if ($request->certificate_issue_date) {
            $certificate_issue_date = 'on';

        }
        // else
        if ($request->certificate_signature1) {
            $certificate_signature1 = 'on';

        }
        // else
        if ($request->certificate_signature2) {
            $certificate_signature2 = 'on';

        }
        // else
        if ($request->certificate_signature3) {
            $certificate_signature3 = 'on';

        }
        // else
        if ($request->certificate_title) {
            $certificate_title = 'on';
        }
        
        // else{
        //     $certificate_logo = 'off';
        //     $certificate_company_address = 'off';

        //     // $certificate_signature_img_1 = 'off';
        //     // $certificate_signature_img_2 = 'off';
        //     // $certificate_signature_img_3 = 'off';

        //     $certificate_signature1 = 'off';
        //     $certificate_signature2 = 'off';
        //     $certificate_signature3 = 'off';

        //     $certificate_issue_date = 'off';

        //     $certificate_title = 'off';
        // }

            $new_image_name_signature1 = '';
            $new_image_name_signature2 = '';
            $new_image_name_signature3 = '';
            $new_image_name_bg_img =  '';

  
        if ($request->hasFile('certificate_background_image') || 
            $request->hasFile('certificate_signature_img_1_url') ||
            $request->hasFile('certificate_signature_img_2_url') ||
            $request->hasFile('certificate_signature_img_3_url')) {

            $file_signature1 = $request->file('certificate_signature_img_1_url');
            $file_signature2 = $request->file('certificate_signature_img_2_url');
            $file_signature3 = $request->file('certificate_signature_img_3_url');
            $file_frame_background = $request->file('certificate_background_image');
       

        // dd($file_signature2);

        if ($file_signature1 != '') {
        $extension_signature1 = $file_signature1->getClientOriginalExtension();
        // dd($file_signature1);
        }
        if ($file_signature2 != '') {
            $extension_signature2 = $file_signature2->getClientOriginalExtension();
            // dd($extension_signature2);
        }
        if ($file_signature3 != '') {
            $extension_signature3 = $file_signature3->getClientOriginalExtension();
        }
        if ($file_frame_background != '') {
            $extension_bg_img = $file_frame_background->getClientOriginalExtension();
        }


            if ($file_signature1 != '') {
            $new_image_name_signature1 = rand(11111, 99999). '.' .$extension_signature1;
            // dd($new_image_name_signature1);
            }
            if ($file_signature2 != '') {
                $new_image_name_signature2 = rand(21111, 99999). '.' .$extension_signature2;
                // dd($new_image_name_signature2);
            }

            if ($file_signature3 != '') {
                $new_image_name_signature3 = rand(31111, 99999). '.' .$extension_signature3;
            }
            if ($file_frame_background != '') {
            $new_image_name_bg_img = date('Y-m-d'). '.' .$extension_bg_img;

            }
            if ($file_signature1 != '') {
                $file_signature1->move(public_path('certificate_design/school_certificates'), $new_image_name_signature1);
            //    dd($new_image_name_signature1);
            }
            if ($file_signature2 != '') {
                $file_signature2->move(public_path('certificate_design/school_certificates'), $new_image_name_signature2);
               
            }
            if ($file_signature3 != '') {
                $file_signature3->move(public_path('certificate_design/school_certificates'), $new_image_name_signature3);
            }

            if ($file_frame_background != '') {
                $file_frame_background->move(public_path('certificate_design/school_certificates'), $new_image_name_bg_img);
            
            }
            
            // dd($new_image_name_signature, $new_image_name_qrcode);

        }else {
                $new_image_name_signature1 = '';
                $new_image_name_signature2 = '';
                $new_image_name_signature3 = '';
                $new_image_name_bg_img =  '';
            }

            // $certificate_title_text = '';
                
            // dd($request->all());
            // dd( $new_image_name_signature1, $new_image_name_signature2, $new_image_name_signature3 );

            $isExist = DesignCertificates::where('certificate_type', $request->certificate_type)
                        ->where('certificate_to', $request->certificate_to)->count();
    if ($isExist > 0) {
        Flash::error('Certificate with this name ' . $request->certificate_type . ' is already exisit for '  . $request->certificate_to .  ' please try another name');
        return redirect(url()->previous())->with($request->certificate_to);
     } else {
      
            $certificate_template =  DesignCertificates::Create($request->all());

        if ($certificate_template) {

        $certificate_template_prop = array(

            "design_certificate_id" => $certificate_template->id,
            "certificate_company_name" => $certificate_company_name,
            "certificate_company_name_height" => $request->certificate_company_name_height,
            "certificate_company_name_font_size" => $request->certificate_company_name_font_size,
            "certificate_company_name_font_weight" => $request->certificate_company_name_font_weight,
            "certificate_company_name_font_family" => $request->certificate_company_name_font_family,
            "certificate_company_name_margin" => $request->certificate_company_name_margin,
            "certificate_company_name_padding" => $request->certificate_company_name_padding,
            "certificate_company_name_display" => $request->certificate_company_name_display,
            "certificate_company_name_text_align" => $request->certificate_company_name_text_align,

            "certificate_logo" => $certificate_logo,
            "certificate_logo_width" => $request->certificate_logo_width,
            "certificate_logo_height" => $request->certificate_logo_height,
            "certificate_logo_margin" => $request->certificate_logo_margin,
            "certificate_logo_padding" => $request->certificate_logo_padding,
            "certificate_logo_display" => $request->certificate_logo_display,

            "certificate_company_address" => $certificate_company_address,
            "certificate_company_address_width" => $request->certificate_company_address_width,
            "certificate_company_address_height" => $request->certificate_company_address_height,
            "certificate_company_address_font_size" => $request->certificate_company_address_font_size,
            "certificate_company_address_font_weight" => $request->certificate_company_address_font_weight,
            "certificate_company_address_font_family" => $request->certificate_company_address_font_family,
            "certificate_company_address_margin" => $request->certificate_company_address_margin,
            "certificate_company_address_padding" => $request->certificate_company_address_padding,
            "certificate_company_address_display" => $request->certificate_company_address_display,
            "certificate_company_address_text_align" => $request->certificate_company_address_text_align,

            "certificate_title" => $certificate_title,
            "certificate_title_text" => $request->certificate_title_text,
            "certificate_title_text_align" => $request->certificate_title_text_align,
            "certificate_title_font_family" => $request->certificate_title_font_family,
            "certificate_title_font_weight" => $request->certificate_title_font_weight,
            "certificate_title_font_size" => $request->certificate_title_font_size,
            "certificate_title_font_display" => $request->certificate_title_font_display,
            "certificate_title_margin" => $request->certificate_title_margin,
            "certificate_title_padding" => $request->certificate_title_padding,

            "certificate_certify_title" => $certificate_certify_title,
            "certificate_certify_title_text" => $request->certificate_certify_content,
            "certificate_certify_text_align" => $request->certificate_certify_text_align,
            "certificate_certify_title_font_family" => $request->certificate_certify_title_font_family,
            "certificate_certify_title_font_weight" => $request->certificate_certify_title_font_weight,
            "certificate_certify_title_font_size" => $request->certificate_certify_title_font_size,
            "certificate_certify_title_font_display" => $request->certificate_certify_title_font_display,
            "certificate_certify_title_margin" => $request->certificate_certify_title_margin,
            "certificate_certify_title_padding" => $request->certificate_certify_title_padding,

            "certificate_holder_name" => $request->certificate_holder_name,
            "certificate_holder_text_align" => $request->certificate_holder_text_align,
            "certificate_holder_font_family" => $request->certificate_holder_font_family,
            "certificate_holder_font_weight" => $request->certificate_holder_font_weight,
            "certificate_holder_font_size" => $request->certificate_holder_font_size,
            "certificate_holder_font_display" => $request->certificate_holder_font_display,
            "certificate_holder_margin" => $request->certificate_holder_margin,
            "certificate_holder_padding" => $request->certificate_holder_padding,

            "certificate_information" => $request->certificate_information,
            "certificate_information_text" => $request->certificate_information_text,
            "certificate_information_text_align" => $request->certificate_information_text_align,
            "certificate_information_font_family" => $request->certificate_information_font_family,
            "certificate_information_font_weight" => $request->certificate_information_font_weight,
            "certificate_information_font_size" => $request->certificate_information_font_size,
            "certificate_information_font_display" => $request->certificate_information_font_display,
            "certificate_information_margin" => $request->certificate_information_margin,
            "certificate_information_padding" => $request->certificate_information_padding,
            "school_id" => $request->school_id,
            "certificate_background_image" => $new_image_name_bg_img,
        );

            $certificate_template_prop1 = array(

                "design_certificate_id" => $certificate_template->id,

                "certificate_signature1" => $certificate_signature1,
                "certificate_signature1_text_align" => $request->certificate_signature1_text_align,
                "certificate_signature1_font_family" => $request->certificate_signature1_font_family,
                "certificate_signature1_font_weight" => $request->certificate_signature1_font_weight,
                "certificate_signature1_font_size" => $request->certificate_signature1_font_size,
                "certificate_signature1_font_display" => $request->certificate_signature1_font_display,
                "certificate_signature1_margin" => $request->certificate_signature1_margin,
                "certificate_signature1_padding" => $request->certificate_signature1_padding,
                "certificate_signature1_line_height" => $request->certificate_signature1_line_height,

                "certificate_img_signature1" => $certificate_signature_img_1,
                "certificate_img_signature1_text_align" => $request->certificate_img_signature1_text_align,
                "certificate_img_signature1_font_family" => $request->certificate_img_signature1_font_family,
                "certificate_img_signature1_font_weight" => $request->certificate_img_signature1_font_weight,
                "certificate_img_signature1_font_size" => $request->certificate_img_signature1_font_size,
                "certificate_img_signature1_font_display" => $request->certificate_img_signature1_font_display,
                "certificate_img_signature1_margin" => $request->certificate_img_signature1_margin,
                "certificate_img_signature1_padding" => $request->certificate_img_signature1_padding,
                "certificate_img_signature1_line_height" => $request->certificate_img_signature1_line_height,
                "certificate_img_signature1_width" => $request->certificate_img_signature1_width,
                "certificate_img_signature1_height" => $request->certificate_img_signature1_height,
                "certificate_img_signature1_border_radius" => $request->certificate_img_signature1_border_radius,
                "certificate_signature_img_1_url" => $new_image_name_signature1,

                 "certificate_signature2" => $certificate_signature2,
                "certificate_signature2_text_align" => $request->certificate_signature2_text_align,
                "certificate_signature2_font_family" => $request->certificate_signature2_font_family,
                "certificate_signature2_font_weight" => $request->certificate_signature2_font_weight,
                "certificate_signature2_font_size" => $request->certificate_signature2_font_size,
                "certificate_signature2_font_display" => $request->certificate_signature2_font_display,
                "certificate_signature2_margin" => $request->certificate_signature2_margin,
                "certificate_signature2_padding" => $request->certificate_signature2_padding,
                "certificate_signature2_line_height" => $request->certificate_signature2_line_height,

                "certificate_img_signature2" => $certificate_signature_img_2,
                "certificate_img_signature2_text_align" => $request->certificate_img_signature2_text_align,
                "certificate_img_signature2_font_family" => $request->certificate_img_signature2_font_family,
                "certificate_img_signature2_font_weight" => $request->certificate_img_signature2_font_weight,
                "certificate_img_signature2_font_size" => $request->certificate_img_signature2_font_size,
                "certificate_img_signature2_font_display" => $request->certificate_img_signature2_font_display,
                "certificate_img_signature2_margin" => $request->certificate_img_signature2_margin,
                "certificate_img_signature2_padding" => $request->certificate_img_signature2_padding,
                "certificate_img_signature2_line_height" => $request->certificate_img_signature2_line_height,
                "certificate_img_signature2_width" => $request->certificate_img_signature2_width,
                "certificate_img_signature2_height" => $request->certificate_img_signature2_height,
                "certificate_img_signature2_border_radius" => $request->certificate_img_signature2_border_radius,
                "certificate_signature_img_2_url" => $new_image_name_signature2,

                "certificate_signature3" => $certificate_signature3,
                "certificate_signature3_text_align" => $request->certificate_signature3_text_align,
                "certificate_signature3_font_family" => $request->certificate_signature3_font_family,
                "certificate_signature3_font_weight" => $request->certificate_signature3_font_weight,
                "certificate_signature3_font_size" => $request->certificate_signature3_font_size,
                "certificate_signature3_font_display" => $request->certificate_signature3_font_display,
                "certificate_signature3_margin" => $request->certificate_signature3_margin,
                "certificate_signature3_padding" => $request->certificate_signature3_padding,
                "certificate_signature3_line_height" => $request->certificate_signature3_line_height,

                "certificate_img_signature3" => $certificate_signature_img_3  ,
                "certificate_img_signature3_text_align" => $request->certificate_img_signature3_text_align,
                "certificate_img_signature3_font_family" => $request->certificate_img_signature3_font_family,
                "certificate_img_signature3_font_weight" => $request->certificate_img_signature3_font_weight,
                "certificate_img_signature3_font_size" => $request->certificate_img_signature3_font_size,
                "certificate_img_signature3_font_display" => $request->certificate_img_signature3_font_display,
                "certificate_img_signature3_margin" => $request->certificate_img_signature3_margin,
                "certificate_img_signature3_padding" => $request->certificate_img_signature3_padding,
                "certificate_img_signature3_line_height" => $request->certificate_img_signature3_line_height,
                "certificate_img_signature3_width" => $request->certificate_img_signature3_width,
                "certificate_img_signature3_height" => $request->certificate_img_signature3_height,
                "certificate_img_signature3_border_radius" => $request->certificate_img_signature3_border_radius,
                "certificate_signature_img_3_url" => $new_image_name_signature3,

                "certificate_issue_date"  => $request->certificate_issue_date,
                "certificate_issue_date_value" => $request->certificate_issue_date_value,
                "certificate_issue_date_text_align" => $request->certificate_issue_date_text_align,
                "certificate_issue_date_font_family" => $request->certificate_issue_date_font_family,
                "certificate_issue_date_font_weight" => $request->certificate_issue_date_font_weight,
                "certificate_issue_date_font_size" => $request->certificate_issue_date_font_size,
                "certificate_issue_date_font_display" => $request->certificate_issue_date_font_display,
                "certificate_issue_date_margin" => $request->certificate_issue_date_margin,
                "certificate_issue_date_padding" => $request->certificate_issue_date_padding,
                "certificate_issue_date_line_height" => $request->certificate_issue_date_line_height,
                "certificate_issue_date_width" => $request->certificate_issue_date_width,
                "certificate_issue_date_height" => $request->certificate_issue_date_height,
                "certificate_issue_date_border_radius" => $request->certificate_issue_date_border_radius,

                'signature_person1_text' => $request->signature_person1_text,
                'signature_person2_text' => $request->signature_person2_text,
                'signature_person3_text' => $request->signature_person3_text,

                
                // "certificate_signature_img_2" => $new_image_name_signature2,
                // "certificate_signature_img_3" => $new_image_name_signature3,
                "school_id" => $request->school_id,
            );


            DesignCertificateProp::updateOrCreate($certificate_template_prop);
            DesignCertificateProp1::updateOrCreate($certificate_template_prop1);

        //    $id = DB::table('design_certificates')->where('school_id', auth()->user()->school_id)
        //     ->where('id', $certificate_template->id)
        //     ->last();
        //     dd($id);
                // Flash::success("Your account is not yet active. <a href='{url('/activation/resend')}'>Click here</a>");
        }else {
          Flash::error('Certificate Creation Failed!');
        }
       

        $msg = 'Your Certificate is Created successfully!, <i class="fa fa-hand-right fa-lg"></i> <a href="'. route('design_certiifcate.show', [$certificate_template->id]) . '" target="_blank"> click here  </a>  to see the result';
        return redirect()->back()->withSuccess($msg);

    }
}

    public function genarateCertificate(Request $request)
    {
        $students = Admission::
        join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('school_id', auth()->user()->school_id)->where('acceptance', 'accept')->get();


        $classes = Classes::where('school_id', auth()->user()->school_id)->where('status', 'on')->get();

        // dd($request->all());

        if ($request->class_code != '' && $request->student_id == '') {
            $institute = DB::table('rolls')->join('admissions', 'admissions.id', '=', 'rolls.student_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
            ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
            ->join('departments', 'departments.department_id', '=', 'admissions.department_id')
            ->select('classes.class_name','semesters.semester_name','institute.name',
            'institute.email as school_email', 'institute.establish','institute.phoneNo','institute.address as school_address',
            'admissions.first_name', 'admissions.last_name','admissions.gender','admissions.*',
            'institute.image as logo','rolls.username as roll_no','admissions.email','departments.department_name',
            'admissions.image','admissions.phone', 'admissions.id as student_id')
            ->where('admissions.school_id', auth()->user()->school_id)
            ->where('classes.class_code', $request->class_code )
            ->get();

        }elseif ($request->class_code == '' && $request->student_id != '') {
            $institute = DB::table('rolls')->join('admissions', 'admissions.id', '=', 'rolls.student_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
            ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
            // ->join('departments', 'departments.department_id', '=', 'admissions.department_id')
            ->select('classes.class_name','semesters.semester_name','institute.name',
            'institute.email as school_email', 'institute.establish','institute.phoneNo','institute.address as school_address',
            'admissions.first_name', 'admissions.last_name','admissions.gender','admissions.*',
            'institute.image as logo','rolls.username as roll_no','admissions.email',
            'admissions.dob as department_name',
            'admissions.image','admissions.phone', 'admissions.id as student_id')
            ->where('admissions.school_id', auth()->user()->school_id)
            ->where('admissions.id', $request->student_id )
            ->get();
           
        }elseif ($request->teacher_id != '' && $request->class_code == '' && $request->student_id == '') {
            $institute = DB::table('teachers')
            ->join('departments', 'departments.department_id', '=', 'teachers.department_id')
            ->join('faculties', 'faculties.faculty_id', '=', 'teachers.faculty_id')
            ->join('semesters', 'semesters.id', '=', 'teachers.semester_id')
            ->join('institute', 'institute.school_id', '=', 'teachers.school_id')
            ->select(
            'teachers.first_name', 'teachers.last_name','teachers.gender','institute.name',
            'institute.name','institute.email as school_email', 'institute.establish','institute.phoneNo',
            'institute.address','departments.department_name', 'faculties.faculty_name',
            'institute.web as campus','teachers.dob','institute.image as logo','institute.address as school_address',
            'teachers.roll_no as roll_no','teachers.email','teachers.image','teachers.phone',
            'teachers.teacher_id', 'semesters.semester_name')
            ->where('teachers.school_id', auth()->user()->school_id)
            ->where('teachers.teacher_id', $request->teacher_id )
            ->get();
           
        }

        $data = DB::table('rolls')->join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
        ->join('batches', 'batches.id', '=', 'admissions.batch_id')
        ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
        ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
        ->select('classes.class_name','semesters.semester_name',
        'admissions.first_name', 'admissions.last_name','admissions.gender','institute.name',
        'institute.name','institute.email as school_email', 'institute.establish','institute.phoneNo','institute.address',
        'batches.batch as session', 'batches.id as seatNo',
        'institute.web as campus','admissions.father_name', 'admissions.mother_name','admissions.dob',
        'institute.image as logo','rolls.username as roll_no','admissions.email','admissions.address as student_address',
        'admissions.image','admissions.phone', 'admissions.id as student_id')
        ->where('admissions.school_id', auth()->user()->school_id)
        ->where('admissions.id', $request->student_id )
        ->first();


        $card_template1 = DesignCertificates::where('school_id', auth()->user()->school_id)->get();
        $id_cards = DesignCertificates::where('school_id', auth()->user()->school_id)
        ->where('certificate_to',$request->card_title)
        ->get();

        $admit_cards = DesignCertificates::where('school_id', auth()->user()->school_id)
        ->where('certificate_to',$request->card_title)->first();


        $students = Admission::
        join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('school_id', auth()->user()->school_id)->where('acceptance', 'accept')->get();

        $teachers = Teacher::
        join('departments', 'departments.department_id', '=', 'teachers.department_id')
        ->join('faculties', 'faculties.faculty_id', '=', 'teachers.faculty_id')
        ->join('semesters', 'semesters.id', '=', 'teachers.semester_id')
        ->where('teachers.school_id', auth()->user()->school_id)->get();


        $classes = Classes::where('school_id', auth()->user()->school_id)->where('status', 'on')->get();

        $card_template = DesignCertificates::join('design_certificate_props', 'design_certificate_props.design_certificate_id', 'design_certificates.id')
            ->where('design_certificates.school_id', auth()->user()->school_id)
            ->select('certificate_to')
            ->groupBy('certificate_to')->get();


        return view('admins.design_certificates.print_certificate', compact('students', 'teachers', 'classes','data', 'card_template'));
    }


    public function printCertificate(Request $request)
    {
        $students = Admission::
        join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('school_id', auth()->user()->school_id)->where('acceptance', 'accept')->get();


        $classes = Classes::where('school_id', auth()->user()->school_id)->where('status', 'on')->get();


        // $classes1 = DB::table('design_certificate_prop1s')->get();
        // dd($classes1);

        if ($request->class_code != '' && $request->student_id == '') {
            
            $show_certificate = DB::table('design_certificates')
            ->join('design_certificate_props', 'design_certificate_props.design_certificate_id', 'design_certificates.id')
            ->join('design_certificate_prop1s', 'design_certificate_prop1s.design_certificate_id', 'design_certificates.id')
            ->join('institute', 'institute.school_id', 'design_certificates.school_id')
            ->join('admissions', 'admissions.school_id', 'design_certificates.school_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->where('admissions.acceptance',  'accept')
            ->where('classes.class_code', $request->class_code )
            ->where('design_certificates.school_id', auth()->user()->school_id)
            ->select('institute.name',
            'design_certificate_props.certificate_title_text',
            'design_certificate_props.certificate_information_text',
            'design_certificate_props.certificate_certify_title_text',

            'design_certificate_prop1s.certificate_signature_img_1_url',
            'design_certificate_prop1s.certificate_signature_img_2_url',
            'design_certificate_prop1s.certificate_signature_img_3_url',

            'design_certificate_prop1s.certificate_issue_date_value',

            'design_certificate_prop1s.signature_person1_text',
            'design_certificate_prop1s.signature_person2_text',
            'design_certificate_prop1s.signature_person3_text',

            'design_certificate_prop1s.certificate_signature1',
            'design_certificate_prop1s.certificate_signature2',
            'design_certificate_prop1s.certificate_signature3',
             'institute.image as logo',
              'admissions.first_name',
              'admissions.last_name',
              'admissions.image')->
              groupBy('institute.name',
              'design_certificate_props.certificate_title_text',
              'design_certificate_props.certificate_information_text',
              'design_certificate_props.certificate_certify_title_text',
  
              'design_certificate_prop1s.certificate_signature_img_1_url',
              'design_certificate_prop1s.certificate_signature_img_2_url',
              'design_certificate_prop1s.certificate_signature_img_3_url',
  
              'design_certificate_prop1s.certificate_issue_date_value',

              'design_certificate_prop1s.signature_person1_text',
              'design_certificate_prop1s.signature_person2_text',
              'design_certificate_prop1s.signature_person3_text',
  
              'design_certificate_prop1s.certificate_signature1',
              'design_certificate_prop1s.certificate_signature2',
              'design_certificate_prop1s.certificate_signature3',

               'logo',
                'admissions.first_name',
                'admissions.last_name',
                'admissions.image')->get();


        }elseif ($request->class_code == '' && $request->student_id != '') {
            $show_certificate = DB::table('design_certificates')
            ->join('design_certificate_props', 'design_certificate_props.design_certificate_id', 'design_certificates.id')
            ->join('design_certificate_prop1s', 'design_certificate_prop1s.design_certificate_id', 'design_certificates.id')
            ->join('institute', 'institute.school_id', 'design_certificates.school_id')
            ->join('admissions', 'admissions.school_id', 'design_certificates.school_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->where('admissions.acceptance',  'accept')
            ->where('admissions.id', $request->student_id)
            ->where('design_certificates.school_id', auth()->user()->school_id)
            ->select('institute.name',
            'design_certificate_props.certificate_title_text',
            'design_certificate_props.certificate_information_text',
            'design_certificate_props.certificate_certify_title_text',

            'design_certificate_prop1s.certificate_signature_img_1_url',
            'design_certificate_prop1s.certificate_signature_img_2_url',
            'design_certificate_prop1s.certificate_signature_img_3_url',

            'design_certificate_prop1s.certificate_issue_date_value',

            'design_certificate_prop1s.signature_person1_text',
            'design_certificate_prop1s.signature_person2_text',
            'design_certificate_prop1s.signature_person3_text',

            'design_certificate_prop1s.certificate_signature1',
            'design_certificate_prop1s.certificate_signature2',
            'design_certificate_prop1s.certificate_signature3',
             'institute.image as logo',
              'admissions.first_name',
              'admissions.last_name',
              'admissions.image')->
              groupBy('institute.name',
              'design_certificate_props.certificate_title_text',
              'design_certificate_props.certificate_information_text',
              'design_certificate_props.certificate_certify_title_text',
  
              'design_certificate_prop1s.certificate_signature_img_1_url',
              'design_certificate_prop1s.certificate_signature_img_2_url',
              'design_certificate_prop1s.certificate_signature_img_3_url',
  
              'design_certificate_prop1s.certificate_issue_date_value',

              'design_certificate_prop1s.signature_person1_text',
              'design_certificate_prop1s.signature_person2_text',
              'design_certificate_prop1s.signature_person3_text',
  
              'design_certificate_prop1s.certificate_signature1',
              'design_certificate_prop1s.certificate_signature2',
              'design_certificate_prop1s.certificate_signature3',

               'logo',
                'admissions.first_name',
                'admissions.last_name',
                'admissions.image')->get();

           
            }elseif ($request->teacher_id != '' && $request->class_code == '' && $request->student_id == '') {

            $show_certificate = DB::table('teachers')
            // ->join('design_certificate_props', 'design_certificate_props.design_certificate_id', 'design_certificates.id')
            // ->join('design_certificate_prop1s', 'design_certificate_prop1s.design_certificate_id', 'design_certificates.id')
            // ->join('institute', 'institute.school_id', 'design_certificates.school_id')
            // ->join('admissions', 'admissions.school_id', 'design_certificates.school_id')
            // ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            // ->where('admissions.acceptance',  'accept')
            ->where('teachers.teacher_id', $request->teacher_id )
            ->where('school_id', auth()->user()->school_id)
            // ->select('institute.*', 'institute.image as logo', 'admissions.*',
            // 'design_certificates.*','design_certificate_props.*', 'design_certificate_prop1s.*')
            ->get();

            }

            $data = DB::table('rolls')->join('admissions', 'admissions.id', '=', 'rolls.student_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->join('batches', 'batches.id', '=', 'admissions.batch_id')
            ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
            ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
            ->select('classes.class_name','semesters.semester_name',
            'admissions.first_name', 'admissions.last_name','admissions.gender','institute.name',
            'institute.name','institute.email as school_email', 'institute.establish','institute.phoneNo','institute.address',
            'batches.batch as session', 'batches.id as seatNo',
            'institute.web as campus','admissions.father_name', 'admissions.mother_name','admissions.dob',
            'institute.image as logo','rolls.username as roll_no','admissions.email','admissions.address as student_address',
            'admissions.image','admissions.phone', 'admissions.id as student_id')
            ->where('admissions.school_id', auth()->user()->school_id)
            ->where('admissions.id', $request->student_id )
            ->first();


            $show_certificate1 = DB::table('design_certificates')
            ->join('design_certificate_props', 'design_certificate_props.design_certificate_id', 'design_certificates.id')
                                        ->join('design_certificate_prop1s', 'design_certificate_prop1s.design_certificate_id', 'design_certificates.id')
                                        ->join('institute', 'institute.school_id', 'design_certificates.school_id')
                                        ->join('admissions', 'admissions.school_id', 'design_certificates.school_id')
                                        // ->where('design_certificates.id',  $id)
                                        ->where('admissions.acceptance',  'accept')
                                        // ->where('admissions.id',  1)
                                        ->where('design_certificates.school_id', auth()->user()->school_id)
                                        ->select('institute.*', 'institute.image as logo', 'admissions.*',
                                        'design_certificates.*','design_certificate_props.*', 'design_certificate_prop1s.*')
                                        ->get();





            return view('admins.design_certificates.show',compact('show_certificate', 'show_certificate1'));

    }


    public function ListCertificate()
    {
        $list_certificate = DB::table('design_certificates')
        ->join('design_certificate_props', 'design_certificate_props.design_certificate_id', 'design_certificates.id')
                                    ->join('design_certificate_prop1s', 'design_certificate_prop1s.design_certificate_id', 'design_certificates.id')
                                    ->join('institute', 'institute.school_id', 'design_certificates.school_id')
                                    // ->join('admissions', 'admissions.school_id', 'design_certificates.school_id')
                                    // ->where('design_certificates.id',  $id)
                                    // ->where('admissions.acceptance',  'accept')
                                    // ->where('admissions.id',  1)
                                    ->where('design_certificates.school_id', auth()->user()->school_id)
                                    ->select('institute.*', 'institute.image as logo', 
                                    // 'admissions.*',
                                    'design_certificates.*','design_certificate_props.*', 'design_certificate_prop1s.*')
                                    ->get();

        return view('admins.design_certificates.list')->with('list_certificate', $list_certificate);
    }


  
    /**
     * Display the specified resource.
     *
     * @param  \App\DesignCertificates  $designCertificates
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($designCertificates);
    //    $certificate_design =  DesignCertificates::find($id);
    //    dd( $certificate_design);

    // $user = DB::table('users')
    //             ->latest()
    //             ->first();
    //             dd($user);


        $show_certificate1 = DB::table('design_certificates')
        ->join('design_certificate_props', 'design_certificate_props.design_certificate_id', 'design_certificates.id')
                                    ->join('design_certificate_prop1s', 'design_certificate_prop1s.design_certificate_id', 'design_certificates.id')
                                    ->join('institute', 'institute.school_id', 'design_certificates.school_id')
                                    ->join('admissions', 'admissions.school_id', 'design_certificates.school_id')
                                    ->where('design_certificates.id',  $id)
                                    ->where('admissions.acceptance',  'accept')
                                    ->where('admissions.id',  1)
                                    ->where('design_certificates.school_id', auth()->user()->school_id)
                                    ->select('institute.*', 'institute.image as logo', 'admissions.*',
                                    'design_certificates.*','design_certificate_props.*', 'design_certificate_prop1s.*')
                                    ->get();

                                    
            $show_certificate = DB::table('design_certificates')
            ->join('design_certificate_props', 'design_certificate_props.design_certificate_id', 'design_certificates.id')
                                        ->join('design_certificate_prop1s', 'design_certificate_prop1s.design_certificate_id', 'design_certificates.id')
                                        ->join('institute', 'institute.school_id', 'design_certificates.school_id')
                                        ->join('admissions', 'admissions.school_id', 'design_certificates.school_id')
                                        ->where('design_certificates.id',  $id)
                                        ->where('admissions.acceptance',  'accept')
                                        ->where('admissions.id',  1)
                                        ->where('design_certificates.school_id', auth()->user()->school_id)
                                        ->select('institute.*', 'institute.image as logo', 'admissions.*',
                                        'design_certificates.*','design_certificate_props.*', 'design_certificate_prop1s.*')
                                        ->get();
    

                                    // print_r($show_certificate);

//                                     echo '<pre>',print_r($show_certificate),'</pre>';
// die();
                                    
        return view('admins.design_certificates.show',compact('show_certificate1','show_certificate'));
    }

    public function SampleCertificate()
    {
        return view('admins.design_certificates.sample');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DesignCertificates  $designCertificates
     * @return \Illuminate\Http\Response
     */
    public function edit(DesignCertificates $designCertificates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DesignCertificates  $designCertificates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DesignCertificates $designCertificates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DesignCertificates  $designCertificates
     * @return \Illuminate\Http\Response
     */
    public function destroy(DesignCertificates $designCertificates)
    {
        //
    }
}