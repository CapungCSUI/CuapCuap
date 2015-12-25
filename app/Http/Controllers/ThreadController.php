<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ThreadController extends Controller
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
        $category_id = $request->input('category_id');
        $author_id = $request->input('author_id');
        $title = $request->input('title');
        $sticky = $request->input('sticky');
        $tags = $request->input('tags');
        $content = $request->$file('content');


        DB::table('threads')->insert([
            'title' => $title, 
            'sticky' => $sticky,
            'content' =>  $content,
            'author_id' =>  $author_id,
            'category_id' =>  $category_id,
            'tags' =>  $tags,
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
        $thread = DB::table('threads')->where('id', $id)->first();

        $initialReplies = DB::table('replies')->where('thread_id', $id)->whereNull('parent_id')->get();

        $stack = array();
        $replies = array();

        foreach ($initialReplies as $reply) {
            $stack[] = array($reply, 0);

            while (!empty($stack)) {
                $lastElement = end($stack);
                $key = key($stack);
                $child_replies = $lastElement[0]->child_replies;
                $pos = $lastElement[1];

                if ($pos == 0) {
                    $lastElement[0]->depth = $key;
                    $replies[] = $lastElement[0];
                }

                if ($pos >= strlen($child_replies)) {
                    array_pop($stack);
                    continue;
                }
                else {
                    $idx = strpos($child_replies, ',', $pos);

                    if (!$idx) {
                        $idx = strlen($child_replies);
                    }

                    $nextId = substr($child_replies, $pos, $idx - $pos);
                    $stack[$key][1] = $idx + 1;

                    $nextReply = DB::table('replies')->where('id', $nextId)->first();
                    $stack[] = array($nextReply, 0);
                }
            }
        }

        return view('show_thread', [
            'thread' => $thread,
            'replies' => $replies,
        ]);
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
        $category_id = $request->input('category_id');
        $author_id = $request->input('author_id');
        $title = $request->input('title');
        $sticky = $request->input('sticky');
        $tags = $request->input('tags');
        $content = $request->$file('content');


        DB::table('threads')

            ->where('id', $id)
            ->update([
            'title' => $title, 
            'sticky' => $sticky,
            'content' =>  $content,
            'author_id' =>  $author_id,
            'category_id' =>  $category_id,
            'tags' =>  $tags
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
        DB::table('threads')->where('id', $id)->delete();

    }
}
