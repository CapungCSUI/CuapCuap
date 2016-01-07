<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Auth;
use DB;

class ReplyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $thread_id
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function create($thread_id, $parent_id = 0)
    {
        $thread = DB::table('threads')->where('id', $thread_id)->first();
        $parentReply = DB::table('replies')->where('id', $parent_id)->first();

        if ($thread == null) {
            abort(404);
        }    
        if ($parent_id != 0 && ($parentReply == null || $thread_id != $parentReply->thread_id)) {
            abort(404);
        }

        return view('create_reply', [
            'thread' => $thread,
            'parentReply' => $parentReply,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $thread_id
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $thread_id, $parent_id = null)
    {
        $user_id = Auth::user()->id;
        $position = '';
        $depth = 0;

        $thread = DB::table('threads')->where('id', $thread_id)->first();
        if ($thread == null) {
            abort(404);
        }

        if ($parent_id != null) {
            $parent = DB::table('replies')->where('id', $parent_id)->first();
            
            if ($parent == null || $parent->thread_id != $thread_id) {
                abort(404);
            }

            $position = $parent->position;
            $depth = $parent->depth + 1;
        }

        // Validation
        $this->validate($request, [
            'content' => 'string|required',
        ]);

        $content = $request->input('content');

        $id = DB::table('replies')->insertGetId([
            'thread_id' =>  $thread_id,
            'user_id' =>  $user_id,
            'parent_id' => $parent_id, 
            'content' =>  $content,
            'depth' => $depth,
        ]);

        $position = $position . Helper::appendZero($id, 5) . ',';
        DB::table('replies')->where('id', $id)->update([
            'position' => $position,
        ]);

        DB::table('threads')->where('id', $thread_id)->increment('comment_count');
        DB::table('users')->where('id', $user_id)->increment('comment_count');

        $author_id = DB::table('threads')->where('id', $thread_id)->first()->author_id;
        DB::table('notifications')->insert([
            'type' => 1,
            'user_id' => $author_id,
            'content_id' => $count,
        ]);

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $thread_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $thread_id = null)
    {
        $reply = DB::table('replies')->where('id', $id)->first();
        if ($reply == null) {
            abort(404);
        }

        if ($thread_id == null) {
            $thread_id = $reply->thread_id;
        }

        $thread = DB::table('threads')->where('id', $reply->thread_id)->first();
        if ($thread == null || $reply->thread_id != $thread_id) {
            abort(404);
        }

        $replies = DB::table('replies')
            ->where('thread_id', $thread->id)
            ->where('position', 'like', $reply->position . '%')
            ->orderBy('position', 'asc')
            ->get();

        return view('show_reply', [
            'startDepth' => $reply->depth,
            'thread' => $thread,
            'replies' => $replies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $thread_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($thread_id, $id)
    {
        $user_id = Auth::user()->id;
        $reply = DB::table('replies')->where('id', $id)->first();
        if ($reply == null || $thread_id != $reply->thread_id) {
            abort(404);
        }
        if ($reply->user_id != $user_id) {
            abort(401);
        }

        $thread = DB::table('threads')->where('id', $reply->thread_id)->first();
        $parentReply = DB::table('replies')->where('id', $reply->parent_id)->first();

        return view('edit_reply', [
            'reply' => $reply,
            'thread' => $thread,
            'parentReply' => $parentReply,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $thread_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $thread_id, $id)
    {
        $reply = DB::table('replies')->where('id', $id)->first();
        if ($reply == null || $thread_id != $reply->thread_id) {
            abort(404);
        }

        $user_id = Auth::user()->id;
        if ($reply->user_id != $user_id) {
            abort(401);
        }

        // Validation
        $this->validate($request, [
            'content' => 'string|required',
        ]);

        $content = $request->input('content');

        DB::table('replies')->where('id', $id)->update([
            'content' => $content,
        ]);

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $thread_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread_id, $id)
    {
        $reply = DB::table('replies')->where('id', $id)->first();
        if ($reply == null || $thread_id != $reply->thread_id) {
            abort(404);
        }

        $user_id = Auth::user()->id;
        if ($reply->user_id != $user_id) {
            abort(401);
        }

        DB::table('replies')->where('id', $id)->update([
            'is_deleted' => true,
        ]);

        return redirect('/home');
    }
}
