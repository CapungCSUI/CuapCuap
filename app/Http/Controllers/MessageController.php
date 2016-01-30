<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  receiver_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $receiver_id)
    {
        $sender_id = Auth::user()->id;

        $receiver = DB::table('users')->where('id', $receiver_id)->first();
        if ($receiver == null) {
            abort(404);
        }

        // Validation
        $this->validate($request, [
            'content' => 'string|required',
        ]);

        $content = $request->input('content');

        DB::table('messages')->insert([
            'sender_id' =>  $sender_id,
            'receiver_id' =>  $receiver_id,
            'content' =>  $content,
        ]);

        DB::table('notifications')->insert([
            'type' => 0,
            'user_id' => $receiver_id,
            'content_id' => $sender_id,
        ]);

        return redirect('/messages/'.$receiver_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $receiver_id
     * @return \Illuminate\Http\Response
     */
    public function show($receiver_id)
    {
        $sender_id = Auth::user()->id;

        if ($receiver_id == $sender_id) {
            abort(404);
        }
        
        $receiver = DB::table('users')->where('id', $receiver_id)->first();
        if ($receiver == null) {
            abort(404);
        }

        $messages = DB::table('messages')
            ->where(function ($query) use ($sender_id, $receiver_id) {
                $query->where('receiver_id', $receiver_id)
                      ->where('sender_id', $sender_id);
            })
            ->orWhere(function ($query) use ($sender_id, $receiver_id) {
                $query->where('receiver_id', $sender_id)
                      ->where('sender_id', $receiver_id);
            })
            ->orderBy('created_at', 'asc')
            ->paginate(8);

        return view('show_messages', [
            'receiver' => $receiver,
            'messages' => $messages,
        ]);
    }
}
