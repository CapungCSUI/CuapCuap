<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use SSO\SSO;
use Auth;
use DB;
use Storage;
use Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->paginate(3);

        foreach ($users as &$user) {
            $user->profile_picture = Helper::getUserResource($user->profile_picture, $user->id);
        }

        return view('show_profiles', [
            'users' => $users,
        ]);
    }

    /**
     * Show user related resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResource($id = 0, $filename)
    {
        if ($id == 0) {
            $id = Auth::user()->id;
        }

        if (DB::table('users')->where('id', $id)->first() == null) {
            return abort(401);
        }
        $file = 'users/' . $id . '/' . $filename;

        if (!Storage::has($file)) {
            return abort(404);
        }

        $mimeType = Storage::mimeType($file);
        if (!Helper::startsWith($mimeType, 'image/')) {
            return abort(404);
        }

        $file = Storage::get($file);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $mimeType);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        if ($id == 0) {
            $id = Auth::user()->id;
        }

        $user = DB::table('users')->where('id', $id)->first();
        if ($user == null) {
            return abort(401);
        }

        if ($user->profile_picture !== null) {
            $user->profile_picture = Helper::getUserResource($user->profile_picture, $user->id);
        }

        return view('show_profile', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('edit_profile', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'email' => 'email',
            'birthday' => 'date',
            'profile_picture' => 'image|max:10000',
        ]);

        $birthday = $request->input('birthday');
        $birthday = date('Y-m-d', strtotime($birthday));

        $email = $request->input('email');

        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            $image = $request->file('profile_picture');
            if (isset($user->profile_picture)) {
                Storage::delete('users/'.$user->id.'/'.$user->profile_picture);
            }

            $profile_picture = $image->getClientOriginalName();
            $image->move(storage_path().'/app/users/'.$user->id, $profile_picture);
        }
        else {
            $profile_picture = $user->profile_picture;
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'email' => $email,
                'birthday' => $birthday,  
                'profile_picture' =>  $profile_picture,
            ]);

        return redirect('/profile/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect('/profiles');
    }

    /**
     * Login the user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return redirect('/home');
    }

    /**
     * Logout the user and delete all sessions.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if (!$request->session()->has('sso') && !Auth::check()) {
            SSO::logout();
        }
        
        Auth::logout();
        $request->session()->flush();
        
        return redirect('/logout');
    }
}
