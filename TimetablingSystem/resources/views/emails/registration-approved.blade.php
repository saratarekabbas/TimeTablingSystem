<x-mail::message>
# Welcome to Timetabling System

    Your registration request have been approved, we are excited to have you!
    You can use your credentials to log into your account now.

{{-- MODIFY LATER--}}
<x-mail::button :url="'/login'">
    Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
