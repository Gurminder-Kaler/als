<?php

namespace App\Http\Controllers\Backend;

use Session;
use App\Models\DonationCause;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationCauseController extends Controller
{
    
    // donation index
    public function index() {
        $donationCauses = DonationCause::paginate(10);
        
        return view('backend.donationCause.index');
    }
    
    // donation create
    public function create() {
        return view('backend.donationCause.create');
    }
    
    // donation update
    public function update() {
        return view('backend.donationCause.update');
    }

    // donation delete
    public function delete() {
        return view('backend.donationCause.delete');
    }
    
}