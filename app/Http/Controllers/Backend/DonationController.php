<?php

namespace App\Http\Controllers\Backend;

use Stripe;
use Session;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    
    // donation index
    public function index() {
        $donations = Donation::paginate(10);
        return view('backend.donation.index', compact('donations'));
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
  
        Session::flash('success', 'Payment successful!');
          
        return back();
    }
    
    // donation create
    public function create() {
        return view('backend.donation.create');
    }
    
    // donation update
    public function update() {
        return view('backend.donation.update');
    }

    // donation delete
    public function delete() {
        return view('backend.donation.delete');
    }
    
}