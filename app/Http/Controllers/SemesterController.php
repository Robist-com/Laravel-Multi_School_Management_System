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

			$this->middleware('auth');

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
       
        // dd($semesters);

        if (auth()->user()->group == "Owner") {
        $semesters = Semester::where('school_id', auth()->user()->school_id)->get();
        $faculties = Faculty::where('school_id', auth()->user()->school_id)->get();
        $courses = Course::where('school_id', auth()->user()->school_id)->get();
        $semester = Semester::where('school_id', auth()->user()->school_id)->get();
        $enable_grade = Semester::where('school_id', auth()->user()->school_id)->get();
        $count_in_active_grade = Semester::where('status', "off")->where('school_id', auth()->user()->school_id)->count();
        $count_active_grade = Semester::where('school_id', auth()->user()->school_id)->count();

        $semester_id = $request->get('semester_id');

        $check = Semester::where('school_id', auth()->user()->school_id)->get();
        }else {
            $semesters = $this->semesterRepository->all();
            $faculties = Faculty::all();
            $courses = Course::all();
            $semester = Semester::get();
            $enable_grade = Semester::get();
            $count_in_active_grade = Semester::where('status', "off")->count();
            $count_active_grade = Semester::count();

        $semester_id = $request->get('semester_id');

        $check = Semester::all();
        }
        return view('semesters.index',compact('faculties','check','courses','semester','enable_grade','count_in_active_grade','count_active_grade'))
            ->with('semesters', $semesters);

    }

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
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);die;
        $semester = $this->semesterRepository->create($input);

        Flash::success('Semester saved successfully.');

        return redirect(route('semesters.index'));
    }

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
    public function edit(Request $request, $id)
    {
        $semes = $this->semesterRepository->find($id);

    if (auth()->user()->group == "Owner") {
        $semesters = Semester::where('school_id', auth()->user()->school_id)->get();
        $faculties = Faculty::where('school_id', auth()->user()->school_id)->get();
        $courses = Course::where('school_id', auth()->user()->school_id)->get();
        $semester = Semester::where('school_id', auth()->user()->school_id)->get();
        $enable_grade = Semester::where('school_id', auth()->user()->school_id)->get();
        $count_in_active_grade = Semester::where('status', "off")->where('school_id', auth()->user()->school_id)->count();
        $count_active_grade = Semester::where('school_id', auth()->user()->school_id)->count();

        $semester_id = $request->get('semester_id');

        $check = Semester::where('school_id', auth()->user()->school_id)->get();
        }else {
            $semesters = $this->semesterRepository->all();
            $faculties = Faculty::all();
            $courses = Course::all();
            $semester = Semester::get();
            $enable_grade = Semester::get();
            $count_in_active_grade = Semester::where('status', "off")->count();
            $count_active_grade = Semester::count();

        $semester_id = $request->get('semester_id');

        $check = Semester::all();
        }
        // dd($semester);
        if (empty($semester)) {
            Flash::error('Semester not found');

            return redirect(route('semesters.index'));
        }

        return view('semesters.index',compact('semesters','faculties','check','courses','semester','enable_grade','count_in_active_grade','count_active_grade'))->with('semes', $semes);
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
