<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassScheduleRequest;
use App\Http\Requests\UpdateClassScheduleRequest;
use App\Repositories\ClassScheduleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
// we need  to add all our Models class here before writing anything okay.
use App\Models\Batch;
use App\Models\Classes;
use App\Models\ClassRoom;
use App\Models\Course;
use App\Models\Day;
use App\Models\Level;
use App\Models\Semester;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Teacher;
use App\Degree;
use App\Models\Shift;
use App\Models\Time;
use App\Models\ClassSchedule;
use DB;
use PDF;
class ClassScheduleController extends AppBaseController
{
    /** @var  ClassScheduleRepository */
    private $classScheduleRepository;

    public function __construct(ClassScheduleRepository $classScheduleRepo)
    {
        $this->classScheduleRepository = $classScheduleRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the ClassSchedule.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->group == "Owner") {

            $batch = Batch::where('school_id', auth()->user()->school->id)->get(); // this function call all the batch from the batch table but we are using modal okay.
            $classes = Classes::where('school_id', auth()->user()->school->id)->get();
            $course = Course::where('school_id', auth()->user()->school->id)->get();
            $day = Day::where('school_id', auth()->user()->school->id)->get();
            $level = Level::where('school_id', auth()->user()->school->id)->get();
            $semester =  Semester::where('status', 'on')->get();
            $shift = Shift::where('school_id', auth()->user()->school->id)->get();
            $time = Time::where('school_id', auth()->user()->school->id)->get();
            $classroom = ClassRoom::where('school_id', auth()->user()->school->id)->get();
            $department = Department::where('school_id', auth()->user()->school->id)->get();
            $faculty = Faculty::where('school_id', auth()->user()->school->id)->get();
            $teachers = Teacher::where('school_id', auth()->user()->school->id)->get();


            // $classSchedules = $this->classScheduleRepository->all();

            $classSchedules =  ClassSchedule::where('school_id',auth()->user()->school->id)->get();

            $classSchedule = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                            ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                            ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                            ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                            ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                            ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                            ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                            ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                            ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                            ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                            ->select('class_schedule.id as schedule_id', 'courses.course_name','batches.batch',
                            'class_schedule.start_date','class_schedule.end_date',
                            'classes.class_name','days.name','levels.level', 'semesters.semester_name','shifts.shift',
                            'times.time','faculties.faculty_name', 'departments.department_name','class_rooms.classroom_name')
                            ->where('class_schedule.school_id',auth()->user()->school->id)
                            ->groupby('schedule_id','class_schedule.start_date','class_schedule.end_date',
                            'courses.course_name','batches.batch','classes.class_name','days.name',
                            'levels.level', 'semesters.semester_name','shifts.shift','times.time',
                            'faculties.faculty_name', 'departments.department_name','class_rooms.classroom_name')
                            ->get();

                            // dd( $classSchedule);

        }
       else {

            $batch = Batch::all();
            $classes = Classes::all();
            $course = Course::all();
            $day = Day::all();
            $level = Level::all();
            $semester =  Semester::where('status', 'on')->get();
            $shift = Shift::all();
            $time = Time::all();
            $classroom = ClassRoom::all();
            $department = Department::all();
            $faculty = Faculty::all();
            $teachers = Teacher::all();

            $classSchedules = $this->classScheduleRepository->all();

            $classSchedule = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                            ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                            ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                            ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                            ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                            ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                            ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                            ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                            ->join('schools', 'schools.id','=', 'class_schedule.school_id')
                            ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                            ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                            ->select('class_schedule.id as schedule_id', 'courses.course_name','batches.batch',
                            'classes.class_name','days.name','levels.level', 'semesters.semester_name','shifts.shift',
                            'times.time','faculties.faculty_name', 'departments.department_name','class_rooms.classroom_name')
                                    ->groupby('schedule_id', 
                                    'courses.course_name','batches.batch','classes.class_name','days.name',
                                    'levels.level', 'semesters.semester_name','shifts.shift','times.time',
                                    'faculties.faculty_name', 'departments.department_name','class_rooms.classroom_name')
                                    ->get();
       }


       

                        // dd($classSchedule);  die;
        return view('class_schedules.index', compact('classSchedule','batch','classes', 'course', 'day', 'level',
        'semester','shift','time', 'classroom','faculty','department','teachers'))
            ->with('classSchedules', $classSchedules);
    }

// this is our dynamic level function okay

        public function DynamicLevel(Request $request){
                $course_id = $request->get('course_id');
                dd( $course_id );
                // $levels = Level::where('course_id', '=', $course_id)->get();

                // return Response::json($levels);

                if ($request->ajax()) {
                    return response(Level::where('course_id', $request->course_id)->get());
                }

        }

        // now let's open the view okay..

    /**
     * Show the form for creating a new ClassSchedule.
     *
     * @return Response
     */
    public function create()
    {
        $batch = Batch::all();
        $classes = Classes::all();
        // dd($batch);
        return view('class_schedules.create',compact('batch','classes'));
    }

    /**
     * Store a newly created ClassSchedule in storage.
     *
     * @param CreateClassScheduleRequest $request
     *
     * @return Response
     */
    public function store(CreateClassScheduleRequest $request)
    {
        $input = $request->all();
        // dd($input); die;
        $classSchedule = $this->classScheduleRepository->create($input);

        Flash::success('Class Schedule saved successfully.');

        return redirect(route('classSchedules.index'));
    }

    /**
     * Display the specified ClassSchedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classSchedule = $this->classScheduleRepository->find($id);

        if (empty($classSchedule)) {
            Flash::error('Class Schedule not found');

            return redirect(route('classSchedules.index'));
        }

        return view('class_schedules.show')->with('classSchedule', $classSchedule);
    }

    /**
     * Show the form for editing the specified ClassSchedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Request $request, $id) // we will use this edit funtion okay
    {
        // we will use request to fetch the id okay
        if (auth()->user()->group == "Owner") {

            $batch = Batch::where('school_id', auth()->user()->school->id)->get(); // this function call all the batch from the batch table but we are using modal okay.
            $classes = Classes::where('school_id', auth()->user()->school->id)->get();
            $course = Course::where('school_id', auth()->user()->school->id)->get();
            $day = Day::where('school_id', auth()->user()->school->id)->get();
            $level = Level::where('school_id', auth()->user()->school->id)->get();
            $semester =  Semester::where('status', 'on')->where('school_id', auth()->user()->school->id)->get();
            $shift = Shift::where('school_id', auth()->user()->school->id)->get();
            $time = Time::where('school_id', auth()->user()->school->id)->get();
            $classroom = ClassRoom::where('school_id', auth()->user()->school->id)->get();
            $department = Department::where('school_id', auth()->user()->school->id)->get();
            $faculty = Faculty::where('school_id', auth()->user()->school->id)->get();
            $teachers = Teacher::where('school_id', auth()->user()->school->id)->get();


            // $classSchedules = $this->classScheduleRepository->all();

            $classSchedules =  ClassSchedule::where('school_id',auth()->user()->school->id)->get();

            $edit_classSchedule = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                            ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                            ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                            ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                            ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                            ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                            ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                            ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                            ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                            ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                            ->select('class_schedule.id as schedule_id','class_schedule.*')
                            ->where('class_schedule.school_id',auth()->user()->school->id)
                            ->where('class_schedule.id', $id)->first();

                           
        }
       else {

            $batch = Batch::all();
            $classes = Classes::all();
            $course = Course::all();
            $day = Day::all();
            $level = Level::all();
            $semester =  Semester::where('status', 'on')->get();
            $shift = Shift::all();
            $time = Time::all();
            $classroom = ClassRoom::all();
            $department = Department::all();
            $faculty = Faculty::all();
            $teachers = Teacher::all();

            $classSchedules = $this->classScheduleRepository->all();

            $edit_classSchedule = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                            ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                            ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                            ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                            ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                            ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                            ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                            ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                            ->join('schools', 'schools.id','=', 'class_schedule.school_id')
                            ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                            ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                            ->select('class_schedule.id as schedule_id','class_schedule.*')
                            ->where('class_schedule.id', $id)->first();
       }

                        // dd($edit_classSchedule);  die;
        return view('class_schedules.create', compact('batch','classes', 'course', 'day', 'level',
        'semester','shift','time', 'classroom','faculty','department','teachers'))
            ->with('classSchedules', $classSchedules)->with('edit_classSchedule', $edit_classSchedule);

        // if($request->ajax()){
        //     return response(ClassSchedule::find($request->Scheduleid)); //we are fetching the data from the model okay
        // }
    }


    /**
     * Update the specified ClassSchedule in storage.
     *
     * @param int $id
     * @param UpdateClassScheduleRequest $request
     *
     * @return Response
     */
    // we will not use this update function okay we will use the simples way okay

        public function update(Request $request, $id)
        {

            $classSchedule = array(
                // here we will write our input names okay.
                'class_id'     => $request->class_id, //input names
                'degree_id'     => $request->level_id, //input names
                'course_id'    => $request->course_id, //input names
                'level_id'     => $request->level_id, //input names
                'shift_id'     => $request->shift_id, //input names
                'classroom_id' => $request->classroom_id, //input names
                'batch_id'     => $request->batch_id,//input names
                'day_id'       => $request->day_id,//input names
                'time_id'      => $request->time_id,//input names
                'semester_id'  => $request->semester_id,//input names
                'start_date'   => date('Y-m-d', strtotime($request->start_date)),//input names
                'end_date'     => date('Y-m-d', strtotime($request->end_date)),//input names
                'schedule_status'  => $request->schedule_status//input names
            );
            // echo "<pre>"; print_r($classSchedule); die;
            ClassSchedule::findOrFail($id)->update($classSchedule);
                    // now let's try to update okay...
            // echo "<pre>"; print_r($classSchedule); die; // lets debug and see if the data is coming okay

            if(empty($classSchedule)) {
                Flash::error('Class Schedule Updation Failed'); // this code check if its not empty update else send fail message
                return redirect(route('classSchedules.create'));
            }
            Flash::success('Class Schedule Updated Successfully!');
            return redirect(route('classSchedules.index'));

        }


        public function updateStatus(Request $request)
        { 
            $schedule = ClassSchedule::findOrFail($request->schedule_id);
            $schedule->schedule_status = $request->status;
            $schedule->save();
            dd($schedule);
            return response()->json(['message' => 'Class Schedule status updated successfully.']);
        }



    // public function update($id, UpdateclassScheduleRequest $request)
    // {
    //         // update code
    //         if (empty($classSchedule)) {
    //             Flash::error('Class Schedule not found');

    //             return redirect(route('classSchedules.index'));
    //         }

    //     return redirect()->route('classSchedules.index')->with('success','Student Updated Successfully!');
    //     }


    /**
     * Remove the specified ClassSchedule from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classSchedule = $this->classScheduleRepository->find($id);

        if (empty($classSchedule)) {
            Flash::error('Class Schedule not found');

            return redirect(route('classSchedules.index'));
        }

        $this->classScheduleRepository->delete($id);

        Flash::success('Class Schedule deleted successfully.');

        return redirect(route('classSchedules.index'));
    }

    // ClassSchedule PDF CODE

    public function PDFgenerator()
      {
       $classRoom = ClassSchedule::all();

       $classRoom = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
           ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
           ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
           ->join('days', 'days.day_id','=', 'class_schedule.day_id')
           ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
           ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
           ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
           ->join('times', 'times.time_id','=', 'class_schedule.time_id')
           ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
           ->get();

           // instantiate and use the dompdf class
           // $dompdf->();
           // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
           $dompdf = PDF::loadview('class_schedules.pdf',['classRoom'=> $classRoom]);
           // (Optional) Setup the paper size and orientation
           $dompdf->setPaper('A4', 'landscape');

           // Output the generated PDF to Browser
           $dompdf->stream();

           return $dompdf->download('Class_Schedule_Table.pdf');
      }

      public function print($id)
      {
        $classRoom = ClassSchedule::all();

        $classRoom = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
            ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
            ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
            ->join('days', 'days.day_id','=', 'class_schedule.day_id')
            ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
            ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
            ->join('times', 'times.time_id','=', 'class_schedule.time_id')
            ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
            ->where('class_schedule.Scheduleid','=', $id )->get();
              // dd( $faculties); die;
          return view('class_schedules.print',['classRoom'=> $classRoom]);
      }

      public function PDFgeneratorSingle($id)
      {
        $classRoom = ClassSchedule::all();

        $classRoom = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
            ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
            ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
            ->join('days', 'days.day_id','=', 'class_schedule.day_id')
            ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
            ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
            ->join('times', 'times.time_id','=', 'class_schedule.time_id')
            ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
            ->where('class_schedule.Scheduleid','=', $id )->get();
              // dd( $admissions); die;
              $dompdf = PDF::loadview('class_schedules.single_pdf',['classRoom'=> $classRoom]);
                  // (Optional) Setup the paper size and orientation
                  $dompdf->setPaper('A4', 'landscape');

                  // Output the generated PDF to Browser
                  $dompdf->stream();

                  return $dompdf->download('Class_Schedule.pdf');
      }

      //{{-----------Show Class Information Contorller-------------------}}

      public function FilterByClass(Request $request)
      {
            $class_id = $request->get('class_id');
            $classes = Classes::all();
            $course = Course::all();
            $level = Level::all();

        if ($request->class_id != '') {
            $classSchedule =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
          ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
          ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
          ->join('days', 'days.day_id','=', 'class_schedule.day_id')
          ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
          ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
          ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
          ->join('times', 'times.time_id','=', 'class_schedule.time_id')
          ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
        //   ->where($criteria)
          ->where('class_schedule.class_id',$class_id)
          ->orderBy('class_schedule.class_id', 'DESC')->get();

          if(count($classSchedule)=="0"){
            echo "<h1 align='center' class=' alert alert-danger'>No Class Found Under This Class </h1>";
          }else{

           $view = view('class_schedules.search_table')->with('classSchedule', $classSchedule, 'classes', $classes )
           ->with('classes', $classes )->with('course', $course )->with('level', $level )->render();
            return response($view);
        }
    }
}

        public function FilterByCourse(Request $request){

            $course_id = $request->get('course_id');
            $classes = Classes::all();
            $course = Course::all();
            $level = Level::all();

        if ($request->course_id != '') {
            $classSchedule =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
          ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
          ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
          ->join('days', 'days.day_id','=', 'class_schedule.day_id')
          ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
          ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
          ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
          ->join('times', 'times.time_id','=', 'class_schedule.time_id')
          ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
          ->where('class_schedule.course_id',$course_id)
        //   ->where('class_schedule.degree_id',$level_id)
          ->orderBy('class_schedule.class_id', 'DESC')->get();

          if(count($classSchedule)=="0"){
            echo "<h1 align='center' class=' alert alert-danger'>No Class Found Under This Course </h1>";
          }else{
            return view('class_schedules.search_table')->with('classSchedule', $classSchedule)
            ->with('classes', $classes )->with('course', $course )->with('level', $level );
        }
    }
}

        public function FilterByLevel(Request $request){

            $level_id = $request->get('level_id');
            $classes = Classes::all();
            $course = Course::all();
            $level = Level::all();

        if ($request->level_id != '') {
            $classSchedule =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
        ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
        ->join('days', 'days.day_id','=', 'class_schedule.day_id')
        ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
        ->join('times', 'times.time_id','=', 'class_schedule.time_id')
        ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
        ->where('class_schedule.degree_id',$level_id)
        //   ->where('class_schedule.degree_id',$level_id)
        ->orderBy('class_schedule.class_id', 'DESC')->get();

        if(count($classSchedule)=="0"){
            echo "<h1 align='center' class=' alert alert-danger'>No Class Found Under This Level </h1>";
        }else{
            return view('class_schedules.search_table')->with('classSchedule', $classSchedule)
            ->with('classes', $classes )->with('course', $course )->with('level', $level );
        }
    }
}

        public function FilterByCourseLevel(Request $request)
        {
            $course_id = $request->get('course_id');
            $level_id = $request->get('level_id');

            if ($request->course_id != '' && $request->level_id != '') {
                    $classSchedule =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                  ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                  ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                  ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                  ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                  ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                  ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                  ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                  ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                  ->where('class_schedule.course_id',$course_id)
                  ->where('class_schedule.degree_id',$level_id)
                  ->orderBy('class_schedule.class_id', 'DESC')->get();
                  if(count($classSchedule)=="0"){
                    echo "<h1 align='center' class=' alert alert-danger'>No Class Found Under This Course and Level </h1>";
                }else{
                    return view('class_schedules.search_table')->with('classSchedule', $classSchedule);
                }
     }
    }
}
