@extends('layouts.master')

@section('title', 'Thread ' . $thread->id)

@section('internal-css')
    @parent

    .thread .statusbar {
        font-size: 0.8em; 
    }

    .thread .author, .reply .author {
        color: blue;
    }

    .thread .author:hover, .reply .author:hover {
        text-decoration: underline;
    }

    .thread .author:active, .reply .author:active {
        color: #A2F;
    }

    .thread .content {
        font-size: 0.8em; 
        text-align: justify; 
        border: 1px solid black; 
        padding: 1em; 
        margin: 0.5em 0; 
        line-height: 1.5em;
    }

    .reply-button:active {
        background: blue;
        color: white;
    }

    .status-button:active {
        background: green;
        color: white;
    }

    .thread .reply-button {
        float: left;
        padding: 0em 1.2em; 
        border: 1px solid blue; 
        font-size: 0.8em; 
        font-family: Calibri;
    }

    .thread .status-button {
        float: right;
        margin: 0 0.25em;
        padding: 0 1.2em; 
        border: 1px solid green; 
        font-size: 0.8em; 
        font-family: Calibri;
    }

    .reply {
        font-size: 0.8em;
    }

    .reply .reply-time {
        font-size: 0.8em;
    }

    .reply .reply-time span {
        color: yellow;
    }

    .reply .reply-button {
        font-size: 0.8em;
        padding: 0.3em 1.2em; 
        border: 1px solid blue; 
        font-family: Calibri;
    }

    .reply .content {
        text-align: justify; 
        line-height: 1.5em; 
        margin-bottom: 0.3em;
    }

    .reply hr {
        height:1px;
        border:none;
        color:black;
        background-color:black;" 
    }

    .reply .vote {
        position: relative; 
        bottom: 0.25em; 
        left: 1.5em;
    }
@endsection

@section('content')
    <article class="row thread">
        <div class="col-2 text-center rate vote">
            <div class="wrapper wrapper-fluid">
                <a href="#upvote">
                    <svg style="width:48;height:48" viewBox="0 0 24 24">
                        <path fill="#3B8EE3" d="M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z" />
                    </svg>
                </a>
            </div>
            <span class="wrapper wrapper-fluid {{ $thread->upvote >= 0 ? "positive" : "negative" }}">
                {{ $thread->upvote }}
            </span>
            <div class="wrapper wrapper-fluid">
                <a href="#downvote">
                    <svg style="width:48;height:48" viewBox="0 0 24 24">
                        <path fill="#E33B3B" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="col-10">
            {{ $thread->title }}
            <div class="statusbar">
                oleh <a href="/profile/{{ $thread->author_id }}" class="author">{{ $users[$thread->author_id - 1]->username }}</a>
                <span style="color: gray; float: right;">{{ $thread->created_at }}</span>
            </div>
            <div class="content">
                {!! $thread->content !!}
            </div>
            <div>
                <span class="reply-button"><a href="/thread/{{ $thread->id }}/reply">CUAPIN</a></span>
                <span class="status-button"><a href="/category/{{ $thread->category_id }}">{{ $categories[$thread->category_id - 1]->name }}</a></span>
                <span class="status-button">{{ $thread->comment_count }} Cuap</span>
            </div>
            <div style="clear:both; background: #3c90e6; margin-top: 3em; height: 2px;"></div>
        </div>                  
    </article>

    @foreach ($replies as $reply)
        <article class="row reply">
            <div class="col-2 text-center rate vote">
                <div class="wrapper wrapper-fluid">
                    <a href="#upvote">
                        <svg style="width:35;height:35" viewBox="0 0 24 24">
                            <path fill="#3B8EE3" d="M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z" />
                        </svg>
                    </a>
                </div>
                <span class="wrapper wrapper-fluid {{ $reply->upvote >= 0 ? "positive" : "negative" }}">
                    {{ $reply->upvote }}
                </span>
                <div class="wrapper wrapper-fluid">
                    <a href="#downvote">
                        <svg style="width:35;height:35" viewBox="0 0 24 24">
                            <path fill="#E33B3B" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-10">
                <a class="author" href="/profile/{{ $reply->user_id }}">{{ $users[$reply->user_id - 1]->username }}</a>
                <!--<div class="reply-time"><span>5 menit</span> yang lalu </div>-->
                <div class="reply-time">Pada <span>{{ $reply->updated_at }}</span></div>
                <hr />
                <div class="content">
                    {!! $reply->content !!}
                </div>
                <span class="reply-button">
                    <a href="/thread/{{ $thread->id }}/{{ $reply->id }}/reply">CUAPIN</a>
                </span>
            </div>
        </article>
    @endforeach
    <div class="col-left-2 col-10" style="text-align:center; margin-top: 1.5em; margin-bottom: 1.5em;">
        {!! $replies->links() !!}
    </div>
@endsection