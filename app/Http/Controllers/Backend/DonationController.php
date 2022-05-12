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
        $stripe = Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
        // dd($stripe);
        if ($stripe->failure_code !== null) {

            Session::flash('failure', $stripe->failure_message);
            return redirect()->back();
        }
        $donation = new Donation();
        $donation->transaction_id = $stripe->id;
        $donation->amount = $stripe->amount/100;
        if (auth()->check()) {
            $donation->user_id = Auth()->user()->id;
        } else {
            $donation->user_id = 0; // Anonymous Donation.
        }
        $donation->save();
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