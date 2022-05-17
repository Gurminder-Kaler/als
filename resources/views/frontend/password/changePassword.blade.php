@extends('layout.frontendlayout')
@section('body')
  <div class="featured-items">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>Change Password</h1>
          </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6 offset-md-3">
                <span class="anchor" id="formChangePassword"></span> 
                <!-- form card change password -->
                <div class="card card-outline-secondary">
                    <div class="card-body">
                    <form class="form" role="form" method="post" autocomplete="off" action="{{url('/changePassword')}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputPasswordOld">Old Password<span class="text-danger">(*)</span></label>
                        <input type="password" name="oldPassword" class="form-control" id="inputPasswordOld" value="{{old('oldPassword')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPasswordNew">New Password<span class="text-danger">(*)</span></label>
                            <input type="password" name="newPassword" class="form-control" id="inputPasswordNew"  value="{{old('newPassword')}}" required>
                            <span class="form-text small text-muted">
                                The password must be 8-20 characters, and must <em>not</em> contain spaces.
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="inputPasswordNewVerify">Confirm New Password<span class="text-danger">(*)</span></label>
                            <input type="password" name="confirmNewPassword" class="form-control" id="inputPasswordNewVerify"  value="{{old('confirmNewPassword')}}" required>
                            <span class="form-text small text-muted">
                                To confirm, type the new password again.
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block float-right">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- /form card change password -->

            </div>
        </div>
      </div>
    </div>
  </div>

@endsection