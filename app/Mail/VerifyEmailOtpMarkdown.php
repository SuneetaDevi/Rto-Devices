<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmailOtpMarkdown extends Mailable
{
    use Queueable, SerializesModels;
    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->markdown('emails.verify-otp')
            ->subject('Your Email Verification OTP');
    }

}
