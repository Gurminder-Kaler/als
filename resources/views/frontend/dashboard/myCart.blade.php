@extends('layout.frontendlayout')
{{-- @section('head')
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
@endsection --}}
@section('body')  
  <!-- Featured Starts Here -->
  <div class="featured-items">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>My Cart Items</h1>
          </div>
        </div>
        @if(isset($cart) && $cart->count() > 0)
        <div class="col-12">
          <table class="table table-striped">
            <thead class="text-center">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Photo</th>
                <th scope="col" class="text-success">Quantity</th>
                <th scope="col" class="text-primary" >($)Price</th>
                <th scope="col"><span class="text-success">Quantity</span> x <span class="text-primary">($)Price</span></th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach($cart as $item)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->product ? $item->product->title : 'No title Found'}}</td>
                <td><img src='{{"/storage/product/".$item->product->img.""}}' width="90px" height="80px" /></td>
                <td>{{$item->product ? $item->quantity : 'No Quantity Found'}}</td>
                <td>{{$item->product ? $item->product->price : 'No Price Found'}}</td>
                <td>{{$item->product ? $item->quantity * $item->product->price : 'No total price Found'}}</td>
                <td>
                <form method="post" action="{{url('/cart/increase')}}">@csrf
                  <input type="hidden" name="cart_id" value="{{$item->id}}" />
                  <button
                  type="submit"
                  class="btn-sm text-white btn-success"
                  title="Increase this item's quantity"
                  id="{{$item->id}}">+1</button>
                </form>
                <form method="post" action="{{url('/cart/decrease')}}">@csrf
                  <input type="hidden" name="cart_id" value="{{$item->id}}" />
                  <button
                  type="submit"
                  class="btn-sm text-white btn-danger"
                  title="Decrease this item's quantity"
                  id="{{$item->id}}">-1</button>
                </form>
                <form method="post" action="{{url('/cart/remove')}}">@csrf
                  <input type="hidden" name="cart_id" value="{{$item->id}}" />
                  <button
                  type="submit"
                  class="btn-sm text-white btn-danger"
                  title="delete this item from cart"
                  id="{{$item->id}}">X</button>
                </form>
                </td>
              </tr>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center">
          <h2 >Your Cart is Empty</h2>
        </div>
        <div class="col-12">
          <a href="{{url('/products')}}" class="btn btn-sm btn-primary">Explore Products <i class="fa fa-arrow-right"></i></a>
        </div>
        @endif
        @if($cart->count() > 0 )
        <div class="col-12">
          <a href="{{url('/checkout')}}" class="btn btn-sm btn-primary">Proceed to Checkout <i class="fa fa-arrow-right"></i></a>
        </div>
        @endif
        
      </div>
    </div>
  </div> 

@endsection
