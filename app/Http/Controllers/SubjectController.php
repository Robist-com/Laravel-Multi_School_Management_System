<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Subject;
use App\Models\Classes;
use App\Models\Course;
use App\GPA;
use DB;

class SubjectController extends Controller {

	public function __construct() {
		/*$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth');
		$this->beforeFilter('userAccess',array('only'=> array('delete')));*/
	       $this->middleware('auth');
              // $this->middleware('userAccess',array('only'=> array('delete')));
	}
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
        $classes = Classes::select('class_code','class_name')->orderby('class_code','asc')->get();
        
        // dd($classes);
        $gpa =GPA::select('for')->distinct()->get();
        
        // $Subjects =	DB::table('Subject')
		// ->join('classes', 'Subject.class', '=', 'classes.class_code')
		// ->select('Subject.id', 'Subject.code','Subject.name','Subject.type', 'Subject.subgroup','Subject.stdgroup','Subject.totalfull',
		// 'Subject.totalpass','Subject.gradeSystem','Subject.wfull', 'Subject.wpass','Subject.mfull','Subject.mpass','classes.class_name as class','Subject.sfull','Subject.spass',
		// 'Subject.pfull','Subject.ppass')
		// ->get();
           // echo "<pre>";print_r($gpa);exit;
		//return View::Make('subjects.subjectCreate',compact('classes','gpa'));
		return View('subjects.index',compact('classes','gpa'));
	}


	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function create(Request $request)
	{

//echo "<pre>";print_r($request->get('class'));
    $classes =  $request->get('class');
		$rules=[
			'name'         => 'required',
			'code'         => 'required',
			'type'         => 'required',
			'subgroup'     => 'required',
			'stdgroup'     => 'required',
			'class'        => 'required',
			'gradeSystem'  => 'required',
			'totalfull'    => 'required',
			'wfull'        => 'required',
			'mfull'        => 'required',
			'sfull'        => 'required',
			'pfull'        => 'required',
			'totalpass'    => 'required',
			'wpass'        => 'required',
			'mpass'        => 'required',
			'spass'        => 'required',
			'ppass'        => 'required'
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/subject/create')->withErrors($validator);
		}
		else {
			$exsubject = Subject::select('*')->where('class',$request->get('class'))->where('code',$request->get('code'))->get();
			if(count($exsubject)>0)
			{
				$errorMessages = new Illuminate\Support\MessageBag;
				$errorMessages->add('deplicate', 'subject all ready exists for this class!!');
				return Redirect::to('/subject/create')->withErrors($errorMessages);


			}
			else {
				foreach($classes as $class){
				$subject = new Course;
				$subject->name = $request->get('name');
				$subject->code = $request->get('code');
				$subject->class = $class;
				$subject->gradeSystem = $request->get('gradeSystem');
				$subject->type = $request->get('type');
				$subject->subgroup = $request->get('subgroup');
				$subject->stdgroup = $request->get('stdgroup');
				$subject->totalfull = $request->get('totalfull');
				$subject->totalpass = $request->get('totalpass');
				$subject->wfull = $request->get('wfull');
				$subject->wpass = $request->get('wpass');
				$subject->mfull = $request->get('mfull');
				$subject->mpass = $request->get('mpass');
				$subject->sfull = $request->get('sfull');
				$subject->spass = $request->get('spass');
				$subject->pfull = $request->get('pfull');
				$subject->ppass = $request->get('ppass');

				$subject->save();
			}
				return Redirect::to('/subject/create')->with("success", "Subject Created Succesfully.");
			}

		}
	}


	/**
	* show all resource in strograge.
	*
	* @return Response
	*/
	public function show(Request $request)
	{

		$Subjects=	DB::table('Subject')
		->join('classes', 'Subject.class', '=', 'classes.class_code')
		->select('Subject.id', 'Subject.code','Subject.name','Subject.type', 'Subject.subgroup','Subject.stdgroup','Subject.totalfull',
		'Subject.totalpass','Subject.gradeSystem','Subject.wfull', 'Subject.wpass','Subject.mfull','Subject.mpass','classes.class_name as class','Subject.sfull','Subject.spass',
		'Subject.pfull','Subject.ppass')
		->get();

		//return View::Make('subjects.subjectList',compact('Subjects'));
		return View('subjects.index',compact('Subjects'));
	}




	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function edit(Request $request, $id)
	{
		$classes = Classes::pluck('class_name','class_code');
		$subject = Subject::find($id);
		$gpa =GPA::select('for')->distinct()->get();
		//return View::Make('subjects.subjectEdit',compact('subject','classes'));
		return View('subjects.edit',compact('subject','classes','gpa'));

	}


	/**
	* Update the specified resource in storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function update(Request $request)
	{
		$rules=[
			'name' => 'required',
			'code' => 'required',
			'type' => 'required',
			'subgroup' => 'required',
			'stdgroup' => 'required',
			'class' => 'required',
			'gradeSystem' => 'required',
			'totalfull' => 'required',
			'wfull' => 'required',
			'mfull' => 'required',
			'sfull' => 'required',
			'pfull' => 'required'

		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/subject/edit/'.$request->get('id'))->withErrors($validator);
		}
		else {
			$subject = Subject::find($request->get('id'));
			$subject->name= $request->get('name');
			$subject->code=$request->get('code');
			$subject->class=$request->get('class');
			$subject->gradeSystem=$request->get('gradeSystem');
			$subject->type=$request->get('type');
			$subject->subgroup=$request->get('subgroup');
			$subject->stdgroup=$request->get('stdgroup');

			$subject->totalfull=$request->get('totalfull');
			$subject->totalpass=$request->get('totalpass');
			$subject->wfull=$request->get('wfull');
			$subject->wpass=$request->get('wpass');
			$subject->mfull=$request->get('mfull');
			$subject->mpass=$request->get('mpass');
			$subject->sfull=$request->get('sfull');
			$subject->spass=$request->get('spass');
			$subject->pfull=$request->get('pfull');
			$subject->ppass=$request->get('ppass');
			$subject->save();
			return Redirect::to('/subject/list')->with("success","Subject Updated Succesfully.");

		}
	}


	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function delete($id)
	{
		$subject = Subject::find($id);
		$subject->delete();
		return Redirect::to('/subject/list')->with("success","Subject Deleted Succesfully.");
	}
	public function getmarks($subject,$cls)
	{
		$subject = Subject::select('totalfull','totalpass','wfull','wpass','mfull','mpass','sfull','spass','pfull','ppass')->where('code','=',$subject)->where('class','=',$cls)->get();
		return $subject;
	}
	public function getsubjects($class){

      $subject= Subject::select('id','name')->where('class','=',$class)->get();
	return $subject;
	}


}
