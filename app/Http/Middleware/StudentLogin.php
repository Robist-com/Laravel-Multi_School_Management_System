<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Carbon\Carbon;
use Cache;
use App\Roll;
class StudentLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(Session::has('studentSession'))){ // here we check if the session is not empty 

            $students = Roll::join('admissions','admissions.id','=', 'rolls.student_id')
        ->where(['username' => Session::get('studentSession')])->get();
            $expiredTime = Carbon::now()->addMinute(1);
            Cache::put('student-online' . $students , true, $expiredTime );
            return redirect('/student');// /student is our route for the login page okay.
        } // our session name is studentSession okay
        return $next($request);
    }
    // so here we will make a seesion for this middleware okay.
}
