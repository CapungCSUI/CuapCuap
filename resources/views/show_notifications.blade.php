@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach ($notifications as $notification)
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/notification/{{ $notification->id }}">Notification {{ $notification->id }}</a></div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">user_id: {{ $notification->user_id }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">type: {{ $notification->type }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">content_id: {{ $notification->content_id }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">created_at: {{ $notification->created_at }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">is_read: {{ $notification->is_read }}</label>
                        </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

