<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Payout;

class PayoutProcessedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payout;
    public $user;

    public function __construct(Payout $payout)
    {
        $this->payout = $payout;
        $this->user = $payout->user;
    }

    public function build()
    {
        return $this->subject('Your Payout Has Been Processed')
                    ->markdown('emails.payouts.processed');
    }
}
