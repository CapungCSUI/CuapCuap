<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Auth;
use DB;

class VoteController extends Controller
{
    /**
     * Upvote thread
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upvoteThread($id)
    {
        $author = DB::table('threads')->select('author_id')->where('id', $id)->first();

        if ($author == null || $author->author_id == Auth::user()->id) {
            return redirect()->back();
        }
        $author = $author->author_id;

        $votedThreads = Auth::user()->voted_threads;
        $needle = '|' . $id . ':';
        $pos = strpos($votedThreads, $needle);
        $thanks = 0;

        if ($pos === false) {
            $votedThreads = $votedThreads . $id . ':2|';
            DB::table('threads')->where('id', $id)->increment('upvote');
            DB::table('users')->where('id', Auth::user()->id)->update([
                'voted_threads' => $votedThreads,
            ]);

            $thanks = 1;
        }
        else {
            $pos = strpos($votedThreads, ':', $pos);
            $pos = $pos + 1;
            $stat = $votedThreads[$pos];

            if ($stat == '2') {
                $votedThreads[$pos] = '1';
                DB::table('threads')->where('id', $id)->decrement('upvote');
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_threads' => $votedThreads,
                ]);

                $thanks = -1;
            }
            else if ($stat == '1') {
                $votedThreads[$pos] = '2';
                DB::table('threads')->where('id', $id)->increment('upvote');
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_threads' => $votedThreads,
                ]);

                $thanks = 1;
            }
            else if ($stat == '0') {
                $votedThreads[$pos] = '2';
                DB::table('threads')->where('id', $id)->increment('upvote', 2);
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_threads' => $votedThreads,
                ]);

                $thanks = 2;
            }
        }

        if ($thanks < 0) {
            DB::table('users')->where('id', $author)->decrement('exp', -$thanks);
        }
        else if ($thanks > 0) {
            DB::table('users')->where('id', $author)->increment('exp', $thanks);
        }

        return redirect()->back();
    }

    /**
     * Downvote thread
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downvoteThread($id)
    {
        $author = DB::table('threads')->select('author_id')->where('id', $id)->first();
        if ($author == null || $author->author_id == Auth::user()->id) {
            return redirect()->back();
        }
        $author = $author->author_id;
        
        $votedThreads = Auth::user()->voted_threads;
        $needle = '|' . $id . ':';
        $pos = strpos($votedThreads, $needle);
        $thanks = 0;

        if ($pos === false) {
            $votedThreads = $votedThreads . $id . ':0|';
            DB::table('threads')->where('id', $id)->decrement('upvote');
            DB::table('users')->where('id', Auth::user()->id)->update([
                'voted_threads' => $votedThreads,
            ]);
            $thanks = -1;
        }
        else {
            $pos = strpos($votedThreads, ':', $pos);
            $pos = $pos + 1;
            $stat = $votedThreads[$pos];

            if ($stat == '2') {
                $votedThreads[$pos] = '0';
                DB::table('threads')->where('id', $id)->decrement('upvote', 2);
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_threads' => $votedThreads,
                ]);

                $thanks = -2;
            }
            else if ($stat == '1') {
                $votedThreads[$pos] = '0';
                DB::table('threads')->where('id', $id)->decrement('upvote');
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_threads' => $votedThreads,
                ]);

                $thanks = -1;
            }
            else if ($stat == '0') {
                $votedThreads[$pos] = '1';
                DB::table('threads')->where('id', $id)->increment('upvote');
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_threads' => $votedThreads,
                ]);

                $thanks = 1;
            }
        }

        if ($thanks < 0) {
            DB::table('users')->where('id', $author)->decrement('exp', -$thanks);
        }
        else if ($thanks > 0) {
            DB::table('users')->where('id', $author)->increment('exp', $thanks);
        }

        return redirect()->back();
    }

    /**
     * Upvote reply
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upvoteReply($id)
    {
        $author = DB::table('replies')->select('user_id')->where('id', $id)->first();
        if ($author == null || $author->user_id == Auth::user()->id) {
            return redirect()->back();
        }
        $author = $author->user_id;
        
        $votedReplies = Auth::user()->voted_replies;
        $needle = '|' . $id . ':';
        $pos = strpos($votedReplies, $needle);
        $thanks = 0;

        if ($pos === false) {
            $votedReplies = $votedReplies . $id . ':2|';
            DB::table('replies')->where('id', $id)->increment('upvote');
            DB::table('users')->where('id', Auth::user()->id)->update([
                'voted_replies' => $votedReplies,
            ]);

            $thanks = 1;
        }
        else {
            $pos = strpos($votedReplies, ':', $pos);
            $pos = $pos + 1;
            $stat = $votedReplies[$pos];

            if ($stat == '2') {
                $votedReplies[$pos] = '1';
                DB::table('replies')->where('id', $id)->decrement('upvote');
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_replies' => $votedReplies,
                ]);

                $thanks = -1;
            }
            else if ($stat == '1') {
                $votedReplies[$pos] = '2';
                DB::table('replies')->where('id', $id)->increment('upvote');
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_replies' => $votedReplies,
                ]);

                $thanks = 1;
            }
            else if ($stat == '0') {
                $votedReplies[$pos] = '2';
                DB::table('replies')->where('id', $id)->increment('upvote', 2);
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_replies' => $votedReplies,
                ]);

                $thanks = 2;
            }
        }

        if ($thanks < 0) {
            DB::table('users')->where('id', $author)->decrement('exp', -$thanks);
        }
        else if ($thanks > 0) {
            DB::table('users')->where('id', $author)->increment('exp', $thanks);
        }

        return redirect()->back();
    }

    /**
     * Downvote reply
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downvoteReply($id)
    {
        $author = DB::table('replies')->select('user_id')->where('id', $id)->first();
        if ($author == null || $author->user_id == Auth::user()->id) {
            return redirect()->back();
        }
        $author = $author->user_id;

        $votedReplies = Auth::user()->voted_replies;
        $needle = '|' . $id . ':';
        $pos = strpos($votedReplies, $needle);
        $thanks = 0;

        if ($pos === false) {
            $votedReplies = $votedReplies . $id . ':0|';
            DB::table('replies')->where('id', $id)->decrement('upvote');
            DB::table('users')->where('id', Auth::user()->id)->update([
                'voted_replies' => $votedReplies,
            ]);

            $thanks = -1;
        }
        else {
            $pos = strpos($votedReplies, ':', $pos);
            $pos = $pos + 1;
            $stat = $votedReplies[$pos];

            if ($stat == '2') {
                $votedReplies[$pos] = '0';
                DB::table('replies')->where('id', $id)->decrement('upvote', 2);
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_replies' => $votedReplies,
                ]);

                $thanks = -2;
            }
            else if ($stat == '1') {
                $votedReplies[$pos] = '0';
                DB::table('replies')->where('id', $id)->decrement('upvote');
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_replies' => $votedReplies,
                ]);

                $thanks = -1;
            }
            else if ($stat == '0') {
                $votedReplies[$pos] = '1';
                DB::table('replies')->where('id', $id)->increment('upvote');
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'voted_replies' => $votedReplies,
                ]);

                $thanks = 1;
            }
        }

        if ($thanks < 0) {
            DB::table('users')->where('id', $author)->decrement('exp', -$thanks);
        }
        else if ($thanks > 0) {
            DB::table('users')->where('id', $author)->increment('exp', $thanks);
        }

        return redirect()->back();
    }
}
