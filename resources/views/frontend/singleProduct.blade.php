@extends('layout.frontendlayout')
@section('body')
<div class="single-product">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-heading">
               <div class="line-dec"></div>
               <h1>Single Product</h1>
            </div>
         </div>
         <div class="col-md-6">
            <div class="product-slider">
               @php
               $k = $product->images;
               $images = $k ? explode(';', $k) : ['placeholder.jpeg'];
               // dd($images);
               @endphp
               <div id="slider" class="flexslider">
                  <ul class="slides">
                     @if(count($images)> 0 )
                     @foreach($images as $img)
                     <li>
                        <img src="{{asset('/storage/product/'.$img.'')}}" />
                     </li>
                     @endforeach
                     @endif
                     <!-- items mirrored twice, total of 12 -->
                  </ul>
               </div>
               <div id="carousel" class="flexslider">
                  <ul class="slides">
                     @if(count($images)> 0 )
                     @foreach($images as $img)
                     <li>
                        <img src="{{asset('/storage/product/'.$img.'')}}" />
                     </li>
                     @endforeach
                     @endif
                     <!-- items mirrored twice, total of 12 -->
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="right-content">
               <h4>{{$product->title}}</h4>
               <h6>${{$product->price}}</h6>
               <p>{{$product->desc}} </p>
               {{-- <span>7 left on stock</span> --}}
               <form action="{{url('/placeOrder')}}" method="post" >
                  @csrf
                  <label for="quantity">Quantity:</label>
                  <input name="quantity" type="quantity" class="quantity-text" id="quantity"
                     value="1" size="4">
                  <button type="submit" class="button" >Order NOW!</button>
                  <button type="button" id="addToCart" class="button"><i class="fa fa-shopping-cart"></i> ADD TO CART</button>
               </form>
               <div class="down-content">
                  <div class="categories">
                     <h6>Category: 
                        {{$product->category ? $product->category->title : "None"}}
                     </h6>
                  </div>
                  <div class="share">
                     <h6>
                     Share: 
                     @php
                        $siteSetting = \App\Models\SiteSetting::find(1);
                     @endphp
                     @if($siteSetting)
                     <span>
                        <a href="{{$siteSetting->facebook}}"><i class="fa fa-facebook"></i></a>
                        <a href="{{$siteSetting->twitter}}"><i class="fa fa-twitter"></i></a>
                        <a href="{{$siteSetting->instagram}}"><i class="fa fa-instagram"></i></a>
                     </span>
                     @endif
                     </h6>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('common.similarProducts')
@endsection
@section('script')
<script>
$(document).ready(function() {
   $('#addToCart').on('click',function(e) {
      var quantity = $('#quantity').val();
      $.ajax({
         type: "POST",
         url: "/addToCart",
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data: {
            quantity: quantity,
            product_id: {{$product->id}},
         },
         success: function (res) {
         window.location.reload();
         }
      });
   });
});
  </script>
@endsection

@section('toastr_js')
  @jquery
  @toastr_js
  @toastr_render
@endsection