@component('mail::message')
# Verification Document Upload Required

Hello,

You are receiving this email because we need you to upload your verification documents to complete your contract
application.

Please click the button below to securely upload the following:

- Front of your ID
- Back of your ID
- A photo of yourself (selfie)

@component('mail::button', ['url' => $uploadUrl])
Upload Documents
@endcomponent

If the button does not work, copy and paste the link below into your browser:

{{ $uploadUrl }}

This link is secure and will expire automatically after your upload is completed.

If you believe you received this email by mistake, please ignore it.

Thanks,<br>
{{ config('app.name') }}
@endcomponent