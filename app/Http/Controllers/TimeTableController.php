<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Repositories\TeacherRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use DB;
use Response;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\Course;
use PDF;
use Auth;
use App\Models\ClassAssigning;
use App\Models\Classes;
use App\Models\Admission;
// use Excel;  // because this one is the same with this one okay
use App\Exports\Teacher_Export;
use App\Imports\TeacherImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\TimeTable;

use App\Models\Batch;
use App\Models\ClassRoom;
use App\Models\Day;
use App\Models\Level;
use App\Models\Shift;
use App\Models\Time;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\ClassSchedule;
use App\Degree;

class TimeTableController extends Controller
{
    public function construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->group == "Owner") {
            $teachers = Teacher::where('school_id',auth()->user()->school_id)->get();
            // $semester = Semester::all();
            $classes = Classes::where('school_id',auth()->user()->school_id)->get();
            $coursese  = Course::where('school_id',auth()->user()->school_id)->get();
    
            $semesters = Semester::where('status', 'on')->where('school_id',auth()->user()->school_id)->get();
            $departments = Department::where('school_id',auth()->user()->school_id)->get();
            $faculty = Faculty::where('school_id',auth()->user()->school_id)->get();
            $timeslot = Time::where('school_id',auth()->user()->school_id)->get();
            $days = Day::where('school_id',auth()->user()->school_id)->get();
            $levels = Level::where('school_id',auth()->user()->school_id)->get();
            $timetable=array();
        }else {
           
        $teachers = Teacher::all();
        // $semester = Semester::all();
        $classes = Classes::all();
        $coursese  = Course::all();

        $semesters = Semester::where('status', 'on')->get();
        $departments = Department::all();
        $faculty = Faculty::all();
        $timeslot = Time::all();
        $days = Day::all();
        $levels = Level::all();
        $timetable=array();
        
    }
       


        // $timetables=array();
        return view('timetables.index',compact('faculty','timeslot','days','timetable','classes','coursese','semesters','departments','levels'))
            ->with('teachers', $teachers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


		}
    // }

   public function createTimeTable(Request $request)
    {
        $data = $request->all();

        // dd($data);
        $days = $request->day;

		$rules=[//'regiNo' => 'required',
		'teacher' => 'required',
		'class' => 'required',
		// 'section' => 'required',
		'course' => 'required',
		'start_time' => 'required',
		'end_time' => 'required',
		'day' => 'required',
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
            Flash::error('Time Table Not Generated!.');

            return redirect(route('teachers.index')->withErrors($validator)->withInput());

		}
		else {

				foreach($days as $day){

				$timetable = new Timetable;
				$timetable->teacher_id= $request->teacher;
				$timetable->class_id= $request->class;
				// $timetable->section_id= $request->get('section');
				$timetable->course_id= $request->course;
				$timetable->start_time= $request->start_time;
				$timetable->end_time= $request->end_time;
                $timetable->day = $day;

                // dd($timetable);
				$timetable->save();

			}

			//echo request()->photo->move(public_path('images/'), $fileName);
            return redirect(route('timetables.index'))->with("success","Time Table Created Succesfully.");
				}
    }

    public function view_timetable1(Request $request,  $id)
	{
		if($request->class !='' && $request->section !=''){
           $teacher_name =  array();
			$class = $request->class;
			$timetables = DB::table('timetable')
			->join('teacher', 'timetable.teacher_id', '=', 'teacher.teacher_id')
			->join('coursese', 'coursese.id', '=', 'timetable.course_id')
			->join('classes', 'classes.id', '=', 'timetable.class_id')
			// ->join('section', 'section.id', '=', 'timetable.section_id')
            ->select('teachers.*','timetable.start_time','timetable.end_time',
            'timetable.day','timetable.id as timetable_id',
            'courses.course_name AS course_name')
            //  'section.class_code as classname')
			->where('timetable.class_id',$request->class)
			// ->where('timetable.section_id',Input::get('section'))
			/*	->where('section',Input::get('section'))
			->where('shift',Input::get('shift'))
			->where('session',trim(Input::get('session')))*/
			->get();
		}else{
			$class = '';
			$teacher_name =  DB::table('teachers')->select('first_name','last_name')->where('teacher_id',$id)->first();
			$timetables = DB::table('timetable')
			->join('teachers', 'timetable.teacher_id', '=', 'teachers.teacher_id')
			->join('courses', 'courses.id', '=', 'timetable.course_id')
			->join('classes', 'classes.id', '=', 'timetable.class_id')
			// ->join('section', 'section.id', '=', 'timetable.section_id')
            ->select('teachers.*','timetable.start_time','timetable.end_time',
            'timetable.day','timetable.id as timetable_id',
            'courses.course_name AS course_name',
            'classes.class_name as class_name',
            'classes.class_code as class_code')
			->where('timetable.teacher_id',$id)
			/*	->where('section',Input::get('section'))
			->where('shift',Input::get('shift'))
			->where('session',trim(Input::get('session')))*/
			->get();
	    }
		// $timetables = DB::table('timetable')->where('timetable.teacher_id',$id)->get();
		//echo "<pre>";print_r($timetables); exit;
		// return View("timetables.teacherViewtimetable",compact('timetables','teacher_name','class'));
		return View("timetables.teacherViewtimetable",compact('timetables','teacher_name','class'));
    }

    public function Generate_Class_Timetables(Request $request)
	{
            $timeslot = Time::all();
            $days = Day::all();
            $timetable=array();

            $input = $request->all();
            $department_id = $request->get('department_id');
            $semester_id = $request->get('semester_id');
            $degree_id = $request->get('degree_id');
            $faculty_id = $request->get('faculty_id');
            $class_id = $request->get('class_id');

            $grades = Semester::where(['id' => $semester_id, 'school_id' => auth()->user()->school_id])->first();
            $exis_class = Classes::where(['class_code' => $class_id, 'school_id' => auth()->user()->school_id])->first();

            $teachers = Teacher::where('school_id',auth()->user()->school_id)->get();
            // $semester = Semester::all();
            $classes = Classes::where('school_id',auth()->user()->school_id)->get();
            $coursese  = Course::where('school_id',auth()->user()->school_id)->get();
    
            $semesters = Semester::where('status', 'on')->where('school_id',auth()->user()->school_id)->get();
            $departments = Department::where('school_id',auth()->user()->school_id)->get();
            $faculty = Faculty::where('school_id',auth()->user()->school_id)->get();
            $timeslot = Time::where('school_id',auth()->user()->school_id)->get();
            $days = Day::where('school_id',auth()->user()->school_id)->get();
            $levels = Level::where('school_id',auth()->user()->school_id)->get();

            if(auth()->user()->group == "Owner"){
                    $classtimetables =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                    ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                    ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                    ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                    ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                    ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                    ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                    ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                    ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                    ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                    ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                                    // ->where('class_schedule.status','=', 1 )->get();
                                    // ->get();
                    ->where('class_schedule.semester_id', $semester_id)
                    ->where('class_schedule.department_id', $department_id)
                    ->where('class_schedule.degree_id', $degree_id)
                    ->where('class_schedule.faculty_id', $faculty_id)
                    ->where('class_schedule.class_id', $class_id)
                    ->where('class_schedule.school_id', auth()->user()->school_id)
                    ->orderBy('teachers.teacher_id', 'DESC')
                    ->get();
            }else {
                    $classtimetables =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                    ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                    ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                    ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                    ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                    ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                    ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                    ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                    ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                    ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                    ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                                    // ->where('class_schedule.status','=', 1 )->get();
                                    // ->get();
                    ->where('class_schedule.semester_id', $semester_id)
                    ->where('class_schedule.department_id', $department_id)
                    ->where('class_schedule.degree_id', $degree_id)
                    ->where('class_schedule.faculty_id', $faculty_id)
                    ->where('class_schedule.class_id', $class_id)
                    // ->where('class_schedule.school_id', auth()->user()->school_id)
                    ->orderBy('teachers.teacher_id', 'DESC')
                    ->get();
            }

    $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                 ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                 ->where('class_schedule.class_id', $class_id)
                                 ->first();

            // dd(back()); die;
          if(count($classtimetables) == 0){
              Flash::error('No TimeTable Found Under ' . $grades->semester_name .' <i class="fa fa-exchange"> </i> ' . $exis_class->class_name);
            return view('timetables.index',compact('class_name','faculty','timeslot','days','timetable','classes','coursese','semesters','departments','levels'))
            ->with('teachers', $teachers) ->with('classtimetables', $classtimetables);
          }else{
            return view('timetables.index',compact('class_name','faculty','timeslot','days','timetable','classes','coursese','semesters','departments','levels'))
            ->with('teachers', $teachers) ->with('classtimetables', $classtimetables);

            // return view('timetables.index',compact())
           
        }
    // }
}

public function Generate_Teacher_Timetables(Request $request)
	{

        $teacher_id = Auth::user()->teacher_id;
    $teachertimetables =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                    ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                    ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                    ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                    ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                    ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                    ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                    ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                    ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                    ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                    ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                    // ->select('class_schedule.id', 'courses.id as course_id', 'courses.course_name')
            ->where('class_schedule.teacher_id', $teacher_id)
            // ->groupBy('class_schedule.id')
            ->orderBy('teachers.teacher_id', 'ASC')
            ->get();

    $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                 ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                 ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                 ->where('class_schedule.teacher_id', $teacher_id)
                                 ->first();

            // dd( $class_name); die;

            return view('timetables.teachers.timetable', compact('class_name'))
            ->with('teachertimetables', $teachertimetables);
        // }
    // }
}




    public function getTeacherinfo($teacher_id)
	{
		$teacher = DB::table('teachers')
					->select(DB::raw('teachers.*'))
					->where('teacher_id',$teacher_id)
					->first();
		$html = '';
		$html .='<tr>
		<td>'.$teacher->first_name.''.$teacher->last_name.'</td>
		<td>'.$teacher->phone.'</td>
		<td>'.$teacher->email.'</td>
		</tr>
		';
		return $html;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ViewStudentsClass(){
        $batch = Batch::all(); // this function call all the batch from the batch table but we are using modal okay.
        $classes = Classes::all();
        $course = Course::all();
        $day = Day::all();
        $level = Level::all();
        $semester =  Semester::all();
        $shift = Shift::all();
        $time = Time::all();
        $classroom = ClassRoom::all();
        $department = Department::all();
        $faculty = Faculty::all();
        $degree = Degree::all();

        $classSchedule = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                                    ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                                    ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                                    ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                                    ->join('degrees', 'degrees.degree_id','=', 'class_schedule.degree_id')
                                    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                    ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                                    ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                                    ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                                    ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                                    ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                                    // ->where('class_schedule.status','=', 1 )->get();
                                    ->get();
                        // dd($classSchedule);  die;
        return view('timetables.class.table', compact('classSchedule','batch','classes', 'course', 'day', 'level',
        'semester','shift','time', 'classroom','department','faculty','degree'))
            ->with('classSchedule', $classSchedule);

        // return view('timetables.class.table');
    }


    public function PDFgenerator()
    {
     $classRoom = ClassSchedule::all();

     $classRoom = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                                ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                                ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                                ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                                ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                ->join('degrees', 'degrees.degree_id','=', 'class_schedule.degree_id')
                                ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                                ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                                ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                                ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
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

      $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                 ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                 ->where('class_schedule.class_id', $id)
                                 ->first();

      $classRoom = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                                ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                                ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                                ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                                ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                ->join('degrees', 'degrees.degree_id','=', 'class_schedule.degree_id')
                                ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                                ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                                ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                                ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                                ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
          ->where('class_schedule.class_id','=', $id )->get();
            // dd( $faculties); die;
        return view('class_schedules.print',['classRoom'=> $classRoom]);
    }

    public function PDFgeneratorSingle($id)
    {

      $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                    ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                                    ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                                    ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                    ->join('degrees', 'degrees.degree_id','=', 'class_schedule.degree_id')
                                    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                    ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                                    ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                                    ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                                    ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                                    ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                                 ->where('class_schedule.class_id', $id)
                                 ->first();

      $classtimetables_pdf = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
          ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
          ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
          ->join('days', 'days.day_id','=', 'class_schedule.day_id')
          ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
          ->join('levels', 'levels.level_id','=', 'class_schedule.degree_id')
          ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
          ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
          ->join('times', 'times.time_id','=', 'class_schedule.time_id')
          ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
          ->where('class_schedule.class_id',$id )->get();
            // dd( $admissions); die;
            $dompdf = PDF::loadview('timetables.printoptions.classes.pdf',['classtimetables_pdf'=> $classtimetables_pdf,'class_name'=>$class_name]);
                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'portrait');

                // Output the generated PDF to Browser
                $dompdf->stream();

                return $dompdf->download('Class_Schedule.pdf');
    }

    public function PDFTeacherSingleTimetable($teacher_id)
    {

      $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                    ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                                    ->join('days', 'days.day_id','=', 'class_schedule.day_id')
                                    ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                    ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
                                    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                    ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
                                    ->join('times', 'times.time_id','=', 'class_schedule.time_id')
                                    ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
                                    ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
                                    ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
                                 ->where('class_schedule.teacher_id', $teacher_id)
                                 ->first();

      $teachertimetables_pdf = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
          ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
          ->join('classes', 'classes.class_code','=', 'class_schedule.class_id')
          ->join('days', 'days.day_id','=', 'class_schedule.day_id')
          ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
          ->join('levels', 'levels.id','=', 'class_schedule.degree_id')
          ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
          ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
          ->join('times', 'times.time_id','=', 'class_schedule.time_id')
          ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
          ->where('class_schedule.teacher_id',$teacher_id )->get();
            // dd( $teachertimetables_pdf); die;
            $dompdf = PDF::loadview('timetables.printoptions.teachers.pdf',['teachertimetables_pdf'=> $teachertimetables_pdf,'class_name'=>$class_name]);
                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'portrait');

                // Output the generated PDF to Browser
                $dompdf->stream();

                return $dompdf->download('Teacher-TimeTable.pdf');
    }





}