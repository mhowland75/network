<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightBox.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/ionicons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    <div id="app">
      <div class="navBar" id="myTopnav">
      <a id="nav_logo" href="{{ url('/') }}">
          <img src="/images/bathCollegeLogo.png" />
      </a>
      <a href="/event/index">Events</a>
      <a href="/gallery/index">Gallery</a>
      @if (Auth::guest())
        <a class="footerLinks" href="{{ route('login') }}">Login</a><br />
      @else
        <a class="footerLinks" href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
           Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      @endif
      @if (Auth::id())
      <div class="dropdownBox">
        <button class="dropbtnx">
            <a href="#">Account</a>
        </button>
        <div class="dropdown-content">
          <a href="/event/my-events">My Bookings</a>
          <a href="/event/my-events-history">Event History</a>
        </div>
      </div>
      @endif
  <a href="javascript:void(0);" class="icon" onclick="displayBlock()">&#9776;</a>
</div>
<div id="sideNav">
  <div>
    <a href="/education/index/maths">Maths</a>
    <a href="/education/index/english">English</a>
    <a href="/departments/view">Diagnostic Questions</a>
    <a href="/help/view">Help</a>
    @if (Auth::id())
      <a href="/home">Backend</a>
    @endif
  </div>
</div>
    <div id="page">
      @yield('content')
    </div>
    @include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
