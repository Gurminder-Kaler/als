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
<div class="container">
    <div class="row my-5">
        <div class="col-6">
            <div class="panel panel-default credit-card-box ">
                <div class="panel-heading display-table my-4" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Donation Causes</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">    
                <div id="accordion">
                    @if(isset($donationCauses))
                        @foreach($donationCauses as $donationCause)
                        <div class="card">
                            <div class="card-header" id="{{$donationCause->id}}">
                                <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{$donationCause->id}}" aria-expanded="true" aria-controls="collapseOne{{$donationCause->id}}">
                                {{$donationCause->title}}
                                </button>
                                </h5>
                            </div>
                        
                            <div id="collapseOne{{$donationCause->id}}" class="collapse @if($loop->first) show @endif" aria-labelledby="{{$donationCause->id}}" data-parent="#accordion">
                                <div class="card-body">
                                <img style="height: 160px;width: 190px" src="{{url('/storage/donationCause/'.$donationCause->img.'')}}" alt="{{$donationCause->img}}">
                                <a class="btn btn-sm btn-dark" href="{{url('/donate/'.$donationCause->slug .'')}}">Show More <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="panel panel-default credit-card-box ">
                <div class="panel-heading display-table my-4" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Card Details</h3>
                        <div class="btn btn-sm" >
                            <a href="{{url('/myDonations')}}" class="myPink" ><i class="fa fa-smile-o"></i> My Donations</a>
                            {{-- <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png"> --}}
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <form
                        role="form"
                        action="{{ url('/submitDonation') }}"
                        method="post"`
                        class="require-validation"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="pk_test_51KxqnAHryki7BTj3xWyCo3dvrCuuDeyBt7JIAEqdae09Jze1ZwcRExc8bQXSOWzRp5XKrmuDpu5Hz5uBCfzbP2Su00f7ZveTNO"
                        id="payment-form">
                        @csrf

                        <div class='form-row row'>
                            
                            <div class="row" style="border: 1px solid #8080804d; padding:15px 5px;margin:12px 0px 12px 0px">
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
                                    <input autocomplete='off' value="123" class='form-control card-cvc' plac    eholder='ex. 311' size='4'
                                        type='text'>
                                </div>
                                <div class='col-6 form-group expiration requi   red'>
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
                            </div>
                            

                            <div class='col-12 form-group amount required'>
                                <label class='control-label'>Select Donation Cause</label>
                                <select class='form-control card-expiry-year' name="donation_cause_id">
                                    @if(isset($donationCauses))
                                        @foreach($donationCauses as $donationCause)
                                            <option value="{{$donationCause->id}}">{{$donationCause->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class='col-9 form-group amount required'>
                                <label class='control-label'>Donation Amount</label>
                                <input
                                    class='form-control card-expiry-year' placeholder='Enter the amount in Canadian dollars' size='4'
                                    type='number' name="amount" value="100" min="3" max="9999">
                            </div>

                            <div class='col-3 form-group expiration required'>
                                <label class='control-label'></label>
                                <button class="btn btn-success mt-2 btn-block" type="submit"><i class="fa fa-credit-card"></i>&nbsp;Donate</button>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('stripe')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

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