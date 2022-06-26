<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    

    public function donationCause() {
        return $this->belongsTo('App\Models\DonationCause', 'donation_cause_id', 'id');
    }

}
