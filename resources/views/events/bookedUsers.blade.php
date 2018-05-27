@extends('layouts.backend')
@section('content')
@foreach($userDetails as $user)
  {{$user[0]->name}}
@endforeach
@endsection
