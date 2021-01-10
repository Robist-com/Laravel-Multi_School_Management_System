<?php

use App\Exam;
use App\Models\Course;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Input;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redirect;
    use App\Models\Classes;
    use App\Models\Course;
    use App\Models\Department;
    use App\Question;
    use App\Exam;
    use App\QuestionTemp;
    use App\Models\Courses;
    use Carbon\Carbon;
    use DB;
    use Flash;
    use Validator;
    Class formfoo1{

    }

    class ExamQuestionPaperGenerateController extends Controller
    {

        public function index()
        {
            $classes = Classes::where('school_id', auth()->user()->school_id)->get();
            $departments = Department::where('school_id', auth()->user()->school_id)->get();

            $exams = DB::table('exam')
            ->join('classes', 'exam.class_id', '=', 'classes.class_code')
            ->join('departments', 'exam.department_id', '=', 'departments.department_id')
            ->select('exam.id','exam.type','exam.e_date','exam.session', 'classes.class_name as class', 'departments.department_name as department')
            ->get();
            $exam = array();
            $classes = DB::table('classes')->where('school_id', auth()->user()->school_id)->get();
            $department = DB::table('departments')->where('school_id', auth()->user()->school_id)->get();
            // dd($exams);
            return view('exam_management.index', compact('department','exam','exams','departments'))
            ->with("classes",  $classes);
        }

        public function examCreate()
        {
            $classes = Classes::where('school_id', auth()->user()->school_id)->get();

            // $classes = DB::table('Class')->get();
            // $sections = DB::table('section')->get();

           return View('exam_management.examCreate',compact('classes'));

            // return view('exam_management.index')->with("classes",  $classes);;

        }



        /**
        * Show the form for creating a new quiz event.
        *
        * @return \Illuminate\Http\Response
        */
        public function create(){
            $classes = Classes::where('school_id', auth()->user()->school_id)->get();

            /*$query =DB::table('Student1')
            ->join('Class','Student.class','=','Class.name')
            ->join('section','Student.section','=','section.name')
            ->join('feesSetup','Student.class','=','feesSetup.class')
            ->select('Student.*','Class.name as class','section.name as section','feesSetup.fee')
            ->where('Student.family_id','23232')
            ->get();*/
            return view('exam_management.question', compact('classes'))->with("classes",  $classes);
        }

        public function show(Type $var = null)
        {
          return view('');
        }

        /**
        * Store a newly created quiz event in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
        public function store(Request $request)
        {
            dd($request->all());

            $rules=[

                'q_name' => 'required',
                'class_id' => 'required',
                'question.*' => 'required',
                'session' => 'required',
                'chapter' => 'required',
                'level' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                Flash::error('Question Not Created Check your Fields!.');

                return redirect()->back();
            }
            else {
                $quiz_name  = $request->input('q_name');
                $class_code = $request->input('class_id');

                $questions  = $request->input('question'); //Question
                $types      = $request->input('qt'); //Question types

                $i    = $request->input('i'); //Correct answer for identification
                $mc   = $request->input('mc'); //Choices for multiple choice
                $c_mc = $request->input('c-mc'); //Correct choice
                $tf   = $request->input('tf'); //Correct answer for true or false
                $p    = $request->input('points'); //Question point

               /* Questionnaire::create([
                    'questionnaire_name' => $quiz_name,
                ]);*/

                //$q_id = Questionnaire::count(); //Questionnaire id.

                for($x = 0; $x < count($questions); $x++){
                    $question = $questions[$x];
                    $choices = ""; //For multiple choice use.
                    $answer = null; //Obviously.
                    $points = $p[$x];

                    if($types[$x] == 0){
                        //ERROR
                    }else if ($types[$x] == 1){//Identification
                        $answer = $i[$x];
                    }else if($types[$x] == 2){//Multiple choice
                        $choices = $mc[$x][0] . ";" . $mc[$x][1] . ";" . $mc[$x][2] . ";" . $mc[$x][3];
                        $answer = $c_mc[$x];
                    }else if($types[$x] == 3){//True or False
                        $answer = $tf[$x];
                    }

                    if(trim($question) == "" || is_null($question))
                        continue;
                         //echo $question;
                             //print_r(Question::all());exit;
                    Question::create([
                       // 'questionnaire_id'  => $q_id,
                        'quize_name'     => $quiz_name,
                        'question_name'     => $question,
                        'session'           => $request->input('session'),
                        'class_code'        => $request->input('class_id'),
                        'course_id'        => $request->input('course_id'),
                        'chapter'           => $request->input('chapter'),
                        'level'             => $request->input('level'),
                        'question_type'     => $types[$x],
                        'choices'           => $choices,
                        'answer'            => $answer,
                        'points'            => $points
                    ]);
                   // exit;
                }

                Flash::success('Question Paper Created Succesfully!.');

                return redirect()->back();
            }
        }


        public function generate()
        {
            $formdata = new formfoo1;
            $formdata->class="";
            $formdata->section="00";
            $formdata->shift="";
            $formdata->exam="";
            $formdata->session="";
            $formdata->type="";
            $classes = Classes::all();
            $students =array();
            return view('exam_management.generatepaper',compact('classes','formdata','students'));
        }

        public function post_generate(Request $request)
        {
            $getmcqs = Question::where('class_code',$request->class)
                                ->where('course_id',$request->course_id)
                                ->whereIn('chapter',$request->chapter)
                                ->where('session',$request->session)
                                ->where('question_type',2)
                                ->whereIn('level',$request->level)
                                ->orderByRaw('RAND()')
                                ->take($request->mcqs)
                                ->get();
            $getshorts = Question::where('class_code',$request->class)
                                ->where('course_id',$request->course_id)
                                ->whereIn('chapter',$request->chapter)
                                ->where('session',$request->session)
                                ->where('question_type',3)
                                ->whereIn('level',$request->level)
                                ->orderByRaw('RAND()')
                                ->take($request->short)
                                ->get();
            $getlongs = Question::where('class_code',$request->class)
                        ->where('course_id',$request->course_id)
                        ->whereIn('chapter',$request->chapter)
                        ->where('session',$request->session)
                        ->where('question_type',1)
                        ->whereIn('level',$request->level)
                        ->orderByRaw('RAND()')
                        ->take($request->long)
                        //->inRandomOrder()
                        ->get();
            //INSERT INTO connection2.table (SELECT * from connection1.table);
            QuestionTemp::truncate();
            //echo "<pre>";print_r($getmcqs->toArray());
            if($getmcqs){
                foreach ($getmcqs->toArray() as $item)
                {
                   unset($item['id']);
                    $item['created_at'] = Carbon::now();
                    $item['updated_at'] = Carbon::now();
                    //echo "<pre>";print_r($item);
                    QuestionTemp::insert($item);
                }
            }
            if($getshorts){
                foreach ($getshorts->toArray() as $item)
                {
                   unset($item['id']);
                    $item['created_at'] = Carbon::now();
                    $item['updated_at'] = Carbon::now();
                    //echo "<pre>";print_r($item);
                    QuestionTemp::insert($item);
                }
            }
            if($getlongs){
                foreach ($getlongs->toArray() as $item)
                {
                   unset($item['id']);
                    $item['created_at'] = Carbon::now();
                    $item['updated_at'] = Carbon::now();
                    //echo "<pre>";print_r($item);
                    QuestionTemp::insert($item);
                }
            }
            $gmcqs = array();
            //echo $request->print;
            for($i=0;$i<$request->print;$i++){

                $tempararymcq   = QuestionTemp::where('question_type',2)->orderByRaw('RAND()')->get();
                $tempararylong  = QuestionTemp::where('question_type',1)->get();
                $tempararyshort = QuestionTemp::where('question_type',3)->get();
                //echo $i;
                //echo "===============================================================================================";
                //$gmcqs[$i];
                foreach ($tempararymcq as $items){

                    $gmcqs[$i][] = $items;
                }
                foreach ($tempararylong as $items){

                    $gmcqs[$i][] = $items;
                }
                foreach ($tempararyshort as $items){

                    $gmcqs[$i][] = $items;
                }
                //echo "===============================================================================================";
            }
            if(empty($gmcqs)){
                return Redirect::back()->withInput()->with("error", "No questions found");
            }
            //echo "<pre>".count($gmcqs);exit;
            return view('exam_management.printpaper',compact('gmcqs'));
            //echo "<pre>";print_r(array_rand($getmcqs->toArray()));
            //foreach()
        }

        public function list()
        {
            $formdata = new formfoo1;
            $formdata->class="";
            $formdata->section="00";
            $formdata->shift="";
            $formdata->exam="";
            $formdata->session="";
            $formdata->type="";
            $classes = Classes::all();
            $questions =array();
            return view('exam_management.paperlist',compact('formdata','classes','questions'));
        }
        public function getlist(Request $request)
        {
            $formdata = new formfoo1;
            $formdata->class="";
            $formdata->section="00";
            $formdata->shift="";
            $formdata->exam="";
            $formdata->session="";
            $formdata->type="";
            $classes = Classes::all();

            // $Question = Question::all();
            // dd($Question); die;
            //$students =array();

            $questions = Question::join('courses', 'courses.id','=','questions.course_id')
                                ->select('questions.*','questions.id as question_id','courses.course_name')
                                ->where('class_code',$request->class)
                                ->where('course_id',$request->course_id)
                                ->whereIn('chapter',$request->chapter)
                                ->where('session',$request->session)
                                // ->where('question_type',2)
                                ->whereIn('level',$request->level)
                                ->orderBy('question_type','ASC')
                                //->take($request->mcqs)
                                ->get();

                                // dd( $questions);
            return view('exam_management.paperlist',compact('formdata','classes','questions'));
        }

        public function edit($id)
        {
            $formdata = new formfoo1;
            $formdata->class="";
            $formdata->section="00";
            $formdata->shift="";
            $formdata->exam="";
            $formdata->session="";
            $formdata->type="";
            $classes = Classes::all();

            $questions = Question::where('id',$id)->first();
            $course_ids = Course::where('class',$questions->class_code)->get();
            // dd($questions);
            return view('exam_management.questionedit',compact('formdata','classes','questions','course_ids'));
        }

        public function update(Request $request)
        {


            $quiz_name = $request->input('q_name');
            $class_code = $request->input('class_id');

            $questions = $request->input('question'); //Question
            $types = $request->input('qt'); //Question types

            $i = $request->input('i'); //Correct answer for identification
            $mc = $request->input('mc'); //Choices for multiple choice
            $c_mc = $request->input('c-mc'); //Correct choice
            $tf = $request->input('tf'); //Correct answer for true or false

            $p = $request->input('points'); //Question point

           /* Questionnaire::create([
                'questionnaire_name' => $quiz_name,
            ]);*/

            //$q_id = Questionnaire::count(); //Questionnaire id.

            for($x = 0; $x < count($questions); $x++){
                $question = $questions[$x];
                $choices = ""; //For multiple choice use.
                $answer = null; //Obviously.
                $points = $p[$x];

                if($types[$x] == 0){
                    //ERROR
                }else if ($types[$x] == 1){//Identification
                    $answer = $i[$x];
                }else if($types[$x] == 2){//Multiple choice
                    $choices = $mc[$x][0] . ";" . $mc[$x][1] . ";" . $mc[$x][2] . ";" . $mc[$x][3];
                    $answer = $c_mc[$x];
                }else if($types[$x] == 3){//True or False
                    $answer = $tf[$x];
                }

                if(trim($question) == "" || is_null($question))
                    continue;
    //echo $question;
    //print_r(Question::all());exit;
                Question::where('id', $request->id)->update([
                   // 'questionnaire_id'  => $q_id,
                    'quize_name'     => $quiz_name,
                    'question_name'     => $question,
                    'session'           => $request->input('session'),
                    'class_code'        => $request->input('class_id'),
                    'course_id'        => $request->input('course_id'),
                    'chapter'           => $request->input('chapter'),
                    'level'             => $request->input('level'),
                    'question_type'     => $types[$x],
                    'choices'           => $choices,
                    'answer'            => $answer,
                    'points'            => $points
                ]);
                //$question = Question::find($request->id);
               // exit;
            }

            /*QuizEvent::create([
                'quiz_event_name' => $quiz_name,
                'questionnaire_id' => $q_id,
                'class_id' => $class_code,
                'quiz_event_status' => 0,
            ]);*/

            return Redirect::to('/question/list')->with("success","Question Updated Succesfully.");
        }

        public function delete($id)
        {
            $del =  Question::where('id', $id)->delete();
            return Redirect::to('/question/list')->with("success","Question Deleted Succesfully.");

        }

        public function chapters(Request $request,$class){
                      $getmcqs = Question::where('class_code',$request->class)
                                ->where('course_id',$request->course_id)
                                // ->groupBy('id','chapter','')
                                ->get();

                                // dd( $getmcqs);
            return $getmcqs;
        }


        public function getexams(Request $request, $class)
        {
             $class_id = DB::table('classes')->select("*")->where('class_code','=',$class)->first();

             $class_data = Exam::select('id','type')
             ->where('class_id','=',$class_id->id);
             if($request->get('section')!=''){
                 $class_data = $class_data->where('department_id','=',$request->get('section'));
             }
             $class_data =$class_data->get();
        return $class_data;
        }


        public function InsertExam(Request $request)
	{
        // dd($request->all());

		$rules=[
			'type' => 'required',
			'class' => 'required',
			'department_id' => 'required'

		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			//return Redirect::to('/exam/create')->withErrors($validator);
			return Redirect()->back();
		}
		else {
			$type = $request->get('type');

			 $departments = DB::table('departments')->select("*")->where('department_id','=',$request->get('department_id'))->first();



			$isexists=Exam::select('*')->where('type','=',$type)->where('department_id','=',$departments->department_id)->where('class_id','=',$request->get('class'))->get();
			if(count($isexists)>0){

				Flash::error('Exam for this departments and class are already exists!! please try another department and class!');
				return redirect()->back();
			}
			else {
				// echo "<pre>";print_r($request->get('section'));exit;
				foreach($request->get('class') as $class)
				{
					$exam = new Exam;
					$exam->type = $request->get('type');
					$exam->e_date = $request->get('e_date');
					$exam->session = $request->get('session');
					$exam->class_id = $class;
					$exam->school_id = auth()->user()->school_id;
					$exam->department_id =  $departments->department_id;
					$exam->save();
			    }
				//return Redirect::to('/exam/create')->with("success", "Exam Created Succesfully.");
				Flash::success('Exam Created Succesfully!');
				return redirect()->back();
			}

		}

	}



    }

