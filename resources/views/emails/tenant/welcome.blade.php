@component('mail::message')
# Welcome to {{ config('app.name') }}, {{ $tenantUser->name }}!

Your tenant account has been created successfully.

### Login Details:
- **Shop Name:** {{ $tenant->name }}
- **Email:** {{ $tenantUser->email }}
- **Password:** {{ $password }}

@component('mail::button', ['url' => $loginUrl])
Login to Dashboard
@endcomponent

Once you log in, please change your password for security reasons.

Thanks,<br>
{{ config('app.name') }}
@endcomponent