<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
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
              <a class="nav-link" href="{{url('/')}}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('products')) ? 'active' : ''}}">
            <a class="nav-link" href="{{url('/products')}}">Products</a>
            </li>
            <li class="nav-item {{ (request()->is('about')) ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/about')}}">About Us</a>
            </li>
            <li class="nav-item {{ (request()->is('contact')) ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/contact')}}">Contact Us</a>
            </li>
            <li class="nav-item {{ (request()->is('donate')) ? 'active' : ''}}">
              <a class="nav-link" href="{{url('/donate')}}">Donate</a>
            </li>
            @guest
              @if (Route::has('login'))
                  <li class="nav-item {{ (request()->is('login')) ? 'active' : ''}}">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
              @endif 
            @else
                <li class="nav-item">
                  Hi <a href="/admin/dashboard" class="text-uppercase">{{ Auth::user()->name }}</a>,
                  <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form> 
                </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    @yield('body')

    @include('common.subscribe')
    @include('common.footer')

    @yield('script')
    <script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
    @yield('toastr_js')
    <script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Additional Scripts -->
    <script src="{{asset('frontend/assets/js/custom.js')}}"></script>
    <script src="{{asset('frontend/assets/js/owl.js')}}"></script>
    <script src="{{asset('frontend/assets/js/isotope.js')}}"></script>
    <script src="{{asset('frontend/assets/js/flex-slider.js')}}"></script>
    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>
    @yield('stripe')
</body>
</html>