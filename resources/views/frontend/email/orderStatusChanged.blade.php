<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Thank you</title>
    <link rel="shortcut icon" href="ALS.png" type="image/x-icon">
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
</head>

<body>
    <header style="background-color:rgb(28,24,147); width:100%; padding:10px;">
        <img src="logo.png" alt="ALS" style="width:100px; height:auto; margin-left:44%;">
        <h1 style=" text-align:center ;color:white">Animal Lovers' Society</h1>
    </header>
    <main>
        <div class="main_container" style="display:flex; gap:20px;">
            <div class="image" style="border:2px ;padding-top:5%;">
                <img src="jamie-street-Lw9STRb-D6o-unsplash.jpg" alt="Thank You" style=width:200px;>
            </div>
            <div class="text" style="background-color:rgba(186,84,153,0.5); padding:5%; border:2px; border-color:rgba(186,84,153,0.5); border-style:dashed; margin-top:5%;">
                <p>Hi <strong> X </strong></p>
                <p> Product(s): .</p>
                @php
                //   dd($order);
                  $productIds = explode(',',$order->product_ids);
                  $i=0;
                  $quantities = explode(',',$order->quantities);
                  @endphp
                  @foreach($productIds as $prod)
                  @php
                    $productDetail = \App\Models\Product::find($prod);
                    // dd($quantities);    
                  @endphp
                  <a href="{{url('/product/'.$productDetail->slug.'')}}" 
                    target="_blank">
                    {{$productDetail->title}}
                  </a> X 
                  {{isset($quantities[$i])
                  ? $quantities[$i] 
                  : ''}} 
                  @php 
                    $i++;
                  @endphp
                  <br>
                  @endforeach
                <strong>Your order number {{$order->id}}, status has changed to {{$order->status}}.</strong>
                <p> We are really grateful for your help.
                    Together we can raise knowlege and provide support for animals.
                <p><strong>Yours Lovely,</strong><br> <a href="{{url('/')}}" style="text-decoration:none; color:black; font-weight:bold;">Animal Lovers Society</a></p>
            </div>
            <div class="image" style=border:2px;padding-top:5%;>
                <img src="the-lucky-neko-uePn9YCTCY0-unsplash.jpg" alt="Thank You" style=width:200px;>
                <img src="eric-ward-ISg37AI2A-s-unsplash.jpg" alt="Thank You" style=width:200px;>
            </div>
        </div>
    </main>
    <footer style=background-color:rgb(28,24,147);font-weight:bold;width:100%;height:40px;margin-top:10px;margin-bottom:0px;>
        <a href="#" style=color:white;>Home</a> | <a href="#" style=color:white>About us</a> | <a href="#" style=color:white>Contact us</a> | <a href="#" style=color:white>help
        </a>
    </footer>
</body>

</html>