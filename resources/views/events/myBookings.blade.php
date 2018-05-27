@extends('layouts.app')
@section('content')
<h1>Upcomeing Events</h1>
@foreach ($events as $event)
<a href="/event/{{$event->id}}/view">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
       <div class="col-sm-2">
         <center>
           <p style="font-weight:bold;font-size:18px;">
             {{$event->date}}<br />
             Start: {{$event->start_time}}<br />
             Finish: {{$event->finish_time}}
           </p>
         </center>
       </div>
       <div class="col-sm-4">
         <img style="max-height:300px" src="{{$event->image}}" />
       </div>
       <div class="col-sm-6">
         <h2>{{$event->name}}</h2>
         <p>
           {{$event->description}}
         </p>
         <h1>£{{$event->price}}</h1>
       </div>
      </div>
    </div>
  </div>
  </a>
@endforeach

@endsection
