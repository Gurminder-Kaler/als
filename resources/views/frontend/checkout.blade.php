@extends('layout.frontendlayout')
@section('head')
<style type="text/css">
    .panel-title {
    display: inline;
    font-weight: bold;
    }
    .display-table {
        display: table;
    }
    .display-tr {
        display: table-row;
    }
    .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 61%;
    }
    .hide {
        display: none;
    }
</style>
@endsection
@section('body')
<div class="about-page">
  <div class="container">
     <div class="row">
        <div class="col-md-12">
           <div class="section-heading text-center">
              <h1>Checkout</h1>
           </div>
           <div class="section-heading">
              <div class="line-dec"></div>
              <h4>My Cart</h4>
              <a href="{{url('/myCart')}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit Cart</a>
           </div>
           <div class="right-content">
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
                       </tr>
                    </thead>
                    <tbody class="text-center">
                      @php 
                      $numberOfitems = 0;
                      $totalCostBeforeTax = 0;
                      @endphp
                       @foreach($cart as $item)
                       <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td>{{$item->product ? $item->product->title : 'No title Found'}}</td>
                          <td><img src='{{"/storage/product/".$item->product->img.""}}' width="90px" height="80px" /></td>
                          <td>{{$item->product ? $item->quantity : 'No Quantity Found'}}</td>
                          <td>{{$item->product ? $item->product->price : 'No Price Found'}}</td>
                          <td>{{$item->product ? $item->quantity * $item->product->price : 'No total price Found'}}</td>
                       </tr>
                       @php
                        $numberOfitems += $item->quantity;
                        $totalCostBeforeTax += ($item->quantity * $item->product->price);
                       @endphp
                       @endforeach
                       <tr>
                         <td></td>
                         <td></td>
                         <td></td>
                       <td><i>Total no. of items : </i>{{$numberOfitems}}</td>
                         <td></td>
                       <td><i>Total cost before tax : </i>$ {{$totalCostBeforeTax}}</td>
                       </tr>
                    </tbody>
                 </table>
              </div>
              @else
              <div class="text-center">
                 <h2>Your Cart is Empty</h2>
              </div>
              <div class="col-12">
                 <a href="{{url('/products')}}" class="btn btn-sm btn-primary">Explore Products <i class="fa fa-arrow-right"></i></a>
              </div>
              @endif
           </div>
        </div>
        <div class="col-md-12"> 
          <div class="row">
            <div class="col-12">
              <div class="section-heading">
                  <div class="line-dec"></div>
                  <h4>My Addresses (Select default address)</h4>
                  <a href="{{url('/myAddresses')}}" class="btn btn-sm btn-success my-2"><i class="fa fa-edit"></i> Edit Addresses</a>
              </div>
              <div class="row">
                @if(isset($addresses) && $addresses->count() > 0)
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                      <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">House No. or Company Name</th>
                            <th scope="col">Address Line 1 & 2</th>
                            <th scope="col">Country, Province, City, Zip </th>
                            {{-- 
                            <th scope="col">Address Type </th>
                            --}}
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($addresses as $a)
                          <tr>
                            {{-- {{dd($selectedAddress)}} --}}
                            <th scope="row">
                              <input type="radio" 
                                @if($selectedAddress != null) 
                                  @if($a->id == $selectedAddress->id) 
                                    checked 
                                  @endif
                                @endif
                                class="addressSelect" name="address" value="{{$a->id}}" />
                            </th>
                            <td>{{$a->company_house_no}}</td>
                            <td>{{$a->address_line_one . ' / ' . $a->address_line_two}}</td>
                            <td>{{$a->country. ', '. $a->province. ', '. $a->city. ', '. $a->zip_code}}</td>
                            {{-- 
                            <td>{{$a->type}}</td>
                            --}}
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
                @else
                <h4 class="p-3">--No Addresses Found--</h4>
                @endif
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-6">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>Proceed with payment</h1>
          </div>
          <form 
              role="form" 
              action="{{ url('/placeCartOrder') }}" 
              method="post" 
              class="require-validation"
              data-cc-on-file="false"
              {{-- data-stripe-publishable-key="{{ env('STRIPE_PUBLISHABLE_KEY') }}" --}}
              data-stripe-publishable-key="pk_test_51KxqnAHryki7BTj3xWyCo3dvrCuuDeyBt7JIAEqdae09Jze1ZwcRExc8bQXSOWzRp5XKrmuDpu5Hz5uBCfzbP2Su00f7ZveTNO"
              id="payment-form">
              @csrf
              <div class='form-row row'>
                <div class='col-12 form-group required'>
                  <label class='control-label'>Name on Card</label> 
                  <input value="Gurminder Singh" class='form-control' size='12' type='text'>
                </div>
                <div class='col-10 form-group required'>
                  <label class='control-label'>Card Number</label> 
                  <input value="4242424242424242" autocomplete='off' class='form-control card-number' size='20'
                    type='text'>
                </div>
                <div class='col-2 form-group cvc required'>
                    <label class='control-label'>CVC</label> 
                    <input autocomplete='off' value="123" class='form-control card-cvc' placeholder='ex. 311' size='4'
                      type='text'>
                </div>
                <div class='col-6 form-group expiration required'>
                  <label class='control-label'>Expiration Month</label> 
                  {{-- <input  class='form-control card-expiry-month' placeholder='MM' size='2'
                    type='text'> --}}
                  <select class="form-control card-expiry-month" >
                  @php
                  $array = ["01", "02", "03", "04","05", "06", "07", "08", "09", "10", "11", "12"]; 
                  @endphp
                  @foreach($array as $a) 
                  <option @if($a == "01") value="{{$a}}" @endif>{{$a}}</option>
                  @endforeach
                  @endphp
                  </select>
                </div>
                <div class='col-6 form-group expiration required'>
                  <label class='control-label'>Expiration Year</label> 
                  {{-- <input
                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                    type='text'> --}}
                  <select class="form-control card-expiry-year" >
                  @for($i = 2022; $i < 2050; $i++) 
                  <option @if($i == 2023) selected @endif value="{{$i}}">{{$i}}</option>
                  @endfor
                  </select>
                </div>
                <div class='col-9 form-group amount'>
                  <label class='control-label'>Cost before tax : </label> 
                  <b>$ {{$totalCostBeforeTax}}</b>
                </div>
                <div class='col-9 form-group amount'>
                  <label class='control-label'>13% HST : </label> 
                  <b>$ {{$totalCostBeforeTax*0.13}}</b>
                </div>
                <div class='col-9 form-group amount'>
                  <label class='control-label'>Total cost : </label> 
                  <b>$ {{$totalCostBeforeTax+$totalCostBeforeTax*0.13}}</b>
                </div>
                <input type="hidden" name="amount" value="{{$totalCostBeforeTax+$totalCostBeforeTax*0.13}}">
                <div class='col-3 form-group expiration required'>
                  <label class='control-label'></label> 
                  <button class="btn btn-success mt-2 btn-block" type="submit"><i class="fa fa-credit-card"></i>&nbsp;Buy</button>
                </div>
              </div>
              <div class='form-row row'>
                <div class='col-12 error form-group hide'>
                    <div class='alert-danger alert'>Please correct the errors and try again.</div>
                </div>
              </div>
          </form>
        </div>
        <div class="col-md-6">
          <div class="row">
          </div>
        </div>
     </div>
  </div>
</div>
@endsection

@section('stripe')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
  $(document).ready(function() {
    $('.addressSelect').on('click', function(){
      let id = $(this).val();
      $.ajax({
        type: "POST",
        url: "/addressSelect",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          id: id,
        },
        success: function (res) {
          toastr.success('Your default address is selected!');
        }
      });
    });
  });
</script>
<script type="text/javascript">
$(function() {
   
    var $form         = $(".require-validation");
   
    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
  
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
   
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey("pk_test_51KxqnAHryki7BTj3xWyCo3dvrCuuDeyBt7JIAEqdae09Jze1ZwcRExc8bQXSOWzRp5XKrmuDpu5Hz5uBCfzbP2Su00f7ZveTNO");
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
  
  });
  
  function stripeResponseHandler(status, response) {
    if (response.error) {
        $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
    } else {
        /* token contains id, last4, and card type */
        var token = response['id'];
            
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
    }
  }
   
});
</script>
@endsection