<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Course;
use App\models\Level;
use App\Status;
use App\models\Fees;
use App\ReceiptDetail;
use App\FeeType;
use App\models\FeeStructure;
use App\StudentFee;
// use App\Transaction;
use App\Receipt;
use App\Roll;
use DB;
use Session;
use App\Models\Admission;
use App\Models\ClassAssigning;
use App\Models\Teacher;
use Flash;
use Response;

use App\models\Batch;
use App\models\Classes;
use App\models\ClassRoom;
use App\models\Semester;
use App\SemesterDetail;
use App\models\Department;
use App\models\Faculty;
use App\models\Shift;
use App\models\Time;
use App\InvoiceDetails;
use App\Invoice;
use App\models\ClassSchedule;
use App\models\Transaction;
use Validator;
use PDF;
use App\StudentSubjects;
use App\SemesterSubjects;
class FeeController extends Controller
{
    public function getPayment()
    {
        return view('fee.searchPayment');
    }

    public function student_roll($studentId)
    {
                    return Roll::latest('rolls.roll_id')
                    ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
                    ->join('semesters', 'semesters.id','=', 'rolls.semester_id')
                    // ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
                    // ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                    // ->join('classes', 'classes.id','=', 'class_schedule.class_id')
                    ->join('departments', 'departments.department_id', '=', 'admissions.department_id')
                    ->join('faculties', 'faculties.faculty_id', '=', 'admissions.faculty_id')
                    // ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                    ->join('levels', 'levels.id','=', 'admissions.degree_id')
                    // ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                    // ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                    // ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                    ->where('admissions.id', $studentId)->first();

                    // echo "<pre>";print_r($roll); die;
    }


    public function FeeCollectionPayment(Request $request)
    {
        if ($request->ajax()) {
            
                $semester_id = $request->get('semester_id');
                $class_code = $request->get('class_code');
                $roll_no = $request->get('roll_no');
                $semester = Semester::all();
                $classes = Classes::all();
                $student_id = $request->get('student_id');

                $rolls = Roll::where('username', $roll_no)->first();
              
                $readStudentTransaction = $this->read_student_transaction($rolls->student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // dd($readStudentTransaction);

        $readStudentFee = $this->read_student_fee($rolls->student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // dd($readStudentFee);
        $totalTransaction = $this->total_transaction($rolls->student_id)->get();
        $invoice_id = InvoiceDetails::where('student_id', 'student_id')->max('invoice_id');
        $student_name =  DB::table('admissions')->select('first_name','last_name')->where('id',$rolls->student_id)->first();

        if ($request->roll_no !="" ) {

                $data =  Roll::join('semesters','semesters.id','=', 'rolls.semester_id')
                        ->join('admissions', 'admissions.id','=', 'rolls.student_id')
                        ->join('departments','departments.department_id','=', 'admissions.department_id')
                        ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
                        ->join('levels', 'levels.id','=', 'admissions.degree_id')
                        ->join('classes', 'classes.class_code','=', 'admissions.class_code')
                        ->join('batches', 'batches.id','=', 'admissions.batch_id')
                        // ->join('fee_structures','fee_structures.semester_id','=', 'admissions.semester_id')
                        ->select('admissions.id as student_id','departments.*','semesters.*','semesters.semester_name',
                                   'levels.*','rolls.username',
                                   'admissions.*',
                                   'classes.*', 'classes.id as class_id')
                                ->where('rolls.username',$roll_no)
                                ->get();

                $fee_structure = FeeStructure::where('semester_id', $rolls->semester_id)->get();
                $fee_structure_amount = FeeStructure::where('id', $request->fee_type)->first();
        }
        elseif($request->class_code != '' && $request->semester_id != '')
        {
            $data =  Roll::join('semesters','semesters.id','=', 'rolls.semester_id')
            ->join('admissions', 'admissions.id','=', 'rolls.student_id')
            ->join('departments','departments.department_id','=', 'admissions.department_id')
            ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
            ->join('levels', 'levels.id','=', 'admissions.degree_id')
            ->join('classes', 'classes.class_code','=', 'admissions.class_code')
            ->join('batches', 'batches.id','=', 'admissions.batch_id')
            ->join('fee_structures','fee_structures.semester_id','=', 'admissions.semester_id')
            ->select('admissions.id as student_id','departments.*','semesters.*','semesters.semester_name',
                       'fee_structures.*','faculties.*','levels.*','rolls.username',
                       'fee_structures.id as fee_structure_id','admissions.*',
                       'classes.*', 'classes.id as class_id')
                       ->where('semesters.id',$semester_id)
                       ->where('classes.class_code',$class_code)
                    ->get();
        }

        $fee_structure1 = FeeStructure::all();

        $view = view('fee.fee-payment')
        ->with('readStudentFee', $readStudentFee)
        ->with('data', $data )
        ->with('semester', $semester )
        ->with('readStudentTransaction', $readStudentTransaction)
        ->with('totalTransaction', $totalTransaction)
        ->with('fee_structure', $fee_structure)
        ->with('fee_structure1', $fee_structure1)
        ->with('fee_structure_amount', $fee_structure_amount)
        ->with('classes', $classes)
        ->with('student_name', $student_name)
        ->render();

        return response($view);


        // echo json_encode($data);
        }
}

// ------------------------- SINGLE STUDENT FEE COLLECTION------------------
public function StudentFeeCollectionPayment($student_id)
{
        $semester = Semester::where('status', 'on')->get();
        $faculty = Faculty::all();
        $classes = Classes::all();
        $batches = Batch::all();
        
        $readStudentTransaction = $this->read_student_transaction($student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // dd($readStudentTransaction);

        $readStudentFee = $this->read_student_fee($student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // dd($readStudentFee);
        $totalTransaction = $this->total_transaction($student_id)->get();
        $invoice_id = InvoiceDetails::where('student_id', 'student_id')->max('invoice_id');
     $student_name =  DB::table('admissions')->select('first_name','last_name')->where('id',$student_id)->first();
    //  dd($student_name);
    $data = Roll::join('semesters','semesters.id','=', 'rolls.semester_id')
    ->join('admissions', 'admissions.id','=', 'rolls.student_id')
    ->join('departments','departments.department_id','=', 'admissions.department_id')
    ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
    ->join('levels', 'levels.id','=', 'admissions.degree_id')
    ->join('classes', 'classes.class_code','=', 'admissions.class_code')
    ->join('batches', 'batches.id','=', 'admissions.batch_id')
    // ->join('fee_structures','fee_structures.semester_id','=', 'admissions.semester_id')
    // ->join('semester_subjects','semester_subjects.id','=', 'admissions.semester_id')
    // ->join('courses','courses.id','=', 'semester_subjects.course_id')
    ->select('admissions.id as student_id','departments.*','semesters.*',
               'faculties.*','levels.*',
               'admissions.*','rolls.username',
            //    'semester_subjects.*',
            //    'courses.*',
               'classes.*', 'classes.id as class_id')
            ->where('rolls.student_id',$student_id)
            ->get();
            $fee_structure = FeeStructure::all();
            $fee_structure1 = FeeStructure::all();
            // dd($data);die;
            return view('fee.fee-payment-class', compact('data',
            'student','readStudentTransaction','student_name',
            'readStudentFee','semester','faculty','fee_structure','fee_structure1',
            'totalTransaction','invoice_id','classes'));
}

// ------------------------- MULTI STUDENT FEE COLLECTION BY CLASS------------------
public function StudentFeeListCollectionPayment(Request $request)
{
                $semester = Semester::where('status', 'on')->get();
                $faculty = Faculty::all();
                $classes = Classes::all();
                $batches = Batch::all();
                $department_id = $request->get('department_id');
                $semester_id = $request->get('semester_id');
                $degree_id = $request->get('degree_id');
                $faculty_id = $request->get('faculty_id');
                $class_id = $request->get('class_id');
                $student_id = $request->get('student_id');
                $readStudentFee = $this->read_student_fee($student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
                if ($request->department_id !="" && $request->faculty_id != ""
                && $request->semester_id != "" && $request->degree_id != ""
                && $request->class_id != "")
                {
                    $data = Roll::join('semesters','semesters.id','=', 'rolls.semester_id')
                          ->join('admissions', 'admissions.id','=', 'rolls.student_id')
                          ->join('departments','departments.department_id','=', 'admissions.department_id')
                          ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
                          ->join('levels', 'levels.id','=', 'admissions.degree_id')
                          ->join('classes', 'classes.class_code','=', 'admissions.class_code')

                          
                          ->join('batches', 'batches.id','=', 'admissions.batch_id')
                        //   ->join('rolls', 'rolls.roll_id','=', 'rolls.student_id')
                          ->join('fee_structures','fee_structures.semester_id','=', 'admissions.semester_id')
                        // //   ->join('semesters','semesters.id','=', 'admissions.semester_id')
                        // //   ->join('courses','courses.id','=', 'admissions.course_id')
                          ->select('admissions.id as student_id','departments.*','semesters.*',
                                   'fee_structures.*','faculties.*','levels.*',
                                   'fee_structures.id as fee_structure_id','admissions.*','rolls.username',
                                   'classes.*', 'classes.id as class_id')
                                  ->where('admissions.class_code', $class_id)
                                  ->where('admissions.semester_id',$semester_id)
                                  ->where('admissions.faculty_id',$faculty_id)
                                  ->where('admissions.department_id',$department_id)
                                  ->get();
                                //   dd($data1);
                                  if(count($data)=="0"){
                                      echo "<h1 align='center' class=' alert alert-danger'>No Class Found Under This Course </h1>";
                                    }
                                    else
                                    {

                           return view('fee.feeTypes.multiFeePayment', compact('data',
                                          'student','readStudentTransaction',
                                          'readStudentFee','semester','faculty',
                                          'totalTransaction','invoice_id','classes'));
                               }

                              }else{
                                  echo "<h1 align='center' class=' alert alert-danger'>No Class Found Under This Course </h1>";
                              }

                              return view('fee.studentListpayment',  compact('data',
                                          'student','readStudentTransaction',
                                          'readStudentFee','semester','faculty',
                                          'totalTransaction','invoice_id','classes'));

}

public function StudentListPayment(Request $request)
{
        $semester = Semester::where('status', 'on')->get();
        $faculty = Faculty::all();
        $classes = Classes::all();
        $batches = Batch::all();

    return view('fee.studentListpayment', compact('data','semester','faculty','classes'));
}

    public function ViewPayment(Request $request){
        $semester = Semester::where('status', 'on')->get();
        $faculty = Faculty::all();
        $classes = Classes::all();
        $batches = Batch::all();

        $roll_no = $request->get('roll_no');
        $student_id = $request->get('student_id');

        $rolls = Roll::where('username', $roll_no)->first();

        if (isset($rolls)) {

        $readStudentTransaction = $this->read_student_transaction($rolls->student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // dd($readStudentTransaction);

        $readStudentFee = $this->read_student_fee($rolls->student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // dd($readStudentFee);
        $totalTransaction = $this->total_transaction($rolls->student_id)->get();
        $invoice_id = InvoiceDetails::where('student_id', $rolls->student_id)->max('invoice_id');
        $student_name =  DB::table('admissions')->select('first_name','last_name')->where('id',$rolls->student_id)->first();

        }else {
            $readStudentTransaction = $this->read_student_transaction($student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // dd($readStudentTransaction);

        $readStudentFee = $this->read_student_fee($student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // dd($readStudentFee);
        $totalTransaction = $this->total_transaction($student_id)->get();
        $invoice_id = InvoiceDetails::where('student_id', $student_id)->max('invoice_id');
        $student_name =  DB::table('admissions')->select('first_name','last_name')->where('id',$student_id)->first();
        }

        $data = Roll::join('semesters','semesters.id','=', 'rolls.semester_id')
                    ->join('admissions', 'admissions.id','=', 'rolls.student_id')
                    ->join('departments','departments.department_id','=', 'admissions.department_id')
                    ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
                    ->join('levels', 'levels.id','=', 'admissions.degree_id')
                    ->join('classes', 'classes.class_code','=', 'admissions.class_code')
                    ->join('batches', 'batches.id','=', 'admissions.batch_id')
                    ->join('fee_structures','fee_structures.semester_id','=', 'admissions.semester_id')
                    // ->join('semester_subjects','semester_subjects.id','=', 'admissions.semester_id')
                    // ->join('courses','courses.id','=', 'semester_subjects.course_id')
                    ->select('admissions.id as student_id','departments.*','semesters.*',
                            'fee_structures.*','faculties.*','levels.*',
               'fee_structures.id as fee_structure_id','admissions.*','rolls.username',
            //    'semester_subjects.*',
            //    'courses.*',
               'classes.*', 'classes.id as class_id')
            ->where('rolls.student_id',$student_id)
            ->get();

            $all_fees = Roll::join('semesters','semesters.id','=', 'rolls.semester_id')
            ->join('admissions', 'admissions.id','=', 'rolls.student_id')
            ->join('departments','departments.department_id','=', 'admissions.department_id')
            ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
            ->join('levels', 'levels.id','=', 'admissions.degree_id')
            ->join('classes', 'classes.class_code','=', 'admissions.class_code')
            ->join('batches', 'batches.id','=', 'admissions.batch_id')
            ->join('student_fees','student_fees.student_id','=', 'admissions.id')
            ->join('fee_structures','fee_structures.id','=', 'student_fees.fee_id')
            ->join('transactions','transactions.student_id','=', 'student_fees.student_id')
            // ->join('courses','courses.id','=', 'semester_subjects.course_id')
            ->select('admissions.id as student_id','departments.*','semesters.*',
                    'student_fees.*','faculties.*','levels.*','fee_structures.fee_type','fee_structures.semesterFee',
            'student_fees.student_fee_id','admissions.*','rolls.username','transactions.*',
    //    'semester_subjects.*',
    //    'courses.*',
       'classes.*', 'classes.id as class_id')
    // ->where('rolls.student_id',$student_id)
    ->get();

        $fee_structure = FeeStructure::all();
        $fee_structure1 = FeeStructure::all();
        $fee_structure_amount = FeeStructure::where('id', $request->fee_type)->first();

            // dd($fee_structure_amount);

        return view('fee.search-fee-payment', compact('student','readStudentTransaction','data','fee_structure1',
                                                'readStudentFee','semester','faculty','rolls','all_fees',
                                                'totalTransaction','invoice_id','classes','student_name','fee_structure','fee_structure_amount'));
    }

    public function getFeeTypes(Request $request)
    {
        if($request->ajax())
        {
        if ($request->fee_type != '') {
        $fee_structure1 = FeeStructure::join('semesters', 'semesters.id', '=', 'fee_structures.semester_id' )
                              ->where('fee_structures.id', $request->fee_type)
                              ->select('fee_structures.id as fee_structure_id', 
                              'fee_structures.semesterFee', 'fee_structures.degree_id as level_id',
                              'semesters.semester_name','fee_structures.total_amount',
                              'fee_structures.fee_type')->get();

        }
        else {
            $fee_structure = FeeStructure::all();
        }

        $view = view('fee.fee-type')
        // ->with('readStudentFee', $readStudentFee)
        // ->with('getfee', $getfee )
        // ->with('semester', $semester )
        // ->with('readStudentTransaction', $readStudentTransaction)
        // ->with('totalTransaction', $totalTransaction)
        ->with('fee_structure1', $fee_structure1)
        // ->with('fee_structure_amount', $fee_structure_amount)
        // ->with('classes', $classes)
        // ->with('student_name', $student_name)
        ->render();

        return response($view);

        
    }

    

    // echo json_encode($data);
}



    public function StudentInvoicePrint($invoice_id)
    {
        $invoice = InvoiceDetails::join('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
                        ->join('admissions', 'admissions.id', '=', 'invoice_details.student_id')
                        ->join('transactions', 'transactions.transaction_id', '=', 'invoice_details.transaction_id')
                        ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                        ->join('levels', 'levels.id', '=', 'fee_structures.degree_id')
                        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                        ->join('faculties', 'faculties.faculty_id', '=', 'fee_structures.faculty_id')
                        ->join('departments', 'departments.department_id', '=', 'fee_structures.department_id')
                        ->join('semesters', 'semesters.id', '=', 'fee_structures.semester_id')
                        ->join('users', 'users.id', '=', 'transactions.user_id')
                        ->join('rolls', 'rolls.roll_id', '=', 'admissions.id')
                        ->where('invoices.id', $invoice_id)
                        ->select('admissions.id',
                                    'admissions.first_name',
                                    'admissions.last_name',
                                    'admissions.gender',
                                    'semesters.semester_name',
                                    'faculties.faculty_name',
                                    'departments.department_name',
                                    'fee_structures.semesterFee as semesterFee',
                                    'fee_structures.admissionFee as admissionFee',
                                    'fee_structures.fee_type',
                                    'fee_structures.id as fee_structure_id',
                                    'transactions.transaction_date as paid_date',
                                    'transactions.paid_amount',
                                    'transactions.balance',
                                    'transactions.description',
                                    'classes.class_name',
                                    'users.name',
                                    // 'fees.id',
                                    'invoices.id as invoice_id',
                                    'admissions.id as student_id',
                                    'rolls.username as roll_no',
                                    'transactions.semester_fee_id',
                                    'levels.id as degree_id','levels.level')
                                    ->first();

        $totalPaid = Transaction::where('semester_fee_id', $invoice->semester_fee_id)
                                    ->where('student_id',$invoice->student_id)->sum('paid_amount');
        $studentFee = StudentFee::find($invoice->semester_fee_id);
        $roll_no = Roll::where('username',$invoice->roll_no)->first();
        // $roll = $this->student_roll($invoice->student_id);

        // dump($totalPaid);
        // dump($roll_no);die;
        return view('fee.fee-invoice.fee_invoice', compact('invoice','roll_no', 'timeTable', 'totalPaid', 'studentFee'));
    }

    public function payment($viewName,$student_id)
    {
        // $feetypes = FeeStructure::all();
        $roll = $this->student_roll($student_id);
        // dd($roll); die;
        $course = SemesterSubjects::where('semester_id', $roll->semester_id)->get();
        $feetypes = FeeStructure::join('semesters','semesters.id','=', 'fee_structures.semester_id')
        ->join('faculties','faculties.faculty_id','=', 'fee_structures.faculty_id')
        ->join('departments','departments.department_id','=', 'fee_structures.department_id')
        ->join('levels','levels.id','=', 'fee_structures.degree_id')
        ->select('faculties.faculty_name',
                            'levels.id',
                            'levels.degree_name',
                            'fee_structures.semesterFee as semester_fee',
                            'fee_structures.id'
                            // 'admissions.id',
                            // 'student_fees.student_fee_id',
                            // 'student_fees.amount as semester_fee_amount'
                            )
        ->where('levels.id', $roll->semester_id)->get();

        $semesterfee = $this->show_semester_fee($roll->semester_id)->first();
        // dd($semesterfee); die;
        $readStudentFee = $this->read_student_fee($roll->student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // dd($readStudentFee); die;
        $readStudentTransaction = $this->read_student_transaction($student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        // $StudentSubjects = $this->student_subjects()->get();
        $totalTransaction = $this->total_transaction($student_id)->get();
        $invoice_id = InvoiceDetails::where('student_id', 'student_id')->max('invoice_id');
        // $semester1_id = SemesterSubjects::where('semester_id', $roll->semester_id )->max('semester_id');
        $data =  Admission::with('semester_detail', 'semester_detail.course','semester_detail.semester')
                                        ->join('semesters','semesters.id','=', 'admissions.semester_id')
                                        ->join('departments','departments.department_id','=', 'admissions.department_id')
                                        ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
                                        ->join('levels', 'levels.id','=', 'admissions.degree_id')
                                        ->join('classes', 'classes.id','=', 'admissions.class_code')
                                        // ->join('batches', 'batches.id','=', 'admissions.batch_id')
                                        ->join('fee_structures','fee_structures.id','=', 'admissions.semester_id')
                                        ->join('semester_subjects','semester_subjects.id','=', 'admissions.semester_id')
                                        ->join('courses','courses.id','=', 'semester_subjects.course_id')
                                        ->select('admissions.id as student_id','departments.*','semesters.*',
                                                 'fee_structures.*','faculties.*','levels.*',
                                                 'fee_structures.id as fee_structure_id','admissions.*',
                                                 'semester_subjects.*','courses.*','classes.*', 'classes.id as class_id')
                                        ->where('admissions.id', $student_id)
                                        // ->where('admissions.id', $student_id)
                                        ->get();

        $data2 = SemesterSubjects::join('semesters','semesters.id','=', 'semester_subjects.semester_id')
                                        ->join('admissions','admissions.id','=', 'admissions.semester_id')
                                        ->join('courses','courses.id','=', 'semester_subjects.course_id')
                                        ->join('departments','departments.department_id','=', 'admissions.department_id')
                                        ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
                                        ->join('levels', 'levels.id','=', 'admissions.degree_id')
                                        ->join('rolls', 'rolls.roll_id','=', 'admissions.id')
                                        ->join('fee_structures','fee_structures.id','=', 'admissions.semester_id')
                                //  ->join('semesters','semesters.id','=', 'admissions.semester_id')

                                ->where('semester_subjects.semester_id', $roll->semester_id)
                                ->where('semester_subjects.department_id', $roll->student_id)
                                // ->where('faculties.faculty_id', $roll->student_id)
                                // ->where('admissions.semester_id',$student_id)
                                // ->where('admissions.id', $student_id)
                                ->get();
                                // ->where('semester_subjects.semester_id', $roll->semester_id)


        $semester_id = 'semester_id';
        $department_id = 'department_id';
        $level_id = 'level_id';

                $semesters = Semester::all();
                $departments = Department::all();
                $levels = Level::all();

            //  $levels = Level::where('course_id', $roll->semester_id)->get();
            $roll_no = Roll::select('username')->where('student_id',$student_id)->first();

            // if ($request->semester_id != '' && $request->department_id != '' && $request->level_id != '') {
                $classAssignings = ClassSchedule::join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
                ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
                ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                ->join('classes', 'classes.id','=', 'class_schedule.class_id')
                ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                // ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                ->join('levels','levels.id','=', 'class_schedule.degree_id')
                ->join()
                ->join('admissions', 'admissions.id','=', 'semesters.id')
                ->join('departments', 'departments.department_id','=', 'admissions.department_id')
                ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')

                ->where('class_schedule.semester_id', $semester_id)
                ->where('admissions.department_id', $department_id)
                ->where('class_schedule.degree_id', $level_id)
                ->orderBy('teachers.teacher_id', 'DESC')->get();

                // $student = Admission::max('id');

        return view($viewName, compact('course',
                                    'levels',
                                    'roll',
                                    'invoice_id',
                                    'data',
                                    'data2',
                                    'levels',
                                    'semester1_id',
                                    'roll_no',
                                    'classAssignings',
                                    'StudentSubjects',
                                    'semesterfee',
                                    'readStudentFee',
                                    'readStudentTransaction',
                                    'semesters','departments',
                                    'totalTransaction',
                                    'feetypes'))
                              ->with('student_id', $student_id);

}


public function FilterBySemesterDepartment(Request $request)
{
                    $semesters = Semester::all();
                    $departments = Department::all();
                    $levels = Level::all();
                    $semester_id = $request->get('semester_id');
                    $department_id = $request->get('department_id');
                    $level_id = $request->get('level_id');

                    // $student = Admission::max('id');

                // ->where('admissions.id','=','admissions.semester_id')->get();

                if ($request->semester_id != '' && $request->department_id != '' && $request->level_id != '') {
                  $classAssignings = ClassSchedule::join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                    ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
                    ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
                    ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                    ->join('classes', 'classes.id','=', 'class_schedule.class_id')
                    ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                    ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                    ->join('admissions', 'admissions.id','=', 'semesters.id')
                    ->join('departments', 'departments.department_id','=', 'admissions.department_id')
                    ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                    ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                    ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')

                    ->where('class_schedule.semester_id', $semester_id)
                    ->where('admissions.department_id', $department_id)
                    ->where('class_schedule.degree_id', $level_id)
                    // ->where('admissions.id', $student_id)
                    ->orderBy('teachers.teacher_id', 'DESC')->get();

                //   dd( $classAssignings); die;


                return view('fees.semester_course.course_modal', compact('classAssignings','semesters','departments','levels'));
                // return view('fees.payment', compact('classAssignings','semesters','departments','levels','student'));
        // }
    }

}

    public function insert(Request $request)
    {
        $input = $request->all();

            foreach ($request->multiclass as $key => $teach) {
                $data2 = array(
                            'admission_id'=> $request->student_id,
                            'semester_id'=> $request->semester_id,
                            'department_id'=> $request->department_id,
                            'level_id'=> $request->level_id,
                            'class_assign_id'=>$request->multiclass [$key]);
                SemesterDetail::insert($data2);
            }

        Flash::success('Class Assigning Generate successfully!.');

        return redirect(route('classAssignings.index'));
    }

    
    
        public function read_student_fee($student_id)
    {
        return  StudentFee::join('fee_structures', 'fee_structures.id', '=', 'student_fees.fee_id')
                             ->join('semesters', 'semesters.id', '=', 'fee_structures.semester_id')
                            ->join('admissions', 'admissions.id', '=', 'student_fees.student_id')
                            // ->join('semester_subjects', 'semester_subjects.id', '=', 'fee_structures.semester_id')
                            ->join('levels', 'levels.id', '=', 'student_fees.level_id')
                            // ->join('courses', 'courses.id', '=', 'semester_subjects.course_id')
                             ->select(
                                //  'courses.course_name',
                                    'levels.id',
                                    'levels.level',
                                    'semesters.semester_name',
                                    // 'semesters.semester_name',
                                    // 'semesters.*',
                                    'fee_structures.semesterFee as semester_fee',
                                    'admissions.id as student_id',
                                    'fee_structures.fee_type',
                                    'student_fees.student_fee_id',
                                    'student_fees.amount as semester_fee_amount')
                                    // ,
                                    // 'studentfees.discount')
                             ->where('admissions.id', $student_id)
                             ->orderBy('student_fees.student_fee_id', 'ASC');
                            // return $result;
    }

    public function read_student_transaction($student_id) 
    {
        return InvoiceDetails::
        join('invoices', 'invoices.id', 'invoice_details.invoice_id')
                        ->join('admissions', 'admissions.id', '=', 'invoice_details.student_id')
                        ->join('transactions', 'transactions.transaction_id', '=', 'invoice_details.transaction_id')
                        ->join('fee_structures', 'fee_structures.id', '=', 'transactions.semester_fee_id')
                        ->join('users', 'users.id', '=', 'transactions.user_id')
                        // ->select('fee_structures.id as semester_fee_id')
                        // dd();
                        ->where('admissions.id', $student_id);
    }

    public function student_subjects(Request $request)
    {

        $department_id = $request->get('department_id');
        $semester_id = $request->get('semester_id');
        $degree_id = $request->get('degree_id');
        $faculty_id = $request->get('faculty_id');
        $class_id = $request->get('class_id');
        $semesters = Semester::all();
        $departments = Department::all();
        $levels = Level::all();

        if ($request->department_id == $department_id && $request->faculty_id == $faculty_id  && $request->semester_id == $semester_id && $request->degree_id == $degree_id ) {
           return $classSchedule = ClassSchedule::join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
            
             ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
             ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
            ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
            ->join('classes', 'classes.id','=', 'class_schedule.class_id')
            ->join('days', 'days.day_id','=', 'class_schedule.day_id')
            ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
            ->join('admissions', 'admissions.id','=', 'semesters.id')
            ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
            ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
            ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
            ->join('times', 'times.time_id','=', 'class_schedule.time_id')
            ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')

            ->where('class_schedule.semester_id', $semester_id)
            ->where('class_schedule.department_id', $department_id)
            ->where('class_schedule.degree_id', $degree_id)
            ->where('class_schedule.faculty_id', $faculty_id)
            ->where('class_schedule.class_id', $class_id)
            // ->orderBy('teachers.teacher_id', 'DESC')
            ->get();
    }
}

    public function total_transaction($student_id)
    {
        return InvoiceDetails::join('invoices', 'invoices.id', 'invoice_details.invoice_id')
        ->join('admissions', 'admissions.id', '=', 'invoice_details.student_id')
        ->join('transactions', 'transactions.transaction_id', '=', 'invoice_details.transaction_id')
        ->join('fees', 'fees.id', '=', 'transactions.fee_id')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->select(DB::raw('SUM(transactions.paid_amount) As total_transaction'))
        ->where('admissions.id', $student_id)
        ->groupBy('transactions.semester_fee_id');


    }

    public function showStudentPayment(Request $request)
    {
        $student_id = $request->student_id;

        return $this->payment('fee.payment', $student_id);
    }

    public function show_semester_fee($semester_id)
    {
        return FeeStructure::join('semesters', 'semesters.id', '=', 'fee_structures.semester_id')
                            ->join('faculties','faculties.faculty_id','=', 'fee_structures.faculty_id')
                            ->join('departments','departments.department_id','=', 'fee_structures.department_id')
                            ->join('levels','levels.id','=', 'fee_structures.degree_id')
                    ->select('levels.*','departments.*','semesters.*','faculties.*',
                            'fee_structures.*','fee_structures.id as fee_structures_id')
                    // ->join('fee_structures', 'fee_structures.id', '=', 'fees.fee_structure_id')
                    ->where('semesters.id', $semester_id)
                    ->orderBy('fee_structures.semesterFee', 'DESC')->get();
    }

    public function goPayment($student_id)
    {
        return $this->payment('fee.payment', $student_id);
    }

    public function savePayment(Request $request)
    {
            $input = $request->all();
//   dd($input); die;
            $CheckStudentfee_type = StudentFee::where('student_id', $request->student_id)
                                                ->where('fee_id', $request->fee_id)->count();

            if ($CheckStudentfee_type) {
                
               Flash::error('Student Already Paid this Fee');
               return redirect()->back();
            }else {
                # code...
           
            // dd($input); die;
        $studentFee = StudentFee::create(['student_id' => $request->student_id,
                                        'fee_id' => $request->fee_id,
                                        'amount' => $request->amount,
                                        'level_id' => $request->level_id]);

        $transact = Transaction::create(['transaction_date' => $request->transact_date = date('Y-m-d'),
                                        'fee_id' => $request->fee_id,
                                        'user_id' => $request->user_id,
                                        'student_id' => $request->student_id,
                                        'semester_fee_id' => $studentFee->student_fee_id,
                                        'paid_amount' => $request->paid_amount,
                                        'balance' => $request->balance,
                                        'remark' => $request->remark,
                                        'description' => $request->description]);
        // dd($transact); die;
        $invoice_id = Invoice::autoNumber();

          InvoiceDetails::create(['invoice_id' => $invoice_id,
                                'student_fee_id' => $studentFee->student_fee_id,
                                'student_id' => $request->student_id,
                                'transaction_id' => $transact->transaction_id]);
        Flash::success('Student Payment Save Successfully!.');
        return back();
    }
}

    public function MultipleSavePayment(Request $request)
    {
        $input = $request->all();
        // dd($input);
            $studentFee = array(
                        'fee_id'=> $request->fee_id,
                        'amount'=> $request->amount,
                        'level_id'=> $request->level_id,
                        'student_id'=>$request->multifeepayment);
            StudentFee::insert($studentFee);

        if ($studentFee > 0) {

            $transact = array(
                'transaction_date' => $request->transact_date = date('Y-m-d'),
                'fee_id' => $request->fee_id,
                'user_id' => $request->user_id,
                'student_id'=>$studentFee->student_id,
                'semester_fee_id' => $request->fee_id,
                'paid_amount' => $request->paid_amount,
                'balance' => $request->balance1,
                'remark' => $request->remark,
                'description' => $request->description);
                Transaction::insert($transact);
        }

        // foreach ($request->multifeepayment as $key => $teach) {
                
            // }
        // dd($transact); die;
        $invoice_id = Invoice::autoNumber();

        // foreach ($request->multifeepayment as $key => $teach) {
                $invoice_detail = array(
                'invoice_id' => $invoice_id,
                'student_fee_id' => $request->student_fee_id,
                'student_id' => $teach,
                'transaction_id' => $transact->transaction_id);
                InvoiceDetails::insert($invoice_detail);
            // }
        Flash::success('Student Payment Save Successfully!.');
        return back();

        Flash::success('Class Assigning Generate successfully!.');

        return redirect(route('classAssignings.index'));
    }

    public function createFee(Request $request)
    {
        if ($request->ajax()) {
            $fee = Fees::create($request->all());

            return   response($fee);
        }
    }

    public function pay(Request $request)
    {
        if ($request->ajax()) {

            $studentFee =   StudentFee::join('fee_structures', 'fee_structures.id', '=', 'student_fees.fee_id')
            ->join('semesters', 'semesters.id', '=', 'fee_structures.semester_id')
           ->join('admissions', 'admissions.id', '=', 'student_fees.student_id')
           ->join('semester_subjects', 'semester_subjects.id', '=', 'fee_structures.semester_id')
           ->join('levels', 'levels.id', '=', 'student_fees.level_id')
           // ->join('courses', 'courses.id', '=', 'semester_subjects.course_id')
            ->select(
               //  'courses.course_name',
                   'levels.id',
                   'levels.degree_name',
                   'semesters.semester_name',
                   // 'semesters.*',
                   'fee_structures.semesterFee as semester_fee',
                   'fee_structures.id as fee_structure_id',
                   'admissions.id as student_id',
                   // 'student_fees.*',
                   'student_fees.student_fee_id',
                   'student_fees.amount as semester_fee_amount')
        ->where('student_fees.student_fee_id', $request->student_fee_id)->first();

            return response($studentFee);
        }
    }

    public function exstraPay(Request $request)
    {
        $transact = Transaction::create($request->all());
        if (count([$transact]) != 0) {
            $transact_id = $transact->transact_id;
            $student_id = $transact->student_id;
            $receipt_id = Invoice::autoNumber();
            $receipt_id =   Invoice::where('id', now()->id)->increment();
            InvoiceDetails::create(['receipt_id' => $receipt_id, 'student_id' => $student_id, 'transact_id' => $transact_id]);
            Session::flash('success', 'Extra Payment Successfull');

            return back();
        }
    }

    public function deleteTransact($transact_id)
    {
        Transaction::destroy($transact_id);
        Session::flash('success', 'Transaction Deleted Successfull');

        return back();
    }

    public function deleteStudentFee($student_fee_id)
    {
        StudentFee::findOrfail($student_fee_id)->delete();

        Flash::success('Student Fee along with Transaction related Deleted Successfull');
        Session::flash('success', 'Transaction Deleted Successfull');
        return back();

    }

    public function showStudentLevel(Request $request)
    {
        $status = ClassSchedule::join('levels', 'levels.id', '=', 'classes.level_id')
                       ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                       ->join('times', 'times.time_id', '=', 'classes.time_id')
                       ->join('groups', 'groups.group_id', '=', 'classes.group_id')
                       ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                       ->join('teachers', 'teachers.teacher_id', '=', 'classes.teacher_id')
                       ->join('days', 'days.day_id', '=', 'classes.day_id')
                       ->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                       ->join('programs', 'programs.program_id', '=', 'levels.program_id')
                       ->join('statuses', 'statuses.class_id', '=', 'classes.class_id')
                       ->where('levels.id', $request->level_id)
                       ->where('statuses.student_id', $request->student_id)
                       ->select(DB::raw('CONCAT(programs.program,

                                        " / Level=",levels.level,
                                         " / Shift=",shifts.shift,
                                         " / Time=",times.time,
                                         " / Group=",groups.group,
                                         " / Batch=",batches.batch
                                         " / Teacher=",teachers.first_name," ",teachers.last_name,
                                         " / Day=",days.days,

                                           ) As details'))

                                           ->first();
        // dump($status);

        return response($status);
    }

    //------------------------------ test -------------------------
    public function createStudentLevel()
    {
        Status::insert(['student_id' => 1, 'class_id' => 1]);
    }

    //--------------------------- Fee Report ----------------------

    public function ClasswiseFeeReport(Request $request)
    {
        // dd($request->all());
        if($request->ajax())
        {
            if ($request->roll_no != '') {
               $data = $this->classwisefeeInfo()
                   ->select('users.name', 
                   'admissions.id as student_id',
                   'admissions.first_name',
                   'admissions.last_name',
                   'fee_structures.semesterFee as school_fee',
                   'fee_structures.fee_type',
                   'student_fees.amount as student_fee',
                   'classes.class_code',
                   'semesters.semester_name',
                   'levels.level',
                   'invoices.id as invoice_id',
                   'rolls.username',
                   'transactions.transaction_date',
                   'transactions.balance',
                   'transactions.paid_amount as paid_amount')
               ->where('rolls.username', $request->roll_no)
               ->orderBy('admissions.id')
                   ->get();

            } 
            elseif($request->class_code != '' && $request->semester_id != '')
            {
                $data = $this->classwisefeeInfo()
                ->select('users.name', 
                'admissions.id as student_id',
                'admissions.first_name',
                'admissions.last_name',
                'fee_structures.semesterFee as school_fee',
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
            ->where('classes.class_code', $request->class_code)
            ->where('semesters.id', $request->semester_id)
            ->orderBy('admissions.id')
                ->get();
            }
            else if ($request->from_date != '' && $request->to_date != '') {
                $data = $this->classwisefeeInfo()
                ->select('users.name', 
                'admissions.id as student_id',
                'admissions.first_name',
                'admissions.last_name',
                'fee_structures.semesterFee as school_fee',
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
                ->whereDate('transactions.transaction_date', '>=', $request->from_date)
                ->whereDate('transactions.transaction_date', '<=', $request->to_date)
                ->orderBy('admissions.id')
                    ->get();
             }
            else 
            {
            $data = DB::table('transactions')->orderBy('transaction_date', 'desc')->get();
            }

            $classes = Classes::where('status', 'on')->get();
            $semesters = Semester::where('status', 'on')->get();

                $students = $this->classwisefeeInfo()
                    ->select('users.name', 
                    'admissions.id as student_id',
                    'admissions.first_name',
                    'admissions.last_name',
                    'fee_structures.semesterFee as school_fee',
                    'fee_structures.fee_type',
                    'student_fees.amount as student_fee',
                    'classes.class_code',
                    'semesters.semester_name',
                    'levels.level',
                    'invoices.id as invoice_id',
                    'rolls.username',
                    'transactions.transaction_date',
                    'transactions.balance',
                    'transactions.paid_amount as paid_amount')
                ->where('rolls.username', $request->roll_no)
                ->orderBy('admissions.id')
                    ->first();

            $view = view('report.fee_report.table')
            ->with('semesters', $semesters )
            ->with('students', $students )
            ->with('data', $data)
            ->with('classes', $classes)
            ->render();
            return response($view);
        }

    }

    
    public function classwisefeeInfo()
    {
        return InvoiceDetails::
        join('invoices', 'invoices.id', 'invoice_details.invoice_id')
                        // ->join('rolls', 'rolls.roll_id', '=', 'invoice_details.student_id')
                        ->join('admissions', 'admissions.id', '=', 'invoice_details.student_id')
                        ->join('transactions', 'transactions.transaction_id', '=', 'invoice_details.transaction_id')
                        ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                        ->join('users', 'users.id', '=', 'transactions.user_id')
                        ->join('semesters', 'semesters.id', '=', 'admissions.semester_id')
                        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                        ->join('levels', 'levels.id', '=', 'admissions.degree_id')
                        ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
                        ->join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.semester_fee_id');
    }


    public function getFeeReport(Request $request)
    {
        $data = $this->feeInfo()
        ->select('users.name', 
        'admissions.id as student_id',
        'admissions.first_name',
        'admissions.last_name',
        'fee_structures.semesterFee as school_fee',
        'fee_structures.fee_type',
        'student_fees.amount as student_fee',
        // 'student_fees.discount',
        'invoices.id as invoice_id',
        'transactions.transaction_date',
        'transactions.balance',
        'transactions.paid_amount as paid_amount')
        // ->whereBetween('transactions.transaction_date', array($request->from_date, $request->to_date))
    // ->whereDate('transactions.transaction_date', '>=', $request->from_date)
    // ->whereDate('transactions.transaction_date', '<=', $request->to_date)
    // ->orderBy('admissions.id')
        ->get();

        return view('fee.feeReport')->with('data', $data);
    }

    //============================================================

    public function showFeeReport(Request $request)
    {

        if($request->ajax())
        {
            if ($request->roll_no != '') {
               $data = $this->classwisefeeInfo()
                   ->select('users.name', 
                   'admissions.id as student_id',
                   'admissions.first_name',
                   'admissions.last_name',
                   'fee_structures.semesterFee as school_fee',
                   'fee_structures.fee_type',
                   'student_fees.amount as student_fee',
                   'classes.class_code',
                   'semesters.semester_name',
                   'levels.level',
                   'invoices.id as invoice_id',
                   'rolls.username',
                   'transactions.transaction_date',
                   'transactions.balance',
                   'transactions.paid_amount as paid_amount')
               ->where('rolls.username', $request->roll_no)
               ->orderBy('admissions.id')
                   ->get();

            } 
            elseif($request->class_code != '' && $request->semester_id != '')
            {
                $data = $this->classwisefeeInfo()
                ->select('users.name', 
                'admissions.id as student_id',
                'admissions.first_name',
                'admissions.last_name',
                'fee_structures.semesterFee as school_fee',
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
            ->where('classes.class_code', $request->class_code)
            ->where('semesters.id', $request->semester_id)
            ->orderBy('admissions.id')
                ->get();
            }
            else if ($request->from_date != '' && $request->to_date != '') {
                $data = $this->classwisefeeInfo()
                ->select('users.name', 
                'admissions.id as student_id',
                'admissions.first_name',
                'admissions.last_name',
                'fee_structures.semesterFee as school_fee',
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
                ->whereDate('transactions.transaction_date', '>=', $request->from_date)
                ->whereDate('transactions.transaction_date', '<=', $request->to_date)
                ->orderBy('admissions.id')
                    ->get();
             }
            else 
            {
            $data = DB::table('transactions')->orderBy('transaction_date', 'desc')->get();
            }

            $classes = Classes::where('status', 'on')->get();
            $semesters = Semester::where('status', 'on')->get();

                $students = $this->classwisefeeInfo()
                    ->select('users.name', 
                    'admissions.id as student_id',
                    'admissions.first_name',
                    'admissions.last_name',
                    'fee_structures.semesterFee as school_fee',
                    'fee_structures.fee_type',
                    'student_fees.amount as student_fee',
                    'classes.class_code',
                    'semesters.semester_name',
                    'levels.level',
                    'invoices.id as invoice_id',
                    'rolls.username',
                    'transactions.transaction_date',
                    'transactions.balance',
                    'transactions.paid_amount as paid_amount')
                ->where('rolls.username', $request->roll_no)
                ->orderBy('admissions.id')
                    ->first();

            $view = view('report.fee_report.table')
            ->with('semesters', $semesters )
            ->with('students', $students )
            ->with('data', $data)
            ->with('classes', $classes)
            ->render();
            return response($view);
        }
    }
 
    //--------------------------------------------------

    public function feeInfo()
    {
        return InvoiceDetails::
        join('invoices', 'invoices.id', 'invoice_details.invoice_id')
                        // ->join('rolls', 'rolls.roll_id', '=', 'invoice_details.student_id')
                        ->join('admissions', 'admissions.id', '=', 'invoice_details.student_id')
                        ->join('transactions', 'transactions.transaction_id', '=', 'invoice_details.transaction_id')
                        ->join('fee_structures', 'fee_structures.id', '=', 'transactions.semester_fee_id')
                        ->join('users', 'users.id', '=', 'transactions.user_id')
                        ->join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.fee_id');
        // return  Transaction::join('fees', 'fees.id', '=', 'transactions.fee_id')
                    // ->join('admissions', 'admissions.id', '=', 'transactions.student_id')
                    // ->join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.fee_id')
                    // ->join('fee_structures', 'fee_structures.id', '=', 'transactions.semester_fee_id')
                    // ->join('users', 'users.id', '=', 'transactions.user_id');
        // ->join('students','students.student_id','=','transaction.student_id')
    }

    public function Reports(Request $request)
    {
        $classes = Classes::where('status', 'on')->get();
        $semesters = Semester::where('status', 'on')->get();
        return view('report.index', compact('classes','semesters'));
    }

    public function FeeReport(Request $request)
    {
        $classes = Classes::where('status', 'on')->get();
        $semesters = Semester::where('status', 'on')->get();

            $data = $this->classwisefeeInfo()
                ->select('users.name', 
                'admissions.id as student_id',
                'admissions.first_name',
                'admissions.last_name',
                'fee_structures.semesterFee as school_fee',
                'fee_structures.fee_type',
                'student_fees.amount as student_fee',
                'classes.class_code',
                'semesters.semester_name',
                'levels.level',
                'invoices.id as invoice_id',
                'rolls.username',
                'transactions.transaction_date',
                'transactions.balance',
                'transactions.paid_amount as paid_amount')
                // ->whereBetween('transactions.transaction_date', array($request->from_date, $request->to_date))
            ->where('rolls.username', $request->roll_no)
         //    ->whereDate('transactions.transaction_date', '<=', $request->to_date)
            ->orderBy('admissions.id')
                ->get();

                $students = Roll::where('student_id', $request->student_id)->first();

        return view('report.fee_report.index', compact('classes','semesters','students'))->with('data',$data);
    }

    public function All_Student_Fee_Transactios($student_id)
    {
        $data = $this->classwisefeeInfo()
        ->select('users.name', 
        'admissions.id as student_id',
        'admissions.first_name',
        'admissions.last_name',
        'fee_structures.semesterFee as school_fee',
        'fee_structures.fee_type',
        'student_fees.amount as student_fee',
        'classes.class_code',
        'semesters.semester_name',
        'levels.level',
        'invoices.id as invoice_id',
        'rolls.username',
        'transactions.transaction_date',
        'transactions.balance',
        'transactions.paid_amount as paid_amount')
        // ->whereBetween('transactions.transaction_date', array($request->from_date, $request->to_date))
    ->where('admissions.id', $student_id)
 //    ->whereDate('transactions.transaction_date', '<=', $request->to_date)
    ->orderBy('admissions.id')
        ->get();
// dd($data);
        $student_id = Admission::where('id', $student_id)->first();

        return view('admins.students.transactions', compact('data','student_id'));
    }
}
