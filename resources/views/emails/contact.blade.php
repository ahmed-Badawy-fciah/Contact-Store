@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => 'https://facebook.com/ahmed.ali.badawy22/'])
My Facebook
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
