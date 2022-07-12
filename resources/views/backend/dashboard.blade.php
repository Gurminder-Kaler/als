@extends('layout.backendlayout')

@section('body')
{{-- Data coming from AdminController --}}
    <div class="container">
        <div class="row">
            {{-- @include('backend.sidebar') --}}

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h3>Total No. of Users</h3></div>
                    <div class="card-body">
                        <h2>{{$totalNoOfUsers}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h3>Total No. of Donors</h3></div>
                    <div class="card-body">
                        <h2>{{$totalNoOfDonors}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h3>Total No. of Donations</h3></div>
                    <div class="card-body">
                        <h2>{{$totalNoOfDonations}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h3>Total Amount of Donations</h3></div>
                    <div class="card-body">
                        <h2>$ {{number_format($totalDonationAmount)}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h3>Total No. of Orders</h3></div>
                    <div class="card-body">
                        <h2>{{$totalNoOfOrders}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
