@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Reply</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ Request::url() }}" >
                        {!! csrf_field() !!}

                        <div class="panel panel-default">
                            <label class="col-md-4 control-label">Thread</label>

                            <div class="col-md-6">
                                Thread {{ $thread->id}}, category {{ $thread->category_id }}, author {{ $thread->author_id}}, title {{ $thread->title }}, tags {{ $thread->tags }}, sticky {{ $thread->sticky }}, <br />
                                comment-count: {{ $thread->comment_count }}, content: <br />
                                {{ $thread->content }}
                            </div>
                        </div>

                        @if ($parentReply != null)
                        <div class="panel panel-default">
                            <div class="panel-heading">Reply {{ $parentReply->id }}, thread: {{ $parentReply->thread_id }}, parent: {{ $parentReply->parent_id }}<br />pos: {{ $parentReply->position }}</div>
                            <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">By: {{ $parentReply->user_id }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Content: {{ $parentReply->content }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Depth: {{ $parentReply->depth }}</label>
                                    </div>
                            </div>
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Edit reply</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="content" value = "{{ $reply->content }}">
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br />
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

