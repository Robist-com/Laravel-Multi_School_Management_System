<?php
namespace App\Http\Controllers;
use DB;
use App\GPA;
use Storage;
use App\Roll;
use App\Marks;
use App\Subject;
use App\MeritList;
use App\Ictcore_fees;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Courses;
use App\Models\Admission;
use App\Models\Attendance;
use Laracasts\Flash\Flash;
use App\Ictcore_integration;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\$request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ictcoreController;
Class formfoo5{

}
Class Meritdata{

}
class gradesheetController extends Controller {
 public $data = array();
	public function __construct() {
		/*$this->beforeFilter('csrf', array('on'=>'post'));
        

		$this->beforeFilter('auth',array('except' => array('searchpub','postsearchpub','printsheet')));*/
			   $this->middleware('auth',array('except' => array('searchpub','postsearchpub','printsheet')));
			  
	}
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index(Request $request)
	{
		$formdata = new formfoo5;
		$formdata->class="";
		$formdata->department_id="00";
		$formdata->shift="";
		$formdata->exam="";
		$formdata->batch="";
		$formdata->type="";
		$students=array();
		$classes = Classes::pluck('class_name','class_code');
        // echo "<pre>";print_r($students);exit;
         if(Storage::disk('local')->exists('/public/grad_system.txt')){
			          $contant = Storage::get('/public/grad_system.txt');
			          $data = explode('<br>',$contant );

						// echo "<pre>";print_r($data);
						$gradsystem = $data[0];
					}else{
				      $gradsystem ='';
					}
		//return View::Make('result.gradeSheet',compact('classes','formdata','students'));
		if($request->get('class')!='' && $request->get('section')!=''){
		$formdata->class   = $request->get('class');
		$formdata->department_id = $request->get('section');
		}
        $regiNo  = $request->get('regiNo');
        // echo "<pre>";print_r($regiNo);exit;
		return View('result.index',compact('classes','formdata','students','gradsystem','regiNo'));
	}


    public function home(Request $request)
	{
		$formdata = new formfoo5;
		$formdata->class="";
		$formdata->department_id="00";
		$formdata->shift="";
		$formdata->exam="";
		$formdata->batch="";
		$formdata->type="";
		$students=array();
		$classes = Classes::pluck('class_name','class_code');
        // echo "<pre>";print_r($students);exit;
         if(Storage::disk('local')->exists('/public/grad_system.txt')){
			          $contant = Storage::get('/public/grad_system.txt');
			          $data = explode('<br>',$contant );

						// echo "<pre>";print_r($data);
						$gradsystem = $data[0];
					}else{
				      $gradsystem ='';
					}
		//return View::Make('result.gradeSheet',compact('classes','formdata','students'));
		if($request->get('class')!='' && $request->get('section')!=''){
		$formdata->class   = $request->get('class');
		$formdata->department_id = $request->get('section');
		}
        $regiNo  = $request->get('regiNo');
        // echo "<pre>";print_r($regiNo);exit;
		return View('result.gradeSheet',compact('classes','formdata','students','gradsystem','regiNo'));
	}


	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/

    public function studentdlistresult(Request $request)
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
				->where('admissions.acceptance', '=', 'accept')
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
** Send result sms
**/

public function send_sms($class,$section,$exam,$session)
{

	//echo "heelo";
//echo $section;
        $examed    = DB::table('exam')->where('id',$exam)->first();
		$exam_name =  $examed->type;

          $students = DB::table('Student')
                      ->where('Student.isActive', '=', 'Yes')
				      ->where('Student.class', '=', $class)
				      ->where('Student.section', '=', $section)
				      ->where('Student.session', '=', $session)
				      ->get();
				      $rr  = array();
				    foreach($students as $student){
				    	//echo $student->regiNo;
				      	$marks = DB::table('Marks')
				      			->join('Subject', 'Marks.subject', '=', 'Subject.id')
				      			->select('Marks.section','Marks.exam','Marks.regiNo','Marks.shift', 'Marks.class', 'Marks.section','Marks.obtain_marks','Marks.total_marks','Subject.name as subject_name')
				      			//->where('Marks.class',   '=', $class)
								->where('Subject.class', '=', $class)
								//->where('Marks.section', '=', $section)
								->where('Marks.session', '=', $session)
								->where('Marks.exam',    '=', $exam)
								->where('Marks.regiNo',  '=', $student->regiNo)
								->get();
								//echo "<pre>";print_r($marks);

								$save_data = array();
								foreach($marks as $mark){
									$save_data[] =array('total'=>$mark->total_marks,'obtain'=>$mark->obtain_marks,'subject'=>$mark->subject_name);
								    //$rr[] = $save_data;
								}

								$test  = $this->send_noti($save_data,$student->fatherCellNo,$student->firstName.''.$student->lastName );

				      }

	}

	public function send_noti($data=array(),$phone,$name){
          $this->data = $data;
          //return $this->data;

        $subject = '';
        $message1 = '';
        $message2 = '';
        $message3 = '';

		if(!empty($data)){
         $message = 'your child [name]';
         $sub     = " subject [sub]";
         $obtain  = ' obtains marks [obt]';
         $total   = ' out of  [total] marks';
			 $message = str_replace("[name]",$name,$message);

			for($i=0;$i<count($data);$i++){

				 //$message1 .= str_replace("[sub]",$data[$i]['subject'],$message);
				 $message1 .= ' subject '.$data[$i]['subject'].' obtatain marks:'.$data[$i]['obtain'].' out of:' .$data[$i]['total'] ."\n";
				 //$message2 .= str_replace("[obt]",$data[$i]['obtain'],$message1);
				 //$message3 .= str_replace("[total]",$data[$i]['total'],$message2);
				 //$subject2 .= str_replace("[number]",$dta['obtain'],$subject1);
				 //$subject3 .= str_replace("[total]",$dta['total'],$subject2);
			}
			$body = $message."\n". $message1  ;
			//return  $body  ;
			//exit;
			$ict     = new ictcoreController();
			$i       =0;
			$attendance_noti     = DB::table('notification_type')->where('notification','fess')->first();
			$ictcore_fees        = Ictcore_fees::select("*")->first();
			$ictcore_integration = Ictcore_integration::select("*")->where('type','sms');
			//echo $ictcore_integration->method;
			//exit;
			if($ictcore_integration->count()>0){
				$ictcore_integration = $ictcore_integration->first();
			}else{
				//return Redirect::to('fee_detail?action=unpaid')->withErrors("Sms credential not found");
				return 404;
			}
				//$group_id = $ict->telenor_apis('group','','','','','');
				$contacts = array();
				$contacts1 = array();
				$i=0;


			if (preg_match("~^0\d+$~", $phone)) {
					$to = preg_replace('/0/', '92', $phone, 1);
				}else {
					$to =$phone;
				}
				//$contacts1[] = $to;
				if(strlen(trim($to))==12){
					$contacts = $to;
					//$i++;
				}
				//$comseprated= implode(',',$contacts);
				//$group_contact_id = $ict->telenor_apis('add_contact',$group_id,$contacts,'','','');
		}else{
			return 403;
		}
			/*$col_msg = DB::table('message')->first();
			if(empty($col_msg)){
				$msg = $body ;
	      	}else{
	      		$body
	      	}*/
	      	$msg = $body ;
			/*if($fee_msg->count()>0 && $fee_msg->first()->description!=''){
				$msg = $fee_msg->first()->description;
			}else{
				$msg = "please submit your child  fee for this month";
			}*/
			if($ictcore_integration->method!='ictcore'){
				$snd_msg  = $ict->verification_number_telenor_sms($to,$msg,'SidraSchool',$ictcore_integration->ictcore_user,$ictcore_integration->ictcore_password,'sms');
			}else{

			    $send_msg_ictcore = sendmesssageictcore($name,'',$to,$msg,'result');

			}
			//$campaign      = $ict->telenor_apis('campaign_create',$group_id,'',$msg,'','sms');
			//$send_campaign = $ict->telenor_apis('send_msg','','','','',$campaign);
			//session()->forget('upaid');
			return 200;
	}

	public  function gradeCalculator($point,$gparules)
	{
		$grade=0;
		foreach ($gparules as $gpa) {
			if ($point >= $gpa->grade){
				$grade=$gpa->gpa;
				break;
			}
		}
		return $grade;
	}
	public  function pointCalculator($marks,$gparules)
	{

		$point=0;
		foreach ($gparules as $gpa) {


			if ($marks >= $gpa->markfrom){
				$point=$gpa->grade;
				break;
			}
		}

		return $point;
	}
	public  function gpaCalculator($marks,$gparules)
	{
		$gpacal= array();
      //dd($marks);
		foreach ($gparules as $gpa) {

			if ($marks >= $gpa->markfrom){
				$gpacal[0]=$gpa->grade;
				$gpacal[1]=$gpa->gpa;
				break;
			}
		}
		return $gpacal;
	}
	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/

	public function printsheet($regiNo,$exam,$class)
	{
        $examed  = DB::table('exam')->where('id',$exam)->first();
		$exam_name =  $examed->type;
		$student =	DB::table('admissions')
		->join('classes', 'admissions.class_code', '=', 'classes.class_code')
		 ->join('departments','admissions.department_id','=','departments.department_id')
		 ->join('faculties','faculties.faculty_id','=','departments.faculty_id')
		 ->join('batches','batches.id','=','admissions.batch_id')
		 ->join('semesters','semesters.id','=','admissions.semester_id')
		 ->join('rolls','rolls.student_id','=','admissions.id')
		 ->select('admissions.id as student_id', 'admissions.image','admissions.dateregistered','admissions.dob','faculties.faculty_name',
		'admissions.first_name','admissions.last_name','admissions.father_name','departments.department_name',
		 'admissions.mother_name', 'admissions.class_code as classcode','rolls.username as roll_no','batches.batch',
		 'classes.class_name as class','admissions.department_id','admissions.batch_id','admissions.faculty_id',
		'semesters.*')
		 ->where('rolls.username','=',$regiNo)
		 ->where('admissions.class_code','=',$class)
		 ->where('admissions.acceptance', '=', 'accept');
		//  ->first();
    //    echo "<pre>";print_r($student->first());exit;
		if($student->count()>0) {
           $student = $student->first();
           $department = $student->department_id;

			$merit = DB::table('MeritList')
			->select('id','roll_no', 'grade', 'point', 'totalNo','department_id')
			->where('exam', $exam)
			->where('class', $class)
			->where('batch', trim($student->batch_id))
			->where('department_id', trim($department))
			//->where('regiNo',$regiNo)
			//->orderBy('point', 'DESC')
			//->orderBy('point')
			->orderBy('totalNo', 'DESC')
			->get();
			//->orderBy('totalNo', 'DESC')->get();
			//echo "<pre>";print_r($merit);exit;
			if (empty($student)  || empty($merit)) {
				return Redirect::back()->with('noresult', 'Result Not Found!');
			} else {
				$meritdata = new Meritdata();
				$position  = 0;
				foreach ($merit as $m) {
					$position++;
					//$test[] = $m->section_id .'==='. $section."909".$m->regiNo .'=== '.$regiNo;

					if($m->roll_no === $regiNo && $m->department_id == $department) {
						$meritdata->id = $m->id;
						$meritdata->roll_no = $m->roll_no;
						$meritdata->point = $m->point;
						$meritdata->grade = $m->grade;
						$meritdata->position = $position;
						$meritdata->totalNo = $m->totalNo;
						break;
					}
				}
				//echo $m->section_id .'==='. $section."909".$m->regiNo .'=== '.$regiNo;
					//  echo "<pre>";print_r($meritdata);
					//  exit;

              //print_r($meritdata);
             // exit;
				//sub group need to implement
				$subjects = Course::select('course_name', 'course_code', 'totalfull')
				->where('class', '=', $student->classcode)->get();
				// echo "<pre>";print_r($subjects->toArray() );exit;
				$overallSubject = array();
				$subcollection = array();
				
				// dd($subcollection );

				$banglatotal = 0;
				$banglatotalhighest = 0;
				$urdu = 0;
				$banglaArray = array();
				$blextra = array();

				$englishtotal = 0;
				$englishtotalhighest = 0;
				$english_total = 0;
				$englishArray = array();
				$enextra = array();

				$totalHighest = 0;
				$totalourall = 0;
				$isBanglaFail=false;
                $isEnglishFail=false;

				$coursecode = Course::join('class_schedule','class_schedule.course_id','=', 'courses.id')
				->join('batches','batches.id','=', 'class_schedule.batch_id')
				->select('course_code')
				->where('batches.is_current_batch', 1)
				->where('class_schedule.school_id', 4)->first();
                            //  print_r($coursecode); exit;
				foreach ($subjects as $subject) {
					$submarks = Marks::select('written', 'mcq', 'practical', 'ca', 'total', 'point', 'grade')->where('roll_no', '=', $student->roll_no)
					->where('subject', '=', $subject->course_code)->where('exam', '=', $exam)->where('class', '=', $class)->first();
					$maxMarks = Marks::select(DB::raw('max(total) as highest'))->where('class', '=', $class)->where('department', '=', $student->department_id)
					->where('subject', '=', $subject->course_code)->where('exam', '=', $exam)->first();

					$submarks["highest"] = $maxMarks->highest;
					$submarks["subcode"] = $subject->course_code;

					$submarks["subname"] = $subject->course_name;
					$submarks["outof"] = $subject->totalfull;


					if ($this->getSubGroup($subjects, $subject->course_code) === $coursecode) {

						if($submarks->grade=="F")
						{
							$isBanglaFail=true;
						}

						$banglatotal += $submarks->total;
						$banglatotalhighest += $submarks->highest;
                         $urdu += $subject->totalfull;
						$bangla = array($submarks->subcode, $submarks->subname, $submarks->written, $submarks->mcq, $submarks->ca, $submarks->practical,$subject->totalfull);
                        array_push($banglaArray, $bangla);
                        
                        // dd($new); die;

					} else if ($this->getSubGroup($subjects, $subject->course_code) === $coursecode) {
						if($submarks->grade==="F")
						{
							$isEnglishFail=true;
						}
						$englishtotal += $submarks->total;
						$englishtotalhighest += $submarks->highest;
                        $english_total += $subject->totalfull;
						$english = array($submarks->subcode, $submarks->subname, $submarks->written, $submarks->mcq, $submarks->ca, $submarks->practical,$subject->totalfull);
                        array_push($englishArray, $english);
                        
					} else {
						$totalHighest += $maxMarks->highest;
						$totalourall +=$subject->totalfull;
						array_push($subcollection, $submarks);
					}
                    $outof[] = $subject->totalfull;
                    
                   
                }
                

				$gparules = GPA::select('gpa', 'grade', 'markfrom')->get();
				$subgrpbl = false;

				if ($banglatotal > 0) {

					$blt = floor($banglatotal / 2);
					$totalHighest += $banglatotalhighest;
					$totalourall +=$urdu;
					$gcal = $this->gpaCalculator($blt, $gparules);

					$subgrpbl = true;
					array_push($blextra, $banglatotal);
					//array_push($blextra, $banglatotalhighest);
					array_push($blextra, $urdu);
                //    echo $gcal[1].'uuu'; die;
					if($isBanglaFail)
					{
						array_push($blextra, "0.00");
						array_push($blextra, "F");
					}
					else {
						array_push($blextra, $gcal[0]);
						array_push($blextra, $gcal[1]);
					}
				}
				$subgrpen = false;
				if ($englishtotal > 0) {
					$ent = floor($englishtotal / 2);
					$totalHighest += $englishtotalhighest;
					$totalourall += $english_total;
					$gcal = $this->gpaCalculator($ent, $gparules);
					$subgrpen = true;
					array_push($enextra, $englishtotal);
					//array_push($enextra, $englishtotalhighest);
					array_push($enextra, $english_total);

					// echo $ent.'uuu'.print_r($gcal,true);
					// exit;
					if($isEnglishFail)
					{
						array_push($enextra, "0.00");
						array_push($enextra, "F");

					}
					else {
						array_push($enextra, $gcal[0]);
						array_push($enextra, $gcal[1]);

					}
				}
					
                // echo "<pre>";print_r(array_push($enextra, $gcal[0])); die;
                // echo "<pre>f";print_r($subcollection);
            //    exit;
				$extra = array($exam_name, $subgrpbl, $totalHighest, $subgrpen,$totalourall);
				$query="select left(MONTHNAME(STR_TO_DATE(m, '%m')),3) as month, count(student_id) AS present from ( select 01 as m union all select 02 union all select 03 union all select 04 union all select 05 union all select 06 union all select 07 union all select 08 union all select 09 union all select 10 union all select 11 union all select 12 ) as months LEFT OUTER JOIN attendances ON MONTH(attendances.attendance_date)=m and attendances.student_id ='".$regiNo."' and  attendances.attendance_status IN ('Present','present','late','Late') GROUP BY m";
				$attendance=DB::select(DB::RAW($query));
				// echo "<pre>";print_r($attendance);exit;
				// exit;

				$attendaces = Attendance::where('student_id', $student->student_id)->get();
				$attendaces1 = Attendance::where('student_id', $student->student_id)
				->where('attendance_status', 'present')->get()->count();
				$attendaces2 = Attendance::where('student_id', $student->student_id)
				->where('attendance_status', 'absent')->get()->count();

				$classcount = Admission::where('class_code', $student->classcode)->count();

// echo "<pre>";print_r($classcount);exit;
				return View('result.stdgradesheet', compact('student', 'classcount','attendaces', 'attendaces1', 'attendaces2','extra', 'meritdata', 'subcollection', 'blextra', 'banglaArray', 'enextra', 'englishArray','attendance'));

			}
		}
		else
		{
			//echo "<h1 style='text-align: center;color: red'>Result Not Found</h1>";
			return  Redirect::back()->with('noresult','Result Not Found!');

		}
	}


	public  function  getgenerate()
	{
		$classes = Classes::pluck('class_name','class_code');
		// $batches = Batch::pluck('id','batch');
			//return View::Make('result.resultgenerate',compact('classes'));
		  if(Storage::disk('local')->exists('/public/grad_system.txt')){
			          $contant = Storage::get('/public/grad_system.txt');
			          $data = explode('<br>',$contant );

						echo "<pre>";print_r($data);
						$gradsystem = $data[0];
					}else{
				      $gradsystem ='';
					}

		 $formdata = new formfoo5;
		$formdata->class="";
		$formdata->section="";
		$formdata->shift="";
		$formdata->exam="";
		$formdata->session="";
		$formdata->type="";
		
		return View('result.resultgenerate',compact('classes','gradsystem','formdata'));
	}

	public  function getSubGroup($subjects,$subject)
	{
		$group="";
		foreach($subjects as $sub)
		{
			if($sub->course_code===$subject)
			{
				$group=$sub->department;
				break;
			}
		}

		// dd($group);
		return $group;

	}
	public  function getSubjectTotalno($subjects,$subject)
	{
		$total="";
		foreach($subjects as $sub)
		{
			if($sub->course_code===$subject)
			{
				$total=$sub->totalfull;
				break;
			}
		}
		return $total;
	}
	public  function  postgenerate(Request $request )
	{
        // dd($request->all()); die;
		$rules = [
			'class' => 'required',
			'exam' => 'required',
			//'section' => 'required',
			'session' => 'required'
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('/result/generate')->withErrors($validator);
		} else {
            $isGenerated=DB::table('MeritList')
			->select('roll_no')
			->where('class', '=', $request->get('class'))
			->where('batch', '=', trim($request->get('session')))
			->where('exam', '=', $request->get('exam'))
			->where('department_id', '=', $request->get('section'))
			->get();
			if(count($isGenerated)==0)
			{
				 $subjects            = Course::select('course_name', 'course_code','department')
										->where('class', '=', $request->get('class'))->where('school_id', auth()->user()->school_id)->get();

				 $sectionsHas         = Admission::select('department_id')->where('class_code', '=', $request->get('class'))
										->where('department_id', '=', $request->get('section'))->where('batch_id', trim($request->get('session')))
										->where('acceptance', '=', 'accept')->distinct()->orderBy('department_id', 'asc')->get();

				 $sectionMarksSubmit  = Marks::select('department')->where('class', '=', $request->get('class'))
										->where('department', '=', $request->get('section'))->where('session', trim($request->get('session')))
										->where('exam',$request->get('exam'))->distinct()->get();

                // dd($sectionsHas, $sectionMarksSubmit);
				if (count($sectionsHas)==count($sectionMarksSubmit))
				{
					$isAllSubSectionMarkSubmit =false;
					$notSubSection='';
					foreach ($sectionsHas as $section) {
						$marksubmit = Marks::select('subject')->where('class', '=', $request->get('class'))
						->where('department',$section->department_id)
						->where('session', trim($request->get('session')))
						->where('exam',$request->get('exam'))->distinct()->get();

					// 	if(count($subjects) == count($marksubmit))
					// 	{
					// 		$isAllSubSectionMarkSubmit = true;
					// 		continue;
					// 	}
					// 	else{
					// 		$notSubSection=$section->department_id;
					// 		$isAllSubSectionMarkSubmit =false;
					// 		break;
					// 	}
					}

					// dd($isAllSubSectionMarkSubmit);
					if (!$isAllSubSectionMarkSubmit) {
						$fourthsubjectCode = "";
						foreach ($subjects as $subject) {
							if ($subject->type === "Electives") {
								$fourthsubjectCode = $subject->course_code;
							}
                        }

                        $students = Roll::join('admissions','admissions.id','=','rolls.student_id')
                        ->join('departments','departments.department_id','=','admissions.department_id')
                        ->select('admissions.*','departments.department_name','rolls.username as roll_no')
                        ->where('admissions.class_code',    '=', $request->get('class'))
                        ->where('admissions.department_id',  '=', $request->get('section'))
                        ->where('admissions.batch_id',  '=', trim($request->get('session')))
                        ->where('admissions.acceptance', '=', 'accept')
                        ->get();
        //    echo "<pre>";print_r($students->toArray());exit;
            if (count($students) != 0) {
                $marksSubmitStudents= Roll::join('admissions','admissions.id','=','rolls.student_id')
                ->join('marks','marks.roll_no','=','rolls.username')
                ->select('marks.roll_no')
                // ->join('Student', 'Marks.roll_no', '=', 'Student.regiNo')
                ->where('admissions.acceptance', '=', 'accept')
                ->where('admissions.class_code', '=', $request->get('class'))
                ->where('marks.class', '=', $request->get('class'))
                ->where('marks.session', '=', trim($request->get('session')))
                ->where('marks.exam', '=', $request->get('exam'))
                ->distinct()
                ->get();

                if(count($students)==count($marksSubmitStudents))
                {
                    $gparules = GPA::select('gpa', 'grade', 'markfrom')->get();
                    $foobar   = array();
                    foreach ($students as $student) {

                        $marks 			= Marks::select('subject', 'grade', 'point', 'total','Absent')->where('roll_no', '=', $student->roll_no)->where('exam', '=', $request->get('exam'))->get();
                        $totalpoint     = 0;
                        $totalmarks     = 0;
                        $subcounter     = 0;
                        $banglamark     = 0;
                        $englishmark    = 0;
                        $totalexammarks = 0;
                        $isfail 		= false;
									foreach ($marks as $mark) {


										if ($this->getSubGroup($subjects, $mark->subject) === "Bangla") {
											$banglamark += $mark->total;

										} else if ($this->getSubGroup($subjects, $mark->subject) === "English") {
											$englishmark += $mark->total;
										} else {
											if ($mark->subject === $fourthsubjectCode) {
												if ($mark->point >= 2.00) {
													$totalmarks += $mark->total;
													$totalpoint += $mark->point - 2;


												} else {
													$totalmarks += $mark->total;
												}
												$subcounter--;

											} else {
												$totalmarks += $mark->total;
												$totalpoint += $mark->point;

											}

										}


										$subcounter++;

										if ($mark->subject !== $fourthsubjectCode && $mark->grade === "F") {
											$isfail = true;
										}
									}


									if ($banglamark > 0) {
										$blmarks = floor($banglamark / 2);


										$totalmarks += $banglamark;

										$totalpoint += $this->pointCalculator($blmarks, $gparules);

										$subcounter--;

									}


									if ($englishmark > 0) {
										$enmarks = floor($englishmark / 2);
										$totalmarks += $englishmark;
										$totalpoint += $this->pointCalculator($enmarks, $gparules);
										$subcounter--;
									}
									$grandPoint = ($totalpoint / $subcounter);
									if ($isfail) {
										$grandGrade = $this->gradnGradeCal(0.00, $gparules);
									} else {
										$grandGrade = $this->gradnGradeCal($grandPoint, $gparules);
									}
									$merit          = new MeritList;
									$merit->class   = $request->get('class');
									$merit->batch = trim($request->get('session'));
									$merit->exam    = $request->get('exam');
									$merit->roll_no  = $student->roll_no;
									$merit->totalNo = $totalmarks;
									$merit->point   = $grandPoint;
									$merit->grade   = $grandGrade;
									$merit->department_id   = $student->department_id;
                                echo "<pre>";print_r($merit );
									$merit->save();
                                    $test[] = $merit;
								}

								//  echo "<pre>";print_r($test );
								// 	exit;

							}
							else {
                                Flash::error('All students examintaion marks not submited yet!');
								return Redirect::to('/result/home');
							}
						}
						else
						{
                            Flash::error('There is no students in this class!');
							return Redirect::to('/result/home');
                        }
                        Flash::success('Result Generate and Publish Successfull!');
						return Redirect::to('/result/home');
					}
					else
					{
                        Flash::error($notSubSection." all subjects marks not submited yet!!");
						return Redirect::to('/result/home');

					}
				}
				else{
                    Flash::error('All 1 sections marks not submited yet!');
					return Redirect::to('/result/home');
				}
			}
			else{
                Flash::error('Result already generated for this class,session and exam!');
				return Redirect::to('/result/home');
			}
		}
	}

	public function gradnGradeCal($grandPoint)
	{
		return $grandPoint;
		$grade="";
		if($grandPoint>=5.00)
		{
			$grade="A+";
			return $grade;
		}
		$lowarray   = array("0.00","1.00","2.00","3.00","3.50","4.00");
		$higharray  = array("1.00","2.00","3.00","3.50","4.00","5.00");
		$gradearray = array("F","D","C","B","A-","A");

		for($i = 0;$i < count($lowarray);$i++)
		{
			if($grandPoint >= $lowarray[$i] && $grandPoint<$higharray[$i])
			{
				$grade=$gradearray[$i];
			}
		}

		return $grade;
	}

	// SEARCH BY
	public function search(Request $request)
	{
        $regiNo = $request->get('regiNo');
		$formdata = new formfoo5;
		$formdata->class=$request->get('class');
			$formdata->department_id=$request->get('section');
			$formdata->exam=$request->get('exam');
            $formdata->batch=$request->get('session');
		// $students =$request->get('regiNo');
		$classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();
		// dd($classes);
		//return View::Make('result.resultsearch',compact('formdata','classes'));
		return View('result.resultsearch',compact('formdata','classes','students','regiNo'));
    }
    
    public function postsearch(Request $request)
	{
		$rules=[
			'class' => 'required',
			// 'section' => 'required',
			'exam' => 'required',
			'session' => 'required'

		];
		// dd($request->all());
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
            $formdata = new formfoo5;
			$formdata->class=$request->get('class');
			$formdata->department_id=$request->get('section');
			$formdata->exam=$request->get('exam');
            $formdata->batch=$request->get('session');

			if($request->get('regiNo_f')!='' && $request->get('class_f')!='' && $request->get('section_f')!=''){
				Flash::error($validator);
				return Redirect::to('/result/search?class='.$request->get('class_f'). '&department_id='.$request->get('section_f').'&regiNo='.$request->get('regiNo_f'));
			}
			Flash::error($validator);
			return Redirect::to('/result/search');
		}
		else {
        //  echo "<pre>";print_r($request->all());
        //   exit;
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
            //    ->where('department_id','=',trim($request->get('section')))
               ->whereIn('exam',$request->get('exam'))
               ->orderBy('created_at','desc')
               ->groupBy('roll_no')
               ->get();

        //         echo "<pre>";print_r($ispubl);
        //   exit;
           }else{
               $exams_ids='';
               $ispubl  = DB::table('MeritList')
               ->select('roll_no','exam')
               ->where('class','=',$request->get('class'))
               ->where('batch','=',trim($request->get('session')))
               ->where('exam','=',$request->get('exam'))
            //    ->where('department_id','=',trim($request->get('section')))

               ->get();
           }

        //    echo "<pre>";print_r($ispubl);
        //   exit;

			if(count($ispubl)>0) {

				$classes = Classes::pluck('class_name', 'class_code');
				// $students = DB::table('admissions')
				// ->join('rolls', 'rolls.student_id', '=', 'admissions.id')
				// ->join('marks', 'marks.roll_no', '=', 'rolls.username')
				// ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
				// ->join('departments', 'departments.department_id', '=', 'admissions.department_id')
                // ->select(DB::raw('DISTINCT(rolls.username)'), 'rolls.username as roll_no', 'admissions.first_name','admissions.image',
                // 'admissions.last_name', 'departments.department_name', 'marks.shift', 'marks.class','classes.class_code')
				// ->where('admissions.acceptance', '=', 'accept')
				// ->where('marks.roll_no', '=', $request->get('regiNo'));
				// if($request->get('regiNo_f')!=''){
				// 	$students =$students->where('rolls.username',$request->get('regiNo_f'));
				// }
				$all_students_class = Admission::all();

				$students_class = DB::table('admissions')
				->join('rolls', 'rolls.student_id', '=', 'admissions.id')
				->join('marks', 'marks.roll_no', '=', 'rolls.username')
				->join('classes', 'classes.class_code', '=', 'admissions.class_code')
				->join('departments', 'departments.department_id', '=', 'admissions.department_id')
                ->select(DB::raw('DISTINCT(rolls.username)'), 'rolls.username as roll_no', 'admissions.first_name','admissions.image',
                'admissions.last_name', 'departments.department_name', 'marks.shift', 'marks.class','classes.class_code')
				->where('admissions.acceptance', '=', 'accept')
				// ->where('admissions.class_code', '=', $request->get('class'))
				->where('Marks.class', '=', $request->get('class'))
				// ->where('admissions.department_id', '=', $request->get('section'))
				->where('admissions.batch_id', '=', trim($request->get('session')))
				->where('marks.exam', '=', $request->get('exam'));
				// ->where('marks.roll_no', '=', $request->get('regiNo'));
				if($request->get('section_f')!='' && $request->get('class_f')!=''){
					$students_class =$students_class->where('Marks.class',$request->get('class_f'));
				}

                // $students =$students->get();
                $students_class =$students_class->get();
				
				if (count($students_class) == 0) {
					Flash::error('No Result Found for this session... ' .$request->get('session'). ' and '  . $classes->class_name . 'and ' .$request->get('exam'). '');
					return redirect(url('result/search'));
				}
                

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


                //     dd($students); die;
                //   exit;

					$regiNo = $request->get('regiNo_f');
				return View('result.resultsearch', compact('classes', 'formdata', 'all_students_class', 'students','students_class','gradsystem','type','exams_ids','regiNo'));
            }
            
			else
			{

				if($request->get('regiNo_f')!='' && $request->get('section_f')!='' && $request->get('class_f')!=''){
					return Redirect::to('/result/search?class='.$request->get('class_f').'&department_id='.$request->get('section_f').'&regiNo='.$request->get('regiNo_f'))->withInput()->with("noresult", "Results Not Published Yet!");
				}
				return Redirect::to('/result/search')->withInput()->with("noresult", "Results Not Published Yet!");
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


	
public function searchResultRoll_no(Request $request)
{
	// dd($request->all());
	$formdata = new formfoo5;
	$formdata->class=$request->get('class');
	$formdata->department_id=$request->get('section');
	$formdata->exam=$request->get('exam');
	$formdata->batch=$request->get('session');
	$roll_no = $request->get('regiNo');

				$students = DB::table('admissions')
				->join('rolls', 'rolls.student_id', '=', 'admissions.id')
				->join('marks', 'marks.roll_no', '=', 'rolls.username')
				->join('classes', 'classes.class_code', '=', 'admissions.class_code')
				->join('departments', 'departments.department_id', '=', 'admissions.department_id')
                ->select(DB::raw('DISTINCT(rolls.username)'), 'rolls.username as roll_no', 'admissions.first_name','admissions.image',
                'admissions.last_name', 'departments.department_name', 'marks.shift', 'marks.class','classes.class_code', 'classes.class_name')
				->where('admissions.acceptance', '=', 'accept')
				->where('marks.roll_no', '=', $request->get('regiNo'));
				if($roll_no !=''){
					$students =$students->where('rolls.username',$roll_no);
				}

			$students =$students->get();

			$students_class = '';

			$all_students = Admission::all();

			if (count($students) == 0) {
				Flash::error('No Result Found for this roll no... ' . $roll_no . '');
				return redirect(url('result/search'));
			}
				// dd($students);
				// return $students;
				return View('result.resultsearch', compact('classes', 'formdata', 'all_students', 'students','students_class','gradsystem','type','exams_ids','regiNo'));
}


	// SEARCH IN PUBLIC
	public function searchpub()
	{
		$formdata = new formfoo5;
		$formdata->exam="";
		$classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();
		//return View::Make('result.resultsearchpublic',compact('formdata','classes'));
		return View('result.resultsearchpublic',compact('formdata','classes'));
	}

	public function postsearchpub(Request $request)
	{

		$rules=[
		 'exam' => 'required',
		 'regiNo' => 'required',
		 'class' => 'required'
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/results')->withErrors($validator)->with($request->all());
		}
		else {

            $examed    = DB::table('exam')->where('id',$request->get('exam'))->first();
            $exam_name =  $examed->type;
            $student   =	DB::table('admissions')

            ->join('classes', 'classes.class_code', '=', 'admissions.class_code')
            ->join('departments','departments.department_id','=','admissions.department_id')
             ->join('rolls','rolls.student_id','=','admissions.id')
             ->select('admissions.image','admissions.dateregistered','admissions.dob',
                         'admissions.first_name','admissions.last_name','admissions.father_name',
                        'admissions.mother_name',
                        'admissions.class_code as classcode','classes.class_name as class',
                        'admissions.batch_id',
                        'departments.department_name as section_name');

                        if($student->count()>0) {
                            $student = $student->first();
                            $section = $student->section;
                             $merit = DB::table('MeritList')
                             ->select('regiNo', 'grade', 'point', 'totalNo','section_id')
                             ->where('exam', $request->get('exam'))
                             ->where('class', $request->get('class'))
                             ->where('session', trim($student->session))
                             ->where('section_id', trim($section));
                             if($student->count()>0) {
                                $student = $student->first();
                                $section = $student->section;
                                 $merit = DB::table('MeritList')
                                 ->select('regiNo', 'grade', 'point', 'totalNo','section_id')
                                 ->where('exam', $exam)
                                 ->where('class', $class)
                                 ->where('session', trim($student->session))
                                 ->where('section_id', trim($section))
                                 //->where('regiNo',$regiNo)
                                 //->orderBy('point', 'DESC')
                                 //->orderBy('point')
                                 ->orderBy('totalNo', 'DESC')->get();
                                 //->orderBy('totalNo', 'DESC')->get();
                                 //echo "<pre>";print_r($merit);exit;
                                 if (empty($student)  || empty($merit)) {
                                     return Redirect::back()->with('noresult', 'Result Not Found!');
                                 } else {
                                     $meritdata = new Meritdata();
                                     $position  = 0;
                                     //echo "<pre>";print_r($merit->toArray());
                                     foreach ($merit as $m) {
                                         $position++;
                                         //$test[] = $m->section_id .'==='. $section."909".$m->regiNo .'=== '.$regiNo;

                                         if($m->regiNo === $regiNo && $m->section_id == $section) {
                                             $meritdata->regiNo = $m->regiNo;
                                             $meritdata->point = $m->point;
                                             $meritdata->grade = $m->grade;
                                             $meritdata->position = $position;
                                             $meritdata->totalNo = $m->totalNo;
                                             break;
                                         }
                                     }
                                    }
                                }
                            }
            //  ->where('rolls.username','=',$request->get('regiNo'))
            //  ->where('admissions.class_code', '=',$request->get('class'));

             echo "<pre>";print_r($student);exit;
			return Redirect::to('/gradesheet/print/'.$request->get('regiNo').'/'.$request->get('exam').'/'.$request->get('class'));
		}
	}
	public function gradsystem()
	{
	    //return View('result.resultsearchpublic',compact(''));
	}

public function combined_results(Request $request, $type,$regiNo,$exam,$class)
{
	$exams_array = explode(',',$request->get('examps_ids'));
	$result_data = DB::table('Student')
       ->join('Class', 'Student.class', '=', 'Class.code')
       ->join('section','Student.section','=','section.id')
       ->join('Marks','Student.regiNo','=','Marks.regiNo')
       // ->join('Marks','Student.regiNo','=','Marks.regiNo')
       //->join('MeritList','Marks.regiNo','=','MeritList.regiNo')
       ->join('Subject','Marks.subject','=','Subject.code')
       ->join('exam','Marks.exam','=','exam.id')
       ->select('Student.regiNo','Student.rollNo','Student.dob', 'Student.firstName','Student.middleName','Student.lastName','Student.fatherName','Student.motherName', 'Student.group','Student.shift','Student.class as classcode','Class.Name as class','Student.section','Student.session','Student.extraActivity','section.name as section_name','Marks.total','Marks.grade','Marks.point','Marks.total_marks','Marks.obtain_marks',DB::raw('MONTH(Marks.created_at) as month'),/*'MeritList.totalNo','MeritList.grade','MeritList.point',*/'exam.type','exam.id as exam_id','Subject.code as subject_code','Subject.name as subject_name')
       ->where('Marks.class',$class)
       ->where('Subject.class', '=', $class)
       ->where('Marks.regiNo', '=', $regiNo)
       ->whereIn('Marks.exam', $exams_array)
        // ->where('Student.class',$class)
       ->get();
       foreach($result_data as $result){
        $exam_name   = $result->exam_id;
	        //if($result->subject_name=='urdu'){
	          $ary[$result->subject_name][] = array('regiNo'=>$result->regiNo,'rollNo'=>$result->rollNo,'firstName'=>$result->firstName,'fatherName'=>$result->fatherName,'classcode'=>$result->classcode,'class'=>$result->class,'session'=>$result->session,'section_name'=>$result->section_name,'total'=>$result->total,'grade'=>$result->grade,'point'=>$result->point,'total_marks'=>$result->total_marks,'obtain_marks'=>$result->obtain_marks ,'month'=>$result->month,'type'=>$result->type,'subject_code'=>$result->subject_code,'subject_name'=>$result->subject_name);
	          $res[$exam_name][]=$result;
	        //}
       }

       //$extra      = array($exam_name, $subgrpbl, $totalHighest, $subgrpen, $student->extraActivity,$totalourall);
	   $query      = "select left(MONTHNAME(STR_TO_DATE(m, '%m')),3) as month, count(regiNo) AS present from ( select 01 as m union all select 02 union all select 03 union all select 04 union all select 05 union all select 06 union all select 07 union all select 08 union all select 09 union all select 10 union all select 11 union all select 12 ) as months LEFT OUTER JOIN Attendance ON MONTH(Attendance.date)=m and Attendance.regiNo ='".$regiNo."' and  Attendance.status IN ('Present','present','late','Late') GROUP BY m";
	   $attendance = DB::select(DB::RAW($query));
    //echo "<pre>";print_r($ary);
	         return array('result_data'=>$ary,'attendance'=>$attendance);


      //echo "<pre>";print_r($res);
}



}
