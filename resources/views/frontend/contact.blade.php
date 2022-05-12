@extends('layout.frontendlayout')
@section('body')
<div class="contact-page">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>Contact Us</h1>
          </div>
        </div>
        <div class="col-md-6">
          <div id="map">
                  <!-- How to change your own map point
                         1. Go to Google Maps
                         2. Click on your location point
                         3. Click "Share" and choose "Embed map" tab
                         4. Copy only URL and paste it within the src="" field below
                  --> 
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11540.59327816289!2d-79.7592773!3d43.6866798!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xad7612fc9befe7ad!2sAlgoma%20University!5e0!3m2!1sen!2sca!4v1652226230556!5m2!1sen!2sca" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-md-6">
          <div class="right-content">
            <div class="container">
              @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">{{$error}}</div>
                @endforeach
              @endif
              @if (Session::has('flash_message'))
                <div class="container">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('flash_message') }}
                    </div>
                </div>
              @endif
            <form id="contact" action="{{url('/submitContactForm')}}" method="post">
              @csrf
                <div class="row">
                  <div class="col-md-6">
                    <fieldset>
                      <input required name="contact_query_name" type="text" class="form-control" id="name" placeholder="Your name...">
                    </fieldset>
                  </div>
                  <div class="col-md-6">
                    <fieldset>
                      <input required name="contact_query_email" type="text" class="form-control" id="email" placeholder="Your email...">
                    </fieldset>
                  </div>
                  <div class="col-md-12">
                    <fieldset>
                      <input required name="contact_query_subject" type="text" class="form-control" id="subject" placeholder="Subject...">
                    </fieldset>
                  </div>
                  <div class="col-md-12">
                    <fieldset>
                      <textarea required name="contact_query_message" rows="6" class="form-control" id="message" placeholder="Your message..."></textarea>
                    </fieldset>
                  </div>
                  <div class="col-md-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button">Send Message</button>
                    </fieldset>
                  </div>
                  <div class="col-md-12">
                    <div class="share">
                      <h6>You can also keep in touch on: <span><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-twitter"></i></a></span></h6>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('toastr_js')
  @jquery
  @toastr_js
  @toastr_render
@endsection