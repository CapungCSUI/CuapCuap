@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <button><a href="{{ 'announcement/new' }}">New Announcement</a></button>
            @foreach ($announcements as $announcement)
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/announcement/{{ $announcement->id}}">Announcement {{ $announcement->id }}</a></div>
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

                        <div class="form-group">
                            <label class="col-md-4 control-label">Updated At: {{ $announcement->updated_at }}</label>
                        </div>

                        <div class="form-group">
                            <button><a href="/announcement/{{ $announcement->id }}/edit">edit</a></button>
                            <button><a href="/announcement/{{ $announcement->id }}/delete">delete</a></button>
                        </div>
                </div>
            </div>
            @endforeach
            {!! $announcements->links() !!}
        </div>
    </div>
</div>
@endsection
