@extends('layouts.master')

@section('title', 'Edit Profile')

@section('content')
    <div class="heading">Edit Profile</div>
    <div>
        <form class="form form-left" role="form" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form_group row{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-2">Birthday</label>

                <div class="col-10">
                    <input type="date" class="form-control" name="birthday" value="{{ $user->birthday }}">

                    @if ($errors->has('birthday'))
                        <span class="help-block">
                            <strong>{{ $errors->first('birthday') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form_group row{{ $errors->has('content') ? ' has-error' : '' }}">
                <label class="col-2">E-Mail Address</label>

                <div class="col-10">
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form_group row{{ $errors->has('content') ? ' has-error' : '' }}">
                <label class="col-2">Profile Picture</label>

                <div class="col-10">
                    <input type="file" class="form-control" name="profile_picture">
                    @if ($errors->has('profile_picture'))
                        <span class="help-block">
                            <strong>{{ $errors->first('profile_picture') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <br />
            <div class="form_group row">
                <div class="col-left-2 col-10">
                    <button type="submit" class="btn btn-primary">
                        Edit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

