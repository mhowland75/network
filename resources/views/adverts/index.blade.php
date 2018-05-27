@extends('layouts.backend')
@section('content')
<div class="row">
 @foreach($adverts as $advert)
 <a href="/advert/{{$advert->id}}/edit"
   <div class="col-sm-3">
     <div class="panel panel-default">
        <div class="panel-body"><img src="{{$advert->image}}" /></div>
        <div class="panel-footer">
          {{$advert->name}}<br />
          {{$advert->company}}<br />
          {{$advert->start_date}}<br />
          {{$advert->end_date}}<br />
          {{$advert->comany}}<br />
        </div>
      </div>

   </div>
 @endforeach
</div>

@endsection
