<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Repositories\CourseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Auth;
use Response;
use PDF;
use App\Degree;
use App\Faculty;
use App\Models\Course;
use App\Models\Admission;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\Semester;
use App\Models\Department;
use App\Models\Level;
use App\GPA;
use DB;

class CourseController extends AppBaseController
{
    /** @var  CourseRepository */
    private $courseRepository;

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepository = $courseRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Course.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->group == "Owner") {
        $courses = Course::join('classes','classes.class_code', '=', 'courses.class')
                            ->join('departments','departments.department_id', '=', 'courses.department')
                            ->where('courses.school_id', auth()->user()->school->id)

                            ->select('courses.id as subject_id',
                            'courses.course_name',
                            'courses.course_code',
                            'courses.description','departments.department_name',
                             'courses.class',
                             'courses.status'
                              )
                             
                             ->groupby('courses.id'
                             ,'courses.course_name','courses.course_code','courses.description',
                             'departments.department_name',
                            'courses.class', 'courses.status'
                             )->get();
                            // dd($courses);
        //  = $this->courseRepository->all();
        $classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->where('school_id', auth()->user()->school->id)->get();

        // dd($classes);
        $gpa =GPA::select('for')->distinct()->where('school_id', auth()->user()->school->id)->get();

        $semester =Semester::where('status', 'on')->where('school_id', auth()->user()->school->id)->get();
        $department =Department::where('school_id', auth()->user()->school->id)->get();

        }else
        {
            $courses = Course::join('classes','classes.class_code', '=', 'courses.class')
            ->join('departments','departments.department_id', '=', 'courses.department')
            ->get();

            $classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();

            $gpa =GPA::select('for')->distinct()->get();

            $semester =Semester::where('status', 'on')->get();
            $department =Department::all();
        }
      
        return view('courses.index', compact('classes','semester','department','gpa'))
            ->with('courses', $courses);
    }

    /**
     * Show the form for creating a new Course.
     *
     * @return Response
     */
    public function create()
    {
        return view('courses.create');
    }



    /**
     * Store a newly created Course in storage.
     *
     * @param CreateCourseRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
            // dd($input); die;
        // $course = $this->courseRepository->create($input);

        $classes =  $request->get('class');
		$rules=[
			'course_name'         => 'required',
			'course_code'         => 'required',
			'describtion'         => 'required',
			// 'semester'     => 'required',
			'department'     => 'required',
			'class'        => 'required',
			'gradeSystem'  => 'required',
			// 'totalfull'    => 'required',
			// 'wfull'        => 'required',
			// 'mfull'        => 'required',
			// 'sfull'        => 'required',
			// 'pfull'        => 'required',
			// 'totalpass'    => 'required',
			// 'wpass'        => 'required',
			// 'mpass'        => 'required',
			// 'spass'        => 'required',
			// 'ppass'        => 'required'
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		}
		else {
			$exsubject = Course::select('*')->where('class',$request->get('class'))->where('course_code',$request->get('course_code'))->get();
			if(count($exsubject)>0)
			{
				Flash::error('deplicate', 'subject all ready exists for this class!!');
				return redirect()->back();


			}
			else {
				foreach($classes as $class){
				$subject = new Course;
				$subject->course_name = $request->get('course_name');
				$subject->course_code = $request->get('course_code');
				$subject->description = $request->get('describtion');
				$subject->class = $class;
				$subject->gradeSystem = $request->get('gradeSystem');
				$subject->school_id = $request->get('school_id');
				$subject->semester = $request->get('semester');
				$subject->department = $request->get('department');
				$subject->totalfull = 0;
				$subject->totalpass = 0;
				$subject->wfull = 0;
				$subject->wpass = 0;
				$subject->mfull = 0;
				$subject->mpass = 0;
				$subject->sfull = 0;
				$subject->spass = 0;
				$subject->pfull = 0;
				$subject->ppass = 0;
				

				$subject->save();
            }
                Flash::success('Course saved successfully.');
			}

		}



        // Flash::success('Course saved successfully.');

        return redirect(route('courses.index'));
    }

    /**
     * Display the specified Course.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        return view('courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified Course.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
        $course = $this->courseRepository->find($id);

        // dd( $course);
        if (auth()->user()->group == "Owner") {
            $courses = Course::join('classes','classes.class_code', '=', 'courses.class')
                                ->join('departments','departments.department_id', '=', 'courses.department')
                                ->where('courses.school_id', auth()->user()->school->id)
                                ->select('courses.*', 'courses.id as subject_id', 'departments.department_name', 'classes.class_name' )->get();
                                // dd($courses);
            //  = $this->courseRepository->all();
            $classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->where('school_id', auth()->user()->school->id)->get();
    
            // dd($classes);
            $gpa =GPA::select('for')->distinct()->where('school_id', auth()->user()->school->id)->get();
    
            $semester =Semester::where('status', 'on')->where('school_id', auth()->user()->school->id)->get();
            $department =Department::where('school_id', auth()->user()->school->id)->get();
    
            }else
            {
                $courses = Course::join('classes','classes.class_code', '=', 'courses.class')
                ->join('departments','departments.department_id', '=', 'courses.department')
                ->get();
    
                $classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();
    
                $gpa =GPA::select('for')->distinct()->get();
    
                $semester =Semester::where('status', 'on')->get();
                $department =Department::all();
            }
          
//         $courses = Course::join('classes','classes.class_code', '=', 'courses.class')
//         ->join('departments','departments.department_id', '=', 'courses.department')
//         ->get();
//         // dd($courses);
// //  = $this->courseRepository->all();

// $classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();

//         $department = Department::all();
//         $semester =Semester::all();
//         $gpa =GPA::select('for')->distinct()->get();
        // dd($course);
        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        return view('courses.index',compact('semester', 'classes'))->with('course', $course)->with('department', $department)
        ->with('gpa', $gpa)->with('courses', $courses);
    }

    /**
     * Update the specified Course in storage.
     *
     * @param int $id
     * @param UpdateCourseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseRequest $request)
    {
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        $course = $this->courseRepository->update($request->all(), $id);

        Flash::success('Course updated successfully.');

        return redirect(route('courses.index'));
    }


    public function updateCourseStatus(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $course->status = $request->status;
        $course->save();

        return response()->json(['message' => 'Course status updated successfully.']);
    }

    /**
     * Remove the specified Course from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $course = $this->courseRepository->find($id);

    //    dd( $course);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        $this->courseRepository->delete($id);

        Flash::success('Course deleted successfully.');

        return redirect(route('courses.index'));
    }

    public function PDFgenerator()
    {
     $courses = Course::all();

    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('courses.pdf',['courses'=> $courses]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');

         // Output the generated PDF to Browser
         $dompdf->stream();

         return $dompdf->download('All-Courses.pdf');
    }

    // public function getCourses($class){

    //     $course= Course::select('id','course_name')->where('class','=',$class)->get();
    //     return $course;
    //   }

      public function dynamicCourse(Request $request){
 
        if ($request->ajax()) {
            return response(Course::where('class', $request->class_id)->get());
        }

}

        public function dynamicDegrees(Request $request){
            $input = $request->all();
           
        if ($request->ajax()) {
            return response(Level::where('grade_id', $request->grade_id)->get());
        }
    }

    public function dynamicDepartments(Request $request){
        $input = $request->all();
        // dd($input); die;
    if ($request->ajax()) {
        return response(Department::where('faculty_id', $request->faculty_id)->get());
    }
}



public function dynamicDepartmentsWithClass(Request $request){
    $input = $request->all();
    // dd($input); die;
if ($request->ajax()) {
    return response(Classes::where('department_id', $request->department_id)->get());
}
}


public function dynamicStudentsByClass(Request $request){
    $input = $request->all();
    dd($input); die;
if ($request->ajax()) {
    return response(Admission::where('class_code', $request->class_id)
    // ->where('semester_id',$request->semester_id)
    // ->where('faculty_id',$request->faculty_id)->where('department_id',$request->department_id)
    ->get());
}
}

// public function dynamicStudentsByClass(Request $request){
//     $input = $request->all();
//     dd($input); die;
// if ($request->ajax()) {
//     return response(Admission::where('department_id',$request->department_id)
//     ->get());
// }
// }


        public function dynamicLevels(Request $request){

            if ($request->ajax()) {
                return response(Level::where('course_id', $request->course_id)->get());
            }

        }

        public function getmarks($course,$class)
        {
            $course = Course::select('totalfull','totalpass','wfull','wpass','mfull','mpass','sfull','spass','pfull','ppass')->where('course_code','=',$course)->where('class','=',$class)->get();
            return $course;
        }
        public function getsubjects($class){

          $course= Course::select('id','course_name')->where('class','=',$class)->get();
        return $course;
        }

    
        public function EnterSubjectDetails(Request $request)
        {
            $subjects = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                ->where('teacher_id', Auth::user()->teacher_id)->get();

            // $course = Course::findOrFail($request->course_id);
            return view ('teachers.subject_details', compact('subjects'));
        }

        public function EditSubjectDetails(Request $request, $id)
        {
            $subjects = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
            ->where('teacher_id', Auth::user()->teacher_id)->get();

            $course = Course::findOrFail($id);
            // $course->totalfull = $request->totalfull;
            // $course->totalpass = $request->totalpass;
            // $course->wfull = $request->wfull;
            // $course->wpass = $request->wpass;
            // $course->mfull = $request->mfull;
            // $course->mpass = $request->mpass;
            // $course->sfull = $request->sfull;
            // $course->spass = $request->spass;
            // $course->pfull = $request->pfull;
            // $course->ppass = $request->ppass;
            // $course->save();

           return view ('teachers.subject_details', compact('course','subjects'));
        }

        public function UpdateSubjectDetails(Request $request, $id)
        {
            $course = Course::findOrFail($id);
            $course->totalfull = $request->totalfull;
            $course->totalpass = $request->totalpass;
            $course->wfull = $request->wfull;
            $course->wpass = $request->wpass;
            $course->mfull = $request->mfull;
            $course->mpass = $request->mpass;
            $course->sfull = $request->sfull;
            $course->spass = $request->spass;
            $course->pfull = $request->pfull;
            $course->ppass = $request->ppass;
            $course->save();

            Flash::success('Course Marks Added successfully.');
           return redirect('/enter-subject-detail');
        }


        

}
