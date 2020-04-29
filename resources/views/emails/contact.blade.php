@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => '/'])
Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
