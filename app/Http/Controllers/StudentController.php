<?php

namespace App\Http\Controllers;

use Mail;
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
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\PromoteStudent;
use App\Institute;

class StudentController extends Controller
{
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    //    return $student = $request->all();

        $studentCount =Roll::where(['username' => Session::get('studentSession')])->count();
            // dd($studentCount); die;

            $students = Roll::onlineStudent();
            
        // if($studentCount > 0){
        //     Session::put('studentSession', $student['username']);
        // }

       $school = Institute::where('web', '!=', '')->count();
       $schoolOwner = Institute::first();

      if ($school > 0) {
        return redirect(route('website', $schoolOwner->web))->with('flash_message_success', 'Logged out successfully.');
      }  
      return view('welcome', compact('studentCount'));
        // but let's make one function inside the roll model okay
        // we will make the to chek if the current is online okay.
    }
    public function studentBiodata(Request $request)
    {
        $students = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
        ->join('classes','classes.class_code','=', 'admissions.class_code')
        ->join('semesters','semesters.id','=', 'admissions.semester_id')
        ->join('levels','levels.id','=', 'admissions.degree_id')
        ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
        ->join('departments','departments.department_id','=', 'admissions.department_id')
        ->join('batches','batches.id','=', 'admissions.batch_id')

        ->where(['username' => Session::get('studentSession')])->first();
        // here we will make join okay to access all the two tables which have the student info okay.
        $studentClass = Admission::where('class_code', $request['class_code'])->first();

        // $teachertimetables =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
        $teachertimetables =  Roll::join('admissions','admissions.id','=', 'rolls.student_id')
        ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
        ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
        ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
        ->join('days', 'days.day_id','=', 'class_schedule.day_id')
        ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
        ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
        ->join('courses', 'courses.id','=', 'class_schedule.course_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
        ->join('times', 'times.time_id','=', 'class_schedule.time_id')
        ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
        ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
        ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
        ->select('admissions.class_code','class_schedule.class_id','semesters.id as semester_id',
                'semesters.semester_name','days.name','times.time','courses.course_name','teachers.first_name'
                ,'teachers.last_name','class_rooms.classroom_name','classes.class_name')
        ->where(['username' => Session::get('studentSession')])
        ->orderBy('teachers.teacher_id', 'ASC')
        ->get();

        // dd(  $teachertimetables); die;
        $class_name = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
        // ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                     ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
                     ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                     ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                     ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                     ->where(['username' => Session::get('studentSession')])
                     ->first();
        // dd(  $class_name); die;

        $enable_grade = Semester::where('status', "on")->get();
        $class_grade = Roll::where(['username' => Session::get('studentSession')])->GET();

        return view('students.lectures.biodata',compact('class_name','enable_grade','class_grade'))->with('students', $students)
        ->with('teachertimetables', $teachertimetables);
 // we will make this file okay.
    }


    public function studentTimetable(){

        $teachertimetables =  Roll::join('admissions','admissions.id','=', 'rolls.student_id')
        ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
        ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
        ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
        ->join('days', 'days.day_id','=', 'class_schedule.day_id')
        ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
        ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
        ->join('courses', 'courses.id','=', 'class_schedule.course_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
        ->join('times', 'times.time_id','=', 'class_schedule.time_id')
        ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
        ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
        ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
        ->select('admissions.class_code','class_schedule.class_id','semesters.id as semester_id',
                'semesters.semester_name','days.name','times.time','courses.course_name','teachers.first_name'
                ,'teachers.last_name','class_rooms.classroom_name','classes.class_name')
        ->where(['username' => Session::get('studentSession')])
        ->orderBy('teachers.teacher_id', 'ASC')
        ->get();

        // dd(  $teachertimetables); die;
        $class_name = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
        // ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                     ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
                     ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                     ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                     ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                     ->where(['username' => Session::get('studentSession')])
                     ->first();

        $enable_grade = Semester::where('status', "on")->get();
        $class_grade = Roll::where(['username' => Session::get('studentSession')])->GET();


        return view('students.timetable.studenttimetable',compact('class_name','enable_grade','class_grade'))->with('teachertimetables', $teachertimetables);
    }


    public function studentTransaction(){

        $studenttransaction = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
                    //  ->join('semesters', 'semesters.id','=', 'rolls.semester_id')
                     ->join('transactions', 'transactions.student_id','=', 'admissions.id')
                     ->join('semesters', 'semesters.id','=', 'transactions.semester_fee_id')
                     ->join('users', 'users.id','=', 'transactions.user_id')
                     ->join('student_fees', 'student_fees.student_id', '=', 'transactions.student_id')
                     ->join('fee_structures', 'fee_structures.id','=', 'transactions.semester_fee_id')
                     ->join('invoice_details', 'invoice_details.student_id','=', 'admissions.id')
                     ->select('transactions.transaction_date','transactions.paid_amount','transactions.remark','transactions.description'
                            ,'transactions.balance','users.name', 'transactions.semester_fee_id', 'invoice_details.invoice_id')
                    ->groupBy('transactions.transaction_date','transactions.paid_amount','transactions.remark','transactions.description'
                    ,'transactions.balance','users.name', 'transactions.semester_fee_id', 'invoice_details.invoice_id')
                     ->where(['username' => Session::get('studentSession')])
                     ->get();

                     $class_name = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
                    //  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                  ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
                                  ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                  ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                  ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                  ->where(['username' => Session::get('studentSession')])
                                  ->first();

                    $student_promote = DB::table('promote_students')->join('admissions','admissions.id','=', 'promote_students.student_id')
                                                                    ->join('rolls','rolls.student_id','=', 'promote_students.student_id')
                                                                    ->where(['username' => Session::get('studentSession')])
                                                                    ->where(['promote_students.school_id' =>  $class_name->school_id])
                                                                    ->where('grade_id',  $class_name->semester_id)->get();

        // dd($student_promote ); die;

       $student_grades = Semester::where('school_id',  $class_name->school_id)->get();

        $enable_grade = Semester::where('status', "on")->get();
        $class_grade = Roll::where(['username' => Session::get('studentSession')])->get();

        return view('students.transactions.transaction',compact('studenttransaction', 'student_grades', 'student_promote','class_name','enable_grade','class_grade'));
   }

   public function GetStudentExamMarks(Request $request)
	{

			$studentmarks=	DB::table('rolls')
			// ->join('rolls', 'rolls.roll_id', '=', 'marks.roll')
            ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
            ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
            ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
			->join('batches', 'batches.id', '=', 'admissions.batch_id')
            ->join('marks', 'marks.roll_no', '=', 'rolls.username')
            ->join('exam', 'exam.id', '=', 'marks.exam')
            ->join('courses', 'courses.course_code', '=', 'marks.subject')
			->select('marks.id','marks.roll_no','rolls.username', 'admissions.first_name',
			'admissions.last_name', 'marks.written','marks.mcq','courses.course_name','exam.type','exam.session',
			'marks.practical','marks.ca','marks.total','marks.grade','marks.point','teachers.first_name','teachers.last_name',
			'marks.Absent','batches.batch')
            ->where('admissions.status', '=', '1')
            ->where(['username' => Session::get('studentSession')])
            ->get();
			// ->where('admissions.class','=',$request->get('class'))
			// ->where('marks.class','=',$request->get('class'))
			// ->where('marks.department','=',$request->get('department'))
		    //      //->Where('Marks.shift','=',$request->get('shift'))
			// ->where('marks.session','=',trim($request->get('batch')))
			// ->where('marks.subject','=',$request->get('subject'))
			// ->where('marks.exam','=',$request->get('exam'))
			// ->get();

            // dd($studentmarks); die;

            $class_name = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
            // ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                         ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
                         ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                         ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                         ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                         ->where(['username' => Session::get('studentSession')])
                         ->first();

            $enable_grade = Semester::where('status', "on")->get();
            $class_grade = Roll::where(['username' => Session::get('studentSession')])->GET();

			return View('students.examMarks.exam-makrs',compact('class_name','studentmarks','enable_grade','class_grade'));
    }

    public  function  GetStudentExamResult(Request $request )
	{
     
            $isGenerated=DB::table('meritlist')
            ->join('exam', 'exam.id', '=', 'meritlist.exam')
            ->join('batches', 'batches.id', '=', 'meritlist.batch')
            ->select('roll_no','exam.type','batches.batch', 'class', 'exam', 'meritlist.id as result_id')
			->where(['roll_no' => Session::get('studentSession')])
            ->get();

            $studentmarks=	DB::table('rolls')
			// ->join('rolls', 'rolls.roll_id', '=', 'marks.roll')
            ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
            ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
             ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
			->join('batches', 'batches.id', '=', 'admissions.batch_id')
            ->join('marks', 'marks.roll_no', '=', 'rolls.username')
            ->join('exam', 'exam.id', '=', 'marks.exam')
            ->join('courses', 'courses.course_code', '=', 'marks.subject')
			->select('marks.id','marks.roll_no','rolls.username', 'admissions.first_name',
			'admissions.last_name', 'marks.written','marks.mcq','courses.course_name','exam.type','exam.session',
			'marks.practical','marks.ca','marks.total','marks.grade','marks.point','teachers.first_name','teachers.last_name',
			'marks.Absent','batches.batch','class_schedule.class_id')
            ->where('admissions.status', '=', '1')
            ->where(['username' => Session::get('studentSession')])
            ->get();

            // dd($studentmarks);

            $class_name = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
            // ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                         ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
                         ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                         ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                         ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                         ->where(['username' => Session::get('studentSession')])
                         ->first();
            
            $enable_grade = Semester::where('status', "on")->get();
            $class_grade = Roll::where(['username' => Session::get('studentSession')])->GET();
            // dd($class_grade);
            return view('students.results.result', compact('isGenerated','class_name','studentmarks','enable_grade','class_grade')); 
            // return view('students.examMarks.semester-result', compact('isGenerated','class_name')); 
	}
    

    public function GetStudentTranscript()
    {

        $studenttranscript=	DB::table('rolls')
        // ->join('rolls', 'rolls.roll_id', '=', 'marks.roll')
        ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
         ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
        ->join('batches', 'batches.id', '=', 'admissions.batch_id')
        ->join('marks', 'marks.roll_no', '=', 'rolls.username')
        ->join('exam', 'exam.id', '=', 'marks.exam')
        ->join('courses', 'courses.course_code', '=', 'marks.subject')
        ->select('marks.id','marks.roll_no','rolls.username', 'admissions.first_name','courses.course_code',
        'admissions.last_name', 'marks.written','marks.mcq','courses.course_name','exam.type','exam.session',
        'marks.practical','marks.ca','marks.total','marks.grade','marks.point','teachers.first_name','teachers.last_name',
        'marks.Absent','batches.batch','admissions.semester_id')
        ->where('admissions.status', '=', '1')
        ->where(['username' => Session::get('studentSession')])
        ->get();

        $studentinfo=	DB::table('rolls')
        // ->join('rolls', 'rolls.roll_id', '=', 'marks.roll')
        ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
         ->join('departments', 'departments.department_id','=', 'admissions.department_id')
         ->join('faculties', 'faculties.faculty_id','=', 'admissions.faculty_id')
        ->join('levels', 'levels.id', '=', 'admissions.degree_id')
        ->join('marks', 'marks.roll_no', '=', 'rolls.username')
        ->join('exam', 'exam.id', '=', 'marks.exam')
        ->join('courses', 'courses.course_code', '=', 'marks.subject')
        ->select('marks.id','marks.roll_no','rolls.username', 'admissions.first_name','courses.course_code',
        'admissions.last_name', 'admissions.dob','departments.department_name','levels.level',
        'faculties.faculty_name','courses.course_name','exam.type','exam.session',
        'marks.practical','marks.ca','marks.total','marks.grade','marks.point',
        'marks.Absent','admissions.image')
        ->where('admissions.status', '=', '1')
        ->where(['username' => Session::get('studentSession')])
        ->first();


        return view('students.transcript.transcript', compact('studenttranscript','studentinfo'));
    }

    public function GetStudentHomeWork(Request $request)
    {
        $students = Roll::onlineStudent();
        // dd(Session::get('studentSession'));
        $class_assign = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
        ->join('homeworks', 'homeworks.semester_id','=', 'rolls.semester_id')
        ->join('semesters', 'semesters.id','=', 'homeworks.semester_id')
        ->join('courses', 'courses.id','=', 'homeworks.subject_id')
        ->select('semesters.id as semester_id','semesters.*','courses.id as subject_id',
        'courses.*','homeworks.*','homeworks.id as homework_id','rolls.student_id')
        ->where('username', Session::get('studentSession'))
        ->where('homeworks.class_code', $students->class_code)
        ->where('homeworks.status', 1)
        ->get();

        $uploaded_homework = StudentUploadHomeWork::where('student_id', $students->id)->get();
        $uploaded_homework1 = StudentUploadHomeWork::where('student_id', $students->id)->get();
        // dd( $uploaded_homework);
        return view('students.lectures.homework', compact('class_assign','uploaded_homework','uploaded_homework1'));
    }

    public function UploadStudentHomeWork(Request $request)
    {
        $input = $request->all();
        // dd($input = $request->all());
        $image =  $request->file('homework_file'); // this request is requesting image file okay.

        $image_name = rand(1111,9999) . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('student_homeworks'), $image_name);

        $homework =  new StudentUploadHomeWork;
        // $homework->body = $request->body;
        $homework->file = $image_name;
        $homework->class_code = $request->class_code;
        $homework->subject_id = $request->subject_id;
        $homework->semester_id = $request->grade;
        $homework->student_id = $request->student_id;
        $homework->status = $request->status;
        $homework->teacher_id = $request->teacher_id;
        $homework->homework_id = $request->homework_id;
        $homework->school_id = $request->school_id;

        $homework->save();

        Flash::success($request->class_code. '  Homework Submitted Successfully!.');
        return redirect()->back();
    }

    

     public function studentChooseCourse(Request $request)
    {
        # code...

        return view('students.lectures.choose-course');
    }

    public function studentLectureCalendar(Request $request)
    {
        # code...

        return view('students.lectures.calendar'); // we will make this file okay.
    }

    public function studentLogin(Request $request){

         $school = Institute::where('web', '!=', '')->count();
       $schoolOwner = Institute::first();

      if ($school > 0) {
        return redirect(route('school.login', $schoolOwner->web))->with('flash_message_success', 'Logged out successfully.');
      } 
        return view('students.login');
    }


    
    public function parentLogin(Request $request){

        return view('students.parent.login');
    }



    public function LoginStudent(Request $request){

        if($request->isMethod('post')){

            $student = $request->all();
            $studentCount = Roll::where(['username'=> $student['username'],
            'password'=> $student['password']])->count(); // to check if the student is match okay
           
            $studentaccess = Roll::join('admissions', 'admissions.id', '=','rolls.student_id' )
                                        ->where('admissions.status', 1)
                                        // ->where('rolls.username', Session::get('studentSession'))
                                        ->count();
            //  return $studentaccess;
// dd( $studentaccess);
            if ($studentaccess) {

            if($studentCount){
                Session::put('studentSession', $student['username']);

                Flash::success('Welcome ' .$student['username']);

                // THE CODE FOR ONLINE USER START HERE

               $ipaddress =  $request->ip(); // THIS WILL GET THE IP OD THE CLIENT OKAY
               $isonline =  Roll::where('username', Session::get('studentSession'))
               ->update(['isonline'=>1, 'login_time' => Carbon::now(), // CURRENT TIME
               'ip_address' =>  $ipaddress]);

             // WHEN THE STUDENT IS LOGGGIN IN OKAY

             // ENDS HERE

                // dd($isonline);die;
                return redirect('/account'); // so let's createe this account
            }
            else
            {
                

                Flash::error('Your Username or Password is Incorrect!');

                return redirect()->back(); // login page okay
            }
    }
        else 
    {
            Flash::error('Your Account is not yet verify yet! Please contact the Administration!');

            return redirect('/student');
        }

    }
}

    // public function LoginParent(Request $request){

    //     if($request->isMethod('post')){

    //         $parent = $request->all();
    //         $parentCount = DB::table('parents')->where(['username'=> $parent['username'],
    //         'password'=> $parent['password']])->count(); // to check if the student is match okay

    //         if($parentCount > 0){
    //             Session::put('studentSession', $parent['username']);

    //             Flash::success('Welcome ' .$parent['username']);

    //             // THE CODE FOR ONLINE USER START HERE

    //            $ipaddress =  $request->ip(); // THIS WILL GET THE IP OD THE CLIENT OKAY
    //            $isonline =  Roll::where('username', Session::get('studentSession'))
    //            ->update(['isonline'=>1, 'login_time' => Carbon::now(), // CURRENT TIME
    //            'ip_address' =>  $ipaddress]);

    //          // WHEN THE STUDENT IS LOGGGIN IN OKAY

    //          // ENDS HERE

    //             // dd($isonline);die;
    //             return redirect('/account'); // so let's createe this account
    //         }else{
                

    //             Flash::error('Your Username or Password is Incorrect!');

    //             return redirect('/student'); // login page okay
    //         }

    //     }
    // }


    public function verifyPassword ( Request $request){

        $students = $request->all();
            // here we will write some codes okay for verifying the code okay
            $validStudent = Roll::where(['username'=> Session::get('studentSession'), 'password' =>$students['old_password']])->count();

            if($validStudent == 1){
                // Flash::success('Your Username is correct');
                echo "true"; die;
            }else{
                // Flash::error('Your Username is not correct');
                echo "false"; die;
            }
    }

    public function changePassword(Request $request)
    {
            $student = $request->all();
            $students = Admission::where('email', $student['email'])->first();
            // dd($students); die;

            $studentCount = Roll::where(['username' => Session::get('studentSession'),
             'password'=>$student['old_password']])->count();

            //  we will use condition here okay
            if( $studentCount == 1){

                $new_password = $student['new_password']; // this is the new password that will be save okay.

                Roll::where('username', Session::get('studentSession'))
                ->update(['password'=>$new_password]);

                    // here we can seend email okay but that will be in the next video
                    // where we will set the email configuration okay.
                    Flash::success('You have Successfully changed your password!');
                    return redirect()->back();

            }else{
                Flash::error('Password Faild to Update!');
                return redirect()->back();
                // send invalid message or email not found okay..
            }

            // so now let's try and see okay..

    }

    // here is the part where we will get the form of the forgot password okay.
     public function getForgotPassword($website){

        return view('students.forget-password');
     }

    //  this part is part were we will write code to send an email to the user okay.
     public function ForgotPassword(Request $request){
        if($request->isMethod('post')){

        $data = $request->all();
        // dd($data); die;

        // $studentCount = Admission::where('email', $data['email'])->count();
        $studentCount = Roll::where('username', $data['username'])->count();
        // we will count if the email is correct or not okay

        // // dd($student_id); die;
        if($studentCount == 0){
            // if the email is not valid okay we will show this message
            Flash::error('We cant find a student with this roll no. ' .$data['username']);
            return redirect()->back();
        }

        $students = Admission::join('rolls','rolls.student_id', '=','admissions.id')->where('username', $data['username'])->first();

// dd($students); die;
        $ran_password = Str::random(12); // email it will send something like this............ XALK23YT548HH to  your email
        // this ran_password will be the random password that we will generate for the user to input and update his/ her
        // password after reset it via email okay
        $new_password =  $ran_password;

        // dd($student_id); die;
       $roll = Roll::where('username',  $data['username'])->update(['password'=> $new_password]);
        // dd($students); die;
        $email =  $students->email; 
        $student_name =  $students->first_name;
        $message = [
            'email'=> $email,
            'first_name'=>$student_name,
            'password'=> $ran_password

            // we can pass this veriables inside our blade okay.
        ];

        // here we will send the email to  the student to upddate his/ her password okay.

        Mail::send('emails.forgot-password', $message,function($message)use($email){
            $message->to($email)->subject('Reset Password - Academic Information System');
        });

        Flash::success('We e-mail your password Reset Link to ' .$students->email);
        return redirect()->back();

        // now let's see what we will have okay.
        // return view('students.login');

     }
     return view('students.login');
    }

    public function NoticeBoard(Request $request)
    {
        // dd($request->all());

        return view('notification.student_noticeboard');
    }

    public function SaveNoticeBoard(Request $request)
    {
        $input = $request->all();

        $notice = new NoticeBoard;

        $notice->type = $request->type;
        $notice->body = $request->body;
        $notice->status = $request->status;
        $notice->start_date = $request->start_date;
        $notice->end_date = $request->end_date;

        $notice->save();
        return redirect()->back();
    }




    public function account(Request $request){
        // inside here we can make something here okay
        if(Session::has('studentSession')){
            $student = Admission::all();



         $noticeMessage = DB::table('notice')->where('status', 1)->first();
            // dd($noticeMessage);
        }
            else{
                return redirect('/student')->with('error', 'please login to access');
            }
        return view('students.account', compact('student','noticeMessage'));
    }


    public function Student_is_Online(){

        return view('admins.online-student');
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
    public function StudentTakeAdmission(Request $request)
    {
        $input = $request->all();
            // dd( $input);
        if ($request->ajax()) {
           
        $isonline =  Roll::where('username', Session::get('studentSession'));
        $existStudent = Admission::where('email',$request->email)->count();

        if ($existStudent > 0) {

            Flash::error('Student Already Exist');
            return redirect(url('/'));
        }

    //    but we will use the simples way of this now let's remove this
         $file = $request->file('image');
         if ($file){
            $extension = $file->getClientOriginalExtension();
            $new_image_name = time(). '.' .$extension;
            $file->move(public_path('student_images'), $new_image_name);
         }else 
         {

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
            $student->dateregistered = date('Y-m-d');
            $student->batch_id = $request->batch_id;
            $student->school_id = $request->school_id;
            if ($request->user_id == '') {
                $student->user_id = 0;
            }else {
                $student->user_id = Auth::id();
            }
             // is the user who has the role to create students okay.
            if ($file) {
                $student->image = $new_image_name;
            }
            

        // so here we will add condition okay to check if insert to proceed to next level okay.
            if($student->save()){
                $student_id =$student->id;
                $email =$student->email;
                $student_name =  $student->first_name;
                $username = 'username';
                $password = 'password';

            Roll::insert(['student_id' => $student_id, 'username'=>
             $request->username,'password'=> $request->password, 'semester_id'=> $request->semester_id]);

            PromoteStudent::insert(['student_id' => $student_id,'grade_id' => $request->semester_id,
            'class_code'=> $request->class_id, 'status' =>'current', 'school_id' => $request->school_id ]);


            $message = [
                'email'=> $email,
                'first_name'=>$student_name,
                'username'=>  $request->username,
                'password'=> $request->password
    
                // we can pass this veriables inside our blade okay.
            ];


            // Mail::send('emails.registration-message', $message,function($message)use($email){
            //     $message->to($email)->subject('Registration Message - Academic Information System');
            // });

            //  dump($request->all()); die;

            // NewStatus::insert(['student_id' => $student_id, 'semester_id' => $request->semester_id]);

            // return redirect()->route('showStudentRoll', ['student_id' => $student_id]);
            // return redirect()->route('view_student_timetable', ['student_id' => $student_id]);

       }
    }

    }
       
        // Flash::success('Admission ' .$request->first_name. ' ' .$request->last_name. ' Submited successfully.'.' We’ve sent you an email with your login credentials  to ' .$request->email);
        // return response($student);
        return response()->json(['message' => 'Admission ' .$request->first_name. ' ' .$request->last_name. ' Submited successfully.'.' We’ve sent you an email with your login credentials  to ' .$request->email]);
        // return view('students.confirm-registration');
    }

            function check(Request $request)
            {
            if($request->get('email'))
            {
            $email = $request->get('email');
            $data = DB::table("admissions")
            ->where('email', $email)
            ->count();
            if($data > 0)
            {
            echo 'not_unique';
            }
            else
            {
            echo 'unique';
            }
            }
            }


    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Request $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $student)
    {
        //
    }

    public function studentLogout(Request $request, $website){


        //  THE LOGOUT OFFLINE CODE START HERE OKAY
        // dd($request->all());

        $ipaddress = $request->ip();

        $isonline =  Roll::where('username', Session::get('studentSession'))
        ->update(['isonline'=>0, 'logout_time' => Carbon::now(), // CURRENT TIME
        'ip_address' =>  $ipaddress]); // CLIENT IP ADDRESS

        // ENDS HERE OKAY

        $url = request()->segment(3);

        // $url = action('UserController@profile', ['id' => 1]);

        //  dd($url);
         

        return redirect(route('website', $url))->with('flash_message_success', 'Logged out successfully.');
        session::flush();
    }

    public function language($locale){
		//here we will write code
        session()->put('locale', $locale);

        // that's all we need here okay.
	return redirect()->back();
    }


    public function getForMarks($class,$department,$batch)
{
    $students= Roll::join('admissions','admissions.id','=','rolls.student_id')
                         ->select('first_name','last_name','rolls.username as studentRollss')
                         ->where('acceptance','=','accept')
                         ->where('class_code','=',$class)
                         ->where('department_id','=',$department)
                        //  ->where('shift','=',$shift)
                         ->where('batch_id','=',$batch)->get();
	return $students;
}

public function getForMarksjoin($class,$department,$batch)
{
    $students= Roll::join('admissions','admissions.id','=','rolls.student_id')
                        ->select('first_name','last_name','rolls.username as studentRollss')
                        ->where('acceptance','=','accept')
                        ->where('class_code','=',$class)
                        ->where('department_id','=',$department)
                    //  ->where('shift','=',$shift)
                        ->where('batch_id','=',$batch)
                        ->get();
                        // dd($students); die;
    return $students;
}

public function StudentAdmission(Request $request)
{

    $studentCount =Roll::where(['username' => Session::get('studentSession')])->count();

       // we fetch all admission as well.
       $student_id = Admission::max('id'); // this roll id will be auto genarated username and password for each stuent okay
       $roll_id = Roll::max('roll_id'); // this roll id will be auto genarated username and password for each stuent okay
       $faculties = Faculty::all(); // we fetch all faculty
       $departments = Department::all(); // we fetch all departments
       $batches = Batch::all(); // we fetch all departments
       $levels = Level::all(); // we fetch all departments
       $classes = Classes::all(); // we fetch all classes
       $Semester = Semester::where('status', "on")->get(); // we fetch all Semester

       $enable_grade = Semester::where('status', "on")->get();

    $admissions = Admission::join('faculties','faculties.faculty_id', 'admissions.faculty_id')
    ->join('departments','departments.department_id', 'admissions.department_id')
    ->join('batches','batches.id', 'admissions.batch_id')
    ->select('admissions.*','departments.*')
    ->select('admissions.batch_id', 'batches.id', DB::raw('COUNT(*) as count'))
    ->groupBy('admissions.batch_id','batches.id')
    ->paginate(10);
    if(count($admissions)!=0){
        $rand_username_password = mt_rand(111609300011 .$student_id +1, 111609300011 .$student_id +1);
       }elseif(count($admissions)==0){
           $rand_username_password = mt_rand(1116093000111 .$student_id , 1116093000111 .$student_id );
       }

    return view('students.take_admission', compact('admissions','levels', 'admission','Semester','classes','student_id','faculties','departments','batches',
    'roll_id','rand_username_password'));

    return view('school.website.online-admissions', compact('admissions','levels', 'admission','Semester','classes','student_id','faculties','departments','batches',
    'roll_id','rand_username_password'));
}

}
