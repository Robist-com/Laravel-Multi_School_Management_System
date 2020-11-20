<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Repositories\LevelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Department;
use PDF;
use App\Models\Level;
class LevelController extends AppBaseController
{
    /** @var  LevelRepository */
    private $levelRepository;

    public function __construct(LevelRepository $levelRepo)
    {
        $this->levelRepository = $levelRepo;

			$this->middleware('auth');

    }

    /**
     * Display a listing of the Level.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->group == "Owner") {

            // $level =  Level::where('school_id', auth()->user()->school_id)->get();
            $levels =  Level::where('school_id', auth()->user()->school_id)->get();
            $course = Course::where('school_id', auth()->user()->school_id)->get();
            $semester =Semester::where('school_id', auth()->user()->school_id)->where('status', 'on')->get();
            $department =Department::where('school_id', auth()->user()->school_id)->get();

        }else {
            $levels = $this->levelRepository->all();
            $course = Course::all();
            $semester =Semester::all();
            $department =Department::all();
        }
        // echo "<pre>"; print_r( $course); die;
        return view('levels.index', compact('course','semester','department'))
            ->with('levels', $levels);
    }

    /**
     * Show the form for creating a new Level.
     *
     * @return Response
     */
    public function create()
    {
        return view('levels.create');
    }

    /**
     * Store a newly created Level in storage.
     *
     * @param CreateLevelRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();
        // dd($input);
        // $level = $this->levelRepository->create($input);

        $input = $request->all();
        // dd($input);die;
        $level =  $request->get('course_id');
        $exdegree = Level::select('*')->where('course_id',$request->get('course_id'))->where('level',$request->get('level'))->get();
			if(count($exdegree)>0)
			{
            //    dd($exdegree) ;die;
				Flash::error('deplicate','already exists for this Level !!');
				return redirect()->back();
            }
            else {
			foreach($level as $semester){
            $degree =  new Level;
            // ::createOrUpdate([
            //     'course_id' => $semester,
            //     'grade_id' => $request->semester_id,
            //     'level' => $request->level,
            //     'status' => $request->status,
            //     'school_id' => $request->school_id,
            //     'level_description' => $request->level_description;
            //     // $degree->save();
            // ]);
            $degree->course_id = $semester;
            $degree->grade_id = $request->semester_id;
            $degree->level = $request->level;
            $degree->status = $request->status;
            $degree->school_id = $request->school_id;
            $degree->level_description = $request->level_description;
            $degree->save();

            // dd();
        }

        Flash::success('Level saved successfully.');

        return redirect(route('levels.index'));
    }
}

    /**
     * Display the specified Level.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $level =  Level::where('school_id', auth()->user()->school_id)->find($id);

        if (empty($level)) {
            Flash::error('Level not found');

            return redirect(route('levels.index'));
        }

        return view('levels.show')->with('level', $level);
    }

    /**
     * Show the form for editing the specified Level.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // $level = Level::find($id);
        // $levels = Level::find($id);
        // $semester =Semester::all();
        // $department =Department::all();
        // $course = Course::all();
        // $courseID = Course::find($course);

        $level =  Level::where('school_id', auth()->user()->school_id)->find($id);
        $levels =  Level::where('school_id', auth()->user()->school_id)->get();
        $course = Course::where('school_id', auth()->user()->school_id)->get();
        $semester =Semester::where('school_id', auth()->user()->school_id)->where('status', 'on')->get();
        $department =Department::where('school_id', auth()->user()->school_id)->get();
        //  echo "<pre>"; print_r( $semester); die;
        if (empty($level)) {
            Flash::error('Level not found');

            return redirect(route('levels.index'));
        }

        return view('levels.index',  compact('course','semester','department','levels'))->with('level', $level);
    }

    /**
     * Update the specified Level in storage.
     *
     * @param int $id
     * @param UpdateLevelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLevelRequest $request)
    {
        $level = Level::find($id);
        
        if (empty($level)) {
            Flash::error('Level not found');

            return redirect(route('levels.index'));
        }

        $levels =  $request->get('course_id');

        // dd($request->semester_id);
        foreach($levels as $semester){
           
            $level->update(['course_id' => $semester,
            'grade_id' => $request->semester_id,
            'level' => $request->level,
            'status' => $request->status,
            'school_id' => $request->school_id,
            'level_description' => $request->level_description]);
        }
        // $level = $this->levelRepository->update($request->all(), $id);

        Flash::success('Level updated successfully.');

        return redirect(route('levels.index'));
    }

    public function updateLevelStatus(Request $request)
    {
        $level = Level::findOrFail($request->level_id);
        $level->status = $request->status;
        $level->save();
    
        return response()->json(['message' => 'Level status updated successfully.']);
    }
  

    /**
     * Remove the specified Level from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $level = $this->levelRepository->find($id);

        if (empty($level)) {
            Flash::error('Level not found');

            return redirect(route('levels.index'));
        }

        $this->levelRepository->delete($id);

        Flash::success('Level deleted successfully.');

        return redirect(route('levels.index'));
    }

    public function PDFgenerator()
    {
     $levels = Level::all();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('levels.pdf',['levels'=> $levels]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-Levels.pdf');
    }
}
