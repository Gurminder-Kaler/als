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
          <img src="{{asset('/frontend/assets/images/about-us.jpg')}}" alt="asds">
          </div>
        </div>
        <div class="col-md-6">
          <div class="right-content">
            <h4>About us</h4>
            <p>ALS is a non-profit, charitable organization that is concerned with the welfare of animals in Toronto. It accepts donations from individuals. It also sells products that are of interest to animal lovers. A percentage of the sales price supports ALS. ALS uses this money to support education programs, lobby government, investigate illegal activities related to animal welfare and pay employee expenses. The database is to provide access to information about welfare </p>
            <div class="share">
              <h6>Find us on: <span><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-twitter"></i></a></span></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection