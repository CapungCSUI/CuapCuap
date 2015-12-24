<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SSO\SSO;
use Auth;
use DB;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show user related resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResource($id = 0, $filename)
    {
        if ($id == 0) {
            $id = $user->id;
        }

        if (DB::table('users')->where('id',$id)->first() == null) {
            return response('Unauthorized', 401);
        }
        $file = 'users/' . $id . '/' . $filename;

        if (!Storage::has($file)) {
            return response('Unauthorized', 401);
        }

        $mimeType = Storage::mimeType($file);
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

        $profile_picture = 'users/'.$id.'/'.$user->profile_picture;

        return view('show_profile', [
            'username' => $user->username,
            'birthday' => $user->birthday,
            'email' => $user->email,
            'profile_picture' => url($profile_picture),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('edit_profile', [
            'birthday' => Auth::user()->birthday,
            'email' => Auth::user()->email,
            'profile_picture' => '',
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

        $birthday = $request->input('birthday');
        $birthday = date('Y-m-d', strtotime($birthday));
        $email = $request->input('email');

        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            $image = $request->file('profile_picture');
            if (isset($user->profile_picture)) {
                Storage::delete('users/'.$user->id.'/'.$user->profile_picture);
            }
            $image->move(storage_path().'/app/users/'.$user->id, $image->getClientOriginalName());
            $profile_picture = $image->getClientOriginalName();
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

        return redirect('/home');
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
    }

    /**
     * Logout the user and delete all sessions.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if (!$request->session()->has('sso')) {
            SSO::logout();
        }
        
        $request->session()->flush();
        
        return redirect('logout');
    }
}
