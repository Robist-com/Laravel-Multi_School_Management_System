<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Repositories\TransactionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Semester;
use App\Models\Classes;
use App\Roll;
use App\InvoiceDetails;
use App\Invoice;
use DB;
use App\StudentFee;
use App\Models\Transaction;
class TransactionController extends AppBaseController
{
    /** @var  TransactionRepository */
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepo)
    {
        $this->transactionRepository = $transactionRepo;

			$this->middleware('auth');

    }

    /**
     * Display a listing of the Transaction.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $transactions = $this->transactionRepository->all();

                $semester = Semester::where('status', 'on')->where('school_id', auth()->user()->school_id)->get();
                $classes = Classes::where('school_id', auth()->user()->school_id)->get();
                $semester_id = $request->get('semester_id');
                $class_code = $request->get('class_code');
                $roll_no = $request->get('roll_no');
                $readStudentFee = $this->read_student_fee($request->student_id)->get();
                $readStudentTransaction = $this->read_student_transaction($request->student_id)->get();
                // if ($request->roll_no != "")
                // {
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
                                //   ->where('rolls.username', $roll_no)
                                  ->where('transactions.school_id', auth()->user()->school_id)
                                  ->get();

                            return view('transactions.index')
                                    ->with('readStudentFee', $readStudentFee)
                                    ->with('data', $data )->with('semester', $semester )
                                    ->with('readStudentTransaction', $readStudentTransaction)
                                    // ->with('totalTransaction', $totalTransaction)
                                    // ->with('rolls', $rolls)
                                    ->with('classes', $classes)
                                    ->with('transactions', $transactions);
                                    // ->render();
                        
                                // return response($view);

    }

    public function getStudentTransactions(Request $request)
    {
        $transactions = $this->transactionRepository->all();

                $semester = Semester::where('status', 'on')->get();
                $classes = Classes::all();
                $semester_id = $request->get('semester_id');
                $class_code = $request->get('class_code');
                $roll_no = $request->get('roll_no');
                $readStudentFee = $this->read_student_fee($request->student_id)->get();
                $readStudentTransaction = $this->read_student_transaction($request->student_id)->get();
                if ($request->roll_no != "")
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
                                  ->where('rolls.username', $roll_no)
                                  ->where('admissions.school_id', auth()->user()->school_id)
                                //   ->where('admissions.semester_id',$semester_id)
                                  ->get();
                                //   dd($data);
                                  if(count($data)=="0"){
                                    return response()->json(['message' => 'No Tranactions Found Under This Roll Number ' . $roll_no . '']);
                                     return back();
                                    // return response()->json(['success'=> "No Tranactions Found Under This Roll Number " . $roll_no. '']);
                                    //   echo "<td></td><td></td><td></td><h1 align='center' class=' alert alert-danger'>No Class Found Under This Course </h1><td></td><td></td><td></td>";
                                    }

                                

                }
                elseif($request->class_code != '' && $request->semester_id != '')
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
                                  ->where('admissions.school_id', auth()->user()->school_id)
                                ->get();

                                if(count($data)=="0"){
                                    return response()->json(['message' => 'No Tranactions Found Under Grade ' . $semester_id . ' and Class ' . $class_code. '']);
                                     return back();
                                    // return response()->json(['success'=> "No Tranactions Found Under This Roll Number " . $roll_no. '']);
                                    //   echo "<td></td><td></td><td></td><h1 align='center' class=' alert alert-danger'>No Class Found Under This Course </h1><td></td><td></td><td></td>";
                                    }
                            
                }
                $rolls = Roll::where('username', $roll_no)->first();

                $view = view('transactions.search-transactions.transactions')
                                    ->with('readStudentFee', $readStudentFee)
                                    ->with('data', $data )->with('semester', $semester )
                                    ->with('readStudentTransaction', $readStudentTransaction)
                                    // ->with('totalTransaction', $totalTransaction)
                                    ->with('rolls', $rolls)
                                    ->with('classes', $classes)
                                    ->with('transactions', $transactions)->render();
                        
                                return response($view);
        }

    public function StudentTransactionPrint($student_id)
    {
        $student_info = InvoiceDetails::join('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
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
                        ->where('transactions.student_id', $student_id)
                        ->where('admissions.school_id', auth()->user()->school_id)
                        ->select('admissions.id',
                                    'admissions.first_name',
                                    'admissions.last_name',
                                    'admissions.gender',
                                    'semesters.semester_name',
                                    'faculties.faculty_name',
                                    'departments.department_name',
                                    'fee_structures.semesterFee as semesterFee',
                                    // 'fee_structures.admissionFee as admissionFee',
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
                        ->where('transactions.student_id', $student_id)
                        ->where('admissions.school_id', auth()->user()->school_id)
                        
                        ->select('admissions.id',
                                    'admissions.first_name',
                                    'admissions.last_name',
                                    'admissions.gender',
                                    'semesters.semester_name',
                                    'faculties.faculty_name',
                                    'departments.department_name',
                                    'fee_structures.semesterFee as semesterFee',
                                    // 'fee_structures.admissionFee as admissionFee',
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
                                    // ->where('transactions.student_id', $student_id)->sum('paid_amount')
                                    ->get();

        $totalPaid = Transaction::where('student_id', $student_id)->where('school_id', auth()->user()->school_id)->sum('paid_amount');
        $balance = Transaction::where('student_id', $student_id)->where('school_id', auth()->user()->school_id)->sum('balance');

        $studentFee = StudentFee::find($student_info->semester_fee_id);
        $roll_no = Roll::where('username',$student_info->roll_no)->first();
        // $roll = $this->student_roll($invoice->student_id);

        // dump( $totalPaid);
        // dump($roll_no);die;
        return view('report.transactions.students.transaction', compact('invoice','roll_no', 
        'student_info',  'totalPaid', 'balance', 'studentFee'));

        
    }


    public function read_student_transaction($student_id) 
    {
        return InvoiceDetails::
        join('invoices', 'invoices.id', 'invoice_details.invoice_id')
                        ->join('admissions', 'admissions.id', '=', 'invoice_details.student_id')
                        ->join('transactions', 'transactions.transaction_id', '=', 'invoice_details.transaction_id')
                        ->join('fee_structures', 'fee_structures.id', '=', 'transactions.fee_id')
                        ->join('users', 'users.id', '=', 'transactions.user_id')
                        // ->select('fee_structures.id as semester_fee_id')
                        // dd();
                        ->where('admissions.id', $student_id)
                        ->where('admissions.school_id', auth()->user()->school_id);
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
                                    // 'student_fees.*',
                                    'student_fees.student_fee_id',
                                    'student_fees.amount as semester_fee_amount')
                                    // ,
                                    // 'studentfees.discount')
                             ->where('admissions.id', $student_id)
                             ->where('admissions.school_id', auth()->user()->school_id)
                             ->orderBy('student_fees.student_fee_id', 'ASC');
                            // return $result;
    }


    /**
     * Show the form for creating a new Transaction.
     *
     * @return Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created Transaction in storage.
     *
     * @param CreateTransactionRequest $request
     *
     * @return Response
     */
    public function store(CreateTransactionRequest $request)
    {
        $input = $request->all();

        $transaction = $this->transactionRepository->create($input);

        Flash::success('Transaction saved successfully.');

        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified Transaction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('transactions.index'));
        }

        return view('transactions.show')->with('transaction', $transaction);
    }

    /**
     * Show the form for editing the specified Transaction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('transactions.index'));
        }

        return view('transactions.edit')->with('transaction', $transaction);
    }

    /**
     * Update the specified Transaction in storage.
     *
     * @param int $id
     * @param UpdateTransactionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransactionRequest $request)
    {
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('transactions.index'));
        }

        $transaction = $this->transactionRepository->update($request->all(), $id);

        Flash::success('Transaction updated successfully.');

        return redirect(route('transactions.index'));
    }

    /**
     * Remove the specified Transaction from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('transactions.index'));
        }

        $this->transactionRepository->delete($id);

        Flash::success('Transaction deleted successfully.');

        return redirect(route('transactions.index'));
    }

    public function DeleteTransactions(Request $request, $transac_id)
    {
     $delete =    DB::table('transactions')
        ->leftJoin('student_fees','student_fees.student_fee_id','=', 'transactions.semester_fee_id')
        ->leftJoin('invoice_details','invoice_details.student_fee_id','=', 'transactions.semester_fee_id')
        ->where('transactions.transaction_id', $transac_id)
        ->where('invoice_details.transaction_id', $transac_id)
        // ->leftJoin('invoice_details','invoice_details.student_fee_id','=', 'transactions.semester_fee_id')
        ->delete();
dd($delete);

    }
}
