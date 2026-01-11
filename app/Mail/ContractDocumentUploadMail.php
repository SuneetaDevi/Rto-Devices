<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractDocumentUploadMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $uploadUrl;

    public function __construct($contract)
    {
        $this->contract = $contract;
        $this->uploadUrl = url('/contract/' . $contract->pub_ref . '/upload-documents');
    }

    public function build()
    {
        return $this->subject('Please Upload Your Verification Documents')
            ->markdown('emails.contract.upload');
    }
}
