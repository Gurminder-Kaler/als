@extends('layout.frontendlayout')
@section('body')
<div class="featured-page">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>Support us by purchasing the products.</h1>
          </div>
        </div>
        <div class="col-md-8 col-sm-12">
          <div id="filters" class="button-group">
            <button class="btn btn-primary" data-filter="*">All Products</button>
            @if(isset($productCategories) && $productCategories->count() > 0)
              @foreach($productCategories as $cat)
                <button class="btn btn-primary" data-filter=".{{$cat->title}}">{{$cat->title}}</button>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="featured container no-gutter">

      <div class="row posts">
        @if(isset($products) && $products->count() > 0)
          @foreach($products as $p)
            <div id="{{$loop->iteration}}" class="item {{$p->category->title}} col-4">
              <a href="{{url('/product/'.$p->slug.'')}}">
                <div class="featured-item">
                  <img src="{{asset('/storage/product/'.$p->img.'')}}" alt="{{$p->img}}">
                  <h4>{{$p->title}}</h4>
                  <h6>${{$p->price}}</h6>
                </div>
              </a>
            </div>
          @endforeach
        @endif
      </div>
  </div>

  <div class="page-navigation">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          {{$products->links()}}
          {{-- <ul>
            <li class="current-page"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
          </ul> --}}
        </div>
      </div>
    </div>
  </div>
@endsection
{{-- @section('script')
<script>
  $('nav').find('.relative').addClass('d-none');
</script>
@endsection --}}