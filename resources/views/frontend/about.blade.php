@extends('layout.frontendlayout')
@section('body')
<div class="about-page">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>About Us</h1>
             
          </div>
        </div>
        <div class="col-md-6">
          <div class="left-image">
          <img src="{{asset('/storage/about/'.$about->img.'')}}" alt="asds">
          </div>
        </div>
        <div class="col-md-6">
          <div class="right-content">
            <h4>About us</h4>
            <p>{{$about->about}}</p>
            <div class="share">
              <h6>Find us on: <span><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-twitter"></i></a></span></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

