<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\Teacher;
use App\Models\Classes;
use DB;
use Flash;
use App\CertificateTemplates;

class IDCARDController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getStudentIDCard(Request $request)
    {
        $add_member = Classes::all();

        $students = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('school_id', auth()->user()->school_id)->where('acceptance', 'accept')->get();
        $classes = Classes::where('school_id', auth()->user()->school_id)->where('status', 'on')->get();


        if ($request->class_code != '' && $request->student_id == '') {
            $institute = DB::table('issue_book')->join('admissions', 'admissions.id', '=', 'issue_book.student_id')
            ->join('books', 'books.id', '=', 'issue_book.book_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->join('institute', 'institute.school_id', '=', 'issue_book.school_id')
            ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
            ->select('issue_book.id as issue_book_id', 'issue_book.due_return_date',
             'issue_book.return_date','issue_book.issue_date', 'classes.class_name',
            'admissions.first_name', 'admissions.last_name','admissions.gender','institute.image as logo',
            'books.book_title', 'books.book_number','rolls.username as roll_no','admissions.email',
            'admissions.image','admissions.phone', 'admissions.id as student_id')
            ->where('issue_book.school_id', auth()->user()->school_id)
            ->where('classes.class_code', $request->class_code )
            ->get();

        }elseif ($request->class_code == '' && $request->student_id != '') {
            $institute = DB::table('rolls')->join('admissions', 'admissions.id', '=', 'rolls.student_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
            ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
            ->select('classes.class_name','semesters.semester_name',
            'admissions.first_name', 'admissions.last_name','admissions.gender','admissions.*',
            'institute.image as logo','rolls.username as roll_no','admissions.email','institute.name',
            'admissions.image','admissions.phone', 'admissions.id as student_id')
            ->where('admissions.school_id', auth()->user()->school_id)
            // ->where('classes.class_code', $request->class_code )
            ->get();
        }else {
            $institute = DB::table('rolls')->join('admissions', 'admissions.id', '=', 'rolls.student_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
            ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
            ->select('classes.class_name','semesters.semester_name',
            'admissions.first_name', 'admissions.last_name','admissions.gender','admissions.*',
            'institute.image as logo','rolls.username as roll_no','admissions.email','institute.name',
            'admissions.image','admissions.phone', 'admissions.id as student_id')
            ->where('admissions.school_id', auth()->user()->school_id)
            // ->where('classes.class_code', $request->class_code )
            ->get();
        }

        $data = DB::table('rolls')->join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
        ->join('batches', 'batches.id', '=', 'admissions.batch_id')
        ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
        ->select('classes.class_name',
        'admissions.first_name', 'admissions.last_name','admissions.gender','institute.name',
        'institute.name','institute.email', 'institute.establish','institute.phoneNo','institute.address',
        'batches.batch as session', 'batches.id as seatNo',
        'institute.web as campus','admissions.father_name', 'admissions.mother_name','admissions.dob',
        'institute.image as logo','rolls.username as roll_no','admissions.email',
        'admissions.image','admissions.phone', 'admissions.id as student_id')
        ->where('admissions.school_id', auth()->user()->school_id)
        // ->where('admissions.id', $request->student_id )
        ->first();

        $card_template = CertificateTemplates::where('school_id', auth()->user()->school_id)->get();
       

       return view('admins.id_cards.index', compact('students',  'classes', 'data','card_template'))->with('add_member', $add_member)->with('institute', $institute);
    }

    public function saveStudentIDCard(Request $request )
    {
        dd($request->all());
        $check_exist = CertificateTemplates::where('card_title', $request->card_title)->where('school_id', $request->school_id)->count();

        if ($check_exist > 0) {

            Flash::error($request->card_title . 'is already Created for this school' . ' ' .  'please create another card.' );
            return redirect()->back();
        }

            $new_image_name_school_logo = '';
            $new_image_name_bg_img =  '';
            $new_image_name_signature =  '';
            $new_image_name_qrcode =  '';

            if ($request->hasFile('qrcode') || $request->hasFile('school_signature')) {

            $file_signature = $request->file('school_signature');
            $file_school_logo = $request->file('school_logo');
            $file_bg_img = $request->file('school_background_image');
            $file_qrcode = $request->file('qrcode');

            

            if ($file_signature != '') {
            $extension_signature = $file_signature->getClientOriginalExtension();
            // dd($file_signature);
            }
            if ($file_school_logo != '') {
                $extension_school_logo = $file_school_logo->getClientOriginalExtension();
            }
            if ($file_bg_img != '') {
                $extension_bg_img = $file_bg_img->getClientOriginalExtension();

            }if($file_qrcode != '') {
                $extension_qrcode = $file_qrcode->getClientOriginalExtension();
            // dd($file_qrcode);
               
            }
            // else {
            //     $extension_bg_img = '';
            //     $extension_signature = '';
            //     $extension_school_logo = '';
            //     $extension_qrcode = '';
            // }
          
           

            if ($file_signature != '') {
            $new_image_name_signature = rand(11111, 99999). '.' .$extension_signature;
            // dd($new_image_name_signature);
            }if ($file_school_logo != '') {
                $new_image_name_school_logo = rand(21111, 99999). '.' .$extension_school_logo;
            }
            if ($file_bg_img != '') {
            $new_image_name_bg_img = rand(31111, 99999). '.' .$extension_bg_img;

            }if ($file_qrcode != '') {
                $new_image_name_qrcode = rand(41111, 99999). '.' .$extension_qrcode;
                
            }

            if ($file_signature != '') {
                    $file_signature->move(public_path('certificate_template/school_images'), $new_image_name_signature);
                //    dd($new_image_name_signature);
                }if ($file_school_logo != '') {
                    $file_school_logo->move(public_path('certificate_template/school_images'), $new_image_name_school_logo);
                }
                if ($file_bg_img != '') {
                    $file_bg_img->move(public_path('certificate_template/school_images'), $new_image_name_bg_img);
                
                }if ($file_qrcode != '') {
                    $file_qrcode->move(public_path('certificate_template/school_images'), $new_image_name_qrcode);
                    // dd($new_image_name_qrcode);
                }
                // dd($new_image_name_signature, $new_image_name_qrcode);

        }else {
            
            $new_image_name_school_logo = '';
            $new_image_name_bg_img =  '';
            $new_image_name_signature =  '';
            $new_image_name_qrcode =  '';
              
        }
        $certificate = new CertificateTemplates;

        $certificate->card_title = $request->card_title;
        $certificate->qrcode = $new_image_name_qrcode;
        $certificate->school_logo = $new_image_name_school_logo;
        $certificate->school_signature = $new_image_name_signature;
        $certificate->school_background_image = $new_image_name_bg_img;

        if($request->card_title == 'student_id_card'){
            $certificate->card_holder = $request->card_holder;
            $certificate->roll_no = $request->roll_no;
            $certificate->student_name = $request->student_name;
            $certificate->student_image = $request->student_image;
            $certificate->class = $request->class;
            $certificate->grade = $request->grade;
            $certificate->father_name = $request->father_name;
            $certificate->mother_name = $request->mother_name;
            $certificate->address = $request->address;

        }elseif ($request->card_title == 'staff_id_card') {
            $certificate->staff_card_holder = $request->staff_card_holder;
            $certificate->staff_roll_no = $request->staff_roll_no;
            $certificate->staff_name = $request->staff_name;
            $certificate->staff_image = $request->staff_image;
            $certificate->staff_department = $request->staff_department;
            $certificate->staff_address = $request->staff_address;

        }elseif ($request->card_title == 'admit_card') {
            $certificate->admit_roll_no = $request->admit_roll_no;
            $certificate->admit_student_name = $request->admit_student_name;
            $certificate->admit_student_image = $request->admit_student_image;
            $certificate->admit_class = $request->admit_class;
            $certificate->admit_grade = $request->admit_grade;
            $certificate->admit_father_name = $request->admit_father_name;
            // $certificate->admit_mother_name = $request->admit_mother_name;
            $certificate->admit_address = $request->admit_address; 
        }
        elseif ($request->card_title == 'leaving_certificate') {
            $certificate->leaving_certificate_roll_no = $request->leaving_certificate_roll_no;
            $certificate->leaving_certificate_student_name = $request->leaving_certificate_student_name;
            $certificate->leaving_certificate_student_image = $request->leaving_certificate_student_image;
            $certificate->leaving_certificate_class = $request->leaving_certificate_class;
            $certificate->leaving_certificate_grade = $request->leaving_certificate_grade;
            $certificate->leaving_certificate_father_name = $request->leaving_certificate_father_name;
            $certificate->leaving_certificate_mother_name = $request->leaving_certificate_mother_name;
            $certificate->leaving_certificate_address = $request->leaving_certificate_address; 
        }
        
        
        $certificate->status = $request->status;
        $certificate->school_header_color = $request->school_header_color;
        $certificate->school_header_bgcolor = $request->school_header_bgcolor;
        $certificate->school_footer_color = $request->school_footer_color;
        $certificate->school_footer_bgcolor = $request->school_footer_bgcolor;
        $certificate->user_id = auth()->user()->id;
        $certificate->school_id = auth()->user()->school_id;

        $certificate->save();
        Flash::success('Certificate Template Created Successfully');
        return redirect()->back();
    // }
}

public function editStudentIDCard(CertificateTemplates $card, $card_id)
{
    $card_templateEdit = CertificateTemplates::find($card_id);
    // dd($card_templateEdit);

    $add_member = Classes::all();
    $data = DB::table('rolls')->join('admissions', 'admissions.id', '=', 'rolls.student_id')
    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    ->join('batches', 'batches.id', '=', 'admissions.batch_id')
    ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
    ->select('classes.class_name',
    'admissions.first_name', 'admissions.last_name','admissions.gender','institute.name',
    'institute.name','institute.email', 'institute.establish','institute.phoneNo','institute.address',
    'batches.batch as session', 'batches.id as seatNo',
    'institute.web as campus','admissions.father_name', 'admissions.mother_name','admissions.dob',
    'institute.image as logo','rolls.username as roll_no','admissions.email',
    'admissions.image','admissions.phone', 'admissions.id as student_id')
    ->where('admissions.school_id', auth()->user()->school_id)
    // ->where('admissions.id', $request->student_id )
    ->first();

    $institute = DB::table('rolls')->join('admissions', 'admissions.id', '=', 'rolls.student_id')
    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
    ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
    ->select('classes.class_name','semesters.semester_name',
    'admissions.first_name', 'admissions.last_name','admissions.gender','admissions.*',
    'institute.image as logo','rolls.username as roll_no','admissions.email','institute.name',
    'admissions.image','admissions.phone', 'admissions.id as student_id')
    ->where('admissions.school_id', auth()->user()->school_id)
    // ->where('classes.class_code', $request->class_code )
    ->get();

    $card_template = CertificateTemplates::where('school_id', auth()->user()->school_id)->get();
   
    return view('admins.id_cards.index', compact('data','card_template', 'card_templateEdit'))->with('add_member', $add_member)->with('institute', $institute);
}

public function updateStudentIDCard(Request $request, $card_id)
{
    dd($request->all());
            $imgs = CertificateTemplates::findOrfail($card_id);
            $file_signature = $request->file('school_signature');
            $file_school_logo = $request->file('school_logo');
            $file_bg_img = $request->file('school_background_image');
            $file_qrcode = $request->file('qrcode');
                    
        if ($imgs) {

           
            $new_image_name_signature =  $imgs->school_signature; 
            $new_image_name_school_logo = $imgs->school_logo;
            $new_image_name_bg_img = $imgs->school_background_image;
            $new_image_name_qrcode = $imgs->qrcode;


            
                // dd($new_image_name_signature, $new_image_name_qrcode);

        }elseif($request->hasFile('qrcode') || $request->hasFile('school_signature')) {
            if ($file_signature != '') {
                $extension_signature = $file_signature->getClientOriginalExtension();
                // dd($file_signature);
                }
                if ($file_school_logo != '') {
                    $extension_school_logo = $file_school_logo->getClientOriginalExtension();
    
                    // dd($file_school_logo);
                }
                if ($file_bg_img != '') {
                    $extension_bg_img = $file_bg_img->getClientOriginalExtension();
    
                }if($file_qrcode != '') {
                    $extension_qrcode = $file_qrcode->getClientOriginalExtension();
                // dd($file_qrcode);
                   
                }
              
                if ($file_signature != '') {
                $new_image_name_signature = rand(11111, 99999). '.' .$extension_signature;
                // dd($new_image_name_signature);
                }if ($file_school_logo != '') {
                    $new_image_name_school_logo = rand(21111, 99999). '.' .$extension_school_logo;
                }
                if ($file_bg_img != '') {
                $new_image_name_bg_img = rand(31111, 99999). '.' .$extension_bg_img;
    
                }if ($file_qrcode != '') {
                    $new_image_name_qrcode = rand(41111, 99999). '.' .$extension_qrcode;
                    
                }
    
                if ($file_signature != '') {
                        $file_signature->move(public_path('certificate_template/school_images'), $new_image_name_signature);
                    //    dd($new_image_name_signature);
                    }if ($file_school_logo != '') {
                        $file_school_logo->move(public_path('certificate_template/school_images'), $new_image_name_school_logo);
                    }
                    if ($file_bg_img != '') {
                        $file_bg_img->move(public_path('certificate_template/school_images'), $new_image_name_bg_img);
                    
                    }if ($file_qrcode != '') {
                        $file_qrcode->move(public_path('certificate_template/school_images'), $new_image_name_qrcode);
                        // dd($new_image_name_qrcode);
                    }
              
        }
        $certificate = array(
 
        'card_title' => $request->card_title,
        'qrcode' => $new_image_name_qrcode,
        'school_logo' => $new_image_name_school_logo,
        'school_signature' => $new_image_name_signature,
        'school_background_image' => $new_image_name_bg_img,

        // if($request->card_title == 'student_id_card'){
            'card_holder' => $request->card_holder,
            'roll_no' => $request->roll_no,
            'student_name' => $request->student_name,
            // 'student_image' => $request->student_image,
            'class' => $request->class,
            'grade' => $request->grade,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,

        // }elseif ($request->card_title == 'staff_id_card') {
            'staff_card_holder' => $request->staff_card_holder,
            'staff_roll_no' => $request->staff_roll_no,
            'staff_name' => $request->staff_name,
            'staff_image' => $request->staff_image,
            'staff_department' => $request->staff_department,
            'staff_address' => $request->staff_address,

        // }elseif ($request->card_title == 'admit_card') {
            'admit_roll_no' => $request->admit_roll_no,
            'admit_student_name' => $request->admit_student_name,
            'admit_student_image' => $request->admit_student_image,
            'admit_class' => $request->admit_class,
            'admit_grade' => $request->admit_grade,
            'admit_father_name' => $request->admit_father_name,
            'admit_address' => $request->admit_address, 
        // }
        // elseif ($request->card_title == 'leaving_certificate') {
            'leaving_certificate_roll_no' => $request->leaving_certificate_roll_no,
            'leaving_certificate_student_name '=> $request->leaving_certificate_student_name,
            'leaving_certificate_student_image' => $request->leaving_certificate_student_image,
            'leaving_certificate_class' => $request->leaving_certificate_class,
            'leaving_certificate_grade' => $request->leaving_certificate_grade,
            'leaving_certificate_father_name' => $request->leaving_certificate_father_name,
            'leaving_certificate_mother_name' => $request->leaving_certificate_mother_name,
            'leaving_certificate_address' => $request->leaving_certificate_address, 
        // }
        
        
        'status' => $request->status,
        'school_header_color' => $request->school_header_color,
        'school_header_bgcolor' => $request->school_header_bgcolor,
        'school_footer_color' => $request->school_footer_color,
        'school_footer_bgcolor' => $request->school_footer_bgcolor,
        'user_id '=> auth()->user()->id,
        'school_id '=> auth()->user()->school_id,
    );
        CertificateTemplates::findOrfail($card_id)->update($certificate);
      
        Flash::success('Certificate Template Updated Successfully');
        return redirect()->back();
}

    public function printIDCARD(Request $request)
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


        $card_template = CertificateTemplates::where('school_id', auth()->user()->school_id)->get();
        $id_cards = CertificateTemplates::where('school_id', auth()->user()->school_id)
        ->where('card_title',$request->card_title)->get();

        $admit_cards = CertificateTemplates::where('school_id', auth()->user()->school_id)
        ->where('card_title',$request->card_title)->first();
        
        // dd($institute);

        return view('admins.id_cards.generate_options', compact('students', 'classes','data','card_template', 'id_cards', 'admit_cards'))->with('institute', $institute);

    }

    public function genarateIDCARD()
    {

        $students = Admission::
        join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('school_id', auth()->user()->school_id)->where('acceptance', 'accept')->get();

        $teachers = Teacher::
        join('departments', 'departments.department_id', '=', 'teachers.department_id')
        ->join('faculties', 'faculties.faculty_id', '=', 'teachers.faculty_id')
        ->join('semesters', 'semesters.id', '=', 'teachers.semester_id')
        ->where('teachers.school_id', auth()->user()->school_id)->get();


        $classes = Classes::where('school_id', auth()->user()->school_id)->where('status', 'on')->get();

        $card_template = CertificateTemplates::where('school_id', auth()->user()->school_id)->get();

        return view('admins.id_cards.generate_id_card', compact('students', 'teachers','classes', 'card_template'));

    }
}
