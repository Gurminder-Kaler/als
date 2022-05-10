<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Controllers\Controller;

class CartController extends Controller
{ 

    // addToCart
    public function addToCart(Request $request) {
        // dd($request->all());
        $this->validate(
           $request,
           [
               'quantity' => 'required',
               'product_id' => 'required',
           ]
        );
        $query = new Cart();
        $query->quantity = $request->quantity;
        $query->user_id = auth()->user()->id;
        $query->product_id = $request->product_id;
        $query->save();
        toastr()->success("Contact Query Received Successfully, We shall contact you shortly.");
        return redirect()->back()->with('flash_message', 'Contact Query Received Successfully, We shall contact you shortly.');
    }
    
}
