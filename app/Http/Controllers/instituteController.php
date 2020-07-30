<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use ValidatesRequests;
use App\Institute;
use App\Branch;
use DB;
use Flash;
use Storage;
class instituteController extends Controller {

	public function __construct() {
		/*$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth');
		$this->beforeFilter('userAccess',array('only'=> array('index','save')));*/
		    $this->middleware('auth', array('only'=>array('show','create','edit','update')));
	}
	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		$institute= Institute::select("*")->first();
		if(is_null($institute))
		{
			$institute=new Institute;
			$institute->name = "";
			$institute->establish = "";
			$institute->web = "";
			$institute->email = "";
			$institute->phoneNo = "";
			$institute->address = "";
			$institute->logo = "";
		}
		if(Storage::disk('local')->exists('/public/grad_system.txt')){
          $contant = Storage::get('/public/grad_system.txt');
          $data = explode('<br>',$contant );

            //echo "<pre>";print_r($data);
            $gradsystem = $data[0]; 
        }else{
          $gradsystem ='';
        }
        //print_r($data);exit;
		//return View::Make('app.institute',compact('institute'));
		return View('school_settings.institute',compact('institute','gradsystem'));
	}

	public function index1()
    {
       if(Storage::disk('local')->exists('/public/grad_system.txt')){
          $contant = Storage::get('/public/grad_system.txt');
          $data = explode('<br>',$contant );

            //echo "<pre>";print_r($data);
            $gradsystem = $data[0]; 
        }else{
          $gradsystem ='';
        }
        return $gradsystem;
    }
	

	

	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function save(Request $request)
	{
		$rules=[
			'name' => 'required',
			'establish' => 'required',
			'web' => 'required',
			'email' => 'required',
			'phoneNo' => 'required',
			'address' => 'required',
			'log' => 'mimes:png',


		];
		//echo "<pre>";print_r($request->file('logo'));exit;
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails())
		{
			Flash::error('Institution Not Created Check your Fields!.');

			return Redirect::to('institute');
		}
		else {

			$input = $request->all();

        $image =  $request->file('logo'); // this request is requesting image file okay.

        $image_name = rand(1111,9999) . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('institute_logo'), $image_name);

   
			$institue=new Institute;
			$institue->name = $request->get('name');
			$institue->establish = $request->get('establish');
			$institue->web = $request->get('web');
			$institue->email = $request->get('email');
			$institue->phoneNo = $request->get('phoneNo');
			$institue->address = $request->get('address');
			$institue->image =  $image_name;
			$institue->save();

		}
				Flash::success('Institute  Information saved!.');
			return Redirect::to('institute');

		}
	}
