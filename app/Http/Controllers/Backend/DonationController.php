<?php

namespace App\Http\Controllers\Backend;

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