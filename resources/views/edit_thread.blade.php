@extends('layouts.master')

@section('title', 'Edit Thread')

@section('content')
    <div class="heading">Edit Thread {{ $thread->id }}</div>
    <div>
        <form class="form form-left" role="form" method="POST">
            {!! csrf_field() !!}

            <div class="form_group row{{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label class="col-2">Category</label>

                <div class="col-10">
                    <select name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $thread->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form_group row{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-2">Title</label>

                <div class="col-10">
                    <input type="text" name="title" value="{{ $thread->title }}">
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
                    <textarea name="content" class="form-text-area tinymce">{{ $thread->content }}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!--<div class="form_group row{{ $errors->has('tags') ? ' has-error' : '' }}">
                <label class="col-2">Tags</label>

                <div class="col-10">
                    <input type="text" class="form-control" name="tags" value="{{ $thread->tags }}">
                    @if ($errors->has('tags'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tags') }}</strong>
                        </span>
                    @endif
                </div>
            </div>-->

            <div class="form_group row{{ $errors->has('sticky') ? ' has-error' : '' }}">
                <label class="col-2">Sticky</label>

                <div class="col-10">
                    <select name="sticky" {{ Auth::user()->role_id == 0 ? "disabled" : "" }}>
                        <option value="0" {{ $thread->sticky == false ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $thread->sticky == true ? 'selected' : '' }}>Yes</option>
                    </select>
                    @if ($errors->has('sticky'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sticky') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <br />
            <div class="form_group row">
                <div class="col-10 col-left-2">
                    <button type="submit" class="btn btn-primary">
                        Edit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection