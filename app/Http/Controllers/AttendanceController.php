<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Repositories\AttendanceRepository;
use App\Http\Controllers\AppBaseController;
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
use App\Roll;
use PDF;
use DB;
class AttendanceController extends AppBaseController
{
    /** @var  AttendanceRepository */
    private $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepo)
    {
        $this->attendanceRepository = $attendanceRepo;
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
        $class_id = $request->class_id;
        $attend_date = date('d-m-Y');

        $edited_date = Attendance::where('attendance_date',$attend_date)->first();

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
        ->where('class_schedule.course_id',$class_id)
        ->get();
     $attendance = Roll::join('admissions','admissions.id','=','rolls.student_id')
                       ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                        ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
                        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
                        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
                        ->where('admissions.class_code',$class_id)
                        ->first();

        // if(Auth::user()->role_id < 3){
        // $attendances = $this->attendanceRepository->all();
        // }else
        // $attendances = Attendance::where('teacher_id', Auth::user()->id)->get();
        // $classes = $this->attendance($teacher_id)->get();
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
         ->where('attendances.attendance_date', $attend_date)
         ->get();
            //  dump($attendances); die;

                        $students = $this->GetClass($request);

        return view('attendances.index', compact('classes', 'students','attendance','edited_date'))
            ->with('attendances', $attendances);
    }

  public function GetClass(Request $request)
{
    $attendances = $this->attendanceRepository->all();
    $class_id = $request->class_id;
    $course_id = $request->course_id;
    $semester_id = $request->semester_id;
    $department_id = $request->department_id;

    $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
    ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
    ->where('admissions.class_code',$class_id)
    ->where('admissions.department_id',$department_id)
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
             'class_schedule.degree_id',
            'courses.course_name'
             )

    //->where('class_schedule.course_id',$course_id)
    ->get();
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

    return view('teachers.attendances.mark_attendance', compact( 'students','classes','attendance'))
    ->with('attendances', $attendances);
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
            $attend_date = date('d-m-Y');

            $input = $request->all();

            $teacher_id = Auth::user()->teacher_id;
            // dd( $input); die;

            $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
            ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
            ->join('semesters', 'semesters.id', '=', 'class_schedule.semester_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
            ->where('admissions.class_code',$class_id)
            ->where('class_schedule.class_id',$class_id)
            // ->where('class_schedule.teacher_id',$teacher_id)
            // ->where('class_schedule.course_id',$course_id)
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
            ->get();

            // dd( $students); die;


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
            compact( 'students','classes','class_name'))
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
        // echo "<pre>",print_r($student); die;

        $atten_date = $request->attendance_date;
        $atten_class = $request->class_id;

        $attendance_date = Attendance::join('classes', 'classes.id','=', 'attendances.class_id')
                                      ->where('attendances.attendance_date',$atten_date)
                                      ->where('attendances.class_id',$atten_class)->first();
            if ( $attendance_date) {

                Flash::error('Sorry , Today Attendance Already Taken, by this ' . $atten_date. ' and Class!');
                return redirect(route('attendances.index'));
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
                        'attendance_date' => $request->attendance_date
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
        // echo "<pre>",print_r($student); die;
        $attendance_date = $request->get('attendance_date');


                foreach ($request->attendance_id as $key => $id) {

                    $update_data=[
                        'attendance_status' => $request->attendance_status[$id],
                        'edit_date' => $request->attendance_date
                    ];
                    // echo "<pre>",print_r($update_data); die;
                    $attendance = Attendance::where(['attendance_id' =>$id, 'attendance_date' => $request->attendance_date])->first();
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
}
