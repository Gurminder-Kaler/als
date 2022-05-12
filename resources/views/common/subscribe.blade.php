<div class="subscribe-form">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>Subscribe on ALS Newsletter now!</h1>
          </div>
        </div>
        <div class="col-md-8 offset-md-2">
          <div class="main-content">
            {{-- <p>Godard four dollar toast prism, authentic heirloom raw denim messenger bag gochujang put a bird on it celiac readymade vice.</p> --}}
            <div class="container">

              @if($errors->has('newsletter_email'))
                  <div class="error text-danger">{{ $errors->first('newsletter_email') }}</div>
              @elseif (Session::has('newsletter_sub_success'))
                  <div class="container">
                      <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ Session::get('newsletter_sub_success') }}
                      </div>
                  </div>
              @endif
            <form action="{{url('/subscribeToNewsletter')}}" method="POST">
              @csrf
                <div class="row">
                  <div class="col-md-7">
                    <fieldset>
                      <input required name="newsletter_email" type="email" class="superPlaceholder form-control"
                      placeholder="Your Email..." >
                    </fieldset>
                  </div>
                  <div class="col-md-5">
                    <fieldset>
                      <button type="submit" class="button">Subscribe Now!</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  @section('toastr_js')
    @jquery
    @toastr_js
    @toastr_render
  @endsection