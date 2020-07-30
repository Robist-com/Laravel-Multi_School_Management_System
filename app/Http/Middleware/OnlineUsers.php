<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Cache;
// use Illuminate\Support\Facades\Auth;
use Auth;
class OnlineUsers
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
        if (Auth::check()) {
            $userOnlineExpiredTime = Carbon::now()->addMinute(1);
            // Cache::put('user-online', . Auth::user()->id, true, $userOnlineExpiredTime);

            Cache::put('user-online' . Auth::user()->id, true, $userOnlineExpiredTime);

            # code...
        }
        return $next($request);
    }
}
