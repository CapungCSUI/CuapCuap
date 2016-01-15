<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = DB::table('announcements')
            ->where('is_deleted', false)
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        return view('show_announcements', [
            'announcements' => $announcements,
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
        $announcement = DB::table('announcements')->where('id', $id)->first();

        if ($announcement == null) {
            abort(404);
        }

        return view('show_announcement', [
            'announcement' => $announcement,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_announcement');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'content' => 'string|required',
        ]);

        $title = $request->input('title');
        $content = $request->input('content');

        DB::table('announcements')->insert([
            'title' => $title,
            'content' => $content,
        ]);

        return redirect('/announcements');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = DB::table('announcements')->where('id', $id)->first();

        if ($announcement == null) {
            abort(404);
        }
        
        return view('edit_announcement', [
            'announcement' => $announcement,
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
        $announcement = DB::table('announcements')->where('id', $id)->first();
        if ($announcement == null) {
            abort(404);
        }

        $this->validate($request, [
            'title' => 'string|required',
            'content' => 'string|required',
        ]);

        $title = $request->input('title');
        $content = $request->input('content');
        
        DB::table('announcements')
            ->where('id', $id)
            ->update([
                'title' => $title,
                'content' => $content,
            ]);

        return redirect('/announcements');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = DB::table('announcements')->where('id', $id)->first();
        if ($announcement == null) {
            abort(404);
        }

        DB::table('announcements')->where('id', $id)->update([
            'is_deleted' => true,
        ]);

        return redirect('/announcements');
    }
}
