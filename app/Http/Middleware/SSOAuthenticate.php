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
        else if (SSO::check()) {
            try {
                $userData = SSO::getUser();
            }
            catch (Exception $e) {
                SSO::logout();
            }
            if (substr($userData->npm, 0, 2) === "15" && $userData->faculty === "ILMU KOMPUTER") {
                $request->session()->put('sso', json_encode(SSO::getUser()));

                if (Auth::guard($guard)->attempt(['username' => $userData->username, 'password' => ''])) {
                    return $next($request);
                }
                else {
                    $id = DB::table('users')->insertGetId([
                        'username' => $userData->username,
                    ]);

                    // Create folder for user
                    Storage::makeDirectory('users/'.$id);

                    Auth::guard($guard)->loginUsingId($id);
                    return $next($request);
                }
            }

            return abort(401);
        }
        else {
            SSO::authenticate();
        }
    }
}
