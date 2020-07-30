<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdmissionRequest;
use App\Http\Requests\UpdateAdmissionRequest;
use App\Repositories\AdmissionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use App\Models\Admission;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\ClassSchedule;
use App\Models\Batch;
use App\Models\Classes;
use App\Models\Semester;
use App\Models\Level;
use App\Roll;
use App\PromoteStudent;
// use App\NewStatus;
use PDF;
use DB;
use Validator;
use App\InvoiceDetails;
use App\Models\FeeStructure;
use App\StudentFee;
class AdmissionController extends AppBaseController
{
    /** @var  AdmissionRepository */
    private $admissionRepository;

    public function __construct(AdmissionRepository $admissionRepo)
    {
        $this->admissionRepository = $admissionRepo;
    }

    /**
     * Display a listing of the Admission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {

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
        // $class_grade = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')->
        // where('teacher_id', Auth::user()->teacher_id)->where('class_id',$class_name->class_code)->GET();
        // dd($class_grade);

        // $admissions = Admission::join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
        //                         ->join('departments','departments.department_id','=', 'admissions.department_id')
        //                         ->join('batches','batches.id','=', 'admissions.batch_id')->get();
                                // dd($admissions); die;
                                $admissions = Admission::join('faculties','faculties.faculty_id', 'admissions.faculty_id')
                                ->join('departments','departments.department_id', 'admissions.department_id')
                                // ->join('batches','batches.id', '=', 'admissions.batch_id')
                                ->paginate(10);
                                // all();
                                $admission = Admission::join('faculties','faculties.faculty_id', 'admissions.faculty_id')
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
        return view('admissions.index', compact('admissions','levels', 'admission','Semester','classes','student_id','faculties','departments','batches','roll_id','rand_username_password'));

    }

    public function SortStudent(Request $request)
    {

        if ($request->sort_by_gender != '') {

            $allStudentList = Roll::join('admissions','admissions.id','=','rolls.student_id')
            ->join('semesters','semesters.id','=','admissions.semester_id')
            ->join('classes','classes.class_code','=','admissions.class_code')
            ->join('departments','departments.department_id','=','admissions.department_id')
            ->join('faculties','faculties.faculty_id','=','admissions.faculty_id')
            ->where('gender', $request->sort_by_gender)->get();

        }
        else if($request->roll_no != '')
        {
            $allStudentList = Roll::join('admissions','admissions.id','=','rolls.student_id')
            ->join('semesters','semesters.id','=','admissions.semester_id')
            ->join('classes','classes.class_code','=','admissions.class_code')
            ->join('departments','departments.department_id','=','admissions.department_id')
            ->join('faculties','faculties.faculty_id','=','admissions.faculty_id')
            ->where('rolls.username', $request->roll_no)->get();

        }

        else
        {
            $allStudentList = Roll::join('admissions','admissions.id','=','rolls.student_id')
            ->join('semesters','semesters.id','=','admissions.semester_id')
            ->join('classes','classes.class_code','=','admissions.class_code')
            ->join('departments','departments.department_id','=','admissions.department_id')
            ->join('faculties','faculties.faculty_id','=','admissions.faculty_id')->get();
        }

        $male = Admission::where('gender', '0')->count();
        $female = Admission::where('gender', '1')->count();

        $view = view('admissions.students.table_list',compact('female','male'))
        ->with('allStudentList', $allStudentList)
        ->with('female', $female)
        ->with('male', $male)->render();
    
         return response($view);
}

public function StudentList(Request $request)
{
    $allStudentList = Roll::join('admissions','admissions.id','=','rolls.student_id')
            ->join('semesters','semesters.id','=','admissions.semester_id')
            ->join('classes','classes.class_code','=','admissions.class_code')
            ->join('departments','departments.department_id','=','admissions.department_id')
            ->join('faculties','faculties.faculty_id','=','admissions.faculty_id')->paginate(8);

        $male = Admission::where('gender', '0')->count();
        $female = Admission::where('gender', '1')->count();

        return view('admissions.students.studentList',compact('female','male'))
        ->with('allStudentList', $allStudentList)
        ->with('female', $female)
        ->with('male', $male);
}

    /**
     * Show the form for creating a new Admission.
     *
     * @return Response
     */
    public function create()
    {
        return view('admissions.create');
    }

    /**
     * Store a newly created Admission in storage.
     *
     * @param CreateAdmissionRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

    //    but we will use the simples way of this now let's remove this
         $file = $request->file('image');
         $extension = $file->getClientOriginalExtension();
         $new_image_name = time(). '.' .$extension;
         $file->move(public_path('student_images'), $new_image_name);


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
            $student->user_id = Auth::id(); // is the user who has the role to create students okay.
            $student->image = $new_image_name;

        // so here we will add condition okay to check if insert to proceed to next level okay.
       if($student->save()){
            $student_id =$student->id;
            $username = 'username';
            $password = 'password';

            Roll::insert(['student_id' => $student_id, 'username'=>
             $request->username,'password'=> $request->password, 'semester_id'=> $request->semester_id]);

            PromoteStudent::insert(['student_id' => $student_id,'grade_id' => $request->semester_id,
            'class_code'=> $request->class_id, 'status' =>'current']);

            //  dump($request->all()); die;

            // NewStatus::insert(['student_id' => $student_id, 'semester_id' => $request->semester_id]);

            // return redirect()->route('showStudentRoll', ['student_id' => $student_id]);
            // return redirect()->route('view_student_timetable', ['student_id' => $student_id]);


       }

        // $admission = $this->admissionRepository->create($input);


        Flash::success('Admission ' .$request->first_name. ''.$request->last_name. ' saved successfully.');

        return redirect(route('admissions.index'));
    }

    /**
     * Display the specified Admission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $admission = $this->admissionRepository->find($id);

        if (empty($admission)) {
            Flash::error('Admission not found');

            return redirect(route('admissions.index'));
        }

        return view('admissions.show')->with('admission', $admission);
    }

    /**
     * Show the form for editing the specified Admission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faculties = Faculty::all(); // we fetch all faculty
        $departments = Department::all(); // we fetch all departments
        $batches = Batch::all(); // we fetch all departments
    //    we don't need to update this part okay it fix for the student okay later we will work
    // on the password section how to change it and make a new password as you wish okay..

        $admission = $this->admissionRepository->find($id);

        if (empty($admission)) {
            Flash::error('Admission not found');

            return redirect(route('admissions.index'));
        }

        return view('admissions.edit', compact('faculties','departments','batches'))->with('admission', $admission);
    }

    /**
     * Update the specified Admission in storage.
     *
     * @param int $id
     * @param UpdateAdmissionRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        // $admission = $this->admissionRepository->find($id);
        // $input = $request->all();

             $file = $request->file('image');
             $extension = $file->getClientOriginalExtension();
             $new_image_name = time(). '.' .$extension;
             $file->move(public_path('student_images'), $new_image_name);


            //  now is the part to store our informayion isde the database okay.

            $student = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'father_phone' => $request->father_phone,
            'mother_name' => $request->mother_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'email' => $request->email,
            'status' => $request->status,
            'nationality' => $request->nationality,
            'passport' => $request->passport,
            'address' => $request->address,
            'current_address' => $request->current_address,
            'department_id' => $request->department_id,
            'faculty_id' => $request->faculty_id,
            'class' => $request->class_id,
            'dateregistered' => date('Y-m-d'),
            'batch_id' => $request->batch_id,
            'user_id' => Auth::id(), // is the user who has the role to create students okay.
            'image' => $new_image_name
            );

            // dd($student); die;
            Admission::findOrfail($id)->update($student);
            // thats all what we need here okay.
        // $admission = $this->admissionRepository->update($request->all(), $id);


        Flash::success($request->first_name.' '.$request->last_name.  ' updated successfully.');

        return redirect(route('admissions.index'));
    }

/**
     * Update the specified Admission in storage.
     *
     * @param tinyint $request
     * @param UpdateAdmission  $request
     *
     * @return Response
     */

    public function updateStatus(Request $request)
    {
        $students = Admission::findOrFail($request->student_id);
        $students->status = $request->status;
        $students->save();

        return response()->json(['message' => 'Admission Student status updated successfully.']);
    }


    /**
     * Remove the specified Admission from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $admission = $this->admissionRepository->find($id);

        if (empty($admission)) {
            Flash::error('Admission not found');

            return redirect(route('admissions.index'));
        }

        $this->admissionRepository->delete($id);

        Flash::success('Admission deleted successfully.');

        return redirect(route('admissions.index'));
    }

    public function PDFgenerator()
    {
     $admissions = Admission::all();
     $admissions = Admission::join('faculties','faculties.faculty_id', 'admissions.faculty_id')
     ->join('departments','departments.department_id', 'admissions.department_id')
     ->join('batches','batches.id', 'admissions.batch_id')->get();

    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('admissions.pdf',['admissions'=> $admissions]);
         // (Optional) Setup the paper size and orientation
         $dompdf->setPaper('A4', 'landscape');

         // Output the generated PDF to Browser
         $dompdf->stream();

         return $dompdf->download('All-Admissions.pdf');
    }

        public function print($id)
        {
            // $admissions = DB::table('admissions')->where('id', $id)->get();
            $admissions = Admission::join('faculties','faculties.faculty_id', 'admissions.faculty_id')
                                ->join('departments','departments.department_id', 'admissions.department_id')
                                ->join('batches','batches.id', 'admissions.batch_id')
                                ->where('admissions.id','=', $id )->get();
                // dd( $faculties); die;
            return view('admissions.print',['admissions'=> $admissions]);
        }

        public function PDFgeneratorSingle($id)
        {
            $admissions = Admission::join('faculties','faculties.faculty_id', 'admissions.faculty_id')
            ->join('departments','departments.department_id', 'admissions.department_id')
            ->join('batches','batches.id', 'admissions.batch_id')
            ->where('admissions.id','=', $id )->get();
                // dd( $admissions); die;
                    $dompdf = PDF::loadview('admissions.single_pdf',['admissions'=> $admissions]);
                    // (Optional) Setup the paper size and orientation
                    // $dompdf->setPaper('A4', 'landscape');

                    // Output the generated PDF to Browser
                    $dompdf->stream();

                    return $dompdf->download('Admission.pdf');
        }


        public function PromoteStudents(Request $request)
        {
            $semester = Semester::where('status', 'on')->get();
            $grades_promote = Semester::where('status', 'on')->get();
            $students = Admission::join('rolls', 'rolls.student_id', '=', 'admissions.id')->where('status', 1)->get();
            $faculty = Faculty::all();
            $classes = Classes::all();
            $classes_promote = Classes::all();
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
                ->where('rolls.student_id', $student_id)
                ->get();
    
            $fee_structure = FeeStructure::all();
            $fee_structure1 = FeeStructure::all();
            $fee_structure_amount = FeeStructure::where('id', $request->fee_type)->first();
    
                // dd($fee_structure_amount);
    
            return view('admissions.promote_student.index', compact('readStudentTransaction','data','fee_structure1',
                                                    'readStudentFee','semester','faculty','rolls','students','grades_promote','classes_promote',
                                                    'totalTransaction','invoice_id','classes','student_name','fee_structure','fee_structure_amount'));
           
        }

        
        public function PromoteStudent(Request $request)
        {
            if ($request->ajax()) {
            
                $semester_id = $request->get('semester_id');
                $class_code = $request->get('class_code');
                $roll_no = $request->get('roll_no');
                $student_id = $request->get('student_id_single');
                $semester = Semester::where('status', 'on')->get();
                $classes = Classes::all();

                $rolls = Roll::where('username', $roll_no)->Orwhere('student_id',$student_id)->first();
              
                // $readStudentTransaction = $this->read_student_transaction($rolls->student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
        $CheckStudentCount = Admission::where('class_code', $request->class_code)->where('semester_id', $request->semester_id)->count();
     
        if ($request->class_code != '' && $request->semester_id != '')
        {
            $data =  Roll::join('semesters','semesters.id','=', 'rolls.semester_id')
            ->join('admissions', 'admissions.id','=', 'rolls.student_id')
            ->join('departments','departments.department_id','=', 'admissions.department_id')
            ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
            ->join('levels', 'levels.id','=', 'admissions.degree_id')
            ->join('classes', 'classes.class_code','=', 'admissions.class_code')
            ->join('batches', 'batches.id','=', 'admissions.batch_id')
            ->select('admissions.id as student_id','departments.*','semesters.*','semesters.semester_name',
                      'faculties.*','levels.*','rolls.username',
                       'admissions.*',
                       'classes.*', 'classes.id as class_id')
                       ->where('semesters.id',$semester_id)
                       ->where('classes.class_code',$class_code)
                    ->get();

                if ($CheckStudentCount){
                        
                
                   $fee_structure1 = FeeStructure::all();

                    $view = view('admissions.promote_student.class')
                    // ->with('readStudentPromote', $readStudentPromote)
                    ->with('data', $data )
                    ->with('semester', $semester )
                    // ->with('readStudentTransaction', $readStudentTransaction)
                    // ->with('totalTransaction', $totalTransaction)
                    // ->with('students', $students)
                    ->with('fee_structure1', $fee_structure1)
                    // ->with('fee_structure_amount', $fee_structure_amount)
                    ->with('classes', $classes)
                    // ->with('student_name', $student_name)
                    ->render();
            
                    return response($view);
                }
                else 
                {
                return response()->json(['info' => 'No Student Found in this ' . ($request->class_code) . ' and Grade ' . ($request->grade_id) . '']);
                    return back();
                }
                // else 
                // {

                    
        }
        elseif ($request->student_id_single !="" ) 
        {

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
                            ->where('rolls.student_id',$student_id)
                            ->get();

            $students = Admission::where('id', $request->student_id_single)->get();
            $fee_structure_amount = FeeStructure::where('id', $request->fee_type)->first();
        }
        elseif($request->roll_no !="" ) {

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
        else {
            return response()->json(['info' => 'Student in ' . ($request->class_code) . ' Already Promoted to Grade ' . ($request->grade_id) . '']);
            return back();
        }

        // dd($data);
                $fee_structure1 = FeeStructure::all();

                $view = view('admissions.promote_student.field')
                // ->with('readStudentPromote', $readStudentPromote)
                ->with('data', $data )
                ->with('semester', $semester )
                // ->with('readStudentTransaction', $readStudentTransaction)
                // ->with('totalTransaction', $totalTransaction)
                // ->with('students', $students)
                // ->with('fee_structure1', $fee_structure1)
                // ->with('fee_structure_amount', $fee_structure_amount)
                ->with('classes', $classes)
                // ->with('student_name', $student_name)
                ->render();
        
            return response($view);

}
    
}


public function SavePromoteStudent(Request $request)
{
    // dd($request->all());

    $request->validate([
        'grade_id' => 'required|max:255',
        'class_code' => 'required|max:255',
    ]);

    $promoteStudent = PromoteStudent::where('student_id',$request->student_id_single)->where('grade_id', $request->grade_id)->count();

    if ($promoteStudent > 0) {
        Flash::error(' Student ' . $request->student_name. ' Already Promoted to ' . $request->grade_id);

    return back();

    }
    else {

        // $promoteStudentStatus = PromoteStudent::where('student_id',$request->student_id)
        //                         ->where('status', 'previous')->update($promoteStudent);
        
        $student = array(
            'status' => 'previous'
        );
        $promoteStudentStatus = PromoteStudent::where('student_id',$request->student_id_single)
                                ->update($student);
            // dd( $promoteStudentStatus);                    
        $promote = new PromoteStudent;

        $promote->student_id = $request->student_id_single;
        $promote->grade_id = $request->grade_id;
        $promote->class_code = $request->class_code;
        $promote->status = 'current';
        $promote->save();
    }

    Flash::success(' Student ' . $request->student_name. ' Promoted to ' . $request->grade_id);
    return back();
    

}

public function SavePromoteStudentClasswise(Request $request)
{
    //  dd($request->all());

     if($request->ajax())
     {
      $rules = array(
       'class_code_classwise'  => 'required',
       'grade_id_classwise'  => 'required'
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }

     $promoteStudent = PromoteStudent::where('class_code',$request->class_code_classwise)->where('grade_id', $request->grade_id_classwise)->count();
     $CheckpromoteStudent = PromoteStudent::where('class_code',$request->class_code_classwise)->where('grade_id', $request->grade_id_classwise)->first();
    //   dd($promoteStudent );
     if ($promoteStudent > 0) {

            return response()->json(['info' => 'Student in ' . ($request->class_code_classwise) . ' Already Promoted to Grade ' . ($request->grade_id_classwise) . '']);
             return back();
        }

    else
        {
        DB::table('promote_students')->whereIn('student_id', $request->student_id_classwise)
                    // ->where('grade_id', $request->grade_id_classwise)
                    ->update(['status' => 'previous']);
         
        foreach ($request->student_id_classwise as $key => $student) {

            $promote_classwise[]=[
                'student_id' => $student,
                'grade_id' => $request->grade_id_classwise,
                'class_code' => $request->class_code_classwise,
                'status' => 'current'
            ];
        }

        PromoteStudent::insert($promote_classwise);
        return response()->json(['message' => 'Students ' . ($request->class_code_classwise) . ' Promoted to Grade' . ($request->grade_id_classwise) . '']);
        return back();
     }
    }
 
    //  Flash::success(' Student ' . $request->class_name. ' Promoted to ' . $request->grade_name);
    //  return back();
}

public function ShowPromoteStudent(Request $request)
{
        $semester = Semester::where('status', 'on')->get();
        $classes = Classes::all();
        // $students = PromoteStudent::join('adm', 'rolls.student_id', '=', 'admissions.id')->where('status', 1)->get();

    $Allpromotestudents = PromoteStudent::join('admissions','admissions.id','=', 'promote_students.student_id')
                                        ->join('rolls','rolls.student_id','=', 'promote_students.student_id')
                                        ->join('semesters','semesters.id','=', 'promote_students.grade_id')
                                        ->join('classes','classes.class_code','=', 'admissions.class_code')
                                        ->select('admissions.first_name', 'admissions.last_name','admissions.image',
                                                'classes.class_name',
                                                'rolls.username',
                                                'semesters.semester_name',
                                                'promote_students.*')
                                            ->where('promote_students.status', 'current')->get();
    // dd($Allpromotestudents);
    return view('admissions.promote_student.table',compact('classes','semester'))->with('Allpromotestudents', $Allpromotestudents);
}

public function ShowPreviousPromotedStudent($student_id)
{
        $semester = Semester::where('status', 'on')->get();
        $classes = Classes::all();
        // $students = PromoteStudent::join('adm', 'rolls.student_id', '=', 'admissions.id')->where('status', 1)->get();

    $promotestudent_current = PromoteStudent::join('admissions','admissions.id','=', 'promote_students.student_id')
                                        ->join('rolls','rolls.student_id','=', 'promote_students.student_id')
                                        ->join('semesters','semesters.id','=', 'promote_students.grade_id')
                                        ->join('classes','classes.class_code','=', 'admissions.class_code')
                                        ->select('admissions.first_name', 'admissions.last_name','admissions.image',
                                                'classes.class_name',
                                                'rolls.username',
                                                'semesters.semester_name',
                                                'promote_students.*')
                                            ->where('promote_students.status', 'current')
                                            ->where('promote_students.student_id', $student_id)->get();

    $promotestudent_previous = PromoteStudent::join('admissions','admissions.id','=', 'promote_students.student_id')
                                        ->join('rolls','rolls.student_id','=', 'promote_students.student_id')
                                        ->join('semesters','semesters.id','=', 'promote_students.grade_id')
                                        ->join('classes','classes.class_code','=', 'admissions.class_code')
                                        ->select('admissions.first_name', 'admissions.last_name','admissions.image',
                                                'classes.class_name',
                                                'rolls.username',
                                                'semesters.semester_name',
                                                'promote_students.*')
                                            ->where('promote_students.status', 'previous')
                                            ->where('promote_students.student_id', $student_id)->get();
    // dd($Allpromotestudents);
    return view('admissions.promote_student.previous.student',compact('classes','semester'))
    ->with('promotestudent_previous', $promotestudent_previous)
    ->with('promotestudent_current', $promotestudent_current);
}


        
public function FilterPromoteStudent(Request $request)
{
    if ($request->ajax()) {
    
        $semester_id = $request->get('semester_id');
        $class_code = $request->get('class_code');
        $roll_no = $request->get('roll_no');
        $student_id = $request->get('student_id_single');
        $semester = Semester::where('status', 'on')->get();
        $classes = Classes::all();

        $rolls = Roll::where('username', $roll_no)->Orwhere('student_id',$student_id)->first();
      
        // $readStudentTransaction = $this->read_student_transaction($rolls->student_id)->orderBy('admissions.id', 'desc')->take(2)->get();
$CheckStudentCount = Admission::where('class_code', $request->class_code)->where('semester_id', $request->semester_id)->count();

if ($request->class_code != '' && $request->semester_id != '')
{
    $data =  Roll::join('semesters','semesters.id','=', 'rolls.semester_id')
    ->join('admissions', 'admissions.id','=', 'rolls.student_id')
    ->join('departments','departments.department_id','=', 'admissions.department_id')
    ->join('faculties','faculties.faculty_id','=', 'admissions.faculty_id')
    ->join('levels', 'levels.id','=', 'admissions.degree_id')
    ->join('classes', 'classes.class_code','=', 'admissions.class_code')
    ->join('batches', 'batches.id','=', 'admissions.batch_id')
    ->select('admissions.id as student_id','departments.*','semesters.*','semesters.semester_name',
              'faculties.*','levels.*','rolls.username',
               'admissions.*',
               'classes.*', 'classes.id as class_id')
               ->where('semesters.id',$semester_id)
               ->where('classes.class_code',$class_code)
            ->get();

        if ($CheckStudentCount){
                
        
           $fee_structure1 = FeeStructure::all();

            $view = view('admissions.promote_student.class')
            // ->with('readStudentPromote', $readStudentPromote)
            ->with('data', $data )
            ->with('semester', $semester )
            // ->with('readStudentTransaction', $readStudentTransaction)
            // ->with('totalTransaction', $totalTransaction)
            // ->with('students', $students)
            ->with('fee_structure1', $fee_structure1)
            // ->with('fee_structure_amount', $fee_structure_amount)
            ->with('classes', $classes)
            // ->with('student_name', $student_name)
            ->render();
    
            return response($view);
        }
        else 
        {
        return response()->json(['info' => 'No Student Found in this ' . ($request->class_code) . ' and Grade ' . ($request->grade_id) . '']);
            return back();
        }
        // else 
        // {

            
}
elseif ($request->student_id_single !="" ) 
{

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
                    ->where('rolls.student_id',$student_id)
                    ->get();

    $students = Admission::where('id', $request->student_id_single)->get();
    $fee_structure_amount = FeeStructure::where('id', $request->fee_type)->first();
}
elseif($request->roll_no !="" ) {

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
else {
    return response()->json(['info' => 'Student in ' . ($request->class_code) . ' Already Promoted to Grade ' . ($request->grade_id) . '']);
    return back();
}

// dd($data);
        $fee_structure1 = FeeStructure::all();

        $view = view('admissions.promote_student.field')
        // ->with('readStudentPromote', $readStudentPromote)
        ->with('data', $data )
        ->with('semester', $semester )
        // ->with('readStudentTransaction', $readStudentTransaction)
        // ->with('totalTransaction', $totalTransaction)
        // ->with('students', $students)
        // ->with('fee_structure1', $fee_structure1)
        // ->with('fee_structure_amount', $fee_structure_amount)
        ->with('classes', $classes)
        // ->with('student_name', $student_name)
        ->render();

    return response($view);

}

}


public function deletePromoteStudent($id)
{
    DB::table("promote_students")->delete($id);
    return response()->json(['success'=>"Promoted Student successfully. ", ' tr'=>'tr_'.$id]);
}


/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
public function deletePromoteStudentAll(Request $request)
{
    $promote_ids = $request->promote_ids;
    DB::table("promote_students")->whereIn('id',explode(",",$promote_ids))->delete();
    return response()->json(['success'=>"Promoted Students Deleted successfully."]);
}

public function deleteStudentAll(Request $request)
{
    $promote_ids = $request->promote_ids;
    DB::table("admissions")->whereIn('id',explode(",",$promote_ids))->delete();
    return response()->json(['success'=>"Admission Students Deleted successfully."]);
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

}
