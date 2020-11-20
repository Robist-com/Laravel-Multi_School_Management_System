<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Flash;
use Response;
use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Repositories\DepartmentRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends AppBaseController
{
    /** @var  DepartmentRepository */
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepository = $departmentRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Department.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        

        if (auth()->user()->group == "Owner") {

            $faculties = Faculty::where('school_id', auth()->user()->school->id)->get();
            $departments = Department::join('faculties', 'faculties.faculty_id', '=' ,'departments.faculty_id')
                ->where('departments.school_id', auth()->user()->school->id)->get();

        }else {
            
            // $faculties = $this->departmentRepository->all();
            $departments = Department::join('faculties', 'faculties.faculty_id', '=' ,'departments.faculty_id')->get();
            $faculties = Faculty::all();
        }

        
        // $this->departmentRepository->all();

        return view('departments.index', compact('faculties'))
            ->with('departments', $departments);
    }

    /**
     * Show the form for creating a new Department.
     *
     * @return Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created Department in storage.
     *
     * @param CreateDepartmentRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartmentRequest $request)
    {
        $input = $request->all();
        // echo "<pre>"; print_r( $input);  die; 
// 
        $department = $this->departmentRepository->create($input);

        Flash::success('Department saved successfully.');

        return redirect(route('departments.index'));
    }

    /**
     * Display the specified Department.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error('Department not found');

            return redirect(route('departments.index'));
        }

        return view('departments.show')->with('department', $department);
    }

    /**
     * Show the form for editing the specified Department.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $department = $this->departmentRepository->find($id);

        if (auth()->user()->group == "Owner") {

            $faculties = Faculty::where('school_id', auth()->user()->school->id)->get();
            $departments = Department::join('faculties', 'faculties.faculty_id', '=' ,'departments.faculty_id')
                ->where('departments.school_id', auth()->user()->school->id)->get();

        }else {
            // $faculties = $this->departmentRepository->all();
            $departments = Department::join('faculties', 'faculties.faculty_id', '=' ,'departments.faculty_id')->get();
            $faculties = Faculty::all();
        }
        
        if (empty($department)) {
            Flash::error('Department not found');

            return redirect(route('departments.index'));
        }

        return view('departments.index')->with('department', $department)
        ->with('faculties', $faculties)
        ->with('departments', $departments);
    }

    /**
     * Update the specified Department in storage.
     *
     * @param int $id
     * @param UpdateDepartmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartmentRequest $request)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error('Department not found');

            return redirect(route('departments.index'));
        }

        $department = $this->departmentRepository->update($request->all(), $id);

        Flash::success('Department updated successfully.');

        return redirect(route('departments.index'));
    }

    /**
     * Update the specified Admission in storage.
     *
     * @param tinyint $request
     * @param UpdateAdmission  $request
     *
     * @return Response
     */

    public function updateDepartmentStatus(Request $request)
    {
       
        $user = Department::findOrFail($request->department_id);
        $user->department_status = $request->status;
        // dd($user);
        $user->save();
    
        return response()->json(['message' => 'Department status updated successfully.']);
    }
    // updateDepartmentStatus

    /**
     * Remove the specified Department from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error('Department not found');

            return redirect(route('departments.index'));
        }

        $this->departmentRepository->delete($id);

        Flash::success('Department deleted successfully.');

        return redirect(route('departments.index'));
    }

    public function PDFgenerator()
    {
     $departments = Department::all();
     $departments = Department::join('faculties', 'faculties.faculty_id', '=' ,'departments.faculty_id')->get();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('departments.pdf',['departments'=> $departments]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-Departments.pdf');
    }

    public function print($id)
    {

        $departments = Department::join('faculties', 'faculties.faculty_id', '=' ,'departments.faculty_id')
                                    ->where('departments.department_id', $id)->get();
            // dd( $faculties); die;
        return view('departments.print',['departments'=> $departments]);
    }

    public function PDFgeneratorSingle($id)
    {
        $departments = Department::join('faculties', 'faculties.faculty_id', '=' ,'departments.faculty_id')
                                    ->where('departments.department_id', $id)->get();
            // dd( $admissions); die;
            $dompdf = PDF::loadview('departments.single_pdf',['departments'=> $departments]);
                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'landscape');
        
                // Output the generated PDF to Browser
                $dompdf->stream();
        
                return $dompdf->download('Department.pdf');
    }

    public function getDepartmentByclassANDbatch($class,$batch){

          $departments = DB::table('class_schedule')
          ->join('departments','departments.department_id','=','class_schedule.department_id')
          ->select(DB::raw('departments.department_id,departments.department_name,
                            (select count(admissions.id) from admissions where  
                            admissions.department_id=departments.department_id 
                            AND admissions.acceptance='.'"accept"'.')as students'))
         ->where('class_schedule.class_id','=',$class)
         ->where('class_schedule.school_id', auth()->user()->school_id)
          ->get();
        //   dd($departments); die;
        //   class=section.class_code  
      return $departments;
      }
  
      public function getDepartmentByclass($class){
  
        $section= ClassSchedule::join('departments','departments.department_id','=','class_schedule.department_id')
                        // ->select('department_id','department_name')
                        ->where('class_schedule.class_id','=',$class)->get();
          
          print_r($section);exit;
      return $section;
      }
}
