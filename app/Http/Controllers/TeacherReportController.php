<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academic;
use App\Models\Admissions;
use App\Models\Day;
use App\Models\ClassAssigning;
use App\Models\Teacher; 
use App\Models\Batch;
use App\Models\Classes;
use App\Models\ClassRoom;
use App\Models\Course;
use App\Status;
use App\Models\Level;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Time;
use App\Models\ClassSchedule;

use DB;
use Validator;
use PDF;
use Charts;
use Flash;
use Response;


class TeacherReportController extends Controller
{

    public function construct()
    {
        $this->middleware('auth');
    }


    public function getTeacherReportList()
    {
        $programs = Program::all();
        $shift = Shift::all();
        $time = Time::all();
        $batch = Batch::all();
        $group = Group::all();
        $classroom = Classroom::all();
        $teachers = Teacher::all();
        $days = Day::all();
        $academics = Academic::orderBy('academic_id', 'DESC')->get();
        // $student_id = Student::max('student_id');

        return view('teacher-report.teacher_report_list', compact('programs','teachers', 'classroom','days','academics', 'shift',
       'time', 'batch', 'group', 'student_id'));
    }

    public function showteacherInfo(Request $request)
    {
        $classes = $this->info($request->class_id)->select(DB::raw('teachers.teacher_id,
                    CONCAT(teachers.first_name," ", teachers.last_name) as teacher_name,
                    CONCAT(classes.start_date," - ", classes.end_date) as start_date,
                    (CASE WHEN teachers.gender=0 THEN "Male" ELSE "Female" END) as sex,
                        teachers.dob,
                        programs.program,
                        levels.level,
                        shifts.shift,
                        times.time,
                        batches.batch,
                        groups.group,
                        classrooms.classroom_code,
                        days.days
                       
                   
                   '))
                    ->where('classes.class_id', $request->class_id)
                    ->get();

        return view('teacher-report.teacher_info', compact('classes'));
    }

    public function info($class_id)
    {
        return Status::join('classes', 'classes.class_id', '=', 'statuses.class_id')
                    ->join('students', 'students.student_id', '=', 'statuses.student_id')
                    ->join('levels', 'levels.level_id', '=', 'classes.level_id')
                    ->join('programs', 'programs.program_id', '=', 'levels.program_id')
                    ->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                    ->join('teachers', 'teachers.teacher_id', '=', 'classes.teacher_id')
                    ->join('days', 'days.day_id', '=', 'classes.day_id')
                    ->join('classrooms', 'classrooms.classroom_id', '=', 'classes.classroom_id')
                    ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                    ->join('times', 'times.time_id', '=', 'classes.time_id')
                    ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                    ->join('groups', 'groups.group_id', '=', 'classes.group_id');
    }

    //================================== multi student class list ================================

    public function getTeacherMultiClassList()
    {
        $programs = Course::all();
        $shift = Shift::all();
        $time = Time::all();
        $batch = Batch::all();
        // $group = Group::all();
        $classroom = Classroom::all();
        $teachers = Teacher::all();
        $days = Day::all();
        $academics = Academic::orderBy('academic_id', 'DESC')->get();
        // $student_id = Student::max('student_id');
            // dd($academics); die;
        return view('teachers.teacher-report.teacher_multi_list_class', compact('programs', 'teachers','days','classroom', 'academics', 'shift',
        'time', 'batch'));
    }

    public function showTeacherMultiClassList(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request['chk'])) {
                $classes = $this->info($request->class_id)->select(DB::raw('teachers.teacher_id,
                        CONCAT(students.first_name," ", students.last_name) as name,
                        CONCAT(teachers.first_name," ", teachers.last_name) as teacher_name,
                        (CASE WHEN teachers.gender=0 THEN "Male" ELSE "Female" END) as sex,
                        teachers.dob,
                        programs.program,
                        levels.level,
                        shifts.shift,
                        times.time,
                        batches.batch,
                        groups.group,
                        classrooms.classroom_code,
                        days.days
                            
                        '))
                        ->whereIn('classes.class_id', $request['chk'])
                        ->get();
                dd($classes); die;
                return view('teacher-report.teacher_info_multi_class', compact('classes'));
            }
        }
    }

    public function getNewTeacherRegister(Request $request)
    {
        $students = Teacher::where(DB::raw("(DATE_FORMAT(dateregistered,'%Y'))"), date('Y'))
                                        ->select('dateregistered AS created_at')->get();

        $chart = Charts::database($students, 'bar', 'highcharts')

                        ->title('Monthly new Register Teachers')

                        ->elementLabel('Total Teachers')

                        ->dimensions(1000, 500)

                        ->responsive(true)

                        ->groupByMonth(date('Y'), true);

        return view('teacher-report.newTeacherEnroll', compact('chart'));
    }
}