<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;
class Localization
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
        if(session()->has('locale')){
            App::setLocale(session()->get('locale'));

            // that's what we need in side the middleware of lacalization
            // this part check is the current language is english or french or chinese or arbic 
            // well get that language and store in the session okay.
        }

        return $next($request);
    }
}
