<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if (Auth::user()) {
            if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                return $next($request);
            else
                return abort(403,'Unauthorized action.');
        } else
            return abort(404,'Page not found.');

        // if(auth()->user()->status == 1){
        //     return $next($request);
        // }
        // elseif(auth()->user()->status == 2){
        //     return redirect('/seller/dashboard')->with('seller','You have seller access');
        // }
        // elseif (auth()->user()->status == 3) {
        //     return redirect('/dhl/welcome/setting_view')->with('service','You have service access');
        // }
        // return redirect('/login')->with('error','You have not admin access');
    }
}
