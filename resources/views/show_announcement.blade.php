@extends('layouts.master')

@section('title', 'Announcement')

@section('internal-css')
    @parent
    
    #title {
        text-align:center;
        font-size: 1.9em;
        margin: 0 auto 1em auto;
    }

    #content {
        text-align: justify;
        font-size: 1em;
    }

@endsection

@section('content')
    <div class="heading">Announcement</div>
    <h2 id="title">{{ $announcement->title }}</h2>
    <div id="content">
        {{ $announcement->content }}
    </div>
@endsection
