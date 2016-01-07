@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Announcement {{ $announcement->id }}</div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Title: {{ $announcement->title }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Content: {{ $announcement->content }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Created At: {{ $announcement->created_at }}</label>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
