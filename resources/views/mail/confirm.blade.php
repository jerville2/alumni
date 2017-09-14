@component('mail::message')
# Welcome

Thanks for Signing up!
<br>
<br>
We just need you to confirm your Email address to get a full access to MMSU Alumni website.
<br>
<br>
Please Click the button below to Activate your Account.

@component('mail::button', ['url' => url('/verifyemail/'.$email_token)])
Confirm Email
@endcomponent

If you did not sign up, just ignore this message.
<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
