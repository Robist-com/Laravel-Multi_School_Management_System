<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use App\Repositories\SemesterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use PDF;
use DB;
use App\Degree;
use App\Models\Semester;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Course;
use App\SemesterSubjects;
class SemesterController extends AppBaseController
{
    /** @var  SemesterRepository */
    private $semesterRepository;

    public function __construct(SemesterRepository $semesterRepo)
    {
        $this->semesterRepository = $semesterRepo;
    }

    /**
     * Display a listing of the Semester.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $semesters = $this->semesterRepository->all();
        // DD($semesters);
        $faculties = Faculty::all();
        $courses = Course::all();
        $semester = Semester::all();
        $enable_grade = Semester::where('status', "on")->get();
        $count_in_active_grade = Semester::where('status', "off")->count();
        $count_active_grade = Semester::where('status', "on")->count();
        // dd($enable_grade );count_active_grade
        // $semesters = Degree::join('semesters','semesters.id', '=', 'degrees.semester_id')->get();
        $semester_id = $request->get('semester_id');
        // $SemesterSubjects = $this->read_semester_course($semester_id);

        // $Semester1Subjects = SemesterSubjects::join('semesters','semesters.id', '=', 'semester_subjects.semester_id')
        // ->join('courses','courses.id', '=', 'semester_subjects.course_id')
        // ->join('departments','departments.department_id', '=', 'semester_subjects.department_id')
        // ->join('faculties','faculties.faculty_id', '=', 'semester_subjects.faculty_id')
        // ->join('degrees','degrees.degree_id', '=', 'semester_subjects.degree_id')
        // ->where('semester_subjects.semester_id',1)
        // ->where('semester_subjects.department_id',1)
        // // ->where('semester_subjects.faculty_id',1)
        // ->get();

        // echo "<pre>";print_r($users);die;

        // $SemesterSubjects = $this->read_semester_course();

        $check = Semester::all();

        return view('semesters.index',compact('faculties','check','courses','semester','enable_grade','count_in_active_grade','count_active_grade'))
            ->with('semesters', $semesters);
            // ->with('SemesterSubjects', $SemesterSubjects)
            // ->with('Semester1Subjects', $Semester1Subjects);
    }

    // public function read_semester_course()
    // {
    //     // $semester_id  = Semester::where();
    //     // dd($semester_id);
    //     return SemesterSubjects::leftJoin('semesters','semesters.id', '=', 'semester_subjects.semester_id')
    //                 ->crossJoin('courses','courses.id', '=', 'semester_subjects.course_id')
    //                 // ->rightJoin('faculties','faculties.faculty_id', '=', 'semester_subjects.faculty_id')
    //                 ->leftJoin('departments','departments.department_id', '=', 'semester_subjects.course_id')
    //                 ->crossJoin('faculties','faculties.faculty_id', '=', 'departments.faculty_id')
    //                 ->join('degrees','degrees.degree_id', '=', 'semester_subjects.semester_id')
    //                 // ->where('semester_subjects.id', '=', 'semester_subjects.semester_id' )
    //                 ->get();


    //         $departments = Department::all();
    //         $courses = Course::all();
    //     return view('semesters.index',compact('departments','courses','SemesterSubjects'));
    //     // ->with('semesters', $semesters);
    // }

    /**
     * Show the form for creating a new Semester.
     *
     * @return Response
     */
    public function create()
    {
        return view('semesters.create');
    }

    /**
     * Store a newly created Semester in storage.
     *
     * @param CreateSemesterRequest $request
     *
     * @return Response
     */
    public function store(CreateSemesterRequest $request)
    {
        $input = $request->all();
        dd($input);die;
        $semester = $this->semesterRepository->create($input);

        Flash::success('Semester saved successfully.');

        return redirect(route('semesters.index'));
    }

//     public function createSemester(Request $request)
//     {
//         $input = $request->all();
//         // dd($input);die;
//         $courses =  $request->get('course_id');
//         $Existsemesters = SemesterSubjects::select('*')->where('semester_id',$request->get('semester_id'))
//                                         ->where('course_id',$request->get('course_id'))
//                                         ->where('department_id',$request->get('department_id'))
//                                         ->where('degree_id',$request->get('degree_id'))->get();
// 			if(count($Existsemesters)>0)
// 			{

// 				Flash::error('deplicate Semester already exists for this Semester !!');
// 				return redirect()->back();
//             }
//             else {

// 			foreach($courses as $course){

//                 $subject = new SemesterSubjects;
// 				$subject->semester_id = $request->get('semester_id');
// 				$subject->department_id = $request->get('department_id');
// 				$subject->degree_id = $request->get('degree_id');
// 				$subject->faculty_id = $request->get('faculty_id');
// 				$subject->course_id = $course;

//                 $subject->save();
//         }

//             Flash::success('Semester Detail saved successfully.');

//         return redirect(route('semesters.index'));

//     }
// }

    public function createDegrees(Request $request)
    {
        $input = $request->all();
        dd($input);die;
        $semesters_degree =  $request->get('semester_id');
        $exdegree = Degree::select('*')->where('semester_id',$request->get('semester_id'))->where('degree_name',$request->get('degree_name'))->get();
			if(count($exdegree)>0)
			{
            //    dd($exdegree) ;die;
				Flash::error('deplicate','already exists for this Grade !!');
				return redirect()->back();
            }
            else {
			foreach($semesters_degree as $semester){
            $degree = new Degree;
            $degree->semester_id = $semester;
            $degree->degree_name = $request->degree_name;
            $degree->description = $request->description;
            $degree->save();

            // dd();
        }
            Flash::success(''.$request->degree_name. ' Assigned successfully');

        return redirect(route('semesters.index'));
    }
}

    /**
     * Display the specified Semester.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $semester = $this->semesterRepository->find($id);

        if (empty($semester)) {
            Flash::error('Semester not found');

            return redirect(route('semesters.index'));
        }

        return view('semesters.show')->with('semester', $semester);
    }

    /**
     * Show the form for editing the specified Semester.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $semester = $this->semesterRepository->find($id);
        // dd($semester);
        if (empty($semester)) {
            Flash::error('Semester not found');

            return redirect(route('semesters.index'));
        }

        return view('semesters.edit')->with('semester', $semester);
    }

    /**
     * Update the specified Semester in storage.
     *
     * @param int $id
     * @param UpdateSemesterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSemesterRequest $request)
    {
        $semester = $this->semesterRepository->find($id);
       
        if (empty($semester)) {
            Flash::error('Semester not found');

            return redirect(route('semesters.index'));
        }

        $semester = $this->semesterRepository->update($request->all(), $id);

        Flash::success('Semester updated successfully.');

        return redirect(route('semesters.index'));
    }

    public function updateSemesterStatus(Request $request)
    {
        $semester = Semester::findOrFail($request->semester_id);
        $semester->status = $request->status;
        $semester->save();

        return response()->json(['message' => 'Semester status updated successfully.']);
    }


    /**
     * Remove the specified Semester from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $semester = $this->semesterRepository->find($id);

        if (empty($semester)) {
            Flash::error('Semester not found');

            return redirect(route('semesters.index'));
        }

        $this->semesterRepository->delete($id);

        Flash::success('Semester deleted successfully.');

        return redirect(route('semesters.index'));
    }

    public function PDFgenerator()
    {
     $semesters = Semester::where('status', 'on')->get();

         $dompdf = PDF::loadview('semesters.pdf',['semesters'=> $semesters]);
         $dompdf->stream();

         return $dompdf->download('All-Grade.pdf');
    }


    public function deleteSemesterAll(Request $request)
    {
        $promote_ids = $request->promote_ids;
        DB::table("semesters")->whereIn('id',explode(",",$promote_ids))->delete();
        return response()->json(['success'=>"Grades Deleted successfully."]);
    }

}
