@extends('layout.frontendlayout')
{{-- @section('head')
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
@endsection --}}
@section('body')
  <div class="featured-items">
    <div class="container">
      <div class="row">
        <div class="col-10 offset-1">
          <div class="section-heading">
          <div class="line-dec"></div>
            <h1>My Orders</h1>
            <a href="{{url('/products')}}" class="btn btn-sm btn-primary mt-2 mb-2 ">Explore More Products <i class="fa fa-smile-o"></i></a>
            <div class="row">
              @if(isset($orders) && $orders->count() > 0)
              <div class="col-12">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Donation Amount($)</th>
                      <th scope="col">Transaction Id</th>
                      <th scope="col">Date and Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $a)
                    <tr>
                      {{-- {{dd($selectedAddress)}} --}}
                    
                      <td>{{$loop->iteration}}</td>
                      <td>{{$a->amount}}</td>
                      <td>{{$a->transaction_id}}</td>
                      <td>{{$a->created_at}}</td>
                      {{-- <td>{{$a->type}}</td> --}}
                    </tr> 
                    @endforeach
                  </tbody>
                </table>
              </div>
              @else
              <h4 class="p-3">--No orders Found--</h4>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 

@endsection