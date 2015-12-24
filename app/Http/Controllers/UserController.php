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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $username = $request->input('username');
         $birthday = $request->input('birthday');
         $profile_picture = $request->$file('profile_picture');

        DB::table('users')->insert([
            'username' => $username, 
            'birthday' => $birthday,
            'profile_picture' =>  $profile_picture
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'profile_picture' => Auth::user()->profile_picture,
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

        $image = $request->file('profile_picture');
        if ($image->isValid()) {
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
