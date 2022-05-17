<div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="logo">
            @include('common.logo')
          </div>
        </div>
        <div class="col-md-12">
          <div class="footer-menu">
            <ul>
              <li><a href="{{url('/')}}">Home</a></li>
              <li><a href="{{url('/products')}}">Shop</a></li>
              <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
              <li><a href="{{url('/about')}}">How It Works ?</a></li>
              <li><a href="{{url('/contact')}}">Contact Us</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-12">
          @php
            $siteSetting = \App\Models\SiteSetting::find(1);
          @endphp
          @if($siteSetting)
          <div class="social-icons">
            <ul>
              <li><a href="{{$siteSetting->facebook}}"><i class="fa fa-facebook"></i></a></li>
              <li><a href="{{$siteSetting->twitter}}"><i class="fa fa-twitter"></i></a></li>
              <li><a href="{{$siteSetting->instagram}}"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>