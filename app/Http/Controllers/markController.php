<?php
namespace App\Http\Controllers;
use DB;
use Flash;
use App\GPA;
use Storage;
use App\Roll;
use App\Inbox;
use App\Marks;
use App\Ictcore_fees;
use App\Models\Batch;
use App\Models\Level;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Admission;
use App\Models\Department;
use Nexmo\Message\Message;
use App\Ictcore_integration;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ictcoreController;
Class foobar4{

}
class markController extends Controller {


	public function __construct() {
		/*$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth');*/
		$this->middleware('auth');
	}
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/

	 public function home()
	{
		return view('mark_management.index');
	}

	public function index(Request $request)
	{
		
		$classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();
		$subjects = Course::all();
		$batches = Batch::all();
		$class_code =$request->get('class');
		if($class_code !=''){
           $departments = ClassSchedule::join('departments','departments.department_id','=','class_schedule.department_id')->where('class_schedule.class_id',$class_code)->get();
		}else{
			$eections = array();
		}

		$department   = $request->get('section');
		$session   = $request->get('session');
		$exam      = $request->get('exam');

		if($exam  !='' && $class_code!=''){
			$exams = DB::table('exam')->where('id',$exam)->get();
		}else{
			$exams = array();
		}
		//return View::Make('app.markCreate',compact('classes','subjects'));
		return View('mark_management.markCreate',compact('classes','batches','subjects','class_code','exam','department','session','exams'));
    }
    
    // OLD CODE NOT IN USE FOR THIS PROJECT
	public function m_index(Request $request)
	{
		//echo "<pre>";print_r(getsubjecclass('cl1'));exit;
		$classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();
		$subjects = Course::all();
		$class_code =$request->get('class_id');
		if($class_code !=''){
           $departments = ClassSchedule::join('departments','departments.department_id','=','class_schedule.department_id')->where('class_schedule.class_id',$class_code)->get();
		}else{
			$eections = array();
		}
		$department =$request->get('section');
		$session =$request->get('session');
		$exam =$request->get('exam');
		if($exam !='' && $class_code!=''){
			$exams = DB::table('exam')->where('id',$exam)->get();
		}else{
			$exams = array();
		}
		//return View::Make('app.markCreate',compact('classes','subjects'));
		return View('mark_management.mmarkCreate',compact('classes','subjects','class_code','department','session','exam','departments','exams'));
	}
    // OLD CODE ENDS HERE NOT IN USE FOR THIS PROJECT

	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function create(Request $request)
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
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
            Flash::error($validator,'are required.');
                return Redirect::to('/mark/create');
            // return Redirect::to('/mark/create')->withErrors($validator);
            // dd($data);die;
		}
		else {
            $subGradeing = Course::select('gradeSystem')->where('course_code',$request->get('subject'))->where('class',$request->get('class'))->first();
            
			if($subGradeing->gradeSystem=="1")
			{
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',"1")->get();
               

			}
			else if($subGradeing->gradeSystem=="2") {
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',"2")->get();
			}else{
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',$subGradeing->gradeSystem)->get();

			}

			//	 $totalMark = Input
			$len = count((array)$request->get('roll'));
            // dd($len);die;
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
					//echo "<pre>d";print_r($gparules->toArray());
					foreach ($gparules as $gpa) {

						if ($totalmark >= $gpa->markfrom){
							$marks->grade = $gpa->gpa;
							$marks->point = $gpa->grade;
							break;
						}
					}

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
                Flash::success( $counter,'exam mark saved successfully.');
				return Redirect::to('/mark/create');
			}
			else {
                $already=$len-$counter;
                Flash::error( $already,'exam mark already saved.');
                return Redirect::to('/mark/create');
                
				// return Redirect::to('/mark/create?class_id='
				// .$request->get('class').'&department='
				// .$request->get('department').'&session='
				// .$request->get('session').'&exam='
				// .$request->get('exam'))->with("success",$counter."
				//  students mark save Succesfully and ".$already." 
				//  Students marks already saved.</strong>");
			}
		}
	}


    // OLD CODE NOT IN USE FOR THIS PROJECT
    public function m_create(Request $request)
	{
		$data =	$request->all();
		$rules=[
			'class'       => 'required',
			'department'     => 'required',
			'shift'       => 'required',
			'session'     => 'required',
			'roll'      => 'required',
			'exam'        => 'required',
			'subject'     => 'required',
			'written'     => 'required',
			'total_marks' => 'required',
			//'mcq' => 'required',
			//'practical' =>'required',
			//'ca' =>'required'
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/mark/m_create')->withErrors($validator);
		}
		else {
			//echo "<pre>";
			//////print_r($request->all());
			//exit;
			$total_marks = $request->get('total_marks');
			if($total_marks==100){
				$grade = 1;
			}
			if($total_marks==50){
				$grade = 2;
			}
			if($total_marks==75){
				$grade = 3;
			}
			if($total_marks==30){
				$grade = 4;
			}
			if($total_marks==25){
				$grade = 5;
			}
			if($total_marks==20){
				$grade = 6;
			}
			if($total_marks==15){
				$grade = 7;
			}
			if($total_marks==10){
				$grade = 8;
			}
			if($total_marks==5){
				$grade = 9;
			}
			//$subGradeing = Subject::select('gradeSystem')->where('code',$request->get('subject'))->where('class',$request->get('class'))->first();
			$gparules = GPA::select('gpa','grade','markfrom')->where('for',$grade )->orderBy('markfrom','desc')->get();
           //echo "<pre>";print_r($gparules->toArray());
			/*if($subGradeing->gradeSystem=="1")
			{
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',"1")->get();

			}
			else if($subGradeing->gradeSystem=="2") {
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',"2")->get();
			}else{
				$gparules = GPA::select('gpa','grade','markfrom')->where('for',$subGradeing->gradeSystem)->get();

			}*/

			//	 $totalMark = Input
			$len = count($request->get('regiNo'));

			$regiNos = $request->get('regiNo');
			$writtens=$request->get('written');
			$mcqs =$request->get('mcq');
			$practicals=$request->get('practical');
			$cas=$request->get('ca');
			$isabsent = $request->get('absent');
			$counter=0;

			for ( $i=0; $i< $len;$i++) {
				$isAddbefore = Marks::where('regiNo','=',$regiNos[$i])->where('exam','=',$request->get('exam'))->where('subject','=',$request->get('subject'))->first();
				if($isAddbefore)
				{

				}
				else {
					$marks = new Marks;
					$marks->class = $request->get('class');
					$marks->department = $request->get('department');
					$marks->shift = $request->get('shift');
					$marks->session = trim($request->get('session'));
					$marks->regiNo = $regiNos[$i];
					$marks->exam = $request->get('exam');
					$marks->subject = $request->get('subject');
					$marks->written = '';
					$marks->mcq = '';
					$marks->practical = '';
					$marks->ca = '';
					$marks->obtain_marks = $writtens[$i];
					$marks->total_marks = $total_marks;
					$marks->ca = '';
					$isExcludeClass = $request->get('class');
					
					$marks->total=$writtens[$i];
					//echo "<pre>d";print_r($gparules->toArray());
					foreach ($gparules as $gpa) {

						if ($writtens[$i] >= $gpa->markfrom){
							$marks->grade = $gpa->gpa;
							$marks->point = $gpa->grade;
							break;
						}
					}
					if($isabsent[$i]!== "")
					{
						$marks->Absent = $isabsent[$i];
					}
                    //echo "<pre>";print_r($marks);exit;
					//$test[] = $marks;
					$marks->save();
					$counter++;
				}
				
			}
			//echo "<pre>";print_r($test);
				//exit;
			if($counter==$len)
			{
				return Redirect::to('/mark/m_create?class_id='.$request->get('class').'&department='.$request->get('department').'&session='.$request->get('session').'&exam='.$request->get('exam'))->with("success",$counter."'s student mark save Succesfully.");
			}
			else {
				$already=$len-$counter;
				return Redirect::to('/mark/m_create?class_id='.$request->get('class').'&department='.$request->get('department').'&session='.$request->get('session').'&exam='.$request->get('exam'))->with("success",$counter." students mark save Succesfully and ".$already." Students marks already saved.</strong>");
			}
		}
	}
    // OLD CODE ENDS HERE NOT IN USE FOR THIS PROJECT



	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function show()
	{

		$formdata = new foobar4;
		$formdata->class="";
		$formdata->department="";
		$formdata->shift="";
		$formdata->session="";
		$formdata->subject="";
		$formdata->exam="";
		$classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();
        $batches  = Batch::orderby('batch','asc')->pluck('id','batch');
		$marks=array();


		//$formdata["class"]="";
		//return View::Make('app.markList',compact('classes','marks','formdata'));
		return View('mark_management.markList',compact('classes','marks','formdata','batches'));
    }
    
    // OLD CODE NOT IN USE FOR THIS PROJECT
	public function m_show()
	{

		$formdata = new foobar4;
		$formdata->class="";
		$formdata->department="";
		$formdata->shift="";
		$formdata->session="";
		$formdata->subject="";
		$formdata->exam="";
		$classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();
		//$subjects = Subject::lists('name','code');
		$marks=array();


		//$formdata["class"]="";
		//return View::Make('app.markList',compact('classes','marks','formdata'));
		return View('mark_management.mmarkList',compact('classes','marks','formdata'));
	}
    // OLD CODE ENDS HERE NOT IN USE FOR THIS PROJECT

	public function getlist(Request $request)
	{
        $input = $request->all();
		// dd($input); die;
		
		$classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();
		$batches  = Batch::orderby('batch','asc')->pluck('id','batch');
		
		$rules=[
			'class' => 'required',
			'department' => 'required',
			'shift' => 'required',
			'session' => 'required',
			'exam' => 'required',
			'subject' => 'required',

		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/mark/list/')->withErrors($validator);
		}
		else {
			$classes2 = Classes::orderby('class_code','asc')->pluck('class_name','class_code');
			$subjects = Course::where('class',$request->get('class'))->pluck('course_name','course_code');
            // $class = Classes::all();
            // $marks=	DB::table('rolls')

            $marks = Marks::join('rolls', 'rolls.username', '=', 'marks.roll_no')
            
			// ->join('rolls', 'rolls.roll_id', '=', 'marks.roll')
			->join('admissions', 'admissions.id', '=', 'rolls.student_id')
			->join('batches', 'batches.id', '=', 'admissions.batch_id')
			// ->join('marks', 'marks.session', '=', 'admissions.batch_id')
			->select('marks.id','marks.roll_no','admissions.first_name',
			'admissions.last_name', 'marks.written','marks.mcq',
			'marks.practical','marks.ca','marks.total','marks.grade','marks.point',
			'marks.Absent','batches.batch')
			->where('admissions.status', '=', '1')
			->where('admissions.class_code','=',$request->get('class'))
			->where('marks.class','=',$request->get('class'))
			->where('marks.department','=',$request->get('department'))
		         ->Where('Marks.shift','=',$request->get('shift'))
			->where('marks.session','=',trim($request->get('session')))
			->where('marks.subject','=',$request->get('subject'))
			->where('marks.exam','=',$request->get('exam'))
            ->get();
            
            // dd($marks); die;
			$formdata = new foobar4;
			$formdata->class=$request->get('class');
			$formdata->department=$request->get('department');
			$formdata->shift=$request->get('shift');
			$formdata->session=$request->get('session');
			$formdata->subject=$request->get('subject');
			$formdata->exam=$request->get('exam');

			if(count($marks)==0)
			{
				$noResult = array("noresult"=>"No Results Found!!");
				//return Redirect::to('/mark/list')->with("noresult","No Results Found!!");
				//return View::Make('app.markList',compact('classes2','subjects','marks','noResult','formdata'));
				return View('mark_management.markList',compact('classes2','subjects','marks','noResult','formdata'));
			}

			//return View::Make('app.markList',compact('classes2','subjects','marks','formdata'));
			return View('mark_management.markList',compact('classes2','subjects', 'marks','formdata', 'classes','batches'));
		}
	}

    // OLD CODE NOT IN USE FOR THIS PROJECT
	public function m_getlist(Request $request)
	{
		$rules=[
			'class' => 'required',
			'department' => 'required',
			'shift' => 'required',
			'session' => 'required',
			'exam' => 'required',
			'subject' => 'required',

		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/mark/m_list/')->withErrors($validator);
		}
		else {
			$classes2 = Classes::orderby('code','asc')->pluck('name','code');
			$subjects = Subject::where('class',$request->get('class'))->pluck('name','code');
			$marks    =	DB::table('Marks')
			->join('Student', 'Marks.regiNo', '=', 'Student.regiNo')
			->select('Marks.id','Marks.regiNo','Student.rollNo', 'Student.firstName','Student.middleName','Student.lastName', 'Marks.written','Marks.mcq','Marks.practical','Marks.ca','Marks.total','Marks.obtain_marks','Marks.total_marks','Marks.grade','Marks.point','Marks.Absent')
			->where('Student.isActive', '=', 'Yes')
			->where('Student.class','=',$request->get('class'))
			->where('Marks.class','=',$request->get('class'))
			->where('Marks.department','=',$request->get('department'))
		         //->Where('Marks.shift','=',$request->get('shift'))
			->where('Marks.department','=',trim($request->get('department')))
			->where('Marks.subject','=',$request->get('subject'))
			->where('Marks.exam','=',$request->get('exam'))
			->get();

			$formdata          = new foobar4;
			$formdata->class   = $request->get('class');
			$formdata->department = $request->get('department');
			$formdata->shift   = $request->get('shift');
			$formdata->session = $request->get('session');
			$formdata->subject = $request->get('subject');
			$formdata->exam    = $request->get('exam');

			if(count($marks)==0)
			{
				$noResult = array("noresult"=>"No Results Found!!");
				//return Redirect::to('/mark/list')->with("noresult","No Results Found!!");
				//return View::Make('app.markList',compact('classes2','subjects','marks','noResult','formdata'));
				return View('app.mmarkList',compact('classes2','subjects','marks','noResult','formdata'));
			}

			//return View::Make('app.markList',compact('classes2','subjects','marks','formdata'));
			return View('app.mmarkList',compact('classes2','subjects','marks','formdata'));
		}
	}
    // OLD CODE ENDS HERE NOT IN USE FOR THIS PROJECT
	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function edit($id)
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

		return View('mark_management.markEdit',compact('marks'));


    }

	/**
	* Update the specified resource in storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function update(Request $request)
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
			return Redirect::to('/mark/edit/'.$request->get('id'))->withErrors($validator);
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

            $marks->save();
            Flash::success('Marks Update Sucessfully');
			return Redirect::to('show/mark/list');

		}
	}


	public function getForMarksjoin($class)
	{
		$departments  = Department::select('department_id','department_name')->where('class_code','=',$class)->get();
		$departments['subjects'] = course::select('id','name')->where('class','=',$class)->get();
		
		/* $students=	DB::table('Student')
		->leftjoin('Marks', 'Student.regiNo', '=', 'Marks.regiNo')
		->select('Student.id', 'Student.regiNo','Student.rollNo','Student.firstName','Student.middleName','Student.lastName',
		'Student.discount_id','Marks.written','Marks.written','Marks.mcq','Marks.practical','Marks.ca','Marks.Absent')
		->where('Student.section','=',$department)->where('Student.shift','=',$shift)->where('Student.session','=',$session)->get();

	*/
		//print_r(getsubjecclass($class)['sub_name']);
		//echo count(getsubjecclass($class)['sub_name']);
		
		//for($i=0;$i<count(getsubjecclass($class)['sub_name']);$i++){
			//$subjecname .= getsubjecclass($class)['sub_name'][$i]['name'];
		//}
		//echo $subjecname;
		//if(count(getsubjecclass($class)['sub_name']))

	

		$output ='';
		foreach($departments as $department){
			$subjecname = '';
			for($i=0;$i<count(getsubjecclass($class)['sub_name']);$i++){
				
				$url = url('/').'/create/marks?sub_id='.getsubjecclass($class)['sub_name'][$i]['id'].'&class='.$class.'&department='.$department->department_id;
				$link = "'".$url."','enter marks','width=1500','height=500'";
				$subjecname .='&nbsp;  ';
				$subjecname .='<a href="#'.$url.'" onclick="window.open('."$link".'); 
	              return false;">'.getsubjecclass($class)['sub_name'][$i]['name'].'</a>';
			}
			$output .='<tr><td>'.$department->department_name.'</td><td>'.$subjecname.'</td></tr>'; 
		}
		return $output;
	}

	public function createmarks(Request $request){

		//echo "<pre>";print_r(getsubjecclass('cl1'));exit;
		$class = Classes::select('id','class_name')->where('class_code',$request->get('class'))->first();
		
		$exams = DB::table('exam')->where('department_id',$request->get('department'))->where('class_id',$class->id)->get();
		$param1 = $request->get('exam');
		$param2 = $request->get('total_marks');
		$session = $request->get('session');
		$subject_id = $request->get('sub_id');
		$class_code = $request->get('class');
		$department = $request->get('department');
		$students = array();
		if($request->get('show')){
			
			$students = DB::table('admissions')
						//->leftjoin('Marks','Student.regiNo','=','Marks.regiNo')
						->leftJoin('marks', function($join) use ($param1,$subject_id)
					    {
					        $join->on('Student.regiNo', '=', 'Marks.regiNo');
					        $join->on('Marks.exam','=',DB::raw("'".$param1."'"));
					        $join->on('Marks.subject','=',DB::raw("'".$subject_id."'"));

					    })

						->select(DB::raw("CONCAT(Student.firstName,' ',Student.lastName) as fullname"),'Student.regiNo as student_id','Marks.*')
						//->where('Marks.exam',$request->get('exam'))
						->where('Student.session',get_current_session()->id)
						->where('Student.class',$request->get('class'))
						->where('Student.section',$request->get('section'))
						->groupBy('Student.regiNo')
						->get();

						//echo "<pre>hgg";print_r($students);exit;
		}
		//return View::Make('app.markCreate',compact('classes','subjects'));
		return View('app.markscreate',compact('class','exams','subject_id','students','param1','param2','session','class_code','section'));
	}


	public function newcreate()
	{
		//echo "<pre>";print_r($request->get('sms'));exit;
		$data =	$request->all();
		

		$rules=[
			'class'       => 'required',
			// 'section'     => 'required',
			'shift'       => 'required',
			'department'     => 'required',
			'regiNo'      => 'required',
			'exam'        => 'required',
			'subject'     => 'required',
			'written'     => 'required',
			'total_marks' => 'required',
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/create/marks?class='
			.$request->get('class').'&department='
			.$request->get('department').'&session='
			.$request->get('session').'&exam='.$request->get('exam').'&sub_id='.$request->get('subject'))->withErrors($validator);
		}
		else {
			$getexam       = DB::table('exam')->where('id',$request->get('exam'))->first();
				$exam_name = $getexam->type;
			$total_marks   = $request->get('total_marks');
			if($total_marks==100){
				$grade = 1;
			}
			if($total_marks==50){
				$grade = 2;
			}
			if($total_marks==75){
				$grade = 3;
			}
			if($total_marks==30){
				$grade = 4;
			}
			if($total_marks==25){
				$grade = 5;
			}
			if($total_marks==20){
				$grade = 6;
			}
			if($total_marks==15){
				$grade = 7;
			}
			if($total_marks==10){
				$grade = 8;
			}
			if($total_marks==5){
				$grade = 9;
			}
			$gparules = GPA::select('gpa','grade','markfrom')->where('for',$grade )->orderBy('markfrom','desc')->get();
           
			$len = count($request->get('regiNo'));

			$regiNos = $request->get('regiNo');
			$writtens=$request->get('written');
			//$mcqs =$request->get('mcq');
			//$practicals=$request->get('practical');
			//$cas=$request->get('ca');
			$isabsent = $request->get('absent');
			$sms = $request->get('sms');
			//print_r($isabsent);exit;
			$counter  = 0;

			for ( $i  = 0; $i< $len;$i++) {
				$isAddbefore = Marks::where('regiNo','=',$regiNos[$i])->where('exam','=',$request->get('exam'))->where('subject','=',$request->get('subject'))->first();
				
				if($isAddbefore)
				{
					$marks = Marks::find($isAddbefore->id);
				}
				else {
					$marks = new Marks;
				}
					$marks->class = $request->get('class');
					$marks->department = $request->get('department');
					$marks->shift = $request->get('shift');
					$marks->session = trim($request->get('session'));
					$marks->regiNo = $regiNos[$i];
					$marks->exam = $request->get('exam');
					$marks->subject = $request->get('subject');
					$marks->written = '';
					$marks->mcq = '';
					$marks->practical = '';
					$marks->ca = '';
					$marks->obtain_marks = $writtens[$i];
					$marks->total_marks = $total_marks;
					$marks->ca = '';
					$isExcludeClass = $request->get('class');
					
					$marks->total=$writtens[$i];
					//echo "<pre>d";print_r($gparules->toArray());
					foreach ($gparules as $gpa) {

						if ($writtens[$i] >= $gpa->markfrom){
							$marks->grade = $gpa->gpa;
							$marks->point = $gpa->grade;
							break;
						}
					}
					if($isabsent[$regiNos[$i]]== "yes")
					{
						$marks->Absent = $isabsent[$regiNos[$i]];
						$writtens[$i]  = 0;
						$marks->total=$writtens[$i];
						$marks->obtain_marks = $writtens[$i];
					}
                    //echo "<pre>";print_r($marks);exit;
					//$test[] = $marks;
					if($marks->save()){
					    if($sms[$regiNos[$i]]== "yes"){
					    	$send_sms = $this->send_sms($regiNos[$i],$total_marks,$writtens[$i],$request->get('subject'),$exam_name);
						}
						$counter++;
					}
				//}

				
			}
			//echo "<pre>";print_r($test);
				//exit;
			if($counter==$len)
			{
				return Redirect::to('/mark/m_create?class_id='.$request->get('class').'&department='.$request->get('department').'&session='.$request->get('session').'&exam='.$request->get('exam'))->with("success",$counter."'s student mark save Succesfully.");
			}
			else {
				$already=$len-$counter;
				return Redirect::to('/mark/m_create?class_id='.$request->get('class').'&department='.$request->get('department').'&session='.$request->get('session').'&exam='.$request->get('exam'))->with("success",$counter." students mark save Succesfully and ".$already." Students marks already saved.</strong>");
			}
		}
	}


	// public function send_sms($regiNo,$total,$obtain,$sub,$exam_name)
	// {

	
	// 	$student = DB::table('Student')->where('regiNo',$regiNo)->first();
	// 	$subject = DB::table('Subject')->where('id',$sub)->first();
		
	// 	$phone   = $student->fatherCellNo;
		
	// 	//$message = 'your Child '.$student->firstName.' '.$student->lastName. ' subject '.$subject->name.' obtains marks '.$obtain.' out of '.$total.' marks ';
		
	// 	$col_msg = DB::table('message')->where('name','mark_notification')->first();
	// 		if(empty($col_msg)){
	// 			$message = 'your Child '.$student->firstName.' '.$student->lastName. ' subject '.$subject->name.' obtains marks '.$obtain.' out of '.$total.' marks ';
	//       	}else{
	//       		$message =$col_msg->description;
	//       		$msg1 = str_replace("[student_name]",$student->firstName.''.$student->lastName,$message);
	//       		$msg2 = str_replace("[marks]",$obtain,$msg1);
	//       		$msg3 = str_replace("[outoff]",$total,$msg2);
	//       		$msg4 = str_replace("[subjects]",$subject->name,$msg3);
	//       		$message = str_replace("[exam]",$exam_name,$msg4);
	//       	}




	// 	$body    = $message;
	// 	$ict     = new ictcoreController();
	// 	$i       = 0;
	// 	$attendance_noti     = DB::table('notification_type')->where('notification','fess')->first();
	// 	$ictcore_fees        = Ictcore_fees::select("*")->first();
	// 	$ictcore_integration = Ictcore_integration::select("*")->where('type','sms');
	// 	if($ictcore_integration->count()>0){
	// 		$ictcore_integration = $ictcore_integration->first();
	// 	}else{
	// 		return 404;
	// 	}
	// 	$contacts = array();
	// 	$contacts1 = array();
	// 	$i=0;
	// 	if (preg_match("~^0\d+$~", $phone)) {
	// 		$to = preg_replace('/0/', '92', $phone, 1);
	// 	}else {
	// 		$to =$phone;  
	// 	}
	// 	if(strlen(trim($to))==12){
	// 		$contacts = $to;
	// 	}
		
	// 	$msg = $body ;
	// 	if($ictcore_integration->method!='ictcore'){
	// 	$snd_msg  = $ict->verification_number_telenor_sms($to,$msg,'SidraSchool',$ictcore_integration->ictcore_user,$ictcore_integration->ictcore_password,'sms');
		
	// 	}else{
	// 		$send_msg_ictcore = sendmesssageictcore($student->firstName,$student->lastName,$to,$msg,'marks');
	// 	}

	// 	return 200;
	// }

	public function template()
	{
		
		$message = Inbox::where('name','mark_notification')->first();
		if(!empty($message)){
			return Redirect::to('/message/edit/'.$message ->id);
		}
		return View('app.markstemplate');
	}
	public function edittemplate($id)
	{
		$message = Inbox::find($id);
		//return View::Make('app.classEdit',compact('class'));
		return View('app.messageEdit',compact('message'));
	}


}
