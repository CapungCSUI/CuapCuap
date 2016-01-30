@extends('layouts.master')

@section('internal-css')
    @parent
    .heading-blue {
        background-color: #3c90e6
    }

    .profpic {
        max-width:100%;
        padding: 0.25em;
        border-radius: 4px;
        border: 1px solid #AAA; 
        height: auto; 
        transition: 0.2s;
    }

    .profpic:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    label {
        font-size: 1.25em;
        line-height: 1.25em;
    }

    label.value {
        font-weight: lighter;
    }

@endsection

@section('title', $user->fullname)

@section('content')
    <div class="heading heading-blue">{{ $user->fullname }}</div>
    <div>
        <div class="row">
            @if (!empty($user->profile_picture))
            <div class="col-3">
                <img class="profpic" src="{{ $user->profile_picture }}">
            </div>
            @endif
            <div class="col-9">
                <div class="row">
                    <label class="key col-3">Email</label>
                    <label class="value col-9">{{ $user->email }}</label>
                </div>
                <div class="row">
                    <label class="key col-3">Birthday</label>
                    <label class="value col-9">{{ $user->birthday }}</label>
                </div>
                <div class="row">
                    <label class="key col-3">Cuap count</label>
                    <label class="value col-9">{{ $user->comment_count }}</label>
                </div>
                <div class="row">
                    <label class="key col-3">Threads made</label>
                    <label class="value col-9">{{ $user->thread_count }}</label>
                </div>
                <div class="row">
                    <label class="key col-3">Level</label>
                    <label class="value col-9">{{ intval($user->exp / 10)+1 }}</label>
                </div>
            </div>
        </div>
    </div>
@endsection

