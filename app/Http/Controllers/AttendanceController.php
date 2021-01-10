<?php

namespace App\Http\Controllers;

use App\ClassOff;
use App\Holidays;
use App\Http\Requests\CreateAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Repositories\AttendanceRepository;
use App\Http\Controllers\AppBaseController;
use App\Institute;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use App\Models\Attendance;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Admission;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\Department;
use App\Models\Semester;
use App\Roll;
use Carbon\Carbon;
use PDF;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Laracasts\Flash\Flash as FlashFlash;

class AttendanceController extends AppBaseController
{
    /** @var  AttendanceRepository */
    private $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepo)
    {
        $this->attendanceRepository = $attendanceRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Attendance.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request  $request)
    {
        $classes = Classes::all();
        $semesters = Semester::where('status', 'on')->get();
        $class_id = $request->class_id;
        $attend_date = date('d-m-Y');
        $date_attend = $request->attendance_date;

        $edited_date = Attendance::where('attendance_date',$attend_date)->first();

        $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
        ->select('admissions.first_name as student_firstname',
                 'admissions.last_name as student_lastname',
                 'admissions.id as student_id',
                 'rolls.username as roll_no',
                 'teachers.first_name  as teacher_firstname',
                 'teachers.last_name  as teacher_lastname',
                 'semesters.id  as semester_id',
                 'semesters.semester_name', 
                 'teachers.teacher_id',
                 'classes.class_name',
                 'classes.id as class_id',
                 'courses.id as course_id',
                 'courses.course_name')
        ->where('admissions.class_code',$class_id)
        // ->where('class_schedule.school_id', auth()->user()->school_id)
        ->where('admissions.school_id', auth()->user()->school_id)
        ->get();
       
     $attendance = Roll::join('admissions','admissions.id','=','rolls.student_id')
                       ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                        ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
                        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
                        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
                        ->where('admissions.class_code',$class_id)
                        ->first();
                       
        if(auth()->user()->group == 'Owner'){

            $attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
            ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
            // ->join('schools', 'schools.id', '=', 'admissions.school_id')
            ->join('users', 'users.id', '=', 'attendances.teacher_id')
            ->join('courses', 'courses.id', '=', 'attendances.course_id')
            ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
             ->select(
                  'admissions.first_name as student_first_name',
                  'admissions.last_name as student_last_name',
                  'admissions.image',
                  'users.name as teacher_first_name',
                //   'teachers.last_name as teacher_last_name',
                  'rolls.username as roll_no',
                  'courses.course_name',
                  'attendances.attendance_date',
                  'attendances.attendance_status',
                  'classes.class_name'
                  )
                ->where('admissions.school_id',     auth()->user()->school_id)
                ->groupby('rolls.username','admissions.first_name'
                 ,'admissions.last_name','admissions.image','users.name',
                 'attendances.attendance_date','attendances.attendance_status',
                 'classes.class_name','courses.course_name')->get();
                  
                return view('attendances.index', compact('classes', 'semesters',  'students','attendance','edited_date'))
                ->with('attendances', $attendances);
            //  dump($attendances); die;
       }else{

                
           if ($request->school_id != '' && $request->class_id != '' && $request->attendance_date != '') {

            // dd($request->all());

            $attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
            ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
            ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
            ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
            ->join('courses', 'courses.id', '=', 'attendances.course_id')
            ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
            ->select(
                'admissions.first_name as student_first_name',
                'admissions.last_name as student_last_name',
                'admissions.image',
                'teachers.first_name as teacher_first_name',
                'teachers.last_name as teacher_last_name',
                'rolls.username as roll_no',
                'courses.course_name',
                'attendances.attendance_date',
                'attendances.attendance_status',
                'classes.class_name'
                )
                ->where('attendances.class_id', $request->class_id)
                ->where('attendances.school_id',$request->school_id)
                ->where('attendances.attendance_date',$request->attendance_date)
                ->groupby('rolls.username','admissions.first_name'
                ,'admissions.last_name','admissions.image',
                'teacher_first_name', 'teacher_last_name', 
                'attendances.attendance_date','attendances.attendance_status',
                'classes.class_name','courses.course_name')
                ->get();

                // dd( $attendances);

                if ($attendances == '') {
                    FlashFlash::info("No Attendance Found");
                   return redirect(route("attendances.index"));
                }


                    return view('attendances.index', compact('classes', 'students', 'semesters', 'attendance','edited_date'))
                    ->with('attendances', $attendances);
                    
  

            }elseif ($request->school_id != '' && $request->class_id != '' && $request->attendance_date == '') {
                $attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
                ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
                ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
                ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
                ->join('courses', 'courses.id', '=', 'attendances.course_id')
                ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
                ->select(
                    'admissions.first_name as student_first_name',
                    'admissions.last_name as student_last_name',
                    'admissions.image',
                    'teachers.first_name as teacher_first_name',
                    'teachers.last_name as teacher_last_name',
                    'rolls.username as roll_no',
                    'courses.course_name',
                    'attendances.attendance_date',
                    'attendances.attendance_status',
                    'classes.class_name'
                    )
                    ->where('attendances.class_id', $request->class_id)
                    ->where('attendances.school_id',$request->school_id)
                    // ->where('attendances.attendance_date',$request->attendance_date)
                    ->groupby('rolls.username','admissions.first_name'
                    ,'admissions.last_name','admissions.image','teacher_first_name', 'teacher_last_name', 'attendances.attendance_date','attendances.attendance_status',
                    'classes.class_name','courses.course_name')
                    ->get();

                    if ($attendances == '') {
                        FlashFlash::info("No Attendance Found");
                       return redirect(route("attendances.index"));
                    }

                    return view('attendances.index', compact('classes', 'students','semesters', 'attendance','edited_date'))
                    ->with('attendances', $attendances);
            }

           

    }
    

       $attendances = Attendance::where('attendances.class_id', $request->class_id);
        $students = $this->GetClass($request);

        // return redirect(route("attendances.index"));
        return view('attendances.index', compact('classes', 'students','attendance','edited_date'))
            ->with('attendances', $attendances);
    }

  public function GetClass(Request $request)
{
    // dd($request->all());
    $attendances = $this->attendanceRepository->all();
    $class_id = $request->class_id;
    $course_id = $request->course_id;
    $semester_id = $request->semester_id;
    $department_id = $request->department_id;

    if(auth()->user()->group == 'Owner'){

    $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
    // ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    // ->rightjoin('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
    // ->join('courses', 'courses.id', '=', '2')
    ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
    // ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
    ->where('admissions.class_code',$class_id)
    // ->where('class_schedule.school_id', auth()->user()->school_id)
    ->where('admissions.school_id', auth()->user()->school_id)
    ->where('admissions.acceptance', 'accept')
     ->select('admissions.first_name as student_firstname',
             'admissions.last_name as student_lastname',
             'admissions.id as student_id',
             'rolls.username as roll_no',
             'semesters.id  as semester_id',
             'semesters.semester_name'
            //  'teachers.first_name  as teacher_firstname',
            //  'teachers.last_name  as teacher_lastname',
            //  'teachers.teacher_id',
            //  'classes.class_name',
            //  'classes.class_code',
            //  'classes.id as class_id'
            //  'courses.id as course_id',
            //  'class_schedule.degree_id',
            // 'courses.course_name'
             )
             ->get();
    // dump($students); die;

    $attendance = Roll::join('admissions','admissions.id','=','rolls.student_id')
    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
    ->where('admissions.class_code',$class_id)
    ->first();

    // return $students;
    $classes = Classes::where('school_id', auth()->user()->school_id)->get();
    $grades = Semester::where('school_id', auth()->user()->school_id)->get();
    //attendances.mark_attendance

    return view('attendances.mark_attendance', compact( 'students','classes','attendance','grades'))
    ->with('attendances', $attendances);

    }elseif(auth()->user()->group == 'Teacher'){

        $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
        ->where('admissions.class_code',$class_id)
        ->where('class_schedule.school_id', auth()->user()->school_id)
        ->where('admissions.school_id', auth()->user()->school_id)
         ->select('admissions.first_name as student_firstname',
                 'admissions.last_name as student_lastname',
                 'admissions.id as student_id',
                 'rolls.username as roll_no',
                 'teachers.first_name  as teacher_firstname',
                 'teachers.last_name  as teacher_lastname',
                 'teachers.teacher_id',
                 'classes.class_name',
                 'classes.class_code',
                 'classes.id as class_id',
                 'courses.id as course_id',
                 'class_schedule.degree_id',
                'courses.course_name'
                 )->get();
        // dump($students); die;
    
        $attendance = Roll::join('admissions','admissions.id','=','rolls.student_id')
        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
        ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
        ->where('admissions.class_code',$class_id)
        ->first();
    
        // return $students;
        $classes = Classes::where('school_id', auth()->user()->school_id)->get();
        $grades = Semester::where('school_id', auth()->user()->school_id)->get();
        //attendances.mark_attendance
    
        return view('teachers.attendances.mark_attendance', compact( 'students','classes','attendance','grades'))
        ->with('attendances', $attendances);
}else {
      
    $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
    ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
    ->where('admissions.class_code',$class_id)
    ->where('class_schedule.school_id', $request->school_id)
    ->where('admissions.school_id',$request->school_id)
     ->select('admissions.first_name as student_firstname',
             'admissions.last_name as student_lastname',
             'admissions.id as student_id',
             'rolls.username as roll_no',
             'teachers.first_name  as teacher_firstname',
             'teachers.last_name  as teacher_lastname',
             'semesters.id  as semester_id',
             'semesters.semester_name',
             'teachers.teacher_id',
             'classes.class_name',
             'classes.class_code',
             'classes.id as class_id',
             'courses.id as course_id',
             'class_schedule.degree_id',
            'courses.course_name')->get();

    if(!$students){
        return back();
    }
    // dump($students); die;

    $attendance = Roll::join('admissions','admissions.id','=','rolls.student_id')
    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
    ->where('admissions.class_code',$class_id)
    ->first();

    // return $students;
    $classes = Classes::all();
    //attendances.mark_attendance
    return view('attendances.mark_attendance', compact( 'students','classes','attendance','grades'))
    ->with('attendances', $attendances);
}
}

public function Get_Attendance_Class(Request $request)
{
    $attendances = $this->attendanceRepository->all();
    $class_id = $request->class_id;

    $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
    ->where('admissions.class_code',$class_id)
     ->select('admissions.first_name as student_firstname',
             'admissions.last_name as student_lastname',
             'admissions.id as student_id',
             'rolls.username as roll_no',
             'teachers.first_name  as teacher_firstname',
            'teachers.last_name  as teacher_lastname',
             'teachers.teacher_id',
             'classes.class_name',
             'classes.class_code',
             'classes.id as class_id',
             'courses.id as course_id',
            'courses.course_name'
             )
    ->where('admissions.class_code',$class_id)
    ->get();
     //dump($students); die;

    $attendance = Roll::join('admissions','admissions.id','=','rolls.student_id')
    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
    ->where('admissions.class_code',$class_id)
    ->first();

    // return $students;


    return view('attendances.attendance', compact( 'students','classes','attendance'))
    ->with('attendances', $attendances);
}

public function Mark_Teacher_Attendance(Request $request)
	{

        // $attendance = $this->GetTeacherStudents->all();
        $attendances = $this->attendanceRepository->all();
        $class_id = $request->class_id;
        $course_id = $request->course_id;
        $department_id = $request->department_id;

        $teacher_id = Auth::user()->teacher_id;

        
      

        $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
        ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
        ->where('class_schedule.teacher_id', $teacher_id)
        ->first();


        $classes = ClassSchedule::join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                           ->where('class_schedule.teacher_id', $teacher_id)
                          // ->where('class_schedule.course_id', $teacher_id)
                           //->groupBy('classes.id')
                           ->orderBy('classes.id', 'ASC')
                           ->get();

        // $departments = ClassSchedule::join('departments', 'departments.department_id','=', 'class_schedule.department_id')
        //                    ->where('class_schedule.teacher_id', $teacher_id)
        //                   // ->where('class_schedule.course_id', $teacher_id)
        //                    //->groupBy('classes.id')
        //                    ->orderBy('departments.department_id', 'ASC')
        //                    ->get();

        // $faculties = ClassSchedule::join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
        //                    ->where('class_schedule.teacher_id', $teacher_id)
        //                   // ->where('class_schedule.course_id', $teacher_id)
        //                    //->groupBy('classes.id')
        //                    ->orderBy('faculties.faculty_id', 'ASC')
        //                    ->get();

        // $semesters = ClassSchedule::join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        //                     ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
        //                    ->where('class_schedule.teacher_id', $teacher_id)
        //                     //->where('class_schedule.course_id', $class_name->teacher_id)
        //                 //    ->groupBy('semesters.id')
        //                    ->orderBy('semesters.id', 'ASC')
        //                    ->get();
            // dd($semesters );
        // $courses = ClassSchedule::join('courses', 'courses.id','=', 'class_schedule.course_id')
        //             ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
        //            ->where('class_schedule.teacher_id', $teacher_id)
        //           //->where('class_schedule.course_id', $class_name->teacher_id)
        //            //->groupBy('classes.id')
        //            ->orderBy('courses.id', 'ASC')
        //            ->get();

                           $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
                           ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                           ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
                           ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
                           ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
                           ->where('teachers.teacher_id',$teacher_id)
                           ->where('class_schedule.class_id',$class_id)
                            ->select('admissions.first_name as student_firstname',
                                    'admissions.last_name as student_lastname',
                                    'admissions.id as student_id',
                                    'admissions.semester_id as semester_id',
                                    'rolls.username as roll_no',
                                    'teachers.first_name  as teacher_firstname',
                                    'teachers.last_name  as teacher_lastname',
                                    'teachers.teacher_id',
                                    'classes.class_name',
                                    'classes.class_code',
                                    'classes.id as class_id',
                                    'courses.id as course_id',
                                   'courses.course_name'
                                    )
                                    ->groupBy('admissions.id')
                           //->where('admissions.class',$class_id)
                           ->get();



            // dd( $students); die;

            return view('teachers.attendances.attendance',
            compact( 'students','classes','semesters','courses','departments','faculties','class_name'))
            ->with('attendances', $attendances);
        }


        public function GetTeacherStudents(Request $request, $class_id)
        {
            $attendances = $this->attendanceRepository->all();
            $class_id1 = $request->class_id;
            $course_id = $request->course_id;
            $semester_id = $request->semester_id;
            $department_id = $request->department_id;
            $teacher_id = $request->teacher_id;
            $attend_date = date('Y-m-d');

            $input = $request->all();

            $teacher_id = Auth::user()->teacher_id;
            // dd( $input); die;

            $today_attendance = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
            ->where('attendances.teacher_id', $teacher_id)
            ->where('admissions.class_code',$class_id)
            ->where('attendances.teacher_id', $teacher_id)
            ->where('attendances.attendance_date', $attend_date)
            ->count();

            $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
            ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
            ->join('semesters', 'semesters.id', '=', 'class_schedule.semester_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
            ->where('admissions.class_code',$class_id)
            ->where('class_schedule.class_id',$class_id)
            ->where('class_schedule.teacher_id',$teacher_id)
            ->where('class_schedule.course_id', 3)
            // ->where('class_schedule.department_id',$department_id)
            // ->where('class_schedule.semester_id',$semester_id)
             ->select('admissions.first_name as student_firstname',
                     'admissions.last_name as student_lastname',
                     'admissions.id as student_id',
                     'rolls.username as roll_no',
                     'teachers.first_name  as teacher_firstname',
                     'teachers.last_name  as teacher_lastname',
                     'teachers.teacher_id',
                     'semesters.id as semester_id',
                     'classes.class_name',
                     'classes.class_code',
                     'classes.id as class_id',
                     'courses.id as course_id',
                    'courses.course_name')
                    ->groupBy('admissions.id')
            ->get();

            // dd( $students); die;

            // $url = $request->fullUrl();
            $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
        ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
        ->where('class_schedule.teacher_id', $teacher_id)
        ->first();


        $classes = ClassSchedule::join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                                ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                           ->where('class_schedule.teacher_id', $teacher_id)
                          // ->where('class_schedule.course_id', $teacher_id)
                           //->groupBy('classes.id')
                           ->orderBy('classes.id', 'ASC')
                           ->get();

            // dd( $teachertimetables); die;

            return view('teachers.attendances.attendance',
            compact( 'students','classes','class_name', 'today_attendance'))
            ->with('attendances', $attendances);
        //    dd($students);
        }

        public function DynamicAttendanceByClass(Request $request){
            $input = $request->all();
            $semester_id = $request->get('semester_id');
            $teacher_id = $request->get('teacher_id');

            $class_name =  ClassSchedule::join('classes', 'classes.id', '=', 'class_schedule.class_id')
            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
            ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
            ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
            ->where('class_schedule.teacher_id',$request->semester_id)
            ->first();
            // dd($input); die;
        if ($request->ajax()) {
            return response(ClassSchedule::join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')

            ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
            //->where('teachers.teacher_id',$request->semester_id)
             ->when($semester_id, function($query, $semester_id){
               return  $query->where('class_schedule.faculty_id',$semester_id)
                             ->Orwhere('class_schedule.faculty_id', $semester_id);
             }

            // ['class_schedule.faculty_id', $request->semester_id],
            // ['class_schedule.teacher_id', '=', 'class_schedule.class_id'],
            // ['class_schedule.teacher_id', '=', 'class_schedule.faculty_id']
        )
        // ->when($teacher_id, function($query, $teacher_id){
        //     return  $query->where('class_schedule.teacher_id',$semester_id);
        //   }
        // )
           // ->where('class_schedule.semester_id',$request->semester_id)
            //->groupBy('classes.id')
            ->get());
        }
    }

    public function Teacher_Attendance(Request $request)
	{

        // $attendance = $this->GetTeacherStudents->all();
        $attendances = $this->attendanceRepository->all();
        $class_id = $request->class_id;
        $course_id = $request->course_id;
        $department_id = $request->department_id;

        $teacher_id = Auth::user()->teacher_id;

        $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
        ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
        ->where('class_schedule.teacher_id', $teacher_id)
        ->first();


        $classes = ClassSchedule::join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                           ->where('class_schedule.teacher_id', $teacher_id)
                          // ->where('class_schedule.course_id', $teacher_id)
                           //->groupBy('classes.id')
                           ->orderBy('classes.id', 'ASC')
                           ->get();



                           $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
                           ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                           ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
                           ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
                           ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
                           ->where('teachers.teacher_id',$teacher_id)
                           ->where('class_schedule.class_id',$class_id)
                            ->select('admissions.first_name as student_firstname',
                                    'admissions.last_name as student_lastname',
                                    'admissions.id as student_id',
                                    'admissions.semester_id as semester_id',
                                    'rolls.username as roll_no',
                                    'teachers.first_name  as teacher_firstname',
                                    'teachers.last_name  as teacher_lastname',
                                    'teachers.teacher_id',
                                    'classes.class_name',
                                    'classes.class_code',
                                    'classes.id as class_id',
                                    'courses.id as course_id',
                                   'courses.course_name'
                                    )
                           //->where('admissions.class',$class_id)
                           ->get();



            // dd( $students); die;

            return view('teachers.attendances.attendance',
            compact( 'students','classes','class_name'))
            ->with('attendances', $attendances);
        }


    

    public function DynamicByFaculty(Request $request){
        $input = $request->all();
        // dd($input); die;
    if ($request->ajax()) {
        return response(ClassSchedule::
        join('departments', 'departments.department_id','=', 'class_schedule.department_id')
        ->where('departments.department_id',$request->faculty_id)
        ->where('class_schedule.teacher_id',$request->faculty_id)
        ->where('class_schedule.department_id',$request->faculty_id)
        ->get());
    }
}

public function DynamicByClass(Request $request){
    $input = $request->all();
    // dd($input); die;
if ($request->ajax()) {
    return response(ClassSchedule::
    join('classes', 'classes.id','=', 'class_schedule.class_id')
    ->where('classes.id',$request->department_id)
    ->get());
}
}

public function DynamicByCourse(Request $request){
    $input = $request->all();
    // dd($input); die;
if ($request->ajax()) {
    return response(
        ClassSchedule::where('course_id',$request->class_id)
        ->orWhere(function ($query) {
            $query->where('teacher_id', '=', 'course_id')
                ->where('course_id', '=', 'class_id' );
        })->get());
}
}


public function AttendanceList(Request $request)
{
    $classes = Classes::all();
    $class_id = $request->class_id;
    $attend_date = date('d-m-Y');

    $teacher_id = Auth::user()->teacher_id;
    $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
    ->select('admissions.first_name as student_firstname',
             'admissions.last_name as student_lastname',
             'admissions.id as student_id',
             'rolls.username as roll_no',
             'teachers.first_name  as teacher_firstname',
             'teachers.last_name  as teacher_lastname',
             'teachers.teacher_id',
             'classes.class_name',
             'classes.id as class_id',
             'courses.id as course_id',
             'courses.course_name')
    ->where('admissions.class_code',$class_id)
    ->get();

$attendance = Roll::join('admissions','admissions.id','=','rolls.student_id')
                   ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                    ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
                    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
                    ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
                    ->where('admissions.class_code',$class_id)
                    ->first();

    $attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
            ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
            ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
            ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
            ->join('courses', 'courses.id', '=', 'attendances.course_id')
            ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
             ->select(
                  'admissions.first_name as student_first_name',
                  'admissions.last_name as student_last_name',
                  'admissions.image',
                  'teachers.first_name as teacher_first_name',
                  'teachers.last_name as teacher_last_name',
                  'rolls.username as roll_no',
                  'courses.course_name',
                  'attendances.attendance_date',
                  'attendances.attendance_status',
                  'classes.class_name')
         ->where('attendances.attendance_date', $attend_date)
         ->get();

                    $tudents = $this->GetClass($request);
                    return view('attendances.attendance_list', compact('classes', 'students','attendance'))
                    ->with('attendances', $attendances);
}

public function SearchAttendanceByDate(Request $request)
{
    // $edited_date = $this->EditAttendance($request);
    $attend_date = $request->attendance_date;
    $classes = Classes::all();
    $attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
    ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
    ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
    ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
    ->join('courses', 'courses.id', '=', 'attendances.course_id')
    ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
     ->select(
          'admissions.first_name as student_first_name',
          'admissions.last_name as student_last_name',
          'admissions.image',
          'teachers.first_name as teacher_first_name',
          'teachers.last_name as teacher_last_name',
          'rolls.username as roll_no',
          'courses.course_name',
          'attendances.attendance_date',
          'attendances.attendance_status',
          'classes.class_name')
        //   'courses.course_name')
        ->where('attendances.attendance_date', $attend_date)
        ->get();

        return view('attendances.index')
        ->with('attendances', $attendances)->with('classes',$classes);

}

public function SearchAttendanceByRollNo(Request $request)
{

    $roll_no = $request->roll_no;
    $classes = Classes::all();
    $attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
    ->join('classes', 'classes.id', '=', 'attendances.class_id')
    ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
    ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
    ->join('courses', 'courses.id', '=', 'attendances.course_id')
    ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
     ->select(
          'admissions.first_name as student_first_name',
          'admissions.last_name as student_last_name',
          'admissions.image',
          'teachers.first_name as teacher_first_name',
          'teachers.last_name as teacher_last_name',
          'rolls.username as roll_no',
          'courses.course_name',
          'attendances.attendance_date',
          'attendances.attendance_status',
          'classes.class_name')
        //   'courses.course_name')
        ->where('attendances.student_id', $roll_no)
        ->get();

        return view('attendances.index')
        ->with('attendances', $attendances)->with('classes',$classes);

}

public function SearchAttendanceByClass(Request $request)
{

    $class_id = $request->class_id;
    $classes = Classes::all();
    $attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
    ->join('classes', 'classes.id', '=', 'attendances.class_id')
    ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
    ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
    ->join('courses', 'courses.id', '=', 'attendances.course_id')
    ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
     ->select(
          'admissions.first_name as student_first_name',
          'admissions.last_name as student_last_name',
          'admissions.image',
          'teachers.first_name as teacher_first_name',
          'teachers.last_name as teacher_last_name',
          'rolls.username as roll_no',
          'courses.course_name',
          'attendances.attendance_date',
          'attendances.attendance_status',
          'classes.class_name')
        //   'courses.course_name')
        ->where('attendances.class_id', $class_id)
        ->get();

        return view('attendances.index')
        ->with('attendances', $attendances)->with('classes',$classes);

}


    /**
     * Show the form for creating a new Attendance.
     *
     * @return Response
     */
    public function create()
    {
        return view('attendances.create');
    }

    /**
     * Store a newly created Attendance in storage.
     *
     * @param CreateAttendanceRequest $request
     *
     * @return Response
     */
    public function store(CreateAttendanceRequest $request)
    {
        $input = $request->all();
        // dd($input);die;

        $attendance = $this->attendanceRepository->create($input);

        Flash::success('Attendance saved successfully.');

        return redirect(route('attendances.index'));
    }


    public function InsertAttendanceClass(Request $request)
    {

        $student = $request->all();
        // dd($student);
        // echo "<pre>",print_r($student); die;

        $atten_date = $request->attendance_date;
        $atten_class = $request->class_id;
        $school_id = $request->school_id;

        // dd( $school_id,  $atten_class , $atten_date );

        $attendance_date = Attendance::where('attendance_date',$atten_date)
                                      ->where('class_id',$atten_class)
                                      ->where('school_id',$school_id)
                                      ->first();
            
    // echo "<pre>",print_r($attendance_date); die;
    // dd($attendance_date);
            if ($atten_class == '' && $request->school_id == '') {

                Flash::error('Please select class to proceed!' . $atten_class . 'and' . $request->school_id . '');
                return back();
            }
            
            if($attendance_date ) {

                Flash::error('Sorry , Today Attendance Already Taken, by this ' . $atten_date . 'and' . $atten_class . '');
                return back();
            }else{

                foreach ($request->student_id as $key => $markattendance) {

                    $insert_data[]=[
                        'student_id' => $markattendance,
                        'teacher_id' => $request->teacher_id,
                        'course_id' => $request->course_id,
                        'semester_id' => $request->semester_id,
                        'class_id' => $request->class_id,
                        'month' => $request->month,
                        'year' => $request->year,
                        'day' => $request->day,
                        'attendance_status' => $request->attendance_status[$markattendance],
                        'attendance_date' => $request->attendance_date,
                        'school_id' => $request->school_id,
                        'attendance_reason' => $request->attendance_reason[$markattendance]
                        
                    ];
                }

                Attendance::insert($insert_data);
                Flash::success('Attendance Marked Successfully!');
                return redirect(route('attendances.index'));
            }
        }

    public function EditAttendance($edit_date)
    {

        $edited_date = Attendance::where('attendance_date',$edit_date)->first();
        // dd($edit_date);

        $edit_attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
        ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
        ->join('courses', 'courses.id', '=', 'attendances.course_id')
        ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
         ->select(
              'admissions.first_name as student_first_name',
              'admissions.last_name as student_last_name',
              'admissions.image',
              'teachers.first_name as teacher_first_name',
              'teachers.last_name as teacher_last_name',
              'rolls.username as roll_no',
              'courses.course_name',
              'attendances.attendance_date',
              'attendances.attendance_status',
              'attendances.attendance_id',
              'classes.class_name')
            ->where('attendances.attendance_date', $edit_date)
            ->get();

            // dd($edit_attendances);

        return view('attendances.edit',compact('edited_date'))
        ->with('edit_attendances',$edit_attendances)
        ->with('edited_date',$edited_date);
    }

    public function UpdateAttendance(Request $request)
    {
        $student = $request->all();
        echo "<pre>",print_r($student); die;
        $attendance_date = $request->get('attendance_date');


                foreach ($request->attendance_id as $key => $id) {

                    $update_data=[
                        'attendance_status' => $request->attendance_status[$id],
                        'edit_date' => $request->attendance_date
                    ];
                    // echo "<pre>",print_r($update_data); die;
                    $attendance = Attendance::where(['attendance_id' =>$id])->first();
                    // dd($attendance);

                    $attendance->update($update_data);
                }

                Flash::success('Attendance Updated Successfully!');
                return redirect(route('attendances.index'));
            // }
    }

    public function AttendanceReport()
    {
        $classes = Classes::all();
       return view('attendances.attendance_report.report_list',compact('classes'));
    }

    public function ClassWiseAttendance(Request $request)
    {
        $class_id = $request->class_id;
        $month_date = $request->monthly_date;
        $classes = Classes::all();
        // dd($class_id);

        $classCount  = Attendance::where('class_id', $class_id)
        ->where('month', $month_date)->count();

        if($request->class_id !='' && $request->monthly_date !=''){
            $class_and_month =  Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
            ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
            ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
            ->join('faculties', 'faculties.faculty_id', '=', 'class_schedule.faculty_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
            ->join('courses', 'courses.id', '=', 'attendances.course_id')
            ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
            ->select(
               'admissions.first_name as student_first_name',
               'admissions.last_name as student_last_name',
               'admissions.image',
               'teachers.first_name as teacher_first_name',
               'teachers.last_name as teacher_last_name',
               'rolls.username as roll_no',
               'courses.course_name',
               'attendances.attendance_date',
               'attendances.attendance_status',
               'attendances.month',
               'attendances.year',
               'faculties.faculty_name',
               'classes.class_name')
             ->where('attendances.class_id', $class_id)
             ->where('attendances.month', $month_date)
         ->first();

            $class_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
            ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
            ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
            ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
            ->join('courses', 'courses.id', '=', 'attendances.course_id')
            ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
             ->select(
                  'admissions.first_name as student_first_name',
                  'admissions.last_name as student_last_name',
                  'admissions.image',
                  'teachers.first_name as teacher_first_name',
                  'teachers.last_name as teacher_last_name',
                  'rolls.username as roll_no',
                  'courses.course_name',
                  'attendances.attendance_date',
                  'attendances.attendance_status',
                  'attendances.month',
                  'classes.class_name')
                ->where('attendances.class_id', $class_id)
                ->where('attendances.month', $month_date)
                ->get();

                if ($classCount) {
                    
                $dompdf = PDF::loadview('attendances.attendance_report.modal.class.class_attendance_with_month',['class_attend'=> $class_attend,'class_and_month'=> $class_and_month]);
                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'portrait');

                // Output the generated PDF to Browser
                $dompdf->stream();

                return $dompdf->download('Class-Month-Attendance.pdf');
             }else 
             {
             Flash::error('No Report Found Under this ' .$class_id    .$month_date);
            return redirect()->back();
            }
            }

             elseif($request->class_id !='' && $request->monthly_date ==''){

                    $class_name =  Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
                    ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
                    ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
                    ->join('faculties', 'faculties.faculty_id', '=', 'class_schedule.faculty_id')
                    ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
                    ->join('courses', 'courses.id', '=', 'attendances.course_id')
                    ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
                    ->select(
                       'admissions.first_name as student_first_name',
                       'admissions.last_name as student_last_name',
                       'admissions.image',
                       'teachers.first_name as teacher_first_name',
                       'teachers.last_name as teacher_last_name',
                       'rolls.username as roll_no',
                       'courses.course_name',
                       'attendances.attendance_date',
                       'attendances.attendance_status',
                       'attendances.month',
                       'attendances.year',
                       'faculties.faculty_name',
                       'classes.class_name')
                     ->where('attendances.class_id', $class_id)
                    //  ->where('attendances.month', $month_date)
                 ->first();
                    // dd( $class_name );
                $class_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
                ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
                ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
                ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
                ->join('courses', 'courses.id', '=', 'attendances.course_id')
                ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
                 ->select(
                      'admissions.first_name as student_first_name',
                      'admissions.last_name as student_last_name',
                      'admissions.image',
                      'teachers.first_name as teacher_first_name',
                      'teachers.last_name as teacher_last_name',
                      'rolls.username as roll_no',
                      'courses.course_name',
                      'attendances.attendance_date',
                      'attendances.attendance_status',
                      'attendances.month',
                      'classes.class_name')
                    ->where('attendances.class_id',  $class_id)
                    ->get();
                 }

        if ($class_name) 
        {
                 // dd( $monthly_attend); die;
            $dompdf = PDF::loadview('attendances.attendance_report.modal.class.class_attendance',['class_attend'=> $class_attend,'class_name'=> $class_name]);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Output the generated PDF to Browser
            $dompdf->stream();

            return $dompdf->download('Class-Attendance.pdf');
        }
        else 
        {
        Flash::error('No Report Found Under this ' .$class_id);
        return redirect()->back();
        }
                   
    }


    public function MonthlyAttendance(Request $request)
    {
        $atten_date = $request->monthly_date;
        $atten_year = $request->yearly_date;
        // $class_id = $request->class_id;
        $classes = Classes::all();

        if($request->yearly_date != "" && $request->monthly_date !=''){
        $month_and_year =  Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
        ->join('faculties', 'faculties.faculty_id', '=', 'class_schedule.faculty_id')
        ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
        ->join('courses', 'courses.id', '=', 'attendances.course_id')
        ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
        ->select(
           'admissions.first_name as student_first_name',
           'admissions.last_name as student_last_name',
           'admissions.image',
           'teachers.first_name as teacher_first_name',
           'teachers.last_name as teacher_last_name',
           'rolls.username as roll_no',
           'courses.course_name',
           'attendances.attendance_date',
           'attendances.attendance_status',
           'attendances.month',
           'attendances.year',
           'faculties.faculty_name',
           'classes.class_name')
         ->where('attendances.month', $atten_date)
         ->where('attendances.year', $atten_year)
     ->first();

     $monthly_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
     ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
     ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
     ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
     ->join('courses', 'courses.id', '=', 'attendances.course_id')
     ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
      ->select(
           'admissions.first_name as student_first_name',
           'admissions.last_name as student_last_name',
           'admissions.image',
           'teachers.first_name as teacher_first_name',
           'teachers.last_name as teacher_last_name',
           'rolls.username as roll_no',
           'courses.course_name',
           'attendances.attendance_date',
           'attendances.attendance_status',
           'attendances.month',
           'classes.class_name')
         ->where('attendances.month', $atten_date)
         ->where('attendances.year', $atten_year)
         ->get();

         if ( $month_and_year) {
            $dompdf = PDF::loadview('attendances.attendance_report.modal.month.monthly_and_yearly_attendance',['monthly_attend'=> $monthly_attend,'month_and_year'=>$month_and_year]);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Output the generated PDF to Browser
        $dompdf->stream();

        return $dompdf->download('Monthly-and-Year-Attendance.pdf'); # code...
         }

         else 
         {
         Flash::error('No Report Found Under this ' .$atten_date .$atten_year);
         return redirect()->back();
         }

    }
    elseif ($request->yearly_date == "" && $request->monthly_date !="") {

        $month_name =  Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
        ->join('faculties', 'faculties.faculty_id', '=', 'class_schedule.faculty_id')
        ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
        ->join('courses', 'courses.id', '=', 'attendances.course_id')
        ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
        ->select(
           'admissions.first_name as student_first_name',
           'admissions.last_name as student_last_name',
           'admissions.image',
           'teachers.first_name as teacher_first_name',
           'teachers.last_name as teacher_last_name',
           'rolls.username as roll_no',
           'courses.course_name',
           'attendances.attendance_date',
           'attendances.attendance_status',
           'attendances.month',
           'attendances.year',
           'faculties.faculty_name',
           'classes.class_name')
         ->where('attendances.month', $atten_date)
        //  ->where('attendances.year', $atten_year)
        ->first();

            $monthly_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
            ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
            ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
            ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
            ->join('courses', 'courses.id', '=', 'attendances.course_id')
            ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
             ->select(
                  'admissions.first_name as student_first_name',
                  'admissions.last_name as student_last_name',
                  'admissions.image',
                  'teachers.first_name as teacher_first_name',
                  'teachers.last_name as teacher_last_name',
                  'rolls.username as roll_no',
                  'courses.course_name',
                  'attendances.attendance_date',
                  'attendances.attendance_status',
                  'attendances.month',
                  'classes.class_name')
                ->where('attendances.month', $atten_date)
                ->get();
         }
            if ( $month_name) {
                $dompdf = PDF::loadview('attendances.attendance_report.modal.month.monthly_attendance',['monthly_attend'=> $monthly_attend,'month_name'=>$month_name]);
                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'portrait');
    
                // Output the generated PDF to Browser
                $dompdf->stream();
    
                return $dompdf->download('Monthly-Attendance.pdf');
            }
            else 
            {
            Flash::error('No Report Found Under this ' .$atten_date );
            return redirect()->back();
            }

}

public function YearlyAttendance(Request $request)
{
    $class_id = $request->class_id;
    $atten_year = $request->yearly_date;
    // $class_id = $request->class_id;
    $classes = Classes::all();

    if($request->yearly_date != "" && $request->class_id !=''){
    $class_and_year =  Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
    ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
    ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
    ->join('faculties', 'faculties.faculty_id', '=', 'class_schedule.faculty_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
    ->join('courses', 'courses.id', '=', 'attendances.course_id')
    ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
    ->select(
       'admissions.first_name as student_first_name',
       'admissions.last_name as student_last_name',
       'admissions.image',
       'teachers.first_name as teacher_first_name',
       'teachers.last_name as teacher_last_name',
       'rolls.username as roll_no',
       'courses.course_name',
       'attendances.attendance_date',
       'attendances.attendance_status',
       'attendances.month',
       'attendances.year',
       'faculties.faculty_name',
       'classes.class_name')
     ->where('attendances.class_id', $class_id)
     ->where('attendances.year', $atten_year)
 ->first();

 $monthly_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
 ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
 ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
 ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
 ->join('courses', 'courses.id', '=', 'attendances.course_id')
 ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
  ->select(
       'admissions.first_name as student_first_name',
       'admissions.last_name as student_last_name',
       'admissions.image',
       'teachers.first_name as teacher_first_name',
       'teachers.last_name as teacher_last_name',
       'rolls.username as roll_no',
       'courses.course_name',
       'attendances.attendance_date',
       'attendances.attendance_status',
       'attendances.month',
       'classes.class_name')
     ->where('attendances.class_id', $class_id)
     ->where('attendances.year', $atten_year)
     ->get();

     if ($class_and_year) {
        $dompdf = PDF::loadview('attendances.attendance_report.modal.year.class_and_yearly_attendance',['monthly_attend'=> $monthly_attend,'class_and_year'=>$class_and_year]);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
    
        // Output the generated PDF to Browser
        $dompdf->stream();
    
        return $dompdf->download('Monthly-and-Year-Attendance.pdf');
     }
    else 
    {
    Flash::error('No Report Found Under this ' .$class_id  .$atten_year );
    return redirect()->back();
    }
   

}
elseif ($request->yearly_date != "" && $request->class_id =="") {

    $year_name =  Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
    ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
    ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
    ->join('faculties', 'faculties.faculty_id', '=', 'class_schedule.faculty_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
    ->join('courses', 'courses.id', '=', 'attendances.course_id')
    ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
    ->select(
       'admissions.first_name as student_first_name',
       'admissions.last_name as student_last_name',
       'admissions.image',
       'teachers.first_name as teacher_first_name',
       'teachers.last_name as teacher_last_name',
       'rolls.username as roll_no',
       'courses.course_name',
       'attendances.attendance_date',
       'attendances.attendance_status',
       'attendances.month',
       'attendances.year',
       'faculties.faculty_name',
       'classes.class_name')
     ->where('attendances.year', $atten_year)
    //  ->where('attendances.year', $atten_year)
    ->first();

        $yearly_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
        ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
        ->join('courses', 'courses.id', '=', 'attendances.course_id')
        ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
         ->select(
              'admissions.first_name as student_first_name',
              'admissions.last_name as student_last_name',
              'admissions.image',
              'teachers.first_name as teacher_first_name',
              'teachers.last_name as teacher_last_name',
              'rolls.username as roll_no',
              'courses.course_name',
              'attendances.attendance_date',
              'attendances.attendance_status',
              'attendances.month',
              'classes.class_name')
            ->where('attendances.year', $atten_year)
            ->get();
     }
     if ($year_name) {
        // dd( $monthly_attend); die;
        $dompdf = PDF::loadview('attendances.attendance_report.modal.year.yearly_attendance',['yearly_attend'=> $yearly_attend,'year_name'=>$year_name]);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Output the generated PDF to Browser
        $dompdf->stream();

        return $dompdf->download('Yearly-Attendance.pdf');
     }
     else 
     {
     Flash::error('No Report Found Under this ' .$class_id  .$atten_year );
     return redirect()->back();
     }
        
}

        /**
     * Display the specified Attendance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        return view('attendances.show')->with('attendance', $attendance);
    }

    /**
     * Show the form for editing the specified Attendance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        $edited_date = Attendance::where('attendance_date',$id)->first();

        return view('attendances.edit',compact('edited_date'))->with('attendance', $attendance);
    }

    /**
     * Update the specified Attendance in storage.
     *
     * @param int $id
     * @param UpdateAttendanceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttendanceRequest $request)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        $attendance = $this->attendanceRepository->update($request->all(), $id);

        Flash::success('Attendance updated successfully.');

        return redirect(route('attendances.index'));
    }

    /**
     * Remove the specified Attendance from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        $this->attendanceRepository->delete($id);

        Flash::success('Attendance deleted successfully.');

        return redirect(route('attendances.index'));
    }

    public function monthlyReport(Request $request)
    {
        $class        = $request->get('class', null);
        $section      = $request->get('section', null);
         $session      = trim($request->get('session', date('Y')));
        $shift        = $request->get('shift', null);
        $isPrint      = $request->get('print_view', null);
        $yearMonth    = $request->get('yearMonth', date('Y-m'));

        $classes2     = Classes::select('class_code', 'class_name')->orderby('class_code', 'asc')->get();
        //    if(!empty(FixData()['classes'])){
            //   dd($classes2 );      	
					//  $classes =FixData()['classes'];
					 $classes2  = Classes::select('class_name','class_code')->whereIn('class_code',$classes2)->orderBy('created_at', 'asc')->get();
            // }
            // dd($classes2 );   
        $section_data = Department::select('department_id','department_name')->where('department_id','=',$section)->first();
        if($isPrint) {

            $myPart   = mb_split('-', $yearMonth);

           
            if(count($myPart)!= 2) {

                FlashFlash::error('Error', 'Please don\'t mess with inputs!!!');
                // $errorMessages = new Illuminate\Support\MessageBag;
                // $errorMessages->add('Error', 'Please don\'t mess with inputs!!!');
                return redirect(url('/attendance/monthly-report'));
            }
            if($request->get('regiNo')==''){
              $students = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')->where('class_code', $class)
                // ->where('', 'Yes')
                // ->where('session' , $session)
                // ->where('shift'   , $shift)
                // ->where('section' , $section)
                //  ->lists('regiNo');
                ->pluck('rolls.username');
            }else{
                $students = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')->where('class_code', $class)
                // ->where('isActive', 'Yes')
                // ->where('session' , $session)
                // ->where('shift'   , $shift)
                // ->where('section' , $section)
                ->where('rolls.username' , $request->get('regiNo'))
                 //->lists('regiNo');
                ->pluck('rolls.username');
            }
            //     echo "<pre>";print_r($students->toArray());
            //    echo implode(',', $students->toArray());
            //   exit;
            if(empty($students)) {
               
                FlashFlash::error('Student Not Fund!!!');
                // $errorMessages = new Illuminate\Support\MessageBag;
                // $errorMessages->add('Error', 'Please don\'t mess with inputs!!!');
                return redirect(url('/attendance/monthly-report'));
            }


            //find request month first and last date
            $firstDate   = $yearMonth."-01";
            $oneMonthEnd = strtotime("+1 month", strtotime($firstDate));
            $lastDate    = date('Y-m-d', strtotime("-1 day", $oneMonthEnd));

            //get holidays of request month
            $holiDays = Holidays::where('status', 1)
                ->whereDate('holiDate', '>=', $firstDate)
                ->whereDate('holiDate', '<=', $lastDate)
                //->lists('status', 'holiDate');
                ->pluck('status', 'holiDate');
               //get holidays of request month
            
            $offDays = ClassOff::where('status', 1)
                ->whereDate('offDate', '>=', $firstDate)
                ->whereDate('offDate', '<=', $lastDate)
                //->lists('oType', 'offDate');
                ->pluck('oType', 'offDate');
                  //pluck
            //find fridays of requested month
            $fridays = [];
            $startDate = Carbon::parse($firstDate)->next(Carbon::SUNDAY); // Get the first friday.
            $endDate =   Carbon::parse($lastDate);

            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
                $fridays[$date->format('Y-m-d')] = 1;
            }

            //get class info
            $classInfo = Classes::where('class_code', $class)->first();
            $className = $classInfo->class_name;


            $SelectCol = self::getSelectColumns($myPart[0], $myPart[1]);
             //echo "<pre>";print_r($SelectCol);
             //exit;
            $fullSql   = "SELECT CONCAT(MAX(ad.first_name),' ',MAX(ad.father_name),' ',MAX(ad.last_name)) as name, 
             CAST(MAX(ad.id) as UNSIGNED) as student_id,".$SelectCol." FROM attendances as att left join admissions as ad ON att.student_id=ad.id  
             left join rolls as roll ON roll.student_id=ad.id";
            $fullSql .=" WHERE roll.username IN(".implode(',', $students->toArray()).") AND att.attendance_status !='Absent' GROUP BY att.student_id ORDER BY student_id;";
            $data = FacadesDB::select($fullSql);
                    //    return $data;
            //  echo "<pre>";print_r($data);
            //  exit;
             if(!empty($data)){
            	$keys = array_keys((array)$data[0]);
            	
        	}else{
        		$keys=array();
        	}
        	$type = $request->get('type');
            //            return $data;
        //    echo "<pre>";print_r($keys);
        //    dd($keys ); 
            $institute=Institute::select('*')->first();
            // dd($institute);
            if(empty($institute)) {

                
                FlashFlash::error('Please setup institute information!');
                // $errorMessages = new Illuminate\Support\MessageBag;
                // $errorMessages->add('Error', 'Please don\'t mess with inputs!!!');
                return redirect(url('/attendance/monthly-report'));

            }



            return View('attendances.attendance_report.monthly_attendance_report', compact('institute', 'data', 'keys', 'yearMonth', 'fridays', 'holiDays', 'className', 'section', 'session', 'shift', 'offDays','section_data','type'));
        }
        return View('attendances.attendance_report.report', compact('classes2','institute', 'data', 'keys', 'yearMonth', 'fridays', 'holiDays', 'className', 'section', 'session', 'shift', 'offDays','section_data','type'));
    }


    public function monthlyReport1(Request $request)
    {

        $class        = $request->get('class', null);
        $section      = $request->get('section', null);
         $session      = trim($request->get('session', date('Y')));
        $shift        = $request->get('shift', null);
        $isPrint      = $request->get('print_view', null);
        $yearMonth    = $request->get('yearMonth', date('Y-m'));

        if($isPrint) {

        $classInfo = Classes::where('class_code', $class)->first();
        $className = $classInfo->class_name;
        // dd($className);

        $institute=Institute::select('*')->first();
        // dd($institute);
        }

        $institute=Institute::select('*')->first();
        return view('attendances.attendance_report.report', compact('institute','class','shift',
                'yearMonth','className','isPrint'));
    }




    
    private static function getSelectColumns($year,$month)
    {
        $start_date = "01-".$month."-".$year;
        $start_time = strtotime($start_date);

        $end_time = strtotime("+1 month", $start_time);
        $selectCol = "";
        for($i=$start_time; $i<$end_time; $i+=86400)
        {
            $d = date('Y-m-d', $i);
            $selectCol .= "MAX(IF(attendance_date = '".$d."', 1, 0)) AS '".$d."',";
        }
        if(strlen($selectCol)) {
            $selectCol = substr($selectCol, 0, -1);
        }

        return $selectCol;
    }


}
