<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institute;
use App\Models\Teacher;
use App\SchoolBanner;
use App\School_Event;
use App\ContactUs;
use Flash;
use App\GPA;
use Session;
use App\Roll;
use App\StudentUploadHomeWork;
use App\Marks;
use App\Student;
use App\MeritList;
use Carbon\Carbon;
use App\NoticeBoard;
use App\Models\Course;
use App\Models\Admission;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Semester;
use App\Models\Batch;
use App\Models\Level;
use App\Models\Classes;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\DB;
use App\MediaManager; 
use App\SchoolNews;

class WebsiteController extends Controller
{
    
    public function Website($website)
    {
        $institute =  Institute::where('web', $website)
                      ->join('schools', 'schools.id', '=', 'institute.school_id')->get();
        
        if (auth()->user()) 
        {
            $school_banner =    SchoolBanner::where('school_id', auth()->user()->school_id)
            ->select('school_banners.name as banner_name', 'school_banners.banner_image')->get();

            $school_event = School_Event::join('institute', 'institute.school_id', '=', 'school_events.school_id')
            ->select('school_events.name as event_name', 'school_events.image', 'institute.name')
            ->where('school_id', auth()->user()->school_id)->where('status', 1)->get();
        }else {
            $school_banner = SchoolBanner::join('institute', 'institute.school_id', '=', 'school_banners.school_id')
                ->select('school_banners.name as banner_name', 'school_banners.banner_image', 'institute.name')
                ->where('web', $website)->where('status', 1)->get();

                $school_event = School_Event::join('institute', 'institute.school_id', '=', 'school_events.school_id')
                ->select('school_events.name as event_name', 'school_events.image', 'institute.name')
                ->where('web', $website)->where('status', 1)->get();
        }

        // dd( $school_banner );
       return view('school.website.website')->with('institute',$institute)->with('school_banner',  $school_banner)->with('school_event', $school_event);
    }

    public function SchoolEvent(Request $request)
    {

        return view('school.website.website');
    }

    public function SchoolWebsite()
    {
        $institute =  Institute::where('school_id', auth()->user()->school_id)
                                ->join('schools', 'schools.id', '=', 'institute.school_id')->get();

        $school_banner =    SchoolBanner::where('school_id', auth()->user()->school_id)->get();

        $school_event = School_Event::join('institute', 'institute.school_id', '=', 'school_events.school_id')
                ->select('school_events.name as event_name', 'school_events.image', 'institute.name', 'school_events.id as event_id', 'school_events.place', 'school_events.body', 'school_events.start_date', 'school_events.end_date')
                ->where('school_events.school_id', auth()->user()->school_id)->where('status', 1)->where('featured', 0)->get();

                $school_event_featured = School_Event::join('institute', 'institute.school_id', '=', 'school_events.school_id')
                ->select('school_events.name as event_name', 'school_events.image', 'institute.name','school_events.start_date', 'school_events.end_date' , 'school_events.id as event_id', 'school_events.place', 'school_events.body')
                ->where('school_events.school_id', auth()->user()->school_id)->where('status', 1)->where('featured', 1)->get();
    
        // dd( $school_event );
       return view('school.website.website')->with('institute',$institute)->with('school_banner',  $school_banner)->with('school_event', $school_event)->with('school_event_featured', $school_event_featured);
    }
    

    public function OurTeachers(Request $request, $website)
    {
        $institute =  Institute::where('web', $website)
                                ->join('schools', 'schools.id', '=', 'institute.school_id')->get();
    $our_teacher = Teacher::all();

        if (auth()->user()) 
        {
           $teachers = Teacher::where('school_id', auth()->user()->school_id)->get();
         }else {
                $teachers = Teacher::join('institute', 'institute.school_id', '=', 'teachers.school_id')
                ->select('teachers.*')
                ->where('web', $website)->get();
         }
       

        return view('school.website.about-us', compact('our_teacher'))->with('teachers', $teachers);
    }

    public function Gallary(Request $request, $website)
    {
        $institute =  Institute::where('web', $website)
                                ->join('schools', 'schools.id', '=', 'institute.school_id')->get();
    // $school_gallary = MediaManager::all();

        if (auth()->user()) 
        {
           $school_gallary = MediaManager::where('school_id', auth()->user()->school_id)->get();
         }else {
                $school_gallary = MediaManager::join('institute', 'institute.school_id', '=', 'media_managers.school_id')
                ->select('media_managers.*')
                ->where('web', $website)->get();
         }
       

        return view('school.website.gallary.gallary')->with('school_gallary', $school_gallary);
    }

    public function Event(Request $request, $website)
    {
        $institute =  Institute::where('web', $website)
                                ->join('schools', 'schools.id', '=', 'institute.school_id')->get();
    // $school_event = SchoolEvent::all();

    // dd( $institute);

        if (auth()->user()) 
        {
           $school_event = School_Event::where('school_id', auth()->user()->school_id)->get();
         }else {
                $school_event = School_Event::join('institute', 'institute.school_id', '=', 'school_events.school_id')
                ->select('school_events.*')
                ->where('web', $website)->get();
         }
       

        return view('school.website.event.event')->with('school_event', $school_event);
    }

    public function News(Request $request, $website)
    {
        $institute =  Institute::where('web', $website)
                                ->join('schools', 'schools.id', '=', 'institute.school_id')->get();
    // $school_event = SchoolEvent::all();

        if (auth()->user()) 
        {
           $school_news = SchoolNews::where('school_id', auth()->user()->school_id)->get();
         }else {
                $school_news = SchoolNews::join('institute', 'institute.school_id', '=', 'school_events.school_id')
                ->select('school_events.*')
                ->where('web', $website)->get();
         }
       

        return view('admins.news.index', compact('our_teacher'))->with('school_news', $school_news);
    }
    
    
    
    public function OurSchool(Request $request)
    {
        return view('school.website.our-school');
    }

    public function OnlineAdminssion(Request $request, $website)
    {

        $studentCount =Roll::where(['username' => Session::get('studentSession')])->count();

        $student_id = Admission::join('institute', 'institute.school_id', '=', 'admissions.school_id')->where('institute.web', $website)->max('admissions.id'); // this roll id will be auto genarated username and password for each stuent okay
        $roll_id = Roll::max('roll_id'); // this roll id will be auto genarated username and password for each stuent okay
        $faculties = Faculty::join('institute', 'institute.school_id', '=', 'faculties.school_id')->where('institute.web', $website)->get(); // we fetch all faculty
        $departments = Department::join('institute', 'institute.school_id', '=', 'departments.school_id')->where('institute.web', $website)->get(); // we fetch all departments
        $batches = Batch::join('institute', 'institute.school_id', '=', 'batches.school_id')->where('is_current_batch', 1)->where('institute.web', $website)->select('batches.batch', 'batches.name as session', 'batches.id as batch_id', 'institute.name','institute.web')->get(); // we fetch all departments
        $levels = Level::join('institute', 'institute.school_id', '=', 'levels.school_id')->where('institute.web', $website)->get(); // we fetch all departments
        $classes = Classes::join('institute', 'institute.school_id', '=', 'classes.school_id')->where('institute.web', $website)->get(); // we fetch all classes
        $Semester = Semester::join('institute', 'institute.school_id', '=', 'semesters.school_id')->where('status', "on")->where('institute.web', $website)->get(); // we fetch all Semester
            // dd( $levels);
        $enable_grade = Semester::join('institute', 'institute.school_id', '=', 'semesters.school_id')->where('status', "on")->where('institute.web', $website)->get();

        $admissions = Admission::join('faculties','faculties.faculty_id', 'admissions.faculty_id')
                ->join('departments','departments.department_id', 'admissions.department_id')
                ->join('schools','schools.id', 'admissions.school_id')
                ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
                ->where('institute.web', $website)->paginate(10);
                // dd( $admissions);
                $admission = Admission::join('faculties','faculties.faculty_id', 'admissions.faculty_id')
                ->join('departments','departments.department_id', 'admissions.department_id')
                ->join('batches','batches.id', 'admissions.batch_id')
                ->join('schools','schools.id', 'admissions.school_id')
                ->join('institute', 'institute.school_id', '=', 'admissions.school_id')
                ->select('admissions.*','departments.*')
                ->select('admissions.batch_id', 'batches.id', DB::raw('COUNT(*) as count'))
                ->groupBy('admissions.batch_id','batches.id')
                ->where('institute.web', $website)->paginate(10);

                $contact_us = Institute::where('web', $website)
                ->join('schools', 'schools.id', '=', 'institute.school_id')->get();

                $school_id = $request->school_id;
                
                if(count($admissions)!=0){
                    $rand_username_password = mt_rand($school_id. 111609300011 .$student_id +1, $school_id. 111609300011 .$student_id +1);
                    }elseif(count($admissions)==0){
                        $rand_username_password = mt_rand($school_id. 1116093000111 .$student_id , $school_id. 1116093000111 .$student_id );
                    }

 
     return view('school.website.online-admissions', compact('contact_us','admissions','levels', 'admission','Semester','classes','student_id','faculties','departments','batches',
     'roll_id','rand_username_password'));
    }

    public function postOnlineAdmission(Request $request)
    {
        $input = $request->all();
        dd($input);
    //    but we will use the simples way of this now let's remove this
        if ($request->file('image') == '') {

         $file = $request->file('image');
        //  $extension = $file->getClientOriginalExtension();
        //  $new_image_name = time(). '.' .$extension;
        //  $file->move(public_path('student_images'), $new_image_name);

        }else {
           
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $new_image_name = time(). '.' .$extension;
            $file->move(public_path('student_images'), $new_image_name);
        //  now is the part to store our informayion isde the database okay.

        $student = new Admission;
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->father_name = $request->father_name;
            $student->father_phone = $request->father_phone;
            $student->mother_name = $request->mother_name;
            $student->gender = $request->gender;
            $student->phone = $request->phone;
            $student->dob = $request->dob;
            $student->email = $request->email;
            $student->status = $request->status;
            $student->nationality = $request->nationality;
            $student->passport = $request->passport;
            $student->address = $request->address;
            $student->current_address = $request->current_address;
            $student->department_id = $request->department_id;
            $student->faculty_id = $request->faculty_id;
            $student->semester_id = $request->semester_id;
            $student->degree_id = $request->degree_id;
            $student->class_code = $request->class_id;
            $student->school_id = $request->school_id;
            $student->dateregistered = date('Y-m-d');
            $student->batch_id = $request->batch_id;
            $student->acceptance = 'accept';
            $student->user_id = Auth::id(); // is the user who has the role to create students okay.
            if ( $file) {
                $student->image = $new_image_name;
            }else {
                $student->image = '';
            }
            
            // dd($student);
        // so here we will add condition okay to check if insert to proceed to next level okay.
       if($student->save()){
            $student_id =$student->id;
            $username = 'username';
            $password = 'password';

            Roll::insert(['student_id' => $student_id, 'username'=>
             $request->username,'password'=> $request->password, 'semester_id'=> $request->semester_id]);

            PromoteStudent::insert(['student_id' => $student_id,'grade_id' => $request->semester_id,
            'class_code'=> $request->class_id, 'school_id'=> $request->school_id, 'status' =>'current']);

            //  dump($request->all()); die;

            // NewStatus::insert(['student_id' => $student_id, 'semester_id' => $request->semester_id]);

            // return redirect()->route('showStudentRoll', ['student_id' => $student_id]);
            // return redirect()->route('view_student_timetable', ['student_id' => $student_id]);

       }
    }
}

    public function AboutUs(Request $request, $website)
    {
        $about_us = Teacher::all();
        $our_teacher = Teacher::all();
        if (auth()->user()) 
        {
           $teachers = Teacher::where('school_id', auth()->user()->school_id)->get();
         }else {
                $teachers = Teacher::join('institute', 'institute.school_id', '=', 'teachers.school_id')
                ->select('teachers.*', 'institute.name')
                ->where('web', $website)->get();
         }
       
        return view('school.website.about-us', compact('about_us', 'our_teacher'))->with('teachers', $teachers);
    }

    public function Register(Request $request)
    {
        return view('school.website.register');
    }

    public function Login(Request $request)
    {
        return view('school.website.login');
    }

    public function ContactUs(Request $request, $website)
    {
                $contact_us = Institute::where('web', $website)
                ->join('schools', 'schools.id', '=', 'institute.school_id')->get();

        return view('school.website.contact-us')->with('contact_us', $contact_us);
    }

    public function postSchoolContactUs(Request $request)
    {   
        // dd($request->all());

           $contact_us = new ContactUs;
            $contact_us->first_name = $request->fname;
            $contact_us->last_name = $request->lname;
            $contact_us->phone = $request->phone;
            $contact_us->email = $request->email;
            $contact_us->message = $request->message;
            $contact_us->school_id = $request->school_id;

            $contact_us->save();
            Flash::success('Email has successfully send!' .',' . ' we will get back to you in a few days!');
        return redirect()->back();
    }

    public function postSchoolBanner(Request $request)
    {

        return view('school.website.login');
    }

    public function dynamicSubject(Request $request){
 
        if ($request->ajax()) {
            return response(Course::where('class', $request->class_id)->get());
        }

}

        public function PrimaryLevel(Request $request){
            $input = $request->all();
           
        if ($request->ajax()) {
            return response(Level::where('grade_id', $request->grade_id)->get());
        }
    }

    public function dynamicStudentGroup(Request $request){
        $input = $request->all();
        // dd($input); die;
    if ($request->ajax()) {
        return response(Department::where('faculty_id', $request->faculty_id)->get());
    }
}

public function dynamicDepartmentClass(Request $request){
    $input = $request->all();
    // dd($input); die;
if ($request->ajax()) {
    return response(Classes::where('department_id', $request->department_id)->get());
}
}


}
