<?php

namespace App\Http\Middleware;

use Closure;
use SSO\SSO;
use Illuminate\Support\Facades\Auth;
use DB;
use Storage;

class SSOAuthenticate
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
            return $next($request);
        }
        else  {
            $username = str_random(10);

            if (Auth::guard($guard)->attempt(['username' => $username, 'password' => ''])) {
                return $next($request);
            }
            else {
                $id = DB::table('users')->insertGetId([
                    'username' => $username,
                    'fullname' => str_random(8),
                    'voted_threads' => "|",
                    'voted_replies' => "|",
                ]);

                // Create folder for user
                Storage::makeDirectory('users/'.$id);

                Auth::guard($guard)->loginUsingId($id);
                return $next($request);
            }
        }
    }
}
