@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <button><a href="{{ 'category/new' }}">New Category</a></button>
            @foreach ($categories as $category)
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/category/{{ $category->id}}">Category {{ $category->id }}</a></div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Title: {{ $category->name }}</label>
                        </div>

                        <div class="form-group">
                            <button><a href="/category/{{ $category->id }}/edit">edit</a></button>
                            <button><a href="/category/{{ $category->id }}/delete">delete</a></button>
                        </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
