@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Profile Settings</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/api_post')  }}">
                        {{ csrf_field() }}
                        <label class="col-md-4 control-label">API Key</label>
                        <div class="col-md-6">
                            <input id="text" type="text" class="form-control" name="api_key" value="{{$api_key}}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-sign-in"></i> Update
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
