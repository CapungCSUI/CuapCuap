@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br />
                    <br />
                    This is for development purposes, <br />
                    available routes: <br />
                        /profile/{id} <br />
                        /profile <br />
                        /profiles <br />
                        /profile/edit <br />
                        /home <br />
                        /logout <br />
                        / <br />
                    <br />


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
