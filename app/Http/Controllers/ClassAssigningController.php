<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassAssigningRequest;
use App\Http\Requests\UpdateClassAssigningRequest;
use App\Repositories\ClassAssigningRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\ClassAssigning;
use App\Models\Teacher;
use Flash;
use Response; 

use App\Models\Batch;
use App\Models\Classes;
use App\Models\ClassRoom;
use App\Models\Course;
use App\Status;
use App\Models\Level;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Time;
use App\Models\ClassSchedule;
use DB;
use Validator;
use PDF;

class ClassAssigningController extends AppBaseController
{
    /** @var  ClassAssigningRepository */
    private $classAssigningRepository;

    public function __construct(ClassAssigningRepository $classAssigningRepo)
    {
        $this->classAssigningRepository = $classAssigningRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the ClassAssigning.
     *
     * @param Request $request
     *
     * @return Response 
     */
    public function index(Request $request)
    {

        $classAssignings = $this->classAssigningRepository->all();
        $teacher = Teacher::get();
        // dd( $teacher ); die;

        $classSchedules = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
        ->join('classes', 'classes.id','=', 'class_schedule.class_id')
        ->join('days', 'days.day_id','=', 'class_schedule.day_id')
        ->join('levels', 'levels.level_id','=', 'class_schedule.degree_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
        ->join('times', 'times.time_id','=', 'class_schedule.time_id')
        ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
        ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
        ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
        ->get();

        // here is the class assigning table relation part okay.
        $classAssignings = ClassAssigning::join('class_schedule','class_schedule.id',
                                                '=', 'class_assignings.class_schedule_id')
        ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
        ->join('classes', 'classes.id','=', 'class_schedule.class_id')
        ->join('days', 'days.day_id','=', 'class_schedule.day_id')
        ->join('levels', 'levels.level_id','=', 'class_schedule.degree_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
        ->join('times', 'times.time_id','=', 'class_schedule.time_id')
        ->join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
        ->join('departments', 'departments.department_id','=', 'class_schedule.department_id')
        ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
        ->orderBy('teachers.teacher_id')->paginate(3);
       
        // $classAssignings = ClassSchedule::with('classassign', 'classassign.teacher')
        // ->get();

        // foreach (\App\Models\ClassAssigning::has('teacher')->get() as $owner){
        //     echo $owner->fisrt_name;
        //     // foreach ($owner->teacher as $gerbil){
        //     //     echo $gerbil->last_name;
        //     // }
        // }
        // $users = ClassAssigning::select('teacher_id')->groupBy('teacher_id')->get()->toArray() ;
		// dd($classAssignings); die;

        // here is the code please you can write them at your end okay.
        return view('class_assignings.index', compact('classSchedules','teacher'))
            ->with('classAssignings', $classAssignings);
    }


    
    public function showClassInformation(Request $request)
    {
        if ($request->academic_id != '' && $request->program_id == '') {
            $criterial = array('academics.academic_id' => $request->academic_id);
        } elseif ($request->academic_id != '' &&
                            $request->program_id != '' &&
                            $request->level_id != '' &&
                            $request->shift_id != '' &&
                            $request->classroom_id != '' &&
                            $request->time_id != '' &&
                            $request->day_id != '' &&
                            $request->batch_id != '' &&
                            $request->group_id != '' &&
                            $request->teacher_id != '') {
            $criterial = array('academics.academic_id' => $request->academic_id,
                             'programs.program_id' => $request->program_id,
                              'levels.level_id' => $request->level_id,
                              'shifts.shift_id' => $request->shift_id,
                              'classrooms.classroom_id' => $request->classroom_id,
                              'times.time_id' => $request->time_id,
                              'days.day_id' => $request->day_id,
                               'batches.batch_id' => $request->batch_id,
                               'groups.group_id' => $request->group_id,
                               'teachers.teacher_id' => $request->teacher_id, );
        }

        $classes = $this->ClassInformation($criterial)->get();
        // $classes = $this->ClassInformation()->get();

        return view('class.classinfo', compact('classes'));
    }

    //{{-----------Show Class Information Contorller-------------------}}

    public function ClassInformation($criterial)
    {
        return MyClass::join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                               ->join('levels', 'levels.level_id', '=', 'classes.level_id')
                               ->join('programs', 'programs.program_id', '=', 'levels.program_id')
                               ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                               ->join('classrooms', 'classrooms.classroom_id', '=', 'classes.classroom_id')
                               ->join('times', 'times.time_id', '=', 'classes.time_id')
                               ->join('days', 'days.day_id', '=', 'classes.day_id')
                               ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                               ->join('groups', 'groups.group_id', '=', 'classes.group_id')
                               ->join('teachers', 'teachers.teacher_id', '=', 'classes.teacher_id')
                               ->where($criterial)
                                ->orderBy('classes.class_id', 'DESC');

        return view('class.classinfo', compact('classes'));
    }


    public function ShowClassAssign(Request $request){

        // public function search(Request $request)
        // {
            if ($request->has('search')) {
                $teachers = ClassAssigning::join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
                 ->where('class_assignings.teacher_id', 'LIKE', '%'.$request->search.'%')
                //  ->Orwhere('teachers.first_name', 'LIKE', '%'.$request->search.'%')
                //  ->Orwhere('teachers.last_name', 'LIKE', '%'.$request->search.'%')
                //  ->select(DB::raw('teachers,
                //                   first_name,
                //                   last_name,
                // CONCAT(first_name," ", last_name) As full_name,
                // (CASE WHEN gender=0 THEN "Male" ELSE "Female" END) As gender,dob,email,image,phone'))
                ->paginate(10)->appends('search', $request->search);
            } else {
                $teachers = ClassAssigning::select(DB::raw('teacher_id,
                                    first_name,
                                    last_name,
                                    CONCAT(first_name," ", last_name) As full_name,
                                    (CASE WHEN gender=0 THEN "Male" ELSE "Female" END) As gender,
                                    dob,email,image,phone'))->paginate(10);
            } 
                // dd( $teachers); die;
            // return view('class_assignings.show_class_assign')
            //     ->with('teachers', $teachers);
        // }
    

        $classAssignings = ClassAssigning::join('class_schedule','class_schedule.id',
                '=', 'class_assignings.class_schedule_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
            ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
            ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
            ->join('classes', 'classes.id','=', 'class_schedule.class_id')
            ->join('days', 'days.day_id','=', 'class_schedule.day_id')
            ->join('levels', 'levels.level_id','=', 'class_schedule.degree_id')
            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
            ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
            ->join('times', 'times.time_id','=', 'class_schedule.time_id')
            ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
            ->where('class_assignings.teacher_id', 'LIKE', '%'.$request->search.'%')
            ->orderBy('teachers.teacher_id')->get();

            return view('class_assignings.show_class_assign',compact('teachers'))
            ->with('classAssignings', $classAssignings);
    }

// function create here 
        public function insert(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'teacher_id' => 'required',
            ]);
    
            if ($validator->fails()) {
                Flash::error('Teacher can not be empty!');
                return redirect(route('classAssignings.index'));
                           
            }

            $input = $request->all();

            $teacher = new Status;
            $teacher->teacher_id = $request->teacher_id;
            $status_id = $teacher->save();
            if ($status_id != 0) {
                foreach ($request->multiclass as $key => $teach) {
                    $data2 = array('teacher_id'=> $request->teacher_id,
                                'class_schedule_id'=>$request->multiclass [$key]);
                    // dd($data2); die;
                    // $checkExist = ClassAssigning::where('teacher_id',$request->teacher_id) 
                    //                             ->where('class_schedule_id',$request->multiclass)
                    //                             ->first();
                    // if ($checkExist) {
                    //     Flash::error('Class Assigning for this Teacher already Exsist.');

                    //     return redirect(route('classAssignings.index'));
                    // }
                    // else
                    ClassAssigning::insert($data2);
                }
                // now let's try to insert our first class assigning with the teacher okay.
                
            }
            
            Flash::success('Class Assigning Generate successfully!.');

            return redirect(route('classAssignings.index'));
        }

        public function classassign_validation(){
            $rules = [  // this array okay to validate our buses input before insertation to our database
                'teacher_id' => 'required'
                
            ];

}

    /**r
     * Show the form for creating a new ClassAssigning.
     *
     * @return Response
     */
    public function create()
    {
        return view('class_assignings.create');
    }

    /**
     * Store a newly created ClassAssigning in storage.
     *
     * @param CreateClassAssigningRequest $request
     *
     * @return Response
     */
   
    /**
     * Display the specified ClassAssigning.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classAssigning = $this->classAssigningRepository->find($id);

        if (empty($classAssigning)) {
            Flash::error('Class Assigning not found');

            return redirect(route('classAssignings.index'));
        }

        return view('class_assignings.show')->with('classAssigning', $classAssigning);
    }

    /**
     * Show the form for editing the specified ClassAssigning.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classAssignings = $this->classAssigningRepository->find($id);
        $teacher = Teacher::get();
        if (empty($classAssignings)) {
            Flash::error('Class Assigning not found');

            return redirect(route('classAssignings.index'));
        }

        return view('class_assignings.edit', compact('teacher'))->with('classAssignings', $classAssignings);
    }

    /**
     * Update the specified ClassAssigning in storage.
     *
     * @param int $id
     * @param UpdateClassAssigningRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassAssigningRequest $request)
    {
        $classAssigning = $this->classAssigningRepository->find($id);

        if (empty($classAssigning)) {
            Flash::error('Class Assigning not found');

            return redirect(route('classAssignings.index'));
        }

        $classAssigning = $this->classAssigningRepository->update($request->all(), $id);

        Flash::success('Class Assigning updated successfully.');

        return redirect(route('classAssignings.index'));
    }

    /**
     * Remove the specified ClassAssigning from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classAssigning = $this->classAssigningRepository->find($id);

        if (empty($classAssigning)) {
            Flash::error('Class Assigning not found');

            return redirect(route('classAssignings.index'));
        }

        $this->classAssigningRepository->delete($id);

        Flash::success('Class Assigning deleted successfully.');

        return redirect(route('classAssignings.index'));
    }

   			
    // ClassAssigning PDF CODE
 
    public function PDFgenerator()
      {
       $classAssignings = ClassAssigning::all();
   
       $classAssignings = ClassAssigning::join('class_schedule','class_schedule.id',
             '=', 'class_assignings.class_schedule_id')
           ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
           ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
           ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
           ->join('classes', 'classes.id','=', 'class_schedule.class_id')
           ->join('days', 'days.day_id','=', 'class_schedule.day_id')
           ->join('levels', 'levels.level_id','=', 'class_schedule.degree_id')
           ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
           ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
           ->join('times', 'times.time_id','=', 'class_schedule.time_id')
           ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
           ->get(); // table will get 3 rows okay
   
           // instantiate and use the dompdf class
           // $dompdf->();
           // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
           $dompdf = PDF::loadview('class_assignings.pdf',['classAssignings'=> $classAssignings]);
        //    we will make the pdf file inside the class_assigning folder okay.
           // (Optional) Setup the paper size and orientation
           $dompdf->setPaper('A4', 'landscape');
   
           // Output the generated PDF to Browser
           $dompdf->stream();
   
           return $dompdf->download('Class_Assigning_Table.pdf');
      }

      public function PrintAllTeacherClassAssign(Request $request)
      {

        $classAssignings = ClassAssigning::all();

        $classAssignings = ClassAssigning::join('class_schedule','class_schedule.id',
             '=', 'class_assignings.class_schedule_id')
           ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
           ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
           ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
           ->join('classes', 'classes.id','=', 'class_schedule.class_id')
           ->join('days', 'days.day_id','=', 'class_schedule.day_id')
           ->join('levels', 'levels.level_id','=', 'class_schedule.degree_id')
           ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
           ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
           ->join('times', 'times.time_id','=', 'class_schedule.time_id')
           ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
           ->orderBy('teachers.teacher_id')->get();
            // ->where('class_assignings.teacher_id', 'LIKE', '%'.$request->search.'%')->get();
            //   dd( $classAssignings); die;
          return view('class_assignings.print_all',['classAssignings'=> $classAssignings]);
      }

      public function print( Request $request, $id)
      {

        $classAssignings = ClassAssigning::all();

        $classAssignings = ClassAssigning::join('class_schedule','class_schedule.id',
             '=', 'class_assignings.class_schedule_id')
           ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
           ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
           ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
           ->join('classes', 'classes.id','=', 'class_schedule.class_id')
           ->join('days', 'days.day_id','=', 'class_schedule.day_id')
           ->join('levels', 'levels.level_id','=', 'class_schedule.degree_id')
           ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
           ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
           ->join('times', 'times.time_id','=', 'class_schedule.time_id')
           ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
            ->where('class_assignings.teacher_id','=', $id )->get();
            // ->where('class_assignings.teacher_id', 'LIKE', '%'.$request->search.'%')->get();
            //   dd( $classAssignings); die;
          return view('class_assignings.print_teacher_class_assign',['classAssignings'=> $classAssignings]);
      }

      public function PDFgeneratorSingle($id)
      {
       $classAssignings = ClassAssigning::all();
   
        $classAssignings = ClassAssigning::join('class_schedule','class_schedule.id',
        '=', 'class_assignings.class_schedule_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
            ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
            ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
            ->join('classes', 'classes.id','=', 'class_schedule.class_id')
            ->join('days', 'days.day_id','=', 'class_schedule.day_id')
            ->join('levels', 'levels.level_id','=', 'class_schedule.degree_id')
            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
            ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
            ->join('times', 'times.time_id','=', 'class_schedule.time_id')
            ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
            ->where('class_assignings.class_assign_id','=', $id )->get();
              // dd( $admissions); die;
              $dompdf = PDF::loadview('class_assignings.single_pdf',['classAssignings'=> $classAssignings]);
                  // (Optional) Setup the paper size and orientation
                  $dompdf->setPaper('A4', 'landscape');
          
                  // Output the generated PDF to Browser
                  $dompdf->stream();
          
                  return $dompdf->download('Class_Assigned.pdf');
      }
}
