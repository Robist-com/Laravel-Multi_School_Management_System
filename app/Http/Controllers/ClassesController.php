<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Repositories\ClassesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use PDF;
use DB;
use App\models\Classes;
use App\models\Department;
use App\models\Course;
class ClassesController extends AppBaseController
{
    /** @var  ClassesRepository */
    private $classesRepository;

    public function __construct(ClassesRepository $classesRepo)
    {
        $this->classesRepository = $classesRepo;
    }

    /**
     * Display a listing of the Classes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $classes = $this->classesRepository->all();
        $departments = Department::all();

		$classes = Classes::join('departments','departments.department_id', '=', 'classes.department_id')
        ->select(DB::raw('classes.id,classes.class_code, 
                          classes.created_at, classes.updated_at,
                          classes.class_name,classes.status,
                          departments.department_name,
                          (select count(admissions.id) 
                          from admissions where class_code=classes.class_code)
                          as students'))
		->get();
            // dd($classes);
		$class = array();

        return view('classes.index', compact('class', 'departments'))
            ->with('classes', $classes);
    }

    /**
     * Show the form for creating a new Classes.
     *
     * @return Response
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created Classes in storage.
     *
     * @param CreateClassesRequest $request
     *
     * @return Response
     */
    public function store(CreateClassesRequest $request)
    {
        $input = $request->all();

        $classes = $this->classesRepository->create($input);

        Flash::success('Classes saved successfully.');

        return redirect(route('classes.index'));
    }

    /**
     * Display the specified Classes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classes = $this->classesRepository->find($id);

        if (empty($classes)) {
            Flash::error('Classes not found');

            return redirect(route('classes.index'));
        }

        return view('classes.show')->with('classes', $classes);
    }

    /**
     * Show the form for editing the specified Classes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classes = $this->classesRepository->find($id);
        $departments = Department::all();
        if (empty($classes)) {
            Flash::error('Classes not found');

            return redirect(route('classes.index'));
        }

        return view('classes.edit')->with('classes', $classes)->with('departments', $departments);
    }

    /**
     * Update the specified Classes in storage.
     *
     * @param int $id
     * @param UpdateClassesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassesRequest $request)
    {
        $classes = $this->classesRepository->find($id);

        if (empty($classes)) {
            Flash::error('Classes not found');

            return redirect(route('classes.index'));
        }

        $classes = $this->classesRepository->update($request->all(), $id);

        Flash::success('Classes updated successfully.');

        return redirect(route('classes.index'));
    }


       /**
     * Update the specified Admission in storage.
     *
     * @param tinyint $request
     * @param UpdateAdmission  $request
     *
     * @return Response
     */

    public function updateClassStatus(Request $request)
    {
       
        $user = Classes::findOrFail($request->class_id);
        $user->status = $request->status;
        // dd($user);
        $user->save();
    
        return response()->json(['message' => 'Class status updated successfully.']);
    }
    /**
     * Remove the specified Classes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classes = $this->classesRepository->find($id);

        if (empty($classes)) {
            Flash::error('Classes not found');

            return redirect(route('classes.index'));
        }

        $this->classesRepository->delete($id);

        Flash::success('Classes deleted successfully.');

        return redirect(route('classes.index'));
    }

    public function PDFgenerator()
    {
     $classes = Classes::join('departments','departments.department_id', '=', 'classes.department_id')->get();
    //  $users = User::join('roles', 'roles.id', '=' ,'users.role_id')->get();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('classes.pdf',['classes'=> $classes]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-Classes.pdf');
    }

    public function print($id)
    {
        $classes = Classes::where('id', $id)->get();
        // $users = User::join('roles', 'roles.id', '=' ,'users.role_id')
        //               ->where('users.id', $id)->get();
            // dd( $faculties); die;
        return view('classes.print',['classes'=> $classes]);
    }

    public function PDFgeneratorSingle($id)
    {
        $classes = Classes::where('id', $id)->get();
            // dd( $admissions); die;
            $dompdf = PDF::loadview('classes.single_pdf',['classes'=> $classes]);
                // (Optional) Setup the paper size and orientation
                // $dompdf->setPaper('A4', 'landscape');
        
                // Output the generated PDF to Browser
                $dompdf->stream();
        
                return $dompdf->download('Class.pdf');
    }

    public function getCourses($class)
	{
	
		$course = Course::select('id','course_name','course_code')->where('class',$class)->orderby('course_code','asc')->get();
		return $course;
    }


    // 

    public function deleteClassAll(Request $request)
    {
        $promote_ids = $request->promote_ids;
        DB::table("classes")->whereIn('id',explode(",",$promote_ids))->delete();
        return response()->json(['success'=>"Classes Deleted successfully."]);
    }
    
}
