@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{ $category }}
        <div class="col-md-8 col-md-offset-2">
            @foreach ($threads as $thread)
            <div class="panel panel-default">
                <div class="panel-heading">Thread {{ $thread->id }}</div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Category_id: {{ $thread->category_id }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Author_id: {{ $thread->author_id }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Title: {{ $thread->title }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tags: {{ $thread->tags }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Content: {{ $thread->content }}</label>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Upvotes: {{ $thread->upvote }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Comment_count: {{ $thread->comment_count }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Created_at: {{ $thread->created_at }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Updated_at: {{ $thread->updated_at }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Sticky: {{ $thread->sticky}} </label>
                        </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

