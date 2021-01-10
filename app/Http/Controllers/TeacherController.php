<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Exam;
use Flash;
use App\GPA;
use Session;
use App\Roll;
use DateTime;
use Response;
use App\Marks;
use App\HomeWork;
use App\Institute;
use Carbon\Carbon;
use App\Models\User;
use App\Ictcore_fees;
use App\Models\Batch;
use App\Models\Level;
use App\Models\Course;
use App\Models\Status;
use App\Models\Classes;
use App\Models\Faculty;
// use Excel;  // because this one is the same with this one okay
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\Admission;
use App\Models\Attendance;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use App\Imports\TeacherImport;
use App\StudentUploadHomeWork;
use App\Exports\Teacher_Export;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\TeacherRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash as FlashFlash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Support\Facades\DB as FacadesDB;

class TeacherController extends AppBaseController
{
    /** @var  TeacherRepository */
    private $teacherRepository;

    public function __construct(TeacherRepository $teacherRepo)
    {
        $this->teacherRepository = $teacherRepo;

			$this->middleware('auth');

    }

    /**
     * Display a listing of the Teacher.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $teachers = $this->teacherRepository->all();
        $teachers = Teacher::paginate(6);
        $teacher_id = Teacher::max('teacher_id');
        $semester = Semester::all();
        $classes = Classes::all();
        $subjects  = Course::all();
        $faculties  = Faculty::all();
        $timetable=array();

        $TeacherTimeTable =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
        ->where('class_schedule.teacher_id', $teacher_id)
        ->get();
        
        if(count($teachers)!=0){
            $rand_username_password = mt_rand(222609300011 .$teacher_id +1, 222609300011 .$teacher_id +1);
           }elseif(count($teachers)==0){
               $rand_username_password = mt_rand(2226093000111 .$teacher_id , 2226093000111 .$teacher_id );
           }
        // dd($TeacherTimeTable); die;
        return view('teachers.index',compact('teacher_id','faculties','TeacherTimeTable','semester','timetable','classes','subjects'))
            ->with('teachers', $teachers)->with('rand_username_password',$rand_username_password);
    }

    // allStudentList

     public function StudentListInCharge(Request $request)
    {
        $teacher_id = Auth::user()->teacher_id;
        $allStudentList = Admission::join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
                                    ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')                                
                                    ->join('rolls', 'rolls.student_id','=', 'admissions.id')
                                    ->join('departments', 'departments.department_id','=', 'admissions.department_id')
                                ->where('class_schedule.teacher_id', $teacher_id)
                                // ->where(['class_schedule.class_id' =>  $request->class_id])
                                ->get();
        
        $teacher_class = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')                                
                                        ->select('classes.class_code','semesters.semester_name')
                                        ->where('teacher_id',$teacher_id)->get();                        
                                // dd($allStudentList);
       return view('teachers.students.studentList',compact('teacher_class'))->with('allStudentList',$allStudentList);
    }

    public function GetStudentListInCharge(Request $request)
    {
        $teacher_id = Auth::user()->teacher_id;
        $allStudentList = Admission::join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
                                    ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                    ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')                                
                                    ->join('rolls', 'rolls.student_id','=', 'admissions.id')
                                    ->join('departments', 'departments.department_id','=', 'admissions.department_id')
                                ->where('class_schedule.teacher_id', $teacher_id)
                                ->where(['class_schedule.class_id' =>  $request->class_id])
                                ->get();

        $classStudentListCount = Admission::join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
            ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')                                
            ->join('rolls', 'rolls.student_id','=', 'admissions.id')
            ->join('departments', 'departments.department_id','=', 'admissions.department_id')
        ->where('class_schedule.teacher_id', $teacher_id)
        ->where(['class_schedule.class_id' =>  $request->class_id])
        ->count();

        $teacher_class = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')                                
        ->select('classes.class_code','semesters.semester_name')
        ->where('teacher_id',$teacher_id)->get();    
        
        $teacher_class_grade = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')                                
        ->select('classes.class_code','semesters.semester_name', 'classes.class_name')
        ->where('teacher_id',$teacher_id)
        ->where(['class_schedule.class_id' =>  $request->class_id])->get(); 

      return view('teachers.students.studentList',compact('teacher_class','teacher_class_grade','classStudentListCount'))->with('allStudentList',$allStudentList);
    }

    public function ClassListInCharge(Request $request)
    {
        $teacher_id = Auth::user()->teacher_id;
        $allStudentList = Classes::join('class_schedule', 'class_schedule.class_id','=', 'classes.class_code')
                                 ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id') 
                                 ->join('admissions', 'admissions.class_code','=', 'classes.class_code') 
                                ->where('class_schedule.teacher_id', $teacher_id)
                                ->select('classes.class_name as class_name', 'semesters.semester_name as semester_name', 'classes.class_code as class_code', DB::raw('count(admissions.id) as total_student'))
                                ->where('admissions.school_id', auth()->user()->school_id)
                                ->groupBy('class_name', 'semester_name','class_code')->get();

                               
                                // dd($all_studentDetail);
       return view('teachers.classes.classList')->with('allStudentList',$allStudentList);
    }

    public function AllStudentDetail_In_Class($class_code)
    {
        $teacher_id = Auth::user()->teacher_id;
        $all_studentDetail = Classes::join('class_schedule', 'class_schedule.class_id','=', 'classes.class_code')
                                ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id') 
                                ->join('admissions', 'admissions.class_code','=', 'classes.class_code') 
                                ->join('rolls', 'rolls.student_id','=', 'admissions.id') 
                            ->where('class_schedule.teacher_id', $teacher_id)
                            ->where('admissions.class_code', $class_code)
                            ->where('admissions.school_id', auth()->user()->school_id)
                            // ->groupBy('admissions.id')
                            ->get();
    return view('teachers.classes.classList')->with('all_studentDetail',$all_studentDetail);
    }

    public function SortTeacher(Request $request)
    {

        if ($request->sort_by_gender != '') {

            $teacherList = Teacher::join('faculties', 'faculties.faculty_id','=', 'teachers.faculty_id')
                                    ->join('departments', 'departments.department_id','=', 'teachers.department_id')
                                    ->where('gender', $request->sort_by_gender)->get();

        }
        else if($request->roll_no != '')
        {
            $teacherList = Teacher::join('faculties', 'faculties.faculty_id','=', 'teachers.faculty_id')
                                   ->join('departments', 'departments.department_id','=', 'teachers.department_id')
                                   ->where('teachers.roll_no', $request->roll_no)->get();

        }

        else
        {
            $teacherList = Teacher::join('faculties', 'faculties.faculty_id','=', 'teachers.faculty_id')
            ->join('departments', 'departments.department_id','=', 'teachers.department_id')->get();
        }

        $male = Teacher::where('gender', '0')->count();
        $female = Teacher::where('gender', '1')->count();

        $view = view('teachers.teacher.table_list',compact('female','male'))
        ->with('teacherList', $teacherList)
        ->with('female', $female)
        ->with('male', $male)->render();
    
         return response($view);
    }


    public function TeacherList(Request $request)
    {
        $teacherList = Teacher::join('faculties', 'faculties.faculty_id','=', 'teachers.faculty_id')
                                ->join('departments', 'departments.department_id','=', 'teachers.department_id')
                                ->get();
                                // dd($teacherList);
       return view('teachers.teacher.teacherList')->with('teacherList',$teacherList);
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $teachers = Teacher::where('teacher_id', 'LIKE', '%'.$request->search.'%')
             ->Orwhere('first_name', 'LIKE', '%'.$request->search.'%')
             ->Orwhere('last_name', 'LIKE', '%'.$request->search.'%')
             ->select(DB::raw('teacher_id,
                              first_name,
                              last_name,
            CONCAT(first_name," ", last_name) As full_name,
            (CASE WHEN gender=0 THEN "Male" ELSE "Female" END) As gender,dob,email,image,phone'))
            ->paginate(10)->appends('search', $request->search);
        } else {
            $teachers = Teacher::select(DB::raw('teacher_id,
                                first_name,
                                last_name,
                                CONCAT(first_name," ", last_name) As full_name,
                                (CASE WHEN gender=0 THEN "Male" ELSE "Female" END) As gender,
                                dob,email,image,phone'))->paginate(10);
        }

        return view('teachers.index')
            ->with('teachers', $teachers);
    }


    public function markindex(Request $request)
	{
        $teacher_id =  Auth::user()->teacher_id;
        $classes = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
        ->select('classes.class_code','classes.class_name')->orderby('classes.class_code','asc')
        ->where('class_schedule.teacher_id', $teacher_id)
        ->get();

        // dd( $classes); die;

        // $class_id = DB::table('classes')->select("*")->where('class_code','=','C-A-0001-GBS')->first();

        //      $class_data = FacadesDB::table('exam')->select('id','type')
        //      ->where('class_id','=',$class_id->id);
        //      if($request->get('section')!=''){
        //          $class_data = $class_data->where('session','=',$request->get('section'));
        //      }
        //      $class_data =$class_data->get();

        //      dd($class_data);
        
        $subjects = Course::join('class_schedule','class_schedule.course_id', '=', 'courses.id')
        ->where('class_schedule.school_id', auth()->user()->school_id)
        ->where('class_schedule.teacher_id', auth()->user()->teacher_id)->get();
        $batches = ClassSchedule::join('batches', 'batches.id', '=', 'class_schedule.batch_id')
        ->select('batches.id','batches.batch','batches.is_current_batch')->orderby('id','asc')
        ->where('batches.is_current_batch', 1)
        ->where('batches.school_id', auth()->user()->school_id)
        ->where('class_schedule.teacher_id', $teacher_id)
        ->get();

        // dd( auth()->user()->school_id); die;
        
		$class_code =$request->get('class_id');
		if($class_code !=''){
           $departments = DB::table('departments')->where('class_code',$class_code)
           ->where('school_id', auth()->user()->school_id)->get();
           dd($departments);
		}else{
			$eections = array();
		}

		$department   = $request->get('department');
		$session   = $request->get('session');
		$exam      = $request->get('exam');

		if($exam  !='' && $class_code!=''){
			$exams = DB::table('exam')->where('id',$exam)->where('school_id', auth()->user()->school->id)->get();
		}else{
			$exams = array();
		}
		//return View::Make('mark_management.markCreate',compact('classes','subjects'));
		return View('teachers.mark_management.markCreate',compact('classes','batches','subjects','class_code','exam','department','session','exams'));
    }
    
    public function TeacherEnterMarks(Request $request)
	{
		$data =	$request->all();
		// dd($data);die;
		$rules=[
			'class'     => 'required',
			'department'   => 'required',
			'shift'     => 'required',
			'session'   => 'required',
			'roll'    => 'required',
			'exam'      => 'required',
			'subject'   => 'required',
			'written'   => 'required',
			'mcq'       => 'required',
			'practical' =>'required',
			'ca'        =>'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        // dd( $validator);
		if ($validator->fails())
		{
            Flash::error( $validator.'are required.');
                return redirect(url('/mark/entry'));
		}
		else {
			// $subGradeing = Course::select('gradeSystem')->where('course_code',$request->get('subject'))->where('class',$request->get('class'))->first();
            $subGradeing = Course::select('gradeSystem')->where('course_code',$request->get('subject'))->where('class',$request->get('class'))->first();
            
            // dd($subGradeing);
			if($subGradeing->gradeSystem=="1")
			{
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',"1")->get();

			// }
			// else if($subGradeing->gradeSystem=="2") {
            //     $gparules = GPA::select('gpa','grade','markfrom')->where('for',"2")->get();
                
            }else if($subGradeing->gradeSystem=="3") {
                    $gparules = GPA::select('gpa','grade','markfrom')->where('for',"3")->get();

            // }else if($subGradeing->gradeSystem=="4") {
            //         $gparules = GPA::select('gpa','grade','markfrom')->where('for',"4")->get();
			}else{
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',$subGradeing->gradeSystem)->get();

            }
            // dd($gparules = GPA::select('gpa','grade','markfrom')->where('for',$subGradeing->gradeSystem)->get());
			//	 $totalMark = Input
			$len = count($request->get('roll'));

			$roll_no    = $request->get('roll');
			$writtens   = $request->get('written');
			$mcqs       = $request->get('mcq');
			$practicals = $request->get('practical');
			$cas        = $request->get('ca');
			$isabsent   = $request->get('absent');
			$counter    = 0;

			for ( $i=0; $i< $len;$i++) {
				$isAddbefore = Marks::where('roll_no','=',$roll_no[$i])
							    ->where('exam','=',$request->get('exam'))
							   ->where('subject','=',$request->get('subject'))->first();
				if($isAddbefore)
				{

				}
				else {
					$marks = new Marks;
					$marks->class = $request->get('class');
					$marks->department = $request->get('department');
					$marks->shift = $request->get('shift');
					$marks->session = trim($request->get('session'));
					$marks->roll_no = $roll_no[$i];
					$marks->exam = $request->get('exam');
					$marks->subject = $request->get('subject');
					$marks->written = $writtens[$i];
					$marks->mcq = $mcqs[$i];
					$marks->practical = $practicals[$i];
					$marks->ca = $cas[$i];
					$isExcludeClass = $request->get('class');
					$marks->school_id = auth()->user()->school_id;
					if($isExcludeClass=="cl3" ||  $isExcludeClass=="cl4" || $isExcludeClass=="cl5")
					{
						$totalmark = $writtens[$i]+$mcqs[$i]+$practicals[$i]+$cas[$i];
					}
					else
					{
						//$totalmark = ((($writtens[$i]+$mcqs[$i])*80)/100)+$practicals[$i]+$cas[$i];
						$totalmark = $writtens[$i]+$mcqs[$i]+$practicals[$i]+$cas[$i];
					}
					$marks->total=$totalmark;
                    echo "<pre>d";print_r($gparules->toArray());
                   
					foreach ($gparules as $gpa) {

						if ($totalmark >= 80){
							$marks->grade = 'A+';
                            $marks->point = 4;
                        }
                        elseif ($totalmark >= 70) {
                            $marks->grade = 'A';
                            $marks->point = 3.5;
                        }
                        elseif ($totalmark >= 60) {
                            $marks->grade = 'B';
                            $marks->point = 3;
                        }

                        elseif ($totalmark >= 50) {
                            $marks->grade = 'C';
                            $marks->point = 2.5;
                        }
                        elseif ($totalmark >= 40) {
                            $marks->grade = 'D';
                            $marks->point = 2;
                        }
                        elseif($totalmark >= 30){
                            $marks->grade = 'E';
                            $marks->point = 1.5;
                        }
                        else{
                            $marks->grade = 'F';
                            $marks->point = 1.5;
                        }
							break;
                        }
                        
                        // dd($gpa->markfrom >= $totalmark );
					// }

					if($isabsent[$i]!== "")
					{
						$marks->Absent = $isabsent[$i];
					}
                    //   echo "<pre>";print_r($marks);exit;
					$marks->save();
					$counter++;
				}
			}
			if($counter==$len)
			{
                Flash::success( $counter. '  exam mark saved successfully.');
				return Redirect::to('/mark/entry');
			}
			else {
                $already=$len-$counter;
                Flash::error('This '. $already. ' exam mark already exist.');
                return Redirect::to('/mark/entry');
			}
		}
	}

    public function GetMarkList()
	{

		$formdata = new Ictcore_fees;
		$formdata->class="";
		$formdata->department="";
		$formdata->shift="";
		$formdata->session="";
		$formdata->subject="";
        $formdata->exam="";
        
         $teacher_id =  Auth::user()->teacher_id;
         
        $classes = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
        ->select('classes.class_code','classes.class_name')->orderby('classes.class_code','asc')
        ->where('class_schedule.teacher_id', $teacher_id)
        ->get();

        // dd($teacher_id); die;
        
		// $subjects = Course::all();
		// $batches = ClassSchedule::join('batches', 'batches.id', '=', 'class_schedule.batch_id')
        // ->select('batches.id','batches.batch','batches.is_current_batch')->orderby('batches.id','asc')
        // ->where('class_schedule.teacher_id', $teacher_id)
        // ->where('batches.is_current_batch', 1)
        // ->get();

        $subjects = Course::join('class_schedule','class_schedule.course_id', '=', 'courses.id')
        ->where('class_schedule.school_id', auth()->user()->school_id)
        ->where('class_schedule.teacher_id', auth()->user()->teacher_id)->get();
        $batches = ClassSchedule::join('batches', 'batches.id', '=', 'class_schedule.batch_id')
        ->select('batches.id','batches.batch','batches.is_current_batch')->orderby('id','asc')
        ->where('batches.is_current_batch', 1)
        ->where('batches.school_id', auth()->user()->school_id)
        ->where('class_schedule.teacher_id', auth()->user()->teacher_id)
        ->get();

        // dd($batches); die;
		
		//$subjects = Subject::lists('name','code');
		$marks=array();


		//$formdata["class"]="";
		//return View::Make('mark_management.markList',compact('classes','marks','formdata'));
		return View('teachers.mark_management.markList',compact('classes','marks','formdata','batches'));
    }
    
    public function TeacherGetMarkList(Request $request)
	{
        // dd($request->all());
		$rules=[
			'class' => 'required',
			'department' => 'required',
			// 'shift' => 'required',
			'batch' => 'required',
			'exam' => 'required',
			'subject' => 'required',

		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/get/mark/list/')->withErrors($validator);
		}
		else {
            $teacher_id =  Auth::user()->teacher_id;
         
            $classes = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
            ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
            ->select('classes.class_code','classes.class_name')->orderby('classes.class_code','asc')
            ->where('class_schedule.teacher_id', $teacher_id)
            ->get();
            // dd($classes);
			// $subjects = Course::where('class',$request->get('class'))->pluck('course_name','course_code');
            // $batches = Batch::select('id','batch')->orderby('batch','asc')->get();
            
            $subjects = Course::join('class_schedule','class_schedule.course_id', '=', 'courses.id')
            ->where('class_schedule.school_id', auth()->user()->school_id)
            ->where('class_schedule.teacher_id', auth()->user()->teacher_id)
            ->pluck('courses.course_name','courses.course_code');

            $batches = ClassSchedule::join('batches', 'batches.id', '=', 'class_schedule.batch_id')
            ->select('batches.id','batches.batch','batches.is_current_batch')->orderby('id','asc')
            ->where('batches.is_current_batch', 1)
            ->where('batches.school_id', auth()->user()->school_id)
            ->where('class_schedule.teacher_id', $teacher_id)
            ->orderby('batch','asc')->get();

			$marks=	DB::table('rolls')
			->join('marks', 'marks.roll_no', '=', 'rolls.username')
			->join('batches', 'batches.id', '=', 'marks.session')
			// ->join('courses', 'courses.course_code', '=', 'marks.subject')
			->rightjoin('admissions', 'admissions.id', '=', 'rolls.student_id')
			->select('marks.id','marks.roll_no','rolls.username', 'admissions.first_name',
			'admissions.last_name', 'marks.written','marks.mcq',
			'marks.practical','marks.ca','marks.total','marks.grade','marks.point',
            'marks.Absent',
            'batches.batch')
			->where('admissions.acceptance', '=', 'accept')
			->where('admissions.class_code','=',$request->get('class'))
			->where('marks.class','=',$request->get('class'))
			->where('marks.department','=',$request->get('department'))
		        //  ->Where('Marks.shift','=',$request->get('shift'))
			->where('marks.session','=',trim($request->get('batch')))
			->where('marks.subject','=',$request->get('subject'))
			->where('marks.exam','=',$request->get('exam'))
			->get();
            $class = Roll::all();
			// dd($marks); die;

			$formdata = new Ictcore_fees;
			$formdata->class=$request->get('class');
			$formdata->department=$request->get('department');
			$formdata->shift=$request->get('shift');
			$formdata->session=$request->get('batch');
			$formdata->subject=$request->get('subject');
			$formdata->exam=$request->get('exam');

			if(count($marks)==0)
			{
				// dd($formdata); die;
                Flash::error('No Results Found!');
                return Redirect::to('/get/mark/list/');
                
                // View('mark_management.markList',compact('classes2','class','subjects','marks','noResult','formdata','batches'));
			}
			
			// return View::Make('mark_management.markList',compact('classes2','subjects','marks','formdata'));
            // return  Redirect::to('/get/mark/list/')->with('marks', $marks);
            
            return View('teachers.mark_management.markList',compact('classes', 'class','subjects','marks','formdata','batches'));
		}
    }
    
    public function markedit($id)
	{
        $marks = Marks::join('rolls', 'rolls.username', '=', 'marks.roll_no')
            
        ->join('departments', 'departments.department_id', '=', 'marks.department')
        ->join('courses', 'courses.course_code', '=', 'marks.subject')
        ->join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->join('batches', 'batches.id', '=', 'admissions.batch_id')
        ->join('classes', 'classes.class_code', '=', 'marks.class')
        ->select('marks.id','marks.roll_no','admissions.first_name','courses.course_name','courses.course_code',
        'admissions.last_name', 'marks.written','marks.mcq','classes.class_name','departments.department_name',
        'marks.practical','marks.ca','marks.total','marks.grade','marks.point','classes.class_code',
        'marks.Absent','batches.batch')
		->where('Marks.id','=',$id)
        ->first();
        
        // dd($marks ); die;

		return View('teachers.mark_management.markEdit',compact('marks'));


    }

    public function markupdate(Request $request)
	{
        // $subGradeing = Course::select('gradeSystem')->where('course_code',$request->get('subject'))->where('class',$request->get('class'))->first();

        // dd($subGradeing); die;

       $course_code = $request->get('subject');
       $class_code = $request->get('class');
		$rules=[
			'written' => 'required',
			'mcq' => 'required',
			'practical' =>'required',
			'ca' =>'required',
			'subject' => 'required',
			'class' => 'required'
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
            Flash::error($validator,'Opps Check your fields');
			return Redirect::to('/teacher/mark/edit/'.$request->get('id'))->withErrors($validator);
		}
		else {

            $marks = Marks::find($request->get('id'));
            
            //get subject grading system
            $subGradeing = Course::select('gradeSystem','class')->where('course_code',$course_code )->where('class',$class_code)->first();
            // dd($subGradeing); die;
            // $subGradeing = Subject::select('gradeSystem','class')->where('code',$request->get('subject'))->where('class',$request->get('class'))->first();
			if($subGradeing->gradeSystem=="1")
			{
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',"1")->get();

			}
			else {
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',"2")->get();
			}
			//end
			$marks->written=$request->get('written');
			$marks->mcq = $request->get('mcq');
			$marks->practical=$request->get('practical');
			$marks->ca=$request->get('ca');

			$isExcludeClass=$subGradeing->class;
			if($isExcludeClass=="cl3" ||  $isExcludeClass=="cl4" || $isExcludeClass=="cl5")
			{
				$totalmark =$request->get('written')+$request->get('mcq')+$request->get('practical')+$request->get('ca');
			}
			else
			{
				//$totalmark = ((($request->get('written')+$request->get('mcq'))*80)/100)+$request->get('practical')+$request->get('ca');
				 $totalmark =$request->get('written')+$request->get('mcq')+$request->get('practical')+$request->get('ca');

			}
			$marks->total=$totalmark;
            foreach ($gparules as $gpa) {

                if ($totalmark >= 80){
                    $marks->grade = 'A+';
                    $marks->point = 4;
                }
                elseif ($totalmark >= 70) {
                    $marks->grade = 'A';
                    $marks->point = 3.5;
                }
                elseif ($totalmark >= 60) {
                    $marks->grade = 'B';
                    $marks->point = 3;
                }

                elseif ($totalmark >= 50) {
                    $marks->grade = 'C';
                    $marks->point = 2.5;
                }
                elseif ($totalmark >= 40) {
                    $marks->grade = 'D';
                    $marks->point = 2;
                }
                elseif($totalmark >= 30){
                    $marks->grade = 'E';
                    $marks->point = 1.5;
                }
                else{
                    $marks->grade = 'F';
                    $marks->point = 1.5;
                }
                    break;
                }
			$marks->Absent=$request->get('Absent');
            // dd($marks);
            $marks->save();
            Flash::success('Marks Update Sucessfully');
			return Redirect::to('get/mark/list');

		}
    }
    
    public function TeacherResultHome(Request $request)
	{
        $teacher_id  = Auth::user()->teacher_id;
        $class_id  = $request->get('class_code');
        $isGenerated=DB::table('meritlist')
        ->join('exam', 'exam.id', '=', 'meritlist.exam')
        ->join('classes', 'classes.id', '=', 'exam.class_id')
        ->join('batches', 'batches.id', '=', 'meritlist.batch')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'classes.class_code')
        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
        ->select('meritlist.roll_no','exam.type','batches.batch', 'meritlist.class', 
        'meritlist.exam', 'classes.class_name','classes.class_code','meritlist.id as result_id'
        //  DB::raw('count(*) as total')
         )
        //  ->groupBy('exam')
        ->where(['class_schedule.teacher_id' =>  $teacher_id])
        ->where(['class_schedule.class_id' =>  $class_id])
        ->get();


        $class_assign = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->where(['teacher_id' =>  $teacher_id])
        ->where(['class_schedule.class_id' =>  $class_id])
        ->get();


        $class_assign1 = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->where(['teacher_id' =>  $teacher_id])
        // ->where(['class_schedule.class_id' =>  $class_id])
        ->get();

        // dd( $class_assign); die;



        $class_name = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
        // ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                     ->join('class_schedule', 'class_schedule.class_id','=', 'admissions.class_code')
                     ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                     ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                     ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                     ->where(['teachers.teacher_id' =>  $teacher_id])
                     ->first();

        $exam_term = DB::table('meritlist')
        ->join('exam', 'exam.id', '=', 'meritlist.exam')
        ->join('classes', 'classes.id', '=', 'exam.class_id')
        ->join('batches', 'batches.id', '=', 'meritlist.batch')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'classes.class_code')
        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
        ->select('meritlist.roll_no','exam.type','batches.batch', 'meritlist.class', 
        'meritlist.exam', 'classes.class_name','classes.class_code','meritlist.id as result_id','class_schedule.semester_id'
        //  DB::raw('count(*) as total')
         )
        //  ->groupBy('exam')
        ->where(['class_schedule.teacher_id' =>  $teacher_id])
        ->first();
            
                    //   dd( $exam_term); die;
       
        $enable_grade = Semester::where('status', "on")->where('school_id', auth()->user()->school_id)->get();
      return  $class_grade = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')->
        where('teacher_id', Auth::user()->teacher_id)->where('class_schedule.class_id',$class_name->class_code)->get();
        
        // dd($class_grade);
        return view('teachers.results.result', compact('isGenerated','class_name','class_assign','class_assign1','enable_grade','class_grade','exam_term'));
       
        
    }
    

    public function GetTeacherHomeWork(Request $request)
    {

        $teacher_id  = Auth::user()->teacher_id;
        $class_assign1 = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->where(['teacher_id' =>  $teacher_id])
        ->get();

        return view('teachers.homework.create', compact('class_assign1'));
    }

    public function SendTeacherHomeWork(Request $request, $class_id)
    {

        $teacher_id  = Auth::user()->teacher_id;
        $class_assign = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('courses', 'courses.id','=', 'class_schedule.course_id')
        ->select('classes.class_code as class_code', 'classes.*','semesters.id as semester_id','semesters.*','courses.id as subject_id','courses.*','class_schedule.*')
        ->where(['teacher_id' =>  $teacher_id])
        ->where(['class_schedule.class_id' =>  $class_id])
        ->get();

        // dd($class_assign);

        $teacher_id  = Auth::user()->teacher_id;
        $class_assign1 = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->where(['teacher_id' =>  $teacher_id])
        ->get();

        return view('teachers.homework.create', compact('class_assign','class_assign1'));
    }

    public function getStudentHomeWork($student_id)
    {
        // $student_homework = StudentUploadHomeWork::where('student_id', $student_id)->where('school_id', auth()->user()->school_id)->get()->dd();

        $teacher_id  = Auth::user()->teacher_id;
        $student_homework = Roll::join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->join('student_upload_homeworks', 'student_upload_homeworks.student_id','=', 'admissions.id')
        ->join('semesters', 'semesters.id','=', 'student_upload_homeworks.semester_id')
        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
        ->join('courses', 'courses.id', '=', 'student_upload_homeworks.subject_id')
        // ->select('semesters.id as semester_id','semesters.*','courses.id as subject_id',
        //     'courses.*','student_upload_homeworks.*','admissions.*')
        ->where(['teacher_id' =>  $teacher_id])
        ->where(['student_upload_homeworks.student_id' =>  $student_id])
        ->where('admissions.school_id', auth()->user()->school_id)
        ->get();

        $class_assign1 = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('admissions', 'admissions.class_code', '=', 'classes.class_code')
        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->select('semesters.id as semester_id','semesters.*','courses.*',
            'classes.id as class_id','classes.*','admissions.*')
        ->where(['teacher_id' =>  $teacher_id])
        // ->where(['class_code' =>  $id])
        ->where('class_schedule.school_id', auth()->user()->school_id)
        // ->groupBy('semesters.id as semester_id','semesters.*','courses.*',
        // 'classes.id as class_id','classes.*')
        ->first();
        // dd($edit_homework);
        return view('teachers.homework.homework_submit', compact('class_assign','class_assign1','student_homework'));

        return view();
    }

    public function CreateHomeWork(Request $request)
    {
        $input = $request->all();
        dd( $input);

        $image =  $request->file('homework_file'); // this request is requesting image file okay.

        $image_name = rand(1111,9999) . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('teacher_homeworks'), $image_name);

        $homework =  new HomeWork;
        $homework->body = $request->body;
        $homework->file = $image_name;
        $homework->class_code = $request->class_code;
        $homework->subject_id = $request->subject_id;
        $homework->semester_id = $request->grade;
        $homework->start_date = $request->start_date;
        $homework->end_date = $request->end_date;
        $homework->status = $request->status;
        $homework->teacher_id = $request->teacher_id;
        $homework->school_id = auth()->user()->school_id;

        $homework->save();

        Flash::success('Teacher saved successfully!.');
        return redirect(url('homework-list'));
    }


    public function HomeWorkList(Request $request)
    {
        $teacher_id  = Auth::user()->teacher_id;
        $class_assign = HomeWork::join('courses', 'courses.id', '=', 'homeworks.subject_id')
        ->join('semesters', 'semesters.id','=', 'homeworks.semester_id')
        // ->join('courses', 'courses.id','=', 'homeworks.subject_id')
        ->select('semesters.id as semester_id','semesters.*','courses.id as subject_id',
        'courses.*','homeworks.*', 'homeworks.id as homework_id')
        ->where(['teacher_id' =>  $teacher_id])
        ->where('homeworks.school_id', auth()->user()->school_id)
        // ->where(['class_schedule.class_id' =>  $class_id])
        ->get();
            $date1 = now()->format('Y-m-d');
            $time1 = now()->format('H:i:00');
            // echo date("l jS \of F Y h:i:s A");
            // dd($date1,  $time1 );
        DB::table('homeworks')
        
                ->whereDate('end_date', '=', $date1)
                ->whereTime('end_date', '=',  $time1)
                // ->whereTime('end_date', '==',  $date1)
                // ->whereTime('end_date', '<=', \Carbon\Carbon::parse( $date1))
                ->get();
       
        // dd( $class_assign);
        return view('teachers.homework.homeworkList', compact('class_assign'));
    }

    public function HomeWorkUploaded(Request $request, $id)
    {
        $teacher_id  = Auth::user()->teacher_id;
        $class_assign = Roll::join('admissions', 'admissions.id', '=', 'rolls.student_id')
        ->join('student_upload_homeworks', 'student_upload_homeworks.student_id','=', 'admissions.id')
        ->join('semesters', 'semesters.id','=', 'student_upload_homeworks.semester_id')
        ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
        ->join('courses', 'courses.id', '=', 'student_upload_homeworks.subject_id')
        // ->select('semesters.id as semester_id','semesters.*','courses.id as subject_id',
        //     'courses.*','student_upload_homeworks.*','admissions.*')
        ->where(['teacher_id' =>  $teacher_id])
        ->where(['student_upload_homeworks.class_code' =>  $id])
        ->where('admissions.school_id', auth()->user()->school_id)
        ->get();

        $class_assign1 = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        ->select('semesters.id as semester_id','semesters.*','courses.*',
            'classes.id as class_id','classes.*')
        ->where(['teacher_id' =>  $teacher_id])
        ->where(['class_code' =>  $id])
        ->where('class_schedule.school_id', auth()->user()->school_id)
        ->first();
        // dd($edit_homework);
        return view('teachers.homework.homework_submit', compact('class_assign','class_assign1'));
    }


    
    public function HomeWorkEdit(Request $request, $id)
    {
        $teacher_id  = Auth::user()->teacher_id;
        $edit_homework = HomeWork::find($id);
        // $edit_homework = HomeWork::join('courses', 'courses.id', '=', 'homeworks.subject_id')
        // ->join('semesters', 'semesters.id','=', 'homeworks.semester_id')
        // ->select('semesters.id as semester_id','semesters.semester_name','courses.id as subject_id',
        // 'courses.course_name','homeworks.*')
        // ->where(['teacher_id' =>  $teacher_id])
        // ->where(['homeworks.id' =>  $id])
        // ->where('homeworks.school_id', auth()->user()->school_id)
        // ->first();

        $class_assign1 = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->select('semesters.id as semester_id','semesters.*',
            'classes.id as class_id','classes.*')
        ->where(['teacher_id' =>  $teacher_id])
        // ->where('homeworks.school_id', auth()->user()->school_id)
        ->get();
        // dd($edit_homework);
        return view('teachers.homework.edit', compact('edit_homework','class_assign1'));
    }

    public function HomeWorkUpdate(Request $request, $id)
    {
            // dd( $input = $request->all());
        $image_name = $request->hidden_image;
        $image =  $request->file('homework_file'); // this request is requesting image file okay.
        if($image != '')
        {
            // $input = $request->all();
        // dd($image_name);
        $image_name = rand(1111,9999) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('teacher_homeworks'), $image_name);
    }
    else{
        $image_name = $request->hidden_image;
        // dd($image_name);
    }

        $update_homework = array( // Teacher is the modal of the Teacher where we have all the fillbale attributes.
        'body' => $request->body,
        'class_code' => $request->class_code,
        'subject_id' => $request->subject_id,
       'semester_id' => $request->grade,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => $request->status,
        'file' => $image_name // is the new name of the image okay.
    );

    HomeWork::findOrFail($id)->update($update_homework);

        Flash::success('Home work updated successfully.');

        return redirect(route('homework-list'));
    }

    public function HomeWorkDelete(Request $request, $id)
    {
        $teacher_id  = Auth::user()->teacher_id;
        $delete_homework = HomeWork::findOrFail($id);
        
        $delete_homework->delete();

        Flash::success('Home Work Deleted Successfully!');
        return redirect()->back();
       
    }

    public function TeacherResultByClass(Request $request, $class_id)
    {
        $session_batch = Batch::where('is_current_batch', 1)->where('school_id', auth()->user()->school_id)->first();

        $teacher_id  = Auth::user()->teacher_id;
        $isGenerated=DB::table('meritlist')
        ->join('exam', 'exam.id', '=', 'meritlist.exam')
        ->join('classes', 'classes.id', '=', 'exam.class_id')
        ->join('batches', 'batches.id', '=', 'meritlist.batch')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'classes.class_code')
        ->join('semesters', 'semesters.id', '=', 'class_schedule.semester_id')
        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
        ->join('admissions', 'admissions.class_code', '=', 'classes.class_code')
        ->select('meritlist.roll_no','exam.type','batches.batch', 'batches.id', 'meritlist.class', 
        'meritlist.exam', 'classes.class_name','classes.class_code','meritlist.id as result_id'
        , 'semesters.semester_name','admissions.image','admissions.first_name','admissions.last_name','admissions.email','admissions.father_name','admissions.phone'
        //  DB::raw('count(*) as total')
         )
        //  ->groupBy('exam')
        ->where(['class_schedule.teacher_id' =>  $teacher_id])
        ->where(['class_schedule.class_id' =>  $class_id])
        ->where('meritlist.school_id', auth()->user()->school_id)
        ->get();

        $isGeneratedResult=DB::table('meritlist')
        ->join('exam', 'exam.id', '=', 'meritlist.exam')
        ->join('classes', 'classes.id', '=', 'exam.class_id')
        ->join('batches', 'batches.id', '=', 'meritlist.batch')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'classes.class_code')
        ->join('semesters', 'semesters.id', '=', 'class_schedule.semester_id')
        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
        ->select('meritlist.roll_no','exam.type','batches.batch', 'batches.id', 'meritlist.class', 
        'meritlist.exam', 'classes.class_name','classes.class_code','meritlist.id as result_id'
        , 'semesters.semester_name'
        //  DB::raw('count(*) as total')
         )
        //  ->groupBy('exam')
        
        ->where(['class_schedule.teacher_id' =>  $teacher_id])
        ->where(['class_schedule.class_id' =>  $class_id])
        ->where(['class_schedule.batch_id' =>  $session_batch->id])
        ->where('meritlist.school_id', auth()->user()->school_id)
        ->first();

        // dd($isGeneratedResult);


        if (!$isGeneratedResult) {
            FlashFlash::info('Result Session ' . $session_batch->batch . ' is not Pulished Yet! ' . ' We will notifi you when the Result are published.');
            return redirect(url('teacher/gradesheet'));
        }

        

        $class_assign = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('exam', 'exam.id', '=', 'classes.id')
        ->join('batches', 'batches.id', '=', 'exam.session')
        ->where(['teacher_id' =>  $teacher_id])
        ->where(['class_schedule.class_id' =>  $class_id])
        ->where(['class_schedule.school_id' => auth()->user()->school_id])
        ->get();

        // dd($class_assign);
        $class_assign1 = ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
        ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        ->join('exam', 'exam.id', '=', 'classes.id')
        ->join('batches', 'batches.id', '=', 'exam.session')
        ->where(['teacher_id' =>  $teacher_id])
        ->where(['class_schedule.class_id' =>  $class_id])
        ->where(['class_schedule.school_id' => auth()->user()->school_id])
        ->get();

        $exam_term = DB::table('meritlist')
        ->join('exam', 'exam.id', '=', 'meritlist.exam')
        ->join('classes', 'classes.id', '=', 'exam.class_id')
        ->join('batches', 'batches.id', '=', 'meritlist.batch')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'classes.class_code')
        ->join('semesters', 'semesters.id', '=', 'class_schedule.semester_id')
        ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
        ->select('meritlist.roll_no','exam.type','batches.batch', 'meritlist.class', 'semesters.semester_name',
        'meritlist.exam', 'classes.class_name','classes.class_code','meritlist.id as result_id','class_schedule.semester_id')
        ->where(['class_schedule.teacher_id' =>  $teacher_id])
        ->where(['class_schedule.class_id' =>  $class_id])
        ->where(['meritlist.school_id' => auth()->user()->school_id])
        ->first();

        // dd($isGenerated);

        return view('teachers.results.result', compact('isGenerated','class_assign','class_assign1','exam_term'));
    }

	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/

    public function TeacherStudentdListResult(Request $request)
	{
		$rules=[
			'class' => 'required',
			'section' => 'required',
			'exam' => 'required',
			'session' => 'required'

		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
            $formdata = new formfoo5;
			$formdata->class=$request->get('class');
			$formdata->department_id=$request->get('section');
			$formdata->exam=$request->get('exam');
            $formdata->batch=$request->get('session');

			if($request->get('regiNo_f')!='' && $request->get('section_f')!='' && $request->get('class_f')!=''){
				return Redirect::to('/gradesheet?class='.$request->get('class_f').'&section='.$request->get('section_f').'&regiNo='.$request->get('regiNo_f'))->withErrors($validator);
			}
			Flash::error($validator);
			return Redirect::to('/gradesheet');
		}
		else {
         // echo "<pre>";print_r($request->all());
          //exit;
			if($request->get('send_sms')=='yes'){
				$send = $this->send_sms($request->get('class'),$request->get('section'),$request->get('exam'),$request->get('session'));
			   // echo "<pre>";print_r($send);
			    //exit;
            }

            if(is_array($request->get('exam'))){
                $exams_ids =implode(',',$request->get('exam')) ;
               $ispubl  = DB::table('MeritList')
               ->select('roll_no','exam')
               ->where('class','=',$request->get('class'))
               ->where('batch','=',trim($request->get('session')))
               ->where('department_id','=',trim($request->get('section')))
               ->whereIn('exam',$request->get('exam'))
               ->orderBy('created_at','desc')
               ->groupBy('roll_no')
               ->get();
           }else{
               $exams_ids='';
               $ispubl  = DB::table('MeritList')
               ->select('roll_no','exam')
               ->where('class','=',$request->get('class'))
               ->where('batch','=',trim($request->get('session')))
               ->where('exam','=',$request->get('exam'))
               ->where('department_id','=',trim($request->get('section')))

               ->get();
           }

			if(count($ispubl)>0) {

				$classes = Classes::pluck('class_name', 'class_code');
				$students = DB::table('admissions')
				->join('rolls', 'rolls.roll_id', '=', 'admissions.id')
				->join('marks', 'marks.roll_no', '=', 'rolls.username')
				->join('departments', 'departments.department_id', '=', 'admissions.department_id')
                ->select(DB::raw('DISTINCT(rolls.username)'), 'rolls.username as roll_no', 'admissions.first_name','admissions.image',
                'admissions.last_name', 'departments.department_name', 'marks.shift', 'marks.class')
				->where('admissions.status', '=', 1)
				->where('admissions.class_code', '=', $request->get('class'))
				//->where('Marks.class', '=', $request->get('class'))
				->where('admissions.department_id', '=', $request->get('section'))
				->where('admissions.batch_id', '=', trim($request->get('session')))
				->where('marks.exam', '=', $request->get('exam'));
				if($request->get('regiNo_f')!='' && $request->get('section_f')!='' && $request->get('class_f')!=''){
					$students =$students->where('rolls.username',$request->get('regiNo_f'));
				}

				$students =$students->get();

				$formdata = new formfoo5;
				$formdata->class = $request->get('class');
				$formdata->department_id = $request->get('section');
				$formdata->batch = $request->get('session');
				if(is_array($request->get('exam'))){
					$formdata->exam = $request->get('exam')[0];
			    }else{
			    	$formdata->exam = $request->get('exam');
			    }
				$formdata->type = $request->get('type');
				$formdata->postclass = $request->get('class');
				// $formdata->postclass = array($classes, $request->get('class'));

				//return View::Make('app.gradeSheet', compact('classes', 'formdata', 'students'));
				 if(Storage::disk('local')->exists('/public/grad_system.txt')){
			          $contant = Storage::get('/public/grad_system.txt');
			          $data = explode('<br>',$contant );

						//echo "<pre>";print_r($data);
						$gradsystem = $data[0];
					}else{
				      $gradsystem ='';
					}
					$type = $request->get('type');

                  // exit;

					$regiNo = $request->get('regiNo_f');
				return View('result.gradeSheet', compact('classes', 'formdata', 'students','gradsystem','type','exams_ids','regiNo'));
			}
			else
			{

				if($request->get('regiNo_f')!='' && $request->get('section_f')!='' && $request->get('class_f')!=''){
					return Redirect::to('/gradesheet?class='.$request->get('class_f').'&section='.$request->get('section_f').'&regiNo='.$request->get('regiNo_f'))->withInput()->with("noresult", "Results Not Published Yet!");
				}
				return Redirect::to('/gradesheet')->withInput()->with("noresult", "Results Not Published Yet!");
			}

			// 	if($request->get('regiNo_f')!='' && $request->get('section_f')!='' && $request->get('class_f')!=''){
			// 		// Flash::error('Results Not Published Yet!');
			// 		return Redirect::to('/gradesheet?class='.$request->get('class_f').'&section='.$request->get('section_f').'&regiNo='.$request->get('regiNo_f'));
			// 	}
			// 	Flash::error("Results Not Published Yet!");
			// 	return Redirect::to('/gradesheet');
			// }


		}
	}




    /**
     * Show the form for creating a new Teacher.
     *
     * @return Response
     */
    public function create()
    {

        if (auth()->user()->group == 'Owner') {

            $teachers = Teacher::where('school_id', auth()->user()->school->id)->get();
            $teacher_id = Teacher::where('school_id', auth()->user()->school->id)->max('teacher_id'); // this roll id will be auto genarated username and password for each stuent okay
            $roll_id = Roll::max('roll_id'); // this roll id will be auto genarated username and password for each stuent okay
            $faculties = Faculty::where('school_id', auth()->user()->school->id)->get(); // we fetch all faculty
            $departments = Department::where('school_id', auth()->user()->school->id)->get(); // we fetch all departments
            $batches = Batch::where('school_id', auth()->user()->school->id)->get(); // we fetch all departments
            $levels = Level::where('school_id', auth()->user()->school->id)->get(); // we fetch all departments
            $classes = Classes::where('school_id', auth()->user()->school->id)->get(); // we fetch all classes
            $Semester = Semester::where('status', "on")->where('school_id', auth()->user()->school->id)->get();
            $timetable=array();

            $TeacherTimeTable =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
            ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
            ->where('class_schedule.teacher_id', $teacher_id)
            ->where('teachers.school_id', auth()->user()->school->id)
            ->get();
                $institute = Institute::where('school_id', auth()->user()->school->id)->max('institute_number');

                // $insti = Institute::max( $institute);
                // dd( $institute);
            if(count($teachers)!=0){
                $rand_username_password = mt_rand($institute .$teacher_id +1, $institute .$teacher_id +1);
            }elseif(count($teachers)==0){
                $rand_username_password = mt_rand($institute .$teacher_id , $institute .$teacher_id );
            }
        }else {
            $teachers = Teacher::all();
            $teacher_id = Teacher::max('teacher_id'); // this roll id will be auto genarated username and password for each stuent okay
            $roll_id = Roll::max('roll_id'); // this roll id will be auto genarated username and password for each stuent okay
            $faculties = Faculty::all(); // we fetch all faculty
            $departments = Department::all(); // we fetch all departments
            $batches = Batch::all(); // we fetch all departments
            $levels = Level::all(); // we fetch all departments
            $classes = Classes::all(); // we fetch all classes
            $Semester = Semester::where('status', "on")->get(); // we fetch all Semester
    
            $enable_grade = Semester::where('status', "on")->get();

            $TeacherTimeTable =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
            ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
            ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
            ->where('class_schedule.teacher_id', $teacher_id)
            ->get();
        
            if(count($teachers)!=0){
                $rand_username_password = mt_rand(222609300011 .$teacher_id +1, 222609300011 .$teacher_id +1);
            }elseif(count($teachers)==0){
                $rand_username_password = mt_rand(2226093000111 .$teacher_id , 2226093000111 .$teacher_id );
            }
        }
        // dd($TeacherTimeTable); die;
        return view('teachers.create',compact('teacher_id','faculties','TeacherTimeTable','Semester','timetable','classes','subjects','batches'))
            ->with('teachers', $teachers)->with('rand_username_password',$rand_username_password); 
    }

    /**
     * Store a newly created Teacher in storage.
     *
     * @param CreateTeacherRequest $request
     *
     * @return Response
     */
    public function store(CreateTeacherRequest $request)
    {
        $input = $request->all();

            $image =  $request->file('image'); // this request is requesting image file okay.

            $image_name = rand(1111,9999) . '.' . $image->getClientOriginalExtension();
            //  this part is the part that our image name will be like. we use the rand function
            // to generate random numbers for each of our images that we store okay
            $image->move(public_path('teacher_images'), $image_name);
            //  this move function is a function that will move our imgae to the public folder
            // and create folder class (teacher_images) and store all our images inside that folder.

            $teacher = new Teacher; // Teacher is the modal of the Teacher where we have all the fillbale attributes.
            $teacher->roll_no = $request->roll_no;
            $teacher->first_name = $request->first_name;
            $teacher->last_name = $request->last_name;
            $teacher->gender = $request->gender;
            $teacher->email = $request->email;
            $teacher->dob = $request->dob;
            $teacher->faculty_id = $request->faculty_id;
            $teacher->department_id = $request->department_id;
            $teacher->phone = $request->phone;
            $teacher->address = $request->address;
            $teacher->nationality = $request->nationality;
            $teacher->passport = $request->passport;
            $teacher->marital_status = $request->marital_status;
            $teacher->status = $request->status;
            $teacher->dateregistered = $request->dateregistered;
            $teacher->user_id = $request->user_id;
            $teacher->school_id = auth()->user()->school_id;
            $teacher->image = $image_name; // is the new name of the image okay.

                // dd($teacher);
            $teacher->save(); // this save function will save our data inside the database.

            if($teacher){
                // $teacher_id = Teacher::where('teacher_id',$teacher->id)->first();
                // dd($teacher->teacher_id);
                User::create(['teacher_id' => $teacher->teacher_id,
                'name' => $request->first_name.' '.$request->last_name,
                'password' => Hash::make($request->roll_no),
                'role_id' => 2,
                'created_at' => $request->dateregistered,
                'email' =>$request->email]);
            }

        // $teacher = $this->teacherRepository->create($input);
        // echo"<pre>"; print_r($input);die;
        Flash::success('Teacher saved successfully!.');

        return redirect(route('teachers.index'));
    }

    public function UpdateTeacherStatus(Request $request)
    {
            $teachers = Teacher::findOrFail($request->teacher_id);
            $teachers->status = $request->status;
            $teachers->save();

        return response()->json(['message' => 'Teacher Status updated Successfully.']);
    }

    /**
     * Display the specified Teacher.
     *
     * @param int $id
     *
     * @return Response
     */

    public function home()
    {
        $id = Auth::user()->teacher_id;
        $teacher = $this->teacherRepository->find($id); 

        $students_in_charge_total = ClassSchedule::join('admissions', 'admissions.class_code', '=', 'class_schedule.course_id')
        ->join('batches', 'batches.id','=', 'class_schedule.batch_id')->count();

                    $teachertimetables =  ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
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

            ->where('class_schedule.teacher_id', $id)
            ->orderBy('teachers.teacher_id', 'ASC')
            ->get();

    $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                 ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                 ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                 ->where('class_schedule.teacher_id', $id)
                                 ->first();


                                 $current_month_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->count();

                                 $last_month_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->count();
                                 
                                 $month_before_last_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->count();

                                 dd($month_before_last_attendance);
                                 
        return view('teachers.teacher_dashboard', compact('class_name','students_in_charge_total','current_month_attendance','last_month_attendance','month_before_last_attendance'))->with('teacher', $teacher)
        ->with('teachertimetables', $teachertimetables);

    }

    public function show(Request $request ,$id)
    {
        $teacher = $this->teacherRepository->find($id);
        $enable_grade = Semester::where('status', "on")->get();
            // dd($teacher); die;
        if (empty($teacher)) {
            Flash::error('Teacher not found');

            return redirect(route('teachers.index'));
        }

        // $classAssign = ClassAssigning::join('class_schedule','class_schedule.id',
        //             '=', 'class_assignings.class_schedule_id')
        //             ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
        //             ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
        //             ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
        //             ->join('classes', 'classes.id','=', 'class_schedule.class_id')
        //             ->join('days', 'days.day_id','=', 'class_schedule.day_id')
        //             ->join('degrees', 'degrees.degree_id','=', 'class_schedule.degree_id')
        //             ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
        //             ->join('shifts', 'shifts.shift_id','=', 'class_schedule.shift_id')
        //             ->join('times', 'times.time_id','=', 'class_schedule.time_id')
        //             ->join('class_rooms', 'class_rooms.classroom_id','=', 'class_schedule.classroom_id')
        //             // ->join('admissions', 'admissions.id','=', 'admissions.class_id')
        //             ->where('class_assignings.teacher_id','=', $id )
        //             ->orderBy('teachers.teacher_id')->get();

                    // $classes = DB::table('timetables')->join('class_assignings','class_assignings.class_assign_id', 'timetables.class_assign_id')
                    // ->join('class_schedule','class_schedule.id', 'class_assignings.class_schedule_id')
                    // ->join('classes', 'classes.id','=', 'class_schedule.class_id')
                    // ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                    // ->join('admissions', 'admissions.id','=', 'timetables.student_id')
                    // ->join('departments','departments.department_id', 'admissions.department_id')
                    // ->join('faculties','faculties.faculty_id', 'admissions.faculty_id')
                    // ->join('batches', 'batches.id','=', 'class_schedule.batch_id')
                    // ->join('teachers', 'teachers.teacher_id', '=', 'class_assignings.teacher_id')
                    // // ->join('batches','batches.id', 'admissions.batch_id')
                    // ->where('timetables.class_assign_id', '=',  $id)
                    // // ->where(function ($query) {
                    // //     $query->where('votes', '>', 100)
                    // ->orWhere('class_assignings.teacher_id','=', $id)
                    // // })
                    // ->get();

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
                    ->where('class_schedule.teacher_id', $id)
                    ->orderBy('teachers.teacher_id', 'ASC')
                    ->select('class_schedule.id as schedule_id', 'class_schedule.*','courses.*','batches.*','classes.*',
                    'days.*','levels.*','semesters.*','shifts.*','times.*','faculties.*','departments.*','class_rooms.*')
                    ->get();
                    // dd($teachertimetables);
                    $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                 ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                                 ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                                 ->where('class_schedule.teacher_id', $id)
                                 ->first();

                    $schedule_teacher = ClassSchedule::where('teacher_id',$teacher->teacher_id )->GET();
                    // dd($schedule_teacher);
        return view('teachers.show', compact('class_name'))->with('teacher', $teacher)
        ->with('teachertimetables', $teachertimetables)->with('enable_grade', $enable_grade)
        ->with('schedule_teacher', $schedule_teacher);
    }

    /**
     * Show the form for editing the specified Teacher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $teacher = $this->teacherRepository->find($id);

        if (empty($teacher)) {
            Flash::error('Teacher not found');

            return redirect(route('teachers.index'));
        }



        return view('teachers.edit')->with('teacher', $teacher);
    }

    /**
     * Update the specified Teacher in storage.
     *
     * @param int $id
     * @param UpdateTeacherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeacherRequest $request)
    {
        // $teacher = $this->teacherRepository->find($id);


            $image_name = $request->hidden_image;
            $image =  $request->file('image'); // this request is requesting image file okay.
            if($image != '')
            {
                $input = $request->all();

            $image_name = rand(1111,9999) . '.' . $image->getClientOriginalExtension();
            //  this part is the part that our image name will be like. we use the rand function
            // to generate random numbers for each of our images that we store okay
            $image->move(public_path('teacher_images'), $image_name);
            //  this move function is a function that will move our imgae to the public folder
            // and create folder class (teacher_images) and store all our images inside that folder.

        }
        else{
            $input = $request->all();
        }
            $teacher = array( // Teacher is the modal of the Teacher where we have all the fillbale attributes.
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
           'email' => $request->email,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'address' => $request->address,
           'nationality' => $request->nationality,
            'passport' => $request->passport,
            'status' => $request->status,
            'dateregistered' => $request->dateregistered,
            'user_id' => $request->user_id,
            'image' => $image_name // is the new name of the image okay.
        );

        if (empty($teacher)) {
            Flash::error('Teacher not found');

            return redirect(route('teachers.index'));
        }
            // dd($teacher);
        // $teacher = $this->teacherRepository->update($request->all(), $id);
       Teacher::findOrfail($id)->update($teacher);

        Flash::success('Teacher updated successfully.');

        return redirect(route('teachers.index'));
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
        $teacher = Teacher::findOrFail($request->teacher_id);
        $teacher->status = $request->status;
        $teacher->save();

        return response()->json(['message' => 'Teacher status updated successfully.']);
    }


    /**
     * Remove the specified Teacher from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $teacher = $this->teacherRepository->find($id);

        if (empty($teacher)) {
            Flash::error('Teacher not found');

            return redirect(route('teachers.index'));
        }

        $this->teacherRepository->delete($id);

        Flash::success('Teacher deleted successfully.');

        return redirect(route('teachers.index'));
    }

		// TeacherS PDF CODE

        public function PDFgenerator()
        {
         $teachers = Teacher::all();

        //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
        // VERY SIMPLE TO IMPLIMENT
             // instantiate and use the dompdf class
             // $dompdf->();
             // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
             $dompdf = PDF::loadview('teachers.pdf',['teachers'=> $teachers]);
             // (Optional) Setup the paper size and orientation
             $dompdf->setPaper('A4', 'landscape');

             // Output the generated PDF to Browser
             $dompdf->stream();

             return $dompdf->download('All-Teachers.pdf');
        }

        // Teacher Excel part

  public function ExportExcel_xlsx(){

        return Excel::download(new Teacher_Export, 'Teachers.xlsx' );
    }
 public function ExportExcel_xls(){

        return Excel::download(new Teacher_Export, 'Teachers.xls' );
    }
 public function ExportExcel_csv(){

        return Excel::download(new Teacher_Export, 'Teachers.csv' );
    }

    public function ExcelImport(Request $request)
    {
        $data = $request->all();
        // we need to validate our file okay
        $this->validate($request, [
                'file'=> 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
                // dd( $file); die;
        $file_name = rand() .$file->getClientOriginalName();
        $file->move('Teachers_Excel_Folder', $file_name);// we will move the file inside a folder okay in our public follder

        Excel::import(new TeacherImport, public_path('/Teachers_Excel_Folder/' .$file_name));

        Flash::success('Teachers Saved Successfully.');

        return redirect(route('teachers.index'));

    }

    public function PrintTeacher($id){

        $teachers = Teacher::where('teacher_id',$id)->get();

        return view('teachers.print',compact('teachers'));
    }

    public function PrintAllTeacher(){

        $teachers = Teacher::all();

        return view('teachers.print_all',compact('teachers'));
    }

    public function PrintTeacherAssignSubjects(Request $request, $id){
        // $teachers = ClassSchedule::where('teacher_id', $id)->get();
        $teachers = ClassSchedule::join('courses', 'courses.id', '=', 'class_schedule.course_id')
                                 ->join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                                 ->join('semesters', 'semesters.id', '=', 'class_schedule.semester_id')
                                 ->where('class_schedule.teacher_id', $id)->get();
                                //  dd($teachers);
        return view('teachers.print_assign_subjects',compact('teachers'));
    }

   public function PDFTeacher_Single($id)
    {
        $teachers = DB::table('teachers')->where('teacher_id', $id)->get();
        // dd( $teachers); die;
            $dompdf = PDF::loadview('teachers.single_pdf',['teachers'=> $teachers]);
            // (Optional) Setup the paper size and orientation
            // $dompdf->setPaper('A4', 'landscape');

            // Output the generated PDF to Browser
            $dompdf->stream();

            return $dompdf->download('Teacher.pdf');
    }



	public function index_timetable()
	{
	$classes = Classes::all();
	// ->select(DB::raw('classes.*'))
	// ->get();

	// $sections  = DB::table('section')
	// ->select(DB::raw('section.*'))
	// ->get();

	$subjects  = Course::all();
	// ->select(DB::raw('courses.*'))
	// ->get();

	$teachers = Teacher::all();
	// ->select(DB::raw('teachers.*'))
	// ->get();
	//dd($teachers);
	$timetable=array();
	return View("teachers.timetable.teacher_timetable",compact("classes","teachers","subjects","timetable"));

    }


//     public function InsertClassAttendance(Request $request)
//     {

//         $student = $request->all();
//         // echo "<pre>",print_r($student); die;

//         $atten_date = $request->attendance_date;
//         $atten_class = $request->class_id;
//         $teacher_id = $request->teacher_id;

//         $attendance_date = Attendance::join('classes', 'classes.class_code','=', 'attendances.class_id')
//                                       ->where('attendances.attendance_date',$atten_date)
//                                       ->where('attendances.teacher_id',$teacher_id)
//                                       ->where('attendances.class_id',$atten_class)->first();
//             if ( $attendance_date) {

//                 Flash::error('Sorry , Today Attendance Already Taken, by this ' . $atten_date. ' and Class!');
//                 return redirect()->back();
//             }else{

//                 foreach ($request->student_id as $key => $markattendance) {

//                     $insert_data[]=[
//                         'student_id' => $markattendance,
//                         'teacher_id' => $request->teacher_id,
//                         'course_id' => $request->course_id,
//                         'semester_id' => $request->semester_id,
//                         'class_id' => $request->class_id,
//                         'month' => $request->month,
//                         'year' => $request->year,
//                         'day' => $request->day,
//                         'attendance_status' => $request->attendance_status[$markattendance],
//                         'attendance_date' => $request->attendance_date
//                     ];
//                 }

//                 Attendance::insert($insert_data);
//                 Flash::success('Attendance Marked Successfully!');
//                 return redirect(url('attendance/list',$teacher_id));
//             }
//         }

//     public function TeacherEditAttendance(Request $request, $edit_date,$class_id,$semester_id,$teacher_id)
//     {
//        $teacher_id = $request->teacher_id;
//         $input = $request->all();
// // dd($input); die;

//         $edited_date = Attendance::join('classes', 'classes.class_code', '=', 'attendances.class_id')
//                                     ->join('semesters', 'semesters.id', '=', 'attendances.semester_id')
//                                     ->where('attendance_date',$edit_date)
//                                     ->where('class_id', $class_id)
//                                     ->where('semester_id', $semester_id)
//                                     ->first();
//             // dd($edited_date); die;
//         $edit_attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
//         ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
//         ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
//         ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
//         ->join('semesters', 'semesters.id', '=', 'attendances.semester_id')
//         ->join('courses', 'courses.id', '=', 'attendances.course_id')
//         ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
//          ->select(
//               'admissions.first_name as student_first_name',
//               'admissions.last_name as student_last_name',
//               'admissions.image',
//               'teachers.first_name as teacher_first_name',
//               'teachers.last_name as teacher_last_name',
//               'rolls.username as roll_no',
//               'courses.course_name',
//               'semesters.semester_name',
//               'semesters.id as semester_id',
//               'attendances.attendance_date',
//               'attendances.attendance_status',
//               'attendances.attendance_id',
//               'attendances.semester_id',
//               'attendances.class_id',
//               'classes.id as class_id',
//               'classes.class_code',
//               'classes.class_name')
//             ->where('attendances.attendance_date', $edit_date)
//             ->where('attendances.class_id', $class_id)
//             ->where('attendances.semester_id', $semester_id)
//             ->get();

//             // dd($edit_attendances);

//             $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
//                 ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
//                 ->join('degrees', 'degrees.degree_id','=', 'class_schedule.semester_id')
//                 ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
//                 ->where('class_schedule.teacher_id', $teacher_id)
//                 ->first();
//                 // dd($class_name);
//         return view('teachers.attendances.edit',compact('class_name'))
//         ->with('edit_attendances',$edit_attendances)
//         ->with('edited_date',$edited_date);
//     }

    // public function TeacherUpdateAttendance(Request $request)
    // {
    //     $student = $request->all();
    //     $teacher_id = $request->get('teacher_id');
    //     // echo "<pre>",print_r($student); die;
    //     $attendance_date = $request->get('attendance_date');


    //             foreach ($request->attendance_id as $key => $id) {

    //                 $update_data=[
    //                     'attendance_status' => $request->attendance_status[$id],
    //                     'edit_date' => $request->attendance_date
    //                 ];
    //                 // echo "<pre>",print_r($update_data); die;
    //                 $attendance = Attendance::where(['attendance_id' =>$id, 'attendance_date' => $request->attendance_date])->first();
    //                 $attendance->update($update_data);
    //             }

    //             Flash::success('Attendance Updated Successfully!');
    //             // return redirect(route('teachers.attendances.attendanceList'));
    //             return redirect()->back();
    //         // }
    // }

    // public function AttendanceList(Request $request, $teacher_id)
    // {
    //         $class_id = $request->class_id;
    //         $course_id = $request->course_id;
    //         $semester_id = $request->semester_id;
    //         $department_id = $request->department_id;
    //         $teacher_id = $request->teacher_id;
    //         $attend_date = date('d-m-Y');

    //     $attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
    //                ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
    //                ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
    //                ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
    //                ->join('semesters', 'semesters.id', '=', 'attendances.semester_id')
    //                ->join('courses', 'courses.id', '=', 'attendances.course_id')
    //                ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
    //                 ->select(
    //                      'admissions.first_name as student_first_name',
    //                      'admissions.last_name as student_last_name',
    //                      'admissions.image',
    //                      'teachers.first_name as teacher_first_name',
    //                      'teachers.last_name as teacher_last_name',
    //                      'rolls.username as roll_no',
    //                      'courses.course_name',
    //                      'semesters.semester_name',
    //                      'semesters.id as semester_id',
    //                      'classes.id as class_id',
    //                      'classes.class_code as class_code',
    //                      'attendances.attendance_date',
    //                      'attendances.attendance_status',
    //                      'classes.class_name')
    //             ->where('attendances.attendance_date', $attend_date)
    //             ->where('attendances.teacher_id', $teacher_id)
    //             ->get();

    //             // dd( $attendances); die;

    //             $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
    //             ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
    //             ->join('degrees', 'degrees.degree_id','=', 'class_schedule.semester_id')
    //             ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
    //             ->where('class_schedule.teacher_id', $teacher_id)
    //             ->first();
    //             // dd( $class_name); die;
    //     $classes = ClassSchedule::join('classes', 'classes.class_code','=', 'class_schedule.class_id')
    //                        ->where('class_schedule.teacher_id', $teacher_id)
    //                     //   ->where('class_schedule.course_id', $teacher_id)
    //                     //    ->groupBy('classes.id')
    //                        ->orderBy('classes.id', 'ASC')
    //                        ->get();

    //     $departments = ClassSchedule::join('departments', 'departments.department_id','=', 'class_schedule.department_id')
    //                        ->where('class_schedule.teacher_id', $teacher_id)
    //                       // ->where('class_schedule.course_id', $teacher_id)
    //                        //->groupBy('classes.id')
    //                        ->orderBy('departments.department_id', 'ASC')
    //                        ->get();

    //     $faculties = ClassSchedule::join('faculties', 'faculties.faculty_id','=', 'class_schedule.faculty_id')
    //                        ->where('class_schedule.teacher_id', $teacher_id)
    //                       // ->where('class_schedule.course_id', $teacher_id)
    //                        //->groupBy('classes.id')
    //                        ->orderBy('faculties.faculty_id', 'ASC')
    //                        ->get();

    //     $semesters = ClassSchedule::join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
    //                                ->join('degrees', 'degrees.degree_id','=', 'class_schedule.semester_id')
    //                        ->where('class_schedule.teacher_id', $teacher_id)
    //                         //->where('class_schedule.course_id', $class_name->teacher_id)
    //                        ->groupBy('semesters.id')
    //                        ->orderBy('semesters.id', 'ASC')
    //                        ->get();

    //     $courses = ClassSchedule::join('courses', 'courses.id','=', 'class_schedule.course_id')
    //                        ->join('degrees', 'degrees.degree_id','=', 'class_schedule.semester_id')
    //                ->where('class_schedule.teacher_id', $teacher_id)->orderBy('courses.id', 'ASC')
    //                ->get();

    //             return view('teachers.attendances.attendanceList',
    //         compact('classes','semesters','courses','departments','faculties','class_name'))
    //         ->with('attendances', $attendances);
    // }



























//l<!-- HERE WE WILL CREATE FUNCTIONS FOR OUR ROUTE OKAY   -->

public function InsertClassAttendance(Request $request) // here is the insert function of the attendance okay.
{

    $student = $request->all();
    // echo "<pre>",print_r($student); die;

    $atten_date = $request->attendance_date;
    $atten_class = $request->class_id;
    $teacher_id = $request->teacher_id;

    // here we check if the todays attendance is mark or not if its mark then we return error message else we mark

    $attendance_date = Attendance::join('classes', 'classes.class_code','=', 'attendances.class_id')
                                  ->where('attendances.attendance_date',$atten_date)
                                  ->where('attendances.teacher_id',$teacher_id)
                                  ->where('attendances.class_id',$atten_class)->first();
        if ( $attendance_date) {

            Flash::error('Sorry , Today Attendance Already Taken, by this ' . $atten_date. ' and Class!');
            return redirect()->back();
        }else{

            foreach ($request->student_id as $key => $markattendance) {

                $insert_data[]=[
                    'student_id' => $markattendance,
                    'teacher_id' => $request->teacher_id,
                    'course_id' => $request->course_id,
                    'semester_id' => $request->semester_id,
                    'class_id' => $request->class_id,
                    'month' => $request->month,
                    'year' => $request->year,
                    'day' => $request->day,
                    'school_id' => $request->school_id,
                    'attendance_status' => $request->attendance_status[$markattendance],
                    'attendance_date' => $request->attendance_date
                ];
            }

            Attendance::insert($insert_data);
            Flash::success('Attendance Marked Successfully!');
            return redirect(url('attendance/list'));
        }
    }


    public function TeacherEditAttendance(Request $request, $edit_date,$class_id,$semester_id,$teacher_id)
    {

        $edited_date = Attendance::join('classes', 'classes.class_code', '=', 'attendances.class_id')
                                    ->join('semesters', 'semesters.id', '=', 'attendances.semester_id')
                                    ->where('attendance_date',$edit_date)
                                    ->where('class_id', $class_id)
                                    ->where('semester_id', $semester_id)
                                    ->where('teacher_id', $teacher_id) // it's an optional where clouse okay
                                    ->first();
            // dd($edited_date); die;
        $edit_attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
        ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
        ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
        ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
        ->join('semesters', 'semesters.id', '=', 'attendances.semester_id')
        ->join('courses', 'courses.id', '=', 'attendances.course_id')
        ->join('rolls', 'rolls.roll_id', '=', 'attendances.student_id')
         ->select(
              'admissions.first_name as student_first_name',
              'admissions.last_name as student_last_name',
              'admissions.image',
              'teachers.first_name as teacher_first_name',
              'teachers.last_name as teacher_last_name',
              'rolls.username as roll_no',
              'courses.course_name',
              'semesters.semester_name',
              'semesters.id as semester_id',
              'attendances.attendance_date',
              'attendances.attendance_status',
              'attendances.attendance_id',
              'attendances.semester_id',
              'attendances.attendance_reason',
              'attendances.class_id',
              'classes.id as class_id',
              'classes.class_code',
              'classes.class_name')
            ->where('attendances.attendance_date', $edit_date)
            ->where('attendances.class_id', $class_id)
            ->where('attendances.semester_id', $semester_id)
            ->where('teachers.teacher_id', $teacher_id)
            ->get();

            // dd($edit_attendances);

            $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                ->join('degrees', 'degrees.degree_id','=', 'class_schedule.semester_id')
                ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                ->where('class_schedule.teacher_id', $teacher_id)
                ->first();
                // dd($class_name);
        return view('teachers.attendances.edit',compact('class_name'))
        ->with('edit_attendances',$edit_attendances)
        ->with('edited_date',$edited_date);
    }

    // this function is done let's move to attendance list function okay.

    public function AttendanceList(Request $request) // be careful here is is kinda tricky okay t
    {
            $class_id = $request->class_id;
            $course_id = $request->course_id;
            $semester_id = $request->semester_id;
            $department_id = $request->department_id;
            $teacher_id = $request->teacher_id;
            $attend_date = date('Y-m-d');

            $today_attendance = Attendance::where('teacher_id', Auth::user()->teacher_id)
                                ->where('attendance_date', $attend_date)
                                ->get();
  

            $teacher_id = Auth::user()->teacher_id;


            // $today_attendance = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
            // ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
            // ->where('attendances.teacher_id', $teacher_id)
            // ->where('admissions.class_code',$class_id)
            // ->where('attendances.teacher_id', $teacher_id)
            // ->where('attendances.attendance_date', $attend_date)
            // ->count();

            // dd($today_attendance);

        $attendances = Attendance::join('admissions', 'admissions.id', '=', 'attendances.student_id')
                   ->join('classes', 'classes.class_code', '=', 'attendances.class_id')
                   ->join('class_schedule', 'class_schedule.class_id', '=', 'admissions.class_code')
                   ->join('teachers', 'teachers.teacher_id', '=', 'attendances.teacher_id')
                   ->join('semesters', 'semesters.id', '=', 'attendances.semester_id')
                   ->join('courses', 'courses.id', '=', 'attendances.course_id')
                   ->join('rolls', 'rolls.student_id', '=', 'attendances.student_id')
                    ->select(
                         'admissions.first_name as student_first_name',
                         'admissions.last_name as student_last_name',
                         'admissions.image',
                         'teachers.first_name as teacher_first_name',
                         'teachers.last_name as teacher_last_name',
                         'teachers.teacher_id as teacher_id',
                         'rolls.username as roll_no',
                         'courses.course_name',
                         'semesters.semester_name',
                         'semesters.id as semester_id',
                         'classes.id as class_id',
                         'classes.class_code as class_code',
                         'attendances.attendance_date',
                         'attendances.attendance_reason',
                         'attendances.attendance_status',
                         'classes.class_name')
                // ->where('attendances.attendance_date', $attend_date)
                ->where('attendances.teacher_id', $teacher_id)
                ->orderBy('attendances.attendance_date', 'desc')
                ->get();

                // dd( $attendances); die;

                $class_name =  ClassSchedule::join('classes', 'classes.class_code', '=', 'class_schedule.class_id')
                ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                ->join('levels', 'levels.id','=', 'class_schedule.semester_id')
                ->join('teachers', 'teachers.teacher_id','=', 'class_schedule.teacher_id')
                ->where('class_schedule.teacher_id', $teacher_id)
                ->first();
                // dd( $class_name); die;
        $classes = ClassSchedule::join('classes', 'classes.class_code','=', 'class_schedule.class_id')
                                ->join('semesters', 'semesters.id','=', 'class_schedule.semester_id')
                           ->where('class_schedule.teacher_id', $teacher_id) 
                        //   ->where('class_schedule.course_id', $teacher_id)
                        //    ->groupBy('classes.id')
                           ->orderBy('classes.id', 'ASC')
                           ->get();

                   $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
                   ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
                   ->join('class_schedule', 'class_schedule.id', '=', 'admissions.class_code')
                   ->join('courses', 'courses.id', '=', 'class_schedule.course_id')
                   ->join('teachers', 'teachers.teacher_id', '=', 'class_schedule.teacher_id')
                   ->where('admissions.class_code',$class_id)
                    ->select('admissions.first_name as student_firstname',
                            'admissions.last_name as student_lastname',
                            'admissions.id as student_id',
                            'rolls.username as roll_no',
                            'teachers.first_name  as teacher_firstname',
                           'teachers.last_name  as teacher_lastname',
                            'teachers.teacher_id',
                            'classes.class_name',
                            'classes.class_code',
                            'classes.id as class_id',
                            'courses.id as course_id',
                           'courses.course_name')
                   //->where('admissions.class',$class_id)
                   ->get();

                   

                return view('teachers.attendances.attendanceList',
            compact('classes','class_name', 'students','today_attendance'))
            ->with('attendances', $attendances);
    }


    public function TeacherUpdateAttendance(Request $request)
    {
        $student = $request->get('attendance_date'); //they are not assign with any query okay
        $teacher_id = $request->get('teacher_id');//they are not assign with any query okay
        // echo "<pre>",print_r($student); die;
        // $attendance_date = $request->get('attendance_date');//they are not assign with any query okay


                foreach ($request->attendance_id as $key => $id) {

                    $update_data=[
                        'attendance_status' => $request->attendance_status[$id],
                        'attendance_reason' => $request->attendance_reason[$id],
                        'edit_date' => $request->attendance_date
                    ];

                    // $attendance = Attendance::where(['attendance_id' =>$id, 'attendance_date'
                    //  => $request->attendance_date])->get();
                    $attendance = Attendance::where(['attendance_id' => $id])->first();
                    //  echo "<pre>",print_r($attendance); die;

                    $attendance->update($update_data);
                    // HomeWork::findOrFail($id)->update($update_homework);
                }

                Flash::success('Attendance Updated Successfully!');
                // return redirect(route('teachers.attendances.attendanceList'));
                return redirect(url('attendance/list'));
            // }
    }

    // now our functions are ready

    //  now we will work on the route part okay.

    //  let's go to our route.



    public function deleteTeacherAll(Request $request)
    {
        $promote_ids = $request->promote_ids;
        DB::table("teachers")->whereIn('id',explode(",",$promote_ids))->delete();
        return response()->json(['success'=>"Registered Teachers Deleted successfully."]);
    }
    











}
