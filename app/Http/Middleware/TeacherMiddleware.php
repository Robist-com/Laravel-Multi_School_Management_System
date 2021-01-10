<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class TeacherMiddleware
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
        if ($request->user() && $request->user()->group != 'Teacher') //'super_admin'
            
    {
        return new Response(view('unauthorized')->with('role', 'TEACHERS'));

    }

        return $next($request);
    }
}
