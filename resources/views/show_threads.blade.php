@extends('layouts.master')

@section('title', $category)

@section('internal-css')
    @parent
    

    .thread-link:hover {
        text-decoration: underline;
    }

    .thread-link:active {
        color: #A2F;
    }


@endsection

@section('content')
    @foreach ($threads as $thread)
    <article class="row thread">
        <div class="col-xs-3 col-md-2 text-center">
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
        <div class="col-xs-9 col-md-10">
            <a class="thread-link" href="/thread/{{ $thread->id }}"><p>{{ $thread->title }}</p></a>
            <div>
                @if ($thread->sticky == true)
                <span class="label label-red">Sticky</span>
                @endif
                <span class="label label-green"><a href="/category/{{ $thread->category_id }}">{{ $categories[$thread->category_id - 1]->name }}</a></span>
                <span class="label">{{ $thread->comment_count }} Cuap</span>
                <span style="float: right; font-size: 0.8em; font-style: italic;">Last post: {{ $thread->updated_at }}</span>
            </div>
        </div>
    </article>
    @endforeach

    <div class="pagination wrapper wrapper-fluid">
        {!! $threads->links() !!}
    </div>
@endsection