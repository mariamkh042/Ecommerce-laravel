@php 
if(Auth::check()){
  $orders = \App\Models\Orders::where('user_id',Auth::user()->id)->count(); 
}
@endphp

<style>
/* Dropdown Button */
.dropbtn {
  background-color: #D10024;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #D10024;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
</style>
<!-- NAVIGATION -->
<nav id="navigation">
  <!-- container -->
  <div class="container">
    <!-- responsive-nav -->
    <div id="responsive-nav">
      <!-- NAV -->
      <ul class="main-nav nav navbar-nav">
        <li class="{{ Request::is('/') ? 'active':'' }}"><a href="{{url('/')}}">Home</a></li>
        <li class="{{ Request::is('category') ? 'active':'' }}"><a href="{{url('/category')}}">Categories</a></li>
        @if(Auth::check())
        @if($orders > 0)
        <li class="{{ Request::is('my-orders') ? 'active':'' }}"><a href="{{url('/my-orders')}}">My Orders</a></li>
        @endif
        @endif
      </ul>
      <ul class="main-nav nav navbar-nav pull-right">
        @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="{{ Request::is('login') ? 'active':'' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif
  
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="{{ Request::is('register') ? 'active':'' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
        @else
        <div class="dropdown">
          <button onclick="myFunction()" class="dropbtn"><i class="fa fa-user">{{Auth::user()->name}}</i></button>
          <div id="myDropdown" class="dropdown-content">
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>

            <a class="dropdown-item" href="">
              {{ __('My Profile') }}
            </a>

            @if($orders > 0)
            <a class="dropdown-item" href="{{url('my-orders')}}">
             {{ __('My Order') }}
            </a>
            @endif
          </div>
        </div>
        @endguest
      </ul>
      <!-- /NAV -->
    </div>
    <!-- /responsive-nav -->
  </div>
  <!-- /container -->
</nav>
<!-- /NAVIGATION -->
<script>
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>