@extends('layouts.master')

@section('title', 'Edit Announcement')

@section('content')
    <div class="heading">Edit Announcement {{ $announcement->id }}</div>
    <div>
        <form class="form form-left" role="form" method="POST">
            {!! csrf_field() !!}

            <div class="form_group row{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-2">Title</label>

                <div class="col-10">
                    <input type="text" name="title" value="{{ $announcement->title }}">
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form_group row{{ $errors->has('content') ? ' has-error' : '' }}">
                <label class="col-2">Content</label>

                <div class="col-10">
                    <textarea name="content" class="form-text-area tinymce">{{ $announcement->content }}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
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

