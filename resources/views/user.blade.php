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
                <div class="panel-heading">Profile Settings</div>
                <div class="panel-body">
                    @if (!Auth::user()->profile()->first()->api)
                        <h5 class='text-center'>API Key has not been filled yet </h5>
                    @else
                        <h5 class='text-center'>The current API Key belongs to {{ $gamerTag or 'No One - Problem Occured' }}</h5>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/api_post')  }}">
                        {{ csrf_field() }}
                        <div class="input-group">
                          <input id="text" type="text" class="form-control" name="api_key" placeholder="Place API Key here">
                          <span class="input-group-btn">
                            <button class="btn btn-success" type="submit"><i class="fa fa-btn fa-sign-in"></i>Update</button>
                          </span>
                        </div>
                    </form>
                    <hr>
                    <h5 class="text-center"> Go To </h5>
                    <div class="row">
                        <div style="text-align:center">
                            <a class="btn btn-primary" href="/"><i class="fa fa-btn fa-pencil"></i>Mass Messenger</a>
                            <a class="btn btn-success" target="_blank" href="https://xboxapi.com/"><i class="fa fa-btn fa-key"></i>XboxAPI</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
