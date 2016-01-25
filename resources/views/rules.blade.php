@extends('layouts.master')

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
    <div class="heading">Peraturan Forum</div>
    <div id="content">
        Ga boleh nakal!
    </div>
@endsection
