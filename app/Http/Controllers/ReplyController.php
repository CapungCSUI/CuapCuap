<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class ReplyController extends Controller
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
     * @param  int  $thread_id
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $thread_id, $parent_id = 0)
    {
        $user = Auth::user();
        $child_replies = $request->input('child_replies');
        $content = $request->$file('content');

        DB::table('replies')->insert([
            'parent_id' => $parent_id, 
            'child_replies' => $child_replies,
            'content' =>  $content,
            'user_id' =>  $user_id,
            'thread_id' =>  $thread_id,
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
        //
        $thread_id = $request->input('thread_id');
        $user_id = $request->input('user_id');
        $parent_id = $request->input('parent_id');
        $child_replies = $request->input('child_replies');
        $content = $request->$file('content');


        DB::table('replies')

            ->where('id', $id)
            ->update([
            'parent_id' => $parent_id, 
            'child_replies' => $child_replies,
            'content' =>  $content,
            'user_id' =>  $user_id,
            'thread_id' =>  $thread_id,
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
        //
        DB::table('replies')->where('id', $id)->delete();

    }
}
