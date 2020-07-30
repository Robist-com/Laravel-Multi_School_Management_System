<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\ClassRoom;
use App\Models\Course;
use App\Models\Day;
use App\Models\Level;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Time;
use App\Models\ClassSchedule;
use App\Models\Admission;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\Transaction;
use App\Models\Faculty;
use App\Models\FeeStructure;
use App\StudentFee;
use App\Models\ClassAssigning;
use DB;
class HomeController extends Controller
{
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
        // $batchCount = Batch::count();
        $batchCount = Batch::count(); // this function ccount count the batch from the batch table but we are using modal okay.
        $studentsCount = Admission::count(); 
        $classCount = Classes::count();
        $courseCount = Course::count();
        $dayCount = Day::count();
        $levelCount = Level::count();
        $semesterCount =  Semester::count();
        $shiftCount = Shift::count();
        $feeCount = StudentFee::count();
        $timeCount = Time::count();
        $classroomCount = ClassRoom::count();
        $teachersCount = Teacher::count();
        $classasignCount = ClassAssigning::count();
        $classschedulCount = ClassSchedule::count();
        $facultyCount = Faculty::count();
        $departmentCount = Department::count();
        $feeStructureCount = FeeStructure::count();
        $transactionsCount = Transaction::count();


        $transactions = Transaction::join('student_fees', 'student_fees.student_fee_id', '=', 'transactions.semester_fee_id')
                                    ->get();
        $student_fees = StudentFee::join('transactions', 'transactions.semester_fee_id','=','student_fees.student_fee_id')->get();



        // dd( $batchCount);
        // return view('home', compact('batchCount'));
        return view('home', compact('batchCount','transactionsCount','transactions','student_fees',
        'studentsCount','classCount','courseCount','dayCount','feeCount',
        'levelCount','semesterCount','shiftCount','timeCount','feeStructureCount',
        'classroomCount','teachersCount','classschedulCount','classasignCount',
        'facultyCount','departmentCount'));
        // $batchCount = Batch::count();
        // dd( $batchCount);
        // return view('home', compact('batchCount'));
    }

    public function admin(Request $req){
        return view('middleware')->withMessage("Admin");
        }

        public function super_admin(Request $req){
        return view('middleware')->withMessage("Super Admin");
        }

        public function member(Request $req){
        return view(‘middleware’)->withMessage(“Member”);
        }

}
