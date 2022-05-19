<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Donation;

class DonationReceivedMail extends Mailable
{
    use Queueable, SerializesModels;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Donation $query)
    {
        //
        $this->query = $query;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   

        $donation = $this->query;
        return $this->view('frontend.email.donationReceived', compact('donation'));
    }
}
