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

    .author {
        color: #3B8EE3 !important;
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
@endsection

@section('content')
    <article class="thread">
        <div class="container">
            <header>
                <h3><a href="/profile/{{ $thread->author_id }}" class="author">{{ $users[$thread->author_id - 1]->username }}</a></h3>
                <time>{{ $thread->created_at }}</time>
            </header>
            <main>
                <header>
                    <h1>{{ $thread->title }}</h1>
                </header>

                <article>
                    {!! $thread->content !!}
                </article>
            </main>
            <footer>
                <span class="label"><a href="/thread/{{ $thread->id }}/reply">CUAPIN</a></span>
                <div>
                    <span class="label">{{ $thread->comment_count }} Cuap</span>
                    <span class="label label-green"><a href="/category/{{ $thread->category_id }}">{{ $categories[$thread->category_id - 1]->name }}</a></span>
                </div>
                <div>
                    <span class="label label-green"><a href="#">▴</a></span>
                    <span class="{{ $thread->upvote >= 0 ? "positive" : "negative" }}">{{ $thread->upvote }}</span>
                    <span class="label label-red"><a href="#">▾</a></span>
                </div>

            </footer>
        </div>
    </article>

    <header>
        <h3>999 CUAP</h3>
    </header>

    @foreach ($replies as $reply)
         <article class="reply">
            <div class="container">
                <header>
                     <a class="author" href="/profile/{{ $reply->user_id }}">{{ $users[$reply->user_id - 1]->username }}</a>
                    <span>Pada <time>{{ $reply->updated_at }}</time></span>
                </header>
                <main>
                    {!! $reply->content !!}
                </main>
                <footer>
                    <span class="label"><a href="/thread/{{ $thread->id }}/{{ $reply->id }}/reply">CUAPIN</a></span>
                    <div>
                        <span class="label label-green"><a href="#">▴</a></span>
                        <span class="{{ $reply->upvote >= 0 ? "positive" : "negative" }}">{{ $reply->upvote }}</span>
                        <span class="label label-red"><a href="#">▾</a></span>
                    </div>
                </footer>
            </div>
        </article>
    @endforeach

    <div class="pagination wrapper wrapper-fluid">
        {!! $replies->links() !!}
    </div>
@endsection