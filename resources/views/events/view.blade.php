@extends('layouts.app')
@section('content')
<div class="row">
 <div class="col-sm-4">
   <img style="width:100%" src="{{$event->image}}" />
 </div>
 <div class="col-sm-4">
   <h2>{{$event->name}}</h2>
   <h1>£ {{$event->price}}</h1>
   <h2>{{$event->date}}</h2>
    <h3>{{$event->start_time}} - {{$event->start_time}}</h3>
   <form action="/event/book"  method="get">
     <input type="hidden" name="id" value="{{$event->id}}">
     <button value="Submit" type="button" class="btn btn-primary">Book Now!</button>
   </form>
 </div>
</div>

<div class="row">
 <div class="col-sm-6">
   <h2>Venue</h2>
   <div style="width:600px; height:400px;;" id="map"></div>
 </div>
 <div class="col-sm-6">
   <h2>Description</h2>
   {{$event->description}}
 </div>
</div>
<div class="row">
 <div class="col-sm-8">
   @foreach($comments as $comment)
   <div class="panel panel-default">
      <div class="panel-heading">
        {{$comment->user_name}}
        {{$comment->user_email}}
        {{$comment->created_at}}</div>
      <div class="panel-body">
        {{$comment->comment}}
      </div>
    </div>
   @endforeach

 </div>
 <div class="col-sm-4">
   <form action="/event/add-comment">
      <input type="hidden" name="id" value="{{$event->id}}">
      Add Comment:<br>
      <textarea type="text" name="comment" value="comment"></textarea>
      <br><br>
      <input type="submit" value="Submit">
    </form>
 </div>
</div>
<script>
  function initMap() {
    var uluru = {lat: {{$lonLat[0]}}, lng: {{$lonLat[1]}}};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuHs4ZsDFiJEvpzg3sIrOgsqs2GvxN4zs&callback=initMap">
</script>

@endsection
