@extends('layouts.master')

@section('internal-css')
    @parent

    .parentReply {
        //font-family: "DroidSerif-Regular" !important;
    }

    .parentReply .content {
        border-radius: 4px;
        padding: 1em;
        background-color: #EDEDED;
        margin-bottom: 1em;
    }
    
    .statusbar {
        font-size: 0.9em; 
    }

    .statusbar a {
        color: blue;
    }

    .statusbar a:hover {
        text-decoration: underline;
    }

    .statusbar a:active {
        color: #A2F;
    }

@endsection

@section('content')
    <div class="heading">Edit Reply</div>
    <div>
        <form class="form form-left" role="form" method="POST">
            {!! csrf_field() !!}

            @if ($parentReply != null)
            Parent Reply:
            <div class="parentReply">
                <div class="content">
                    {!! $parentReply->content !!}
                </div>
                <div class="statusbar">
                    By <a href="/profile/{{ $parentReply->user_id }}">{{ $parentReply->user_name }}</a>
                    <span style="float: right">{{ $parentReply->updated_at }}</span>
                </div>
            </div>

            <div style="height: 1px; background: #528ac3; margin: 1em 0;"></div>
            @endif

            <div class="form_group row{{ $errors->has('content') ? ' has-error' : '' }}">
                <label class="col-2">Edit Reply</label>

                <div class="col-10">
                    <textarea name="content" class="form-text-area">{{ $reply->content }}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
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