<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsActive
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
        if (Auth::check())
        {
            if (Auth::User()->verified == 0)
            {
                $token = Auth::user()->email_token;
                Auth::logout();
                return redirect()->route('try', ['token'=> $token]);
            }
        }
        return $next($request);
    }
}
