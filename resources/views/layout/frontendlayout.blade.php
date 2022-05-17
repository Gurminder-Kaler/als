<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
  <title>ALS</title>
  <!-- Bootstrap core CSS -->
  <link href="{{asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  @toastr_css
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/assets/css/tooplate-main.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/assets/css/flex-slider.css')}}"> 
  @yield('head')
  {{-- @yield('toastr_css') --}}
</head>
<body>
@include('common.preheader')
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
  <div class="container">
    @include('common.logo')
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item {{ (request()->is('/')) ? 'active' : ''}}">
          <a class="nav-link" href="{{url('/')}}"><i class="fa fa-home"></i>&nbsp;Home
            <span class="sr-only">(current)</span>
          </a>
        </li> 
        <li class="nav-item {{ (request()->is('products')) ? 'active' : ''}}">
          <a class="nav-link" href="{{url('/products')}}"><i class="fa fa-archive"></i> Products</a>
        </li>
        <li class="nav-item {{ (request()->is('about')) ? 'active' : ''}}">
          <a class="nav-link" href="{{url('/about')}}">About Us</a>
        </li>
        <li class="nav-item {{ (request()->is('contact')) ? 'active' : ''}}">
          <a class="nav-link" href="{{url('/contact')}}"><i class="fa fa-phone"></i> Contact Us</a>
        </li>
        <li class="nav-item {{ (request()->is('donate')) ? 'active' : ''}}">
          <a class="nav-link" style="color:#e87085" href="{{url('/donate')}}"> <i class="fa fa-smile-o"></i> Donate</a>
        </li>
        @guest
          @if (Route::has('login'))
              <li class="nav-item {{ (request()->is('login')) ? 'active' : ''}}">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
          @endif 
        @else
          @if(Auth::user()->role == "admin")
            <li class="nav-item">
              <a title="Goto Admin Dashboard" href="/admin/dashboard" class="nav-link text-uppercase"><i class="fa fa-dashboard"></i> {{ Auth::user()->name }}</a>
            </li>
          @else
            <li class="nav-item">
              <a title="Goto My Dashboard" href="/myProfile" class="nav-link text-success text-uppercase"><i class="fa fa-dashboard"></i> {{ Auth::user()->name }}</a>
            </li>
          @endif
          <li class="nav-item" >
            <a class="nav-link text-primary" title="Goto Shopping Cart" href="/myCart">
              @php 
              $cart = \App\Models\Cart::where('user_id', auth()->user()->id)->get();
              @endphp
            <i class="fa fa-shopping-cart"></i> {{ __('My Cart') }} ({{$cart->count()}})
            </a>
          </li>
          <li class="nav-item" >
            <a class="nav-link text-danger"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form> 
          </li>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
@yield('body')

@include('common.subscribe')
@include('common.footer')

<script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
@yield('script')
@yield('toastr_js')
<script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Additional Scripts -->
<script src="{{asset('frontend/assets/js/custom.js')}}"></script>
<script src="{{asset('frontend/assets/js/owl.js')}}"></script>
<script src="{{asset('frontend/assets/js/isotope.js')}}"></script>
<script src="{{asset('frontend/assets/js/flex-slider.js')}}"></script>
<script language = "text/Javascript"> 
  cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
  function clearField(t) {                   //declaring the array outside of the
    if (!cleared[t.id]) {                 // function makes it static and global
      cleared[t.id] = 1;  // you could use true and false, but that's more typing
      t.value='';         // with more chance of typos
      t.style.color='#fff';
    }
  }
</script>
@yield('stripe')
</body>
</html>