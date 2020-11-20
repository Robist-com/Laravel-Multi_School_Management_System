<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
        protected function redirectTo()
        {
            // if(Auth::user()->role_id < 2){
            //     return  '/';
            // }else{

        // $ipaddress =  Request::ip(); // THIS WILL GET THE IP OD THE CLIENT OKAY
        // $isonline =   Auth::user()->update(['isonline'=>1, 'login_time' => Carbon::now(), // CURRENT TIME
        // 'ip_address' =>  $ipaddress]);
        //     dd( $isonline );

                return  '/home';
            // }
        }

        public function change_skin($value)
	{
		setcookie("skin", $value, time() + (3600), "/");
		return back();
    }

    
    
    public function restore()
    {
    	ini_set('max_execution_time', 300);
		Artisan::call("migrate:refresh");
		Artisan::call("db:seed");
		\Session::flush();
        \Session::regenerate();
		$message =  trans('topbar_menu_lang.success');
		return redirect('/')->withMessage($message);
    }

  
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
