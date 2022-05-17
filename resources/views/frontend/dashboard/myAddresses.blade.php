@extends('layout.frontendlayout')
{{-- @section('head')
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
@endsection --}}
@section('body')
  <!-- Featured Starts Here -->
  <div class="featured-items">
    <div class="container">
      <div class="row">
        <div class="col-7">
          <div class="section-heading">
          <div class="line-dec"></div>
            <h1>My Addresses (Select default address)</h1>
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
                      {{-- <th scope="col">Address Type </th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($addresses as $a)
                    <tr>
                      {{-- {{dd($selectedAddress)}} --}}
                    <th scope="row"><input type="checkbox" 
                      @if($selectedAddress != null) 
                        @if($a->id == $selectedAddress->id) 
                      checked 
                        @endif
                      @endif
                      class="addressSelect" value="{{$a->id}}" /></th>
                      <td>{{$a->company_house_no}}</td>
                      <td>{{$a->address_line_one . ' / ' . $a->address_line_two}}</td>
                      <td>{{$a->country. ', '. $a->province. ', '. $a->city. ', '. $a->zip_code}}</td>
                      {{-- <td>{{$a->type}}</td> --}}
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
        <div class="col-5">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>Add New Address</h1>
            <form id="address" action="{{url('/addMyAddress')}}" method="post">
              @csrf
                <div class="row">
                  <div class="col-6 p-2">
                    <fieldset>
                      <label for="company_house_no">House No. /Company</label>
                      <input required name="company_house_no" type="text" class="form-control" id="name">
                    </fieldset>
                  </div>
                  <div class="col-6 p-2">
                    <fieldset>
                      <label for="country">Country</label>
                      <input required name="country" type="text" class="form-control" id="name">
                    </fieldset>
                  </div>
                  <div class="col-6 p-2">
                    <fieldset>
                      <label for="city">City</label>
                      <input required name="city" type="text" class="form-control" id="name">
                    </fieldset>
                  </div>
                  <div class="col-6 p-2">
                    <fieldset>
                      <label for="province">Province</label>
                      <input required name="province" type="text" class="form-control" id="name">
                    </fieldset>
                  </div>
                  <div class="col-6 p-2">
                    <fieldset>
                      <label for="zip_code">Zip Code</label>
                      <input required name="zip_code" type="text" class="form-control" id="name">
                    </fieldset>
                  </div>
                  <div class="col-6 p-2">
                    <fieldset>
                      <label for="address_line_one">Address Line 1</label>
                      <input required name="address_line_one" type="text" class="form-control" id="name">
                    </fieldset>
                  </div>
                  <div class="col-6 p-2">
                    <fieldset>
                      <label for="address_line_two">Address Line 2</label>
                      <input required name="address_line_two" type="text" class="form-control" id="name">
                    </fieldset>
                  </div>
                  <div class="col-6 p-2">
                    <fieldset>
                      <label for="type">Type of Address</label>
                      <select name="type" id="typeOfAddress" class="form-control">
                        <option value="shipping">Shipping</option>
                        <option value="permanent">Permanent</option>
                        <option value="both">Both</option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-12 p-2">
                    <fieldset>
                      <button type="submit" class="btn btn-sm btn-success btn-block"><i class="fa fa-plus"></i> Add</button>
                    </fieldset>
                  </div>
                </div>
              </form>
          </div>
        </div>
       
      </div>
    </div>
  </div> 

@endsection
@section('script')
<script>
  $(document).ready(function() {
    $('.addressSelect').on('click',function(e) {
      var id = $(this).val();
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
            window.location.reload();
          }
      });
    });
  });
  </script>
@endsection