@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class ="panel panel-default">
                Thread {{ $thread->id}}, category {{ $thread->category_id }}, author {{ $thread->author_id}}, title {{ $thread->title }}, tags {{ $thread->tags }}, sticky {{ $thread->sticky }}, <br />
                comment-count: {{ $thread->comment_count }}, content: <br />
                {{ $thread->content }}
                <button><a href="{{ Request::url() . '/edit' }}">edit</a></button>
                <button><a href="{{ Request::url() . '/delete' }}">delete</a></button>
                <button><a href="{{ Request::url() . '/reply' }}">reply</a></button>
            </div>
            @foreach ($replies as $reply)
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ Request::url() . '/' . $reply->id }}">Reply {{ $reply->id }}</a>, thread: {{ $reply->thread_id }}, parent: {{ $reply->parent_id }}<br />pos: {{ $reply->position }}</div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">By: {{ $reply->user_id }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Content: {{ $reply->content }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Depth: {{ $reply->depth }}</label>
                        </div>
                        <button><a href="{{ Request::url() . '/' . $reply->id . '/edit' }}">edit</a></button>
                        <button><a href="{{ Request::url() . '/' . $reply->id . '/delete' }}">delete</a></button>
                        <button><a href="{{ Request::url() . '/' . $reply->id . '/reply' }}">reply</a></button>
                </div>
            </div>
            @endforeach
            {!! $replies->links() !!}
        </div>
    </div>
</div>
@endsection

