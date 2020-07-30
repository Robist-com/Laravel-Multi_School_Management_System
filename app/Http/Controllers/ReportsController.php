<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academic;
use App\Program;
use App\Shift;
use App\Time;
use App\Batch;
use App\Group;
use App\Student;
use App\Classroom;
use App\Teacher;
use App\Day;
use App\Status;
use DB;
use Charts;

class ReportsController extends Controller
{
    public function getStudentReportList()
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

        return view('report.student_report_list', compact('programs','teachers', 'classroom','days','academics', 'shift',
       'time', 'batch', 'group', 'student_id'));
    }

    public function showStudentInfo(Request $request)
    {
        $classes = $this->info()->select(DB::raw('students.student_id,
                    CONCAT(students.first_name," ", students.last_name) as name,
                    CONCAT(teachers.first_name," ", teachers.last_name) as teacher_name,
                    CONCAT(classes.start_date," - ", classes.end_date) as start_date,
                    (CASE WHEN students.sex=0 THEN "Male" ELSE "Female" END) as sex,
                        students.dob,
                        programs.program,
                        levels.level,
                        shifts.shift,
                        times.time,
                        batches.batch,
                        groups.group, 
                        classrooms.classroom_code,
                        days.days
                       
                   
                   '))
                    // ->where('classes.class_id', $class_id)
                    ->get();
        dd($classes);
        return view('report.student_info', compact('classes'));
    }

    public function info()
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

    public function getStudentMultiClassList()
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

        return view('report.student_multi_list_class', compact('programs', 'teachers','days','classroom', 'academics', 'shift',
        'time', 'batch', 'group', 'student_id'));
    }

    public function showStudentMultiClassList(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request['chk'])) {
                $classes = $this->info()->select(DB::raw('students.student_id,
                        CONCAT(students.first_name," ", students.last_name) as name,
                        CONCAT(teachers.first_name," ", teachers.last_name) as teacher_name,
                        (CASE WHEN students.sex=0 THEN "Male" ELSE "Female" END) as sex,
                        students.dob,
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

                return view('report.student_info_multi_class', compact('classes'));
            }
        }
    }

    public function getNewStudentRegister(Request $request)
    {
        $students = Student::where(DB::raw("(DATE_FORMAT(dateregistered,'%Y'))"), date('Y'))
                                        ->select('dateregistered AS created_at')->get();

        $chart = Charts::database($students, 'bar', 'highcharts')

                        ->title('Monthly new Register Student')

                        ->elementLabel('Total Students')

                        ->dimensions(1000, 500)

                        ->responsive(true)

                        ->groupByMonth(date('Y'), true);

        return view('report.newStudentRegister', compact('chart'));
    }
}