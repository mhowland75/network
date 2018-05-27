@extends('layouts.backend')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create name code</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/event/store" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-2 control-label">Image</label>
                            <div class="col-md-6">
                                <input id="image" type="file" name="image" value="{{ old('image') }}" required autofocus>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">date</label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}" required autofocus>
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
                          <label for="start_time" class="col-md-4 control-label">start_time</label>
                          <div class="col-md-6">
                              <input id="start_time" type="time" class="form-control" name="start_time" value="{{ old('start_time') }}" required autofocus>
                              @if ($errors->has('start_time'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('start_time') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                    <div class="form-group{{ $errors->has('finish_time') ? ' has-error' : '' }}">
                        <label for="finish_time" class="col-md-4 control-label">finish_time</label>
                        <div class="col-md-6">
                            <input id="finish_time" type="time" class="form-control" name="finish_time" value="{{ old('finish_time') }}" required autofocus>
                            @if ($errors->has('finish_time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('finish_time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                        <label for="location" class="col-md-4 control-label">location</label>
                        <div class="col-md-6">
                            <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required autofocus>
                            @if ($errors->has('location'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">description</label>
                        <div class="col-md-6">
                            <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus></textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="subject" class="col-md-4 control-label">subject</label>
                        <div class="col-md-6">
                            <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>
                            @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type" class="col-md-4 control-label">type</label>
                        <div class="col-md-6">
                            <input id="type" type="text" class="form-control" name="type" value="{{ old('type') }}" required autofocus>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('max_capasity') ? ' has-error' : '' }}">
                        <label for="max_capasity" class="col-md-4 control-label">max_capasity</label>
                        <div class="col-md-6">
                            <input id="max_capasity" type="text" class="form-control" name="max_capasity" value="{{ old('max_capasity') }}" required autofocus>
                            @if ($errors->has('max_capasity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('max_capasity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="col-md-4 control-label">price</label>
                        <div class="col-md-6">
                            <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required autofocus>
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('speaker') ? ' has-error' : '' }}">
                        <label for="speaker" class="col-md-4 control-label">speaker</label>
                        <div class="col-md-6">
                            <input id="speaker" type="text" class="form-control" name="speaker" value="{{ old('speaker') }}" required autofocus>
                            @if ($errors->has('speaker'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('speaker') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('visibility') ? ' has-error' : '' }}">
                        <label for="visibility" class="col-md-4 control-label">visibility</label>
                        <div class="col-md-6">
                            <select name="visibility">
                             <option value="1">Visible</option>
                             <option value="0">Invisible</option>
                            </select>
                            @if ($errors->has('visibility'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('visibility') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('first_line') ? ' has-error' : '' }}">
                      <label for="first_line" class="col-md-4 control-label">Firstline</label>
                        <div class="col-md-6">
                            <input id="first_line" type="text" class="form-control" name="first_line" value="{{ old('first_line') }}" required autofocus>
                            @if ($errors->has('first_line'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_line') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('second_line') ? ' has-error' : '' }}">
                        <label for="second_line" class="col-md-4 control-label">Second line</label>
                        <div class="col-md-6">
                            <input id="second_line" type="text" class="form-control" name="second_line" value="{{ old('second_line') }}" required autofocus>
                            @if ($errors->has('second_line'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('second_line') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                        <label for="city" class="col-md-4 control-label">City</label>
                        <div class="col-md-6">
                            <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus>
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                        <label for="postcode" class="col-md-4 control-label">Post Code</label>
                        <div class="col-md-6">
                            <input id="postcode" type="text" class="form-control" name="postcode" value="{{ old('postcode') }}" required autofocus>
                            @if ($errors->has('postcode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('postcode') }}</strong>
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
