@extends('layouts.master')

@section('title', 'Inbox')

@section('internal-css')
    @parent

    .notification {
        display: inline-block;
        padding: 0;
        margin: 0;
        list-style-type: none;
    }

    ul.notification li {
        display: block;
        border-radius: 8px;
        color: white;
        background-color: #528ac3;
        padding: 8px 16px;
        margin: 0.5em;
        text-decoration: none;
        border: 1px solid #bbb;
    }

    ul.notification li.green {
        background-color: #96d046;
    }

    ul.notification li:hover, ul.notification li.green:hover {
        text-decoration: underline;
    }

    ul.notification li:active {
        background-color: #bbb;
    }

@endsection

@section('content')
    <div class="heading">Inbox</div>
    <div class="row">
        <ul class="notification col-6">
            @for ($i = 0; $i < count($notifications); $i += 2)
                <a href="/notification/{{ $notifications[$i]->id }}">
                    <li {{ $notifications[$i]->type == 1 ? "class=green" : "" }}>
                        @if ($notifications[$i]->type == 0)
                        New message from - {{ $users[$notifications[$i]->content_id - 1]->fullname }}<br />
                        At {{ $notifications[$i]->created_at }}
                        @elseif ($notifications[$i]->type == 1)
                        New reply on Thread - {{ $threads[$notifications[$i]->content_id - 1]->title }}<br />
                        At {{ $notifications[$i]->created_at }}
                        @endif
                    </li>
                </a>
            @endfor
        </ul>
        <ul class="notification col-6">
            @for ($i = 1; $i < count($notifications); $i += 2)
                <a href="/notification/{{ $notifications[$i]->id }}">
                    <li {{ $notifications[$i]->type == 1 ? "class=green" : "" }}>
                        @if ($notifications[$i]->type == 0)
                        New message from - {{ $users[$notifications[$i]->content_id - 1]->fullname }}<br />
                        At {{ $notifications[$i]->created_at }}
                        @elseif ($notifications[$i]->type == 1)
                        New reply on Thread - {{ $threads[$notifications[$i]->content_id - 1]->title }}<br />
                        At {{ $notifications[$i]->created_at }}
                        @endif
                    </li>
                </a>
            @endfor
        </ul>
        
        <div class="col-12" style="text-align:center; margin-top: 1.5em; margin-bottom: 1.5em;">
            {!! $notifications->links() !!}
        </div>
    </div>
@endsection
