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
                    @if (!Auth::user()->api)
                        <h5>API Key has not been filled yet </h5>
                    @else
                        <h5>The current API Key belongs to {{ $gamerTag or 'No One - Problem Occured' }}</h5>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/api_post')  }}">
                        {{ csrf_field() }}
                        <label class="col-md-4 control-label">API Key</label>
                        <div class="col-md-6">
                            <input id="text" type="text" class="form-control" name="api_key">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
