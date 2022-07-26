<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactQuery;
use App\Models\User;
use App\Models\Order;
use App\Models\Donation;
use App\Models\Subscriber;

class AdminController extends Controller
{
    // admin dashboard
    public function dashboard()
    {
        $totalNoOfUsers = User::all()->count();
        $totalNoOfDonors = User::where('role', 'donor')->get()->count();
        $donations = Donation::all();
        $totalNoOfDonations = $donations->count();
        $totalDonationAmount = $donations->sum('amount');
        $totalNoOfOrders = Order::all()->count();
        return view('backend.dashboard', compact('totalNoOfUsers', 'totalNoOfDonors', 'totalNoOfDonations', 'totalDonationAmount', 'totalNoOfOrders'));
    }

    public function newsletterSubscription()
    {
        $subscriptions = Subscriber::all();
        return view('backend.newsletterSubscription.index', compact('subscriptions'));
    }

    public function contactQuery()
    {
        $contactQuery = ContactQuery::all();
        return view('backend.contactQuery.index', compact('contactQuery'));
    }
}
