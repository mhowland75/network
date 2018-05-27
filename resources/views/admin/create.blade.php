@extends('layouts.backend')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create email code</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/admin/store">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">email</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('access_level') ? ' has-error' : '' }}">
                            <label for="access_level" class="col-md-4 control-label">Group Code</label>
                            <div class="col-md-6">
                                <input id="access_level" type="text" class="form-control" name="access_level" value="{{ old('access_level') }}" required autofocus>
                                @if ($errors->has('access_level'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('access_level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Admin
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
