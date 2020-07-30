<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ClassRoom;
use App\Models\Teacher;
use Carbon\Carbon;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Return view for public home page
     */
    public function publicHome()
    {
        return view('public.home');
    }

    /**
     * Return view for login
     */
    public function login()
    {
        return view('auth.login');
    }

    public function lockscreen()
    {
        $user = Auth::user();
        // dd($user); die;
        Auth::logout();

        return view('users.lockscreen',[
                'user'  => $user
            ]);
    }
    

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    // }

    /**
     * Return view for invalid url error
     */
    public function invalidUrl()
    {
        if(Auth::check()) {
            return view('errors.404');
        } else {
            return redirect(route('login'));
        }
    }

    /**
     * Return view for public home page
     */
    public function serverError()
    {
        if(Auth::check()) {
            return view('errors.500');
        } else {
            return redirect(route('login'));
        }
    }

    /**
     * Handle an authentication attempt.
     */
    public function loginAction(Request $request)
    {
        // dd($request->all());
        $credentials = $request->only('email', 'password');
        $email = $request->get('email');
        $password = $request->get('password');
         
        //  if(Auth::attempt(['email' => $userName, 'password' => $password],true)) {
            if(Auth::attempt($credentials)) {
            // Authentication passed...
            $user   = Auth::user();
            // dd( $user );
            $today  = strtotime('now');
            // dd( $today );
            $userValidDate = strtotime($user->valid_till);
            // dd( $userValidDate );
            
                // dd( $isonline );

            // redirect to login if the user validation is completed
            if(!empty($user->valid_till) && $today > $userValidDate) {
                //logout user
                Auth::logout();

                return redirect(route('user-expired'))->with("expired-user", $user->user_name);
            } else if(!empty($user->valid_till) && (($userValidDate - $today) <= 172800)){

                return redirect(route('user-dashboard'))->with("message",("Welcome " . $user->name . ". Your trial pack ends on " . $user->valid_till . ". Please contact developer team for more info."))->with("alert-class","alert-warning");
            }

            $ipaddress =  $request->ip(); // THIS WILL GET THE IP OD THE CLIENT OKAY
            $isonline =   $user->update(['is_online'=>1, 'login_time' => Carbon::now(), // CURRENT TIME
            'ip_address' =>  $ipaddress]);
            return redirect(route('home'))->with("message","Welcome " . $user->name . ". You are successfully logged in to the School Timetable Managemet System.")->with("alert-class","alert-success");
        } else {
            // Authentication fails...
            return redirect(route('login'))->with("message","Login failed. Incorrect user name and password.")->with("alert-class","alert-danger");
        }
    }

    /**
     * Redirect successfully logged users
     */
    public function dashboard()
    {
        $classesCount   = 0;
        $teachersCount  = 0;

        $classesCount   = ClassRoom::where('status', 1)->count();
        $teachersCount  = Teacher::where('status', 1)->count();

        return view('user.dashboard', [
                'classesCount'  => $classesCount,
                'teachersCount' => $teachersCount
            ]);
    }

    /**
     * Logsout users
     */
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    /**
     * Return view for software licence
     */
    public function licence()
    {
        return view('public.license');
    }

    /**
     * Return view for uncompleted pages
     */
    public function underConstruction()
    {
        return view('public.under-construction');
    }

    /**
     * Return view for expired users
     */
    public function userExpired()
    {
        return view('public.expired');
    }
}
