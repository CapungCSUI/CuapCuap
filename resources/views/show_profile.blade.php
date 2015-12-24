@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Birthday: {{ $birthday }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Username: {{ $username }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email: {{ $email }}</label>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Profile picture: <img src = "{{ $profile_picture }}"></label>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

