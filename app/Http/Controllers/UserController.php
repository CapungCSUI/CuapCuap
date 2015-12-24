<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SSO\SSO;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $username = $request->input('username');
        $birthday = $request->input('birthday');
        $profile_picture = $request->$file('profile_picture');

        DB::table('users')
            ->where('id', $id)
            ->update([
                'username' => $username,
                'birthday' => $birthday,  
                'profile_picture' =>  $profile_picture  
            ]);
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
