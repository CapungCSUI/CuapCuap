@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach ($users as $user)
            <div class="panel panel-default">
                <div class="panel-heading">Profile {{ $user->id }}</div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Birthday: {{ $user->birthday }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Username: {{ $user->username }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email: {{ $user->email }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Profile picture: <img style="max-width:100px;" src="{{ $user->profile_picture }}"></label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Voted_threads: {{ $user->voted_threads }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Voted_replies: {{ $user->voted_replies }}</label>
                        </div>

                        <div class="form-group">
                            <button><a href="/messages/{{ $user->id }}">Message!</a></button>
                        </div>

                </div>
            </div>
            @endforeach
            {!! $users->links() !!}
        </div>
    </div>
</div>
@endsection

