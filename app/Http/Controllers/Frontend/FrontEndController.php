<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Banner;
use Auth;
use Hash;
use Stripe;
use Session;
use App\Models\Order;
use App\Models\Cart;    
use App\Models\Product;
use App\Models\Address;
use App\Models\About;
use App\Models\SiteSetting;
use App\Models\Subscriber;
use App\Models\Donation;
use App\Models\User;
use App\Models\ContactQuery;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;


class FrontEndController extends Controller
{
    // home page
    public function index() {
        $banner = Banner::find(1);
        $featuredProducts = Product::where('deleted_at', null)->where('featured_status', 1)->get();
        return view('frontend.index', compact('banner', 'featuredProducts'));
    }

    // all - products page
    public function privacyPolicy() {
        $siteSetting = SiteSetting::find(1);
        return view('frontend.privacyPolicy', compact('siteSetting'));
    }

    // all - products page
    public function allProducts() {
        $products = Product::paginate(12);
        $productCategories = ProductCategory::all();
        return view('frontend.allProducts', compact('products', 'productCategories'));
    }

    // donation page
    public function donate() {
        return view('frontend.donate');
    }

    // single - product page
    public function singleProduct(Request $request) {
        $slug = $request->slug;
        $product = Product::where('slug', $slug)->first();
        $similarProducts = Product::where('category_id', $product->category_id)->get();
        return view('frontend.singleProduct', compact('product', 'similarProducts'));
    }

    // about page
    public function about() {
        $about = About::find(1);
        return view('frontend.about', compact('about'));
    }

    // contact page
    public function contact() {
        return view('frontend.contact');
    } 
    
    //select the address in the frontend
    public function addressSelect(Request $request)
    {
        $id = $request->id;
        $addresses = Address::where('user_id', Auth::user()->id)
        ->where('id', '!=', $id)
        ->get();
        foreach($addresses as $a) {
            $a->status = 0;
            $a->update();
        }

        $address = Address::find($id);
        $address->status = 1;
        $address->update();
    }

    // subscribeToNewsletter
    public function subscribeToNewsletter(Request $request) {
        $this->validate(
           $request,
           [
               'newsletter_email' => 'required|unique:subscribers',
           ]
        );
        $sub = new Subscriber();
        $sub->newsletter_email = $request->newsletter_email;
        $sub->save();
        toastr()->success("Subscribed to Newsletter successfully.");
        return redirect()->back()->with('newsletter_sub_success', 'Subscribed to Newsletter successfully.');
    }

    // checkout
    public function checkout() {
    
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $addresses = Address::where('user_id', Auth::user()->id)->where('deleted_at', null)->get();
        $selectedAddress = Address::where('user_id', Auth::user()->id)->where('status', 1)->first();
        return view('frontend.checkout', compact('cart', 'addresses', 'selectedAddress'));
        
    }

    // addToCart
    public function addToCart(Request $request) {
        $this->validate(
           $request,
           [
               'quantity' => 'required',
               'product_id' => 'required',
           ]
        );
        $oldCart = Cart::where('user_id', Auth::user()->id)
        ->where('product_id', $request->product_id)
        ->first();
        if ($oldCart != null) {
            $oldCart->quantity = $oldCart->quantity + $request->quantity;
            $oldCart->update();
            toastr()->success("Item added to cart successfully.");
            return redirect()->back();
        }
        $cart = new Cart();
        $cart->quantity = $request->quantity;
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $request->product_id;
        $cart->save();
        toastr()->success("Item added to cart successfully.");
        return redirect()->back();
    }

    // increase Quantity
    public function increaseQuantity(Request $request) {
       $cart = Cart::find($request->cart_id);
       $cart->quantity = $cart->quantity + 1;
       $cart->update();
       toastr()->success("Item added to cart.");
       return redirect()->back();
    }

    // decrease Quantity
    public function decreaseQuantity(Request $request) {
        $cart = Cart::find($request->cart_id);
        if ($cart->quantity == 1) {
            $cart->delete();
        } else {
            $cart->quantity = $cart->quantity - 1;
            $cart->update(); 
        }
        toastr()->success("Item removed from cart.");
        return redirect()->back();
    }

    // remove Quantity
    public function removeItem(Request $request) {
        $cart = Cart::find($request->cart_id);
        $cart->delete();

       toastr()->success("Item deleted from cart.");
       return redirect()->back();
    }

    // // checkOut
    // public function checkout(Request $request) {
    //     $cart = Cart::find($request->cart_id);
    //     $cart->delete();

    //    toastr()->success("Item Deleted from Cart.");
    //    return redirect()->back();
    // }

    // submitContactForm
    public function submitContactForm(Request $request) {
        // dd($request->all());
        $this->validate(
           $request,
           [
               'contact_query_email' => 'required',
               'contact_query_name' => 'required',
               'contact_query_subject' => 'required',
               'contact_query_message' => 'required',
           ]
        );
        $query = new ContactQuery();
        $query->email = $request->contact_query_email;
        $query->name = $request->contact_query_name;
        $query->subject = $request->contact_query_subject;
        $query->message = $request->contact_query_message;
        $query->save();
        toastr()->success("Contact Query Received Successfully, We shall contact you shortly.");
        return redirect()->back()->with('flash_message', 'Contact Query Received Successfully, We shall contact you shortly.');
    }
    // updateProfile
    public function updateProfile(Request $request) {
        // dd($request->all());
        $this->validate(
           $request,
           [
               'name' => 'required',
           ]
        );
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        if($request->hasfile('profile_photo'))
        {
           $image = $request->file('profile_photo');
           $img = time().$image->getClientOriginalName();
           $path = 'storage/profile/';
           $upload = $image->move($path, $img);
           $user->profile_photo = $img;
        }
        $user->update();
        toastr()->success("Data Updated Successfully.");
        return redirect()->back()->with('flash_message', 'Data Updated Successfully.');
    }
    // updateProfile
    public function changePassword(Request $request) {
        // dd($request->all());
        $this->validate(
           $request,
           [
               'oldPassword' => 'required',
               'newPassword' => 'required',
               'confirmNewPassword' => 'required',
           ]
        );
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->oldPassword, $user->password)) {
            if ($request->newPassword == $request->confirmNewPassword) {
                $user->password = Hash::make($request->newPassword);
                $user->update();
                toastr()->success("Password Updated Successfully.");
                return redirect()->back()->with('flash_message', 'Password Updated Successfully.');
            } else {
                toastr()->warning("New Password and Confirm Password Mismatch.");
                return redirect()->back()->with('flash_message', 'New Password and Confirm Password Mismatch.');
            }
        } else {
            toastr()->warning("Old Password did not match.");
            return redirect()->back()->with('flash_message', 'Old Password did not match.');
        }
    }

    public function submitDonation(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $stripe = Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);

        if ($stripe->failure_code !== null) {

            Session::flash('failure', $stripe->failure_message);
            return redirect()->back();
        }
        $donation = new Donation();
        $donation->transaction_id = $stripe->id;
        $donation->amount = $stripe->amount/100;
        if (Auth::check()) {
            $donation->user_id = Auth::user()->id;
        } else {
            $donation->user_id = 0; // Anonymous Donation.
        }
        $donation->save();
        // $details = [
        //     'donation' => $donation,
        // ];
        // dd(Auth::user()->email);
        \Mail::to(Auth::user()->email)->send(new \App\Mail\DonationReceivedMail($donation));
        // id: "ch_3KybHtHryki7BTj30R4QV57P"
        // object: "charge"
        // amount: 10000
        // amount_captured: 10000
        // amount_refunded: 0
        // application: null
        // application_fee: null
        // application_fee_amount: null
        // balance_transaction: "txn_3KybHtHryki7BTj30Le4W7UN"
        // billing_details: Stripe\StripeObject {#378 ▶}
        // calculated_statement_descriptor: "Stripe"
        // captured: true
        // created: 1652359117
        // currency: "usd"
        // customer: null
        // description: "Test payment from itsolutionstuff.com."
        // destination: null
        // dispute: null
        // disputed: false
        // failure_balance_transaction: null
        // failure_code: null
        // failure_message: null
        // fraud_details: []
        // invoice: null
        // livemode: false
        // metadata: Stripe\StripeObject {#379 ▶}
        // on_behalf_of: null
        // order: null
        // outcome: Stripe\StripeObject {#384 ▶}
        // paid: true
        // payment_intent: null
        // payment_method: "card_1KybHsHryki7BTj3KmvhFVB2"
        // payment_method_details: Stripe\StripeObject {#391 ▶}
        // receipt_email: null
        // receipt_number: null
        // receipt_url: "https://pay.stripe.com/receipts/acct_1KxqnAHryki7BTj3/ch_3KybHtHryki7BTj30R4QV57P/rcpt_LfxC8t8lVYIDHBHvFt32grcBDYQCLpS"
        // refunded: false
        // refunds: Stripe\Collection {#395 ▶}
        // review: null
        // shipping: null
        // source: Stripe\Card {#400 ▶}
        // source_transfer: null
        // statement_descriptor: null
        // statement_descriptor_suffix: null
        // status: "succeeded"
        // transfer_data: null
        // transfer_group: null
  
        Session::flash('success', 'Payment successful!');
          
        return redirect()->back();
    } 

    public function myAddresses() {
        $addresses = Address::where('deleted_at', null)->where('user_id', Auth::user()->id)->get();
        $selectedAddress = Address::where('user_id', Auth::user()->id)->where('status', 1)->first();
        return view('frontend.dashboard.myAddresses', compact('addresses', 'selectedAddress'));
    }

    public function addMyAddress(Request $request) {
        // dd($request->all());
        $this->validate(
            $request,
            [
                'company_house_no' => 'required',
                'country' => 'required',
                'city' => 'required',
                'province' => 'required',
                'zip_code' => 'required',
                'address_line_one' => 'required',
                'address_line_two' => 'required',
                'type' => 'required'
            ]
         );
         $address = new Address();
         $address->company_house_no = $request->company_house_no;
         $address->country = $request->country;
         $address->city = $request->city;
         $address->province = $request->province;
         $address->user_id = Auth::user()->id;
         $address->zip_code = $request->zip_code;
         $address->address_line_one = $request->address_line_one;
         $address->address_line_two = $request->address_line_two;
         $address->type = $request->type;
         $address->save();
         return redirect()->back()->with('flash_message', 'Address Added Successfully!');
    }

    public function changePasswordView() {
        return view('frontend.password.changePassword');
    }

    public function myCart() {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('frontend.dashboard.myCart', compact('cart'));
    }

    public function myProfile() {
        return view('frontend.dashboard.myProfile');
    }

    public function myDonations() {
        $donations = Donation::where('user_id', Auth::user()->id)->get();
        return view('frontend.dashboard.myDonations', compact('donations'));
    }

    public function myOrders() {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('frontend.dashboard.myOrders', compact('orders'));
    }

    // placeOrder from the cart items
    public function placeCartOrder(Request $request) {
        // dd($request->all());
        
        $selectedAddress = Address::where('user_id', Auth::user()->id)->where('status', 1)->first();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $allQuantities = 0;
        $productIds = [];
        $totalCostBeforeTax = 0;
        $totalCostAfterTax = 0;
        foreach( $cart as $c) {
            $allQuantities+=$c->quantity;
            array_push($productIds, $c->product_id);
            $totalCostBeforeTax += ($c->quantity * $c->product->price);
        }
        $totalCostAfterTax = $totalCostBeforeTax + $totalCostBeforeTax*0.13;
        // dd($totalCostAfterTax);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $stripe = Stripe\Charge::create ([
                "amount" => $totalCostAfterTax * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
        // dd($stripe);
        if ($stripe->failure_code !== null) {

            Session::flash('failure', $stripe->failure_message);
            toastr()->warning($stripe->failure_message);
            return redirect()->back();
        }
        $order = new Order();
        $order->quantities = $allQuantities;
        $order->product_ids = implode(',', $productIds);
        $order->discount = 0;
        $order->total_cost = $totalCostAfterTax;
        $order->shipping_address_id = $selectedAddress->id;
        $order->billing_address_id = $selectedAddress->id;
        $order->payment_method = "stripe";
        $order->user_id = Auth::user()->id;
        $order->status = "placed";
        $order->transaction_id = $stripe->id;
        $order->type = "multiple";
        $order->order_id = 1;
        $order->save();
        foreach($cart as $c) {
            $c->delete();
        }
        return view('frontend.order.placeOrder', compact('cart', 'selectedAddress'));
        
    }

    //place order directly- when user presses PLACE ORDER button.

    public function placeDirectOrder(Request $request) {
        dd($request->all());
        $selectedAddress = Address::where('user_id', Auth::user()->id)->where('status', 1)->first();
        $product = Product::find($request->product_id);
        $totalCostBeforeTax = $product->price;
        $totalCostAfterTax = 0; 
        $totalCostAfterTax = $totalCostBeforeTax + $totalCostBeforeTax*0.13;
        $order = new Order();
        $order->quantities = 1;
        $order->product_ids = $request->product_id;
        $order->discount = 0;
        $order->total_cost = $totalCostAfterTax;
        $order->shipping_address_id = $selectedAddress->id;
        $order->billing_address_id = $selectedAddress->id;
        $order->payment_method = "stripe";
        $order->user_id = Auth::user()->id;
        $order->status = "placed";
        $order->transaction_id = $stripe->id;
        $order->order_id = 1;
        $order->type = "multiple";
        $order->save();
        return view('frontend.order.placeOrder', compact('cart', 'selectedAddress'));
    }
    
}
