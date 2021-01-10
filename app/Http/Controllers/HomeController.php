<?php

namespace App\Http\Controllers;

use DB;
use Flash;
use Image;
use App\User;
use App\School;
use App\Message;
use App\ContactUs;
use App\Institute;
use Carbon\Carbon;
use App\Models\Day;
use App\SchoolNews;
use App\StudentFee;
use App\Models\Time;
use App\MediaManager;
use App\Models\Batch;
use App\Models\Level;
use App\Models\Shift;
use App\School_Event;
use App\SchoolBanner;
use App\VideoManager;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Faculty;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\Admission;
use App\Models\ClassRoom;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Transaction;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Models\ClassAssigning;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class HomeController extends Controller
{
    // public function construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $batchCount = Batch::where('school_id', auth()->user()->school_id)->count(); 
        $batchCount = Batch::where('school_id', auth()->user()->school_id)->count();  // this function ccount count the batch from the batch table but we are using modal okay.
        $studentsCount = Admission::where('school_id', auth()->user()->school_id)->count(); 
        $classCount = Classes::where('school_id', auth()->user()->school_id)->count(); 
        $courseCount = Course::where('school_id', auth()->user()->school_id)->count(); 
        $dayCount = Day::where('school_id', auth()->user()->school_id)->count(); 
        $levelCount = Level::where('school_id', auth()->user()->school_id)->count(); 
        $semesterCount =  Semester::where('school_id', auth()->user()->school_id)->count(); 
        $shiftCount = Shift::where('school_id', auth()->user()->school_id)->count(); 
        $feeCount = StudentFee::count(); 
        $timeCount = Time::where('school_id', auth()->user()->school_id)->count(); 
        $classroomCount = ClassRoom::where('school_id', auth()->user()->school_id)->count(); 
        $teachersCount = Teacher::where('school_id', auth()->user()->school_id)->count(); 
        // $classasignCount = ClassAssigning::where('school_id', auth()->user()->school_id)->count(); 
        $classschedulCount = ClassSchedule::where('school_id', auth()->user()->school_id)->count(); 
        $facultyCount = Faculty::where('school_id', auth()->user()->school_id)->count(); 
        $departmentCount = Department::where('school_id', auth()->user()->school_id)->count(); 
        $feeStructureCount = FeeStructure::where('school_id', auth()->user()->school_id)->count(); 
        $transactionsCount = Transaction::where('school_id', auth()->user()->school_id)->count(); 

        if (auth()->user()->group == 'Admin' || auth()->user()->group == 'Owner') {
            # code...
        $transactions = Transaction::join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.semester_fee_id')
                                    ->get();
        $student_fees = StudentFee::join('transactions', 'transactions.semester_fee_id','=','student_fees.student_fee_id')->get();


        // TEACHERS DASHBORAD  SETTINGS

        $id = Auth::user()->teacher_id;

        $students_in_charge_total = ClassSchedule::join('admissions', 'admissions.class_code', '=', 'class_schedule.course_id')
        ->join('batches', 'batches.id','=', 'class_schedule.batch_id')->count();

                    $teachertimetables =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                    ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                    ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                    ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                    ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                    ->join('degrees', 'degrees.degree_id','=', 'class_schedule.degree_id')
                    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                    ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                    ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                    ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                    ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                    ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')

                    ->where('class_schedule.teacher_id', $id)
                    ->orderBy('teachers.teacher_id', 'ASC')
                    ->get();

                    $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                 ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                 ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                 ->where('class_schedule.teacher_id', $id)
                                 ->first();


                                 $current_month_attendance_present = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->where('attendance_status', 'present')->where('school_id', auth()->user()->school_id)->count();
                                 $current_month_attendance_absent = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->where('attendance_status', 'absent')->where('school_id', auth()->user()->school_id)->count();
                                 $current_month_attendance_late = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->where('attendance_status', 'late')->where('school_id', auth()->user()->school_id)->count();
                                 $current_month_attendance_sick = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->where('attendance_status', 'sick')->where('school_id', auth()->user()->school_id)->count();

                                //last month atten
                                 $last_month_attendance_present = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('attendance_status', 'present')->where('school_id', auth()->user()->school_id)->count();
                                 $last_month_attendance_absent = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('attendance_status', 'absent')->where('school_id', auth()->user()->school_id)->count();
                                 $last_month_attendance_late = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('attendance_status', 'late')->where('school_id', auth()->user()->school_id)->count();
                                 $last_month_attendance_sick = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('attendance_status', 'sick')->where('school_id', auth()->user()->school_id)->count();

                                 $month_before_last_attendance_present = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('attendance_status', 'present')->where('school_id', auth()->user()->school_id)->count();
                                 $month_before_last_attendance_absent = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('attendance_status', 'absent')->where('school_id', auth()->user()->school_id)->count();
                                 $month_before_last_attendance_late = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('attendance_status', 'late')->where('school_id', auth()->user()->school_id)->count();
                                 $month_before_last_attendance_sick = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('attendance_status', 'sick')->where('school_id', auth()->user()->school_id)->count();

                                 $month_before2_last_attendance_present = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('attendance_status', 'present')->where('school_id', auth()->user()->school_id)->count();
                                 $month_before2_last_attendance_absent = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('attendance_status', 'absent')->where('school_id', auth()->user()->school_id)->count();
                                 $month_before2_last_attendance_late = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('attendance_status', 'late')->where('school_id', auth()->user()->school_id)->count();
                                 $month_before2_last_attendance_sick = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('attendance_status', 'sick')->where('school_id', auth()->user()->school_id)->count();

       
                                 
                                 $last_month_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('school_id', auth()->user()->school_id)->count();
                                 $month_before_last_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('school_id', auth()->user()->school_id)->count();
                                 $month_before2_last_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('school_id', auth()->user()->school_id)->count();

                                //  dd($month_before2_last_attendance_sick);

                                // ONLINE ADMISSIONS
                                    $online_admission = Admission::select(DB::raw('online_admission as Total_register_online'))->where('online_admission' , 1)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->count();
                                    // dd($online_admission );
                                // OFFLINE ADMISSIONS
                                    $offline_admission = Admission::select('online_admission as Total_register_offline', 'batch_id as session', 'created_at as joined_date')->where('online_admission' , 0)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->count();
                                    // dd($offline_admission );

                                    $repeated_students = DB::table('marks')
                                    ->join('courses', 'courses.course_code', '=', 'marks.subject')
                                    ->join('batches', 'batches.id', '=', 'marks.session')
                                    ->join('exam', 'exam.id', '=', 'marks.exam')
                                    ->join('classes', 'classes.class_code', '=', 'marks.class')
                                    ->join('rolls', 'rolls.username', '=', 'marks.roll_no')
                                    ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
                                    ->join('semesters', 'semesters.id', '=', 'rolls.semester_id')
                                    ->where('grade', 'F')->where('marks.school_id', auth()->user()->school_id)
                                    ->select('courses.course_name as subject_name', 'courses.course_code as subject_code', 'exam.type',
                                    'batches.batch','classes.class_name','classes.class_code','rolls.username as roll_no','semesters.semester_name as grade_name',
                                    'admissions.first_name', 'admissions.last_name', 'marks.grade', 'marks.id as mark_id')
                                    ->get()->toArray();

                                    $current_session_repeated_students = DB::table('marks')->where('grade', 'F')
                                    ->whereYear('created_at', Carbon::now()->year)
                                    ->where('marks.school_id', auth()->user()->school_id)
                                    ->count();

                                    
                                    $last_session_repeated_students = DB::table('marks')->where('grade', 'F')
                                    ->whereYear('created_at', Carbon::now()->subYear(1))
                                    ->where('marks.school_id', auth()->user()->school_id)
                                    ->count();

                                    $year_before_last_session_repeated_students = DB::table('marks')->where('grade', 'F')
                                    ->whereYear('created_at', Carbon::now()->subYear(2))
                                    ->where('marks.school_id', auth()->user()->school_id)
                                    ->count();
               
                                        // dd( $current_session_repeated_students,$last_session_repeated_students,  $year_before_last_session_repeated_students);
                                        $data['year_list'] = $this->fetch_year();

                                       $studentAdmission = Admission::join('countries', 'countries.id', '=', 'admissions.nationality')->select('countries.name as country', DB::raw('count(admissions.nationality) as count'))
                                       ->groupBy('country')->get();

                                            $top_staff = Teacher::where('school_id', auth()->user()->school_id)->get();

                                    
                                
                      }elseif (auth()->user()->group == "Teacher") {
                                              # code...
                                        $transactions = Transaction::join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.semester_fee_id')
                                                ->get();
                                        $student_fees = StudentFee::join('transactions', 'transactions.semester_fee_id','=','student_fees.student_fee_id')->get();


                                        // TEACHERS DASHBORAD  SETTINGS

                                        $id = Auth::user()->teacher_id;

                                        $students_in_charge_total = ClassSchedule::join('admissions', 'admissions.class_code', '=', 'class_schedule.course_id')
                                        ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                                        ->where('admissions.school_id', auth()->user()->school_id)
                                        ->where('class_schedule.teacher_id', $id)->count();
                                            
                                        $teachertimetables =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                                        ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                                        ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                                        ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                                        ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                        ->join('degrees', 'degrees.degree_id','=', 'class_schedule.degree_id')
                                        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                        ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                                        ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                                        ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                                        ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                                        ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                                        ->where('class_schedule.school_id', auth()->user()->school_id)
                                        ->where('class_schedule.teacher_id', $id)
                                        ->orderBy('teachers.teacher_id', 'ASC')
                                        ->get();

                                        $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                            ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                            ->where('class_schedule.teacher_id', $id)
                                            ->first();


                                            $current_month_attendance_present = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->where('attendance_status', 'present')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $current_month_attendance_absent = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->where('attendance_status', 'absent')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $current_month_attendance_late = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->where('attendance_status', 'late')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $current_month_attendance_sick = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->where('attendance_status', 'sick')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();

                                            //last month atten
                                            $last_month_attendance_present = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('attendance_status', 'present')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $last_month_attendance_absent = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('attendance_status', 'absent')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $last_month_attendance_late = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('attendance_status', 'late')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $last_month_attendance_sick = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('attendance_status', 'sick')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();

                                            $month_before_last_attendance_present = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('attendance_status', 'present')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $month_before_last_attendance_absent = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('attendance_status', 'absent')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $month_before_last_attendance_late = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('attendance_status', 'late')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $month_before_last_attendance_sick = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('attendance_status', 'sick')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();

                                            $month_before2_last_attendance_present = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('attendance_status', 'present')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $month_before2_last_attendance_absent = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('attendance_status', 'absent')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $month_before2_last_attendance_late = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('attendance_status', 'late')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();
                                            $month_before2_last_attendance_sick = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('attendance_status', 'sick')->where('school_id', auth()->user()->school_id)->where('teacher_id',$id )->count();


                                            
                                            $last_month_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->where('school_id', auth()->user()->school_id)
                                            ->where('teacher_id',$id )->count();
                                            $month_before_last_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->where('school_id', auth()->user()->school_id)
                                            ->where('teacher_id',$id )->count();
                                            $month_before2_last_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(3))->where('school_id', auth()->user()->school_id)
                                            ->where('teacher_id',$id )->count();

                                            //  dd($month_before2_last_attendance_sick);

                                            // ONLINE ADMISSIONS
                                                $online_admission = Admission::select(DB::raw('online_admission as Total_register_online'))->where('online_admission' , 1)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->count();
                                                // dd($online_admission );
                                            // OFFLINE ADMISSIONS
                                                $offline_admission = Admission::select('online_admission as Total_register_offline', 'batch_id as session', 'created_at as joined_date')->where('online_admission' , 0)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->count();
                                                // dd($offline_admission );

                                                $repeated_students = DB::table('marks')
                                                ->join('courses', 'courses.course_code', '=', 'marks.subject')
                                                ->join('batches', 'batches.id', '=', 'marks.session')
                                                ->join('exam', 'exam.id', '=', 'marks.exam')
                                                ->join('classes', 'classes.class_code', '=', 'marks.class')
                                                ->join('rolls', 'rolls.username', '=', 'marks.roll_no')
                                                ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
                                                ->join('semesters', 'semesters.id', '=', 'rolls.semester_id')
                                                ->where('grade', 'F')->where('marks.school_id', auth()->user()->school_id)
                                                ->select('courses.course_name as subject_name', 'courses.course_code as subject_code', 'exam.type',
                                                'batches.batch','classes.class_name','classes.class_code','rolls.username as roll_no','semesters.semester_name as grade_name',
                                                'admissions.first_name', 'admissions.last_name', 'marks.grade', 'marks.id as mark_id')
                                                ->get()->toArray();

                                                $current_session_repeated_students = DB::table('marks')->where('grade', 'F')
                                                ->whereYear('created_at', Carbon::now()->year)
                                                ->where('marks.school_id', auth()->user()->school_id)
                                                ->count();

                                                
                                                $last_session_repeated_students = DB::table('marks')->where('grade', 'F')
                                                ->whereYear('created_at', Carbon::now()->subYear(1))
                                                ->where('marks.school_id', auth()->user()->school_id)
                                                ->count();

                                                $year_before_last_session_repeated_students = DB::table('marks')->where('grade', 'F')
                                                ->whereYear('created_at', Carbon::now()->subYear(2))
                                                ->where('marks.school_id', auth()->user()->school_id)
                                                ->count();

                                                    // dd( $current_session_repeated_students,$last_session_repeated_students,  $year_before_last_session_repeated_students);
                                                    $data['year_list'] = $this->fetch_year();

                                                $studentAdmission = Admission::join('countries', 'countries.id', '=', 'admissions.nationality')->select('countries.name as country', DB::raw('count(admissions.nationality) as count'))
                                                ->groupBy('country')->get();

                                                $top_staff = Teacher::where('school_id', auth()->user()->school_id)->get();

                                                $current_session_puplished_result_count = DB::table('meritlist')
                                                ->join('classes', 'classes.class_code', '=', 'meritlist.class')
                                                ->join('batches', 'batches.id', '=', 'meritlist.batch')
                                                ->join('exam', 'exam.id', '=', 'meritlist.exam')->where('batches.is_current_batch', 1)
                                                ->where('meritlist.school_id', auth()->user()->school_id)->count();
                                            
                                        }else {
                                           
                                            return view('school.home.staff');
                                        }

     
                                if (auth()->user()->group == 'Admin') {
                                    
                                        $schoolsCount = School::count();
                                        $activeschools = School::join('institute', 'institute.school_id', 'schools.id')->where('is_active', 1)
                                                         ->select('institute.*', 'schools.id as school_id', 'schools.*')->get();
                                        $inactiveschools = School::join('institute', 'institute.school_id', 'schools.id')->where('is_active', 0)
                                                                    ->select('institute.*', 'schools.id as school_id', 'schools.*')->get();

                                        $StaffusersCount = User::where('school_id', 0)->count();

                                        return view('admin_home', compact('batchCount','transactionsCount','transactions','student_fees',
                                'schoolsCount','inactiveschools','activeschools','StaffusersCount','feeCount',
                                'levelCount','semesterCount','shiftCount','timeCount','feeStructureCount',
                                'classroomCount','teachersCount','classschedulCount',
                                'class_name','students_in_charge_total',
                                // 'current_session_puplished_result_count',
                                'last_month_attendance','month_before_last_attendance','month_before2_last_attendance',
                                'current_month_attendance_present','current_month_attendance_absent',
                                'current_month_attendance_late','current_month_attendance_sick',

                                'last_month_attendance_present','last_month_attendance_absent','last_month_attendance_late','last_month_attendance_sick',
                                'month_before_last_attendance_present','month_before_last_attendance_absent','month_before_last_attendance_late','month_before_last_attendance_sick',
                                'month_before2_last_attendance_present','month_before2_last_attendance_absent','month_before2_last_attendance_late','month_before2_last_attendance_sick',

                                'online_admission','offline_admission',
                                
                                'repeated_students','current_session_repeated_students',
                                'last_session_repeated_students', 'year_before_last_session_repeated_students','top_staff',

                                'facultyCount','departmentCount'))
                                ->with('teachertimetables', $teachertimetables)
                                ->with($data)->with('studentAdmission', $studentAdmission);
                            }
                            return view('home', compact('batchCount','transactionsCount','transactions','student_fees',
                            'studentsCount','classCount','courseCount','dayCount','feeCount',
                            'levelCount','semesterCount','shiftCount','timeCount','feeStructureCount',
                            'classroomCount','teachersCount','classschedulCount',
                            'class_name','students_in_charge_total',
                            // 'current_session_puplished_result_count',
                            'last_month_attendance','month_before_last_attendance','month_before2_last_attendance',
                            'current_month_attendance_present','current_month_attendance_absent',
                            'current_month_attendance_late','current_month_attendance_sick',

                            'last_month_attendance_present','last_month_attendance_absent','last_month_attendance_late','last_month_attendance_sick',
                            'month_before_last_attendance_present','month_before_last_attendance_absent','month_before_last_attendance_late','month_before_last_attendance_sick',
                            'month_before2_last_attendance_present','month_before2_last_attendance_absent','month_before2_last_attendance_late','month_before2_last_attendance_sick',

                            'online_admission','offline_admission',
                            
                            'repeated_students','current_session_repeated_students',
                            'last_session_repeated_students', 'year_before_last_session_repeated_students','top_staff',

                            'facultyCount','departmentCount'))
                            ->with('teachertimetables', $teachertimetables)
                            ->with($data)->with('studentAdmission', $studentAdmission);
        // $batchCount = Batch::where('school_id', auth()->user()->school_id)->count(); 
        // dd( $batchCount);
        // return view('home', compact('batchCount'));
    }


    public function Dashboard(Request $request)
    {
        $batchCount = Batch::where('school_id', auth()->user()->school_id)->count();  // this function ccount count the batch from the batch table but we are using modal okay.
        $studentsCount = Admission::where('school_id', auth()->user()->school_id)->count();  
        $classCount = Classes::where('school_id', auth()->user()->school_id)->count(); 
        $courseCount = Course::where('school_id', auth()->user()->school_id)->count(); 
        $dayCount = Day::where('school_id', auth()->user()->school_id)->count(); 
        $levelCount = Level::where('school_id', auth()->user()->school_id)->count(); 
        $semesterCount =  Semester::where('school_id', auth()->user()->school_id)->count(); 
        $shiftCount = Shift::where('school_id', auth()->user()->school_id)->count(); 
        $feeCount = StudentFee::count(); 
        $timeCount = Time::where('school_id', auth()->user()->school_id)->count(); 
        $classroomCount = ClassRoom::where('school_id', auth()->user()->school_id)->count(); 
        $teachersCount = Teacher::where('school_id', auth()->user()->school_id)->count(); 
        // $classasignCount = ClassAssigning::where('school_id', auth()->user()->school_id)->count(); 
        $classschedulCount = ClassSchedule::where('school_id', auth()->user()->school_id)->count(); 
        $facultyCount = Faculty::where('school_id', auth()->user()->school_id)->count(); 
        $departmentCount = Department::where('school_id', auth()->user()->school_id)->count(); 
        $feeStructureCount = FeeStructure::where('school_id', auth()->user()->school_id)->count(); 
        $transactionsCount = Transaction::where('school_id', auth()->user()->school_id)->count(); 


        $transactions = Transaction::join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.semester_fee_id')
                                    ->where('school_id', auth()->user()->school_id)->get();
        $student_fees = StudentFee::join('transactions', 'transactions.semester_fee_id','=','student_fees.student_fee_id')
                                    ->where('school_id', auth()->user()->school_id)->get();

            // ONLINE ADMISSIONS
            $online_admission = Admission::select(DB::raw('online_admission as Total_register_online'))->where('online_admission' , 1)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->count();
            // dd($online_admission );
        // OFFLINE ADMISSIONS
            $offline_admission = Admission::select('online_admission as Total_register_offline', 'batch_id as session', 'created_at as joined_date')->where('online_admission' , 0)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->count();
            // dd($offline_admission );

            $repeated_students = DB::table('marks')
            ->join('courses', 'courses.course_code', '=', 'marks.subject')
            ->join('batches', 'batches.id', '=', 'marks.session')
            ->join('exam', 'exam.id', '=', 'marks.exam')
            ->join('classes', 'classes.class_code', '=', 'marks.class')
            ->join('rolls', 'rolls.username', '=', 'marks.roll_no')
            ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
            ->join('semesters', 'semesters.id', '=', 'rolls.semester_id')
            ->where('grade', 'F')->where('marks.school_id', auth()->user()->school_id)
            ->select('courses.course_name as subject_name', 
            'courses.course_code as subject_code', 'exam.type as exam_type',
            'batches.batch as session','classes.class_name as class_name',
            'classes.class_code as class_code','exam.id as exam_id',
            // 'rolls.username as roll_no',
            'semesters.semester_name as grade_name',
            // 'admissions.first_name', 'admissions.last_name',
             'marks.grade as exam_grade',
            //  , 'marks.id as mark_id',
             DB::raw('count(marks.class) as student_fail'))
             ->groupBy('subject_name','subject_code','exam_type','class_name', 'session',
             'class_code','grade_name','exam_grade','exam_id')->get();
            //  ->dd();

            $current_session_repeated_students = DB::table('marks')->where('grade', 'F')
            ->whereYear('created_at', Carbon::now()->year)
            ->where('marks.school_id', auth()->user()->school_id)
            ->count();
            
            $last_session_repeated_students = DB::table('marks')->where('grade', 'F')
            ->whereYear('created_at', Carbon::now()->subYear(1))
            ->where('marks.school_id', auth()->user()->school_id)
            ->count();

            $year_before_last_session_repeated_students = DB::table('marks')->where('grade', 'F')
            ->whereYear('created_at', Carbon::now()->subYear(2))
            ->where('marks.school_id', auth()->user()->school_id)
            ->count();

                // dd( $current_session_repeated_students,$last_session_repeated_students,  $year_before_last_session_repeated_students);
            $data['year_list'] = $this->fetch_year();

            $studentAdmission = Admission::join('countries', 'countries.id', '=', 'admissions.nationality')->select('countries.name as country', DB::raw('count(admissions.nationality) as count'))
            ->groupBy('country')->get();

            $top_staff = Teacher::where('school_id', auth()->user()->school_id)->get();


            $current_session_exams = DB::table('exam')->join('classes', 'classes.id', '=', 'exam.class_id')
            ->where('exam.school_id', auth()->user()->school_id)->paginate(2);

            $current_session_exams_count = DB::table('exam')->join('classes', 'classes.id', '=', 'exam.class_id')
            ->where('exam.school_id', auth()->user()->school_id)->count();

            $current_session_exams_marks = DB::table('marks')
            ->join('classes', 'classes.class_code', '=', 'marks.class')
            ->join('exam', 'exam.id', '=', 'marks.exam')
            ->join('batches', 'batches.id', '=', 'marks.session')
            ->join('courses', 'courses.course_code', '=', 'marks.subject')
            ->where('exam.school_id', auth()->user()->school_id)
            ->where('batches.is_current_batch', 1)
            ->select('courses.course_code as subject_code', 'courses.course_name as subject_name',
            'exam.id as exam_id', 'exam.type as exam_type','classes.class_name as class_name',
            'classes.class_code as class_code','batches.batch as session',
            DB::raw('count(marks.class) as total_students'))
            ->groupBy('subject_name','subject_code','exam_type','class_name', 'session',
            'class_code','exam_id')->orderBy('classes.class_name', 'ASC')->orderBy('exam.id', 'DESC')->get();

            $current_session_exams_marks_count = DB::table('marks')
            ->join('classes', 'classes.class_code', '=', 'marks.class')
            ->join('exam', 'exam.id', '=', 'marks.exam')
            ->join('batches', 'batches.id', '=', 'marks.session')
            ->join('courses', 'courses.course_code', '=', 'marks.subject')
            ->where('exam.school_id', auth()->user()->school_id)
            ->where('batches.is_current_batch', 1)->count();

            $current_session_puplished_result = DB::table('meritlist')
            ->join('classes', 'classes.class_code', '=', 'meritlist.class')
            ->join('batches', 'batches.id', '=', 'meritlist.batch')
            ->join('exam', 'exam.id', '=', 'meritlist.exam')->where('batches.is_current_batch', 1)
            ->where('batches.is_current_batch', 1)
            ->select(
            'exam.id as exam_id', 'exam.type as exam_type','batches.batch as session','meritlist.created_at as publish_date',
            DB::raw('count(meritlist.roll_no) as total_students'))
            ->groupBy('exam_type','batches.batch','exam_id','publish_date')->orderBy('classes.class_name', 'ASC')
            ->orderBy('exam.id', 'DESC')->get();

            $current_session_puplished_result_count = DB::table('meritlist')
            ->join('classes', 'classes.class_code', '=', 'meritlist.class')
            ->join('batches', 'batches.id', '=', 'meritlist.batch')
            ->join('exam', 'exam.id', '=', 'meritlist.exam')->where('batches.is_current_batch', 1)
            ->where('meritlist.school_id', auth()->user()->school_id)->count();
                

        return view('school.dashboad2',compact('batchCount','transactionsCount','transactions','student_fees',
        'studentsCount','classCount','courseCount','dayCount','feeCount',
        'levelCount','semesterCount','shiftCount','timeCount','feeStructureCount',
        'classroomCount','teachersCount','classschedulCount','current_session_exams_marks_count','current_session_exams_count',
        'class_name','students_in_charge_total','current_session_puplished_result_count',
        'last_month_attendance','month_before_last_attendance','month_before2_last_attendance',
        'current_month_attendance_present','current_month_attendance_absent',
        'current_month_attendance_late','current_month_attendance_sick',

        'last_month_attendance_present','last_month_attendance_absent','last_month_attendance_late','last_month_attendance_sick',
        'month_before_last_attendance_present','month_before_last_attendance_absent','month_before_last_attendance_late','month_before_last_attendance_sick',
        'month_before2_last_attendance_present','month_before2_last_attendance_absent','month_before2_last_attendance_late','month_before2_last_attendance_sick',

        'online_admission','offline_admission','current_session_exams','current_session_exams_marks',
        
        'repeated_students','current_session_repeated_students','current_session_puplished_result',
        'last_session_repeated_students', 'year_before_last_session_repeated_students','top_staff',

        'facultyCount','departmentCount'))
        ->with($data)->with('studentAdmission', $studentAdmission);
    }


    public function RepeatStudentsList(Request $request, $class, $exam)
    {
        $repeated_students = DB::table('marks')
        ->join('courses', 'courses.course_code', '=', 'marks.subject')
        ->join('batches', 'batches.id', '=', 'marks.session')
        ->join('exam', 'exam.id', '=', 'marks.exam')
        ->join('classes', 'classes.class_code', '=', 'marks.class')
        ->join('rolls', 'rolls.username', '=', 'marks.roll_no')
        ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->join('semesters', 'semesters.id', '=', 'rolls.semester_id')
        ->where('grade', 'F')->where('marks.school_id', auth()->user()->school_id)
        ->where('marks.class', $class)->where('batches.is_current_batch', 1)
        ->where('marks.exam', $exam)
        ->select('courses.course_name as subject_name', 'courses.course_code as subject_code', 'exam.type',
        'batches.batch','classes.class_name','classes.class_code','rolls.username as roll_no','semesters.semester_name as grade_name',
        'admissions.first_name', 'admissions.last_name', 'marks.grade', 'marks.id as mark_id')
        ->get();

       return view('repeat/repeat_student_list')->with('repeated_students', $repeated_students);
    }

        public function fetch_year() {
            $data = FacadesDB::table('admissions')->select(FacadesDB::raw('DATE_FORMAT(dateregistered, "%Y") as year '))->groupBy('year')->orderBy('year', 'DESC')->get();
            return $data;
        }


        public function fetch_data(Request $request) {

           
             
            // echo $studentAdmission [0]['country'];die;
            $studentAdmission = $this->fetch_chart_data();
                 
            foreach($studentAdmission->toArray() as $row)
            {
        
             $output[] = array(
            'students'  => $row['count'],
            'countries' => $row['country']
             );
            }
                //  dd($test);
                 echo json_encode($output);
            }
        // }

        function fetch_chart_data()
        {
            $studentAdmission = Admission::join('countries', 'countries.id', '=', 'admissions.nationality')->select('countries.name as country', DB::raw('count(admissions.nationality) as count'))
            ->groupBy('country')->get();
        // $data =  FacadesDB::table('admissions')->select(FacadesDB::raw('DATE_FORMAT(dateregistered, "%Y") as year '),'month', 'id')->orderBy('year', 'ASC')->whereYear('dateregistered', 2020)->get();
        return $studentAdmission;
        }

        public function getSchoolBanner(Request $request)
        {   
            $banners = SchoolBanner::where('school_id', auth()->user()->school_id)->get();
                
            return view('school.website.banner.index')->with('banners', $banners);
        }
    
        public function postSchoolBanner(Request $request)
        {
            // dd($request->all());

            $banner_image = $request->file('banner_image');

            if (!$banner_image) {
                    Flash::error('Image is required please checked your input!');
                    return redirect(route('banner.create'));
            }else {
                $extension = $banner_image->getClientOriginalExtension();
                $new_image_name = time(). '.' .$extension;
                $banner_image->move(public_path('school_images/banner'), $new_image_name);
            }

            $school_banner = new SchoolBanner;
            $school_banner->name = $request->name;
            $school_banner->status =  $request->status;
            $school_banner->school_id =  $request->school_id;
            $school_banner->banner_image =  $new_image_name;

            $school_banner->save();
    
            Flash::success('Banner Added Successfully');
            return redirect(route('banner.create'));
        }
    
        public function editSchoolBanner($id)
        {
            $banner = SchoolBanner::findOrFail($id);
            return view('school.website.banner.index')->with('banner', $banner);
        }
    
        public function deleteSchoolBanner(Request $request)
        {
    
            return view('school.website.banner.index');
        }

        public function getSchoolEvent(Request $request)
        {   
            $events = School_Event::where('school_id', auth()->user()->school_id)->get();
                
            return view('school.website.event.event_index')->with('events', $events);
        }
    
        public function postSchoolEvent(Request $request)
        {
            // dd($request->all());

            $event_image = $request->file('event_image');

            if (!$event_image) {
                    Flash::error('Image is required please checked your input!');
                    return redirect(route('event.create'));
            }else {
                $extension = $event_image->getClientOriginalExtension();
                $new_image_name = time(). '.' .$extension;
                $event_image->move(public_path('school_images/event'), $new_image_name);
            }

            $school_event = new School_Event;
            $school_event->name = $request->name;
            $school_event->place = $request->place;
            $school_event->body = $request->body;
            $school_event->start_date =  $request->start_date;
            $school_event->end_date =  $request->end_date;
            $school_event->status =  $request->status;
            $school_event->school_id =  $request->school_id;
            $school_event->image =  $new_image_name;

            $school_event->save();
    
            Flash::success('Event Added Successfully');
            return redirect(route('event.create'));
        }
    
        public function editSchoolEvent($id)
        {
            $event = School_Event::findOrFail($id);
            $events = School_Event::where('school_id', auth()->user()->school_id)->get();
            return view('school.website.event.event_index')->with('event', $event)->with('events', $events);
        }

        public function updateSchoolEvent(Request $request)
        {
            $event = School_Event::where(['id' => $request->event_id])
            ->update(['name' => $request->name, 'place' => $request->place, 'body' => $request->body, 'start_date' => $request->start_date, 'status' => $request->status, 'image' => $request->event_image]);
            // $message = Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

            Flash::success('Event Updated Successfully!');
            return redirect(route('event.create'));
        }

        public function getSchoolEventDetail(Request $request, $event_id)
        {
             $event_detail = School_Event::where('id', $event_id)->get();

             return view('school.website.event.event_detail')->with('event_detail', $event_detail);
        }
    
        public function deleteSchoolEvent(School_Event $event_delete, $id)
        {
            $event_delete = School_Event::find($id);

                $event_delete->delete();

                Flash::success('Event Delete Successfully!');
            return back();
        }

        public function SchoolNewsIndex()
        {
            $schoolnews = SchoolNews::where('school_id', auth()->user()->school_id)->get();

            return view('admins.news.index', compact('schoolnews'));
        }


        public function getSchoolNews(Request $request)
        {   
            $school_news = SchoolNews::where('school_id', auth()->user()->school_id)->get();
                // $school_new = SchoolNews::findOrFail($id);
            return view('admins.news.index')->with('school_news', $school_news);
        }
    
        public function postSchoolNews(Request $request)
        {
            // dd($request->all());

            $news_image = $request->file('featured_image');

            if (!$news_image) {
                    Flash::error('Image is required please checked your input!');
                    return redirect(route('news.create'));
            }else {
                $extension = $news_image->getClientOriginalExtension();
                $new_image_name = time(). '.' .$extension;
                $news_image->move(public_path('school_images/news'), $new_image_name);
            }

            $school_news = new SchoolNews;
            $school_news->title = $request->title;
            $school_news->body = $request->body;
            $school_news->news_date =  $request->news_date;
            $school_news->status =  $request->status;
            $school_news->school_id =  $request->school_id;
            $school_news->image =  $new_image_name;

            $school_news->save();
    
            Flash::success('News Added Successfully');
            return redirect(route('news.create'));
        }
    
        public function editSchoolNews($id)
        {
            $school_new = SchoolNews::findOrFail($id);
            $school_news = SchoolNews::where('school_id', auth()->user()->school_id)->get();
            return view('admins.news.index')->with('school_news', $school_news)->with('school_new', $school_new);
        }

        public function updateSchoolNews(Request $request)
        {
            // dd($request->all());
            $event = SchoolNews::where(['id' => $request->news_id])
            ->update(['title' => $request->title, 'body' => $request->body, 'news_date' => $request->news_date, 'status' => $request->status, 'image' => $request->event_image]);

            Flash::success('News Updated Successfully!');
            return redirect(route('news.index'));
        }

        public function getSchoolNewsDetail(Request $request, $event_id)
        {
             $news_detail = SchoolNews::where('id', $event_id)->get();

             return view('admins.news.news_detail')->with('news_detail', $news_detail);
        }
    
        public function deleteSchoolNews(Request $request)
        {
    
            return view('school.website.event.index');
        }
        


        public function getMediaManager(Request $request)
        {   
            $media_images = MediaManager::where('school_id', auth()->user()->school_id)->get();
            $media_videos = VideoManager::where('school_id', auth()->user()->school_id)->get();
                
            return view('school.media_manager.index')->with('media_images', $media_images)->with('media_videos', $media_videos);
        }
    
        public function postMediaManager(Request $request)
        {
                $image = $request->file('file');

            if (!$image) {
                    Flash::error('Image is required please checked your input!');
                    return redirect(route('media.index'));
            }else {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('school_images/media_manager'),$imageName);

    				// Resize Images
                // Image::make($image_tmp)->save($large_image_path);
                // Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                // Image::make($image)->resize(300,300)->save($image);

                
            }

            // dd($request->all());

            $imageUpload = new MediaManager;
            $imageUpload->filename = $imageName;
            $imageUpload->school_id =  $request->school_id;
            $imageUpload->save();
            return response()->json(['success'=>$imageName]);
            // Flash::success('Event Added Successfully');
            // return redirect(route('event.create'));
        }
    
        public function editMediaManager($id)
        {
            $event = School_Event::findOrFail($id);
            $events = School_Event::where('school_id', auth()->user()->school_id)->get();
            return view('school.website.event.index')->with('event', $event)->with('events', $events);
        }

        public function updateMediaManager(Request $request)
        {
            $event = School_Event::where(['id' => $request->event_id])
            ->update(['name' => $request->name, 'place' => $request->place, 'body' => $request->body, 'start_date' => $request->start_date, 'status' => $request->status, 'image' => $request->event_image]);
            // $message = Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

            Flash::success('Event Updated Successfully!');
            return redirect(route('event.create'));
        }

        public function detailMediaManager(Request $request, $event_id)
        {
             $event_detail = School_Event::where('id', $event_id)->get();

             return view('school.website.event.event_detail')->with('event_detail', $event_detail);
        }
    
        public function deleteMediaManager(MediaManager $media_image)
        {
            $media_image->delete();
            // dd( $media_image);
           if(!empty($media_image->filename)) {
               if (file_exists(public_path('school_images/media_manager/'. $media_image->filename))) {
                 unlink(public_path('school_images/media_manager/'. $media_image->filename));
               }
            }
            Flash::success($media_image->filename.' successfully deleted');
            return back();
            
            // $filename =  $request->get('filename');
            // MediaManager::where('filename',$filename)->delete();
            // $path=public_path().'/school_images/media_manager/'.$filename;
            // if (file_exists($path)) {
            //     unlink($path);
            // }
            // return $filename; 
            // return view('school.website.event.index');
        }

        public function SaveVideoMediaManager(Request $request)
        {
                // $image = $request->file('video_manager_url');



            // if (!$image) {
            //         Flash::error('Image is required please checked your input!');
            //         return redirect(route('event.create'));
            // }else {
            //     $imageName = $image->getClientOriginalName();
                // $image->move(public_path('school_videos/videomedia_manager'),$image);
            // }

            $imageUpload = new VideoManager;
            $imageUpload->video_filename = $request->video_manager_url;
            $imageUpload->video_name = $request->v_name;
            $imageUpload->school_id =  $request->school_id;
            $imageUpload->save();
            // return response()->json(['success'=>$imageName]);
            Flash::success('Video Added Successfully');
            return redirect(route('media.index'));
        }


        public function getContactUs()
        {
            $contact_us = ContactUs::where('school_id', Auth()->user()->school_id)->get();

           return view('admins.contact_Us.index')->with('contact_us', $contact_us);
        }
    
    


//         Route::post('get/banner', 'HomeController@getSchoolBanner')->name('banner.create');
// Route::get('edit/banner/{id}', 'HomeController@editSchoolBanner')->name('banner.edit');
// Route::post('delete/banner/{id}', 'HomeController@deleteSchoolBanner')->name('banner.delete');
// Route::post('post/banner', 'HomeController@postSchoolBanner')->name('banner.Store');


























        public function messageindex()
        {
            // select all users except logged in user
            // $users = User::where('id', '!=', Auth::id())->get();
            // users.avatar,
            // count how many message are unread from the selected user
            $users = DB::select("select users.id, users.name,  users.email, count(is_read) as unread 
            from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
            where users.id != " . Auth::id() . " 
            group by users.id, users.name,  users.email"); //users.avatar,
    
            return view('admins.messages.table', ['users' => $users]);
        }
    
        public function getMessage($user_id)
        {
            $my_id = Auth::id();

            // Make read all unread message
           $message = Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);
            dd( $message);
            // Get all message from selected user
            $messages = Message::where(function ($query) use ($user_id, $my_id) {
                $query->where('from', $user_id)->where('to', $my_id);
            })->oRwhere(function ($query) use ($user_id, $my_id) {
                $query->where('from', $my_id)->where('to', $user_id);
            })->get();
    
            return view('admins.messages.index', ['messages' => $messages]);
        }
    
        public function sendMessage(Request $request)
        {
            $from = Auth::id();
            $to = $request->receiver_id;
            $message = $request->message;
    
            $data = new Message();
            $data->from = $from;
            $data->to = $to;
            $data->message = $message;
            $data->is_read = 0; // message will be unread when sending message
            $data->save();
    
            // pusher
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
    
            // 'options' => [
            //     'cluster' => 'ap1',
            //     'useTLS' => true
            //   ],
    
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
    
            $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'my-event', $data);
        }
    
        public function typingEvent(Request $request)
        {
            event(new TypingEvent($request->user_id, \Auth::user()->id, $request->isTyping));
            return [
                'typing' => $request->isTyping
            ];
        }


        public function admin(Request $req){
            return view('middleware')->withMessage("Admin");
            }

        public function super_admin(Request $req){
        return view('middleware')->withMessage("Super Admin");
        }

        public function member(Request $req){
        return view('middleware')->withMessage("Member");
        }

}
