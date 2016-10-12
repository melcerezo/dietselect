<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FoodieGuard
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
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson())
                return response('Unauthorized.', 401);
            return redirect()->route('foodie.login.show');//redirect to login;
        }
        return $next($request);
    }
}
