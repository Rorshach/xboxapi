@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
            @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
            @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Main Messenger</div>
                <div class="panel-body">
                    @if (!Auth::user()->profile()->first()->api)
                        <h3 class="text-center">API Key has not been filled yet </h3>
                        <hr>
                        <div class="row">
                            <div style="text-align:center">
                                <a class="btn btn-primary" href="/user" role="button"><i class="fa fa-btn fa-cog"></i>Input API Key</a>
                            </div>
                        </div>
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
                                    <p>Choose Game</p>
                                    @if(isset($uniqueGames))
                                        @foreach ($uniqueGames as $game)
                                        <label class="btn btn-success btn-sm btn-block">
                                          <input type="checkbox" name="game[]" value="{{$game}}" > {{$game}}
                                        </label>
                                        @endforeach
                                    @endif
                                        <br>
                                        <p>Filter Players - <i><small>Optional</small></i></p>
                                        <label class="btn btn-warning btn-sm btn-block">
                                          <input type="checkbox" name="friends" value="true" > Filter Out Friends
                                        </label>
                                        <label class="btn btn-warning btn-sm btn-block">
                                          <input type="checkbox" name="convo" value="true" > Filter Out Recently Messaged
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Send Message</button>
                                    <br>
                                    @if(Session::has('flash_message'))
                                        <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
                                    @else
                                        <div class="alert alert-success"><em> "1. Write Message // 2. Choose Players // 3. Filter Out Players // 4. SEND"</em></div>
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
