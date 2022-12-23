@component('mail::message')
# Hello, {{$user->name}}

To enable your account, please click in

following link or copy it onto the address bar of your

favourite browser

@component('mail::button',['url' => $url])
Verifiy This email
@endcomponent

Please click within 24 hours.

Thanks,

Zoel
@endcomponent