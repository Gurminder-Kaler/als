@extends('layout.frontendlayout')
{{-- @section('head')
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
@endsection --}}
@section('body') 
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>My Profile</h1>
            </div>
          </div>
        <div class="col-8 offset-2" style="margin-top: 14px;margin-bottom: 34px;padding: 15px; border: 1px solid grey">
            @php
            $user = Auth::user();
            @endphp
            <form action="{{url('/updateProfile')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="border: 1px solid #0000ff25;padding: 15px;">
                    <div class="row p-2">
                        <div class="col-4">
                            Profile Photo
                        </div>
                        <div class="col-8">
                            <img src="{{ $user->profile_photo ? asset('/storage/profile/'.$user->profile_photo.'') : asset('/frontend/assets/images/placeholder.png') }}" height="145px" width="135px"/>
                            <input type="file" name="profile_photo" />
                        </div>
                    </div>

                    <div class="row p-2">
                        <div class="col-4">
                            Name
                        </div>
                        <div class="col-6">
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">    
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>    Update</button> 
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-5">
                <div class="col-4">
                    Email
                </div>
                <div class="col-8 text-success">
                    <i>{{ $user->email }}</i>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-4">
                    Gender
                </div>
                <div class="col-8">
                    {{ $user->gender }}
                </div>
            </div>
            <div class="row text-center mt-5">
                <div class="col-3">
                    <a class="btn btn-sm btn-dark" href="{{url('/myAddresses')}}"><i class="fa fa-home"></i> My Addresses</a>
                </div>
                <div class="col-3">
                    <a class="btn btn-sm btn-dark" href="{{url('/changePassword')}}"><i class="fa fa-key"></i> Change Password</a>
                </div>
                <div class="col-3">
                    <a class="btn btn-sm btn-dark" href="{{url('/myDonations')}}"><i class="fa fa-smile-o"></i> My Donations</a>
                </div>
                <div class="col-3">
                    <a class="btn btn-sm btn-dark" href="{{url('/myOrders')}}"><i class='fas fa-box-open'></i> My Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection