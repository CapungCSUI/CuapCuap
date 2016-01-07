@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Messages to {{ $receiver->id }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ Request::url() }}" >
                        {!! csrf_field() !!}

                        @foreach ($messages as $message)
                        <div class="panel panel-default">
                            <div class="panel-heading">Message {{ $message->id }}</div>
                            <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">By: {{ $message->sender_id }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">To: {{ $message->receiver_id }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Content: {{ $message->content }}</label>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Created_at: {{ $message->created_at }}</label>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                        {!! $messages->links() !!}

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">New message</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="content">
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
                                    <i class="fa fa-btn fa-user"></i>Post
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

