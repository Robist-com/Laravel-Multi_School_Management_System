<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\GPA;
class gpaController extends Controller {

	public function __construct() {
		/*$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth');
		$this->beforeFilter('userAccess',array('only'=> array('index','edit','create','update','delete')));*/
	        $this->middleware('auth');

	}
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		if (auth()->user()->group == "Owner") {
			$gpaes=GPA::where('school_id', auth()->user()->school->id)->get();
			$gpa = array();
		}else {
			$gpaes=GPA::all();
			$gpa = array();
		}
		
		//return View::Make('app.GPA',compact('gpaes','gpa'));
		return View('gpa.GPA',compact('gpaes','gpa'));
	}


	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function create(Request $request)
	{
		$rules=[
			'for' => 'required',
			'gpa' => 'required|numeric',
			'grade' => 'required',
			'markfrom' => 'required|integer',
			'markto' => 'required|integer',

		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/gpa')->withErrors($validator);
		}
		else {
			$gpa = new GPA;
			$gpa->for= $request->get('for');
			$gpa->gpa= $request->get('gpa');
			$gpa->grade=$request->get('grade');
			$gpa->markfrom=$request->get('markfrom');
			$gpa->markto=$request->get('markto');
			$gpa->school_id=$request->get('school_id');
			$gpa->save();
			return Redirect::to('/gpa')->with("success","GPA Created Succesfully.");

		}
	}





	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function edit($id)
	{

		$gpa = GPA::find($id);

		if (auth()->user()->group == "Owner") {
			$gpaes=GPA::where('school_id', auth()->user()->school->id)->get();
			// $gpa = array();
		}else {
			$gpaes=GPA::all();
			// $gpa = array();
		}
		
		//return View::Make('app.GPA',compact('gpaes','gpa'));
		return View('gpa.GPA',compact('gpaes','gpa'));

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
			'for' => 'required',
			'gpa' => 'required',
			'grade' => 'required|between:0,99.99',
			'markfrom' => 'required|integer',
			'markto' => 'required|integer',
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/gpa/edit/'.$request->get('id'))->withErrors($validator);
		}
		else {
			$gpa = GPA::find($request->get('id'));
			$gpa->for= $request->get('for');
			$gpa->gpa= $request->get('gpa');
			$gpa->grade=$request->get('grade');
			$gpa->markfrom=$request->get('markfrom');
			$gpa->markto=$request->get('markto');
			$gpa->save();
			return Redirect::to('/gpa')->with("success","GPA update Succesfully.");

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
		$gpa = GPA::find($id);
		$gpa->delete();
		return Redirect::to('/gpa')->with("success","GPA deleted Succesfully.");

	}
}
