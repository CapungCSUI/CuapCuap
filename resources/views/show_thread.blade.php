@extends('layouts.master')

@section('title', 'Thread ' . $thread->id)

@section('internal-css')
    @parent
    .content article {
        margin-bottom: 1em; 
    }

    .nested-1 {
        padding-left: 1em;
    }

    .nested-2 {
        padding-left: 2em;
    }

    .nested-3 {
        padding-left: 3em;
    }

    .nested-4 {
        padding-left: 4em;
    }

    .nested-5 {
        padding-left: 5em;
    }

    .thread main, .reply main {
        text-align: justify;
    }

    .reply {
        font-size: 0.8em;
    }

    time {
        font-style: italic;
    }

    .container {

    }

    .container footer {
        vertical-align: center;
        height: 2.5em;
    }

    .container-1 header, .container-1 footer {
        background: #3c90e6;
        color: white;
    }

    .container-1 {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); 
        margin-bottom: 2.35em;
    }

    .container-1 .positive {
        color: white;
    }

    .title {
        font-size: 1.6em;
        text-align: center;
        margin: 0.2em 0 0.5em 0;
    }

    .horizontal-line {
        height: 1px;
        background: #878787;
        margin: 0.5em 0 1em 0;
    }

@endsection

@section('content')
    <article class="thread">
        <div class="container container-1">
            <header>
                <h3><a href="/profile/{{ $thread->author_id }}" class="author">{{ $users[$thread->author_id - 1]->username }}</a></h3>
                <time>{{ $thread->created_at }}</time>
            </header>
            <main>
                <div class="title">{{ $thread->title }}</div>
                <div class="horizontal-line"></div>
                <article>
                    {!! $thread->content !!}
                </article>
            </main>
            <footer>
                <div>
                    <span class="label"><a href="/thread/{{ $thread->id }}/reply">CUAPIN</a></span>
                </div>
                <div>
                    <span class="label">{{ $thread->comment_count }} Cuap</span>
                    <span class="label label-green"><a href="/category/{{ $thread->category_id }}">{{ $categories[$thread->category_id - 1]->name }}</a></span>
                </div>
                <div>
                    <span class="label label-green"><a href="/thread/{{ $thread->id }}/upvote">▴</a></span>
                    <span class="{{ $thread->upvote >= 0 ? "positive" : "negative" }}">{{ $thread->upvote }}</span>
                    <span class="label label-red"><a href="/thread/{{ $thread->id }}/downvote">▾</a></span>
                </div>

            </footer>
        </div>
    </article>

    @foreach ($replies as $reply)
         <article class="reply">
            <div class="container container-2 {{ $reply->depth > 0 ? "col-left-" . $reply->depth : "" }} ">
                <header>
                     <a class="author" href="/profile/{{ $reply->user_id }}">{{ $users[$reply->user_id - 1]->username }}</a>
                    <span><time>{{ $reply->updated_at }}</time></span>
                </header>
                <main>
                    {!! $reply->content !!}
                </main>
                <footer>
                    <div>
                        <span class="label"><a href="/thread/{{ $thread->id }}/{{ $reply->id }}/reply">CUAPIN</a></span>
                    </div>
                    <div>
                        <span class="label label-green"><a href="/reply/{{ $reply->id }}/upvote">▴</a></span>
                        <span class="{{ $reply->upvote >= 0 ? "positive" : "negative" }}">{{ $reply->upvote }}</span>
                        <span class="label label-red"><a href="/reply/{{ $reply->id }}/downvote">▾</a></span>
                    </div>
                </footer>
            </div>
        </article>
    @endforeach

    <div class="pagination wrapper wrapper-fluid">
        {!! $replies->links() !!}
    </div>
@endsection