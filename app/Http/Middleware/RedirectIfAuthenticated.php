<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::hasRole('superadmin')){
                return view('SuperAdmin');
            }elseif(Auth::hasRole('admin')){
                return view('admin');
            }elseif(Auth::hasRole('user')){
                return view('user');
            }
        }

        return $next($request);
    }
}
