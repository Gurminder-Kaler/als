@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<!-- Featured Starts Here -->
<div class="featured-items">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h1>Featured Items</h1>
        </div>
      </div>
      <div class="col-md-12">
        <div class="owl-carousel owl-theme">
          @foreach($featuredProducts as $p)
          <a href="{{url('/product/'.$p->slug.'')}}">
            <div class="featured-item">
              <img src="{{asset('/storage/product/'.$p->img.'')}}" alt="Item 1">
              <h4>{{$p->title}}</h4>
              <h6>${{$p->price}}</h6>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Featured Ends Here -->
@endif