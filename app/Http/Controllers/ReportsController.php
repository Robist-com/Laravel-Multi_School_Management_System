<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academic;
use App\ClassOff;
use App\Program;
use App\Shift;
use App\Time;
use App\Group;
use App\Student;
use App\Classroom;
use App\Models\Admission;
use App\Models\Classes;
use App\Models\Batch;
use App\Models\Semester;
use App\Models\Transaction;
use App\Teacher;
use App\Day;
use App\Holidays;
use App\Institute;
use App\Roll;
use App\Status;
use App\InvoiceDetails;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\User;
use App\School;
use DB;
use Charts;
use Flash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;
use Laracasts\Flash\Flash as FlashFlash;

class ReportsController extends Controller
{

    public function construct()
    {
        $this->middleware('auth');
    }

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

    public function getstudentInormation(Request $request)
    {
        // $allstudentreport = Admission::all();
        // dd($allstudentreport);

        return view ('report.student.index');
    }

    public function getstudentReport(Request $request)
    {
        if(auth()->user()->group == "Owner"){
        $allstudentreport = Admission::where('school_id', auth()->user()->school_id)->get();
        $classes = Classes::where('school_id', auth()->user()->school_id)->get();
        $classstudentreport_single = Admission::where('school_id', auth()->user()->school_id)->first();
        
    }else{
        $allstudentreport = Admission::all();
        $classes = Classes::all();
        $classstudentreport_single = Admission::first();
    }

    return view ('report.student.index', compact('allstudentreport','classes','classstudentreport_single'));
}

    public function poststudentReport(Request $request)
    {
       if (auth()->user()->group == "Owner") {

                $allstudentreport = Admission::where('school_id', auth()->user()->school_id)->get();
                $classes = Classes::where('school_id', auth()->user()->school_id)->get();
                if ($request->class_id != "" && $request->gender == "" && $request->section == "") {
                    $classstudentreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
                }elseif ($request->class_id != "" && $request->gender != "" && $request->section == "")  {
                    $classstudentreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->where('class_code', $request->class_id)
                    ->where('gender', $request->gender)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
                }elseif ($request->class_id != "" && $request->gender == "" && $request->section != "")  {
                    $classstudentreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->where('class_code', $request->class_id)
                    ->where('department_id', $request->department)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
                }
                
                $classstudentreport_single = Admission::where('class_code', $request->class_id)->where('school_id', auth()->user()->school_id)->first();
        // dd($classstudentreport);

       }
       else {
                $allstudentreport = Admission::all();
                $classes = Classes::all();
                if ($request->class_id != ""  && $request->school_id != "" && $request->gender == "" && $request->section == "") {
                    $classstudentreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->get('school_id'))->get();
                }elseif ($request->class_id != "" && $request->school_id != "" && $request->gender != "" && $request->section == "")  {
                    $classstudentreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->where('class_code', $request->class_id)
                    ->where('gender', $request->gender)->where('acceptance', 'accept')->where('school_id', $request->get('school_id'))->get();
                }elseif ($request->class_id != "" && $request->school_id != "" && $request->gender == "" && $request->section != "")  {
                    $classstudentreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->where('class_code', $request->class_id)
                    ->where('department_id', $request->department)->where('acceptance', 'accept')->where('school_id', $request->get('school_id'))->get();
                }
                
                $classstudentreport_single = Admission::where('class_code', $request->class_id)->first();
       }
        return view ('report.student.index', compact('allstudentreport','classes','classstudentreport','classstudentreport_single'));
        // return redirect(route('getstudentInormation'))->with('allstudentreport',$allstudentreport);
    }

    public function getguadianReport(Request $request)
    {
        if (auth()->user()->group == "Owner") {
            $studentguidianreport = Admission::where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
            $classes = Classes::where('school_id', auth()->user()->school_id)->get();
        }else {
            $studentguidianreport = Admission::where('acceptance', 'accept')->get();
            $classes = Classes::all();
        }

        return view ('report.student.index', compact('studentguidianreport','classes'));
    }

    public function poststudentguadianReport(Request $request)
    {
        if (auth()->user()->group == "Owner") {
            $studentguidianreport = Admission::where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
            $classes = Classes::where('school_id', auth()->user()->school_id)->get();

            $poststudentguidianreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
            ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
            // dd($poststudentguidianreport);
            $classstudentreport_single = Admission::where('class_code', $request->class_id)->where('school_id', auth()->user()->school_id)->first();
        }else {
            $studentguidianreport = Admission::where('acceptance', 'accept')->get();
            $classes = Classes::all();

            $poststudentguidianreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
            ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();
            // dd($poststudentguidianreport);
            $classstudentreport_single = Admission::where('class_code', $request->class_id)->where('school_id', $request->school_id)->first();
        }

        return view ('report.student.index', compact('poststudentguidianreport','studentguidianreport','classes','classstudentreport_single'));
    }


    public function getstudenthistoryReport(Request $request)
    {
        if (auth()->user()->group == "Owner") {
            $studenthistoryreport = Admission::where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
            $classes = Classes::where('school_id', auth()->user()->school_id)->get();
            $batches = Batch::where('school_id', auth()->user()->school_id)->get();
        }else {
            $studenthistoryreport = Admission::where('acceptance', 'accept')->get();
            $classes = Classes::all();
            $batches = Batch::all();
        }
        // dd($allstudentreport);
        return view ('report.student.index', compact('studenthistoryreport', 'classes','batches'));
    }

    
    public function poststudenthistoryReport(Request $request)
    {
        if (auth()->user()->group == "Owner") {
            $studenthistoryreport = Admission::where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
            $classes = Classes::where('school_id', auth()->user()->school_id)->get();
            $batches = Batch::where('school_id', auth()->user()->school_id)->get();

            if ($request->class_id != ""  && $request->batch_id == "") {
                $poststudenthistoryreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                ->join('batches', 'batches.id', '=', 'admissions.batch_id')
                ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                ->where('classes.class_code', $request->class_id)
                ->where('admissions.school_id', auth()->user()->school_id)
                ->get();
            }
            elseif($request->class_id != ""  && $request->batch_id != "") {
                $poststudenthistoryreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                ->join('batches', 'batches.id', '=', 'admissions.batch_id')
                ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                ->where('classes.class_code', $request->class_id)
                ->where('admissions.school_id', auth()->user()->school_id)
                ->get();

                $classstudentreport_single = Admission::where('class_code', $request->class_id)->where('batch_id', $request->batch_id)
                ->where('admissions.school_id', auth()->user()->school_id)->first();
            }
            else 
            {
                Flash::error('class field is Required');
                return back();
            }
        }else {
            $studenthistoryreport = Admission::where('acceptance', 'accept')->get();
            $classes = Classes::all();
            $batches = Batch::all();

            if ($request->class_id != "" && $request->batch_id == "" && $request->school_id != "") {
                $poststudenthistoryreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                ->join('batches', 'batches.id', '=', 'admissions.batch_id')
                ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                ->where('classes.class_code', $request->class_id)
                ->where('admissions.school_id', $request->school_id)
                ->get();
            }
            elseif($request->class_id != "" && $request->batch_id != "" && $request->school_id != "") {
                $poststudenthistoryreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                ->join('batches', 'batches.id', '=', 'admissions.batch_id')
                ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                ->where('classes.class_code', $request->class_id)
                ->where('admissions.school_id', $request->school_id)
                ->get();

                $classstudentreport_single = Admission::where('class_code', $request->class_id)->where('batch_id', $request->batch_id)
                ->where('admissions.school_id', $request->school_id)->first();
            }
            else 
            {
                Flash::error('class field is Required');
                return back();
            }
        }
        
        // dd($poststudenthistoryreport);

        return view ('report.student.index', compact('poststudenthistoryreport','studenthistoryreport','classes','classstudentreport_single','batches'));
    }
       

    public function getstudentLogindetailReport(Request $request)
    {
        if (auth()->user()->group == "Owner") {
            $studentlogindetailreport = Admission::where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
            $classes = Classes::where('school_id', auth()->user()->school_id)->get();
        }else {
            $studentlogindetailreport = Admission::where('acceptance', 'accept')->get();
            $classes = Classes::all();
        }
        

        return view ('report.student.index', compact('studentlogindetailreport','classes'));
    }

    public function poststudentLoginDetailReport(Request $request)
    {
        if (auth()->user()->group == "Owner") {
            $studentlogindetailreport = Admission::where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();
            $classes = Classes::where('school_id', auth()->user()->school_id)->get();

            $poststudentlogindetailreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
            ->where('class_code', $request->class_id)->where('acceptance', 'accept')
            ->where('school_id', auth()->user()->school_id)->get();
            // dd($poststudentguidianreport);
            $classstudentreport_single = Admission::where('class_code', $request->class_id)->first();

        }else {

            $studentlogindetailreport = Admission::where('acceptance', 'accept')->get();
            $classes = Classes::all();
            $poststudentlogindetailreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
            ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->student_id)->get();
            // dd($poststudentguidianreport);
            $classstudentreport_single = Admission::where('class_code', $request->class_id)->first();
        }
       

        return view ('report.student.index', compact('poststudentlogindetailreport','studentlogindetailreport','classes','classstudentreport_single'));
    }


    public function getadmissionReport(Request $request)
    {
        $studentacademicreport = Admission::where('acceptance', 'accept')->get();
        $admissionReport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->get();


        return view ('report.student.index', compact('studentacademicreport', 'admissionReport'));
    }

    public function postadmissionReport(Request $request)
    {

        // dd($request->all());
        if (auth()->user()->group == "Owner") {
            $studentacademicreport = Admission::where('acceptance', 'accept')->where('school_id', auth()->user()->school_id)->get();

            if ($request->admission_date != '' ) 
            {
                $admissionReport =  Admission::whereDate('admissions.created_at', '>', $request->admission_date)
                                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                                    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                                    ->join('batches', 'batches.id', '=', 'admissions.batch_id')
                                    ->where('acceptance', 'accept')
                                    ->where('admissions.school_id', auth()->user()->school_id)->get();
            }
            else
            {
               Flash::error('Admission Date is required');
                
            }
        }else {
            $studentacademicreport = Admission::where('acceptance', 'accept')->get();

            if ($request->admission_date != '' && $request->school_id != '') 
            {
                $admissionReport =  Admission::whereDate('admissions.created_at', '>=', $request->admission_date)
                                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                                    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                                    ->join('batches', 'batches.id', '=', 'admissions.batch_id')
                                    ->where('acceptance', 'accept')
                                    ->where('admissions.school_id', $request->school_id)->get();

                                    // dd($admissionReport);
            }
            else
            {
               Flash::error('Admission Date is required');
                
            }
        }
           
        

        return view ('report.student.index', compact('admissionReport','studentacademicreport'));
    }

    // Finance Report section

    public function getFinance(Request $request)
    {
 

        return view ('report.finance.index');
    }

    public function Finance(Request $request)
    {
        
        return view ('report.finance.index');
    }

    public function gettransactionsReport(Request $request)
    {
        $transctions = Transaction::all();
        $classes = Classes::all();
        if(auth()->user()->group == 'Owner'){
            $semesters = Semester::where('status', 'on')->where('school_id', auth()->user()->school_id)->get();

            $student_roll = Roll::join('admissions', 'admissions.id', '=', 'rolls.student_id')
                    ->select(DB::raw('username,
                    CONCAT(admissions.first_name," ", admissions.last_name) as full_name'))
                    ->where('admissions.school_id', auth()->user()->school_id)
                    ->get();

                    // dd($student_roll);
        }else {
           $semesters = Semester::where('status', 'on')->where('school_id', $request->school_id)->get();
        }
        
        $poststudentlogindetailreport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->get();
        // dd($poststudentguidianreport);

        
        
        return view ('report.finance.index', compact('transctions','semesters', 'classes','student_roll'));
    }

    public function posttransactionsReport(Request $request)
    {
        $transactions = Transaction::all();
        $semesters = Semester::where('status', 'on')->get();
                $classes = Classes::all();
                $semester_id = $request->get('semester_id');
                $class_code = $request->get('class_code');
                $roll_no_transaction = $request->get('roll_no_transaction');
                $school_id = $request->get('school_id');
                $data = '';
               
               if ($request->ajax()) {
                
                if ($request->roll_no_transaction != "" && $request->school_id != "")
                {
                    $data =  InvoiceDetails::
                                    join('invoices', 'invoices.id', 'invoice_details.invoice_id')
                                    ->join('admissions', 'admissions.id', '=', 'invoice_details.student_id')
                                    ->join('transactions', 'transactions.transaction_id', '=', 'invoice_details.transaction_id')
                                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
                                    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                                    ->join('levels', 'levels.id', '=', 'admissions.degree_id')
                                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                                    ->join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.semester_fee_id')
                                    ->select('users.name', 
                                    'admissions.id as student_id',
                                    'admissions.first_name',
                                    'admissions.last_name',
                                    'fee_structures.semesterFee as school_fee',
                                    'fee_structures.fee_type',
                                    'student_fees.amount as student_fee',
                                    'classes.class_code',
                                    'semesters.semester_name',
                                    'semesters.id as semester_id',
                                    'levels.level',
                                    'invoices.id as invoice_id',
                                    'rolls.username',
                                    'transactions.transaction_date',
                                    'transactions.balance',
                                    'transactions.transaction_id',
                                    'transactions.paid_amount as paid_amount')
                                    // ->GroupBy('transactions.transaction_id')
                                  ->where('rolls.username', $roll_no_transaction)
                                  ->where('admissions.school_id',$school_id)
                                  ->get();
                                //   dd($data);
                                  if(count($data)=="0"){
                                    return response()->json(['message' => 'No Tranactions Found Under This Roll Number ' . $roll_no_transaction . '']);
                                     return back();
                                    }

                }
                elseif($request->class_code != '' && $request->semester_id != '' && $request->school_id != "")
                {
                    $data =  InvoiceDetails::
                                    join('invoices', 'invoices.id', 'invoice_details.invoice_id')
                                    ->join('admissions', 'admissions.id', '=', 'invoice_details.student_id')
                                    ->join('transactions', 'transactions.transaction_id', '=', 'invoice_details.transaction_id')
                                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
                                    ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                                    ->join('levels', 'levels.id', '=', 'admissions.degree_id')
                                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                                    ->join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.semester_fee_id')
                                    ->select('users.name', 
                                    'admissions.id as student_id',
                                    'admissions.first_name',
                                    'admissions.last_name',
                                    'fee_structures.semesterFee as school_fee',
                                    'fee_structures.fee_type',
                                    'student_fees.amount as student_fee',
                                    'classes.class_code',
                                    'semesters.semester_name',
                                    'semesters.id as semester_id',
                                    'levels.level',
                                    'invoices.id as invoice_id',
                                    'rolls.username',
                                    'transactions.transaction_date',
                                    'transactions.balance',
                                    'transactions.paid_amount as paid_amount')
                                ->where('admissions.class_code', $class_code)
                                  ->where('admissions.semester_id',$semester_id)
                                  ->where('admissions.school_id',$school_id)
                                ->get();

                                if(count($data)=="0"){
                                    return response()->json(['message' => 'No Tranactions Found Under Grade ' . $semester_id . ' and Class ' . $class_code. '']);
                                     return back();
                                    }
                            
                }
                if ($roll_no_transaction != '') {
                    $total_balance = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->where('rolls.username', $roll_no_transaction)->select(
                        DB::raw('SUM(transactions.balance) AS total_balance'))
                    ->get();

                    $total_paid = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->where('rolls.username', $roll_no_transaction)->select(
                        DB::raw('SUM(transactions.paid_amount) AS total_paid'))
                    ->get();

                    $total_fee = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->where('rolls.username', $roll_no_transaction)->select(
                        DB::raw('SUM(fee_structures.semesterFee) AS total_fee'))
                    ->get();
                }else
                {
                    $total_balance = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    // ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->where('admissions.class_code', $class_code)
                    ->where('admissions.semester_id',$semester_id)
                    ->select(
                        // DB::raw('SUM(transactions.paid_amount) AS total_paid'), 
                        // DB::raw('SUM(fee_structures.semesterFee) AS total_fee'), 
                        DB::raw('SUM(transactions.balance) AS total_balance'))
                    ->get();

                    $total_paid = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->where('admissions.class_code', $class_code)
                    ->where('admissions.semester_id',$semester_id)
                    ->select(
                        DB::raw('SUM(transactions.paid_amount) AS total_paid'))
                    ->get();

                    $total_fee = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->where('admissions.class_code', $class_code)
                    ->where('admissions.semester_id',$semester_id)
                    ->select(
                        DB::raw('SUM(fee_structures.semesterFee) AS total_fee'))
                    ->get();
                }
                
                $total_balance =$total_balance->sum('total_balance');
                $total_paid =$total_paid->sum('total_paid');
                $total_fee =$total_fee->sum('total_fee');
                // $total_balance_classwise =$total_balance_classwise->sum('total_balance');

                // dd( $total_balance1);
    
                $rolls = Roll::where('username', $roll_no_transaction)->get();

                $student_roll = Roll::join('admissions', 'admissions.id', '=', 'rolls.student_id')
                    ->select(DB::raw('username,
                    CONCAT(admissions.first_name," ", admissions.last_name) as full_name'))
                    ->where('admissions.school_id',$request->school_id)
                    ->get();

                $view = view('report.finance.transaction')
                                    // ->with('readStudentFee', $readStudentFee)
                                    ->with('data', $data )->with('semesters', $semesters )
                                    // ->with('readStudentTransaction', $readStudentTransaction)
                                    ->with('student_roll', $student_roll)
                                    ->with('rolls', $rolls)
                                    ->with('total_balance', $total_balance)
                                    ->with('total_paid', $total_paid)
                                    ->with('total_fee', $total_fee)
                                    // ->with('total_balance_classwise', $total_balance_classwise)
                                    ->with('classes', $classes)
                                    ->with('transactions', $transactions)->render();

        return response($view);
    }  
}

    public function getSchoolInfo(Request $request)
    {
        if ($request->ajax()) {

            
            // return response(Semester::where('school_id',$request->school_id)->where('status', 'on')
            // ->get());

            
            $grades = Semester::select('id','semester_name','semester_code')->where('school_id',$request->school_id)->where('status', 'on')->orderby('semester_name','asc')->get();
            return $grades;

            // echo json_decode(FacadesDB::table('semesters')->where('school_id',$request->school_id)->where('status', 'on')
            // ->get());

        }
    }

    public function getGradeRelatedClass(Request $request)
    {
        if ($request->ajax()) {
            return response(Classes::where('grade_id',$request->grade_id)
            ->get());
        }
    }

    public function getSchoolRelatedClass(Request $request)
    {
        if ($request->ajax()) {
            return response(Classes::where('grade_id',$request->grade_id)
            ->get());
        }
    }

    public function getSchoolRelatedStudent(Request $request)
    {
        if ($request->ajax()) {
            return response(Roll::join('admissions', 'admissions.id', '=', 'rolls.student_id')
            ->select(DB::raw('username,
            CONCAT(admissions.first_name," ", admissions.last_name) as full_name'))
            ->where('admissions.school_id',$request->school_id)
            ->get());
        }
    }

    public function getSchoolRelatedStaff(Request $request)
    {
        if ($request->ajax()) {
            return response(User::where('school_id',$request->school_id)
            ->get());
        }
    }

    public function attendanceinfo()
    {

        return InvoiceDetails::
        join('invoices', 'invoices.id', 'invoice_details.invoice_id')
        ->join('admissions', 'admissions.id', '=', 'invoice_details.student_id')
        ->join('transactions', 'transactions.transaction_id', '=', 'invoice_details.transaction_id')
        ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
        ->join('levels', 'levels.id', '=', 'admissions.degree_id')
        ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->join('departments', 'departments.department_id', '=', 'admissions.department_id')
        ->join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.semester_fee_id');
    }


    public function getbalanceReport(Request $request)
    {
        $transctions_balance = Transaction::where('school_id', $request->school_id)->get();
        // $classes = Classes::all();
        if(auth()->user()->group == 'Owner'){
            $semesters = Semester::where('status', 'on')->where('school_id', auth()->user()->school_id)->get();
            $classes = Semester::where('school_id', auth()->user()->school_id)->get();
        }else {
           $semesters = Semester::where('status', 'on')->where('school_id', $request->school_id)->get();
           $classes = Semester::where('school_id', $request->school_id)->get();
        }
        
        $poststudentbalancereport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();
        // dd($poststudentguidianreport);

        $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('rolls.username', $request->roll_no)->select(
            // DB::raw('SUM(income) AS total_income'), 
            // DB::raw('SUM(outgoings) AS total_outgoings'), 
            DB::raw('SUM(balance) AS total_balance')
        )
        ->get();


    $students = Roll::join('admissions','admissions.id', '=', 'rolls.student_id')->get();
        
        return view ('report.finance.index', compact('transctions_balance','semesters', 'classes','poststudentbalancereport'))
        ->with('students', $students);
    }


    public function poststudentbalanceReport(Request $request)
    {
        
        $transctions_balance = Transaction::all();
        $semesters = Semester::where('school_id', $request->school_id)->where('status', 'on')->get();
                $classes = Classes::where('school_id', $request->school_id)->get();
                $semester_id = $request->get('semester_id');
                $class_code = $request->get('class_code');
                $roll_no_balance = $request->get('roll_no_balance');
                $data_balance = '';



        $poststudentbalancereport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();

                $students = Roll::join('admissions','admissions.id', '=', 'rolls.student_id')
                ->where('school_id', $request->school_id)->get();

                

                // dd($students);
            
            //    if ($request->ajax()) {
                
                if ($request->roll_no_balance != "" && $request->school_id != "")
                {

                    $data_balance = $this->attendanceinfo()->select(DB::raw('users.name,
                    CONCAT(admissions.first_name," ", admissions.last_name) as full_name,
                    admissions.id as student_id,
                    fee_structures.semesterFee as school_fee,
                    fee_structures.fee_type,
                    student_fees.amount as student_fee,
                    classes.class_code,
                    semesters.semester_name,
                    semesters.id as semester_id, 
                    levels.level,
                    invoices.id as invoice_id,
                    rolls.username,
                    transactions.transaction_date,
                    transactions.balance,
                    transactions.transaction_id,
                    transactions.paid_amount as paid_amount
                '))->where('rolls.username', $roll_no_balance)
                    ->where('transactions.school_id', $request->school_id)
                    ->where('transactions.balance', '!=', 0)
                    // ->Groupby('transactions.student_id')
                        ->get();

                                    // dd($total_balance1);

                                //   dd($data);
                    if(count($data_balance)=="0"){
                        // FlashFlash::error('No Tranactions Found Under This Roll Number ' . $roll_no . '');
                    return response()->json(['message' => 'No Tranactions Found Under This Roll Number ' . $roll_no_balance . '']);
                        return back();
                    }

                                
                }
                elseif($request->class_code != '' && $request->school_id != '')
                {
                    $data_balance = $this->attendanceinfo()->select(DB::raw('users.name,
                    CONCAT(admissions.first_name," ", admissions.last_name) as full_name,
                    admissions.id as student_id,
                    fee_structures.semesterFee as school_fee,
                    fee_structures.fee_type,
                    student_fees.amount as student_fee,
                    classes.class_code,
                    classes.class_name,
                    semesters.semester_name,
                    semesters.id as semester_id, 
                    levels.level,
                    invoices.id as invoice_id,
                    rolls.username,
                    transactions.transaction_date,
                    transactions.balance,
                    transactions.transaction_id,
                    transactions.paid_amount as paid_amount
                '))->where('classes.class_code', $class_code)
                    ->where('transactions.school_id', $request->school_id)
                    ->where('transactions.balance', '!=', 0)
                    ->get();

                

                if(count($data_balance)=="0"){
                    return response()->json(['message' => 'No Tranactions Found Under Grade ' . $semester_id . ' and Class ' . $class_code. '']);
                        return back();
                    }
                            
                }

                if ($roll_no_balance != '') {

                $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('rolls.username', $request->roll_no_balance)
                    ->where('transactions.school_id', $request->school_id)
                    ->where('transactions.balance', '!=', 0)->select(
                        DB::raw('SUM(semesterFee) AS total_schoolFee'), 
                        DB::raw('SUM(paid_amount) AS total_outgoings'), 
                        DB::raw("SUM(balance) AS total_balance"))->get();

                }elseif($class_code != '' && $request->school_id != '') {
                    $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('admissions.class_code', $class_code)
                    ->where('transactions.balance', '!=', 0)
                    ->where('transactions.school_id', $request->school_id)
                    ->select(
                        DB::raw('SUM(semesterFee) AS total_schoolFee'), 
                        DB::raw('SUM(paid_amount) AS total_outgoings'), 
                        DB::raw("SUM(balance) AS total_balance"))->get();
                }



                $rolls = Roll::where('username', $roll_no_balance)->get();

                $view = view('report.finance.index')
                                    // ->with('readStudentFee', $readStudentFee)
                                    ->with('data_balance', $data_balance )->with('semesters', $semesters )
                                    ->with('poststudentbalancereport', $poststudentbalancereport)
                                    ->with('students', $students)
                                    ->with('rolls', $rolls)
                                    ->with('total_balance1', $total_balance1)
                                    ->with('classes', $classes)
                                    ->with('semesters', $semesters)
                                    ->with('transctions_balance', $transctions_balance)->render();

        return response($view);
    // }  
    }


    public function getfee_statementReport(Request $request)
    {
        $transctions_feestatement = Transaction::where('school_id', $request->school_id)->get();
        $classes = Classes::all();
        if(auth()->user()->group == 'Owner'){
            $semesters = Semester::where('status', 'on')->where('school_id', auth()->user()->school_id)->get();
        }else {
           $semesters = Semester::where('status', 'on')->where('school_id', $request->school_id)->get();
        }
        
        $poststudentbalancereport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();

        $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('rolls.username', $request->roll_no)->select(
                    DB::raw('SUM(balance) AS total_balance'))->get();

        $students = Roll::join('admissions','admissions.id', '=', 'rolls.student_id')->get();
        
        return view ('report.finance.index', compact('transctions_feestatement','semesters', 'classes','poststudentbalancereport'))
        ->with('students', $students);

       return view('report.finance.index');
    }

    public function postfee_statementReport(Request $request)
    {
        $transctions_feestatement = Transaction::all();
        $semesters = Semester::where('school_id', $request->school_id)->where('status', 'on')->get();
                $classes = Classes::where('school_id', $request->school_id)->get();
                $semester_id = $request->get('semester_id');
                $class_code = $request->get('class_code');
                $roll_no_feestatement = $request->get('roll_no_feestatement');
                $data_feestatement = '';


                $poststudentbalancereport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();

                $students = Roll::join('admissions','admissions.id', '=', 'rolls.student_id')
                ->where('school_id', $request->school_id)->get();

                $student_detail = Roll::join('admissions', 'admissions.id', '=', 'rolls.student_id')
                        ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
                        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                        ->join('levels', 'levels.id', '=', 'admissions.degree_id')
                        ->join('departments', 'departments.department_id', '=', 'admissions.department_id')
                        ->select(DB::raw('admissions.id as student_id,
                        CONCAT(admissions.first_name," ", admissions.last_name) as full_name,
                        admissions.image as image,
                        admissions.father_name,
                        classes.class_code,
                        classes.class_name,
                        semesters.semester_name,
                        semesters.id as semester_id, 
                        levels.level,
                        departments.department_name,
                        rolls.username
                        '))->where('rolls.username', $roll_no_feestatement)
                        ->where('admissions.school_id', $request->school_id)->get();

                // dd($student_detail);
            
            //    if ($request->ajax()) {
                
                if ($request->roll_no_feestatement != "" && $request->school_id != "")
                {

                    $data_feestatement = $this->attendanceinfo()->select(DB::raw('users.name,
                    CONCAT(admissions.first_name," ", admissions.last_name) as full_name,
                    admissions.id as student_id,
                    fee_structures.semesterFee as school_fee,
                    fee_structures.fee_type,
                    student_fees.amount as student_fee,
                    classes.class_code,
                    classes.class_name,
                    semesters.semester_name,
                    semesters.id as semester_id, 
                    levels.level,
                    invoices.id as invoice_id,
                    rolls.username,
                    transactions.transaction_date,
                    transactions.balance,
                    transactions.mood,
                    transactions.description,
                    transactions.status,
                    transactions.transaction_id,
                    transactions.paid_amount as paid_amount
                '))->where('rolls.username', $roll_no_feestatement)
                    ->where('transactions.school_id', $request->school_id)
                    // ->where('transactions.balance', '!=', 0)
                    // ->Groupby('transactions.student_id')
                        ->get();

                        // dd( $data_feestatement);

                    if(count($data_feestatement)=="0"){
                        // FlashFlash::error('No Tranactions Found Under This Roll Number ' . $roll_no . '');
                    return response()->json(['message' => 'No Tranactions Found Under This Roll Number ' . $roll_no_feestatement . '']);
                        return back();
                    }

                                
                }
                elseif($request->class_code != '' && $request->school_id != '')
                {
                    $data_feestatement = $this->attendanceinfo()->select(DB::raw('users.name,
                    CONCAT(admissions.first_name," ", admissions.last_name) as full_name,
                    admissions.id as student_id,
                    fee_structures.semesterFee as school_fee,
                    fee_structures.fee_type,
                    student_fees.amount as student_fee,
                    classes.class_code,
                    classes.class_name,
                    semesters.semester_name,
                    semesters.id as semester_id, 
                    levels.level,
                    invoices.id as invoice_id,
                    rolls.username,
                    transactions.transaction_date,
                    transactions.balance,
                    transactions.mood,
                    transactions.description,
                    transactions.transaction_id,
                    transactions.paid_amount as paid_amount
                '))->where('classes.class_code', $class_code)
                    ->where('transactions.school_id', $request->school_id)
                    ->where('transactions.balance', '!=', 0)
                    ->get();

                

                if(count($data_feestatement)=="0"){
                    return response()->json(['message' => 'No Tranactions Found Under Grade ' . $semester_id . ' and Class ' . $class_code. '']);
                        return back();
                    }
                            
                }

                if ($roll_no_feestatement != '') {

                $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('rolls.username', $request->roll_no_feestatement)
                    ->where('transactions.school_id', $request->school_id)
                    // ->where('transactions.balance', '!=', 0)
                    ->select(
                        DB::raw('SUM(semesterFee) AS total_schoolFee'), 
                        DB::raw('SUM(paid_amount) AS total_outgoings'), 
                        DB::raw("SUM(balance) AS total_balance"))->get();

                }elseif($class_code != '' && $request->school_id != '') {
                    $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('admissions.class_code', $class_code)
                    // ->where('transactions.balance', '!=', 0)
                    ->where('transactions.school_id', $request->school_id)
                    ->select(
                        DB::raw('SUM(semesterFee) AS total_schoolFee'), 
                        DB::raw('SUM(paid_amount) AS total_outgoings'), 
                        DB::raw("SUM(balance) AS total_balance"))->get();
                }

                $rolls = Roll::where('username', $roll_no_feestatement)->get();

                $view = view('report.finance.index')
                                    // ->with('readStudentFee', $readStudentFee)
                                    ->with('data_feestatement', $data_feestatement )->with('semesters', $semesters )
                                    ->with('poststudentbalancereport', $poststudentbalancereport)
                                    ->with('students', $students)
                                    ->with('rolls', $rolls)
                                    ->with('total_balance1', $total_balance1)
                                    ->with('classes', $classes)
                                    ->with('semesters', $semesters)
                                    ->with('student_detail', $student_detail )
                                    ->with('transctions_feestatement', $transctions_feestatement)->render();

        return response($view);
    // }  
    }


    public function getfee_collectionReport(Request $request)
    {
        $transctions_feecollection = Transaction::where('school_id', $request->school_id)->get();
        $classes = Classes::all();
        if(auth()->user()->group == 'Owner'){
            $semesters = Semester::where('status', 'on')->where('school_id', auth()->user()->school_id)->get();
        }else {
           $semesters = Semester::where('status', 'on')->where('school_id', $request->school_id)->get();
        }
        
        
        $poststudentbalancereport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();

        $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('rolls.username', $request->roll_no)->select(
                    DB::raw('SUM(balance) AS total_balance'))->get();

                    $users = User::all();
        
        return view ('report.finance.index', compact('transctions_feecollection','semesters', 'classes','poststudentbalancereport'))
        ->with('users', $users);

       return view('report.finance.index');
    }

    public function postfee_collectionReport(Request $request)
    {
        $transctions_feecollection = Transaction::all();
        $users = User::all();
        $user_name = User::where('id', $request->user_id)->first();
                
                // dd($request->all());

                if($request->user_id != '' && $request->school_id != '' && $request->group_by != '' && $request->type_id != '') 
                {

                    $data_collection = $this->attendanceinfo()->select(DB::raw('users.name,
                    CONCAT(admissions.first_name," ", admissions.last_name) as full_name,
                    admissions.id as student_id,
                    fee_structures.semesterFee as school_fee,
                    fee_structures.fee_type,
                    student_fees.amount as student_fee,
                    classes.class_code,
                    classes.class_name,
                    semesters.semester_name,
                    semesters.id as semester_id, 
                    levels.level,
                    invoices.id as invoice_id,
                    rolls.username,
                    transactions.transaction_date,
                    transactions.balance,
                    transactions.mood,
                    transactions.description,
                    transactions.status,
                    transactions.transaction_id,
                    transactions.paid_amount as paid_amount'))
                    ->where('transactions.user_id', $request->user_id)
                    ->where('transactions.school_id', $request->school_id)
                    ->where('transactions.mood', $request->group_by)
                    ->where('transactions.transaction_date', '>=', $request->type_id)->get();

                    // dd( $data_collection);

                    if(count($data_collection)=="0"){
                        FlashFlash::error('No Tranactions Found Under This User ' . $user_name->name . '');
                    // return response()->json(['message' => 'No Tranactions Found Under This Roll Number ' . $roll_no_feestatement . '']);
                        return back();
                    }
                                
                }
 
                if($request->user_id != '' && $request->school_id != '' && $request->group_by != '' && $request->type_id != '') {
                    $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('transactions.user_id', $request->user_id)
                    ->where('transactions.school_id', $request->school_id)
                    ->where('transactions.mood', $request->group_by)
                    ->where('transactions.transaction_date', '>=', $request->type_id)
                    ->select(
                        DB::raw('SUM(semesterFee) AS total_schoolFee'), 
                        DB::raw('SUM(paid_amount) AS total_outgoings'), 
                        DB::raw("SUM(balance) AS total_balance"))->get();
                }


                $view = view('report.finance.index')
                                    ->with('users', $users)
                                    ->with('user_name', $user_name)
                                    ->with('data_collection', $data_collection )
                                    ->with('total_balance1', $total_balance1)
                                    ->with('transctions_feecollection', $transctions_feecollection)
                                    ->render();

        return response($view);
    }


    public function getOnlinefee_collectionReport(Request $request)
    {
        $transctions_onlinefeecollection = Transaction::where('school_id', $request->school_id)->get();
        $classes = Classes::all();
        $semesters = Semester::where('status', 'on')->where('school_id', $request->school_id)->get();
        
        $poststudentbalancereport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();

        $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('rolls.username', $request->roll_no)->select(
                    DB::raw('SUM(balance) AS total_balance'))->get();

                    $users = User::all();
        
        return view ('report.finance.index', compact('transctions_onlinefeecollection','semesters', 'classes','poststudentbalancereport'))
        ->with('users', $users);

       return view('report.finance.index');
    }

    public function postOnlinefee_collectionReport(Request $request)
    {
        $transctions_onlinefeecollection = Transaction::all();
        $users = User::all();
        $user_name = User::where('id', $request->user_id)->first();
                
                // dd($request->all());

                if( $request->school_id != '' && $request->type_id != '') 
                {

                    $data_collection = $this->attendanceinfo()->select(DB::raw('users.name,
                    CONCAT(admissions.first_name," ", admissions.last_name) as full_name,
                    admissions.id as student_id,
                    fee_structures.semesterFee as school_fee,
                    fee_structures.fee_type,
                    student_fees.amount as student_fee,
                    classes.class_code,
                    classes.class_name,
                    semesters.semester_name,
                    semesters.id as semester_id, 
                    levels.level,
                    invoices.id as invoice_id,
                    rolls.username,
                    transactions.transaction_date,
                    transactions.balance,
                    transactions.mood,
                    transactions.description,
                    transactions.status,
                    transactions.transaction_id,
                    transactions.paid_amount as paid_amount'))
                    ->where('transactions.school_id', $request->school_id)
                    ->where('transactions.transaction_date', '>=', $request->type_id)->get();

                    // dd( $data_collection);

                    if(count($data_collection)=="0"){
                        FlashFlash::error('No Tranactions Found Under This Type ' . $request->type_id . '');
                    // return response()->json(['message' => 'No Tranactions Found Under This Roll Number ' . $roll_no_feestatement . '']);
                        return back();
                    }
                                
                }
 
                if($request->school_id != '' && $request->type_id != '') {
                    $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('transactions.school_id', $request->school_id)
                    ->where('transactions.transaction_date', '>=', $request->type_id)
                    ->select(
                        DB::raw('SUM(semesterFee) AS total_schoolFee'), 
                        DB::raw('SUM(paid_amount) AS total_outgoings'), 
                        DB::raw("SUM(balance) AS total_balance"))->get();
                }


                $view = view('report.finance.index')
                                    ->with('users', $users)
                                    ->with('user_name', $user_name)
                                    ->with('data_collection', $data_collection )
                                    ->with('total_balance1', $total_balance1)
                                    ->with('transctions_onlinefeecollection', $transctions_onlinefeecollection)
                                    ->render();

        return response($view);
    }

    public function getpayrollReport(Request $request)
    {
        $transctions_payroll = Transaction::where('school_id', $request->school_id)->get();
        $classes = Classes::all();
        $semesters = Semester::where('status', 'on')->where('school_id', $request->school_id)->get();
        
        $poststudentbalancereport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();

        $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('rolls.username', $request->roll_no)->select(
                    DB::raw('SUM(balance) AS total_balance'))->get();

        $students = Roll::join('admissions','admissions.id', '=', 'rolls.student_id')->get();
        
        return view ('report.finance.index', compact('transctions_payroll','semesters', 'classes','poststudentbalancereport'))
        ->with('students', $students);

       return view('report.finance.index');
    }

    public function postpayrollReport(Request $request)
    {

        
       return view('report.finance.index');
    }


    public function getincomeReport(Request $request)
    {
        $transctions_income = Transaction::where('school_id', $request->school_id)->get();
        $classes = Classes::all();
        $semesters = Semester::where('status', 'on')->where('school_id', $request->school_id)->get();
        
        $poststudentbalancereport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();

        $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('rolls.username', $request->roll_no)->select(
                    DB::raw('SUM(balance) AS total_balance'))->get();

        $students = Roll::join('admissions','admissions.id', '=', 'rolls.student_id')->get();
        
        return view ('report.finance.index', compact('transctions_income','semesters', 'classes','poststudentbalancereport'))
        ->with('students', $students);

       return view('report.finance.index');
    }

    public function postincomeReport(Request $request)
    {

        
       return view('report.finance.index');
    }

    public function getexpenseReport(Request $request)
    {
        $transctions_expense = Transaction::where('school_id', $request->school_id)->get();
        $classes = Classes::all();
        $semesters = Semester::where('status', 'on')->where('school_id', $request->school_id)->get();
        
        $poststudentbalancereport = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
        ->where('class_code', $request->class_id)->where('acceptance', 'accept')->where('school_id', $request->school_id)->get();

        $total_balance1 = Transaction::join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                    ->select(DB::raw('(balance) as totalPriceQuantity'))
                    ->where('rolls.username', $request->roll_no)->select(
                    DB::raw('SUM(balance) AS total_balance'))->get();

        $students = Roll::join('admissions','admissions.id', '=', 'rolls.student_id')->get();
        
        return view ('report.finance.index', compact('transctions_expense','semesters', 'classes','poststudentbalancereport'))
        ->with('students', $students);

       return view('report.finance.index');
    }

    public function postexpenseReport(Request $request)
    {

        
       return view('report.finance.index');
    }







// ---------------------------- ATTENDANCE FUNCTIONS METHOD START HERE -----------------------------

    public function monthlyReport(Request $request)
    {
        $class        = $request->get('class', null);
        $section      = $request->get('section', null);
        $session      = trim($request->get('session', date('Y')));
        $shift        = $request->get('shift', null);
        $isPrint      = $request->get('print_view', null);
        $yearMonth    = $request->get('yearMonth', date('Y-m'));


        if (auth()->user()->group == "Owner") {

        $studentattendancereport = Admission::where('acceptance', 'accept')->get();

        $classes2     = Classes::select('class_code', 'class_name') ->where('school_id' , auth()->user()->school_id)->orderby('class_code', 'asc')->get();

        // $classes2  = Classes::select('class_name','class_code')->whereIn('class_code',$classes2)->orderBy('created_at', 'asc')->get();

        $section_data = Department::select('department_id','department_name')->where('department_id','=',$section)->first();
    
        if($isPrint) {

            if ($class   != '' && $yearMonth != '' && $request->school_id != '') {

            $myPart   = mb_split('-', $yearMonth);

        
            if(count($myPart)!= 2) {

                Flash::error('Error', 'Please don\'t mess with inputs!!!');
                // $errorMessages = new Illuminate\Support\MessageBag;
                // $errorMessages->add('Error', 'Please don\'t mess with inputs!!!');
                return redirect(url('/attendance/monthly-report'));
            }
            if($request->get('regiNo')==''){
            $students = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')->where('class_code', $class)
                ->where('class_code', $class)
                ->where('acceptance', 'accept')
                ->where('school_id' , auth()->user()->school_id)

                ->pluck('rolls.username');
            }else{
                $students = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                ->where('class_code', $class)
                ->where('acceptance', 'accept')
                ->where('school_id' , auth()->user()->school_id)
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
            
                Flash::error('Student Not Fund!!!');
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
                // dd($offDays);

            $sick = Attendance::where('attendance_status', 'sick')
            ->whereDate('attendance_date', '>=', $firstDate)
            ->whereDate('attendance_date', '<=', $lastDate)
            ->where('school_id' , auth()->user()->school_id)
            //->lists('oType', 'offDate');
            ->pluck('attendance_status');

            $late = Attendance::where('attendance_status', 'late')
            ->whereDate('attendance_date', '>=', $firstDate)
            ->whereDate('attendance_date', '<=', $lastDate)
            ->where('school_id' , auth()->user()->school_id)
            //->lists('oType', 'offDate');
            ->pluck('attendance_status');
                //pluck
                //   dd($lastDate);
            //find fridays of requested month
            $fridays = [];
            $startDate = Carbon::parse($firstDate)->next(Carbon::SUNDAY); // Get the first friday.
            $endDate =   Carbon::parse($lastDate);

            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
                $fridays[$date->format('d-m-Y')] = 1;
            }

            //get class info
            $classInfo = Classes::where('class_code', $class)->where('school_id' , auth()->user()->school_id)->first();
            $className = $classInfo->class_name;

            $owner_id = auth()->user()->school_id;

            $SelectCol = self::getSelectColumns($myPart[0], $myPart[1]);
            //echo "<pre>";print_r($SelectCol);
            //exit;
            $fullSql   = "SELECT CONCAT(MAX(ad.first_name),' ',MAX(ad.father_name),' ',MAX(ad.last_name)) as name, 
            CAST(MAX(roll.username) as UNSIGNED) as student_id,".$SelectCol." FROM attendances as att left join admissions as ad ON att.student_id=ad.id  
            left join rolls as roll ON roll.student_id=ad.id";
            $fullSql .=" WHERE roll.username IN(".implode(',', $students->toArray()).") AND att.attendance_status !='absent' AND att.school_id =  $owner_id  GROUP BY att.student_id ORDER BY student_id;";
            $data = DB::select($fullSql);
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
        $institute=Institute::select('*')->where('school_id', $request->school_id)->get();
            // dd($institute);
            if(empty($institute)) {
                
                Flash::error('Please setup institute information!');
                return redirect(url('/attendance/monthly-report'));

            }

            return View('attendances.attendance_report.monthly_attendance_report', compact('institute', 'data', 'keys', 'yearMonth', 'fridays', 'holiDays', 'className', 'section', 'session', 'shift', 'offDays','section_data','type', 'sick', 'late'));
        }else {
            FlashFlash::error('Inputs with astracks are required! please select a correct creterials to procceed!');
            return redirect()->back();
        }
        }
    }else {
        $studentattendancereport = Admission::where('acceptance', 'accept')->get();

        $classes2     = Classes::select('class_code', 'class_name')->orderby('class_code', 'asc')->get();

        // $classes2  = Classes::select('class_name','class_code')->whereIn('class_code',$classes2)->orderBy('created_at', 'asc')->get();

        $section_data = Department::select('department_id','department_name')->where('department_id','=',$section)->first();
    
        if($isPrint) {

            if ($class   != '' && $yearMonth != '' && $request->school_id != '') {
            
            $myPart   = mb_split('-', $yearMonth);

        
            if(count($myPart)!= 2) {

                Flash::error('Error', 'Please don\'t mess with inputs!!!');
                // $errorMessages = new Illuminate\Support\MessageBag;
                // $errorMessages->add('Error', 'Please don\'t mess with inputs!!!');
                return redirect(url('/attendance/monthly-report'));
            }
            if($request->get('regiNo')==''){
            $students = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')->where('class_code', $class)
                ->where('class_code', $class)
                ->where('acceptance', 'accept')
                ->where('school_id' , $request->school_id)

                ->pluck('rolls.username');
            }else{
                $students = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')
                ->where('class_code', $class)
                ->where('acceptance', 'accept')
                ->where('school_id' , $request->school_id)
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
            
                Flash::error('Student Not Fund!!!');
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
                // dd($offDays);

            $sick = Attendance::where('attendance_status', 'sick')
            ->whereDate('attendance_date', '>=', $firstDate)
            ->whereDate('attendance_date', '<=', $lastDate)
            ->where('school_id' , $request->school_id)
            //->lists('oType', 'offDate');
            ->pluck('attendance_status');

            $late = Attendance::where('attendance_status', 'late')
            ->whereDate('attendance_date', '>=', $firstDate)
            ->whereDate('attendance_date', '<=', $lastDate)
            ->where('school_id' , $request->school_id)
            //->lists('oType', 'offDate');
            ->pluck('attendance_status');
                //pluck
                //   dd($lastDate);
            //find fridays of requested month
            $fridays = [];
            $startDate = Carbon::parse($firstDate)->next(Carbon::SUNDAY); // Get the first friday.
            $endDate =   Carbon::parse($lastDate);

            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
                $fridays[$date->format('d-m-Y')] = 1;
            }

            $owner_id = $request->get('school_id');

            //get class info
            $className = Classes::where('class_code', $class)->where('school_id' ,  $owner_id)->get();

        

            $SelectCol = self::getSelectColumns($myPart[0], $myPart[1]);
            //echo "<pre>";print_r($SelectCol);
            //exit;

            $fullSql   = "SELECT CONCAT(MAX(ad.first_name),' ',MAX(ad.father_name),' ',MAX(ad.last_name)) as name, 
            CAST(MAX(roll.username) as UNSIGNED) as student_id,".$SelectCol." FROM attendances as att left join admissions as ad ON att.student_id=ad.id  
            left join rolls as roll ON roll.student_id=ad.id";
            $fullSql .=" WHERE roll.username IN(".implode(',', $students->toArray()).") AND att.attendance_status !='absent' AND att.school_id =  $owner_id  GROUP BY att.student_id ORDER BY student_id;";
            $data = DB::select($fullSql);
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
        //    dd($keys ); attendance_school
            $institute=Institute::select('*')->where('school_id', $request->school_id)->get();
        
            // dd($institute);
            if(empty($institute)) {
                
                Flash::error('Please setup institute information!');
                return redirect(url('/attendance/monthly-report'));

            }

            
            $attendance_school=School::join('attendances', 'attendances.school_id', '=', 'schools.id')->where('school_id', $request->school_id)->get();

    // dd($attendance_school);

            return View('attendances.attendance_report.monthly_attendance_report', compact('institute', 'attendance_school', 'data', 'keys', 'yearMonth', 'fridays', 'holiDays', 'className', 'section', 'session', 'shift', 'offDays','section_data','type', 'sick', 'late'));
        }else {
        FlashFlash::error('Inputs with astracks are required! please select a correct creterials to procceed!');
        return redirect()->back();
        }
    }
    }

        return View('report.attendance.index', compact('studentattendancereport','classes2', 'yearMonth', 'section', 'session', 'shift', 'section_data'));
    }


    private static function getSelectColumns($year,$month)
     {
        $start_date = "01-".$month."-".$year;
        $start_time = strtotime($start_date);

        $end_time = strtotime("+1 month", $start_time);
        $selectCol = "";
        for($i=$start_time; $i<$end_time; $i+=86400)
        {
            $d = date('d-m-Y', $i);
            $selectCol .= "MAX(IF(attendance_date = '".$d."', 1, 0)) AS '".$d."',";
        }
        if(strlen($selectCol)) {
            $selectCol = substr($selectCol, 0, -1);
        }

        return $selectCol;
    }


    public function AttendaceReport(Request $request)
    {
        $class        = $request->get('class', null);
        $section      = $request->get('section', null);
        $session      = trim($request->get('session', date('Y')));
        $shift        = $request->get('shift', null);
        $isPrint      = $request->get('print_view', null);
        $yearMonth    = $request->get('yearMonth', date('Y-m'));

        $classes2     = Classes::select('class_code', 'class_name')->orderby('class_code', 'asc')->get();
        $classes2  = Classes::select('class_name','class_code')->whereIn('class_code',$classes2)->orderBy('created_at', 'asc')->get();
        $section_data = Department::select('department_id','department_name')->where('department_id','=',$section)->first();
        // $studentattendancereport = Admission::where('acceptance', 'accept')->get();

       

        
        return view('report.attendance.index', compact('classes2',  'yearMonth',   'section', 'session', 'shift', 'section_data'));
    }

    public function getAttendaceReport(Request $request)
    {
        $studentattendancereport = Admission::where('acceptance', 'accept')->get();

        return view('report.attendance.index',compact('studentattendancereport'));
    }

    public function getClasswiseAttendaceReport(Request $request)
    {
        $class_id        = $request->get('class_id', null);
        $yearMonth    = $request->get('yearMonth', date('m'));

        if (auth()->user()->group == "Owner") {
        $classes2     = Classes::select('class_code', 'class_name')->where('school_id', auth()->user()->school_id)->orderby('class_code', 'asc')->get();
        $studentclasswiseattendancereport = Admission::where('acceptance', 'accept')->get();

             $class_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
                ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
                // ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
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
                    ->where('attendances.school_id', auth()->user()->school_id)
                    ->get();
        }else {
            $classes2     = Classes::select('class_code', 'class_name')->orderby('class_code', 'asc')->get();
            // $classes2  = Classes::select('class_name','class_code')->whereIn('class_code',$classes2)->orderBy('created_at', 'asc')->get();
            // $section_data = Department::select('department_id','department_name')->where('department_id','=',$section)->first();
            $studentclasswiseattendancereport = Admission::where('acceptance', 'accept')->get();
    
    
    
                 $class_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
                    ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
                    // ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
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
                        ->where('attendances.school_id', $request->school_id)
                        ->get();
                 }

 
        return view('report.attendance.index',compact('studentclasswiseattendancereport','classes2','yearMonth','class_attend'));
    }

    public function PostAttendaceReport(Request $request)
    {
        $class_id        = $request->get('class_id', null);
        $yearMonth    = $request->get('yearMonth', date('m'));

        if (auth()->user()->group == "Owner") {
            $classes2     = Classes::select('class_code', 'class_name')->where('school_id', auth()->user()->school_id)->orderby('class_code', 'asc')->get();
            $studentclasswiseattendancereport = Admission::where('acceptance', 'accept')->get();
    
            if ($request->class_id != '' && $request->school_id != '') {
           
                 $class_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
                    ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
                    // ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
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
                        ->where('attendances.school_id', auth()->user()->school_id)
                        ->get();
                 }else {
                        FlashFlash::error('class and school are required');
                    return redirect()->back();
                }
            }else {
                $classes2     = Classes::select('class_code', 'class_name')->orderby('class_code', 'asc')->get();
                // $classes2  = Classes::select('class_name','class_code')->whereIn('class_code',$classes2)->orderBy('created_at', 'asc')->get();
                // $section_data = Department::select('department_id','department_name')->where('department_id','=',$section)->first();
                $studentclasswiseattendancereport = Admission::where('acceptance', 'accept')->get();
        
                if ($request->class_id != '' && $request->school_id != '') {
                     $class_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
                        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
                        // ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
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
                            ->where('attendances.school_id', $request->school_id)
                            ->get();

                        }else {
                            FlashFlash::error('class and school are required');
                        return redirect()->back();
                    }
                }

                    //  dd($class_attend);

            return view('report.attendance.index',compact('studentclasswiseattendancereport','classes2','yearMonth','class_attend'));

    }

    public function getYearlyAttendanceReport(Request $request)
    {
        $studentyearlyattendancereport = Admission::where('acceptance', 'accept')->get();
        $classes2     = Classes::select('class_code', 'class_name')->orderby('class_code', 'asc')->get();
        $classes2  = Classes::select('class_name','class_code')->whereIn('class_code',$classes2)->orderBy('created_at', 'asc')->get();
        $year = $request->get('yearly_date', date('Y'));
        return view('report.attendance.index',compact('studentyearlyattendancereport','classes2','year'));
    }

    public function PostYearlyAttendanceReport(Request $request)
    {
        if (auth()->user()->group == "Owner") {

        $studentyearlyattendancereport = Admission::where('acceptance', 'accept')->get();
        $class_id = $request->class_id;
        $atten_year = $request->yearly_date;
        $year = $request->get('yearly_date', date('Y'));

        $classes2     = Classes::select('class_code', 'class_name')
        ->where('school_id', auth()->user()->school_id)->orderby('class_code', 'asc')->get();
        // $classes2  = Classes::select('class_name','class_code')->whereIn('school_id', auth()->user()->school_id)->orderBy('created_at', 'asc')->get();

        if ($atten_year != '' && $class_id == '' && $request->school_id != '') {

        $yearly_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
        // ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
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
              'classes.class_name')
            ->where('attendances.year', $atten_year)
            ->where('attendances.school_id', auth()->user()->school_id)
            ->get();

         

        }elseif ($class_id != '' && $atten_year != '' && $request->school_id != '') {

        $yearly_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
        // ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
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
              'classes.class_name')
            ->where('attendances.class_id', $class_id)
            ->where('attendances.year', $atten_year)
            ->where('attendances.school_id', auth()->user()->school_id)
            ->get();

            // dd( $yearly_attend);
        }
        
    }else {
        $studentyearlyattendancereport = Admission::where('acceptance', 'accept')->get();
        $class_id = $request->class_id;
        $atten_year = $request->yearly_date;
        $year = $request->get('yearly_date', date('Y'));

        $classes2     = Classes::select('class_code', 'class_name')->orderby('class_code', 'asc')->get();
        // $classes2  = Classes::select('class_name','class_code')->whereIn('class_code',$classes2)->orderBy('created_at', 'asc')->get();

        if ($atten_year != '' && $class_id == '' && $request->school_id) {

        $yearly_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
        // ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
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
              'classes.class_name')
            ->where('attendances.year', $atten_year)
            ->where('attendances.school_id', $request->school_id)
            ->get();

         

        }elseif ($class_id != '' && $atten_year != '' && $request->school_id) {

        $yearly_attend = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
        // ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
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
              'classes.class_name')
            ->where('attendances.class_id', $class_id)
            ->where('attendances.year', $atten_year)
            ->where('attendances.school_id', $request->school_id)
            ->get();
        }else {
            FlashFlash::error('inputs with astraks are required, please select a correct inputs and procced!');
            return redirect()->back();
        }
     }

        // dd($studentyearlyattendancereport);

        return view('report.attendance.index',compact('year','studentyearlyattendancereport','yearly_attend','classes2'));
    }

}