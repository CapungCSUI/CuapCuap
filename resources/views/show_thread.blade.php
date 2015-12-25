@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class ="panel panel-default">
                Thread {{ $thread->id}}, category {{ $thread->category_id }}, author {{ $thread->author_id}}, title {{ $thread->title }}, tags {{ $thread->tags }}, sticky {{ $thread->sticky }}, <br />
                comment-count: {{ $thread->comment_count }}, content: <br />
                {{ $thread->content }}
            </div>
            @foreach ($replies as $reply)
            <div class="panel panel-default">
                <div class="panel-heading">Reply {{ $reply->id }}, thread: {{ $reply->thread_id }}, parent: {{ $reply->parent_id }}<br />child: {{ $reply->child_replies }}</div>
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
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

