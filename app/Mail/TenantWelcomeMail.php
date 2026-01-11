<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tenant;
    public $tenantUser;
    public $password;
    public $loginUrl;

    public function __construct($tenant, $tenantUser, $password, $loginUrl)
    {
        $this->tenant = $tenant;
        $this->tenantUser = $tenantUser;
        $this->password = $password;
        $this->loginUrl = $loginUrl;
    }

    public function build()
    {
        return $this->subject('Welcome to Your Tenant Dashboard')
            ->markdown('emails.tenant.welcome');
    }
}
