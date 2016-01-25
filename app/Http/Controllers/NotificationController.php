<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $users = DB::table('users')->select('username')->orderBy('id', 'asc')->get();
        $threads = DB::table('threads')->select('title')->orderBy('id', 'asc')->get();

        $notifications = DB::table('notifications')
            ->where('user_id', $user_id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('show_notifications', [
            'notifications' => $notifications,
            'users' => $users,
            'threads' => $threads,
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
        $user_id = Auth::user()->id;

        $notification = DB::table('notifications')->where('id', $id)->first();
        if ($notification == null) {
            abort(404);
        }

        $author_id = $notification->user_id;
        if ($author_id != $user_id) {
            abort(401);
        }

        NotificationController::destroy($id);

        if ($notification->type == 0) {
            return redirect()->action('MessageController@show', ['id' => $notification->content_id]);
        }
        else if ($notification->type == 1) {
            $thread = DB::table('threads')->where('id', $notification->content_id)->first();
            if ($thread == null) {
                abort(404);
            }

            return redirect()->action('ThreadController@show', [
                'id' => $notification->content_id, 
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = DB::table('notifications')->where('id', $id)->first();
        if ($notification == null) {
            abort(404);
        }

        $author_id = $notification->user_id;
        if ($author_id != Auth::user()->id) {
            abort(401);
        }

        DB::table('notifications')
            ->where('id', $id)
            ->update([
                'is_read' => true,
            ]);

        return redirect('/notifications');
    }
}
