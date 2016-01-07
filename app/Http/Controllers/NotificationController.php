<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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

        $notifications = DB::table('notifications')
            ->where('id', $user_id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('show_notifications', [
            'notifications' => $notifications,
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

        $author_id = $notification->author_id;
        if ($author_id != $user_id) {
            abort(401);
        }

        destroy($id);

        if ($notification->type == 0) {
            return redirect()->action('MessageController@show', ['id' => $notification->content_id]);
        }
        else if ($notification->type == 1) {
            return redirect()->action('ReplyController@show', ['id' => $notification->content_id]);
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

        $author_id = $notification->author_id;
        if ($author_id != Auth::user()->id) {
            abort(401);
        }

        DB::table('notifications')
            ->where('id', $id)
            ->update([
                'is_read' => true,
            ]);
    }
}
