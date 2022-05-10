<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
  @php
  $contact_details = contact_detail(); 
  $explode = explode(',',$order->product_ids);
  $quantity_explode = explode(',',$order->quantities);
  $i = 0; 
  $cake=0;
  $super_total = 0;
  $total_gst=0;
  @endphp

  
   <!-- Preview Text goes here-->
   <div style="font-size: 1px; color: #efe1b0; display: none">
       {{-- Place your preview message here. This will show in most email client as the preview text in the inbox. Also make sure it is long enough to make up all of the space available by your choosen email clients. --}}
   </div> 
   
    <!-- html goes here -->
    <table width="100%" border="0" cellspacing="0" celpadding="0">
        <tr>
            <!--/ Main Rows inside it creating containers-->
            <td>
                <table class="container" width="525" align="center" border="0" cellspacing="0" celpadding="0"  bgcolor="#fff" style="padding: 10px;">
                  <tr>
                    <!--/ Left Table-->
                      <td>
                          <table width="525" border="0" cellspacing="0" celpadding="0" style="border-bottom: 1px solid #999;">
                              <tr>
                                  <td valign="top" style="padding-right: 10px; border-right: 1px solid #999;">
                                      <div class="logo" style="background-color: black!important">
                                        <img style="width: 40%;height: auto" src="{{asset('/storage/logo/'.$contact_details->logo.'')}}" class="img-fluid" alt="{{$contact_details->logo}}" />
                                      </div>
                                  </td>
                                  <td valign="top" style="margin-right: 6px; padding-right: 10px;">
                                      @if(!empty($order->transaction_id))
                                      <p style="text-align: right; font-size: 11px; margin: 0 0 3px 0;">Transaction Id(Razorpay): {{$order->transaction_id}}</p>
                                     @else
                                      <p style="text-align: right; font-size: 11px; margin: 0 0 3px 0;">Payment Mode: COD</p>
                                     @endif
                                      <p style="text-align: right; font-size: 11px; margin: 0 0 3px 0;">Order No: {{ strtotime($order->created_at)}} </p> 
                                      <p style="text-align: right; font-size: 11px; margin: 0 0 3px 0;">Invoice Date: {{date('d-M-Y',strtotime($order->created_at))}}</p>
                                  </td>
                              </tr>
                          </table>
                          @php 
                          $address = address_find($order->shipping_address_id); 
                          $bill_address = address_find($order->billing_address_id); 
                          $user = user_detail($order->user_id); 
                          @endphp
                          <table width="525" border="0" cellspacing="0" celpadding="0" style="border-bottom: 1px solid #999;">
                              <tr>
                                  <td valign="top" style="padding: 10px 10px 10px 0;">
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Shipped To : </p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Name : {{$user->name}}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Email : {{$user->email}}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Mobile : {{$user->mobile}}</p> 
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Address Line 1 : {{$address->address_line_one}}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Address Line 2 : {{$address->address_line_two}}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">City : {{ucwords($address->city)}}</p> 
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Pincode : {{$address->zip_code}}</p>  
                                  </td>
                                  <td valign="top" style="padding: 10px 10px 10px 0;">
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Billed To : </p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Name : {{$user->name}}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Email : {{$user->email}}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Mobile : {{$user->mobile}}</p> 
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Address Line 1 : {{$bill_address->address_line_one}}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Address Line 2 : {{$bill_address->address_line_two}}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">City : {{ucwords($bill_address->city)}}</p> 
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Pincode : {{$bill_address->zip_code}}</p>  
                                  </td>
                              </tr>
                          </table> 
                          <table width="525" border="0" cellspacing="0" celpadding="0" style="border-bottom: 1px solid #999;">
                              <tr>
                                 
                                  <td>
                                    <p style="font-size: 14px; margin: 0 0 3px 0;">Bill From : </p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Mangal Sain & Sons </p>  
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Address : {!!$contact_details->address!!}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Phone(s) : {{$contact_details->phone_one}}, {{$contact_details->phone_two}}</p>
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">WhatsApp : {{$contact_details->whatsapp}}</p> 
                                      <p style="font-size: 14px; margin: 0 0 3px 0;">Email : {{$contact_details->email}}</p>  
                                  </td>
                              </tr>
                          </table>  
                      </td>
                  </tr> 
                  <tr>
                     <!--/ Right Table-->
                      <td valign="top">
                          <table width="523" align="center" border="0" cellspacing="0" celpadding="0">
                              <tr>
                                 <td valign="top" colspan="2"><h5 style="margin: 7px 0px 10px; padding: 10px; background-color: #ccc;text-align: center;">Tax Invoice</h5></td>
                              </tr>
                              <tr>
                                  <td valign="top">
                                      <p style="font-size:13px; margin: 0px 0px 2px;text-align:center">Invoice #:<b style="font-size: 10px;">{{date('Ym', strtotime($order->created_at))}}{{$order->id}}</b></p>                                     
                                  </td>
                                  <td align="top">
                                     <p style="font-size:13px; margin: 0px 0px 2px;text-align:center"> Invoice Date :<b style="font-size: 10px;">{{date('d M Y', strtotime($order->created_at))}}</b></p>
                                  </td>
                                  <td align="top">
                                     {{-- <p style="font-size:13px; margin: 0px 0px 2px;text-align:center"> Coupon Applied :<b style="font-size: 10px;">  @if($order['coupon_applied']) 
                                      <span>{{$order['coupon_applied']}}</span>
                                      @else
                                      <span>None</span>
                                      @endif 
                                      </b>
                                    </p>--}}
                                  </td>
                                  <td valign="top">
                                      <p style="text-align: right; font-size:13px; margin: 0px 0px 2px;text-align:center">Order #:<b style="font-size: 10px;">{{$order->id}}</b></p> 
                                  </td>
                              </tr>
                          </table> 
                          <table width="523" border="0" cellspacing="0" celpadding="0" style="border-bottom: 1px solid #999; margin-top: 20px; border-top: 1px solid #999;">
                              <tr>
                                  <th style="border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 12px; padding: 6px 2px;text-align:center">S.No.</th>
                                  <th style="border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 12px; padding: 6px 2px;text-align:center">Product</th>
                                  <th style="border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 12px; padding: 6px 2px;text-align:center">Hsn No.</th>
                                  <th style="border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 12px; padding: 6px 2px;text-align:center">Qty</th>
                                  <th style="border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 12px; padding: 6px 2px;text-align:center">Cost</th> 
                                  <th style="border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 12px; padding: 6px 2px;text-align:center">Discount %</th> 
                                  <th style="border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 12px; padding: 6px 2px;text-align:center">After Discount </th> 

                                  <th style="border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 12px; padding: 6px 2px;text-align:center">GST % <br>(CGST,SGST)</th>

                                  <th style="border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 12px; padding: 6px 2px;text-align:center">Sub Total</th> 
 
                              </tr>
                              @if(!empty($order)>0)
                                 
                                @foreach($explode as $ex)
                                 @php 
                                      $prod = product_detail($ex);    
                                      
                                      $a=0;
                                      $b=0;
                                      $c=0;
                                      $a = $prod->price - $prod->price*($prod->discount/100);
                                      $b = ($prod->price * $quantity_explode[$i])*($prod->gst/100);
                                      $c = $a*$quantity_explode[$i];
                                      
                                      $total_gst+=($c*($prod->gst/100));


                                   $super_total+=(($a+$b)*$quantity_explode[$i]);
                                  @endphp
                                  <tr>
                                      <td valign="top" style="padding:1px; border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 11px;text-align: center"><p>{{$loop->iteration}}</p></td>
                                      <td valign="top" style="padding:1px; border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 11px;text-align: center"><p>{{$prod->title}} {{$prod->size_volume}}</p></td>
                                      <td valign="top" style="padding:1px; border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 11px;text-align: center"><p>@if($prod->hsn_code){{$prod->hsn_code}}@else none @endif</p></td>
                                      <td valign="top" style="padding:1px; border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 11px;text-align: center"><p>{{$quantity_explode[$i]}}</p></td>
                                      <td valign="top" style="padding:1px; border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 11px;text-align: center"><p>Rs. {{$prod->price*$quantity_explode[$i]}}</p></td>
                                      <td valign="top" style="padding:1px; border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 11px;text-align: center"><p>{{$prod->discount}}%</p></td>
                                      <td valign="top" style="padding:1px; border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 11px;text-align: center"><p>Rs. {{$c}}</p></td>
                                      <td valign="top" style="padding:1px; border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 11px;text-align: center"><p>{{$prod->gst?$prod->gst:0}}% <br> CGST: {{$c*($prod->gst/200)}},<br> SGST: {{$c*($prod->gst/200)}}</p></td> 
                                      <td valign="top" style="padding:1px; border-bottom: 1px solid #999; border-right: 1px solid #999; font-size: 11px;text-align: center"><p>Rs. {{($a+$b)*$quantity_explode[$i]}}</p></td>  
                                  </tr>
                                  @php
                                  $i++;
                                  $cake = $cake + $c;
                                  @endphp
                                @endforeach
                              @endif 
                              <tr>
                                  <td valign="top" colspan="8" style="border-right: 1px solid #999;">
                                      <p style="margin:0 0 3px 0; font-size:12px; text-align:right;padding-right:10px;">TOTAL Sale Price Before Tax</p>
                                      <p style="margin:0 0 3px 0; font-size:12px; text-align:right;padding-right:10px;">Delivery charges</p>
                                      <p style="margin:0 0 3px 0; font-size:12px; text-align:right;padding-right:10px;">Total GST Amt.</p>
                                      <p style="margin:0 0 3px 0; font-size:12px; text-align:right;padding-right:10px;">Before Round Off</p>
                                  </td>
                                  <td valign="top" colspan="2">
                                      <p style="margin:0 0 3px 0; font-size:12px; text-align:right; padding-right:10px;">Rs. {{$cake}}</p>
                                      {{-- <p style="margin:0 0 3px 0; font-size:12px; text-align:right; padding-right:10px;">Rs. 
                                       @if(isset(fetch_location_via_zip_code(address_find($order['address_id'])->zip_code)->shipping_cost))
                                       {{fetch_location_via_zip_code(address_find($order['address_id'])->zip_code)->shipping_cost}}
                                       @else
                                        0
                                       @endif</p> --}}
                                      <p style="margin:0 0 3px 0; font-size:12px; text-align:right; padding-right:10px;">Rs. {{$total_gst}}  </p>
                                      <p style="margin:0 0 3px 0; font-size:12px; text-align:right; padding-right:10px;">Rs. {{$cake+$total_gst}}</p> 
                                  </td>
                              </tr>
                              <tr>
                                  <td valign="top" colspan="7" style="border-right: 1px solid #999;border-top:1px solid #999;">
                                      <p style="margin:0 0 3px 0; font-size:12px; text-align:center;padding-right:10px;">Total Sale Value after Tax</p>
                                  </td>
                                  <td valign="top" colspan="2" style="border-top:1px solid #999;">
                                      <p style="margin:0 0 3px 0; font-size:12px; text-align:right; padding-right:10px;">Rs. {{round($super_total)}}/-</p>
                                  </td>
                              </tr>
                          </table>
                          <table width="523" style="margin-top:55px" align="center" border="0" cellspacing="0" celpadding="0">
                              <tr>
                                  <td valign="top"> 
                                     <p style="font-size: 11px; margin: 10px 0 5px;"><strong>DECLARATION</strong> <br>We declare that this invoice shows actual price of the goods described inclusive of taxes and that all particulars are true and correct. In case you find Selling Price on this Invoice to be more than MRP mentioned on product, please inform. All the cost values are mentioned in Indian rupees <a href="#">info@als.com</a></p>
                                     <h6 style="font-size: 11px; margin: 10px 0 0;">PURCHASE MADE ON ALS.com</h6>
                                     <h6 style="font-size: 11px; margin: 10px 0 0; text-align: center;">ALS.com</h6>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <h6 style="font-size: 8px; margin: 0; border-top: 1px solid #999; border-bottom: 1px solid #999; padding: 10px; text-align: center;">THIS IS A COMPUTER GENERATED INVOICE AND DOES NOT REQUIRE SIGNATURE</h6>
                                  </td>
                              </tr>
                          </table>
                      </td>
                  </tr>
                </table>
                <!--/ Conatiners-->
            </td>
        </tr>
    </table>

</body>
</html>
