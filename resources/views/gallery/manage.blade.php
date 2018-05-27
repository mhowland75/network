@extends('layouts.backend')
@section('content')
<div class="row">
 <div class="col-sm-6">
   {{$event[0]->name}}
     <div class="row">
       @foreach($images as $image)
       <div class="col-sm-4"><img src="{{$image->image}}" /></div>
       @endforeach
      </div>
 </div>
 <div class="col-sm-6">
   <div class="container">
       <div class="row">
           <div class="col-md-8 col-md-offset-2">
               <div class="panel panel-default">
                   <div class="panel-heading">Create name code</div>

                   <div class="panel-body">
                       <form class="form-horizontal" method="POST" action="/gallery/store" enctype="multipart/form-data">
                           {{ csrf_field() }}
                             <input type="hidden" name="event" value="{{$event[0]->id}}">

                           <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                               <label for="image" class="col-md-2 control-label">Image</label>
                               <div class="col-md-6">
                                   <input id="image" type="file" name="image[]" multiple="True" value="{{ old('image') }}" required autofocus>
                                   @if ($errors->has('image'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('image') }}</strong>
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
 </div>
</div>

@endsection
