<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  string  $category
     * @return \Illuminate\Http\Response
     */
    public function index($category = 'new')
    {
        if ($category === 'hot') {
            $threads = DB::table('threads')->orderBy('upvote', 'desc')->orderBy('updated_at', 'desc')->get();
        }
        else if ($category === 'new') {
            $threads = DB::table('threads')->orderBy('updated_at', 'desc')->get();
        }
        else {
            $category_id = DB::table('categories')->where('name', $category)->first()->id;
            $threads = DB::table('threads')->where('category_id', $category_id)->get();
        }
        
        return view('show_threads', [
            'threads' => $threads,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->get();

        return view('create_thread', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoriesCount = DB::table('categories')->count();
        $this->validate($request, [
            'category_id' => 'between:1,'.$categoriesCount,
            'title' => 'string',
            'content' => 'string',
            'tags' => 'string',
            'sticky' => 'boolean',
        ]);

        $author_id = Auth::user()->id;
        $category_id = $request->input('category_id');
        $title = $request->input('title');
        $sticky = $request->input('sticky');
        $tags = $request->input('tags');
        $content = $request->input('content');

        DB::table('threads')->insert([
            'title' => $title, 
            'sticky' => $sticky,
            'content' => $content,
            'author_id' => $author_id,
            'category_id' => $category_id,
            'tags' => $tags,
        ]);

        return redirect('/home');
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
        if ($thread == null) {
            abort(404);
        }
        $replies = DB::table('replies')->where('thread_id', $thread->id)->orderBy('position', 'asc')->get();

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
        $thread = DB::table('threads')->where('id', $id)->first();
        if ($thread == null) {
            abort(404);
        }
        if ($thread->author_id != Auth::user()->id) {
            abort(401);
        }
        
        $categories = DB::table('categories')->get();

        return view('edit_thread', [
            'thread' => $thread,
            'categories' => $categories,
        ]);
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
        $thread = DB::table('threads')->where('id', $id)->first();
        if ($thread == null) {
            abort(401);
        }

        $author_id = $thread->author_id;
        if ($author_id != Auth::user()->id) {
            abort(401);
        }

        $categoriesCount = DB::table('categories')->count();

        $this->validate($request, [
            'category_id' => 'between:1,'.$categoriesCount,
            'title' => 'string',
            'content' => 'string',
            'tags' => 'string',
            'sticky' => 'boolean',
        ]);

        $category_id = $request->input('category_id');
        $title = $request->input('title');
        $sticky = $request->input('sticky');
        $tags = $request->input('tags');
        $content = $request->input('content');

        DB::table('threads')
            ->where('id', $id)
            ->update([
                'title' => $title, 
                'sticky' => $sticky,
                'content' => $content,
                'category_id' => $category_id,
                'tags' => $tags,
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
        $thread = DB::table('threads')->where('id', $id)->first();
        if ($thread == null) {
            abort(401);
        }

        $author_id = $thread->author_id;
        if ($author_id != Auth::user()->id) {
            abort(401);
        }

        DB::table('replies')->where('thread_id', $id)->delete();
        DB::table('threads')->where('id', $id)->delete();

        return redirect('/home');
    }
}
