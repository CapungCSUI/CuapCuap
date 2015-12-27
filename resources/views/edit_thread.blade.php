@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Thread {{ $thread->id }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ Request::url() }}" >
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select name = "category_id">
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

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ $thread->title }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="content" value="{{ $thread->content }}">
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Tags</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="tags" value="{{ $thread->tags }}">
                                @if ($errors->has('tags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sticky') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Sticky</label>

                            <div class="col-md-6">
                                <select name = "sticky">
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
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Edit
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

