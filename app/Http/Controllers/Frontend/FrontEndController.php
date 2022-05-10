<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Subscriber;
use App\Models\ContactQuery;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    // home page
    public function index() {
        $banner = Banner::find(1);
        return view('frontend.index', compact('banner'));
    }

    // all - products page
    public function privacyPolicy() {
        $products = SiteSetting::paginate(4);
        $productCategories = ProductCategory::all();
        return view('frontend.allProducts', compact('products', 'productCategories'));
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
        return view('frontend.singleProduct', compact('product'));
    }

    // about page
    public function about() {
        return view('frontend.about');
    }

    // contact page
    public function contact() {
        return view('frontend.contact');
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
    
}
