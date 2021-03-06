<?php

namespace App\Http\Middleware;

use Closure;
use SSO\SSO;
use Illuminate\Support\Facades\Auth;
use DB;
use Storage;

class AdminAuthenticate
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
        if (Auth::guard($guard)->check() && Auth::user()->role_id >= 2) {
            return $next($request);
        }
        else {
            return abort(401);
        }
    }
}