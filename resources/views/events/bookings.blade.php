@extends('layouts.backend')
@section('content')
@foreach ($events as $event)
<tr>
  <td>{{$event[0]->name}}</td>
  <td>{{$event[0]->date}}</td>
  <td>{{$event[0]->start_time}}</td>
  <td>{{$event[0]->finish_time}}</td>
  <td><a data-toggle="tooltip" title="Edit" href="/event/{{$event[0]->id}}/edit"><i style="font-size:20px" class="ion-edit"></i></a></td>
</tr>
@endforeach
@endsection
