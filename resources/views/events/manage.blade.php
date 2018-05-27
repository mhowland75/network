@extends('layouts.backend')
@section('content')
<table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Start Time</th>
        <th>Finish Time</th>
        <th>Booking Count</th>
        <th>No. Images</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($events as $event)
      <tr>
        <td>{{$event->name}}</td>
        <td>{{$event->date}}</td>
        <td>{{$event->start_time}}</td>
        <td>{{$event->finish_time}}</td>
        <td><a href="/event/{{$event->id}}/booked-users">{{$event->bookingCount}}</a></td>
        <td>{{$event->imageCount}}</td>
        <td><a data-toggle="tooltip" title="Edit" href="/event/{{$event->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
        <td><a data-toggle="tooltip" title="Edit" href="/gallery/{{$event->id}}/manage"><i style="font-size:20px" class="ion-images"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
