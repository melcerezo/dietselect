<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfFoodie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'foodie')
    {
        if (Auth::guard($guard)->check()) {
            dd(Auth::guard($guard));
//            if(){
//
//            }else
            return redirect()->route('foodie.dashboard');
        }

        return $next($request);
    }
}
