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
	

	public function Settings(Request $request)
	{
		// dd($request->all());
		$settings = Institute::where('school_id', auth()->user()->school_id)->update(['template' => $request->template]);

		return $settings;
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
			Flash::error('School Not Created Check your Fields!.');

			return Redirect::to('institute');
		}
		else {

			// return $input = $request->all();

				if ($request->logo) {
						$image =  $request->file('logo'); // this request is requesting image file okay.

						$image_name = rand(1111,9999) . '.' . $image->getClientOriginalExtension();

						$image->move(public_path('institute_logo'), $image_name);

			 Institute::updateOrCreate([

			'school_id'   => $request->school_id,
			],[
					'name'     => $request->get('name'),
					'establish' => $request->get('establish'),
					'web'    => $request->get("web"),
					'email'   => $request->get('email'),
					'phoneNo'       => $request->get('phoneNo'),
					'address'   => $request->get('address'),
					'image'   =>  $image_name,
			]);

			}else {
				 Institute::updateOrCreate([

			'school_id'   => $request->school_id,
			],[
					'name'     => $request->get('name'),
					'establish' => $request->get('establish'),
					'web'    => $request->get("web"),
					'email'   => $request->get('email'),
					'phoneNo'       => $request->get('phoneNo'),
					'address'   => $request->get('address'),
			]);
			}

		}
				Flash::success('School  Information saved!.');
			return Redirect::to('institute');

		}
	}
