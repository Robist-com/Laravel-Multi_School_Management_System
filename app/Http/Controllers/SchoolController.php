<?php

namespace App\Http\Controllers;

use App\Mail\SchoolActivationRequest;
use App\Models\Role;
use App\Models\User;
// use App\User;
use App\Roles;
use App\School;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash as FlashFlash;
use Laracasts\Flash\FlashServiceProvider;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class SchoolController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('checkPermission::school_delete');

        // $this->middleware('checkPermission::school_delete')->except('index','edit','update','create','store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->group == 'Owner') {
            $schools = School::join('users','users.id', '=', 'schools.user_id')
            ->select('schools.*','schools.name as school_name','users.name as user_name')->where('user_id', Auth::user()->id)->get();
            // dd( $schools);
            $users = User::all();
        }else {
            $schools = School::join('users','users.id', '=', 'schools.user_id')
            ->select('schools.*','schools.name as school_name','users.name as user_name')->get();
            $users = User::all();
        }
        
        return view('school.table', compact('schools','users'));
    }

    public function Dashboard3(Request $request)
    {
       return view('school.dashboard_3');
    }

  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        $users = User::all();
        return view('school.index', compact('users', 'schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $school =   auth()->user()->school()->create($request->only([
                    'name', 
                    'email', 
                  
                ]));


    //   $school =  auth()->user()->school->create([
    //         'name' => $request->get('name'),
    //         'email' => $request->get('email')
    //         ]);

            // $admin = User::whereHas('role', function($q){
            //     $q->where('name', 'Supper Admin')->first();
            // });

            $email =  $school->email; 
            $owner_name =  $school->name;

                // dd($email, $student_name);
                // $owner_name =  $school->owner->name;
                $message = [
                    'email'=> $email,
                    'name' => $owner_name,
                    // 'name'=>$owner_name,

                    // we can pass this veriables inside our blade okay.
                ];

                // dd($message);
            
            // $admin = User::where(['role_id'=> 1])->get();

            Mail::send('emails.school_activation', $message,function($message)use($email){
                $message->to($email)->subject('School Activation - Academic Information System');
            });
        
            // Mail::to('3939919@gmail.com')->send(new SchoolActivationRequest($school));

        Flash::success('School Created Successfully');
        return redirect()->back();
    }


    public function School_Confirmation()
    {
        return view('school.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        if (auth()->user()->group == 'Owner') {
            $schools = School::join('users','users.id', '=', 'schools.user_id')
            ->select('schools.*','schools.name as school_name','users.name as user_name')->where('schools.user_id', Auth::user()->id)->get();
            // dd( $schools);
            $users = User::all();
        }else {
            $schools = School::join('users','users.id', '=', 'schools.user_id')
            ->select('schools.*','schools.name as school_name','users.name as user_name')->get();
            $users = User::all();
        }

        $school = School::join('users','users.id', '=', 'schools.user_id')
            ->select('schools.*','schools.name as school_name','users.name as user_name')->where('schools.id', $school->id)->first();

        return view('school.table', compact('schools','school','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $school->update($request->all());
        // dd($school);
        Flash::success('School Updated Successfully!');
        return redirect(route('school.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}
