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
    <link href="{{ URL::asset('css/backend.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/backendNavbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <script>
/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "navBar") {
        x.className += " responsive";
    } else {
        x.className = "navBar";
    }
}
function displayBlock() {
  var element = document.getElementById('sideNav'),
    style = window.getComputedStyle(element),
    top = style.getPropertyValue('width');
  if(top == "0px"){
      document.getElementById('sideNav').style.cssText = 'width:300px';
  }
  else{
      document.getElementById('sideNav').style.cssText = 'width:0px';
  }
}
</script>
</head>
<body>
  <div class="navBar" id="myTopnav">
    <a id="nav_logo" href="{{ url('/') }}">
        <img src="/images/bathCollegeLogo.png" />
    </a>
    <a href="/home">Home</a>
    <div class="dropdownBox">
      <button class="dropbtnx">
          <a href="#">Events</a>
      </button>
      <div class="dropdown-content">
        <a href="/event/create">Create Event</a>
        <a href="/event/manage">Manage Events</a>
        <a href="/event/index">Events Index</a>
        <a href="/event/myEvents">My Events</a>
        <a href="/event/manage">Manage Events</a>

      </div>
    </div>
    <div class="dropdownBox">
      <button class="dropbtnx">
          <a href="#">Gallery</a>
      </button>
      <div class="dropdown-content">
        <a href="/gallery/create">Create Galley</a>
        <a href="/gallery/manage">Manage Galley</a>
        <a href="/gallery/index">Events Galley</a>
        <a href="/gallery/manage">Manage Galley</a>

      </div>
    </div>
    <div class="dropdownBox">
      <button class="dropbtnx"><a href="#">Admin</a>

      </button>
      <div class="dropdown-content">
        <a href="/admin/create">Add Admin</a>
        <a href="/admin/manage">Manage</a>
        <a href="/admin/manageAccess">Administrator Privileges</a>
        <a href="/admin/activity">Activity</a>
      </div>
    </div>
  <a href="javascript:void(0);" class="icon" onclick="displayBlock()">&#9776;</a>
</div>
  <div id="page">
      @yield('content')
  </div>
@include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
