@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Main Messenger</div>
                <div class="panel-body">
                    @if (!Auth::user()->profile()->first()->api)
                        <h5>API Key has not been filled yet </h5>
                        <p><a class="btn btn-primary btn-lg" href="/user" role="button">Input API Key</a></p>
                    @else
                        <div class="row">
                            <form role="form" method="POST" action="{{ url('/home/msg_post')  }}">
                                {{ csrf_field() }}
                                <div class="col-md-8">
                                    <textarea placeholder="Write your message here" maxlength="250" class="form-control" rows="20" name="message"></textarea>
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <div class="list-group">
                                        @foreach ($uniqueGames as $game)
                                        <label class="btn btn-success btn-sm btn-block">
                                          <input type="checkbox" name="game[]" value="{{$game}}" > {{$game}}
                                        </label>
                                        @endforeach
                                        <br>
                                        <label class="btn btn-warning btn-sm btn-block">
                                          <input type="checkbox" name="friends" value="true" > No Messaging To Friends
                                        </label>
                                        <label class="btn btn-warning btn-sm btn-block">
                                          <input type="checkbox" name="convo" value="true" > No Messaging To Already Messaged
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Send Message</button>
                                    <br>
                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
