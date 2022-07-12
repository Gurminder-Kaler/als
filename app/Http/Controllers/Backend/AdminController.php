<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Donation;

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
}
