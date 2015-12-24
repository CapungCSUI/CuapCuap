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
            $userData = SSO::getUser();
            if (substr($userData->npm, 0, 2) === "15" && $userData->faculty === "ILMU KOMPUTER") {
                // die('asdfasdf');
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

                    // Create voted_threads and voted_replies
                    Storage::put('users/'.$id.'/voted_threads.txt','');
                    Storage::put('users/'.$id.'/voted_replies.txt','');

                    Auth::guard($guard)->loginUsingId($id);
                    return $next($request);
                }
            }

            return response('Unauthorized.', 401);
        }
        else {
            SSO::authenticate();
        }
    }
}
