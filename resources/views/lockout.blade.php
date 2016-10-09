@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(Session::has('flash_message'))
                <div class="alert alert-success"><em> {{ session('flash_message') }}</em></div>
            @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Lockout CountDown</div>
                    <div class="panel-body">
                        @if($timeLeft > 0)
                            <p>Please Wait {{ $timeLeft }} hour(s) before sending more messages</p>
                            <p><a class="btn btn-primary" href="/user" role="button">Change API Key</a></p>
                        @else
                            <p>You Can Now Send Your Messages</p>
                            <p><a class="btn btn-primary" href="/" role="button">Send Messages</a></p>
                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
